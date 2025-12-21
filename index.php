<?php
/**
 * PROFESSIONAL SMM BOT v5.0
 * Muallif: Sizning talabingiz asosida (Fixed Version)
 * Xususiyatlar: Mukammal Kabinet, Kunlik Bonus, Admin Panel, SQLite
 */

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'bot_errors.log');

// Agar hostingingiz .env fayllarni o'qiy olsa:
$config = [
    'bot_token' => getenv('BOT_TOKEN'),
    'admin_id'  => (int)getenv('ADMIN_ID'),
    'db_file'   => 'smm_pro.db',
    'card_num'  => getenv('CARD_NUM'),
    'min_pay'   => 1000,
    'bonus_sum' => 11
];

// ================= BAZA BILAN ISHLASH (PDO) =================
try {
    $db = new PDO('sqlite:' . $config['db_file']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Jadvallarni yaratish (Agar yo'q bo'lsa)
    $commands = [
        "CREATE TABLE IF NOT EXISTS users (
            chat_id INTEGER PRIMARY KEY, 
            name TEXT, 
            balance INTEGER DEFAULT 0, 
            step TEXT DEFAULT 'none', 
            temp_data TEXT, 
            last_bonus_date TEXT DEFAULT NULL,
            joined_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            category TEXT, 
            name TEXT, 
            price INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            user_id INTEGER, 
            type TEXT,              -- 'order' (xarid) yoki 'deposit' (to'lov)
            service_name TEXT,      -- Xizmat nomi
            amount INTEGER,         -- Summa
            link TEXT DEFAULT NULL, -- Link (xarid uchun)
            status TEXT DEFAULT 'pending', 
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS promos (
            code TEXT PRIMARY KEY, 
            amount INTEGER, 
            status TEXT DEFAULT 'active'
        )"
    ];

    foreach ($commands as $cmd) {
        $db->exec($cmd);
    }
} catch (PDOException $e) {
    die("Baza xatosi: " . $e->getMessage());
}

// ================= FUNKSIYALAR =================
function bot($method, $datas = []) {
    global $config;
    $url = "https://api.telegram.org/bot" . $config['bot_token'] . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log("Curl xatosi: " . curl_error($ch));
    }
    curl_close($ch);
    return json_decode($res);
}

function esc($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function formatSum($sum) {
    return number_format((float)$sum, 0, '.', ' ');
}

// ================= UPDATE NI QABUL QILISH =================
$update = json_decode(file_get_contents('php://input'));

if (isset($update->message)) {
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text ?? '';
    $name = $message->from->first_name ?? 'Foydalanuvchi';
    
    // Userni bazaga qo'shish yoki yangilash
    $stmt = $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)");
    $stmt->execute([$chat_id, $name]);
    
    // User ma'lumotlarini olish
    $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

    // 1. START va MENYU
    if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
        $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
        
        $keys = [
            [['text' => "🚀 Xizmatlar"], ['text' => "👤 Kabinet"]],
            [['text' => "📞 Yordam"], ['text' => "📚 Qo'llanma"]]
        ];
        if ($chat_id == $config['admin_id']) {
            $keys[] = [['text' => "⚙️ Admin Panel"]];
        }

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "👋 <b>Assalomu alaykum, $name!</b>\n\nSMM xizmatlari botiga xush kelibsiz. Quyidagi menyudan kerakli bo'limni tanlang:",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['keyboard' => $keys, 'resize_keyboard' => true])
        ]);
        exit;
    }

    // 2. KABINET (TUZATILGAN)
    if ($text == "👤 Kabinet") {
        // Balans user jadvalida, lekin jami kirimni orders jadvalidan hisoblaymiz
        // COALESCE(SUM(amount), 0) -> Agar hech narsa bo'lmasa 0 qaytaradi (NULL emas)
        $totalIn = $db->query("SELECT COALESCE(SUM(amount), 0) FROM orders WHERE user_id = $chat_id AND type = 'deposit' AND status = 'completed'")->fetchColumn();
        
        $msg = "👤 <b>Sizning Kabinetingiz:</b>\n\n";
        $msg .= "🆔 ID: <code>$chat_id</code>\n";
        $msg .= "👤 Ism: " . esc($name) . "\n";
        $msg .= "💰 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n";
        $msg .= "📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm\n\n";
        $msg .= "🔻 Quyidagi tugmalar orqali boshqaring:";

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => $msg,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
                    [['text' => "🎁 Kunlik Bonus", 'callback_data' => "daily_bonus"], ['text' => "🎫 Promo Kod", 'callback_data' => "promo"]]
                ]
            ])
        ]);
    }

    // 3. XIZMATLAR BO'LIMI
    elseif ($text == "🚀 Xizmatlar") {
        $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
        
        if (!$cats) {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "😔 Hozircha xizmatlar mavjud emas."]);
        } else {
            $btn = []; $row = [];
            foreach ($cats as $cat) {
                $row[] = ['text' => "📂 " . ucfirst($cat), 'callback_data' => "cat_" . $cat];
                if (count($row) == 2) { $btn[] = $row; $row = []; }
            }
            if ($row) $btn[] = $row;
            
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "👇 Kerakli ijtimoiy tarmoqni tanlang:",
                'reply_markup' => json_encode(['inline_keyboard' => $btn])
            ]);
        }
    }

    // 4. ADMIN PANEL (Faqat Admin uchun)
    elseif ($text == "⚙️ Admin Panel" && $chat_id == $config['admin_id']) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "👑 <b>Admin Boshqaruv Paneli</b>\nTanlang:",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => "➕ Xizmat qo'shish", 'callback_data' => "adm_add"], ['text' => "🗑 Xizmat o'chirish", 'callback_data' => "adm_del"]],
                    [['text' => "📊 Statistika", 'callback_data' => "adm_stat"], ['text' => "✉️ Xabar yuborish", 'callback_data' => "adm_send"]]
                ]
            ])
        ]);
    }

    // 5. STATUSLAR (STEPS) BILAN ISHLASH
    
    // --- To'lov Summasini kiritish ---
    elseif ($user['step'] == 'wait_sum') {
        if (is_numeric($text) && $text >= $config['min_pay']) {
            $db->prepare("UPDATE users SET step = 'wait_check', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "💳 <b>To'lov ma'lumotlari:</b>\n\nKartamiz: <code>" . $config['card_num'] . "</code>\nSumma: <b>" . formatSum($text) . " so'm</b>\n\n📸 Iltimos, to'lov qilganingiz haqida <b>chek (skrinshot)</b> yuboring:",
                'parse_mode' => 'HTML'
            ]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Minimal to'lov: " . $config['min_pay'] . " so'm. Iltimos, faqat raqam yozing."]);
        }
    }

    // --- Chekni qabul qilish ---
    elseif ($user['step'] == 'wait_check') {
        if (isset($message->photo)) {
            $photo = end($message->photo)->file_id;
            $summa = $user['temp_data'];
            
            // Adminga yuborish
            bot('sendPhoto', [
                'chat_id' => $config['admin_id'],
                'photo' => $photo,
                'caption' => "💰 <b>Yangi To'lov!</b>\n\n👤 User: <a href='tg://user?id=$chat_id'>$name</a>\n💵 Summa: <b>" . formatSum($summa) . " so'm</b>\n🆔 ID: $chat_id",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => "✅ Tasdiqlash", 'callback_data' => "pay_confirm_{$chat_id}_{$summa}"],
                            ['text' => "❌ Rad etish", 'callback_data' => "pay_reject_{$chat_id}"]
                        ]
                    ]
                ])
            ]);

            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Chek qabul qilindi! Admin tekshirib tasdiqlagach, balansingizga pul tushadi."]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📸 Iltimos, rasm (skrinshot) yuboring."]);
        }
    }

    // --- Buyurtma Linkini qabul qilish ---
    elseif ($user['step'] == 'wait_link') {
        $prod_id = $user['temp_data'];
        $product = $db->query("SELECT * FROM products WHERE id = " . (int)$prod_id)->fetch();

        if ($product && $user['balance'] >= $product['price']) {
            // Balansdan yechish
            $db->prepare("UPDATE users SET balance = balance - ?, step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$product['price'], $chat_id]);
            
            // Order yaratish
            $stmt = $db->prepare("INSERT INTO orders (user_id, type, service_name, amount, link, status) VALUES (?, 'order', ?, ?, ?, 'pending')");
            $stmt->execute([$chat_id, $product['name'], $product['price'], $text]);
            $order_id = $db->lastInsertId();

            // Adminga xabar
            bot('sendMessage', [
                'chat_id' => $config['admin_id'],
                'text' => "📦 <b>Yangi Buyurtma #$order_id</b>\n\n👤 User: <a href='tg://user?id=$chat_id'>$name</a>\n📌 Xizmat: {$product['name']}\n🔗 Link: $text\n💰 Narx: " . formatSum($product['price']) . " so'm",
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
                'reply_markup' => json_encode([
                    'inline_keyboard' => [[['text' => "✅ Bajarildi deb belgilash", 'callback_data' => "order_done_$order_id"]]]
                ])
            ]);

            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtmangiz qabul qilindi (ID: #$order_id). Tez orada bajariladi!"]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Balansingizda mablag' yetarli emas. Iltimos, hisobni to'ldiring."]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        }
    }
    
    // --- Admin: Xizmat qo'shish jarayoni ---
    elseif ($user['step'] == 'add_cat' && $chat_id == $config['admin_id']) {
        $db->prepare("UPDATE users SET step = 'add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✏️ Xizmat nomini kiriting (Masalan: 1000 Obunachi):"]);
    }
    elseif ($user['step'] == 'add_name' && $chat_id == $config['admin_id']) {
        $db->prepare("UPDATE users SET step = 'add_price', temp_data = temp_data || '|' || ? WHERE chat_id = ?")->execute([$text, $chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Narxini kiriting (faqat raqam):"]);
    }
    elseif ($user['step'] == 'add_price' && $chat_id == $config['admin_id']) {
        if (is_numeric($text)) {
            $data = explode('|', $user['temp_data']);
            $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$data[0], $data[1], $text]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xizmat muvaffaqiyatli qo'shildi!"]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Iltimos, narxni raqamda kiriting."]);
        }
    }
}

// ================= CALLBACK QUERY (TUGMALAR) =================
if (isset($update->callback_query)) {
    $cb = $update->callback_query;
    $chat_id = $cb->message->chat->id;
    $mid = $cb->message->message_id;
    $data = $cb->data;
    $cb_id = $cb->id;

    // Userni yangilash
    $user = $db->query("SELECT * FROM users WHERE chat_id = $chat_id")->fetch();

    // 1. HISOB TO'LDIRISH
    if ($data == "deposit") {
        $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
        bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "💵 Hisobni to'ldirish uchun summani yozing (Min: " . $config['min_pay'] . " so'm):",
            'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])
        ]);
    }

    // 2. KUNLIK BONUS (FIXED)
    elseif ($data == "daily_bonus") {
        $today = date('Y-m-d');
        if ($user['last_bonus_date'] == $today) {
            bot('answerCallbackQuery', [
                'callback_query_id' => $cb_id,
                'text' => "⚠️ Siz bugun bonus oldingiz! Ertaga yana kiring.",
                'show_alert' => true
            ]);
        } else {
            $db->prepare("UPDATE users SET balance = balance + ?, last_bonus_date = ? WHERE chat_id = ?")->execute([$config['bonus_sum'], $today, $chat_id]);
            bot('answerCallbackQuery', [
                'callback_query_id' => $cb_id,
                'text' => "✅ Tabriklaymiz! Sizga " . $config['bonus_sum'] . " so'm bonus berildi.",
                'show_alert' => true
            ]);
            // Kabinetni yangilash
            $totalIn = $db->query("SELECT COALESCE(SUM(amount), 0) FROM orders WHERE user_id = $chat_id AND type = 'deposit' AND status = 'completed'")->fetchColumn();
            $newBal = $user['balance'] + $config['bonus_sum'];
            
            $msg = "👤 <b>Sizning Kabinetingiz:</b>\n\n🆔 ID: <code>$chat_id</code>\n👤 Ism: " . esc($user['name']) . "\n💰 Balans: <b>" . formatSum($newBal) . " so'm</b>\n📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm\n\n🔻 Quyidagi tugmalar orqali boshqaring:";
            
            bot('editMessageText', [
                'chat_id' => $chat_id,
                'message_id' => $mid,
                'text' => $msg,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
                        [['text' => "🎁 Kunlik Bonus", 'callback_data' => "daily_bonus"], ['text' => "🎫 Promo Kod", 'callback_data' => "promo"]]
                    ]
                ])
            ]);
        }
    }

    // 3. XIZMATLAR KATEGORIYASI
    elseif (strpos($data, "cat_") === 0) {
        $cat = str_replace("cat_", "", $data);
        $products = $db->prepare("SELECT * FROM products WHERE category = ?");
        $products->execute([$cat]);
        $rows = $products->fetchAll();

        $btn = [];
        foreach ($rows as $p) {
            $btn[] = [['text' => $p['name'] . " - " . formatSum($p['price']) . " so'm", 'callback_data' => "buy_" . $p['id']]];
        }
        $btn[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_services"]];

        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $mid,
            'text' => "📱 <b>" . ucfirst($cat) . "</b> uchun xizmatlar:",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['inline_keyboard' => $btn])
        ]);
    }
    
    elseif ($data == "back_services") {
        $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
        $btn = []; $row = [];
        foreach ($cats as $cat) {
            $row[] = ['text' => "📂 " . ucfirst($cat), 'callback_data' => "cat_" . $cat];
            if (count($row) == 2) { $btn[] = $row; $row = []; }
        }
        if ($row) $btn[] = $row;
        bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "👇 Kerakli ijtimoiy tarmoqni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
    }

    // 4. XARID QILISH
    elseif (strpos($data, "buy_") === 0) {
        $pid = str_replace("buy_", "", $data);
        $db->prepare("UPDATE users SET step = 'wait_link', temp_data = ? WHERE chat_id = ?")->execute([$pid, $chat_id]);
        bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🔗 <b>Havolani yuboring:</b>\n\nMasalan: <code>https://instagram.com/user</code>\n\n(Bekor qilish uchun '❌ Bekor qilish' tugmasini bosing)",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])
        ]);
    }

    // ================= ADMIN ACTIONS =================
    
    // To'lovni tasdiqlash
    if (strpos($data, "pay_confirm_") === 0 && $chat_id == $config['admin_id']) {
        list(,,$user_id, $amount) = explode("_", $data);
        
        // Balansni to'ldirish
        $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$amount, $user_id]);
        // Tarixga yozish
        $db->prepare("INSERT INTO orders (user_id, type, service_name, amount, status) VALUES (?, 'deposit', 'Balans toldirish', ?, 'completed')")->execute([$user_id, $amount]);

        bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "✅ <b>Qabul qilindi!</b>\nFoydalanuvchiga $amount so'm qo'shildi.", 'parse_mode' => 'HTML']);
        bot('sendMessage', ['chat_id' => $user_id, 'text' => "✅ To'lovingiz tasdiqlandi! Balansingizga " . formatSum($amount) . " so'm qo'shildi."]);
    }

    // To'lovni rad etish
    if (strpos($data, "pay_reject_") === 0 && $chat_id == $config['admin_id']) {
        $user_id = str_replace("pay_reject_", "", $data);
        bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "❌ <b>Rad etildi!</b>"]);
        bot('sendMessage', ['chat_id' => $user_id, 'text' => "❌ To'lovingiz qabul qilinmadi. Chek noaniq yoki xato."]);
    }
    
    // Orderni bajarildi qilish
    if (strpos($data, "order_done_") === 0 && $chat_id == $config['admin_id']) {
        $oid = str_replace("order_done_", "", $data);
        $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
        $ord = $db->query("SELECT user_id, service_name FROM orders WHERE id = $oid")->fetch();
        
        bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Buyurtma #$oid bajarildi deb belgilandi."]);
        bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "✅ <b>Buyurtmangiz bajarildi!</b>\n\nXizmat: {$ord['service_name']}\n\nBizni tanlaganingiz uchun rahmat!", 'parse_mode' => 'HTML']);
    }

    // Admin Menyular
    if ($data == "adm_add" && $chat_id == $config['admin_id']) {
        $db->prepare("UPDATE users SET step = 'add_cat' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Yangi xizmat uchun kategoriya nomini yozing (Masalan: Telegram):"]);
    }
    
    if ($data == "adm_stat" && $chat_id == $config['admin_id']) {
        $u_count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $o_count = $db->query("SELECT COUNT(*) FROM orders WHERE type='order'")->fetchColumn();
        $money = $db->query("SELECT COALESCE(SUM(amount), 0) FROM orders WHERE type='deposit' AND status='completed'")->fetchColumn();
        
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📊 <b>Statistika:</b>\n\n👤 Foydalanuvchilar: $u_count ta\n📦 Buyurtmalar: $o_count ta\n💰 Jami tushum: " . formatSum($money) . " so'm", 'parse_mode' => 'HTML']);
    }
}
?>
