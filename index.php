<?php
// SealSeen Professional Bot v3.2 - Final Optimized Version
// Barcha tugmalar va orqaga qaytish funksiyalari to'liq ishchi holatda.

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'bot_errors.log');

// --- SOZLAMALAR ---
$config = [
    'bot_token' => getenv('BOT_TOKEN') ?: 'YOUR_BOT_TOKEN_HERE', 
    'admin_id'  => (int)(getenv('ADMIN_ID') ?: 123456789),       
    'db_file'   => 'sealseen.db',
    'card_num'  => '5614 6868 1732 2558' 
];

if ($config['bot_token'] == 'YOUR_BOT_TOKEN_HERE') die("Bot tokeni kiritilmagan!");

// --- DB ULANISH ---
try {
    $db = new PDO('sqlite:' . $config['db_file']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec('PRAGMA journal_mode = WAL;'); 
} catch (PDOException $e) {
    die("DB Ulanish xatosi: " . $e->getMessage());
}

// --- JADVALLARNI TEKSHIRISH ---
$tables = [
    "users" => "chat_id INTEGER PRIMARY KEY, name TEXT, balance INTEGER DEFAULT 0, step TEXT DEFAULT 'none', temp_data TEXT DEFAULT ''",
    "orders" => "id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER, type TEXT, game TEXT, item TEXT, price INTEGER, amount INTEGER, player_id TEXT, status TEXT DEFAULT 'pending', created_at DATETIME DEFAULT CURRENT_TIMESTAMP",
    "products" => "id INTEGER PRIMARY KEY AUTOINCREMENT, category TEXT, name TEXT, price INTEGER",
    "promos" => "code TEXT PRIMARY KEY, amount INTEGER, status TEXT DEFAULT 'active'"
];

foreach ($tables as $name => $schema) {
    $db->exec("CREATE TABLE IF NOT EXISTS $name ($schema)");
}

// --- YORDAMCHI FUNKSIYALAR ---

function bot($method, $datas = []) {
    global $config;
    $url = "https://api.telegram.org/bot" . $config['bot_token'] . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}

function esc($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function formatSum($sum) {
    return number_format((float)$sum, 0, '.', ' ');
}

// --- UPDATE NI QABUL QILISH ---
$update = json_decode(file_get_contents('php://input'));
if (!$update) exit;

try {
    $chat_id = null;
    $user = null;

    if (isset($update->message)) {
        $msg = $update->message;
        $chat_id = $msg->chat->id;
        $text = $msg->text ?? '';
        $name = $msg->from->first_name ?? 'User';

        $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)")->execute([$chat_id, $name]);
        $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

        // Admin javob berish mantiqi
        if ($chat_id == $config['admin_id'] && isset($msg->reply_to_message)) {
            $replyTxt = $msg->reply_to_message->text ?? $msg->reply_to_message->caption ?? '';
            if (preg_match('/🆔 ID: (\d+)/', $replyTxt, $matches)) {
                bot('sendMessage', [
                    'chat_id' => $matches[1],
                    'text' => "📩 <b>Admindan javob:</b>\n\n" . esc($text),
                    'parse_mode' => 'HTML'
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Javob yuborildi."]);
                exit;
            }
        }

        // Bosh menyu buyruqlari
        if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            $key = json_encode([
                'keyboard' => [
                    [['text' => "🛍 Xizmatlar"], ['text' => "👤 Kabinet"]],
                    [['text' => "📞 Yordam"]]
                ],
                'resize_keyboard' => true
            ]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🖥️ Asosiy menyudasiz.", 'reply_markup' => $key, 'parse_mode' => 'HTML']);
            exit;
        }

        // Admin Panel
        if ($text == "/panel" && $chat_id == $config['admin_id']) {
            $key = json_encode(['inline_keyboard' => [
                [['text' => "➕ Paket qo'shish", 'callback_data' => "adm_add_start"]],
                [['text' => "🗑 Paketni o'chirish", 'callback_data' => "adm_del_list"]],
                [['text' => "📣 Mailing", 'callback_data' => "adm_mail"], ['text' => "📊 Stat", 'callback_data' => "adm_stat"]]
            ]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "⚙️ <b>Admin Panel:</b>", 'parse_mode' => 'HTML', 'reply_markup' => $key]);
            exit;
        }

        // Steplar
        if ($user['step'] == 'wait_help') {
            bot('sendMessage', [
                'chat_id' => $config['admin_id'],
                'text' => "📨 <b>Yangi Murojaat!</b>\n👤 Kimdan: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n\n📄 Xabar: " . esc($text),
                'parse_mode' => 'HTML'
            ]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabaringiz adminga yuborildi.", 'reply_markup' => json_encode(['keyboard' => [[['text' => "🏠 Bosh menyu"]]], 'resize_keyboard' => true])]);
        } 
        elseif ($user['step'] == 'wait_promo') {
            $stmt = $db->prepare("SELECT * FROM promos WHERE code = ? AND status = 'active'");
            $stmt->execute([$text]);
            $promo = $stmt->fetch();
            if ($promo) {
                $db->prepare("UPDATE users SET balance = balance + ?, step = 'none' WHERE chat_id = ?")->execute([$promo['amount'], $chat_id]);
                $db->prepare("UPDATE promos SET status = 'used' WHERE code = ?")->execute([$text]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Tabriklaymiz! Hisobingizga " . formatSum($promo['amount']) . " so'm qo'shildi."]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Kod xato yoki avval ishlatilgan."]);
            }
        }
        elseif ($user['step'] == 'wait_sum') {
            if (is_numeric($text) && $text >= 1000) {
                $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "💳 <b>To'lov tizimi</b>\n\nKarta: <code>" . $config['card_num'] . "</code>\nSumma: <b>" . formatSum($text) . " so'm</b>\n\n❗️ To'lov qilgach, chek rasmini yuboring.",
                    'parse_mode' => 'HTML'
                ]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Minimal to'lov 1000 so'm. Qayta kiriting:"]);
            }
        }
        elseif ($user['step'] == 'wait_receipt' && isset($msg->photo)) {
            $fileId = end($msg->photo)->file_id;
            bot('sendPhoto', [
                'chat_id' => $config['admin_id'],
                'photo' => $fileId,
                'caption' => "💰 <b>Yangi To'lov!</b>\n\n👤 User: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n💵 Summa: <b>" . formatSum($user['temp_data']) . " so'm</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['inline_keyboard' => [[
                    ['text' => "✅ Tasdiqlash", 'callback_data' => "pay_ok_{$chat_id}_{$user['temp_data']}"],
                    ['text' => "❌ Rad etish", 'callback_data' => "pay_no_{$chat_id}"]
                ]]])
            ]);
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Chek qabul qilindi. Admin tekshirib hisobingizni to'ldiradi."]);
        }
        elseif ($user['step'] == 'wait_game_id') {
            $product = $db->query("SELECT * FROM products WHERE id = " . (int)$user['temp_data'])->fetch();
            if ($product && $user['balance'] >= $product['price']) {
                $db->prepare("UPDATE users SET balance = balance - ?, step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$product['price'], $chat_id]);
                $db->prepare("INSERT INTO orders (user_id, game, item, price, player_id, type) VALUES (?, ?, ?, ?, ?, 'purchase')")
                   ->execute([$chat_id, $product['category'], $product['name'], $product['price'], $text]);
                $orderId = $db->lastInsertId();
                
                bot('sendMessage', [
                    'chat_id' => $config['admin_id'],
                    'text' => "📦 <b>Yangi Buyurtma #$orderId</b>\n\n👤 User: $name ($chat_id)\n🎮 O'yin: {$product['category']}\n💎 Paket: {$product['name']}\n🆔 Player ID: <code>$text</code>",
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode(['inline_keyboard' => [[
                        ['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$orderId"], 
                        ['text' => "🔙 Refund", 'callback_data' => "ord_ref_$orderId"]
                    ]]])
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtma qabul qilindi (#$orderId)."]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Xatolik yoki balans yetarli emas."]);
                $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            }
        }
        // Admin: Paket qo'shish steplari
        elseif ($user['step'] == 'adm_add_cat') {
            $db->prepare("UPDATE users SET step = 'adm_add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✏️ Paket nomini kiriting (Masalan: 60 UC):"]);
        }
        elseif ($user['step'] == 'adm_add_name') {
            $db->prepare("UPDATE users SET step = 'adm_add_price', temp_data = ? WHERE chat_id = ?")->execute([$user['temp_data'] . "|" . $text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Narxni kiriting (Faqat raqam):"]);
        }
        elseif ($user['step'] == 'adm_add_price' && is_numeric($text)) {
            $ex = explode("|", $user['temp_data']);
            $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$ex[0], $ex[1], (int)$text]);
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Paket qo'shildi!"]);
        }
        elseif ($user['step'] == 'adm_mail_all' && $chat_id == $config['admin_id']) {
            $all = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($all as $uid) { bot('sendMessage', ['chat_id' => $uid, 'text' => $text]); }
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Mailing tugatildi."]);
        }

        // Tugma bosilganda
        if ($text == "🛍 Xizmatlar") {
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            if (!$cats) {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Hozircha xizmatlar mavjud emas."]);
            } else {
                $btn = []; $row = [];
                foreach ($cats as $c) {
                    $row[] = ['text' => strtoupper($c), 'callback_data' => "cat_" . $c];
                    if (count($row) == 2) { $btn[] = $row; $row = []; }
                }
                if ($row) $btn[] = $row;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎮 Kerakli bo'limni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
        }
        elseif ($text == "👤 Kabinet") {
            $totalIn = $db->query("SELECT SUM(amount) FROM orders WHERE user_id = $chat_id AND status = 'completed' AND type = 'deposit'")->fetchColumn() ?: 0;
            $msgText = "👤 <b>Shaxsiy Kabinet</b>\n\n🆔 ID: <code>$chat_id</code>\n👤 Ism: " . esc($name) . "\n💵 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm";
            $key = json_encode(['inline_keyboard' => [[['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]], [['text' => "🎁 Promo-kod", 'callback_data' => "use_promo"]]]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => $msgText, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }
        elseif ($text == "📞 Yordam") {
            $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📝 Savol yoki taklifingizni yozib qoldiring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
    } 

    elseif (isset($update->callback_query)) {
        $cb = $update->callback_query;
        $chat_id = $cb->message->chat->id;
        $mid = $cb->message->message_id;
        $data = $cb->data;

        $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();
        bot('answerCallbackQuery', ['callback_query_id' => $cb->id]);

        if ($data == "back_home") {
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            $btn = []; $row = [];
            foreach ($cats as $c) {
                $row[] = ['text' => strtoupper($c), 'callback_data' => "cat_" . $c];
                if (count($row) == 2) { $btn[] = $row; $row = []; }
            }
            if ($row) $btn[] = $row;
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "🎮 Kerakli bo'limni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif (strpos($data, "cat_") === 0) {
            $cat = str_replace("cat_", "", $data);
            $prods = $db->prepare("SELECT * FROM products WHERE category = ?");
            $prods->execute([$cat]);
            $btn = [];
            foreach ($prods->fetchAll() as $p) {
                $btn[] = [['text' => $p['name'] . " - " . formatSum($p['price']), 'callback_data' => "buy_" . $p['id']]];
            }
            $btn[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_home"]];
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "💎 <b>" . strtoupper($cat) . "</b> paketini tanlang:", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif ($data == "deposit") {
            $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 To'ldirish summasini kiriting (min: 1000):", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        elseif ($data == "use_promo") {
            $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎁 Promo-kodni kiriting:"]);
        }
        elseif (strpos($data, "buy_") === 0) {
            $pid = str_replace("buy_", "", $data);
            $db->prepare("UPDATE users SET step = 'wait_game_id', temp_data = ? WHERE chat_id = ?")->execute([$pid, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🆔 O'yin ID raqamini (Player ID) yuboring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        // Admin amallari
        if ($chat_id == $config['admin_id']) {
            if ($data == "adm_mail") {
                $db->prepare("UPDATE users SET step = 'adm_mail_all' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📣 Mailing xabarini yuboring:"]);
            }
            elseif (strpos($data, "pay_ok_") === 0) {
                list(,,$uid, $amo) = explode("_", $data);
                $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$amo, $uid]);
                $db->prepare("INSERT INTO orders (user_id, type, amount, status) VALUES (?, 'deposit', ?, 'completed')")->execute([$uid, $amo]);
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "✅ Tasdiqlandi. Summa: $amo"]);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "✅ Hisobingiz $amo so'mga to'ldirildi."]);
            }
            elseif (strpos($data, "ord_done_") === 0) {
                $oid = str_replace("ord_done_", "", $data);
                $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
                $ord = $db->query("SELECT * FROM orders WHERE id = $oid")->fetch();
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ #$oid bajarildi."]);
                bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "✅ Buyurtmangiz bajarildi: {$ord['item']}"]);
            }
            elseif (strpos($data, "real_del_") === 0) {
                $pid = str_replace("real_del_", "", $data);
                $db->prepare("DELETE FROM products WHERE id = ?")->execute([$pid]);
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Paket o'chirildi."]);
            }
            elseif ($data == "adm_stat") {
                $u = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
                $o = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed' AND type='purchase'")->fetchColumn();
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📊 Stat:\nUserlar: $u\nSotuvlar: $o", 'parse_mode' => 'HTML']);
            }
            elseif ($data == "adm_add_start") {
                $db->prepare("UPDATE users SET step = 'adm_add_cat' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Kategoriya (masalan: pubg):"]);
            }
            elseif ($data == "adm_del_list") {
                $all = $db->query("SELECT * FROM products")->fetchAll();
                $btn = []; foreach ($all as $p) { $btn[] = [['text' => "🗑 " . $p['category'] . "-" . $p['name'], 'callback_data' => "real_del_" . $p['id']]]; }
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'chirish:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
        }
    }
} catch (Exception $e) {
    error_log("Bot error: " . $e->getMessage());
}
?>
