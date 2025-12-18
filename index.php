<?php
// ---------------------------------------------------------
// SealSeen - Professional Donation Bot (v2.0)
// ---------------------------------------------------------

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// SOZLAMALAR
$botToken = getenv('BOT_TOKEN'); 
$adminId = getenv('ADMIN_ID'); 

if (!$botToken) { http_response_code(500); die("Token topilmadi!"); }

// MA'LUMOTLAR BAZASI
$db = new PDO('sqlite:sealseen.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Jadvallar
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY, 
    chat_id INTEGER UNIQUE, 
    name TEXT, 
    balance INTEGER DEFAULT 0, 
    step TEXT DEFAULT 'none',
    temp_data TEXT DEFAULT ''
)");

$db->exec("CREATE TABLE IF NOT EXISTS orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    game_name TEXT,
    item_name TEXT,
    amount INTEGER,
    player_id TEXT,
    status TEXT DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// MAHSULOTLAR RO'YXATI
$products = [
    'pubg' => [
        'name' => "PUBG Mobile 🔫",
        'items' => [
            '60_uc' => ['name' => '60 UC', 'price' => 11896],
            '325_uc' => ['name' => '325 UC', 'price' => 59235],
            '660_uc' => ['name' => '660 UC', 'price' => 115000],
        ]
    ],
    'ff' => [
        'name' => "Free Fire 🔥",
        'items' => [
            '100_dm' => ['name' => '100 Diamonds', 'price' => 11000],
            '310_dm' => ['name' => '310 Diamonds', 'price' => 32000],
            '520_dm' => ['name' => '520 Diamonds', 'price' => 55000],
        ]
    ],
    'mlbb' => [
        'name' => "Mobile Legends ⚔️",
        'items' => [
            '86_dm' => ['name' => '86 Diamonds', 'price' => 15000],
            '172_dm' => ['name' => '172 Diamonds', 'price' => 29000],
            '257_dm' => ['name' => '257 Diamonds', 'price' => 45000],
        ]
    ]
];

// ---------------- TELEGRAM API ----------------
function bot($method, $datas = []) {
    global $botToken;
    $ch = curl_init("https://api.telegram.org/bot" . $botToken . "/" . $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}

// UPDATE NI QABUL QILISH
$update = json_decode(file_get_contents('php://input'));

if (isset($update->message)) {
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text ?? '';
    $name = $message->from->first_name;
    
    // Userni bazaga yozish
    $stmt = $db->prepare("INSERT OR IGNORE INTO users (chat_id, name) VALUES (:chat_id, :name)");
    $stmt->execute([':chat_id' => $chat_id, ':name' => $name]);
    
    // User infosini olish
    $stmt = $db->prepare("SELECT * FROM users WHERE chat_id = :chat_id");
    $stmt->execute([':chat_id' => $chat_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // -----------------------------------------------------
    // ADMIN REJIM (Admin userga pul qo'shishi uchun)
    // -----------------------------------------------------
    if ($chat_id == $adminId && strpos($user['step'], 'admin_paying_') === 0) {
        $targetUserId = str_replace('admin_paying_', '', $user['step']);
        
        if (is_numeric($text)) {
            // User balansini to'ldirish
            $db->prepare("UPDATE users SET balance = balance + :amount WHERE chat_id = :id")
               ->execute([':amount' => $text, ':id' => $targetUserId]);
            
            // Admin stepini tozalash
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = :id")->execute([':id' => $adminId]);
            
            bot('sendMessage', [
                'chat_id' => $adminId,
                'text' => "✅ <b>Bajarildi!</b>\nFoydalanuvchi hisobiga $text so'm qo'shildi.",
                'parse_mode' => 'HTML'
            ]);
            
            bot('sendMessage', [
                'chat_id' => $targetUserId,
                'text' => "💳 <b>Hisob to'ldirildi!</b>\nAdmin hisobingizga <b>$text so'm</b> o'tkazdi." . 
                          "\nHozirgi balans: " . number_format($user['balance'] ?? 0 + $text) . " so'm",
                'parse_mode' => 'HTML'
            ]);
        } else {
            bot('sendMessage', ['chat_id' => $adminId, 'text' => "❌ Iltimos, faqat raqam yuboring (summa)."]);
        }
        exit;
    }

    // -----------------------------------------------------
    // FOYDALANUVCHI REJIMI
    // -----------------------------------------------------

    // 1. Asosiy Menyu
    if ($text == "/start" || $text == "🏠 Bosh menyu") {
        $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = :id")->execute([':id' => $chat_id]);
        
        $key = json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [['text' => "🎮 Xizmatlar"], ['text' => "👤 Kabinet"]],
                [['text' => "📞 Yordam"], ['text' => "📄 Biz haqimizda"]]
            ]
        ]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "👋 Salom <b>$name</b>!\nProfessional donat botiga xush kelibsiz.",
            'parse_mode' => 'HTML',
            'reply_markup' => $key
        ]);
    }
    
    // 2. Kabinet
    elseif ($text == "👤 Kabinet") {
        $key = json_encode([
            'inline_keyboard' => [
                [['text' => "💳 Hisobni to'ldirish", 'callback_data' => "deposit"]]
            ]
        ]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "👤 <b>Kabinet:</b>\n\n🆔 ID: <code>$chat_id</code>\n💰 Balans: <b>" . number_format($user['balance']) . " so'm</b>",
            'parse_mode' => 'HTML',
            'reply_markup' => $key
        ]);
    }
    
    // 3. Xizmatlar
    elseif ($text == "🎮 Xizmatlar") {
        $keys = [];
        foreach ($products as $code => $game) {
            $keys[] = [['text' => $game['name'], 'callback_data' => "game_$code"]];
        }
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🎮 O'yinni tanlang:",
            'reply_markup' => json_encode(['inline_keyboard' => $keys])
        ]);
    }
    
    // ---------------- DEPOSIT FLOW ----------------
    
    // A. Summani kiritish
    elseif ($user['step'] == 'wait_sum') {
        if (is_numeric($text) && $text >= 1000) {
            $db->prepare("UPDATE users SET step = 'wait_receipt', temp_data = :sum WHERE chat_id = :id")
               ->execute([':sum' => $text, ':id' => $chat_id]);
            
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "✅ Summa qabul qilindi: <b>$text so'm</b>\n\nEndi ushbu summani kartamizga o'tkazib, <b>CHEK RASMINI</b> yuboring.\n💳 Karta: <code>8600 0000 0000 0000</code>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['keyboard' => [[['text' => "❌ Bekor qilish"]]], 'resize_keyboard' => true])
            ]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Iltimos, to'g'ri summa kiriting (min: 1000)."]);
        }
    }
    
    // B. Chekni qabul qilish
    elseif ($user['step'] == 'wait_receipt') {
        if ($text == "❌ Bekor qilish") {
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = :id")->execute([':id' => $chat_id]);
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Bekor qilindi.", 'reply_markup' => json_encode(['remove_keyboard' => true])]);
            // Qayta menyu
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Bosh menyu:", 
                'reply_markup' => json_encode(['resize_keyboard'=>true, 'keyboard'=>[[['text'=>"🎮 Xizmatlar"],['text'=>"👤 Kabinet"]],[['text'=>"📞 Yordam"],['text'=>"📄 Biz haqimizda"]]]])
            ]);
        }
        elseif (isset($message->photo)) {
            $amount = $user['temp_data'];
            $file_id = $message->photo[count($message->photo)-1]->file_id;
            
            // Adminga yuborish
            bot('sendPhoto', [
                'chat_id' => $adminId,
                'photo' => $file_id,
                'caption' => "💰 <b>Yangi To'lov!</b>\n\n👤 User: <a href='tg://user?id=$chat_id'>$name</a>\n💵 Da'vo qilingan summa: <b>$amount so'm</b>\n\nTasdiqlash uchun tugmani bosing va summani kiriting.",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "✅ Tasdiqlash (Summa kiritish)", 'callback_data' => "adm_ask_sum_$chat_id"]],
                        [['text' => "❌ Rad etish", 'callback_data' => "adm_rej_pay_$chat_id"]]
                    ]
                ])
            ]);
            
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "✅ <b>Chek yuborildi!</b>\nAdmin tekshirib chiqqach hisobingiz to'ldiriladi.",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['remove_keyboard' => true])
            ]);
            
            // User stepini tozalash lekin menyuni qaytarish
            $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = :id")->execute([':id' => $chat_id]);
             bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Kuting...", 
                'reply_markup' => json_encode(['resize_keyboard'=>true, 'keyboard'=>[[['text'=>"🎮 Xizmatlar"],['text'=>"👤 Kabinet"]],[['text'=>"📞 Yordam"],['text'=>"📄 Biz haqimizda"]]]])
            ]);
        } else {
            bot('sendMessage', ['chat_id' => $chat_id, 'text' => "📸 Iltimos, faqat rasm (chek) yuboring."]);
        }
    }
    
    // ---------------- O'YIN ID QABUL QILISH ----------------
    elseif (strpos($user['step'], 'wait_game_id_') === 0) {
        if ($text == "❌ Bekor qilish" || $text == "🏠 Bosh menyu") {
             $db->prepare("UPDATE users SET step = 'none' WHERE chat_id = :id")->execute([':id' => $chat_id]);
             bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Bekor qilindi."]);
        } else {
            // Ma'lumotlarni parse qilish
            $params = explode('_', str_replace('wait_game_id_', '', $user['step']));
            $gameCode = $params[0];
            $itemKey = $params[1] . '_' . $params[2]; // e.g. 60_uc
            
            $item = $products[$gameCode]['items'][$itemKey];
            
            // Balansni yana bir bor tekshirish (xavfsizlik uchun)
            if ($user['balance'] >= $item['price']) {
                // 1. Pulni yechib olish
                $db->prepare("UPDATE users SET balance = balance - :price, step = 'none' WHERE chat_id = :id")
                   ->execute([':price' => $item['price'], ':id' => $chat_id]);
                
                // 2. Order yaratish
                $stmt = $db->prepare("INSERT INTO orders (user_id, game_name, item_name, amount, player_id) VALUES (:uid, :gn, :in, :am, :pid)");
                $stmt->execute([
                    ':uid' => $chat_id,
                    ':gn' => $products[$gameCode]['name'],
                    ':in' => $item['name'],
                    ':am' => $item['price'],
                    ':pid' => $text
                ]);
                $orderId = $db->lastInsertId();
                
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "✅ <b>Buyurtma qabul qilindi!</b>\n\n🆔 Buyurtma №$orderId\n💰 Balansdan yechildi: {$item['price']} so'm\n⏳ Holati: Kutilmoqda...",
                    'parse_mode' => 'HTML'
                ]);
                
                // 3. Adminga yuborish
                bot('sendMessage', [
                    'chat_id' => $adminId,
                    'text' => "🆕 <b>Yangi Buyurtma! #$orderId</b>\n\n👤 User: <a href='tg://user?id=$chat_id'>$name</a>\n🎮 O'yin: {$products[$gameCode]['name']}\n💎 Paket: {$item['name']}\n🆔 Player ID: <code>$text</code>\n💰 Narxi: {$item['price']} so'm",
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                ['text' => "✅ Bajarildi", 'callback_data' => "order_accept_$orderId"],
                                ['text' => "❌ Bekor qilish (Refund)", 'callback_data' => "order_reject_$orderId"]
                            ]
                        ]
                    ])
                ]);
            } else {
                bot('sendMessage', ['chat_id' => $chat_id, 'text' => "❌ Xatolik yuz berdi yoki mablag' yetarli emas."]);
            }
        }
    }
}

// ---------------------------------------------------------
// CALLBACK HANDLE (TUGMALAR)
// ---------------------------------------------------------
if (isset($update->callback_query)) {
    $callback = $update->callback_query;
    $chat_id = $callback->message->chat->id;
    $data = $callback->data;
    $msg_id = $callback->message->message_id;

    // Userni yangilash
    $stmt = $db->prepare("SELECT * FROM users WHERE chat_id = :chat_id");
    $stmt->execute([':chat_id' => $chat_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 1. DEPOSIT START
    if ($data == "deposit") {
        bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $msg_id]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "💰 <b>Hisobni to'ldirish</b>\n\nIltimos, qancha summa to'ldirmoqchi ekanligingizni raqamda yozing:\n<i>Masalan: 50000</i>",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['resize_keyboard'=>true, 'keyboard'=>[[['text'=>"❌ Bekor qilish"]]]])
        ]);
        $db->prepare("UPDATE users SET step = 'wait_sum' WHERE chat_id = :id")->execute([':id' => $chat_id]);
    }
    
    // 2. GAME MENU
    elseif (strpos($data, 'game_') === 0) {
        $gameCode = str_replace('game_', '', $data);
        $game = $products[$gameCode];
        
        $keys = [];
        foreach ($game['items'] as $itemKey => $item) {
            $price = number_format($item['price']);
            $keys[] = [['text' => "{$item['name']} - {$price} so'm", 'callback_data' => "buy_{$gameCode}_{$itemKey}"]];
        }
        $keys[] = [['text' => "🔙 Orqaga", 'callback_data' => "back_main"]];

        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $msg_id,
            'text' => "🎮 <b>{$game['name']}</b>\nPaketni tanlang:",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode(['inline_keyboard' => $keys])
        ]);
    }
    
    // 3. BACK TO MAIN
    elseif ($data == "back_main") {
        bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $msg_id]);
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🏠 Bosh menyu",
            'reply_markup' => json_encode(['resize_keyboard'=>true, 'keyboard'=>[[['text'=>"🎮 Xizmatlar"],['text'=>"👤 Kabinet"]],[['text'=>"📞 Yordam"],['text'=>"📄 Biz haqimizda"]]]])
        ]);
    }
    
    // 4. BUY ITEM
    elseif (strpos($data, 'buy_') === 0) {
        $parts = explode('_', $data);
        $gameCode = $parts[1];
        $itemKey = $parts[2] . '_' . $parts[3];
        $item = $products[$gameCode]['items'][$itemKey];
        
        if ($user['balance'] >= $item['price']) {
            bot('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $msg_id]);
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "✅ Tanlandi: <b>{$item['name']}</b>\n\n✏️ Iltimos, o'yin <b>ID raqamingizni</b> yozib yuboring:",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode(['resize_keyboard'=>true, 'keyboard'=>[[['text'=>"❌ Bekor qilish"]]]])
            ]);
            // Stepga ma'lumotni saqlab qo'yamiz
            $stepValue = "wait_game_id_{$gameCode}_{$itemKey}";
            $db->prepare("UPDATE users SET step = :step WHERE chat_id = :id")->execute([':step' => $stepValue, ':id' => $chat_id]);
        } else {
            bot('answerCallbackQuery', [
                'callback_query_id' => $callback->id,
                'text' => "❌ Hisobingizda mablag' yetarli emas!",
                'show_alert' => true
            ]);
        }
    }
    
    // ---------------- ADMIN ACTIONS ----------------
    
    // Admin: Ask Sum for Deposit
    elseif (strpos($data, 'adm_ask_sum_') === 0) {
        $targetId = str_replace('adm_ask_sum_', '', $data);
        if ($chat_id == $adminId) {
            bot('sendMessage', [
                'chat_id' => $adminId,
                'text' => "✍️ Userga qancha summa qo'shmoqchisiz? Raqamda yozing:",
                'reply_markup' => json_encode(['force_reply' => true])
            ]);
            $db->prepare("UPDATE users SET step = :st WHERE chat_id = :id")
               ->execute([':st' => "admin_paying_$targetId", ':id' => $adminId]);
        }
    }
    
    // Admin: Reject Deposit
    elseif (strpos($data, 'adm_rej_pay_') === 0) {
        $targetId = str_replace('adm_rej_pay_', '', $data);
        bot('editMessageCaption', [
            'chat_id' => $adminId,
            'message_id' => $msg_id,
            'caption' => "❌ To'lov rad etildi."
        ]);
        bot('sendMessage', ['chat_id' => $targetId, 'text' => "❌ To'lovingiz admin tomonidan rad etildi. Qaytadan urinib ko'ring."]);
    }
    
    // Admin: ACCEPT ORDER
    elseif (strpos($data, 'order_accept_') === 0) {
        $orderId = str_replace('order_accept_', '', $data);
        $db->prepare("UPDATE orders SET status = 'completed' WHERE id = :id")->execute([':id' => $orderId]);
        
        // User ID ni olish
        $stmt = $db->prepare("SELECT user_id FROM orders WHERE id = :id");
        $stmt->execute([':id' => $orderId]);
        $ord = $stmt->fetch();
        
        bot('editMessageText', [
            'chat_id' => $adminId,
            'message_id' => $msg_id,
            'text' => "✅ Buyurtma #$orderId bajarildi deb belgilandi."
        ]);
        
        bot('sendMessage', [
            'chat_id' => $ord['user_id'],
            'text' => "✅ <b>Buyurtmangiz bajarildi!</b>\nO'yiningizni tekshirib ko'ring."
        ]);
    }
    
    // Admin: REJECT ORDER (REFUND)
    elseif (strpos($data, 'order_reject_') === 0) {
        $orderId = str_replace('order_reject_', '', $data);
        
        // Order ma'lumotlarini olish
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute([':id' => $orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($order['status'] != 'refunded') {
            // 1. Statusni o'zgartirish
            $db->prepare("UPDATE orders SET status = 'refunded' WHERE id = :id")->execute([':id' => $orderId]);
            
            // 2. Pulni qaytarish (Refund)
            $db->prepare("UPDATE users SET balance = balance + :amt WHERE chat_id = :uid")
               ->execute([':amt' => $order['amount'], ':uid' => $order['user_id']]);
               
            bot('editMessageText', [
                'chat_id' => $adminId,
                'message_id' => $msg_id,
                'text' => "❌ Buyurtma #$orderId bekor qilindi va <b>{$order['amount']} so'm</b> userga qaytarildi.",
                'parse_mode' => 'HTML'
            ]);
            
            bot('sendMessage', [
                'chat_id' => $order['user_id'],
                'text' => "⚠️ <b>Buyurtmangiz bekor qilindi.</b>\n💰 {$order['amount']} so'm balansingizga qaytarildi.",
                'parse_mode' => 'HTML'
            ]);
        }
    }
}

http_response_code(200);
echo "SealSeen v2.0 is Active";
?>
