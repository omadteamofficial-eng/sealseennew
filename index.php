<?php
/*
 * SMM Bot - Barcha funksiyalar bitta faylda
 * Version: 1.0
 * Author: Telegram SMM Bot
 */

// ==================== KONFIGURATSIYA ====================
define('BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
define('ADMIN_ID', [123456789, 987654321]);
define('API_KEY', 'YOUR_SMM_API_KEY');
define('DB_HOST', 'localhost');
define('DB_NAME', 'smm_bot');
define('DB_USER', 'username');
define('DB_PASS', 'password');
define('DAILY_BONUS', 0.50);
define('BONUS_COOLDOWN', 86400);
define('MIN_DEPOSIT', 100);
define('PAYMENT_PROVIDER', 'click');
define('BASE_URL', 'https://your-domain.com');

// Database ulanish
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    error_log("Database ulanishda xatolik: " . $conn->connect_error);
}

// Vaqt zonasi
date_default_timezone_set('Asia/Tashkent');
$apiUrl = "https://api.telegram.org/bot" . BOT_TOKEN;

// ==================== YORDAMCHI FUNKSIYALAR ====================

/**
 * Telegramga xabar yuborish
 */
function sendMessage($chat_id, $text, $reply_markup = null, $parse_mode = 'HTML') {
    global $apiUrl;
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $parse_mode
    ];
    
    if ($reply_markup) {
        $data['reply_markup'] = $reply_markup;
    }
    
    $url = $apiUrl . "/sendMessage";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

/**
 * Xabarni o'zgartirish
 */
function editMessage($chat_id, $message_id, $text, $reply_markup = null) {
    global $apiUrl;
    $data = [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];
    
    if ($reply_markup) {
        $data['reply_markup'] = $reply_markup;
    }
    
    $url = $apiUrl . "/editMessageText";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

/**
 * Callback javobi
 */
function answerCallbackQuery($callback_id, $text = null) {
    global $apiUrl;
    $data = ['callback_query_id' => $callback_id];
    
    if ($text) {
        $data['text'] = $text;
    }
    
    $url = $apiUrl . "/answerCallbackQuery";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

/**
 * User ma'lumotlarini olish
 */
function getUser($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE telegram_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * Yangi user yaratish
 */
function createUser($user_id, $username, $first_name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (telegram_id, username, first_name, balance, created_at) VALUES (?, ?, ?, 0, NOW())");
    $stmt->bind_param("iss", $user_id, $username, $first_name);
    return $stmt->execute();
}

/**
 * Balansni yangilash
 */
function updateBalance($user_id, $amount) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE telegram_id = ?");
    $stmt->bind_param("di", $amount, $user_id);
    return $stmt->execute();
}

/**
 * Admin tekshirish
 */
function isAdmin($user_id) {
    return in_array($user_id, ADMIN_IDS);
}

// ==================== MENU FUNKSIYALARI ====================

/**
 * Boshlang'ich xabar
 */
function sendWelcomeMessage($chat_id, $user_id) {
    $user = getUser($user_id);
    
    $text = "👋 <b>Assalomu alaykum, " . ($user['first_name'] ?? 'Foydalanuvchi') . "!</b>\n\n";
    $text .= "🤖 <b>SMM Panel Botiga xush kelibsiz!</b>\n\n";
    $text .= "📈 Bizning bot orqali siz:\n";
    $text .= "✅ Instagram, YouTube, TikTok obunachilari\n";
    $text .= "✅ Telegram kanal a'zolari\n";
    $text .= "✅ Facebook laik va sharhlari\n";
    $text .= "✅ va boshqa ko'plab xizmatlarni sotib olishingiz mumkin!\n\n";
    $text .= "👇 Quyidagi tugmalar yordamida botdan foydalaning:";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => '📊 Xizmatlar', 'callback_data' => 'category_list'],
                ['text' => '💰 Balans', 'callback_data' => 'balance']
            ],
            [
                ['text' => '📦 Buyurtmalarim', 'callback_data' => 'my_orders'],
                ['text' => '🎁 Kunlik bonus', 'callback_data' => 'daily_bonus']
            ],
            [
                ['text' => '👤 Kabinet', 'callback_data' => 'profile'],
                ['text' => 'ℹ️ Yordam', 'callback_data' => 'help']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($keyboard));
}

/**
 * Asosiy menyu
 */
function showMainMenu($chat_id) {
    $keyboard = [
        'keyboard' => [
            [
                ['text' => '📊 Xizmatlar'],
                ['text' => '💰 Balans']
            ],
            [
                ['text' => '📦 Buyurtmalarim'],
                ['text' => '🎁 Kunlik bonus']
            ],
            [
                ['text' => 'ℹ️ Yordam'],
                ['text' => '👤 Kabinet']
            ]
        ],
        'resize_keyboard' => true
    ];
    
    $text = "🏠 <b>Asosiy Menyu</b>\n\nQuyidagi tugmalardan birini tanlang:";
    sendMessage($chat_id, $text, json_encode($keyboard));
}

/**
 * Balansni ko'rsatish
 */
function showBalance($chat_id, $user_id) {
    global $conn;
    $user = getUser($user_id);
    
    $text = "💰 <b>Hisobingiz</b>\n\n";
    $text .= "👤 Foydalanuvchi: <b>" . ($user['first_name'] ?? 'User') . "</b>\n";
    $text .= "🆔 ID: <code>" . $user_id . "</code>\n";
    $text .= "💵 Balans: <b>" . number_format($user['balance'], 2) . " UZS</b>\n\n";
    $text .= "Balansingizni to'ldirish uchun pastdagi tugmani bosing:";
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '💳 Balans to\'ldirish', 'callback_data' => 'deposit_methods']
            ],
            [
                ['text' => '📊 Statistika', 'callback_data' => 'stats'],
                ['text' => '⬅️ Orqaga', 'callback_data' => 'main_menu']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

/**
 * Kunlik bonus
 */
function claimDailyBonus($chat_id, $user_id) {
    global $conn;
    
    $user = getUser($user_id);
    $last_bonus = $user['last_bonus'] ? strtotime($user['last_bonus']) : 0;
    $now = time();
    
    if ($last_bonus == 0 || ($now - $last_bonus) >= BONUS_COOLDOWN) {
        // Bonus berish
        updateBalance($user_id, DAILY_BONUS);
        
        // Bonus vaqtini yangilash
        $stmt = $conn->prepare("UPDATE users SET last_bonus = NOW() WHERE telegram_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        // Yangi balans
        $new_balance = $user['balance'] + DAILY_BONUS;
        
        $text = "🎉 <b>Kunlik bonus</b>\n\n";
        $text .= "Tabriklaymiz! Siz kunlik bonusni muvaffaqiyatli qabul qildingiz!\n\n";
        $text .= "💸 Bonus miqdori: <b>" . DAILY_BONUS . " UZS</b>\n";
        $text .= "💰 Yangi balans: <b>" . number_format($new_balance, 2) . " UZS</b>\n\n";
        $text .= "Keyingi bonusni 24 soatdan keyin olishingiz mumkin!";
        
        sendMessage($chat_id, $text);
    } else {
        $next_bonus = $last_bonus + BONUS_COOLDOWN;
        $remaining = $next_bonus - $now;
        $hours = floor($remaining / 3600);
        $minutes = floor(($remaining % 3600) / 60);
        
        $text = "⏳ <b>Kunlik bonus</b>\n\n";
        $text .= "Siz allaqachon bugungi bonusingizni oldingiz!\n\n";
        $text .= "⏰ Keyingi bonusni olish uchun $hours soat $minutes daqiqa kutishingiz kerak.\n\n";
        $text .= "Har 24 soatda bir marta bonus olishingiz mumkin!";
        
        sendMessage($chat_id, $text);
    }
}

/**
 * Xizmatlar ro'yxati
 */
function showServices($chat_id, $category_id = null) {
    global $conn;
    
    if ($category_id) {
        // Maxsus kategoriya xizmatlari
        $stmt = $conn->prepare("SELECT * FROM services WHERE category_id = ? AND status = 1 ORDER BY price ASC");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $services = $stmt->get_result();
        
        $category = $conn->query("SELECT name FROM categories WHERE id = $category_id")->fetch_assoc();
        $text = "📊 <b>" . ($category['name'] ?? 'Xizmatlar') . "</b>\n\n";
    } else {
        // Barcha kategoriyalar
        $categories = $conn->query("SELECT * FROM categories WHERE status = 1 ORDER BY sort_order");
        $text = "📊 <b>Xizmatlar</b>\n\nKerakli kategoriyani tanlang:\n\n";
        
        $inline_keyboard = [];
        while ($category = $categories->fetch_assoc()) {
            $inline_keyboard[] = [
                [
                    'text' => $category['name'],
                    'callback_data' => 'category_' . $category['id']
                ]
            ];
        }
        
        $inline_keyboard[] = [
            ['text' => '⬅️ Orqaga', 'callback_data' => 'main_menu']
        ];
        
        $reply_markup = ['inline_keyboard' => $inline_keyboard];
        return sendMessage($chat_id, $text, json_encode($reply_markup));
    }
    
    // Xizmatlarni chiqarish
    $inline_keyboard = [];
    while ($service = $services->fetch_assoc()) {
        $price_per_1000 = number_format($service['price'], 0);
        $text .= "🔹 " . $service['name'] . "\n";
        $text .= "   💰 Narxi: " . $price_per_1000 . " UZS / 1000 ta\n";
        $text .= "   📊 Miqdor: " . $service['min_quantity'] . "-" . $service['max_quantity'] . "\n";
        $text .= "   🆔 ID: " . $service['id'] . "\n\n";
        
        $inline_keyboard[] = [
            [
                'text' => $service['name'] . " - " . $price_per_1000 . " UZS",
                'callback_data' => 'service_' . $service['id']
            ]
        ];
    }
    
    $inline_keyboard[] = [
        ['text' => '⬅️ Bosh menyu', 'callback_data' => 'main_menu'],
        ['text' => '📋 Barcha kategoriyalar', 'callback_data' => 'category_list']
    ];
    
    $reply_markup = ['inline_keyboard' => $inline_keyboard];
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

/**
 * Xizmat tafsilotlari
 */
function showServiceDetails($chat_id, $service_id) {
    global $conn;
    
    $service = $conn->query("SELECT s.*, c.name as category_name FROM services s 
                           LEFT JOIN categories c ON s.category_id = c.id 
                           WHERE s.id = $service_id")->fetch_assoc();
    
    if (!$service) {
        sendMessage($chat_id, "❌ Xizmat topilmadi!");
        return;
    }
    
    $text = "📋 <b>Xizmat tafsilotlari</b>\n\n";
    $text .= "🏷️ Nomi: <b>" . $service['name'] . "</b>\n";
    $text .= "📂 Kategoriya: " . $service['category_name'] . "\n";
    $text .= "💰 Narxi: <b>" . number_format($service['price'], 0) . " UZS / 1000 ta</b>\n";
    $text .= "📊 Minimal miqdor: " . number_format($service['min_quantity']) . "\n";
    $text .= "📈 Maksimal miqdor: " . number_format($service['max_quantity']) . "\n\n";
    
    if ($service['description']) {
        $text .= "📝 Tavsif:\n" . $service['description'] . "\n\n";
    }
    
    $text .= "Xizmatni sotib olish uchun quyidagi tugmani bosing:";
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '🛒 Sotib olish', 'callback_data' => 'order_' . $service_id]
            ],
            [
                ['text' => '⬅️ Orqaga', 'callback_data' => 'category_' . $service['category_id']],
                ['text' => '🏠 Bosh menyu', 'callback_data' => 'main_menu']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

/**
 * Buyurtma qilish
 */
function processOrder($chat_id, $user_id, $service_id) {
    global $conn;
    
    $service = $conn->query("SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
    $user = getUser($user_id);
    
    $text = "🛒 <b>Buyurtma berish</b>\n\n";
    $text .= "Xizmat: <b>" . $service['name'] . "</b>\n";
    $text .= "Narx: " . number_format($service['price'], 0) . " UZS / 1000 ta\n\n";
    $text .= "Iltimos, quyidagi formatda ma'lumotlarni yuboring:\n";
    $text .= "<code>link miqdor</code>\n\n";
    $text .= "Misol:\n";
    $text .= "<code>https://instagram.com/username 1000</code>\n\n";
    $text .= "Yoki bekor qilish uchun /cancel buyrug'ini yuboring.";
    
    sendMessage($chat_id, $text, null, 'HTML');
    
    // Foydalanuvchining holatini saqlash
    $conn->query("INSERT INTO user_sessions (user_id, action, data, created_at) 
                  VALUES ($user_id, 'ordering', '{\"service_id\":$service_id}', NOW())
                  ON DUPLICATE KEY UPDATE data = '{\"service_id\":$service_id}', updated_at = NOW()");
}

/**
 * Foydalanuvchi buyurtmalari
 */
function showMyOrders($chat_id, $user_id) {
    global $conn;
    
    $user = getUser($user_id);
    $orders = $conn->query("SELECT o.*, s.name as service_name FROM orders o 
                           JOIN services s ON o.service_id = s.id 
                           WHERE o.user_id = {$user['id']} 
                           ORDER BY o.created_at DESC LIMIT 10");
    
    $text = "📦 <b>Buyurtmalaringiz</b>\n\n";
    
    if ($orders->num_rows == 0) {
        $text .= "Hozircha sizda hech qanday buyurtma yo'q.\n";
        $text .= "Birinchi buyurtmangizni berish uchun 📊 Xizmatlar bo'limiga o'ting!";
    } else {
        while ($order = $orders->fetch_assoc()) {
            $status_icons = [
                'pending' => '⏳',
                'processing' => '🔄',
                'completed' => '✅',
                'cancelled' => '❌',
                'partial' => '⚠️'
            ];
            
            $status_text = [
                'pending' => 'Kutilyapti',
                'processing' => 'Jarayonda',
                'completed' => 'Yakunlandi',
                'cancelled' => 'Bekor qilindi',
                'partial' => 'Qisman bajarildi'
            ];
            
            $text .= "🆔 ID: <code>" . $order['id'] . "</code>\n";
            $text .= "📦 Xizmat: " . $order['service_name'] . "\n";
            $text .= "🔗 Link: " . substr($order['link'], 0, 30) . "...\n";
            $text .= "📊 Miqdor: " . number_format($order['quantity']) . "\n";
            $text .= "💰 Narx: " . number_format($order['price'], 2) . " UZS\n";
            $text .= "📊 Holat: " . $status_icons[$order['status']] . " " . $status_text[$order['status']] . "\n";
            $text .= "📅 Sana: " . date('d.m.Y H:i', strtotime($order['created_at'])) . "\n";
            $text .= "────────────────────\n";
        }
    }
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '🔄 Yangilash', 'callback_data' => 'my_orders'],
                ['text' => '📊 Barcha buyurtmalar', 'callback_data' => 'all_orders']
            ],
            [
                ['text' => '⬅️ Orqaga', 'callback_data' => 'main_menu']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup), 'HTML');
}

/**
 * To'lov usullari
 */
function showDepositMethods($chat_id, $user_id) {
    $text = "💳 <b>Balans to'ldirish</b>\n\n";
    $text .= "Quyidagi to'lov usullaridan birini tanlang:\n\n";
    $text .= "💰 Minimal to'lov miqdori: " . MIN_DEPOSIT . " UZS\n\n";
    $text .= "To'lov qilgandan so'ng, chek skrinshotini @admin ga yuboring.";
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '💳 Click', 'callback_data' => 'deposit_click'],
                ['text' => '📱 Payme', 'callback_data' => 'deposit_payme']
            ],
            [
                ['text' => '🏦 Uzcard/Humo', 'callback_data' => 'deposit_card'],
                ['text' => '💴 Naqd pul', 'callback_data' => 'deposit_cash']
            ],
            [
                ['text' => '⬅️ Orqaga', 'callback_data' => 'balance']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

/**
 * Yordam xabari
 */
function sendHelp($chat_id) {
    $text = "❓ <b>Yordam va Qo'llanma</b>\n\n";
    $text .= "🤖 <b>Botdan foydalanish:</b>\n";
    $text .= "1. Balansingizni to'ldiring\n";
    $text .= "2. Kerakli xizmatni tanlang\n";
    $text .= "3. Link va miqdorni yuboring\n";
    $text .= "4. To'lovni tasdiqlang\n";
    $text .= "5. Buyurtma bajarilishini kuting\n\n";
    
    $text .= "📞 <b>Aloqa:</b>\n";
    $text .= "Admin: @admin_username\n";
    $text .= "Qo'llab-quvvatlash: 24/7\n\n";
    
    $text .= "⚠️ <b>Eslatmalar:</b>\n";
    $text .= "• Minimal to'lov: " . MIN_DEPOSIT . " UZS\n";
    $text .= "• Buyurtmalar avtomatik boshlanadi\n";
    $text .= "• Muammo bo'lsa, admin bilan bog'laning";
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '📞 Admin bilan bog\'lanish', 'url' => 'https://t.me/admin_username']
            ],
            [
                ['text' => '⬅️ Orqaga', 'callback_data' => 'main_menu']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

/**
 * Foydalanuvchi profili
 */
function showProfile($chat_id, $user_id) {
    global $conn;
    $user = getUser($user_id);
    
    // Statistika
    $total_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE user_id = {$user['id']}")->fetch_assoc()['total'];
    $completed_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE user_id = {$user['id']} AND status = 'completed'")->fetch_assoc()['total'];
    $total_spent = $conn->query("SELECT SUM(price) as total FROM orders WHERE user_id = {$user['id']} AND status = 'completed'")->fetch_assoc()['total'] ?: 0;
    
    $text = "👤 <b>Shaxsiy kabinet</b>\n\n";
    $text .= "🆔 ID: <code>" . $user_id . "</code>\n";
    $text .= "👤 Ism: " . ($user['first_name'] ?? 'Noma\'lum') . "\n";
    $text .= "📧 Username: @" . ($user['username'] ?? 'yoq') . "\n";
    $text .= "💰 Balans: <b>" . number_format($user['balance'], 2) . " UZS</b>\n";
    $text .= "📅 Ro'yxatdan o'tgan: " . date('d.m.Y', strtotime($user['created_at'])) . "\n\n";
    
    $text .= "📊 <b>Statistika:</b>\n";
    $text .= "📦 Jami buyurtmalar: " . $total_orders . "\n";
    $text .= "✅ Bajarilganlar: " . $completed_orders . "\n";
    $text .= "💸 Jami sarflangan: " . number_format($total_spent, 2) . " UZS\n\n";
    
    $text .= "🛠 Sozlamalar:";
    
    $reply_markup = [
        'inline_keyboard' => [
            [
                ['text' => '✏️ Ismni o\'zgartirish', 'callback_data' => 'edit_name'],
                ['text' => '🔔 Bildirishnomalar', 'callback_data' => 'notifications']
            ],
            [
                ['text' => '🔄 Yangilash', 'callback_data' => 'profile'],
                ['text' => '⬅️ Orqaga', 'callback_data' => 'main_menu']
            ]
        ]
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup), 'HTML');
}

// ==================== ADMIN FUNKSIYALARI ====================

/**
 * Admin menyusi
 */
function showAdminMenu($chat_id) {
    if (!isAdmin($chat_id)) {
        sendMessage($chat_id, "❌ Siz admin emassiz!");
        return;
    }
    
    $text = "👑 <b>Admin Panel</b>\n\n";
    $text .= "Quyidagi buyruqlardan birini tanlang:\n\n";
    $text .= "📊 /stats - Bot statistikasi\n";
    $text .= "👥 /users - Foydalanuvchilar ro'yxati\n";
    $text .= "📦 /orders - Barcha buyurtmalar\n";
    $text .= "💰 /deposits - To'lovlar\n";
    $text .= "➕ /addservice - Yangi xizmat qo'shish\n";
    $text .= "📢 /broadcast - Xabar yuborish\n";
    $text .= "⚙️ /settings - Sozlamalar";
    
    sendMessage($chat_id, $text);
}

/**
 * Bot statistikasi
 */
function showAdminStats($chat_id) {
    if (!isAdmin($chat_id)) {
        sendMessage($chat_id, "❌ Siz admin emassiz!");
        return;
    }
    
    global $conn;
    
    // Umumiy statistika
    $total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
    $today_users = $conn->query("SELECT COUNT(*) as total FROM users WHERE DATE(created_at) = CURDATE()")->fetch_assoc()['total'];
    $active_users = $conn->query("SELECT COUNT(DISTINCT user_id) as total FROM orders WHERE DATE(created_at) = CURDATE()")->fetch_assoc()['total'];
    
    $total_orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
    $today_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE DATE(created_at) = CURDATE()")->fetch_assoc()['total'];
    $pending_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status = 'pending'")->fetch_assoc()['total'];
    
    $total_deposits = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'deposit' AND status = 'completed'")->fetch_assoc()['total'] ?: 0;
    $today_deposits = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE type = 'deposit' AND status = 'completed' AND DATE(created_at) = CURDATE()")->fetch_assoc()['total'] ?: 0;
    
    $total_revenue = $conn->query("SELECT SUM(price) as total FROM orders WHERE status = 'completed'")->fetch_assoc()['total'] ?: 0;
    
    $text = "📊 <b>Bot Statistikasi</b>\n\n";
    
    $text .= "👥 <b>Foydalanuvchilar:</b>\n";
    $text .= "• Jami: " . number_format($total_users) . "\n";
    $text .= "• Bugungi: " . number_format($today_users) . "\n";
    $text .= "• Faol: " . number_format($active_users) . "\n\n";
    
    $text .= "📦 <b>Buyurtmalar:</b>\n";
    $text .= "• Jami: " . number_format($total_orders) . "\n";
    $text .= "• Bugungi: " . number_format($today_orders) . "\n";
    $text .= "• Kutilyapti: " . number_format($pending_orders) . "\n\n";
    
    $text .= "💰 <b>Moliya:</b>\n";
    $text .= "• Jami to'lov: " . number_format($total_deposits, 2) . " UZS\n";
    $text .= "• Bugungi to'lov: " . number_format($today_deposits, 2) . " UZS\n";
    $text .= "• Jami daromad: " . number_format($total_revenue, 2) . " UZS\n\n";
    
    $text .= "📅 Hisobot: " . date('d.m.Y H:i');
    
    sendMessage($chat_id, $text);
}

/**
 * Foydalanuvchilar ro'yxati
 */
function showAdminUsers($chat_id, $page = 1) {
    if (!isAdmin($chat_id)) {
        sendMessage($chat_id, "❌ Siz admin emassiz!");
        return;
    }
    
    global $conn;
    
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    $users = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT $limit OFFSET $offset");
    $total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
    $total_pages = ceil($total_users / $limit);
    
    $text = "👥 <b>Foydalanuvchilar ro'yxati</b>\n\n";
    $text .= "Jami foydalanuvchilar: " . number_format($total_users) . "\n";
    $text .= "Sahifa: $page/$total_pages\n\n";
    
    while ($user = $users->fetch_assoc()) {
        $orders_count = $conn->query("SELECT COUNT(*) as total FROM orders WHERE user_id = {$user['id']}")->fetch_assoc()['total'];
        $text .= "🆔 ID: " . $user['id'] . "\n";
        $text .= "👤 Ism: " . ($user['first_name'] ?? 'Noma\'lum') . "\n";
        $text .= "📧 Username: @" . ($user['username'] ?? 'yoq') . "\n";
        $text .= "💰 Balans: " . number_format($user['balance'], 2) . " UZS\n";
        $text .= "📦 Buyurtmalar: " . $orders_count . "\n";
        $text .= "📅 Ro'yxatdan: " . date('d.m.Y', strtotime($user['created_at'])) . "\n";
        $text .= "────────────────────\n";
    }
    
    $reply_markup = ['inline_keyboard' => []];
    
    // Sahifa tugmalari
    $page_buttons = [];
    if ($page > 1) {
        $page_buttons[] = ['text' => '⬅️ Oldingi', 'callback_data' => 'admin_users_' . ($page - 1)];
    }
    if ($page < $total_pages) {
        $page_buttons[] = ['text' => 'Keyingi ➡️', 'callback_data' => 'admin_users_' . ($page + 1)];
    }
    
    if (!empty($page_buttons)) {
        $reply_markup['inline_keyboard'][] = $page_buttons;
    }
    
    $reply_markup['inline_keyboard'][] = [
        ['text' => '⬅️ Admin menyu', 'callback_data' => 'admin_menu']
    ];
    
    sendMessage($chat_id, $text, json_encode($reply_markup));
}

// ==================== ASOSIY BOT LOGIKASI ====================

/**
 * Xabarni qayta ishlash
 */
function processMessage($message) {
    global $conn;
    
    $chat_id = $message['chat']['id'];
    $user_id = $message['from']['id'];
    $text = isset($message['text']) ? $message['text'] : '';
    $username = isset($message['from']['username']) ? $message['from']['username'] : '';
    $first_name = isset($message['from']['first_name']) ? $message['from']['first_name'] : '';
    
    // User ma'lumotlarini saqlash
    $user = getUser($user_id);
    if (!$user) {
        createUser($user_id, $username, $first_name);
    }
    
    // Admin buyruqlari
    if (isAdmin($user_id) && strpos($text, '/') === 0) {
        $parts = explode(' ', $text);
        $command = $parts[0];
        
        switch ($command) {
            case '/admin':
                showAdminMenu($chat_id);
                return;
            case '/stats':
                showAdminStats($chat_id);
                return;
            case '/users':
                $page = isset($parts[1]) ? intval($parts[1]) : 1;
                showAdminUsers($chat_id, $page);
                return;
            case '/broadcast':
                // Xabar yuborish
                if (isset($parts[1])) {
                    $broadcast_text = substr($text, strlen($parts[0]) + 1);
                    broadcastMessage($broadcast_text);
                    sendMessage($chat_id, "✅ Xabar barcha foydalanuvchilarga yuborildi!");
                } else {
                    sendMessage($chat_id, "❌ Iltimos, xabar matnini kiriting!\nMasalan: /broadcast Salom hammaga!");
                }
                return;
        }
    }
    
    // Oddiy buyruqlar
    if (strpos($text, '/') === 0) {
        $command = explode(' ', $text)[0];
        
        switch ($command) {
            case '/start':
                sendWelcomeMessage($chat_id, $user_id);
                break;
            case '/menu':
            case '/help':
                sendHelp($chat_id);
                break;
            case '/balance':
            case '💰 Balans':
                showBalance($chat_id, $user_id);
                break;
            case '📊 Xizmatlar':
                showServices($chat_id);
                break;
            case '📦 Buyurtmalarim':
                showMyOrders($chat_id, $user_id);
                break;
            case '🎁 Kunlik bonus':
                claimDailyBonus($chat_id, $user_id);
                break;
            case '👤 Kabinet':
                showProfile($chat_id, $user_id);
                break;
            case 'ℹ️ Yordam':
                sendHelp($chat_id);
                break;
            case '/cancel':
                $conn->query("DELETE FROM user_sessions WHERE user_id = $user_id");
                sendMessage($chat_id, "❌ Amal bekor qilindi.");
                showMainMenu($chat_id);
                break;
            default:
                sendMessage($chat_id, "❌ Noma'lum buyruq!\nIltimos, menyudan foydalaning.");
        }
    } else {
        // Oddiy xabarlarni qayta ishlash
        processTextMessage($chat_id, $user_id, $text);
    }
}

/**
 * Callback query ni qayta ishlash
 */
function processCallback($callback) {
    $chat_id = $callback['message']['chat']['id'];
    $user_id = $callback['from']['id'];
    $data = $callback['data'];
    $message_id = $callback['message']['message_id'];
    
    // Callback javobi
    answerCallbackQuery($callback['id']);
    
    // Callback ma'lumotlarini qayta ishlash
    if ($data == 'main_menu') {
        showMainMenu($chat_id);
    } elseif ($data == 'balance') {
        showBalance($chat_id, $user_id);
    } elseif ($data == 'category_list') {
        showServices($chat_id);
    } elseif ($data == 'my_orders') {
        showMyOrders($chat_id, $user_id);
    } elseif ($data == 'daily_bonus') {
        claimDailyBonus($chat_id, $user_id);
    } elseif ($data == 'profile') {
        showProfile($chat_id, $user_id);
    } elseif ($data == 'help') {
        sendHelp($chat_id);
    } elseif ($data == 'deposit_methods') {
        showDepositMethods($chat_id, $user_id);
    } elseif (strpos($data, 'category_') === 0) {
        $category_id = str_replace('category_', '', $data);
        showServices($chat_id, $category_id);
    } elseif (strpos($data, 'service_') === 0) {
        $service_id = str_replace('service_', '', $data);
        showServiceDetails($chat_id, $service_id);
    } elseif (strpos($data, 'order_') === 0) {
        $service_id = str_replace('order_', '', $data);
        processOrder($chat_id, $user_id, $service_id);
    } elseif (strpos($data, 'admin_') === 0) {
        // Admin callback lar
        if (isAdmin($user_id)) {
            if ($data == 'admin_menu') {
                showAdminMenu($chat_id);
            } elseif (strpos($data, 'admin_users_') === 0) {
                $page = str_replace('admin_users_', '', $data);
                showAdminUsers($chat_id, $page);
            }
        } else {
            sendMessage($chat_id, "❌ Siz admin emassiz!");
        }
    }
}

/**
 * Oddiy xabarni qayta ishlash
 */
function processTextMessage($chat_id, $user_id, $text) {
    global $conn;
    
    // Foydalanuvchi sessiyasini tekshirish
    $session = $conn->query("SELECT * FROM user_sessions WHERE user_id = $user_id")->fetch_assoc();
    
    if ($session && $session['action'] == 'ordering') {
        // Buyurtma qilish jarayoni
        $data = json_decode($session['data'], true);
        $service_id = $data['service_id'];
        
        // Link va miqdorni ajratish
        $parts = explode(' ', $text);
        if (count($parts) >= 2) {
            $link = $parts[0];
            $quantity = intval($parts[1]);
            
            // Xizmat ma'lumotlarini olish
            $service = $conn->query("SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
            $user = getUser($user_id);
            
            // Miqdorni tekshirish
            if ($quantity < $service['min_quantity'] || $quantity > $service['max_quantity']) {
                sendMessage($chat_id, "❌ Miqdor noto'g'ri!\nMinimal: " . $service['min_quantity'] . "\nMaksimal: " . $service['max_quantity']);
                return;
            }
            
            // Narxni hisoblash
            $price = ($service['price'] * $quantity) / 1000;
            
            // Balansni tekshirish
            if ($user['balance'] < $price) {
                sendMessage($chat_id, "❌ Balansingiz yetarli emas!\nKerak: " . number_format($price, 2) . " UZS\nMavjud: " . number_format($user['balance'], 2) . " UZS");
                return;
            }
            
            // Buyurtmani yaratish
            $stmt = $conn->prepare("INSERT INTO orders (user_id, service_id, link, quantity, price, status, created_at) VALUES (?, ?, ?, ?, ?, 'pending', NOW())");
            $stmt->bind_param("iisid", $user['id'], $service_id, $link, $quantity, $price);
            
            if ($stmt->execute()) {
                // Balansdan yechish
                updateBalance($user_id, -$price);
                
                // Sessiyani tozalash
                $conn->query("DELETE FROM user_sessions WHERE user_id = $user_id");
                
                $text = "✅ <b>Buyurtma qabul qilindi!</b>\n\n";
                $text .= "📦 Xizmat: " . $service['name'] . "\n";
                $text .= "🔗 Link: " . $link . "\n";
                $text .= "📊 Miqdor: " . number_format($quantity) . "\n";
                $text .= "💰 Narx: " . number_format($price, 2) . " UZS\n";
                $text .= "📊 Holat: ⏳ Admin tasdiqini kutyapti\n\n";
                $text .= "Buyurtmangiz admin tomonidan tez orada ko'rib chiqiladi!";
                
                // Adminlarga xabar yuborish
                foreach (ADMIN_IDS as $admin_id) {
                    $admin_text = "🆕 <b>Yangi buyurtma!</b>\n\n";
                    $admin_text .= "👤 Foydalanuvchi: @" . ($user['username'] ?? 'yoq') . "\n";
                    $admin_text .= "📦 Xizmat: " . $service['name'] . "\n";
                    $admin_text .= "🔗 Link: " . $link . "\n";
                    $admin_text .= "📊 Miqdor: " . number_format($quantity) . "\n";
                    $admin_text .= "💰 Narx: " . number_format($price, 2) . " UZS\n";
                    $admin_text .= "🆔 Buyurtma ID: " . $stmt->insert_id;
                    
                    sendMessage($admin_id, $admin_text);
                }
                
                sendMessage($chat_id, $text);
                showMainMenu($chat_id);
            } else {
                sendMessage($chat_id, "❌ Xatolik yuz berdi! Iltimos, qayta urinib ko'ring.");
            }
        } else {
            sendMessage($chat_id, "❌ Format noto'g'ri!\nIltimos, quyidagi formatda yuboring:\n<code>link miqdor</code>\n\nMisol:\n<code>https://instagram.com/username 1000</code>", null, 'HTML');
        }
    } else {
        // Oddiy xabar
        sendMessage($chat_id, "Iltimos, menyudan kerakli bo'limni tanlang yoki /help buyrug'ini yuboring.");
    }
}

// ==================== ASOSIY ISHGA TUSHIRISH ====================

// Database jadvallarini yaratish (agar mavjud bo'lmasa)
function createTables() {
    global $conn;
    
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        telegram_id BIGINT UNIQUE NOT NULL,
        username VARCHAR(255),
        first_name VARCHAR(255),
        balance DECIMAL(10,2) DEFAULT 0.00,
        last_bonus DATETIME DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        status TINYINT DEFAULT 1,
        sort_order INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,5) NOT NULL,
        min_quantity INT DEFAULT 100,
        max_quantity INT DEFAULT 10000,
        api_service_id VARCHAR(100),
        status TINYINT DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    );
    
    CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        service_id INT,
        link VARCHAR(500) NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        api_order_id VARCHAR(100),
        status ENUM('pending', 'processing', 'completed', 'cancelled', 'partial') DEFAULT 'pending',
        start_count INT DEFAULT 0,
        remains INT DEFAULT 0,
        admin_approved TINYINT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (service_id) REFERENCES services(id)
    );
    
    CREATE TABLE IF NOT EXISTS transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        amount DECIMAL(10,2) NOT NULL,
        type ENUM('deposit', 'withdrawal', 'order', 'refund', 'bonus') NOT NULL,
        description VARCHAR(255),
        status ENUM('pending', 'completed', 'failed', 'cancelled') DEFAULT 'pending',
        payment_id VARCHAR(100),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    );
    
    CREATE TABLE IF NOT EXISTS user_sessions (
        user_id BIGINT PRIMARY KEY,
        action VARCHAR(50),
        data TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS admin_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) UNIQUE NOT NULL,
        setting_value TEXT,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    ";
    
    // Bir nechta so'rovni alohida bajarish
    $queries = explode(';', $sql);
    foreach ($queries as $query) {
        if (trim($query)) {
            $conn->query($query);
        }
    }
    
    // Demo ma'lumotlarni qo'shish
    $check_categories = $conn->query("SELECT COUNT(*) as count FROM categories")->fetch_assoc()['count'];
    if ($check_categories == 0) {
        $conn->query("INSERT INTO categories (name, sort_order) VALUES 
                     ('Instagram', 1),
                     ('YouTube', 2),
                     ('Telegram', 3),
                     ('TikTok', 4),
                     ('Facebook', 5)");
    }
    
    $check_services = $conn->query("SELECT COUNT(*) as count FROM services")->fetch_assoc()['count'];
    if ($check_services == 0) {
        $conn->query("INSERT INTO services (category_id, name, price, min_quantity, max_quantity) VALUES 
                     (1, 'Instagram Followers', 5000, 100, 10000),
                     (1, 'Instagram Likes', 3000, 100, 5000),
                     (1, 'Instagram Views', 2000, 100, 50000),
                     (2, 'YouTube Views', 1500, 100, 100000),
                     (2, 'YouTube Likes', 4000, 100, 10000),
                     (3, 'Telegram Members', 6000, 100, 50000),
                     (3, 'Telegram Views', 2500, 100, 100000),
                     (4, 'TikTok Followers', 8000, 100, 10000),
                     (4, 'TikTok Likes', 3500, 100, 50000),
                     (5, 'Facebook Likes', 4500, 100, 10000)");
    }
    
    $check_settings = $conn->query("SELECT COUNT(*) as count FROM admin_settings")->fetch_assoc()['count'];
    if ($check_settings == 0) {
        $conn->query("INSERT INTO admin_settings (setting_key, setting_value) VALUES 
                     ('min_deposit', '100'),
                     ('contact_info', '@admin'),
                     ('terms_url', 'https://example.com/terms')");
    }
}

// Webhook or getUpdates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Webhook rejimi
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    
    if ($update) {
        if (isset($update['message'])) {
            processMessage($update['message']);
        } elseif (isset($update['callback_query'])) {
            processCallback($update['callback_query']);
        }
    }
} else {
    // Webhook o'rnatish uchun
    if (isset($_GET['setwebhook'])) {
        $url = BASE_URL . '/index.php';
        $result = file_get_contents("https://api.telegram.org/bot" . BOT_TOKEN . "/setWebhook?url=" . urlencode($url));
        echo "Webhook o'rnatildi: " . $result;
    } elseif (isset($_GET['deletewebhook'])) {
        $result = file_get_contents("https://api.telegram.org/bot" . BOT_TOKEN . "/deleteWebhook");
        echo "Webhook o'chirildi: " . $result;
    } elseif (isset($_GET['info'])) {
        $result = file_get_contents("https://api.telegram.org/bot" . BOT_TOKEN . "/getWebhookInfo");
        echo "Webhook ma'lumotlari: " . $result;
    } elseif (isset($_GET['init'])) {
        // Database jadvallarini yaratish
        createTables();
        echo "✅ Database jadvallari yaratildi!";
    } else {
        // Asosiy sahifa
        echo "<h1>🤖 SMM Bot ishga tushirildi!</h1>";
        echo "<p>Bot muvaffaqiyatli ishlamoqda.</p>";
        echo "<p><a href='?setwebhook=1'>Webhook o'rnatish</a></p>";
        echo "<p><a href='?deletewebhook=1'>Webhook o'chirish</a></p>";
        echo "<p><a href='?info=1'>Webhook ma'lumotlari</a></p>";
        echo "<p><a href='?init=1'>Database ni ishga tushirish</a></p>";
    }
}

// Agar CLI orqali ishga tushirilsa
if (php_sapi_name() == 'cli') {
    echo "🤖 Bot CLI rejimda ishga tushdi...\n";
    echo "Ctrl+C tugmasini bosib to'xtating.\n";
    
    $offset = 0;
    while (true) {
        $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates?offset=" . $offset . "&timeout=30";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if (isset($data['result']) && count($data['result']) > 0) {
            foreach ($data['result'] as $update) {
                if (isset($update['message'])) {
                    processMessage($update['message']);
                } elseif (isset($update['callback_query'])) {
                    processCallback($update['callback_query']);
                }
                $offset = $update['update_id'] + 1;
            }
        }
        sleep(1);
    }
}
?>

<!-- HTML sahifa ko'rinishi uchun -->
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMM Bot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            margin-top: 50px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .status {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .status.success {
            background: rgba(46, 204, 113, 0.2);
            border-left: 4px solid #2ecc71;
        }
        .status.info {
            background: rgba(52, 152, 219, 0.2);
            border-left: 4px solid #3498db;
        }
        .buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        .feature {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .feature i {
            font-size: 2em;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🤖 SMM Bot Panel</h1>
        
        <div class="status success">
            ✅ Bot muvaffaqiyatli ishga tushirildi!
        </div>
        
        <div class="status info">
            📊 Bot token: <?php echo substr(BOT_TOKEN, 0, 10) . '...'; ?><br>
            👥 Adminlar: <?php echo count(ADMIN_IDS); ?> ta<br>
            ⏰ Server vaqti: <?php echo date('Y-m-d H:i:s'); ?>
        </div>
        
        <div class="features">
            <div class="feature">
                <div>📊</div>
                <h3>Xizmatlar</h3>
                <p>Instagram, YouTube, TikTok va boshqa platformalar uchun xizmatlar</p>
            </div>
            <div class="feature">
                <div>💰</div>
                <h3>To'lov tizimi</h3>
                <p>Click, Payme, Uzcard/Humo orqali to'lov qilish imkoniyati</p>
            </div>
            <div class="feature">
                <div>⚡</div>
                <h3>Tez bajarish</h3>
                <p>Buyurtmalar 5 daqiqadan 24 soatgacha bajariladi</p>
            </div>
            <div class="feature">
                <div>🛡️</div>
                <h3>Kafolat</h3>
                <p>Barcha xizmatlarimiz kafolatlangan va sifatli</p>
            </div>
        </div>
        
        <div class="buttons">
            <a href="?setwebhook=1" class="btn">🌐 Webhook o'rnatish</a>
            <a href="?deletewebhook=1" class="btn">❌ Webhook o'chirish</a>
            <a href="?info=1" class="btn">ℹ️ Webhook ma'lumotlari</a>
            <a href="?init=1" class="btn">🗄️ Database yaratish</a>
        </div>
        
        <div style="text-align: center; margin-top: 40px; font-size: 0.9em; opacity: 0.8;">
            <p>© 2024 SMM Bot Panel. Barcha huquqlar himoyalangan.</p>
            <p>Bot yordam uchun: <a href="https://t.me/username" style="color: #fff;">@admin_username</a></p>
        </div>
    </div>
</body>
</html>
