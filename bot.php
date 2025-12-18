<?php
// SealSeen Professional Bot v3.0 - Full Stable Version
ob_start();
ini_set('display_errors', 0); 

$botToken = getenv('BOT_TOKEN');
$adminId = getenv('ADMIN_ID');

if (!$botToken) die("Token sozlanmagan!");

// DB ulanish
$db = new PDO('sqlite:sealseen.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Ma'lumotlar bazasi jadvallarini yaratish
$db->exec("CREATE TABLE IF NOT EXISTS users (
    chat_id INTEGER PRIMARY KEY, 
    name TEXT, 
    balance INTEGER DEFAULT 0, 
    step TEXT DEFAULT 'none',
    temp_data TEXT DEFAULT ''
)");

$db->exec("CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    type TEXT DEFAULT 'purchase',
    game TEXT,
    item TEXT,
    price INTEGER,
    player_id TEXT,
    status TEXT DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$db->exec("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category TEXT, 
    name TEXT, 
    price INTEGER
)");

$db->exec("CREATE TABLE IF NOT EXISTS promos (
    code TEXT PRIMARY KEY, 
    amount INTEGER, 
    status TEXT DEFAULT 'active'
)");

function bot($method, $datas = []) {
    global $botToken;
    $ch = curl_init("https://api.telegram.org/bot$botToken/$method");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    return json_decode(curl_exec($ch));
}

$update = json_decode(file_get_contents('php://input'));

if (isset($update->message)) {
    $msg = $update->message;
    $chat_id = $msg->chat->id;
    $text = $msg->text ?? '';
    $name = $msg->from->first_name;

    // Userni yaratish va ma'lumotlarni olish
    $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)")->execute([$chat_id, $name]);
    $user = $db->prepare("SELECT * FROM users WHERE chat_id = ?");
    $user->execute([$chat_id]);
    $user = $user->fetch(PDO::FETCH_ASSOC);

    // --- ADMIN JAVOB BERISH (REPLY) ---
    if ($chat_id == $adminId && isset($msg->reply_to_message)) {
        $replyText = $msg->reply_to_message->text;
        if (preg_match('/🆔 ID: (\d+)/', $replyText, $matches)) {
            $userId = $matches[1];
            bot('sendMessage', [
                'chat_id' => $userId,
                'text' => "📩 <b>Admindan javob keldi:</b>\n\n$text",
                'parse_mode' => 'HTML'
            ]);
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "✅ Javob yuborildi."]);
            exit;
        }
    }

    // --- ASOSIY BUYRUQLAR ---
    if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        $key = json_encode(['keyboard' => [[['text' => "🛍 Xizmatlar"], ['text' => "👤 Kabinet"]], [['text' => "📞 Yordam"]]], 'resize_keyboard' => true]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🖥️ Asosiy menyudasiz. Xizmatlardan foydalanish uchun tugmalardan birini bosing.", 'reply_markup' => $key]);
    } 

    // --- ADMIN PANEL ---
    elseif ($text == "/panel" && $chat_id == $adminId) {
        $key = json_encode(['inline_keyboard' => [
            [['text' => "➕ Paket qo'shish", 'callback_data' => "adm_add_start"]],
            [['text' => "🗑 Paketni o'chirish", 'callback_data' => "adm_del_list"]],
            [['text' => "📣 Mailing", 'callback_data' => "adm_mail"], ['text' => "📊 Stat", 'callback_data' => "adm_stat"]]
        ]]);
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "🕹 <b>Boshqaruv paneli:</b>", 'parse_mode' => 'HTML', 'reply_markup' => $key]);
    }

    // --- ADMIN STATISTIKA ---
    elseif ($text == "/stat" && $chat_id == $adminId) {
        $u_count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $o_count = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed'")->fetchColumn();
        $total_sum = $db->query("SELECT SUM(price) FROM orders WHERE status='completed' AND type='purchase'")->fetchColumn() ?? 0;
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "📊 <b>Statistika:</b>\n\nUserlar: $u_count\nBuyurtmalar: $o_count\nAylanma: ".number_format($total_sum)." so'm", 'parse_mode' => 'HTML']);
    }

    // --- PROMO KOD YARATISH (/promo 5000) ---
    elseif (strpos($text, "/promo ") === 0 && $chat_id == $adminId) {
        $sum = str_replace("/promo ", "", $text);
        if (is_numeric($sum)) {
            $code = "PC" . rand(1000, 9999);
            $db->prepare("INSERT INTO promos (code, amount) VALUES (?, ?)")->execute([$code, $sum]);
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "🎁 Promo-kod yaratildi: <code>$code</code>\nSumma: $sum so'm", 'parse_mode' => 'HTML']);
        }
    }

    // --- STEPLARNI QAYTA ISHLASH ---
    elseif ($user['step'] == 'wait_help') {
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "📨 <b>Yangi murojaat!</b>\n\n👤 Foydalanuvchi: $name\n🆔 ID: <code>$chat_id</code>\n\n💬 Xabar: <i>$text</i>", 'parse_mode' => 'HTML']);
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabaringiz yuborildi. Admin javobini kuting."]);
    }

    elseif ($user['step'] == 'wait_promo') {
        $stmt = $db->prepare("SELECT * FROM promos WHERE code = ? AND status = 'active'");
        $stmt->execute([$text]);
        $promo = $stmt->fetch();
        if ($promo) {
            $db->prepare("UPDATE users SET balance = balance + ?, step = 'none' WHERE chat_id = ?")->execute([$promo['amount'], $chat_id]);
            $db->prepare("UPDATE promos SET status = 'used' WHERE code = ?")->execute([$text]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Promo-kod qabul qilindi! Hisobingizga ".number_format($promo['amount'])." so'm qo'shildi."]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Kod xato yoki ishlatilgan!"]);
        }
    }

    elseif ($user['step'] == 'adm_mail_all' && $chat_id == $adminId) {
        $all = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($all as $u) bot('sendMessage', ['chat_id' => $u, 'text' => $text]);
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$adminId]);
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "✅ Xabar hamma userlarga yuborildi."]);
    }

    // --- PAKET QO'SHISH STEPLARI ---
    elseif ($user['step'] == 'adm_add_cat') {
        $db->prepare("UPDATE users SET step = 'adm_add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Paket nomini kiriting (Masalan: 60 UC):"]);
    }
    elseif ($user['step'] == 'adm_add_name') {
        $db->prepare("UPDATE users SET step = 'adm_add_price', temp_data = ? WHERE chat_id = ?")->execute([$user['temp_data']."|".$text, $chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Narxni kiriting (Faqat raqam):"]);
    }
    elseif ($user['step'] == 'adm_add_price') {
        $ex = explode("|", $user['temp_data']);
        $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$ex[0], $ex[1], (int)$text]);
        $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Yangi paket qo'shildi!"]);
    }

    // --- TO'LOV VA ID KIRITISH ---
    elseif ($user['step'] == 'wait_sum') {
        if (is_numeric($text) && $text >= 1000) {
            $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💳 Karta: <code>5614 6868 1732 2558</code>\n📌 Summa: ".number_format($text)." so'm\n\nTo'lov qilganingizdan so'ng chekni (rasm) yuboring.", 'parse_mode' => 'HTML']);
        }
    }

    elseif ($user['step'] == 'wait_receipt' && isset($msg->photo)) {
        $photoId = end($msg->photo)->file_id;
        bot('sendPhoto', [
            'chat_id' => $adminId,
            'photo' => $photoId,
            'caption' => "💰 <b>Yangi to'lov!</b>\n🆔 ID: <code>$chat_id</code>\n💵 Summa: {$user['temp_data']} so'm",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "✅ Tasdiqlash", 'callback_data' => "adm_payok_{$chat_id}_{$user['temp_data']}"], ['text' => "❌ Rad etish", 'callback_data' => "adm_payno_$chat_id"]]]])
        ]);
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Chek yuborildi. Tez orada hisobingiz to'ldiriladi."]);
    }

    elseif (strpos($user['step'], 'wait_id_') === 0) {
        $p = explode("|", str_replace('wait_id_', '', $user['step'])); // id|price|name
        if ($user['balance'] >= $p[1]) {
            $db->prepare("UPDATE users SET balance = balance - ?, step = 'none' WHERE chat_id = ?")->execute([$p[1], $chat_id]);
            $db->prepare("INSERT INTO orders (user_id, game, item, price, player_id) VALUES (?,?,?,?,?)")->execute([$chat_id, 'GAME', $p[2], $p[1], $text]);
            $oid = $db->lastInsertId();
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtma qabul qilindi (#$oid)."]);
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "📦 <b>Yangi Buyurtma #$oid</b>\nUser: $chat_id\nPaket: {$p[2]}\nID: <code>$text</code>", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$oid"], ['text' => "❌ Bekor (Refund)", 'callback_data' => "ord_ref_$oid"]]]])]);
        }
    }

    // --- MENYU TUGMALARI ---
    elseif ($text == "🛍 Xizmatlar") {
        $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
        if (!$cats) {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Hozircha xizmatlar yo'q."]);
        } else {
            $btn = [];
            foreach ($cats as $c) $btn[] = [['text' => strtoupper($c), 'callback_data' => "cat_$c"]];
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'yin turini tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
    }

    elseif ($text == "👤 Kabinet") {
        $stmt = $db->prepare("SELECT SUM(amount) FROM orders WHERE user_id = ? AND status = 'completed' AND type = 'deposit'");
        $stmt->execute([$chat_id]);
        $total_in = $stmt->fetchColumn() ?? 0;
        
        $key = json_encode(['inline_keyboard' => [[['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]], [['text' => "🎁 Promo-kodni ishlatish", 'callback_data' => "use_promo"]]]]);
        $out = "💼 <b>Kabinetingizga xush kelibsiz.</b>\n\n📋 <b>Ma'lumotlaringiz</b>\n├ 🆔 <b>ID raqam:</b> <code>$chat_id</code>\n├ 💵 <b>Hisobingiz:</b> " . number_format($user['balance']) . " so'm\n╰ ✅ <b>Kiritgan pullaringiz:</b> " . number_format($total_in) . " so'm";
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => $out, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
    }

    elseif ($text == "📞 Yordam") {
        $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📝 Adminga murojaatingizni yozib yuboring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
    }
}

// --- CALLBACK QUERY ---
if (isset($update->callback_query)) {
    $cb = $update->callback_query;
    $chat_id = $cb->message->chat->id;
    $data = $cb->data;
    $mid = $cb->message->message_id;

    if ($data == "deposit") {
        $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 To'ldirish summasini kiriting (min 1,000):"]);
    }
    elseif ($data == "use_promo") {
        $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎁 Promo-kodni yuboring:"]);
    }
    elseif (strpos($data, "cat_") === 0) {
        $cat = str_replace("cat_", "", $data);
        $st = $db->prepare("SELECT * FROM products WHERE category = ?");
        $st->execute([$cat]);
        $prods = $st->fetchAll();
        $btn = [];
        foreach ($prods as $p) $btn[] = [['text' => $p['name']." - ".number_format($p['price']), 'callback_data' => "buy_{$p['id']}"]];
        bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "Paketni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
    }
    elseif (strpos($data, "buy_") === 0) {
        $pid = str_replace("buy_", "", $data);
        $st = $db->prepare("SELECT * FROM products WHERE id = ?"); $st->execute([$pid]);
        $pr = $st->fetch();
        $db->prepare("UPDATE users SET step = ? WHERE chat_id = ?")->execute(["wait_id_{$pr['id']}|{$pr['price']}|{$pr['name']}", $chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'yin ID raqamini yuboring:"]);
    }

    // Admin Callbacklari
    if ($chat_id == $adminId) {
        if ($data == "adm_add_start") {
            $db->prepare("UPDATE users SET step = 'adm_add_cat' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "Kategoriyani kiriting (pubg, ff va h.k.):"]);
        }
        elseif (strpos($data, "adm_payok_") === 0) {
            $ex = explode("_", $data); // adm, payok, id, sum
            $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$ex[3], $ex[2]]);
            $db->prepare("INSERT INTO orders (user_id, type, amount, status) VALUES (?, 'deposit', ?, 'completed')")->execute([$ex[2], $ex[3]]);
            bot('editMessageCaption', ['chat_id' => $adminId, 'message_id' => $mid, 'caption' => "✅ Tasdiqlandi!"]);
            bot('sendMessage', ['chat_id' => $ex[2], 'text' => "✅ Hisobingiz ".number_format($ex[3])." so'mga to'ldirildi."]);
        }
        elseif (strpos($data, "ord_done_") === 0) {
            $oid = str_replace("ord_done_", "", $data);
            $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
            bot('editMessageText', ['chat_id' => $adminId, 'message_id' => $mid, 'text' => "✅ #$oid bajarildi."]);
        }
        elseif (strpos($data, "adm_del_list") === 0) {
            $all = $db->query("SELECT * FROM products")->fetchAll();
            $btn = [];
            foreach ($all as $p) $btn[] = [['text' => "🗑 ".$p['name'], 'callback_data' => "adm_real_del_{$p['id']}"]];
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "O'chirmoqchi bo'lgan mahsulotni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif (strpos($data, "adm_real_del_") === 0) {
            $pid = str_replace("adm_real_del_", "", $data);
            $db->prepare("DELETE FROM products WHERE id = ?")->execute([$pid]);
            bot('answerCallbackQuery', ['callback_query_id' => $cb->id, 'text' => "O'chirildi!"]);
            bot('deleteMessage', ['chat_id' => $adminId, 'message_id' => $mid]);
        }
        elseif ($data == "adm_mail") {
            $db->prepare("UPDATE users SET step = 'adm_mail_all' WHERE chat_id = ?")->execute([$adminId]);
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "Xabaringizni yuboring, men uni hamma userlarga tarqataman."]);
        }
    }
}
