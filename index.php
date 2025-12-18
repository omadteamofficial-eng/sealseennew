<?php
$token = "8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk";
$data = file_get_contents("php://input");
$update = json_decode($data, true);

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];

    if ($text == "/start") {
        $url = "https://api.telegram.org/bot$token/sendMessage";
        $params = [
            'chat_id' => $chat_id,
            'text' => "Salom! Men Renderda ishlayapman."
        ];
        
        // cURL orqali yuborish (bu usul ishonchliroq)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}

// Render uchun "OK" javobini qaytarish shart
http_response_code(200);
echo "OK";
