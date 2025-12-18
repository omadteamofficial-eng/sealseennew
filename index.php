<?php
// SealSeen Professional Bot v3.0
ob_start();
ini_set('display_errors', 0); // Xavfsizlik uchun xatolarni yashiramiz

$botToken = getenv('BOT_TOKEN');
$adminId = getenv('ADMIN_ID');

if (!$botToken) die("Token sozlanmagan!");

// DB ulanish
$db = new PDO('sqlite:sealseen.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Jadvallar (temp_data qo'shildi)
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
    game TEXT,
    item TEXT,
    price INTEGER,
    player_id TEXT,
    status TEXT DEFAULT 'pending'
)");

$db->exec("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category TEXT, 
    name TEXT, 
    price INTEGER
)");

// Promo-kodlar uchun jadval
$db->exec("CREATE TABLE IF NOT EXISTS promos (
    code TEXT PRIMARY KEY, 
    amount INTEGER, 
    status TEXT DEFAULT 'active'
)");

// Admin to'lovni tasdiqlagan joyida (namuna):
$db->prepare("INSERT INTO orders (user_id, type, amount, status) VALUES (?, 'deposit', ?, 'completed')")
   ->execute([$targetId, $amount]);



// Mahsulotlar
$products = [
    'pubg' => ['name' => "PUBG Mobile 🔫", 'items' => ['60_uc' => ['n' => '60 UC', 'p' => 12000], '325_uc' => ['n' => '325 UC', 'p' => 60000]]],
    'ff' => ['name' => "Free Fire 🔥", 'items' => ['100_dm' => ['n' => '100 Diamonds', 'p' => 11000]]],
    'mlbb' => ['name' => "Mobile Legends ⚔️", 'items' => ['86_dm' => ['n' => '86 Diamonds', 'p' => 15000]]]
];

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

    // Userni yaratish/olish
    $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (?, ?)")->execute([$chat_id, $name]);
    $user = $db->prepare("SELECT * FROM users WHERE chat_id = ?");
    $user->execute([$chat_id]);
    $user = $user->fetch(PDO::FETCH_ASSOC);

    // ADMIN SUMMA KIRITISHI (To'lovni tasdiqlash uchun)
    if ($chat_id == $adminId && strpos($user['step'], 'adm_pay_') === 0) {
        $targetId = str_replace('adm_pay_', '', $user['step']);
        if (is_numeric($text)) {
            $db->prepare("UPDATE users SET balance = balance + ?, step = 'none' WHERE chat_id = ?")->execute([$text, $targetId]);
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$adminId]);
            
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "✅ $targetId hisobiga $text so'm qo'shildi."]);
            bot('sendMessage', ['chat_id' => $targetId, 'text' => "💳 Hisobingiz $text so'mga to'ldirildi!"]);
        } else {
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "❌ Faqat raqam kiriting!"]);
        }
        exit;
    }
    // ADMIN REPLY QILIB JAVOB YOZISHI
if ($chat_id == $adminId && isset($msg->reply_to_message)) {
    $replyText = $msg->reply_to_message->text;
    
    // Xabar matnidan foydalanuvchi ID sini qidirib topish
    if (preg_match('/🆔 ID: (\d+)/', $replyText, $matches)) {
        $userId = $matches[1];
        
        bot('sendMessage', [
            'chat_id' => $userId,
            'text' => "📩 <b>Admindan javob keldi:</b>\n\n$text",
            'parse_mode' => 'HTML'
        ]);
        
        bot('sendMessage', [
            'chat_id' => $adminId,
            'text' => "✅ Javob foydalanuvchiga yuborildi."
        ]);
        exit; // Javob yuborilgach, boshqa shartlarni tekshirish shart emas
    }
}

    if ($text == "/start" || $text == "🏠 Bosh menyu" || $text == "❌ Bekor qilish") {
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        $key = json_encode(['keyboard' => [[['text' => "🛍 Xizmatlar"], ['text' => "💵 Hisobim"]], [['text' => "📞 Yordam"]]], 'resize_keyboard' => true]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🖥️ Asosiy menyudasiz", 'reply_markup' => $key]);
    } 

    if ($text == "/panel" && $chat_id == $adminId) {
    $key = json_encode([
        'inline_keyboard' => [
            [['text' => "➕ Paket qo'shish", 'callback_data' => "add_product"]],
            [['text' => "💰 Narxlarni tahrirlash", 'callback_data' => "edit_price"]],
            [['text' => "📣 Hammaga xabar yuborish", 'callback_data' => "send_ads"]],
        ]
    ]);
    bot('sendMessage', ['chat_id' => $adminId, 'text' => "🕹 **Admin boshqaruv paneli:**", 'parse_mode' => 'Markdown', 'reply_markup' => $key]);
}
        // --- A BO'LAGI (Statistika) ---
if($text == "/stat" && $chat_id == $adminId){
    $u_count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $o_count = $db->query("SELECT COUNT(*) FROM orders WHERE status='completed'")->fetchColumn();
    $total_sum = $db->query("SELECT SUM(price) FROM orders WHERE status='completed'")->fetchColumn();
    bot('sendMessage', [
        'chat_id' => $adminId,
        'text' => "📊 Statistikangiz:\nUserlar: $u_count\nBuyurtmalar: $o_count\nSumma: ".number_format($total_sum)." so'm"
    ]);
}
    elseif ($user['step'] == 'wait_help') {
    if ($text == "❌ Bekor qilish") {
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', [
            'chat_id' => $chat_id, 
            'text' => "🏠 Murojaat bekor qilindi.",
            'reply_markup' => json_encode(['keyboard' => [[['text' => "🎮 Xizmatlar"], ['text' => "👤 Kabinet"]], [['text' => "📞 Yordam"]]], 'resize_keyboard' => true])
        ]);
    } else {
        // Adminga xabar yuborish
        bot('sendMessage', [
            'chat_id' => $adminId,
            'text' => "📨 **Yangi murojaat!**\n\n👤 Foydalanuvchi: <a href='tg://user?id=$chat_id'>$name</a>\n🆔 ID: <code>$chat_id</code>\n\n💬 Xabar: <i>$text</i>",
            'parse_mode' => 'HTML'
        ]);

        // Foydalanuvchiga tasdiq
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "✅ Xabaringiz adminga yetkazildi. Javobni kuting.",
            'reply_markup' => json_encode(['keyboard' => [[['text' => "🎮 Xizmatlar"], ['text' => "👤 Kabinet"]], [['text' => "📞 Yordam"]]], 'resize_keyboard' => true])
        ]);
    }
}

// --- C BO'LAGI (Promo yaratish) ---
elseif(strpos($text, "/promo ") === 0 && $chat_id == $adminId){
    $sum = str_replace("/promo ", "", $text);
    if(is_numeric($sum)){
        $code = "PC" . rand(1000, 9999);
        $db->prepare("INSERT INTO promos (code, amount) VALUES (?, ?)")->execute([$code, $sum]);
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "🎁 Kod: `$code`\nSumma: $sum", 'parse_mode' => 'Markdown']);
    }
}

// --- B BO'LAGI (Xabar yuborish) ---
elseif($text == "/send" && $chat_id == $adminId){
    $db->prepare("UPDATE users SET step = 'send_all' WHERE chat_id = ?")->execute([$adminId]);
    bot('sendMessage', ['chat_id' => $adminId, 'text' => "Xabarni yuboring:"]);
}

// Diqqat! Bu qism foydalanuvchi "step"ini tekshiradi:
elseif($user['step'] == 'send_all' && $chat_id == $adminId){
    $all_users = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
    foreach($all_users as $u_id){
        bot('sendMessage', ['chat_id' => $u_id, 'text' => $text]);
    }
    $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$adminId]);
    bot('sendMessage', ['chat_id' => $adminId, 'text' => "✅ Hamma yuborildi."]);
}
    elseif ($text == "📞 Yordam") {
    $db->prepare("UPDATE users SET step = 'wait_help' WHERE chat_id = ?")->execute([$chat_id]);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "📝 **Adminga murojaatingizni yozib yuboring.**\nMutaxassislarimiz tez orada javob berishadi.",
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode([
            'keyboard' => [[['text' => "❌ Bekor qilish"]]],
            'resize_keyboard' => true
        ])
    ]);
}
    if ($data == "add_product") {
    $db->prepare("UPDATE users SET step = 'adm_prod_cat' WHERE chat_id = ?")->execute([$chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Kategoriyani kiriting (masalan: pubg, ff, mlbb):"]);
}
        elseif ($user['step'] == 'adm_prod_cat') {
    $db->prepare("UPDATE users SET step = 'adm_prod_name', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Paket nomini kiriting (masalan: 60 UC):"]);
}
elseif ($user['step'] == 'adm_prod_name') {
    $old_data = $user['temp_data']; // Kategoriya
    $db->prepare("UPDATE users SET step = 'adm_prod_price', temp_data = ? WHERE chat_id = ?")->execute([$old_data . "|" . $text, $chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Narxini kiriting (faqat raqam):"]);
}
elseif ($user['step'] == 'adm_prod_price') {
    $parts = explode("|", $user['temp_data']);
    $cat = $parts[0];
    $name = $parts[1];
    $price = (int)$text;

    $db->prepare("INSERT INTO products (category, name, price) VALUES (?, ?, ?)")->execute([$cat, $name, $price]);
    $db->prepare("UPDATE users SET step = 'none', temp_data = '' WHERE chat_id = ?")->execute([$chat_id]);
    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Yangi paket muvaffaqiyatli qo'shildi!"]);
}
    elseif ($user['step'] == 'wait_promo') {
    if ($text == "❌ Bekor qilish") {
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "🖥️ Asosiy menyuga qaytdingiz.", 'reply_markup' => json_encode(['remove_keyboard' => true])]);
        // Bosh menyuni chiqarish kodi bu yerda bo'lishi mumkin
    } else {
        // Promo-kodni bazadan qidirish
        $stmt = $db->prepare("SELECT * FROM promos WHERE code = ? AND status = 'active'");
        $stmt->execute([$text]);
        $promo_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($promo_data) {
            $summa = $promo_data['amount'];
            
            // 1. User balansini oshirish
            $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$summa, $chat_id]);
            
            // 2. Promo-kodni "ishlatilgan" (used) qilish
            $db->prepare("UPDATE promos SET status = 'used' WHERE code = ?")->execute([$text]);
            
            // 3. Stepni tozalash
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);

            bot('sendMessage', [
                'chat_id' => $chat_id, 
                'text' => "✅ **Muvaffaqiyatli!**\nHisobingizga $summa so'm qo'shildi.", 
                'parse_mode' => 'Markdown',
                'reply_markup' => json_encode(['remove_keyboard' => true])
            ]);
        } else {
            bot('sendMessage', [
                'chat_id' => $chat_id, 
                'text' => "❌ **Xato!**\nPromo-kod noto'g'ri, muddati o'tgan yoki allaqachon ishlatilgan."
            ]);
        }
    }
}
    // Reklamani hammaga tarqatish jarayoni
    elseif ($user['step'] == 'send_all' && $chat_id == $adminId) {
        $all_users = $db->query("SELECT chat_id FROM users")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($all_users as $u_id) {
            bot('sendMessage', ['chat_id' => $u_id, 'text' => $text]);
        }
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$adminId]);
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "✅ Xabar barcha foydalanuvchilarga yuborildi!"]);
    }
    
   elseif ($text == "👤 Kabinet") {
    // FAQAT karta orqali muvaffaqiyatli to'ldirilgan pullarni hisoblash
    // Bu yerda status='completed' bo'lishi shart (ya'ni admin tasdiqlagan)
    $stmt = $db->prepare("SELECT SUM(amount) FROM orders WHERE user_id = ? AND status = 'completed' AND type = 'deposit'");
    $stmt->execute([$chat_id]);
    $total_in = $stmt->fetchColumn() ?? 0;

    $key = json_encode([
        'inline_keyboard' => [
            [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]],
            [['text' => "🎁 Promo-kodni ishlatish", 'callback_data' => "use_promo"]]
        ]
    ]);

    $out_text = "💼 <b>Kabinetingizga xush kelibsiz.</b>\n\n";
    $out_text .= "📋 <b>Ma'lumotlaringiz</b>\n";
    $out_text .= "├ 🆔 <b>ID raqam:</b> <code>$chat_id</code>\n";
    $out_text .= "├ 💵 <b>Hisobingiz:</b> " . number_format($user['balance']) . " so'm\n";
    $out_text .= "╰ ✅ <b>Kiritgan pullaringiz:</b> " . number_format($total_in) . " so'm";

    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $out_text,
        'parse_mode' => 'HTML',
        'reply_markup' => $key
    ]);
}

    elseif ($text == "🛍 Xizmatlar") {
        $btn = [];
        foreach ($products as $k => $v) $btn[] = [['text' => $v['name'], 'callback_data' => "game_$k"]];
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Xizmatlarimizni tanlaganingizdan xursandmiz! 👇 Xizmatlardan birini tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
    }

    // TO'LOV JARAYONI
    elseif ($user['step'] == 'wait_sum') {
        if (is_numeric($text) && $text >= 1000) {
            $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = ? WHERE chat_id = ?")->execute([$text, $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Karta: `5614 6868 1732 2558`\nSumma: $text so'm\n\n📝 To'lov chekni (rasm) yuboring", 'parse_mode' => 'Markdown']);
        }
    } 
    
    elseif ($user['step'] == 'wait_receipt' && isset($msg->photo)) {
        $photo = end($msg->photo)->file_id;
        bot('sendPhoto', [
            'chat_id' => $adminId,
            'photo' => $photo,
            'caption' => "💰 Yangi to'lov!\nUser ID: $chat_id\nSumma: {$user['temp_data']} so'm",
            'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "✅ Tasdiqlash", 'callback_data' => "adm_confirm_$chat_id"], ['text' => "❌ Rad etish", 'callback_data' => "adm_reject_$chat_id"]]]])
        ]);
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = ?")->execute([$chat_id]);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Chek adminga yuborildi. Kuting..."]);
    }

    // ORDER JARAYONI (ID kiritish)
    elseif (strpos($user['step'], 'wait_id_') === 0) {
        $data = explode('|', str_replace('wait_id_', '', $user['step'])); // game|item_key|price
        if ($user['balance'] >= $data[2]) {
            // Pulni yechish
            $db->prepare("UPDATE users SET balance = balance - ?, step = 'none' WHERE chat_id = ?")->execute([$data[2], $chat_id]);
            // Order saqlash
            $db->prepare("INSERT INTO orders (user_id, game, item, price, player_id) VALUES (?,?,?,?,?)")
               ->execute([$chat_id, $data[0], $data[1], $data[2], $text]);
            $oid = $db->lastInsertId();
            
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "✅ Buyurtma qabul qilindi (#$oid). Balansdan " . number_format($data[2]) . " yechildi."]);
            bot('sendMessage', [
                'chat_id' => $adminId,
                'text' => "📦 Yangi Buyurtma #$oid\nO'yin: {$data[0]}\nPaket: {$data[1]}\nID: $text",
                'reply_markup' => json_encode(['inline_keyboard' => [[['text' => "✅ Bajarildi", 'callback_data' => "ord_done_$oid"], ['text' => "❌ Bekor qilish (Refund)", 'callback_data' => "ord_cancel_$oid"]]]])
            ]);
        }
    }
}

if (isset($update->callback_query)) {
    $cb = $update->callback_query;
    $chat_id = $cb->message->chat->id;
    $data = $cb->data;
    $mid = $cb->message->message_id;

    if ($data == "deposit") {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "💵 Hisobingzini qancha miqdorda to'ldirmoqchisiz ? ⏬ Minimal miqdor: 1000 so'm ‼️ Faqat raqamlardan foydalaning. 🔜 Masalan: 1000", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
        $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = ?")->execute([$chat_id]);
    }
        if ($data == "use_promo") {
    $db->prepare("UPDATE users SET step = 'wait_promo' WHERE chat_id = ?")->execute([$chat_id]);
    bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $mid]);
    bot('sendMessage', [
        'chat_id' => $chat_id, 
        'text' => "🎁 **Promo-kodni kiriting:**", 
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])
    ]);
}

   elseif (strpos($data, 'game_') === 0) {
    $cat = str_replace('game_', '', $data);
    $stmt = $db->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$cat]);
    $items = $stmt->fetchAll();

    $btns = [];
    foreach ($items as $item) {
        $btns[] = [['text' => "{$item['name']} - " . number_format($item['price']) . " so'm", 'callback_data' => "buy_prod_{$item['id']}"]];
    }
    $btns[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_to_games"]];
    
    bot('editMessageText', [
        'chat_id' => $chat_id, 
        'message_id' => $mid, 
        'text' => "Kerakli paketni tanlang:", 
        'reply_markup' => json_encode(['inline_keyboard' => $btns])
    ]);
}

    elseif ($data == "back_to_games") {
        $btn = [];
        foreach ($products as $k => $v) $btn[] = [['text' => $v['name'], 'callback_data' => "game_$k"]];
        bot('editMessageText', ['chat_id' => $chat_id, 'message_id' => $mid, 'text' => "✅ Xizmatlarimizni tanlaganingizdan xursandmiz! 👇 Xizmatlardan birini tanlang:", 'reply_markup' => json_encode(['inline_keyboard' => $btn])]);
    }

    elseif (strpos($data, 'buy_') === 0) {
        $p = explode('_', $data); // buy, game, item_part1, item_part2
        $game = $p[1]; $item_key = $p[2].'_'.$p[3];
        $item = $products[$game]['items'][$item_key];

        $user = $db->prepare("SELECT balance FROM users WHERE chat_id = ?"); $user->execute([$chat_id]);
        $bal = $user->fetchColumn();

        if ($bal >= $item['p']) {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "O'yin ID raqamingizni yuboring:", 'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])]);
            $db->prepare("UPDATE users SET step = ? WHERE chat_id = ?")->execute(["wait_id_$game|$item_key|{$item['p']}", $chat_id]);
        } else {
            bot('answerCallbackQuery', ['callback_query_id' => $cb->id, 'text' => "Mablag' yetarli emas!", 'show_alert' => true]);
        }
    }

    // ADMIN TO'LOVNI TASDIQLASH (SUMMA SO'RASH)
    if ($data && strpos($data, 'adm_confirm_') === 0) {
        $tid = str_replace('adm_confirm_', '', $data);
        bot('sendMessage', ['chat_id' => $adminId, 'text' => "User ID $tid uchun hisobga qo'shiladigan haqiqiy summani yuboring:"]);
        $db->prepare("UPDATE users SET step = ? WHERE chat_id = ?")->execute(["adm_pay_$tid", $adminId]);
    }

    // ORDERNI RAD ETISH (PULNI QAYTARISH)
    if (strpos($data, 'ord_cancel_') === 0) {
        $oid = str_replace('ord_cancel_', '', $data);
        $order = $db->prepare("SELECT * FROM orders WHERE id = ?"); $order->execute([$oid]);
        $order = $order->fetch(PDO::FETCH_ASSOC);

        if ($order && $order['status'] == 'pending') {
            $db->prepare("UPDATE users SET balance = balance + ? WHERE chat_id = ?")->execute([$order['price'], $order['user_id']]);
            $db->prepare("UPDATE orders SET status = 'rejected' WHERE id = ?")->execute([$oid]);
            bot('editMessageText', ['chat_id' => $adminId, 'message_id' => $mid, 'text' => "❌ #$oid rad etildi, pul qaytarildi."]);
            bot('sendMessage', ['chat_id' => $order['user_id'], 'text' => "❌ Buyurtma #$oid rad etildi. {$order['price']} so'm balansingizga qaytdi."]);
        }
    }
    
    if (strpos($data, 'ord_done_') === 0) {
        $oid = str_replace('ord_done_', '', $data);
        $db->prepare("UPDATE orders SET status = 'completed' WHERE id = ?")->execute([$oid]);
        bot('editMessageText', ['chat_id' => $adminId, 'message_id' => $mid, 'text' => "✅ #$oid bajarildi."]);
    }
}
