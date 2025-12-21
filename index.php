<?php
// SMM Professional Bot v5.0 - Cabinet & Bonus Fixed
// Muallif: Sizning talabingiz asosida yangilandi

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'bot_smm_errors.log');

// --- SOZLAMALAR ---
$config = [
    'bot_token' => getenv('BOT_TOKEN') ?: 'YOUR_BOT_TOKEN_HERE', // Tokeningiz
    'admin_id'  => (int)(getenv('ADMIN_ID') ?: 123456789),       // Admin ID
    'db_file'   => 'smmbot.db',
    'card_num'  => '5614 6868 1732 2558' // Karta raqam
];

// Token tekshiruv
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

// --- JADVALLAR VA YANGILANISHLAR ---
// Users jadvaliga 'last_bonus' ustunini qo'shamiz (Eski bazalar uchun yangilash)
$tables = [
    "users" => "chat_id INTEGER PRIMARY KEY, name TEXT, balance INTEGER DEFAULT 0, step TEXT DEFAULT 'none', temp_data TEXT DEFAULT '', last_bonus TEXT DEFAULT NULL",
    "orders" => "id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER, type TEXT, platform TEXT, service TEXT, price INTEGER, link TEXT, status TEXT DEFAULT 'pending', created_at DATETIME DEFAULT CURRENT_TIMESTAMP",
    "products" => "id INTEGER PRIMARY KEY AUTOINCREMENT, category TEXT, name TEXT, price INTEGER",
    "promos" => "code TEXT PRIMARY KEY, amount INTEGER, status TEXT DEFAULT 'active'"
];

foreach ($tables as $name => $schema) {
    $db->exec("CREATE TABLE IF NOT EXISTS $name ($schema)");
}

// Agar eski baza bo'lsa va last_bonus ustuni bo'lmasa, uni qo'shamiz (Migratsiya)
try {
    $db->exec("ALTER TABLE users ADD COLUMN last_bonus TEXT DEFAULT NULL");
} catch (Exception $e) {
    // Ustun allaqachon mavjud bo'lsa xatolik beradi, buni ignor qilamiz
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
    $text = "";

    // 1. Oddiy xabar
    if (isset($update->message)) {
        $msg = $update->message;
        $chat_id = $msg->chat->id;
        $text = $msg->text ?? '';
        $name = $msg->from->first_name ?? 'User';

        // Foydalanuvchini yaratish
        $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)")->execute([$chat_id, $name]);
        $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

        // Admin reply (javob berish)
        if ($chat_id == $config['admin_id'] && isset($msg->reply_to_message)) {
            $replyTxt = $msg->reply_to_message->text ?? $msg->reply_to_message->caption ?? '';
            if (preg_match('/🆔 ID: (\d+)/', $replyTxt, $matches)) {
                bot('sendMessage', [
                    'chat_id' => $matches[1],
                    'text' => "👨‍💻 <b>Admindan javob:</b>\n\n" . esc($text),
                    'parse_mode' => 'HTML'
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Javob yuborildi."]);
                exit;
            }
        }

        // Bosh menyu
        if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            $key = json_encode([
                'keyboard' => [
                    [['text' => "🚀 Xizmatlar"], ['text' => "👤 Kabinet"]],
                    [['text' => "📞 Yordam"], ['text' => "📚 Qo'llanma"]]
                ],
                'resize_keyboard' => true
            ]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "👋 <b>Assalomu alaykum!</b>\nSMM xizmatlari botiga xush kelibsiz.", 'reply_markup' => $key, 'parse_mode' => 'HTML']);
            exit;
        }

        // Steplar (Statuslar)
        if ($user['step'] == 'wait_sum') {
            if (is_numeric($text) && $text >= 1000) {
                $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "💳 <b>Hisobni to'ldirish</b>\n\nKarta: <code>" . $config['card_num'] . "</code>\nSumma: <b>" . formatSum($text) . " so'm</b>\n\n❗️ To'lov chekini (skrinshot) yuboring.",
                    'parse_mode' => 'HTML'
                ]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Minimal summa 1000 so'm. Qaytadan kiriting:"]);
            }
        }
        elseif ($user['step'] == 'wait_receipt' && isset($msg->photo)) {
            $fileId = end($msg->photo)->file_id;
            bot('sendPhoto', [
                'chat_id' => $config['admin_id'],
                'photo' => $fileId,
                'caption' => "💰 <b>To'lov Tekshiruvi</b>\n\n👤: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n💵: <b>" . formatSum($user['temp_data']) . " so'm</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['inline_keyboard' => [[
                    ['text' => "✅ Tasdiqlash", 'callback_data' => "pay_ok_{$chat_id}_{$user['temp_data']}"],
                    ['text' => "❌ Rad etish", 'callback_data' => "pay_no_{$chat_id}"]
                ]]])
            ]);
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Chek yuborildi. Admin tekshirib tasdiqlaydi."]);
        }
        elseif ($user['step'] == 'wait_link') {
            $product = $db->query("SELECT * FROM products WHERE id = " . (int)$user['temp_data'])->fetch();
            if ($product && $user['balance'] >= $product['price']) {
                // Pulni yechib olish
                $db->prepare("UPDATE users SET balance = balance - ?, step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$product['price'], $chat_id]);
                
                // Buyurtma yaratish
                $db->prepare("INSERT INTO orders (user_id, platform, service, price, link, type) VALUES (?, ?, ?, ?, ?, 'purchase')")
                   ->execute([$chat_id, $product['category'], $product['name'], $product['price'], $text]);
                $orderId = $db->lastInsertId();
                
                // Adminga yuborish
                bot('sendMessage', [
                    'chat_id' => $config['admin_id'],
                    'text' => "📦 <b>Yangi Buyurtma #$orderId</b>\n\n👤: $name ($chat_id)\n📱: {$product['category']}\n💎: {$product['name']}\n🔗: " . esc($text) . "\n💰: " . formatSum($product['price']) . " so'm",
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                    'reply_markup' => json_encode(['inline_keyboard' => [[
                        ['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$orderId"], 
                        ['text' => "🔙 Pulni qaytarish", 'callback_data' => "ord_ref_$orderId"]
                    ]]])
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtma qabul qilindi (#$orderId). Admin tez orada bajaradi."]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Mablag' yetarli emas."]);
                $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            }
        }
        // Promo kod
        elseif ($user['step'] == 'wait_promo') {
            $stmt = $db->prepare("SELECT * FROM promos WHERE code = ? AND status = 'active'");
            $stmt->execute([$text]);
            $promo = $stmt->fetch();
            if ($promo) {
                $db->prepare("UPDATE users SET balance = balance + ?, step = 'none' WHERE chat_id = ?")->execute([$promo['amount'], $chat_id]);
                $db->prepare("UPDATE promos SET status = 'used' WHERE code = ?")->execute([$text]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Promo-kod aktivlashdi! Balansga " . formatSum($promo['amount']) . " so'm qo'shildi."]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Kod xato yoki eskirgan."]);
            }
        }
        elseif ($user['step'] == 'wait_help') {
             bot('sendMessage', [
                'chat_id' => $config['admin_id'],
                'text' => "📨 <b>Murojaat:</b>\n👤: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n\n📄: " . esc($text),
                'parse_mode' => 'HTML'
            ]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabar adminga yuborildi."]);
        }

        // Admin funksiyalari (Xizmat qo'shish)
        elseif ($user['step'] == 'adm_add_cat' && $chat_id == $config['admin_id']) {
            $db->prepare("UPDATE users SET step = 'adm_add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✏️ Xizmat nomi (Masalan: 1000 Obunachi):"]);
        }
        elseif ($user['step'] == 'adm_add_name' && $chat_id == $config['admin_id']) {
            $db->prepare("UPDATE users SET step = 'adm_add_price', temp_data = ? WHERE chat_id = ?")->execute([$user['temp_data'] . "|" . $text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Narxi (faqat raqam):"]);
        }
        elseif ($user['step'] == 'adm_add_price' && $chat_id == $config['admin_id']) {
            if(is_numeric($text)){
                $ex = explode("|", $user['temp_data']);
                $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$ex[0], $ex[1], (int)$text]);
                $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xizmat qo'shildi!"]);
            }
        }
        elseif ($user['step'] == 'adm_mail_all' && $chat_id == $config['admin_id']) {
            $users = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
            $cnt = 0;
            foreach ($users as $uid) {
                bot('sendMessage', ['chat_id' => $uid, 'text' => $text]);
                $cnt++;
            }
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ $cnt kishiga yuborildi."]);
        }

        // TUGMALAR
        if ($text == "👤 Kabinet") {
            // Kabinetni yangilash
            $totalIn = $db->query("SELECT SUM(amount) FROM orders WHERE user_id = $chat_id AND status = 'completed' AND type = 'deposit'")->fetchColumn() ?: 0;
            
            $msgText = "👤 <b>Shaxsiy Kabinet</b>\n\n🆔 ID: <code>$chat_id</code>\n👤 Ism: " . esc($name) . "\n💵 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm";
            
            $key = json_encode(['inline_keyboard' => [
                [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
                [['text' => "🎁 Kunlik Bonus (10 so'm)", 'callback_data' => "daily_bonus"]], // YANGI BONUS TUGMASI
                [['text' => "🎫 Promo-kod", 'callback_data' => "use_promo"]]
            ]]);
            
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => $msgText, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }
        elseif ($text == "🚀 Xizmatlar") {
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            if (!$cats) {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Hozircha xizmatlar yo'q."]);
            } else {
                $btn = []; $row = [];
                foreach ($cats as $c) {
                    $emoji = "📱";
                    if(stripos($c, 'insta') !== false) $emoji = "📸";
                    if(stripos($c, 'tele') !== false) $emoji = "✈️";
                    if(stripos($c, 'tik') !== false) $emoji = "🎵";
                    $row[] = ['text' => "$emoji " . ucfirst($c), 'callback_data' => "cat_" . $c];
                    if (count($row) == 2) { $btn[] = $row; $row = []; }
                }
                if ($row) $btn[] = $row;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🔻 Kerakli tarmoqni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
        }
        elseif ($text == "📞 Yordam") {
            $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📝 Savol yoki taklifingizni yozib qoldiring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        elseif ($text == "/panel" && $chat_id == $config['admin_id']) {
            $key = json_encode(['inline_keyboard' => [
                [['text' => "➕ Xizmat qo'shish", 'callback_data' => "adm_add_start"]],
                [['text' => "🗑 Xizmatni o'chirish", 'callback_data' => "adm_del_list"]],
                [['text' => "📣 Xabar tarqatish", 'callback_data' => "adm_mail"], ['text' => "📊 Statistika", 'callback_data' => "adm_stat"]]
            ]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "⚙️ <b>Admin Panel</b>", 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }
    }

    // 2. Callback (Tugma bosilganda)
    elseif (isset($update->callback_query)) {
        $cb = $update->callback_query;
        $chat_id = $cb->message->chat->id;
        $mid = $cb->message->message_id;
        $data = $cb->data;

        // User ma'lumotini yangilaymiz
        $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

        if ($data == "deposit") {
            $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
            bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 To'ldiriladigan summani yozing (min: 1000):", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        elseif ($data == "use_promo") {
            $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
            bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎁 Promo-kodni kiriting:"]);
        }
        // --- KUNLIK BONUS LOGIKASI ---
        elseif ($data == "daily_bonus") {
            $today = date('Y-m-d');
            if ($user['last_bonus'] == $today) {
                bot('answerCallbackQuery', [
                    'callback_query_id' => $cb->id,
                    'text' => "⚠️ Siz bugun bonus oldingiz! Ertaga qaytib keling.",
                    'show_alert' => true
                ]);
            } else {
                $bonus = 10;
                $db->prepare("UPDATE users SET balance = balance + ?, last_bonus = ? WHERE chat_id = ?")->execute([$bonus, $today, $chat_id]);
                bot('answerCallbackQuery', [
                    'callback_query_id' => $cb->id,
                    'text' => "✅ $bonus so'm bonus berildi!",
                    'show_alert' => true
                ]);
                
                // Kabinetni yangilash
                $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch(); // Yangi balansni olish
                $totalIn = $db->query("SELECT SUM(amount) FROM orders WHERE user_id = $chat_id AND status = 'completed' AND type = 'deposit'")->fetchColumn() ?: 0;
                $msgText = "👤 <b>Shaxsiy Kabinet</b>\n\n🆔 ID: <code>$chat_id</code>\n👤 Ism: " . esc($user['name']) . "\n💵 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm";
                $key = json_encode(['inline_keyboard' => [
                    [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
                    [['text' => "🎁 Kunlik Bonus (10 so'm)", 'callback_data' => "daily_bonus"]],
                    [['text' => "🎫 Promo-kod", 'callback_data' => "use_promo"]]
                ]]);
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => $msgText, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
            }
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
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "📱 <b>" . ucfirst($cat) . "</b> xizmatlari:", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif ($data == "back_home") {
            // Xizmatlar ro'yxatiga qaytish
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            $btn = []; $row = [];
            foreach ($cats as $c) {
                $emoji = "📱";
                if(stripos($c, 'insta') !== false) $emoji = "📸";
                if(stripos($c, 'tele') !== false) $emoji = "✈️";
                $row[] = ['text' => "$emoji " . ucfirst($c), 'callback_data' => "cat_" . $c];
                if (count($row) == 2) { $btn[] = $row; $row = []; }
            }
            if ($row) $btn[] = $row;
            bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "🔻 Kerakli tarmoqni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
        }
        elseif (strpos($data, "buy_") === 0) {
            $pid = str_replace("buy_", "", $data);
            $db->prepare("UPDATE users SET step = 'wait_link', temp_data = ? WHERE chat_id = ?")->execute([$pid, $chat_id]);
            bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🔗 <b>Havola (Link) yuboring:</b>\n\nMasalan:\n- <code>https://instagram.com/user</code>\n- <code>https://t.me/kanal</code>", 'parse_mode' => 'HTML', 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
        
        // --- ADMIN CALLBACKLAR ---
        if ($chat_id == $config['admin_id']) {
            if (strpos($data, "pay_ok_") === 0) {
                list(,,$uid, $amo) = explode("_", $data);
                $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$amo, $uid]);
                $db->prepare("INSERT INTO orders (user_id, type, amount, status) VALUES (?, 'deposit', ?, 'completed')")->execute([$uid, $amo]);
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "✅ Qabul qilindi. Balans to'ldirildi: $amo so'm"]);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "✅ To'lovingiz tasdiqlandi. Balansingizga $amo so'm qo'shildi."]);
            }
            elseif (strpos($data, "pay_no_") === 0) {
                $uid = str_replace("pay_no_", "", $data);
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "❌ Rad etildi."]);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "❌ To'lov cheki qabul qilinmadi."]);
            }
            // BUYURTMA BAJARILDI
            elseif (strpos($data, "ord_done_") === 0) {
                $oid = str_replace("ord_done_", "", $data);
                $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
                $ord = $db->query("SELECT * FROM orders WHERE id = $oid")->fetch();
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Buyurtma #$oid BAJARILDI deb belgilandi."]);
                bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "✅ <b>Buyurtmangiz bajarildi!</b>\n\n#$oid - {$ord['service']}\n\nXizmatimizdan foydalanganingiz uchun rahmat!", 'parse_mode' => 'HTML']);
            }
            // BUYURTMA BEKOR QILINIB, PUL QAYTARILDI
            elseif (strpos($data, "ord_ref_") === 0) {
                $oid = str_replace("ord_ref_", "", $data);
                $ord = $db->query("SELECT * FROM orders WHERE id = $oid")->fetch();
                
                // Agar avval pul qaytarilmagan bo'lsa
                if ($ord['status'] != 'refunded') {
                    $db->prepare("UPDATE orders SET status = 'refunded' WHERE id = ?")->execute([$oid]);
                    $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$ord['price'], $ord['user_id']]);
                    
                    bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "🔙 Buyurtma #$oid bekor qilindi va <b>" . formatSum($ord['price']) . " so'm</b> qaytarildi.", 'parse_mode' => 'HTML']);
                    bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "⚠️ <b>Buyurtma bekor qilindi</b>\n\nBuyurtmangiz (#$oid) bajarilmadi va hisobingizga <b>" . formatSum($ord['price']) . " so'm</b> qaytarildi.", 'parse_mode' => 'HTML']);
                } else {
                    bot('answerCallbackQuery', ['callback_query_id' => $cb->id, 'text' => "Bu buyurtma allaqachon bekor qilingan!", 'show_alert' => true]);
                }
            }
            elseif ($data == "adm_add_start") {
                $db->prepare("UPDATE users SET step = 'adm_add_cat' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Kategoriya (platforma) nomini yozing:"]);
            }
            elseif ($data == "adm_del_list") {
                $all = $db->query("SELECT * FROM products")->fetchAll();
                if(!$all) bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Xizmatlar yo'q."]);
                else {
                    $btn = []; foreach($all as $p){ $btn[] = [['text' => "🗑 " . $p['name'], 'callback_data' => "real_del_" . $p['id']]]; }
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'chirish uchun tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
                }
            }
            elseif (strpos($data, "real_del_") === 0) {
                $pid = str_replace("real_del_", "", $data);
                $db->prepare("DELETE FROM products WHERE id = ?")->execute([$pid]);
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ O'chirildi."]);
            }
            elseif ($data == "adm_stat") {
                $u = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
                $o = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed' AND type='purchase'")->fetchColumn();
                $m = $db->query("SELECT SUM(amount) FROM orders WHERE status='completed' AND type='deposit'")->fetchColumn() ?: 0;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📊 <b>Statistika:</b>\n\n👤 Userlar: $u\n🛒 Sotuvlar: $o\n💰 Tushum: " . formatSum($m) . " so'm", 'parse_mode' => 'HTML']);
            }
            elseif ($data == "adm_mail") {
                $db->prepare("UPDATE users SET step = 'adm_mail_all' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📣 Xabar matnini yuboring:"]);
            }
        }
    }

} catch (Exception $e) {
    error_log("Bot xatosi: " . $e->getMessage());
}
?>
