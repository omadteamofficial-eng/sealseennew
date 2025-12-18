<?php
// Bot tokeningizni shu yerga yozing
$token = "8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk";

// Telegramdan kelayotgan xabarni qabul qilish
$update = json_decode(file_get_contents('php://input'));

if (isset($update->message)) {
    $chat_id = $update->message->chat->id;
    $text = $update->message->text;

    if ($text == "/start") {
        $reply = "Salom! Men Render hostingida muvaffaqiyatli ishlayapman.";
        
        // Telegram API orqali javob yuborish
        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($reply);
        
        // cURL orqali so'rov yuborish (Renderda xavfsizroq usul)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
    }
}

// Render botni "uyg'oq" deb hisoblashi uchun har doim OK qaytarish kerak
http_response_code(200);
echo "Bot is running...";
