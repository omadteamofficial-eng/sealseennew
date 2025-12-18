<?php
// SealSeen Professional Bot v3.1 - Fixed Version
// Kabinet va Mailing to'liq tuzatildi.

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

if (empty($config['bot_token'])) die("Bot tokeni kiritilmagan!");

// --- DB ULANISH ---
try {
    $db = new PDO('sqlite:' . $config['db_file']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec('PRAGMA journal_mode = WAL;'); 
} catch (PDOException $e) {
    die("DB Ulanish xatosi: " . $e->getMessage());
}

// --- JADVALLARNI TEKSHIRISH (FIXED) ---
// Orders jadvaliga 'amount' ustuni qo'shildi
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
    if (curl_errno($ch)) {
        error_log("Curl error: " . curl_error($ch));
    }
    curl_close($ch);
    return json_decode($res);
}

function esc($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function formatSum($sum) {
    return number_format($sum, 0, '.', ' ');
}

// --- UPDATE NI QABUL QILISH ---
$update = json_decode(file_get_contents('php://input'));

// --- LOGIKA BOSHLANISHI ---
try {
    $chat_id = null;
    $name = null;
    $text = null;
    $message_id = null;
    $user = null;

    // 1. Agar oddiy xabar bo'lsa
    if (isset($update->message)) {
        $msg = $update->message;
        $chat_id = $msg->chat->id;
        $text = $msg->text ?? '';
        $name = $msg->from->first_name ?? 'User';
        $message_id = $msg->message_id;

        // Userni bazaga yozish yoki yangilash
        $stmt = $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)");
        $stmt->execute([$chat_id, $name]);
        
        // User ma'lumotlarini olish
        $stmt = $db->prepare("SELECT * FROM users WHERE chat_id = ?");
        $stmt->execute([$chat_id]);
        $user = $stmt->fetch();

        // --- ADMIN REPLAY (Javob berish) ---
        if ($chat_id == $config['admin_id'] && isset($msg->reply_to_message)) {
            $replyTxt = $msg->reply_to_message->text ?? $msg->reply_to_message->caption ?? '';
            if (preg_match('/🆔 ID: (\d+)/', $replyTxt, $matches)) {
                $userId = $matches[1];
                bot('sendMessage', [
                    'chat_id' => $userId,
                    'text' => "📩 <b>Admindan javob:</b>\n\n" . esc($text),
                    'parse_mode' => 'HTML'
                ]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Javob yuborildi."]);
                exit;
            }
        }

        // --- ASOSIY MENYU VA BUYRUQLAR ---
        if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            $key = json_encode([
                'keyboard' => [
                    [['text' => "🛍 Xizmatlar"], ['text' => "👤 Kabinet"]],
                    [['text' => "📞 Yordam"]]
                ],
                'resize_keyboard' => true
            ]);
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "🖥️" . esc($name) . "</b> Asosiy menyudasiz.",
                'parse_mode' => 'HTML',
                'reply_markup' => $key
            ]);
        }

        // --- ADMIN PANEL START ---
        elseif ($text == "/panel" && $chat_id == $config['admin_id']) {
            $key = json_encode(['inline_keyboard' => [
                [['text' => "➕ Paket qo'shish", 'callback_data' => "adm_add_start"]],
                [['text' => "🗑 Paketni o'chirish", 'callback_data' => "adm_del_list"]],
                [['text' => "📣 Mailing", 'callback_data' => "adm_mail"], ['text' => "📊 Stat", 'callback_data' => "adm_stat"]]
            ]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "⚙️ <b>Admin Panel:</b>", 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }
        
        // --- PROMO KOD QO'SHISH ---
        elseif (strpos($text, "/promo ") === 0 && $chat_id == $config['admin_id']) {
            $sum = (int)str_replace("/promo ", "", $text);
            if ($sum > 0) {
                $code = "PC" . rand(10000, 99999);
                $db->prepare("INSERT INTO promos (code, amount) VALUES (?, ?)")->execute([$code, $sum]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Promo yaratildi: <code>$code</code>\n💰 Summa: " . formatSum($sum)]);
            }
        }

        // --- FOYDALANUVCHI STEPLARI (QADAMLAR) ---
        
        // 1. Yordam so'rash
        elseif ($user['step'] == 'wait_help') {
            bot('sendMessage', [
                'chat_id' => $config['admin_id'],
                'text' => "📨 <b>Yangi Murojaat!</b>\n👤 Kimdan: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n\n📄 Xabar: " . esc($text),
                'parse_mode' => 'HTML'
            ]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabaringiz adminga yuborildi."]);
        }

        // 2. Promo ishlatish
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

        // 3. Admin: Paket qo'shish
        elseif ($user['step'] == 'adm_add_cat') {
            $db->prepare("UPDATE users SET step = 'adm_add_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✏️ Paket nomini kiriting (Masalan: 60 UC):"]);
        }
        elseif ($user['step'] == 'adm_add_name') {
            $db->prepare("UPDATE users SET step = 'adm_add_price', temp_data = ? WHERE chat_id = ?")->execute([$user['temp_data'] . "|" . $text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💰 Narxni kiriting (Faqat raqam):"]);
        }
        elseif ($user['step'] == 'adm_add_price') {
            if (is_numeric($text)) {
                $ex = explode("|", $user['temp_data']);
                $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$ex[0], $ex[1], (int)$text]);
                $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Paket muvaffaqiyatli qo'shildi!"]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Iltimos, faqat raqam kiriting."]);
            }
        }

        // 4. Admin: Mailing (FIXED)
        elseif ($user['step'] == 'adm_mail_all' && $chat_id == $config['admin_id']) {
            $users = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
            $count = 0;
            // Xabar yuborishni biroz sekinlatish (serverni qiynamaslik uchun) yoki shunchaki loop
            foreach ($users as $uid) {
                $res = bot('sendMessage', ['chat_id' => $uid, 'text' => $text]);
                if ($res && $res->ok) $count++;
            }
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xabar $count ta foydalanuvchiga muvaffaqiyatli yuborildi."]);
        }

        // 5. Depozit summasini kiritish
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

        // 6. Chekni qabul qilish (Rasm)
        elseif ($user['step'] == 'wait_receipt' && isset($msg->photo)) {
            $photo = end($msg->photo);
            $fileId = $photo->file_id;
            $amount = $user['temp_data'];

            bot('sendPhoto', [
                'chat_id' => $config['admin_id'],
                'photo' => $fileId,
                'caption' => "💰 <b>Yangi To'lov!</b>\n\n👤 User: " . esc($name) . "\n🆔 ID: <code>$chat_id</code>\n💵 Summa: <b>" . formatSum($amount) . " so'm</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [
                        ['text' => "✅ Tasdiqlash", 'callback_data' => "pay_ok_{$chat_id}_{$amount}"],
                        ['text' => "❌ Rad etish", 'callback_data' => "pay_no_{$chat_id}"]
                    ]
                ]])
            ]);
            
            $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Chek qabul qilindi. Admin tekshirib hisobingizni to'ldiradi."]);
        }

        // 7. O'yin ID sini kiritish va sotib olish
        elseif ($user['step'] == 'wait_game_id') {
            $productId = (int)$user['temp_data'];
            $pStmt = $db->prepare("SELECT * FROM products WHERE id = ?");
            $pStmt->execute([$productId]);
            $product = $pStmt->fetch();

            if ($product) {
                if ($user['balance'] >= $product['price']) {
                    // Balansdan yechish
                    $db->prepare("UPDATE users SET balance = balance - ?, step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$product['price'], $chat_id]);
                    
                    // Order yaratish
                    $db->prepare("INSERT INTO orders (user_id, game, item, price, player_id, type) VALUES (?, ?, ?, ?, ?, 'purchase')")
                       ->execute([$chat_id, strtoupper($product['category']), $product['name'], $product['price'], $text]);
                    
                    $orderId = $db->lastInsertId();

                    // Adminga xabar
                    bot('sendMessage', [
                        'chat_id' => $config['admin_id'],
                        'text' => "📦 <b>Yangi Buyurtma #$orderId</b>\n\n👤 User: <a href='tg://user?id=$chat_id'>" . esc($name) . "</a> ($chat_id)\n🎮 O'yin: {$product['category']}\n💎 Paket: <b>{$product['name']}</b>\n🆔 Player ID: <code>$text</code>",
                        'parse_mode' => 'HTML',
                        'reply_markup' => json_encode(['inline_keyboard' => [
                            [['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$orderId"], ['text' => "🔙 Bekor (Refund)", 'callback_data' => "ord_ref_$orderId"]]
                        ]])
                    ]);

                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtma qabul qilindi (#$orderId).\nTez orada bajariladi."]);
                } else {
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Hisobingizda mablag' yetarli emas."]);
                    $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
                }
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Mahsulot topilmadi."]);
                $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
            }
        }

        // --- MENYU BUTTONLARI ---
        elseif ($text == "🛍 Xizmatlar") {
            $cats = $db->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
            if (!$cats) {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Hozircha xizmatlar mavjud emas."]);
            } else {
                $btn = [];
                $row = [];
                foreach ($cats as $c) {
                    $row[] = ['text' => strtoupper($c), 'callback_data' => "cat_" . $c];
                    if (count($row) == 2) { $btn[] = $row; $row = []; }
                }
                if ($row) $btn[] = $row;
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎮 Kerakli bo'limni tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
        }

        elseif ($text == "👤 Kabinet") {
            // FIX: "amount" ustuni endi mavjud va "orders" table da ishlaydi
            $dep = $db->prepare("SELECT SUM(amount) FROM orders WHERE user_id = ? AND status = 'completed' AND type = 'deposit'");
            $dep->execute([$chat_id]);
            $totalIn = $dep->fetchColumn() ?: 0;

            $msgText = "👤 <b>Shaxsiy Kabinet</b>\n\n" .
                       "🆔 ID: <code>$chat_id</code>\n" .
                       "👤 Ism: " . esc($name) . "\n" .
                       "💵 Balans: <b>" . formatSum($user['balance']) . " so'm</b>\n" .
                       "📥 Jami kiritilgan: " . formatSum($totalIn) . " so'm";
            
            $key = json_encode(['inline_keyboard' => [
                [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
                [['text' => "🎁 Promo-kod", 'callback_data' => "use_promo"]]
            ]]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => $msgText, 'parse_mode' => 'HTML', 'reply_markup' => $key]);
        }

        elseif ($text == "📞 Yordam") {
            $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📝 Savol yoki taklifingizni yozib qoldiring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        }
    }

    // 2. Agar Callback (Tugma bosilsa)
    elseif (isset($update->callback_query)) {
        $cb = $update->callback_query;
        $chat_id = $cb->message->chat->id;
        $mid = $cb->message->message_id;
        $data = $cb->data;
        $cb_id = $cb->id;

        // Userni olish (callback context)
        $stmt = $db->prepare("SELECT * FROM users WHERE chat_id = ?");
        $stmt->execute([$chat_id]);
        $user = $stmt->fetch();

        // Loadingni to'xtatish
        bot('answerCallbackQuery', ['callback_query_id' => $cb_id]);

        // --- USER ACTIONS ---
        if ($data == "deposit") {
            $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 To'ldirish summasini kiriting (min: 1000):"]);
        }
        
        elseif ($data == "use_promo") {
            $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🎁 Promo-kodni kiriting:"]);
        }

        elseif (strpos($data, "cat_") === 0) {
            $cat = str_replace("cat_", "", $data);
            $prods = $db->prepare("SELECT * FROM products WHERE category = ?");
            $prods->execute([$cat]);
            $list = $prods->fetchAll();
            
            $btn = [];
            foreach ($list as $p) {
                $btn[] = [['text' => $p['name'] . " - " . formatSum($p['price']), 'callback_data' => "buy_" . $p['id']]];
            }
            $btn[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_home"]]; // Orqaga tugmasini qo'shish kerak bo'lsa mantiq yozish kerak
            
            bot('editMessageText', [
                'chat_id' => $chat_id, 
                'message_id' => $mid, 
                'text' => "💎 <b>" . strtoupper($cat) . "</b> paketini tanlang:", 
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['inline_keyboard' => $btn])
            ]);
        }

        elseif (strpos($data, "buy_") === 0) {
            $pid = (int)str_replace("buy_", "", $data);
            $db->prepare("UPDATE users SET step = 'wait_game_id', temp_data = ? WHERE chat_id = ?")->execute([$pid, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🆔 O'yin ID raqamini (Player ID) yuboring:"]);
        }

        // --- ADMIN ACTIONS ---
        if ($chat_id == $config['admin_id']) {
            
            // FIX: Mailing uchun Step o'rnatish
            if ($data == "adm_mail") {
                $db->prepare("UPDATE users SET step = 'adm_mail_all' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📣 Mailing xabarini yuboring (Text, Rasm yoki Video):"]);
            }

            // To'lovni tasdiqlash
            elseif (strpos($data, "pay_ok_") === 0) {
                list($dummy, $dummy2, $uid, $amount) = explode("_", $data);
                $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$amount, $uid]);
                // FIX: 'amount' ustuniga yozish
                $db->prepare("INSERT INTO orders (user_id, type, amount, status) VALUES (?, 'deposit', ?, 'completed')")->execute([$uid, $amount]);
                
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "✅ <b>To'lov tasdiqlandi!</b>\nUser: $uid\nSumma: " . formatSum($amount), 'parse_mode' => 'HTML']);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "✅ Hisobingiz " . formatSum($amount) . " so'mga to'ldirildi."]);
            }
            
            // To'lovni rad etish
            elseif (strpos($data, "pay_no_") === 0) {
                $uid = str_replace("pay_no_", "", $data);
                bot('editMessageCaption', ['chat_id' => $chat_id, 'message_id' => $mid, 'caption' => "❌ <b>To'lov rad etildi.</b>", 'parse_mode' => 'HTML']);
                bot('sendMessage', ['chat_id' => $uid, 'text' => "❌ To'lov cheki qabul qilinmadi. Iltimos, tekshirib qayta yuboring."]);
            }

            // Stat
            elseif ($data == "adm_stat") {
                $uCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
                $oCount = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed' AND game IS NOT NULL")->fetchColumn();
                $income = $db->query("SELECT SUM(price) FROM orders WHERE status='completed' AND game IS NOT NULL")->fetchColumn() ?: 0;
                
                bot('sendMessage', [
                    'chat_id' => $chat_id, 
                    'text' => "📊 <b>Statistika:</b>\n\n👥 Foydalanuvchilar: $uCount ta\n🛒 Buyurtmalar: $oCount ta\n💸 Jami savdo: " . formatSum($income) . " so'm",
                    'parse_mode' => 'HTML'
                ]);
            }

            // Paket qo'shish start
            elseif ($data == "adm_add_start") {
                $db->prepare("UPDATE users SET step = 'adm_add_cat' WHERE chat_id = ?")->execute([$chat_id]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📂 Kategoriya nomini yozing (pubg, ff):"]);
            }

            // Paket o'chirish ro'yxati
            elseif ($data == "adm_del_list") {
                $all = $db->query("SELECT * FROM products")->fetchAll();
                $btn = [];
                foreach ($all as $p) {
                    $btn[] = [['text' => "🗑 " . $p['category'] . " - " . $p['name'], 'callback_data' => "real_del_" . $p['id']]];
                }
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'chirish uchun tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
            }
            elseif (strpos($data, "real_del_") === 0) {
                $pid = str_replace("real_del_", "", $data);
                $db->prepare("DELETE FROM products WHERE id = ?")->execute([$pid]);
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ O'chirildi."]);
            }

            // Buyurtmani bajarildi qilish
            elseif (strpos($data, "ord_done_") === 0) {
                $oid = str_replace("ord_done_", "", $data);
                $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
                $ord = $db->query("SELECT user_id, item FROM orders WHERE id = $oid")->fetch();
                
                bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Buyurtma #$oid bajarildi."]);
                if ($ord) bot('sendMessage', ['chat_id' => $ord['user_id'], 'text' => "✅ Buyurtmangiz bajarildi: <b>{$ord['item']}</b>", 'parse_mode' => 'HTML']);
            }

            // Refund (Bekor qilish va pulni qaytarish)
            elseif (strpos($data, "ord_ref_") === 0) {
                $oid = str_replace("ord_ref_", "", $data);
                $ordStmt = $db->prepare("SELECT * FROM orders WHERE id = ?");
                $ordStmt->execute([$oid]);
                $order = $ordStmt->fetch();

                if ($order && $order['status'] != 'refunded') {
                    $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$order['price'], $order['user_id']]);
                    $db->prepare("UPDATE orders SET status = 'refunded' WHERE id = ?")->execute([$oid]);
                    
                    bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "♻️ Buyurtma #$oid bekor qilindi va pul qaytarildi."]);
                    bot('sendMessage', ['chat_id' => $order['user_id'], 'text' => "⚠️ Buyurtmangiz (#$oid) bekor qilindi va hisobingizga pul qaytarildi."]);
                }
            }
        }
    }
} catch (Exception $e) {
    error_log("Bot logic error: " . $e->getMessage());
}
?>
