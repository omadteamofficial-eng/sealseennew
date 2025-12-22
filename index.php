<?php
/*
 * Professional SMM Bot
 * Version: 2.0 (Refactored & Secured)
 */

// Xatolarni ko'rsatish (Test rejimida yoqing, productionda o'chiring)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// ==================== ENV YUKLOVCHI ====================
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// .env faylini yuklash
loadEnv(__DIR__ . '/.env');

// ==================== BOT KLASSI ====================
class SMMBot {
    private $conn;
    private $token;
    private $adminIds;
    private $apiUrl;

    public function __construct() {
        $this->token = getenv('BOT_TOKEN');
        $this->adminIds = explode(',', getenv('ADMIN_IDS'));
        $this->apiUrl = "https://api.telegram.org/bot" . $this->token . "/";
        
        $this->connectDB();
    }

    private function connectDB() {
        try {
            $this->conn = new mysqli(
                getenv('DB_HOST'), 
                getenv('DB_USER'), 
                getenv('DB_PASS'), 
                getenv('DB_NAME')
            );
            $this->conn->set_charset("utf8mb4");
            if ($this->conn->connect_error) {
                throw new Exception("DB Ulanish xatosi: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('Database error');
        }
    }

    // --- API SO'ROVLARI ---
    public function request($method, $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function sendMessage($chat_id, $text, $keyboard = null) {
        $data = [
            'chat_id' => $chat_id, 
            'text' => $text, 
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true
        ];
        if ($keyboard) $data['reply_markup'] = $keyboard;
        return $this->request('sendMessage', $data);
    }

    public function answerCallback($id, $text = null, $alert = false) {
        return $this->request('answerCallbackQuery', [
            'callback_query_id' => $id,
            'text' => $text,
            'show_alert' => $alert
        ]);
    }

    // --- DATABASE MENEJMENT ---
    private function getUser($telegram_id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE telegram_id = ?");
        $stmt->bind_param("i", $telegram_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    private function registerUser($telegram_id, $username, $first_name) {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO users (telegram_id, username, first_name, balance) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("iss", $telegram_id, $username, $first_name);
        $stmt->execute();
        return $this->getUser($telegram_id);
    }

    // --- LOGIKA ---
    public function handleRequest() {
        $update = json_decode(file_get_contents('php://input'), true);
        
        if (!$update) {
            // Webhook o'rnatish uchun interfeys (HTML faqat browserda ochilganda chiqadi)
            $this->showWebInterface();
            return;
        }

        if (isset($update['message'])) {
            $this->processMessage($update['message']);
        } elseif (isset($update['callback_query'])) {
            $this->processCallback($update['callback_query']);
        }
    }

    private function processMessage($message) {
        $chat_id = $message['chat']['id'];
        $user_id = $message['from']['id'];
        $text = $message['text'] ?? '';
        $username = $message['from']['username'] ?? '';
        $name = $message['from']['first_name'] ?? '';

        $user = $this->getUser($user_id);
        if (!$user) {
            $user = $this->registerUser($user_id, $username, $name);
        }

        // Sessiyani tekshirish (Buyurtma jarayoni)
        if ($this->checkSession($chat_id, $text, $user)) return;

        // Buyruqlar
        switch ($text) {
            case '/start':
                $this->showMainMenu($chat_id, $name);
                break;
            case '📊 Xizmatlar':
                $this->showCategories($chat_id);
                break;
            case '💰 Balans':
                $this->showBalance($chat_id, $user);
                break;
            case '👤 Kabinet':
                $this->showProfile($chat_id, $user);
                break;
            case '/admin':
                if (in_array($user_id, $this->adminIds)) $this->showAdminPanel($chat_id);
                break;
            default:
                $this->showMainMenu($chat_id, $name);
        }
    }

    private function processCallback($callback) {
        $chat_id = $callback['message']['chat']['id'];
        $data = $callback['data'];
        $user_id = $callback['from']['id'];

        $this->answerCallback($callback['id']);

        if ($data === 'main_menu') {
            $this->request('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $callback['message']['message_id']]);
            $this->showMainMenu($chat_id, $callback['from']['first_name']);
        } elseif (strpos($data, 'cat_') === 0) {
            $cat_id = (int)str_replace('cat_', '', $data);
            $this->showServices($chat_id, $cat_id);
        } elseif (strpos($data, 'srv_') === 0) {
            $srv_id = (int)str_replace('srv_', '', $data);
            $this->startOrder($chat_id, $user_id, $srv_id);
        } elseif ($data === 'deposit') {
            $this->sendMessage($chat_id, "💳 Balans to'ldirish uchun @admin ga murojaat qiling.");
        }
    }

    // --- MENYULAR ---
    private function showMainMenu($chat_id, $name) {
        $keyboard = [
            'keyboard' => [
                [['text' => '📊 Xizmatlar'], ['text' => '💰 Balans']],
                [['text' => '👤 Kabinet'], ['text' => 'ℹ️ Yordam']]
            ],
            'resize_keyboard' => true
        ];
        $this->sendMessage($chat_id, "👋 Assalomu alaykum <b>$name</b>! SMM xizmatlariga xush kelibsiz.", $keyboard);
    }

    private function showCategories($chat_id) {
        $result = $this->conn->query("SELECT * FROM categories WHERE status=1 ORDER BY sort_order");
        $buttons = [];
        while ($row = $result->fetch_assoc()) {
            $buttons[] = [['text' => $row['name'], 'callback_data' => 'cat_' . $row['id']]];
        }
        $this->sendMessage($chat_id, "📂 Kerakli ijtimoiy tarmoqni tanlang:", ['inline_keyboard' => $buttons]);
    }

    private function showServices($chat_id, $cat_id) {
        $stmt = $this->conn->prepare("SELECT * FROM services WHERE category_id = ? AND status=1");
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $buttons = [];
        $text = "📋 <b>Mavjud xizmatlar:</b>\n\n";
        
        while ($row = $result->fetch_assoc()) {
            $price = number_format($row['price'], 0, '.', ' ');
            $text .= "🔸 <b>{$row['name']}</b>\n💰 Narx: {$price} so'm (1000 ta)\n🆔 ID: {$row['id']}\n\n";
            $buttons[] = [['text' => "🛒 " . $row['name'], 'callback_data' => 'srv_' . $row['id']]];
        }
        $buttons[] = [['text' => "⬅️ Orqaga", 'callback_data' => 'main_menu']];
        
        $this->sendMessage($chat_id, $text, ['inline_keyboard' => $buttons]);
    }

    private function showBalance($chat_id, $user) {
        $balance = number_format($user['balance'], 2, '.', ' ');
        $keyboard = ['inline_keyboard' => [[['text' => "💳 To'ldirish", 'callback_data' => 'deposit']]]];
        $this->sendMessage($chat_id, "💰 <b>Sizning balansingiz:</b> {$balance} so'm", $keyboard);
    }

    private function showProfile($chat_id, $user) {
        $orders = $this->conn->query("SELECT COUNT(*) as cnt FROM orders WHERE user_id = {$user['id']}")->fetch_assoc()['cnt'];
        $text = "👤 <b>Kabinet</b>\n\n🆔 ID: <code>{$user['telegram_id']}</code>\n👤 Ism: {$user['first_name']}\n📦 Buyurtmalar: {$orders} ta";
        $this->sendMessage($chat_id, $text);
    }

    // --- BUYURTMA TIZIMI ---
    private function startOrder($chat_id, $user_id, $service_id) {
        $stmt = $this->conn->prepare("INSERT INTO user_sessions (user_id, action, data) VALUES (?, 'ordering', ?) ON DUPLICATE KEY UPDATE action='ordering', data=?");
        $json = json_encode(['sid' => $service_id]);
        $stmt->bind_param("iss", $user_id, $json, $json);
        $stmt->execute();

        $this->sendMessage($chat_id, "🔗 Iltimos, havola (link) va miqdorni quyidagi formatda yuboring:\n\n<code>https://link.com 1000</code>\n\n❌ Bekor qilish uchun /cancel deb yozing.");
    }

    private function checkSession($chat_id, $text, $user) {
        if ($text == '/cancel') {
            $this->conn->query("DELETE FROM user_sessions WHERE user_id = {$user['id']}");
            $this->sendMessage($chat_id, "🛑 Jarayon bekor qilindi.");
            return true;
        }

        $res = $this->conn->query("SELECT * FROM user_sessions WHERE user_id = {$user['id']}");
        if ($res->num_rows == 0) return false;

        $session = $res->fetch_assoc();
        if ($session['action'] == 'ordering') {
            $this->processOrder($chat_id, $text, $user, json_decode($session['data'], true));
            return true;
        }
        return false;
    }

    private function processOrder($chat_id, $text, $user, $data) {
        $parts = explode(' ', trim($text));
        if (count($parts) < 2) {
            $this->sendMessage($chat_id, "⚠️ Format noto'g'ri. Iltimos qaytadan urinib ko'ring:\n`Link Miqdor`");
            return;
        }

        $link = $parts[0];
        $quantity = (int)$parts[1];
        $service_id = $data['sid'];

        $stmt = $this->conn->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->bind_param("i", $service_id);
        $stmt->execute();
        $service = $stmt->get_result()->fetch_assoc();

        if ($quantity < $service['min_quantity'] || $quantity > $service['max_quantity']) {
            $this->sendMessage($chat_id, "⚠️ Miqdor xato! Minimal: {$service['min_quantity']}, Maksimal: {$service['max_quantity']}");
            return;
        }

        $cost = ($service['price'] / 1000) * $quantity;

        if ($user['balance'] < $cost) {
            $this->sendMessage($chat_id, "❌ Mablag' yetarli emas. Kerak: " . number_format($cost) . " so'm");
            return;
        }

        // Tranzaksiya
        $this->conn->begin_transaction();
        try {
            $this->conn->query("UPDATE users SET balance = balance - $cost WHERE id = {$user['id']}");
            
            $stmt = $this->conn->prepare("INSERT INTO orders (user_id, service_id, link, quantity, price, status) VALUES (?, ?, ?, ?, ?, 'pending')");
            $stmt->bind_param("iisid", $user['id'], $service_id, $link, $quantity, $cost);
            $stmt->execute();
            $order_id = $stmt->insert_id;

            $this->conn->query("DELETE FROM user_sessions WHERE user_id = {$user['id']}");
            $this->conn->commit();

            $this->sendMessage($chat_id, "✅ <b>Buyurtma qabul qilindi!</b>\n🆔 ID: {$order_id}\n💰 Narx: " . number_format($cost) . " so'm\n⏳ Holat: Bajarilmoqda...");

            // Adminlarga xabar
            foreach ($this->adminIds as $aid) {
                $this->sendMessage($aid, "🆕 Yangi buyurtma!\nUser: @{$user['username']}\nXizmat: {$service['name']}\nSoni: $quantity\nLink: $link");
            }

        } catch (Exception $e) {
            $this->conn->rollback();
            $this->sendMessage($chat_id, "❌ Tizim xatosi yuz berdi. Keyinroq urinib ko'ring.");
        }
    }

    private function showWebInterface() {
        if (isset($_GET['setup'])) {
            $res = file_get_contents($this->apiUrl . "setWebhook?url=" . getenv('BASE_URL'));
            echo "Webhook natijasi: " . $res;
            exit;
        }
        echo "<h1 style='font-family:sans-serif;text-align:center;margin-top:50px;'>🤖 SMM Bot Ishlamoqda</h1>";
        echo "<p style='text-align:center;'>Webhookni sozlash uchun <a href='?setup=1'>bu yerga bosing</a></p>";
    }
}

// Botni ishga tushirish
$bot = new SMMBot();
$bot->handleRequest();
?>
