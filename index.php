<?php
// SMM Pro Bot v4.0 - Admin orqali boshqariladigan SMM do'koni
// Muallif: SealSeen asosida optimallashtirildi

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'bot_errors.log');

// --- SOZLAMALAR ---
$config = [
    'bot_token' => '8325934929:AAHeKcqYVZZmb2DZ-wTEzcyup0ewOVHJMi8', // Bot tokenini shu yerga yozing
    'admin_id'  => 8125289524,             // Admin Telegram ID raqami
    'db_file'   => 'smm_store.db',        // Baza fayli nomi
    'card_num'  => '5614 6868 1732 2558', // Karta raqamingiz
    'card_name' => 'Sayfullayev Sherali'         // Karta egasi
];

if ($config['bot_token'] == 'YOUR_BOT_TOKEN_HERE') die("⚠️ Bot tokeni kiritilmagan! Kodni tahrirlang.");

// --- DB ULANISH ---
try {
    $db = new PDO('sqlite:' . $config['db_file']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec('PRAGMA journal_mode = WAL;'); 
} catch (PDOException $e) {
    die("DB Xatosi: " . $e->getMessage());
}

// --- JADVALLAR (SMM uchun moslashtirildi) ---
$tables = [
    "users" => "chat_id INTEGER PRIMARY KEY, name TEXT, balance INTEGER DEFAULT 0, step TEXT DEFAULT 'none', temp_data TEXT DEFAULT ''",
    "orders" => "id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER, platform TEXT, service TEXT, price INTEGER, target_link TEXT, status TEXT DEFAULT 'pending', created_at DATETIME DEFAULT CURRENT_TIMESTAMP",
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

    // Xabar kelganda
    if (isset($update->message)) {
        $msg = $update->message;
        $chat_id = $msg->chat->id;
        $text = $msg->text ?? '';
        $name = $msg->from->first_name ?? 'Foydalanuvchi';

        // Userni bazaga qo'shish
        $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)")->execute([$chat_id, $name]);
        $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

        // Admin javob berish (Reply orqali)
        if ($chat_id == $config['admin_id'] && isset($msg->reply_to_message)) {
            $replyTxt = $msg->reply_to_message->text ?? $msg->reply_to_message->caption ?? '';
            if (preg_match('/🆔 ID: (\d+)/', $replyTxt, $matches)) {
                bot('sendMessage', [
                    'chat_id' => $matches[1],
                    'text' => "📩 <b>Qo'llab-quvvatlash bo'limidan javob:</b>\n\n" . esc($text),
                    'parse_mode' => 'HTML'
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Javob foydalanuvchiga yuborildi."]);
                exit;
            }
        }

        // Asosiy buyruqlar
        if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            $key = json_encode([
                'keyboard' => [
                    [['text' => "🚀 Xizmatlar"], ['text' => "👤 Kabinet"]],
                    [['text' => "📞 Yordam"], ['text' => "📜 Buyurtmalarim"]]
                ],
                'resize_keyboard' => true
            ]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "👋 Assalomu alaykum <b>$name</b>!\n\nSMM xizmatlari botiga xush kelibsiz. Quyidagi menyudan kerakli bo'limni tanlang.", 'reply_markup' => $key, 'parse_mode' => 'HTML']);
            exit;
        }

        // Admin Panel Buyruqlari
        if ($text == "/panel" && $chat_id == $config['admin_id']) {
            $key = json_encode(['inline_keyboard' => [
                [['text' => "➕ Xizmat qo'shish", 'callback_data' => "adm_add_start"]],
                [['text' => "🗑 Xizmatni o'chirish", 'callback_data' => "adm_del_list"]],
                [['text' => "📣 Xabar yuborish", 'callback_data' => "adm_mail"], ['text' => "📊 Statistika", 'callback_data' => "adm_stat"]]
            ]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "⚙️ <b>Admin Panel</b>\n\nBu yerdan botni boshqarishingiz mumkin.", 'parse_mode' => 'HTML', 'reply_markup' => $key]);
            exit;
        }

        // STEPLAR (QADAMLAR)
        if ($user['step'] == 'wait_help') {
            bot('sendMessage', [
                'chat_id' => $config['admin_id'],
                'text' => "📨 <b>Yangi Murojaat!</b>\n👤 Kimdan: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n\n📄 Xabar: " . esc($text),
                'parse_mode' => 'HTML'
            ]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabaringiz adminga yuborildi. Tez orada javob olasiz.", 'reply_markup' => json_encode(['keyboard' => [[['text' => "🏠 Bosh menyu"]]], 'resize_keyboard' => true])]);
        } 
        elseif ($user['step'] == 'wait_promo') {
            $stmt = $db->prepare("SELECT * FROM promos WHERE code = ? AND status = 'active'");
            $stmt->execute([$text]);
            $promo = $stmt->fetch();
            if ($promo) {
                $db->prepare("UPDATE users SET balance = balance + ?, step = 'none' WHERE chat_id = ?")->execute([$promo['amount'], $chat_id]);
                $db->prepare("UPDATE promos SET status = 'used' WHERE code = ?")->execute([$text]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Tabriklaymiz! Hisobingizga <b>" . formatSum($promo['amount']) . " so'm</b> qo'shildi.", 'parse_mode' => 'HTML']);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Kod xato yoki avval ishlatilgan."]);
            }
        }
        elseif ($user['step'] == 'wait_sum') {
            if (is_numeric($text) && $text >= 1000) {
                $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "💳 <b>To'lov tizimi</b>\n\nKarta: <code>" . $config['card_num'] . "</code>\nEga: <b>" . $config['card_name'] . "</b>\nSumma: <b>" . formatSum($text) . " so'm</b>\n\n❗️ To'lov qilgach, chek rasmini yuboring.",
                    'parse_mode' => 'HTML'
                ]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Minimal to'lov 1000 so'm. Iltimos, to'g'ri summa kiriting:"]);
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
        elseif ($user['step'] == 'wait_link') {
            // SMM uchun Linkni qabul qilish
            $product = $db->query("SELECT * FROM products WHERE id = " . (int)$user['temp_data'])->fetch();
            
            if ($product && $user['balance'] >= $product['price']) {
                $db->prepare("UPDATE users SET balance = balance - ?, step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$product['price'], $chat_id]);
                
                // Buyurtmani saqlash
                $db->prepare("INSERT INTO orders (user_id, platform, service, price, target_link, status) VALUES (?, ?, ?, ?, ?, 'pending')")
                   ->execute([$chat_id, $product['category'], $product['name'], $product['price'], $text]);
                $orderId = $db->lastInsertId();
                
                // Adminga xabar
                bot('sendMessage', [
                    'chat_id' => $config['admin_id'],
                    'text' => "📦 <b>Yangi SMM Buyurtma #$orderId</b>\n\n👤 User: $name ($chat_id)\n📱 Platforma: <b>{$product['category']}</b>\n💎 Xizmat: <b>{$product['name']}</b>\n🔗 <b>Link:</b> $text\n💰 Narx: " . formatSum($product['price']) . " so'm",
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                    'reply_markup' => json_encode(['inline_keyboard' => [[
                        ['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$orderId"], 
                        ['text' => "🔙 Bekor qilish (Refund)", 'callback_data' => "ord_ref_$orderId"]
                    ]]])
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtmangiz qabul qilindi (#$orderId).\n\nHolat: ⏳ Kutilmoqda\nAdmin tasdiqlashi bilan bajariladi."]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Balansingizda mablag' yetarli emas. Iltimos, hisobni to'ldiring."]);
                $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            }
        }
        // Admin: Paket qo'shish steplari
        elseif ($user['step'] == 'adm_add_cat') {
            $db->prepare("UPDATE users SET step = 'adm_add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✏️ Xizmat nomini kiriting (Masalan: 1000 ta Obunachi):"]);
        }
        elseif ($user['step'] == 'adm_add_name') {
            $db->prepare("UPDATE users SET step = 'adm_add_price', temp_data = ? WHERE chat_id = ?")->execute([$user['temp_data'] . "|" . $text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Narxni kiriting (Faqat raqam, so'mda):"]);
        }
        elseif ($user['step'] == 'adm_add_price' && is_numeric($text)) {
            $ex = explode("|", $user['temp_data']); // [Kategoriya, Nom]
            $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$ex[0], $ex[1], (int)$text]);
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xizmat muvaffaqiyatli qo'shildi!"]);
        }
        elseif ($user['step'] == 'adm_mail_all' && $chat_id == $config['admin_id']) {
            $all = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
            $count = 0;
            foreach ($all as $uid) { 
                bot('sendMessage', ['chat_id' => $uid, 'text' => $text]); 
                $count++;
            }
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabar $count ta foydalanuvchiga yuborildi."]);
        }

        // TUGMALAR BOSILGANDA (TEXT)
        if ($text == "🚀 Xizmatlar") {
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            if (!$cats) {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Hozircha xizmatlar mavjud emas. Tez orada qo'shiladi."]);
            } else {
                $btn = []; $row = [];
                foreach ($cats as $c) {
                    $row[] = ['text' => strtoupper($c), 'callback_data' => "cat_" . $c];
                    if (count($row) == 2) { $btn[] = $row; $row = []; }
                }
                if ($row) $btn[] = $row;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📱 Kerakli ijtimoiy tarmoqni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
        }
        elseif ($text == "👤 Kabinet") {
            $totalIn = $db->query("SELECT SUM(price) FROM orders WHERE user_id = $chat_id AND status = 'completed' AND target_link IS NOT NULL")->fetchColumn() ?: 0;
            $msgText = "👤 <b>Shaxsiy Kabinet</b>\n\n🆔 ID: <code>$chat_id</code>\n👤 Ism: " . esc($name) . "\n💵 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n📉 Jami sarflangan: " . formatSum($totalIn) . " so'm";
            $key = json_encode(['inline_keyboard' => [[['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]], [['text' => "🎁 Promo-kod ishlatish", 'callback_data' => "use_promo"]]]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => $msgText, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }
        elseif ($text == "📜 Buyurtmalarim") {
            $orders = $db->query("SELECT * FROM orders WHERE user_id = $chat_id AND target_link IS NOT NULL ORDER BY id DESC LIMIT 10")->fetchAll();
            if (!$orders) {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📭 Sizda hali buyurtmalar yo'q."]);
            } else {
                $txt = "📜 <b>Oxirgi 10 ta buyurtmangiz:</b>\n\n";
                foreach ($orders as $ord) {
                    $statusIcon = ($ord['status'] == 'completed') ? '✅' : (($ord['status'] == 'refunded') ? '🔙' : '⏳');
                    $txt .= "#{$ord['id']} | {$ord['platform']} - {$ord['service']} | $statusIcon\n";
                }
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => $txt, 'parse_mode' => 'HTML']);
            }
        }
        elseif ($text == "📞 Yordam") {
            $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📝 Savol yoki taklifingizni yozib qoldiring (Admin javob beradi):", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
    } 

    // CALLBACK QUERY (Tugma bosilganda)
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
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "📱 Kerakli ijtimoiy tarmoqni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif (strpos($data, "cat_") === 0) {
            $cat = str_replace("cat_", "", $data);
            $prods = $db->prepare("SELECT * FROM products WHERE category = ?");
            $prods->execute([$cat]);
            $btn = [];
            foreach ($prods->fetchAll() as $p) {
                $btn[] = [['text' => $p['name'] . " - " . formatSum($p['price']) . " so'm", 'callback_data' => "buy_" . $p['id']]];
            }
            $btn[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_home"]];
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "💎 <b>" . strtoupper($cat) . "</b> xizmatlaridan birini tanlang:", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif ($data == "deposit") {
            $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 Hisobni to'ldirish summasini yozing (min: 1000 so'm):", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        elseif ($data == "use_promo") {
            $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎁 Promo-kodni yuboring:"]);
        }
        elseif (strpos($data, "buy_") === 0) {
            $pid = str_replace("buy_", "", $data);
            $db->prepare("UPDATE users SET step = 'wait_link', temp_data = ? WHERE chat_id = ?")->execute([$pid, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🔗 Xizmat ko'rsatilishi kerak bo'lgan <b>Havola (Link)</b> yoki <b>Username</b> ni yuboring:", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
// Admin panel menyusiga tugma qo'shish uchun:
// [['text' => "🎁 Promo yaratish", 'callback_data' => "adm_promo_start"]]

if ($data == "adm_promo_start") {
    $db->prepare("UPDATE users SET step = 'adm_promo_code' WHERE chat_id = ?")->execute([$chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✍️ Yangi promo-kod nomini yozing (Masalan: BONUS2025):"]);
}

// Steplar (Message qismi) ichiga quyidagilarni qo'shing:
elseif ($user['step'] == 'adm_promo_code') {
    $db->prepare("UPDATE users SET step = 'adm_promo_amount', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Ushbu kod qiymatini kiriting (Masalan: 5000):"]);
}
elseif ($user['step'] == 'adm_promo_amount' && is_numeric($text)) {
    $code = $user['temp_data'];
    $db->prepare("INSERT INTO promos (code, amount, status) VALUES (?, ?, 'active')")->execute([$code, (int)$text]);
    $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Promo-kod yaratildi: <b>$code</b>\nQiymati: $text so'm", 'parse_mode' => 'HTML']);
}

        // Admin Callback Amallari
        if ($chat_id == $config['admin_id']) {
            if ($data == "adm_mail") {
                $db->prepare("UPDATE users SET step = 'adm_mail_all' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📣 Barcha foydalanuvchilarga yuboriladigan xabar matnini kiriting (Rasm yoki tekst):"]);
            }
            // To'lovni tasdiqlash
            elseif (strpos($data, "pay_ok_") === 0) {
                list(,,$uid, $amo) = explode("_", $data);
                $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$amo, $uid]);
                // To'lov tarixiga yozish (optional)
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "✅ Tasdiqlandi. Summa: " . formatSum($amo)]);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "✅ Hisobingiz " . formatSum($amo) . " so'mga to'ldirildi."]);
            }
            elseif (strpos($data, "pay_no_") === 0) {
                $uid = str_replace("pay_no_", "", $data);
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "❌ Rad etildi."]);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "❌ To'lov chekingiz rad etildi. Qayta urinib ko'ring yoki adminga yozing."]);
            }
            // Buyurtmani bajarish
            elseif (strpos($data, "ord_done_") === 0) {
                $oid = str_replace("ord_done_", "", $data);
                $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
                $ord = $db->query("SELECT * FROM orders WHERE id = $oid")->fetch();
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Buyurtma #$oid bajarildi.", 'parse_mode' => 'HTML']);
                bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "✅ <b>Buyurtmangiz bajarildi!</b>\n\n🆔 #$oid\n📱 {$ord['platform']} - {$ord['service']}\n\nXizmatlarimizdan foydalanganingiz uchun rahmat!", 'parse_mode' => 'HTML']);
            }
            // Refund (Pulni qaytarish)
            elseif (strpos($data, "ord_ref_") === 0) {
                $oid = str_replace("ord_ref_", "", $data);
                $ord = $db->query("SELECT * FROM orders WHERE id = $oid")->fetch();
                if ($ord['status'] != 'refunded') {
                    $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$ord['price'], $ord['user_id']]);
                    $db->prepare("UPDATE orders SET status = 'refunded' WHERE id = ?")->execute([$oid]);
                    bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "🔙 #$oid uchun pul qaytarildi (Refund)."]);
                    bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "⚠️ <b>Buyurtmangiz bekor qilindi.</b>\n\n🆔 #$oid\n💵 Mablag' balansingizga qaytarildi.", 'parse_mode' => 'HTML']);
                }
            }
            // Paketni o'chirish
            elseif (strpos($data, "real_del_") === 0) {
                $pid = str_replace("real_del_", "", $data);
                $db->prepare("DELETE FROM products WHERE id = ?")->execute([$pid]);
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Xizmat bazadan o'chirildi."]);
            }
            elseif ($data == "adm_stat") {
                $u = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
                $o = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed'")->fetchColumn();
                $m = $db->query("SELECT SUM(price) FROM orders WHERE status='completed'")->fetchColumn() ?: 0;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📊 <b>Statistika:</b>\n\n👤 Foydalanuvchilar: $u ta\n✅ Bajarilgan buyurtmalar: $o ta\n💰 Umumiy savdo: " . formatSum($m) . " so'm", 'parse_mode' => 'HTML']);
            }
            elseif ($data == "adm_add_start") {
                $db->prepare("UPDATE users SET step = 'adm_add_cat' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Kategoriya nomini kiriting (Masalan: <b>Instagram</b>, <b>Telegram</b>):", 'parse_mode' => 'HTML']);
            }
            elseif ($data == "adm_del_list") {
                $all = $db->query("SELECT * FROM products")->fetchAll();
                if (!$all) {
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'chirish uchun xizmatlar yo'q."]);
                } else {
                    $btn = []; foreach ($all as $p) { $btn[] = [['text' => "🗑 " . $p['category'] . " - " . $p['name'], 'callback_data' => "real_del_" . $p['id']]]; }
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'chiriladigan xizmatni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
                }
            }
        }
    }
} catch (Exception $e) {
    // Xatolikni logga yozish
    file_put_contents('bot_errors.log', $e->getMessage() . PHP_EOL, FILE_APPEND);
}
?>
