<?php
/**
 * Professional SMM Bot - SQLite Edition
 * Author: Gemini AI Thought Partner
 */

error_reporting(E_ALL);
ini_set('display_errors', 0); // Productionda 0 qiling
date_default_timezone_set("Asia/Tashkent");

// 1. KONFIGURATSIYA
$token = getenv('BOT_TOKEN');
$admin_id = getenv('ADMIN_ID');
$db_file = getenv('DB_NAME') ?: 'bot_database.sqlite';

define('API_KEY', $token);
define('ADMIN', $admin_id);

// 2. MA'LUMOTLAR BAZASI (SQLite) - Professional ulanish
try {
    $db = new PDO("sqlite:$db_file");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Jadvallarni yaratish (Agar mavjud bo'lmasa)
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        user_id INTEGER PRIMARY KEY,
        balance REAL DEFAULT 0,
        step TEXT,
        referals INTEGER DEFAULT 0,
        status TEXT DEFAULT 'active',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS orders (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        service_id INTEGER,
        amount INTEGER,
        price REAL,
        link TEXT,
        status TEXT DEFAULT 'pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    die("Baza bilan xatolik: " . $e->getMessage());
}

// 3. YORDAMCHI FUNKSIYALAR
function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $datas,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 20
    ]);
    $res = curl_exec($ch);
    return json_decode($res);
}

// 4. UPDATE QABUL QILISH
$update = json_decode(file_get_contents('php://input'), true);
if (!$update) exit;

$message = $update['message'] ?? null;
$callback = $update['callback_query'] ?? null;

if ($message) {
    $chat_id = $message['chat']['id'];
    $text = $message['text'] ?? '';
    $from_id = $message['from']['id'];
    $msg_id = $message['message_id'];
} elseif ($callback) {
    $chat_id = $callback['message']['chat']['id'];
    $data = $callback['data'];
    $from_id = $callback['from']['id'];
    $msg_id = $callback['message']['message_id'];
}

// 5. FOYDALANUVCHINI TEKSHIRISH VA RO'YXATGA OLISH
$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$from_id]);
$user = $stmt->fetch();

if (!$user) {
    $stmt = $db->prepare("INSERT INTO users (user_id) VALUES (?)");
    $stmt->execute([$from_id]);
    $user = ['user_id' => $from_id, 'balance' => 0, 'step' => ''];
}

// 6. ASOSIY LOGIKA (MENU)
$main_menu = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => "🛍 Xizmatlar"], ['text' => "💳 Hisobim"]],
        [['text' => "📊 Buyurtmalar"], ['text' => "🆘 Yordam"]],
        ($from_id == ADMIN ? [['text' => "👨‍💻 Admin Panel"]] : [])
    ]
]);

// START KOMANDASI
if ($text == "/start") {
    $db->prepare("UPDATE users SET step = '' WHERE user_id = ?")->execute([$from_id]);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "Assalomu alaykum! Professional SMM botimizga xush kelibsiz.\n\nHisobingiz: " . number_format($user['balance'], 0, '.', ' ') . " so'm",
        'reply_markup' => $main_menu
    ]);
    exit;
}

// ADMIN PANEL
if ($text == "👨‍💻 Admin Panel" && $from_id == ADMIN) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "Admin boshqaruv paneliga xush kelibsiz.",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "📊 Statistika", 'callback_data' => "adm_stats"]],
                [['text' => "➕ Pul qo'shish", 'callback_data' => "adm_add_money"]],
                [['text' => "📢 Xabar yuborish", 'callback_data' => "adm_broadcast"]]
            ]
        ])
    ]);
    exit;
}

// 7. TO'LOV TIZIMI (CHEK BILAN)
if ($text == "💳 Hisobim") {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "Sizning ID: <code>$from_id</code>\nBalansingiz: <b>" . number_format($user['balance'], 0, '.', ' ') . " so'm</b>",
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode([
            'inline_keyboard' => [[['text' => "➕ Pul solish", 'callback_data' => "deposit"]]]
        ])
    ]);
}

if ($callback && $data == "deposit") {
    $db->prepare("UPDATE users SET step = 'wait_amount' WHERE user_id = ?")->execute([$from_id]);
    bot('editMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $msg_id,
        'text' => "Qancha miqdorda pul solmoqchisiz? (Faqat raqamlarda kiriting)\n\nMasalan: 50000"
    ]);
}

// Miqdor kiritilganda
if ($user['step'] == 'wait_amount' && is_numeric($text)) {
    $db->prepare("UPDATE users SET step = 'wait_check_$text' WHERE user_id = ?")->execute([$from_id]);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "To'lov miqdori: " . number_format($text, 0) . " so'm\n\nTo'lovni amalga oshiring:\n💳 Karta: <code>8600123456789012</code>\n\nTo'lovdan so'ng <b>Chek (Rasm)</b> yuboring.",
        'parse_mode' => 'HTML'
    ]);
    exit;
}

// Chek yuborilganda
if (strpos($user['step'], 'wait_check_') === 0 && (isset($message['photo']) || isset($message['document']))) {
    $amount = str_replace('wait_check_', '', $user['step']);
    $db->prepare("UPDATE users SET step = '' WHERE user_id = ?")->execute([$from_id]);
    
    // Adminga yuborish
    bot('forwardMessage', ['chat_id' => ADMIN, 'from_chat_id' => $chat_id, 'message_id' => $msg_id]);
    bot('sendMessage', [
        'chat_id' => ADMIN,
        'text' => "Yangi to'lov so'rovi!\nUser ID: $from_id\nMiqdor: $amount so'm",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "✅ Tasdiqlash", 'callback_data' => "confirm_{$from_id}_{$amount}"],
                 ['text' => "❌ Rad etish", 'callback_data' => "cancel_{$from_id}"]]
            ]
        ])
    ]);

    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "✅ Chek qabul qilindi. Admin tekshiruvidan so'ng pulingiz hisobingizga tushadi.",
        'reply_markup' => $main_menu
    ]);
}

// ADMIN TASDIQLASHI
if ($callback && strpos($data, "confirm_") === 0) {
    $ex = explode("_", $data);
    $u_id = $ex[1];
    $u_sum = $ex[2];

    $db->prepare("UPDATE users SET balance = balance + ? WHERE user_id = ?")->execute([$u_sum, $u_id]);
    
    bot('editMessageText', ['chat_id' => chat_id, 'message_id' => $msg_id, 'text' => "✅ To'lov tasdiqlandi. $u_sum so'm qo'shildi."]);
    bot('sendMessage', ['chat_id' => $u_id, 'text' => "✅ Hisobingiz $u_sum so'mga to'ldirildi!"]);
}

// 8. SMM XIZMATLAR (NAMUNA)
if ($text == "🛍 Xizmatlar") {
    // Bu yerda SQLite'dan kategoriyalarni chiqarish mumkin
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "Bo'limni tanlang:",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "Telegram", 'callback_data' => "smm_tg"], ['text' => "Instagram", 'callback_data' => "smm_inst"]]
            ]
        ])
    ]);
}
?>
