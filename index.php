<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Tashkent");
define('UzBuilder','8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk');
$time = date('H:i');
$sana = date('d.m.Y');
/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
kodda xato kamchilik bot tuzatib olasilar!
MANBA @UzBuilder Manba Bilan Ol*/
$administrator = "8125289524";
$saytmm = "m2708.myxvest.ru/TexKons";
$UzBuilder = "SULTANOVXZBOT";
$reknomi = "Bizning Korporatsiyamiz";
$botidisi = "8398800703";
$botkanali = "@seal_seen";


function bot($method,$steps=[]){
$url = "https://api.telegram.org/bot".UzBuilder."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$steps);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}

function del($dir){
$ffs = scandir($dir);
foreach($ffs as $ff){
if($ff !='.' and $ff !='..'){
if(file_exists("$dir/$ff")){
unlink("$dir/$ff");
rmdir($dir);
}

if(is_dir($dir.'/'.$ff)){
del($dir.'/'.$ff);
rmdir($dir);
}     
}
rmdir($dir);
}
}
/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
MANBA @UzBuilder Manba Bilan Ol*/
$type = $message->chat->type;

function joinchat($chatid){
    global $mid;
    $result = bot('getChatMember',[
    'chat_id'=>"@MyMaxUz",
    'user_id'=>$chatid,
    ]);
    $results = bot('getChatMember',[
    'chat_id'=>"@iUzbekDev",
    'user_id'=>$chatid,
    ]);
$results1 = bot('getChatMember',[
    'chat_id'=>"@MyMaxUz",
    'user_id'=>$chatid,
    ]);
$stat = $result->result->status;
$stat1 = $results->result->status;
$stat2 = $results1->result->status;
if($stat=="left"){
$res1="❌";
}else{
$res1="✅";
} 

if($stat1=="left"){
$res11="❌";
}else{
$res11="✅";
}

if($stat2=="left"){
$res111="❌";
}else{
$res111="✅";
}

if($stat3=="left"){
$res1111="❌";
}else{
$res1111="✅";
}

         if((($stat=="creator" or $stat=="administrator" or $stat=="member") and ($stat1=="creator" or $stat1=="administrator" or $stat1=="member") and ($stat2=="creator" or $stat2=="administrator" or $stat2=="member"))){
        return true;
    } else {
        bot('sendMessage',[
        'chat_id'=>$chatid,
        'text'=>"⛔️ <b>Botdan to'liq foydalanish uchun</b> quyidagi kanallarga obuna bo'ling:",
'parse_mode'=>'html',
"reply_to_message_id"=>$mid,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"$res1 Yangiliklar🔊","url"=>"https://t.me/seal_seen"],],
[["text"=>"$res11 Homiy","url"=>"https://t.me/SULTANOVCHANNEL"],],
[['text'=>"🔄 Tekshirish",'callback_data'=>"tekshir"]],
]
]),
]); 
        return false;
    }
}




$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$data = $callback->data;

$callback = $update->callback_query;





$timeuzb = date("H:i");
$timeusa = date("H:i",strtotime("-1 hour"));
$timerus=date("H:i",strtotime("-2 hour"));
$timebra=date("H:i",strtotime("-8 hour"));
$timepor=date("H:i",strtotime("-4 hour"));
$timedub=date("H:i",strtotime("-1 hour"));
$timearb=date("H:i",strtotime("-2 hour"));
$timeisp=date("H:i",strtotime("-3 hour"));
$timeger=date("H:i",strtotime("-3 hour"));
$timeqir=date("H:i",strtotime("1 hour"));
$timeyap=date("H:i",strtotime("4 hour"));


$contact = $message->contact;
$phonenumber = $contact->phone_number;
$update = json_decode(file_get_contents('php://input'));
$callback = $update->callback_query->data;
$callcid = $update->callback_query->message->chat->id;
$callmid = $update->callback_query->message->message_id;
$message = $update->message;
$data = $update->callback_query->data;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$cid = $message->chat->id;
$uid = $message->from->id;
$cmid = $update->callback_query->message->message_id;
$name = $message->chat->first_name;
$step = file_get_contents("baza/$cid/$cid.txt");
$blocks = file_get_contents("data/blocks.txt");
$holat = file_get_contents("data/bot.txt");
$kanal = file_get_contents("data/kanal.txt");
$channel = file_get_contents("data/channel.txt");
$taklif = file_get_contents("data/taklif.txt");
$minimal = file_get_contents("data/minimal.txt");
$jrasmj = file_get_contents("bonus/bonss.txt");
$vtikkk = file_get_contents("bonus/bons.tikk");

$surname = $message->chat->last_name;
$username = $message->chat->username;
$bio = $message->chat->bio;

$pulll = file_get_contents("data/minimallll.txt");
$pullll = file_get_contents("data/minimalllll.txt");

$minimall = file_get_contents("data/minimall.txt");
$minimalll = file_get_contents("data/minimalll.txt");
$bbonus = file_get_contents("bonus/bons.soni");
$statistika = file_get_contents("data/statistika.txt");
$statistikak = file_get_contents("data/statistika.kun");
$getids = file_get_contents("data/users.txt");
$pul = file_get_contents("baza/$cid/pul.txt");
$referal = file_get_contents("baza/$cid/referal.txt");
$number = file_get_contents("baza/$cid/number.txt");
$bot = bot('getme',['bot'])->result->username;
$text = $message->text;
$back = "◀️ Ortga";
$admins = file_get_contents("data/admins.txt");
$admin = array($administrator,$admins);



$step = file_get_contents("step/$cid/$cid.txt");
$blocks = file_get_contents("data/blocks.txt");
$holat = file_get_contents("data/bot.txt");
$kanal = file_get_contents("data/kanal.txt");
$channel = file_get_contents("data/channel.txt");
$statistika = file_get_contents("data/statistika.txt");
$admins = file_get_contents("data/admins.txt");
$administrator = "5844316324";
$admin = array($administrator,$admins);

mkdir("data");
mkdir("step");
mkdir("step/$cid");
mkdir("baza/$cid");

if($text == "🌎Dunyo soatlari"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"🇺🇿 O'zbekiston: $timeuzb
➖➖➖➖➖➖➖➖
🇺🇸 AQSH: $timeusa
➖➖➖➖➖➖➖➖
🇧🇷 Braziliya: $timebra
➖➖➖➖➖➖➖➖
🇵🇹 Portugaliya: $timepor
➖➖➖➖➖➖➖➖
🇸🇦 Saudiya Arabistoni: $timearb
➖➖➖➖➖➖➖➖
🇪🇸 Ispaniya: $timeisp
➖➖➖➖➖➖➖➖
🇦🇪 Dubay: $timedub
➖➖➖➖➖➖➖➖
🇯🇵 Yaponiya: $timeyap
➖➖➖➖➖➖➖➖
🇷🇺 Rossiya: $timerus
➖➖➖➖➖➖➖➖
🇩🇪 Germaniya: $timeger
@$bot - orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


$data = $update->callback_query->data;







if($text == "🕋 Arafa Tabrigi"){
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/40",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/41",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/42",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/43",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/44",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/45",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/46",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/47",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/48",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/49",
'caption'=>"
Rasm @$bot orqali topildi ✅",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
}




if($text=="/speed"){
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"
 ☇<b>🔍</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'🔍'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'Loading!.'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!..'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!...'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!....'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'✅'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'□□□□□ 0%'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■□□□□ 20%'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■□□□ 40%'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■□□ 60%'
]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■□ 80%'
 ]);
 sleep(0.8);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■■ 100%'
 ]); 
 }





$reply = $message->reply_to_message->text;
$nomer = $message->contact->phone_number;

$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);

mkdir("data");
mkdir("baza");
mkdir("baza/$cid");

$home = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕Yangi bot ochish"]],
[['text'=>"⚡ Maxsus boʻlim"],['text'=>"🆕️Universal bo'lim"],],
[['text'=>"💸 Pul Ishlash"],['text'=>"💳 Hisobim"]],
[['text'=>"🧑🏻‍💻 Admin"],['text'=>"💳 Tuldirish"]],
[['text'=>"📚Qo'llanma va Qoidalar"],],
]
]);






$botlarimhammasi = json_encode([
'inline_keyboard'=>[
[['text'=>"🚀 Arzon botlar| $minimal so'm | 9-xil","callback_data"=>"botimarzon:1"]],
[['text'=>"💸 Pullik botlar | $minimall so'm | 7-xil","callback_data"=>"botimpullik:1"]],
[['text'=>"🧑🏻‍💻 Maxsus botlar | $minimalll so'm | 1-xil","callback_data"=>"botimmaxsus:1"]],
[['text'=>"$back","callback_data"=>"menu11:1"]],
]
]);






if($text == "🕋Juma Tabrigi"){
file_put_contents("step/$cid/$cid.txt","juma");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b> O'zingizni ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "juma"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://m2708.myxvest.ru/UzBuilder/juma1/api.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan Ism: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}

if($text == "🕋Hayit Tabrigi"){
file_put_contents("step/$cid/$cid.txt","hayit");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b> O'zingizni ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "hayit"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/hayit/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan Ism: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}

if($text == "💳 Tuldirish" and joinchat($cid)==true){
    bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=>"💳 Tuldirish usulini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
           [['text'=>"💠 Click ",'callback_data'=>"tolov2:1"],['text'=>"🌟 Payme Card",'callback_data'=>"tolov_paynet"]],
]
])
]);
}

if(mb_stripos($callback, "tolov_paynet")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"💳To'lov tizimi: PAYME

🌟 Payme Card: <code>2505019934528254</code>

📝Izoh: <code>$callcid</code>

❗Izoh yozish shart.
To'lov cheki adminga xabar buyrug'i yordamida adminga jo'natilsin!

Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «☎️ Bog'lanish» tugmasini bosing; 
3) Qancha pul miqdoni yuborganingizni va to'lov amalga oshirilgan vaqtni yozib yuboring.
4)⏳Kuting va hisobingizga pul tushadi.",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 Admin",'url'=>"tg://user?id=$administrator"],],
[['text'=>"☎️ Bog'lanish ","callback_data"=>"admin3:1"]],
[['text'=>"⏪ Orqaga","callback_data"=>"menu13:7"]],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text == "🕋Arafa Tabrigi"){
file_put_contents("step/$cid/$cid.txt","Arafa");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b> O'zingizni ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "Arafa"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/arafa/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan Ism: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}



$call = $update->callback_query;
$mes = $call->message;
$data = $call->data;






$bolimim = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🌎Dunyo soatlari"],['text'=>"🕋Juma Tabrigi"],],
[['text'=>"🇺🇿Telegram Til🇺🇸🇷🇺"],['text'=>"🌠 Telegram fon 🌠"],],
[['text'=>"💬 Text to speak"],['text'=>"🚘Avto Raqam"],],
[['text'=>"◀️ Ortga"],],
]
]);


if($text == "🌠 Telegram fon 🌠"){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>Siz Telegram ilovangizni qaysi fonga o'zgartirmoqchisiz ?</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Bmw fon",'url'=>"https://t.me/bg/aLBLuMfyCUsEAAAA9n3N0xRCuwo"],],
[['text'=>"Bezak fon",'url'=>"https://t.me/bg/FZla3e-CyEkBAAAAMwmoy6WarGY"],],
[['text'=>"City fon",'url'=>"https://t.me/bg/XorADb5a2EkBAAAAINKBVJtUxqo"],],
[['text'=>"Yashil fon",'url'=>"https://t.me/bg/CiwwsoTP-VEBAAAAmDYEizr71BQ"],],
[['text'=>"Hi-tech home fon",'url'=>"https://t.me/bg/jBen_AFVwUpJAAAA3Ybd3Z-qCSQ"],],
[['text'=>"IPhone fon",'url'=>"https://t.me/bg/Z4wGEfQLmUmYAAAARaGmMPqVJaY"],],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


if($text == "◾QR Code"){
file_put_contents("step/$cid/$cid.txt","qr");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 QR Code uchun soʻz yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "qr"){
unlink("step/$cid/$cid.txt");
bot('sendAudio',[
'chat_id'=>$cid,
'audio'=>"https://apis.xditya.me/qr/gen?text=$text",
'caption'=>"<b>QR Code tayyor!
Rasm @$bot orqali yasaldi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}

if($text!= "/start" and $text!= $back and $step == "speak"){
unlink("step/$cid/$cid.txt");
bot('sendAudio',[
'chat_id'=>$cid,
'audio'=>"https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl=ar&q=$text",
'caption'=>"<b>💬 Ovozli xabar tayyor!
✍️ Ovozli xabar @$bot orqali yasaldi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}




$avtoraqam = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Rols Roys"],['text'=>"Gentra"],],
[['text'=>"Lamborjini"],['text'=>"Bmw"],],
[['text'=>"Mers"],],
[['text'=>"$back"],],
]
]);

/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
MANBA @UzBuilder Manba Bilan Ol*/

if($text == "🕋Ramazon Tabrik"){
file_put_contents("step/$cid/$cid.txt","ramazon");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni Yuboring✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "ramazon"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/Ramadan/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan ism: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


if($text!= "/start" and $text!= $back and $step == "ramazon"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/Ramadan2/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan ism: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


if($text == "➕Yangi bot ochish"){
	if(joinchat($cid)==true){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🚀 Arzon botlar| $minimal so'm | 9-xil","callback_data"=>"botimarzon:1"]],
[['text'=>"💸 Pullik botlar | $minimall so'm | 7-xil","callback_data"=>"botimpullik:1"]],
[['text'=>"🧑🏻‍💻 Maxsus botlar | $minimalll so'm | 1-xil","callback_data"=>"botimmaxsus:1"]],
[['text'=>"⏪ Orqaga","callback_data"=>"menu13:7"]],
]
])
]);
}
}





if($text == "Lamborjini"){
file_put_contents("step/$cid/$cid.txt","lambo");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Namuna 01|A777AA shunday yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "lambo"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/lamborjini/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan raqam: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}

if($text == "Mers"){
file_put_contents("step/$cid/$cid.txt","mers");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Namuna 01|A777AA shunday yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "mers"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/mers/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan raqam: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


if($text == "Bmw"){
file_put_contents("step/$cid/$cid.txt","bmw");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Namuna 01|A777AA shunday yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "bmw"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/BMW/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan raqam: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}



$ishla = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔗 Referal"],],
[['text'=>"◀️ Ortga"],],
]
]);

if($text == "🇺🇿Telegram Til🇺🇸🇷🇺"){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>Siz Telegram ilovangizni qaysi tilga o'zgartirmoqchisiz</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🇺🇿Uzbek tili",'url'=>"tg://setlanguage?lang=uz-beta"],],
[['text'=>"🇺🇿Узбек тили",'url'=>"tg://setlanguage?lang=uzbekcyr"],],
[['text'=>"🇷🇺Русский язык",'url'=>"tg://setlanguage?lang=ru"],],
[['text'=>"🇺🇸 English language",'url'=>"tg://setlanguage?lang=en"],],
[['text'=>"🇹🇷Turkiye Dili",'url'=>"tg://setlanguage?lang=tr"],],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}


$pull = file_get_contents("data/minimallll.txt");
$jrasm = file_get_contents("bonus/bonuss.txt");

if(mb_stripos($callback, "konspekt:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","konsekt");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"✍️ Konspekt yozish uchun soʻz yuboring!✍️",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b>Siz Rasm yaratishingiz uchun hisobingizda kamida $pulll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}




if($step == "konsekt" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");


$rrrr = file_get_contents("baza/$cid/rasmmm.txt");

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pulll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");

bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://apis.xditya.me/write?text=$text",
'caption'=>"✅*RASM TAYYOR✅

👤Siz [ $text ] yozdingiz*✍️

*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}








$bepul = json_encode([
'inline_keyboard'=>[
[['text'=>"📝 File name bot  ","callback_data"=>"bot:2"],],
[['text'=>"🛠 Nik bot  ","callback_data"=>"bot:3"],['text'=>"🎛 Webhook bot  ","callback_data"=>"bot:4"],],
[['text'=>"📂 Convertor bot ","callback_data"=>"bot:1"],['text'=>"💬 Aloqa bot  ","callback_data"=>"bot:9"],],[['text'=>"✍️ Ovoz bot  ","callback_data"=>"bot:10"],['text'=>"📸 Rasmchi bot  ","callback_data"=>"bot:5"],],[['text'=>"📹 Harfga video bot  ","callback_data"=>"bot:6"],['text'=>"📖 Konspekt bot  ","callback_data"=>"bot:7"]],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
]);

$pulik = json_encode([
'inline_keyboard'=>[
[['text'=>"⛅Ob-havo bot ","callback_data"=>"bott:18"]],
[['text'=>"👮🏻 Nazoratchi bot ","callback_data"=>"bott:14"],
['text'=>"🖤 Down bot Tik Tok","callback_data"=>"bott:8"],],
[['text'=>"💰 Pul bot  ","callback_data"=>"bott:11"],['text'=>"💰 Rubl bot  ","callback_data"=>"bott:12"],],
[['text'=>"🌟Kanal 🤖Majburiy a'zo bot","callback_data"=>"bott:16"],['text'=>"🗑️Kirdi Chiqdi Tozalovchi bot","callback_data"=>"bott:17"],],[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
]);

$maxx = json_encode([
'inline_keyboard'=>[
[['text'=>"🤖Maker bot  ","callback_data"=>"bottt:13"]],[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
]);




$vipp = json_encode([
'inline_keyboard'=>[
[['text'=>"🔍Rasm izlash","callback_data"=>"rasm_iz:2"],['text'=>"🌟Nik yasash 📝","callback_data"=>"nik_all:1"]],
[['text'=>"🖤 Tik Tok Video yuklash","callback_data"=>"tik_tok1:4"],['text'=>"✍Konsekt yozish","callback_data"=>"konspekt:1"]],
[['text'=>"📸Rasm Yasash (6-xil)","callback_data"=>"avatarkam:1"],['text'=>"🆔️orqali topish","callback_data"=>"Idtopish:1"],],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
]);


if($text ==  "🌟Siz Uchun Maxsus"){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>Siz Uchun Maxsus Saytlar 👇</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 1-sayt",'url'=>"https://u8695.xvest2.ru/sitecreator/id/$cid/2"],],
[['text'=>"👨‍💻 2-sayt",'url'=>"https://u8695.xvest2.ru/sitecreator/id/$cid/3"]],
[['text'=>"👨‍💻 3-sayt",'url'=>"https://u8695.xvest2.ru/sitecreator/id/$cid/4"],],
[['text'=>"👨‍💻 3-sayt",'url'=>"https://u8695.xvest2.ru/sitecreator/id/$cid/5"],],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}





$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📊 Statistika"]],
[['text'=>"📝 Pochta tizimi"],['text'=>"📢 Kanallar boshqaruvi"],],
[['text'=>"🔐 Blok tizimi"],['text'=>"⚙ Bot sozlamalari"],],
[['text'=>"📋 Adminlar boshqaruvi"],['text'=>"💰 Balans boshqaruvi"],],
[['text'=>"$back"],],
]
]);

$message_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💬 Forward xabar yuborish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$channel_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📢 Kanal qoʻshish"],['text'=>"📢 Kanalni oʻchirish"],],
[['text'=>"📋 Kanallar roʻyxati"],['text'=>"📋 Kanallar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$blok_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Blokdan olish"],['text'=>"❌ Bloklash"],],
[['text'=>"📋 Bloklanganlar roʻyxati"],['text'=>"📋 Bloklanganlar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$bot_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);




$bots = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🚀 Arzon botlar"],['text'=>"💸 Pullik botlar"],],
[['text'=>"🧑🏻‍💻 Maxsus botlar"]],
[['text'=>"◀️ Ortga"],],
]
]);




$admins_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"➕ Admin qoʻshish"],['text'=>"🛑 Adminlikdan olish"],],
[['text'=>"📋 Adminlar roʻyxati"],['text'=>"📋 Adminlar roʻyxatini oʻchirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);

$balans_manager = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💾 Foydalanuvchi maʼlumotlari"],],
[['text'=>"💰 Pul berish"],['text'=>"💰 Pul ayirish"],],
[['text'=>"👥 Taklif narxi"],['text'=>"💸 Botlar Narxi"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);



$botnn = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Arzon botlar"],],[['text'=>"pullik botlar"]],[['text'=>"Maxsus botlar"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
]);


$ortga = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$back"],],
]
]);

if(!file_exists("data/taklif.txt")){
file_put_contents("data/taklif.txt","100");
}

if(!file_exists("data/minimal.txt")){
file_put_contents("data/minimal.txt","1000");
}

if(isset($message)){
$get = file_get_contents("data/statistika.txt");
if(mb_stripos($get,$uid)==false){
file_put_contents("data/statistika.txt", "$get\n$uid");
file_put_contents("baza/$cid/pul.txt", "0");
file_put_contents("baza/$cid/referal.txt", "0");


$odamk = file_get_contents("data/statistika.kun");
$bh = $odamk+1;
file_put_contents("data/statistika.kun","$bh");
}
}






if(in_array($cid,$admin)){}
elseif(mb_stripos($blocks, $uid)!==false){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>⚠️ Kechirasiz <a href = 'tg://user?id=$cid'>$name</a>

📛 Siz botdan bloklangansiz!

👨🏻‍💻 Blokdan chiqish uchun bot administratoriga murojaat qiling!</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 Administrator",'url'=>"tg://user?id=$administrator"],],
]
])
]);
return false;
}

if(in_array($cid,$admin)){}
elseif($holat == "off"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"<b>🛠 Texnik xizmat davom etmoqda!

▪ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
▪ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
▪ Barcha funksiyalar tugallangandan keyin tiklanadi.

🔰 Agar siz ushbu botning administratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin!
👉👨🏻‍💻 Boshqaruv paneli | ⚙ Bot sozlamalari.

📝 Boshqalar uchun:
ℹ️ Keyinroq qaytib keling va bot holatini tekshirish uchun /start tugmasini bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
return false;
}

if(mb_stripos($text,"/start $cid")!==false){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>❌ Siz botga o‘zingizni taklif qila olmaysiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
$idref = "data/id.txt";
$idref2 = file_get_contents($idref);
$id = "$cid\n";
$handle = fopen($idref, 'a+');
fwrite($handle, $id);
fclose($handle);
if(mb_stripos($idref2,$cid) !== false ){
}else{
$pub = explode(" ",$text);
$ex = $pub[1];
$hisob = file_get_contents("baza/$ex/pul.txt");
$a = $hisob+$taklif;
file_put_contents("baza/$ex/pul.txt","$a");
$odam = file_get_contents("baza/$ex/referal.txt");
$b = $odam+1;
file_put_contents("baza/$ex/referal.txt","$b");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Siz botimizga birinchi bor tashrif buyurdingiz! ✅</b>", 
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
bot('sendMessage',[
'chat_id'=>$botkanali,
'text'=>"<a href = 'tg://user?id=$cid'>$name</a>", 
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
bot('sendMessage',[
'chat_id'=>$ex,
'text'=>"<b>💥 Siz do‘stingizni taklif qildingiz sizga $taklif soʻm taqdim etildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}



if($text == "$back"){
unlink("baza/$cid/number.txt");
unlink("baza/$cid/$cid.txt");
unlink("baza/$cid/id.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b><u>🖥 Asosiy menyudasiz",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}




if($text == "/start" or $text == $back){
unlink("baza/$cid/number.txt");
unlink("baza/$cid/$cid.txt");
unlink("baza/$cid/id.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💎Salom <a href = 'tg://user?id=$cid'>$name</a>

<a href = 'tg://user?id=$botidisi'>͜᷼͜᷼͡͝͡͝@TezKonsBot</a>ga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}




if(mb_stripos($callback, "bulimlar1:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Oʻzingizga kerakli boʻlgan boʻlimni tanlang 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$bul11,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}



$photo = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"1-rasm"],['text'=>"2-rasm"],['text'=>"3-rasm"],],
[['text'=>"4-rasm"],['text'=>"5-rasm"],['text'=>"6-rasm"],],
[['text'=>"$back"],],
]
]);


if($text == "1-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm1");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm1"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Yigitlar/1/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}

if($text == "2-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm2");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm2"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Yigitlar/2/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}

if($text == "3-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm3");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm3"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Yigitlar/3/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}

if($text == "4-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm4");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm4"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Qizlarga/3/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}

if($text == "5-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm5");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm5"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Qizlarga/2/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}


if($text == "6-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm6");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm6"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://u8481.xvest6.ru/Apilar/Fildirbot/Qizlarga/1/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}


if($text == "7-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm7");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm7"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Yigitlar/2/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}

if($text == "8-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm8");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm8"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Yigitlar/3/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}

if($text == "9-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm9");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm9"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Yigitlar/4/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}


if($text == "10-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm10");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm10"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Qizlarga/1/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}

if($text == "11-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm11");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm11"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Qizlarga/2/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}
/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
MANBA @UzBuilder Manba Bilan Ol*/

if($text == "12-rasm"){
file_put_contents("step/$cid/$cid.txt","rasm12");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ismingizni yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rasm12"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apilar.uz/1/Qizlarga/3/2.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Ismingiz: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$photo22,
]);
}




if($text == "Rols Roys"){
file_put_contents("step/$cid/$cid.txt","rols");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Namuna 01|A777AA shunday yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "rols"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚡ Tayyorlanmoqda...</b>",
'parse_mode'=>'html'
]);
bot('deletemessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/rolsroys/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan raqam: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$avtoraqam,
]);
}


if($text == "Gentra"){
file_put_contents("step/$cid/$cid.txt","gentra");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Namuna 01|A777AA shunday yuboring ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($text!= "/start" and $text!= $back and $step == "gentra"){
unlink("step/$cid/$cid.txt");
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://apidev.cf/apps/Gentra/code.php?text=$text",
'caption'=>"<b>📃 Buyurtmangiz tayyor bo‘ldi!😉

✍️ Siz yozgan raqam: $text

❤️ Tayyorlovchi: @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$avtoraqam,
]);
}






if($text == "🛠️ Bot yaratish"){
	if(joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bots,
]);
}
}
if($text == "💸 Pul ishlash"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Pul ishlash uchun turini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ishla,
]);
}




if($text == "🚀 Arzon botlar"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bepul,
]);
}




if($text == "🧑🏻‍💻 Maxsus botlar"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$maxx,
]);
}

if($text == "⚡ Maxsus boʻlim"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli boʻlimni tanlang 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$vipp,
]);
}

if($text == "🚘Avto Raqam"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli boʻlimni tanlang 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$avtoraqam,
]);
}



if($text == "🆕️Universal bo'lim"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli boʻlimni tanlang 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolimim,
]);
}

if(mb_stripos($callback, "avatarkam:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","avatarkam");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendPhoto', [
'chat_id'=>$callcid,
'photo'=>"https://t.me/TexBotimga/3",
'caption'=>"💎Sizga qaysi rasm kerak ",
'parse_mode'=>'html',
'reply_markup'=>$photo,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b>Siz Rasm yaratishingiz uchun hisobingizda kamida $pulll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}




$photo2 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"7-rasm"],['text'=>"8-rasm"],['text'=>"9-rasm"],],
/*[['text'=>"10-rasm"],['text'=>"11-rasm"],['text'=>"12-rasm"],],*/
[['text'=>"$back"],],
]
]);


if(mb_stripos($callback, "avatarkam2:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","avatarkam");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendPhoto', [
'chat_id'=>$callcid,
'photo'=>"https://t.me/TexBotimga/10",
'caption'=>"💎Sizga qaysi rasm kerak ",
'parse_mode'=>'html',
'reply_markup'=>$photo2,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b>Siz Rasm yaratishingiz uchun hisobingizda kamida $pulll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text == "💸 Pullik botlar"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$pulik,
]);
}

if(mb_stripos($callback, "bot:")!==false){
$explode = explode("bot:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$minimal){
file_put_contents("baza/$callcid/number.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","createbot");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>📄 Bot raqami: $explode

🤖Bot Turi Arzon botlar
📝 Dasturlash tili: PHP
💬 Bot tili: Oʻzbekcha
👨🏻‍💻 Boshqaruv paneli: Mavjud
💰 Bir martalik toʻlov: $minimal soʻm

<i>🤖 Bot ochishni davom ettirish uchun botingizni tokenini yuboring!</i></b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🔰 Siz bot yaratishingiz uchun hisobingizda kamida $minimal soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);

}
}


if($text!= "/start" and $text!= $back and $step == "createbot"){
if(mb_stripos($text, ":")!==false){
$botnumber = file_get_contents("baza/$cid/number.txt");
$getid = bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛠 Sizning botingiz yaratilmoqda...</b>",
'parse_mode'=>'html',
])->result->message_id;
$code = file_get_contents("bots/index$botnumber.php");
$code = str_replace("bot_token", "$text", $code);
$code = str_replace("admin_id", "$cid", $code);
mkdir("baza/$cid/bot$botnumber");
$status = file_put_contents("baza/$cid/bot$botnumber/index.php", $code);
$webhook = file_get_contents("https://api.telegram.org/bot$text/setwebhook?url=https://$saytmm/baza/$cid/bot$botnumber/index.php");
if($status and $webhook){
$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $minimal;
file_put_contents("baza/$cid/pul.txt","$miqdor");
$botscount = $getids + 1;
file_put_contents("data/users.txt","$botscount");
$user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>ℹ️ Botingiz tayyor!
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user?start"],],
]
])
]);
bot('sendMessage',[
'chat_id'=>$botkanali,
'text'=>"<b>ℹ️ Bot yaratildi! <a href = 'tg://user?id=$cid'>$name</a>
bot raqami $botnumber 
$username
<pre>$cid</pre>
🤖Bot Turi Arzon botlar
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user"],],
]
])
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}else{
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Xatolik yuz berdi iltimos keyinroq qayta urinib koʻring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$maker,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📛 Menimcha siz tokenni yuborishda xatolikka yoʻl qoʻydingiz!
🔰 Token toʻgʻriligiga ishonch hosil qilib qayta yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}



if(mb_stripos($callback, "bott:")!==false){
$explode = explode("bott:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$minimall){
file_put_contents("baza/$callcid/number.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","createbott");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>📄 Bot raqami: $explode

🤖Bot Turi Pullik Botlar
📝 Dasturlash tili: PHP
💬 Bot tili: Oʻzbekcha
👨🏻‍💻 Boshqaruv paneli: Mavjud
💰 Bir martalik toʻlov: $minimall soʻm

<i>🤖 Bot ochishni davom ettirish uchun botingizni tokenini yuboring!</i></b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🔰 Siz bot yaratishingiz uchun hisobingizda kamida $minimall soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text!= "/start" and $text!= $back and $step == "createbott"){
if(mb_stripos($text, ":")!==false){
$botnumber = file_get_contents("baza/$cid/number.txt");
$user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
$getid = bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛠 Sizning botingiz yaratilmoqda...</b>",
'parse_mode'=>'html',
])->result->message_id;
$code = file_get_contents("bots/index$botnumber.php");
$code = str_replace("bot_token", "$text", $code);

$code = str_replace("bot_namer04", "$user", $code);
$code = str_replace("admin_id", "$cid", $code);
mkdir("baza/$cid/bot$botnumber");
$status = file_put_contents("baza/$cid/bot$botnumber/index.php", $code);
$webhook = file_get_contents("https://api.telegram.org/bot$text/setwebhook?url=https://$saytmm/baza/$cid/bot$botnumber/index.php");
if($status and $webhook){
$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $minimall;
file_put_contents("baza/$cid/pul.txt","$miqdor");
$botscount = $getids + 1;
file_put_contents("data/users.txt","$botscount");
$user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>ℹ️ Botingiz tayyor!
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user?start"],],
]
])
]);
bot('sendMessage',[
'chat_id'=>$botkanali,
'text'=>"<b>ℹ️ Bot yaratildi! <a href = 'tg://user?id=$cid'>$name</a>
bot raqami $botnumber
$username
<pre>$cid</pre>
🤖Bot Turi Pullik Botlar
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user"],],
]
])
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}else{
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Xatolik yuz berdi iltimos keyinroq qayta urinib koʻring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$maker,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📛 Menimcha siz tokenni yuborishda xatolikka yoʻl qoʻydingiz!
🔰 Token toʻgʻriligiga ishonch hosil qilib qayta yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}


if(mb_stripos($callback, "bottt:")!==false){
$explode = explode("bottt:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=10000){
file_put_contents("baza/$callcid/number.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","createbottt");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>📄 Bot raqami: $explode

🤖Bot Turi Maxsus Botlar
📝 Dasturlash tili: PHP
💬 Bot tili: Oʻzbekcha
👨🏻‍💻 Boshqaruv paneli: Mavjud
💰 Bir martalik toʻlov: $minimalll soʻm

<i>🤖 Bot ochishni davom ettirish uchun botingizni tokenini yuboring!</i></b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🔰 Siz maker bot yaratishingiz hisobingizda $minimalll so'm bo'lishi kerak </b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text!= "/start" and $text!= $back and $step == "createbottt"){
if(mb_stripos($text, ":")!==false){
$botnumber = file_get_contents("baza/$cid/number.txt");
$getid = bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🛠 Sizning botingiz yaratilmoqda...</b>",
'parse_mode'=>'html',
])->result->message_id;
$code = file_get_contents("bots/index$botnumber.php");
$code1 = file_get_contents("botss/index1.php");
$code2 = file_get_contents("botss/index2.php");
$code3 = file_get_contents("botss/index3.php");
$code4 = file_get_contents("botss/index4.php");
$code5 = file_get_contents("botss/index5.php");
$code6 = file_get_contents("botss/index6.php");
$code7 = file_get_contents("botss/index7.php");
$code8 = file_get_contents("botss/index8.php");
$code9 = file_get_contents("botss/index9.php");
$code10 = file_get_contents("botss/index10.php");
$code11 = file_get_contents("botss/index11.php");
$code12 = file_get_contents("botss/index12.php");
$code = str_replace("dilshod", "$text", $code);
$code = str_replace("gggggg", "$cid", $code);
mkdir("baza/$cid/bot$botnumber");
mkdir("baza/$cid/bot$botnumber/bots");
file_put_contents("baza/$cid/bot$botnumber/bots/index1.php", $code1);
file_put_contents("baza/$cid/bot$botnumber/bots/index2.php", $code2);
file_put_contents("baza/$cid/bot$botnumber/bots/index3.php", $code3);
file_put_contents("baza/$cid/bot$botnumber/bots/index4.php", $code4);
file_put_contents("baza/$cid/bot$botnumber/bots/index5.php", $code5);
file_put_contents("baza/$cid/bot$botnumber/bots/index6.php", $code6);
file_put_contents("baza/$cid/bot$botnumber/bots/index7.php", $code7);
file_put_contents("baza/$cid/bot$botnumber/bots/index8.php", $code8);
file_put_contents("baza/$cid/bot$botnumber/bots/index9.php", $code9);
file_put_contents("baza/$cid/bot$botnumber/bots/index10.php", $code10);
file_put_contents("baza/$cid/bot$botnumber/bots/index11.php", $code11);
file_put_contents("baza/$cid/bot$botnumber/bots/index12.php", $code12);

$status = file_put_contents("baza/$cid/bot$botnumber/index.php", $code);

$webhook = file_get_contents("https://api.telegram.org/bot$text/setwebhook?url=https://$saytmm/baza/$cid/bot$botnumber/index.php");
if($status and $webhook){
$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $minimalll;
file_put_contents("baza/$cid/pul.txt","$miqdor");
$botscount = $getids + 1;
file_put_contents("data/users.txt","$botscount");
$user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>ℹ️ Botingiz tayyor!
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user?start"],],
]
])
]);
bot('sendMessage',[
'chat_id'=>$botkanali,
'text'=>"<b>ℹ️ Bot yaratildi! <a href = 'tg://user?id=$cid'>$name</a>
bot raqami $botnumber
$username
<pre>$cid</pre>
🤖Bot Turi Maxsus Botlar
🔰 Quyidagi tugma orqali botingizga oʻtishingiz mumkin</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➡️ Botga oʻtish", "url"=>"https://t.me/$user"],],
]
])
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}else{
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$getid,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Xatolik yuz berdi iltimos keyinroq qayta urinib koʻring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$maker,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📛 Menimcha siz tokenni yuborishda xatolikka yoʻl qoʻydingiz!
🔰 Token toʻgʻriligiga ishonch hosil qilib qayta yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
unlink("baza/$cid/number.txt");
unlink("step/$cid/$cid.txt");
}
}


if(mb_stripos($callback, "tolov2:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"💳To'lov tizimi: CLICK

⚫ Click: <code>8600060475596665</code>

📝Izoh: <code>$callcid</code>

❗Izoh yozish shart.
To'lov cheki adminga xabar buyrug'i yordamida adminga jo'natilsin!

Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «☎️ Bog'lanish» tugmasini bosing; 
3) Qancha pul miqdoni yuborganingizni va to'lov amalga oshirilgan vaqtni yozib yuboring.
4)⏳Kuting va hisobingizga pul tushadi.",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 Admin",'url'=>"tg://user?id=$administrator"],],
[['text'=>"☎️ Bog'lanish ","callback_data"=>"admin3:1"]],
[['text'=>"⏪ Orqaga","callback_data"=>"menu13:7"]],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}







if(mb_stripos($callback, "Idtopish:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","idtopish");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"Siz menga <u>Telegram </u><b>ID</b> jo'nating va men sizga u <b>ID</b> kimga tegishliligini topishda yordam beraman ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏪ Orqaga","callback_data"=>"menu13:7"]],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text!= "/start" and $text!= $back and $step == "idtopish"){
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"
<i>Pastdagi tugma orqali </i><b><a href = 'tg://user?id=$text'>$text</a> ID</b> <u> Kimga </u> <i>tegishliligini bilib oling</i>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$text",'url'=>"tg://user?id=$text"],],
]
])
]);
}

if(mb_stripos($callback, "botimarzon:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang! ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🛠 Nik bot  ","callback_data"=>"bot:3"],['text'=>"🎛 Webhook bot  ","callback_data"=>"bot:4"],],
[['text'=>"📂 Convertor bot ","callback_data"=>"bot:1"],['text'=>"💬 Aloqa bot  ","callback_data"=>"bot:9"],],[['text'=>"✍️ Ovoz bot  ","callback_data"=>"bot:10"],['text'=>"📸 Rasmchi bot  ","callback_data"=>"bot:5"],],[['text'=>"📹 Harfga video bot  ","callback_data"=>"bot:6"],['text'=>"📖 Konspekt bot  ","callback_data"=>"bot:7"]],
[['text'=>"📝 File name bot  ","callback_data"=>"bot:2"],['text'=>"$back","callback_data"=>"botlarim3:1"]],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Xato {ERROR} Adminga yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if(mb_stripos($callback, "botimpullik:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang! ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👮🏻 Nazoratchi bot ","callback_data"=>"bott:14"],
['text'=>"🖤 Down bot Tik Tok","callback_data"=>"bott:8"],],
[['text'=>"💰 Pul bot  ","callback_data"=>"bott:11"],['text'=>"💰 Rubl bot  ","callback_data"=>"bott:12"],],
[['text'=>"🌟Kanal 🤖Majburiy a'zo bot","callback_data"=>"bott:16"],['text'=>"🗑️Kirdi Chiqdi Tozalovchi bot","callback_data"=>"bott:17"],],
[['text'=>"⛅Ob-havo bot ","callback_data"=>"bott:18"],['text'=>"$back","callback_data"=>"botlarim3:1"]],
[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}









if(mb_stripos($callback, "botimmaxsus:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang! ",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖Maker bot  ","callback_data"=>"bottt:13"]],
[['text'=>"$back","callback_data"=>"botlarim3:1"]],[['text'=>"$reknomi",'url'=>"https://t.me/$UzBuilder"],],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}





if(mb_stripos($callback, "tik_tok1:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","rrrrt");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"<b>🖤Tik Tok Video havolasini yuboring! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan adminga yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}



$api = 'https://www.tikwm.com/api/';
$vidurl = $text;
$tikUrl = $vidurl;
$postData = [
'url' => $tikUrl,
'hd' => 0 
];

$response = curl_request($api . '?' . http_build_query($postData));
$obj = json_decode($response);
$video = $obj->data->play;
$music = $obj->data->music;
$likes = $obj->data->digg_count;
$comments = $obj->data->comment_count;
$views = $obj->data->play_count;
$posts = $obj->data->share_count;
$downloads = $obj->data->download_count;

function curl_request($url, $postData = [])
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_ACCEPTTIMEOUT_MS, 10000);
curl_setopt($curl, CURLOPT_ENCODING, 'gzip');

$response = curl_exec($curl);
return $response;
}

if($step == "rrrrt" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");

$music = file_get_contents("$music");
file_put_contents("step/$cid/@$bot.mp3","$music");
$music = file_get_contents("step/$cid/@$bot.mp3");

$tikk = file_get_contents("bonus/bons.tikk");
$tikk = $tikk + 1;
file_put_contents("bonus/bons.tikk","$tikk");

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
?? Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
bot('sendVideo',[
'chat_id'=>$cid,
'video'=>$video,
'caption'=>"<b>♥️ Likelar soni: $likes ta
✍️ Fikrlar soni: $comments ta
👁‍🗨 Koʻrishlar soni: $views ta
🔰 Postlar soni: $posts ta
🌐 Yuklashlar soni: $downloads ta

🤖 Yuklab berdi @$bot</b>",
'parse_mode'=>'html',
'reply_markup'=>$home
]);
bot('sendAudio',[
'chat_id'=>$cid,
'audio'=>new CURLFile("step/$cid/@$bot.mp3"),
'parse_mode'=>'html',
'reply_markup'=>$home
]);
unlink("step/$cid/$cid.txt");
unlink("step/$cid/@$bot.mp3");
}













if($text == "💳 Hisobim"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>
•💳 Hisobingiz: $pul soʻm
| 
•👤Takliflar: $referal nafar
|
•🆔 ID: <pre>$cid</pre>
| 
•📨 Usernameyingiz: @<code>$username</code>
|
•📋 Ismingiz: <code>$name</code>
|
•📋 Familyangiz: <code>$surname</code>
|
•⏰ Soat: $time | 📆 Sana: $sana 
| 
•🧑🏻‍💻Hisobni toʻldirish usulini tanlang 👇</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⚫ Click | 🔵 Payme","callback_data"=>"tolov2:1"],],
[['text'=>"👨‍💻Admin orqali",'url'=>"tg://user?id=$administrator"],],
]
])
]);
}

if($text == "💸 Pul Ishlash"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔗 Referal havolangiz:

👉 https://t.me/$bot?start=$cid

🎁 Do‘stingiz havola orqali ro‘yxatdan o‘tsa sizga $taklif soʻm beriladi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔗 Ulashish", "url"=>"https://t.me/share/url?url=https://t.me/$bot?start=$cid"]],
]
])
]);
}

if($text == "📊 Statistika"){
$get = substr_count($statistika,"\n");
$getids = $getids + 0;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>•📊@$bot statistika
|
•👥 Bot foydalanuvchilari: $get nafar
|
•🤖 Yaratilgan botlar soni: $getids ta
|
•🖤Tik Tok dan yuklangan video $vtikkk ta
|
•🎁Berilgan Kunlik bonus $bonus soʻm
|
•⏰ Soat: $time | 📆 Sana: $sana</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕Yangi bot ochish","callback_data"=>"botlarim3:1"]],
[['text'=>"👨‍💻 Admin",'url'=>"tg://user?id=$administrator"],['text'=>"💬 Bog'lanish",'callback_data'=>"admin3:1"],],
]
])
]);
}

if($text == "🧑🏻‍💻 Admin"){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>📞Texnik xizmat koʻrsatish uchun <a href = 'tg://user?id=$administrator'>Admin</a>ga murojat qiling 👈
Yoki spam bo'lsangiz bog'anish tugmasini bosing</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👨‍💻 Admin",'url'=>"tg://user?id=$administrator"],],
[['text'=>"💬Admin bilan shu yerda bog'lanish",'callback_data'=>"admin3:1"],],
]
])
]);
}

if($text == "👨🏻‍💻 Boshqaruv paneli"){
if(in_array($cid,$admin)){
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Boshqaruv paneliga xush kelibsiz!
 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Bu bo‘limni faqat bot administratori ishlata oladi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}



if($text == "/panel"){
if(in_array($cid,$admin)){
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Boshqaruv paneliga xush kelibsiz!
?? Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Bu bo‘limni faqat bot administratori ishlata oladi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}



if(in_array($cid,$admin)){
if($text == "📝 Pochta tizimi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 Pochta tizimi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$message_manager,
]);
}
}

if($text == "💬 Forward xabar yuborish"){
file_put_contents("step/$cid/$cid.txt","forward");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👥 Foydalanuvchilarga yuboriladigan xabarni forward qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
'disable_web_page_preview'=>true,
]);
}

if($step == "forward" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
unlink("step/$cid/$cid.txt");
$explode = explode("\n",$statistika);
foreach($explode as $id){
$forward = bot('forwardMessage',[
'chat_id' =>$id, 
'from_chat_id' =>$cid, 
'message_id' =>$mid, 
]);
}
}

if($forward){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👥 Forward xabaringiz barcha bot foydalanuvchilariga yuborildi!✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$message_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "📢 Kanallar boshqaruvi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📢 Kanallar boshqaruvi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📢 Kanal qoʻshish"){
file_put_contents("baza/$cid/$cid.txt","kanalll");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📡 Kanal qo‘shish uchun kanal havolasini yuboring!
🔰 Masalan: @UzBuilderTeam</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "kanalll" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(mb_stripos($kanal,"$text")!==false){
}else{
file_put_contents("data/kanal.txt","$kanal\n$text");
file_put_contents("data/channel.txt","true");
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📡 Kanalingiz botga muvaffaqiyatli qo‘shildi!
🤖 Endi botni kanalingizga admin qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📢 Kanalni oʻchirish"){
file_put_contents("baza/$cid/$cid.txt","delete");
$ids = explode("\n",$kanal);
$soni = substr_count($kanal,"@");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📡 Kanalni oʻchirish uchun kanal havolasini yuboring!

🔰 Masalan: @UzBuilderTeam

👇 Botga ulangan kanallar:
$kanal

📝 Jami kanallar soni: $soni ta
</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "delete" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(mb_stripos($kanal,"$text")!==false){
$k = str_replace("\n".$text."","",$kanal);
file_put_contents("data/kanal.txt",$k);
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 $text muvaffaqiyatli oʻchirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📋 Kanallar roʻyxati"){
if($kanal == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botga ulangan kanallar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Kanallar roʻyxati:
$kanal</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Kanallar roʻyxatini oʻchirish"){
if($kanal == null){
unlink("data/kanal.txt");
unlink("data/channel.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botga ulangan kanallar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}else{
unlink("data/kanal.txt");
unlink("data/channel.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Kanallar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$channel_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "🔐 Blok tizimi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔐 Blok tizimi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "✅ Blokdan olish"){
file_put_contents("baza/$cid/$cid.txt","unblock");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Blokdan olinadigan foydalanuvchini ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if(in_array($cid,$admin)){
if($step == "unblock" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
unlink("baza/$cid/$cid.txt");
if(mb_stripos($blocks, $text)==false){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Ushbu foydalanuvchi botdan bloklanmagan!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
$bl = str_replace("$text", " ", $blocks);
file_put_contents("data/blocks.txt", "$bl");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Foydalanuvchi blokdan olindi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🎉 Siz blokdan muvaffaqiyatli olindingiz!

🔄 Yana botni ishlatishingiz mumkin!

🤖 Botga qayta /start bosing ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "❌ Bloklash"){
file_put_contents("baza/$cid/$cid.txt","block");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🚫 Bloklanadigan foydalanuvchini ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if(in_array($cid,$admin)){
if($step == "block" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(mb_stripos($blocks, $text)==false){
file_put_contents("data/blocks.txt", "$blocks\n$text");
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰 Foydalanuvchi bloklandi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>🚫 Siz bizning botimizdan bloklandingiz!

🔄 Endi botdan foydalana olmaysiz!

👨‍💻 Blokdan chiqish uchun bot administratoriga murojaat qiling!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
}else{
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨🏻‍💻 Ushbu foydalanuvchi botdan allaqachon bloklangan!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Bloklanganlar roʻyxati"){
if($blocks == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar roʻyxati:
$blocks</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Bloklanganlar roʻyxatini oʻchirish"){
if($blocks == null){
unlink("data/blocks.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botdan bloklanganlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}else{
unlink("data/blocks.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Bloklanganlar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$blok_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "⚙ Bot sozlamalari"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙ Bot sozlamalari boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "💸 Botlar Narxi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚙ botlar narxi oʻzgartirish uchun 👇Tanlang</b>",
'parse_mode'=>'html',
'reply_markup'=>$botnn,
]);
}
}

if(in_array($cid,$admin)){
if($text == "✅ Botni yoqish"){
unlink("data/bot.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bot muvaffaqiyatli yoqildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "❌ Botni o‘chirish"){
file_put_contents("data/bot.txt","off");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Bot muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$bot_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar boshqaruvi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Adminlar boshqaruvi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "➕ Admin qoʻshish"){
file_put_contents("step/$cid/$cid.txt","setadmins");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Administrator qoʻshish uchun foydalanuvchi ID raqamini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "setadmins" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(is_numeric($text)){
if(mb_stripos($statistika,$text)!==false){
file_put_contents("data/admins.txt","$admins\n$text");
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi botga administrator qilib tayinlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz botga administrator qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Ushbu foydalanuvchi bazada mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("step/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 ID raqam kiritayotganda faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "🛑 Adminlikdan olish"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
file_put_contents("step/$cid/$cid.txt","deladmins");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👨‍💻 Administratorni olib tashlash uchun foydalanuvchi ID raqamini kiriting</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}
}

if($step == "deladmins" and $text!= "/start" and $text!= $back and $text!= "👨🏻‍💻 Boshqaruv paneli"){
if(is_numeric($text)){
if(mb_stripos($admins,$text)!==false){
unlink("step/$cid/$cid.txt");
$ad = str_replace("\n".$text."","",$admins);
file_put_contents("data/admins.txt",$ad);
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi bot administratorligidan olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"<b>👨‍💻 Siz bot administratorligidan olib tashlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 <a href = 'tg://user?id=$text'>$text</a> ID raqamli foydalanuvchi botda administrator emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}else{
unlink("baza/$cid/$cid.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 ID raqam kiritayotganda faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar roʻyxati"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Administratorlar roʻyxati:
$admins</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "📋 Adminlar roʻyxatini oʻchirish"){
if($admins == null){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>?? Botda administratorlar mavjud emas!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}else{
unlink("data/admins.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 Administratorlar roʻyxati muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$admins_manager,
]);
}
}
}

if(in_array($cid,$admin)){
if($text == "💰 Balans boshqaruvi"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Balans boshqaruvi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}
}

if(in_array($cid,$admin)){
if($text == "💾 Foydalanuvchi maʼlumotlari"){
file_put_contents("step/$cid/$cid.txt","verify");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📱 Foydalanuvchi ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "verify" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
$getpul = file_get_contents("baza/$text/pul.txt");
$getreferal = file_get_contents("baza/$text/referal.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Foydalanuvchi hisobi: $getpul soʻm
👤 Taklif qilgan odamlari: $getreferal nafar
🎯 ID raqami: <code>$cid</code>
⏰ Soat: $time | 📆Sana: $sana</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "💰 Pul berish"){
file_put_contents("step/$cid/$cid.txt","id");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📱 Foydalanuvchi ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "id" and $text!= "/start" and $text!= "$back"){
unlink("baza/$cid/$cid.txt");
file_put_contents("baza/$cid/id.txt","$text");
file_put_contents("step/$cid/$cid.txt","idpul");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Toʻldirmoqchi boʻlgan pul miqdorini kiriting! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($step == "idpul" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
$getid = file_get_contents("baza/$cid/id.txt");
$getpul = file_get_contents("baza/$getid/pul.txt");
$miqdor = $getpul+$text;
file_put_contents("baza/$getid/pul.txt","$miqdor");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 $getid ID raqamiga $text soʻm berildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
bot('sendMessage',[
'chat_id'=>$getid,
'text'=>"<b>💰 Hisobingiz $text soʻmga toʻldirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if(in_array($cid,$admin)){
if($text == "💰 Pul ayirish"){
file_put_contents("step/$cid/$cid.txt","minus_id");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📱 Foydalanuvchi ID raqamini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($text == "📸Rasm Yasash"){
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/my_telegram_baza/27",
'caption'=>"<b>💎Sizga qaysi rasm kerak </b>",
'parse_mode'=>'html',
'reply_markup'=>$pxoto,
]);
}

$pxoto = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"1-rasm"],['text'=>"2-rasm"],['text'=>"3-rasm"],],
[['text'=>"4-rasm"],['text'=>"5-rasm"],['text'=>"6-rasm"],],
[['text'=>"$back"],],
]
]);




if(mb_stripos($callback, "botlarim3:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🤖 Yaratmoqchi bo‘lgan botingiz turini tanlang!",
'parse_mode'=>'html',
'reply_markup'=>$botlarimhammasi,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}









if($step == "minus_id" and $text!= "/start" and $text!= "$back"){
unlink("baza/$cid/$cid.txt");
file_put_contents("baza/$cid/id.txt","$text");
file_put_contents("step/$cid/$cid.txt","minus_pul");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Ayirmoqchi boʻlgan pul miqdorini kiriting! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($step == "minus_pul" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
$getid = file_get_contents("baza/$cid/id.txt");
$getpul = file_get_contents("baza/$getid/pul.txt");
$miqdor = $getpul-$text;
file_put_contents("baza/$getid/pul.txt","$miqdor");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 $getid ID raqamidan $text soʻm ayirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
bot('sendMessage',[
'chat_id'=>$getid,
'text'=>"<b>💰 Hisobingizdan $text soʻm ayirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}

if(in_array($cid,$admin)){
if($text == "👥 Taklif narxi"){
file_put_contents("step/$cid/$cid.txt","taklif");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸 Taklif narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "taklif" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/taklif.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Taklif narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "Arzon botlar"){
file_put_contents("step/$cid/$cid.txt","minimal");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸 arzon Botlar narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "minimal" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/minimal.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Botlar narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "pullik botlar"){
file_put_contents("step/$cid/$cid.txt","minimall");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸 pullik botlar   Botlar narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "minimall" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/minimall.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 pullik  Botlar narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}


if(in_array($cid,$admin)){
if($text == "Rasm narxi"){
file_put_contents("step/$cid/$cid.txt","rrrrrrrr");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸 rasm narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "rrrrrrrr" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/minimallll.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>rasm narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}



if(in_array($cid,$admin)){
if($text == "Maxsus botlar"){
file_put_contents("step/$cid/$cid.txt","minim");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸Maxsus botlar Botlar narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "minim" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/minimalll.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 Maxsus Botlar narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}

if(in_array($cid,$admin)){
if($text == "efkt narxi"){
file_put_contents("step/$cid/$cid.txt","exxx");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💸efkt narxini kiriting!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}

if($step == "exxx" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");
file_put_contents("data/minimalllll.txt","$text");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💰 efkt narxi $text soʻmga oʻzgartirildi! ✅</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
}

if($text == "🎁 Kunlik bonus"){
$bonustime = file_get_contents("bonus/$cid.txt");
$vaqt = date("d",strtotime("20 hour"));
$bonusrand = rand(199,201); 
if($bonustime == $vaqt){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"*📛 Siz kunlik bonusni olib bo‘lgansiz!

✅ Keyingi bonusni 24 soatdan keyin olasiz*",
'parse_mode'=>'markdown',
]);
}else{
$abb = file_get_contents("baza/$cid/pul.txt");
$abb = $abb + $bonusrand;
file_put_contents("baza/$cid/pul.txt","$abb");
file_put_contents("bonus/$cid.txt","$vaqt");
$ab = file_get_contents("bonus/bons.soni");
$ab = $ab + $bonusrand;
file_put_contents("bonus/bons.soni","$ab");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"🎁",
'parse_mode'=>'markdown',
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=bonus",
'caption'=>"
🎁 Sizga *$bonusrand* soʻm kunlik bonus taqdim etildi!",
'parse_mode'=>'markdown',
'reply_markup'=>$backs,
]);
$user = $message->from->username;
if($user){
$username = "@$user";
}else{
$username = "$name";
$chanel_2 = file_get_contents("stat/chanel_2.txt");
}
bot('sendMessage',[
    'chat_id'=>"5267296499", 
    'text'=>"<i>📲 Foydalanuvchi <a href = 'tg://user?id=$cid'>$username</a></i>

🎁 <b>Bonus: $bonusrand soʻm.
🆔 Idinfikatori:</b> <code>$cid</code>

🤖 Botimizga kiring: <i>@$bot</i>",
'parse_mode'=>"html",
]);
}
}


if(mb_stripos($callback, "rasm_iz:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"🕵🏻‍♂ Rasm izlash uchun so'z yozing!",
'parse_mode'=>'markdown',
'reply_markup'=>$rpl, 
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}



if($reply=="🕵🏻‍♂ Rasm izlash uchun so'z yozing!"){
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=$text/1",
'caption'=>"🌠@$bot topib berdi",
'parse_mode'=>'markdown',
'reply_markup'=>$viy3ypp,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=$text/2",
'caption'=>"🌠@$bot topib berdi",
'parse_mode'=>'markdown',
'reply_markup'=>$viy3ypp,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=$text/3",
'caption'=>"🌠@$bot topib berdi",
'parse_mode'=>'markdown',
'reply_markup'=>$viy3ypp,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=$text/4",
'caption'=>"🌠@$bot topib berdi",
'parse_mode'=>'markdown',
'reply_markup'=>$viy3ypp,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"https://yandex.uz/images/touch/search/?text=$text/5",
'caption'=>"
✅*RASM TOPILDI✅

🧑🏻‍💻Siz [ $text ] yozdingiz*✍️

🌠*Rasmni @$bot topib berdi!*",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}





if(mb_stripos($callback, "rasm_log:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"🌠Rasmga yoziladigan ism yozing!",
'parse_mode'=>'markdown',
'reply_markup'=>$rpl, 
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}


if($reply=="🌠Rasmga yoziladigan ism yozing!"){
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-215.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-528.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-521.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-424.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-717.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-619.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-595.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-303.html&text=$text",
'caption'=>"🌠",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Ehophoto/index.php/writeText?output=image&effect=https://en.ephoto360.com/write-text-on-wet-glass-online-704.html&text=$text",
'caption'=>"
✅*RASM TAYYOR ✅

❤️Siz [ $text ] yozdingiz*✍️

🌠*Rasmni @$bot Yasab berdi!*",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);

}




$pull = file_get_contents("data/minimallll.txt");
$jrasm = file_get_contents("bonus/bonuss.txt");

if(mb_stripos($callback, "rass:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","rasmm");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasmga yoziladigan Ism yozing✍️",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b>Siz Rasm yaratishingiz uchun hisobingizda kamida $pulll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}




if($step == "rasmm" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");


$rrrr = file_get_contents("baza/$cid/rasmmm.txt");

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pulll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🌠Rasm tayyor</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Botapilar/api$rrrr.php?text=$text",
'caption'=>"✅*RASM TAYYOR✅

👤Siz [ $text ] yozdingiz*✍️

🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}




$pull = file_get_contents("data/minimallll.txt");
$jrasm = file_get_contents("bonus/bonuss.txt");

if(mb_stripos($callback, "admin3:")!==false){
$explode = explode("rasm204:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","rasmmtt");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"📝Adminga yozmoqchi bo'lgan xabaringizni kiriting !",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>" <b>Nimanidir notog'ri bosdingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}




if($step == "rasmmtt" and $text!= "/start" and $text!= "$back"){
unlink("step/$cid/$cid.txt");


$rrrr = file_get_contents("baza/$cid/rasmmm.txt");

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pulll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");

bot('sendMessage',[
'chat_id'=>$administrator,
'text'=>"<b><a href = 'tg://user?id=$cid'>$name</a> sizga 《$text 》 deb xabar yubordi.
🆔️ID raqami <code>$cid</code></b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"✅*Xabaringiz Adminga yuborildi✅

👤Siz [ $text ] deb yozdingiz*✍️",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}







if(mb_stripos($callback, "rasss:7")!==false){
$explode = explode("bot:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pulll){
file_put_contents("baza/$callcid/number.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","gggg");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>🌠  🤴🏻Oʻgil bolani ismini yozing.....✍️

📝Faqat Oʻgʻil bolani ismi yozilsin....</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b>Siz Rasm yaratishingiz uchun hisobingizda kamida $pulll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}



if($step == "gggg" and $text!= "/start" and $text!= "$back"){
unlink("baza/$cid/$cid.txt");
file_put_contents("baza/$cid/iid.txt","$text");
file_put_contents("baza/$cid/$cid.txt","uuuu");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤴🏻Oʻgʻil bolani ismi $text


👸🏻 Qiz bolani ismini kiriting..✍️</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}

if($step == "uuuu" and $text!= "/start" and $text!= "$back"){
unlink("baza/$cid/$cid.txt");
$yyyy = file_get_contents("baza/$cid/iid.txt");

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pulll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"http://m1965.myxvest.ru/Apilar/PhoneApi/index.php?text=$yyyy&text1=$text",
'caption'=>"✅*RASM TAYYOR✅

🤴🏻$yyyy ❤️ $text 👸🏻

🤴🏻Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);

}














if(mb_stripos($callback, "eff1:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff1");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff1") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


 $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'ef-set'=>15,
      'ef-set-2'=>56,
      'jpeg-quality'=>92
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/cracks-effect-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
  
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}



if(mb_stripos($callback, "eff2:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff2");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff2") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'efset1'=>2,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>92,
      'jpegmeta'=>1
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/add-effect-black-white-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
  
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}


if(mb_stripos($callback, "eff3:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff3");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff3") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uplfile0'=> new CURLFile("rasm/$cid.jpg"),
      'clnums'=>'1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19',
      'clsize1'=>9.5,
      'clsize2'=>16,
      'clsizeunit'=>2,
      'cloverlaytype'=>3,
      'clpercfill'=>45,
      'clout'=>1,
      'clonface'=>1,
      'cltransp1'=>0,
      'cltransp2'=>0,
      'clmirror'=>2,
      'clrot1'=>-45,
      'clrot2'=>45,
      'clcoltone1'=>0,
      'clcoltone2'=>0,
      'clblur1'=>0,
      'clblur2'=>2.5,
      'clblurtype'=>3,
      'clqual'=>1,
      'outformat'=>2,
      'jpegtype'=>1,
      'jpegqual'=>100,
      'jpegmeta'=>1
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/cliparts-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}

if(mb_stripos($callback, "eff4:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff4");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff4") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'efset1'=>4,
      'efset2'=>3,
      'sharpint'=>12,
      'briset'=>0,
      'contrset'=>0,
      'saturset'=>0,
      'mpxlimit'=>2,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>92,
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/retouch-photo-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
  
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}

if(mb_stripos($callback, "eff5:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff5");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff5") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'ef-set'=>1,
      'jpeg-quality'=>92
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/puzzles-from-photo-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
  
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}

if(mb_stripos($callback, "eff6:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff6");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff6") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


$post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'efset1'=>1,
      'efset2'=>15,
      'efset3'=>10,
      'efset4'=>1,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>95
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/stereoscopic-3d-picture-from-photo-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
  
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }

bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}



if(mb_stripos($callback, "eff7:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff7");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff7") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


   $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'sharpset'=>0,
      'normset'=>1,
      'briset'=>'-8',
      'contrset'=>0,
      'saturset'=>25,
      'toneset'=>0,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>95
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/illustration-from-photo-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}


if(mb_stripos($callback, "eff8:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff8");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff8") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


  $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'efset1'=>3,
      'efset2'=>7,
      'efset3'=>2,
      'efset4'=>4,
      'lightint'=>0,
      'briset'=>0,
      'contrset'=>0,
      'saturset'=>12,
      'toneset'=>0,
      'mpxlimit'=>2,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>95,
      'jpegmeta'=>1
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/cartoon-picture-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);

    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}


if(mb_stripos($callback, "eff9:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff9");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}










if($message->photo and $step == "eff9") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'cyear'=>date('Y'),
      'clang'=>2, // 1 = Eng, 2 = Ru
      'ctype'=>1,
      'monthslocation'=>1,
      'monthspos'=>20,
      'monthsoffsetx'=>0,
      'monthsoffsety'=>0,
      'monthsdist'=>5,
      'monthnamecolor'=>10,
      'monthnamecolorhex'=>'',
      'monthnamecolortransp'=>0,
      'monthbackgrcolor'=>6,
      'monthbackgrcolorhex'=>'',
      'monthbackgrcolortransp'=>100,
      'weeknamecolor'=>10,
      'weeknamecolorhex'=>'#2f2f2f',
      'weeknamecolortransp'=>0,
      'weekdayscolor'=>10,
      'weekdayscolorhex'=>'',
      'weekdayscolortransp'=>0,
      'weekenddayscolor'=>2,
      'weekenddayscolorhex'=>'#bd0510',
      'weekenddayscolortransp'=>0,
      'monthsbackgrcolor'=>1,
      'monthsbackgrcolorhex'=>'',
      'monthsbackgrcolortransp'=>25,
      'dayshighlight'=>'', //Bayram kuni probel bilan namuna 01.01 08.03
      'fontstylemonths'=>1,
      'fontstyleweeks'=>1,
      'fontstyledays'=>2,
      'textsmooth'=>4,
      'cropl'=>0,
      'cropr'=>0,
      'cropt'=>0,
      'cropb'=>0,
      'mpxsize'=>1.5,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>95,
      'jpegmeta'=>1
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/calendar-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);
    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}

if(mb_stripos($callback, "eff10:")!==false){
$explode = explode("rass:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=$pullll){
file_put_contents("baza/$callcid/rasmmm.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","eff10");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 Rasm yuboring......",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"🌠 <b> hisobingizda kamida $pullll soʻm boʻlishi kerak!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}






/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
MANBA @UzBuilder Manba Bilan Ol*/



if($message->photo and $step == "eff10") {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Yuklanmoqda...
🛠 Iltimos biroz kuting!</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$mid + 1,
]);
$file = "https://api.telegram.org/file/bot".UzBuilder."/".bot('getfile',['file_id'=>$message->photo[1]->file_id])->result->file_path;
file_put_contents("rasm/$cid.jpg",file_get_contents($file));

$pul = file_get_contents("baza/$cid/pul.txt");
$miqdor = $pul - $pullll;
file_put_contents("baza/$cid/pul.txt","$miqdor");

$raaa = file_get_contents("bonus/bonss.txt");
$raaa = $raaa + 1;
file_put_contents("bonus/bonss.txt","$raaa");


    $post = [
      'uploadfile'=> new CURLFile("rasm/$cid.jpg"),
      'efset1'=>50,
      'efset2'=>30,
      'outformat'=>2,
      'jpegtype'=>2,
      'jpegqual'=>95,
      ];
        $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'https://www.imgonline.com.ua/8bit-picture-result.php');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    $res = curl_exec($ch);

    $res = explode("\n",$res);
    $res = explode("href",$res[29]);
    $res = explode('"',$res[1]);
    $ex = explode(":",$res[1]);
    if($ex[0] == "https"){
    $res = $res[1];
    }else{
      $res = "https://www.imgonline.com.ua/$res[1]";
    }
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>👇</b>",
'parse_mode'=>'html',
'reply_markup'=>$balans_manKkager,
]);
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>"$res",
'caption'=>"✅*RASM TAYYOR*✅



🤴🏻*Rasmni @$bot yasab berdi!* ",
'parse_mode'=>'markdown',
'reply_markup'=>$home,
]);
}



if(mb_stripos($callback, "nik_yas:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","nik");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"<b>📝 Nik yasash uchun ismingizni yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}


if($text == "📚Qo'llanma va Qoidalar"){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>📄@$bot qo'llanmasi va qoidasi
------------------------------
⚡Maxsus bo'lim yordamida  🌟Nik yasashingiz 🕵🏻‍♂rasm izlashingiz 📥Tik tokdan vidio yuklashingiz mumkin.
------------------------------
❗️Bot bizning $soni ta kanallarimizga obuna bo'lmasangiz ishlamaydi.
🔐Bizning kanallar:
$kanal
-----------------------------
👥Bot referal narxi: $taklif so'm
💰Botlar narxi:
🚀 Arzon botlar- $minimal so'm
💸 Pullik botlar- $minimall so'm
🧑🏻‍💻 Maxsus botlar- $minimalll so'm
---------------------------
🛠Bot ochish haqida:
Bot ochish uchun siz referal yig'ib yoki admin orqali hisobingizni to'ldirib Bot ochishingiz mumkin.
Bot ochish ketma ketligi:
1🛠Bot ochish -tugmasini bosing
2 🚀Arzon botlar - 💸pullik botlar -🧑🏻‍?? Maxsus botlar tugmalaridan birini tanlang
3. O'zingizga kerakli botni tanlang👍
4.Va bot tokenini yuboring bot 1-2 soniyada tayyor bo'ladi 
Bot tokenini olish uchun @botfather ga <a href = 'https://t.me/BotFather'>/newbot</a> buyrug'ini jo'nating
------------------------------
💰Pul ishlash.
Siz hisobingizni do'stlaringizni taklif qilib yoki kunlik bonusni olib yoki <a href = 'tg://user?id=$administrator'> 👨‍💻Admin</a> orqali to'ldirishingiz mumkin.
Buning uchun 💸 Pul ishlash bo'limiga kiring.</b>",
'parse_mode' =>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖 BotFather",'url'=>"https://t.me/BotFather"],],
[['text'=>"👨‍💻 Admin",'url'=>"tg://user?id=$administrator"],],
]
])
]);
}




if($text!= "/start" and $text!= $back and $step == "nik"){
unlink("step/$cid/$cid.txt");
file_put_contents("step/$cid/nik.txt","$text");
$nik1 = $text;
$nik1 = str_replace("q", "𝐪", $nik1);
$nik1 = str_replace("w", "𝐰", $nik1);
$nik1 = str_replace("e", "𝐞", $nik1);
$nik1 = str_replace("r", "𝐫", $nik1);
$nik1 = str_replace("t", "𝐭", $nik1);
$nik1 = str_replace("y", "𝐲", $nik1);
$nik1 = str_replace("u", "𝐮", $nik1);
$nik1 = str_replace("i", "𝐢", $nik1);
$nik1 = str_replace("o", "𝐨", $nik1);
$nik1 = str_replace("p", "𝐩", $nik1);
$nik1 = str_replace("a", "𝐚", $nik1);
$nik1 = str_replace("s", "𝐬", $nik1);
$nik1 = str_replace("d", "𝐝", $nik1);
$nik1 = str_replace("f", "𝐟", $nik1);
$nik1 = str_replace("g", "𝐠", $nik1);
$nik1 = str_replace("h", "𝐡", $nik1);
$nik1 = str_replace("j", "𝐣", $nik1);
$nik1 = str_replace("k", "𝐤", $nik1);
$nik1 = str_replace("l", "𝐥", $nik1);
$nik1 = str_replace("z", "𝐳", $nik1);
$nik1 = str_replace("x", "𝐱", $nik1);
$nik1 = str_replace("c", "𝐜", $nik1);
$nik1 = str_replace("v", "𝐯", $nik1);
$nik1 = str_replace("b", "𝐛", $nik1);
$nik1 = str_replace("n", "𝐧", $nik1);
$nik1 = str_replace("m", "𝐦", $nik1);
$nik1 = str_replace("Q", "𝐐", $nik1);
$nik1 = str_replace("W", "𝐖", $nik1);
$nik1 = str_replace("E", "𝐄", $nik1);
$nik1 = str_replace("R", "𝐑", $nik1);
$nik1 = str_replace("T", "𝐓", $nik1);
$nik1 = str_replace("Y", "𝐘", $nik1);
$nik1 = str_replace("U", "𝐔", $nik1);
$nik1 = str_replace("I", "𝐈", $nik1);
$nik1 = str_replace("O", "𝐎", $nik1);
$nik1 = str_replace("P", "𝐏", $nik1);
$nik1 = str_replace("A", "𝐀", $nik1);
$nik1 = str_replace("S", "𝐒", $nik1);
$nik1 = str_replace("D", "𝐃", $nik1);
$nik1 = str_replace("F", "𝐅", $nik1);
$nik1 = str_replace("G", "𝐆", $nik1);
$nik1 = str_replace("H", "𝐇", $nik1);
$nik1 = str_replace("J", "𝐉", $nik1);
$nik1 = str_replace("K", "𝐊", $nik1);
$nik1 = str_replace("L", "𝐋", $nik1);
$nik1 = str_replace("Z", "𝐙", $nik1);
$nik1 = str_replace("X", "𝐗", $nik1);
$nik1 = str_replace("C", "𝐂", $nik1);
$nik1 = str_replace("V", "𝐕", $nik1);
$nik1 = str_replace("B", "𝐁", $nik1);
$nik1 = str_replace("N", "𝐍", $nik1);
$nik1 = str_replace("M", "𝐌", $nik1);
$nik2 = $text;
$nik2 = str_replace("q", "q҉", $nik2);
$nik2 = str_replace("w", "w҉", $nik2);
$nik2 = str_replace("e", "e҉", $nik2);
$nik2 = str_replace("r", "r҉", $nik2);
$nik2 = str_replace("t", "t҉", $nik2);
$nik2 = str_replace("y", "y҉", $nik2);
$nik2 = str_replace("u", "u҉", $nik2);
$nik2 = str_replace("i", "i҉", $nik2);
$nik2 = str_replace("o", "o҉", $nik2);
$nik2 = str_replace("p", "p҉", $nik2);
$nik2 = str_replace("a", "a҉", $nik2);
$nik2 = str_replace("s", "s҉", $nik2);
$nik2 = str_replace("d", "d҉", $nik2);
$nik2 = str_replace("f", "f҉", $nik2);
$nik2 = str_replace("g", "g҉", $nik2);
$nik2 = str_replace("h", "h҉", $nik2);
$nik2 = str_replace("j", "j҉", $nik2);
$nik2 = str_replace("k", "k҉", $nik2);
$nik2 = str_replace("l", "l҉", $nik2);
$nik2 = str_replace("z", "z҉", $nik2);
$nik2 = str_replace("x", "x҉", $nik2);
$nik2 = str_replace("c", "c҉", $nik2);
$nik2 = str_replace("v", "v҉", $nik2);
$nik2 = str_replace("b", "b҉", $nik2);
$nik2 = str_replace("n", "n҉", $nik2);
$nik2 = str_replace("m", "m҉", $nik2);
$nik2 = str_replace("Q", "Q҉", $nik2);
$nik2 = str_replace("W", "W҉", $nik2);
$nik2 = str_replace("E", "E҉", $nik2);
$nik2 = str_replace("R", "R҉", $nik2);
$nik2 = str_replace("T", "T҉", $nik2);
$nik2 = str_replace("Y", "Y҉", $nik2);
$nik2 = str_replace("U", "U҉", $nik2);
$nik2 = str_replace("I", "I҉", $nik2);
$nik2 = str_replace("O", "O҉", $nik2);
$nik2 = str_replace("P", "P҉", $nik2);
$nik2 = str_replace("A", "A҉", $nik2);
$nik2 = str_replace("S", "S҉", $nik2);
$nik2 = str_replace("D", "D҉", $nik2);
$nik2 = str_replace("F", "F҉", $nik2);
$nik2 = str_replace("G", "G҉", $nik2);
$nik2 = str_replace("H", "H҉", $nik2);
$nik2 = str_replace("J", "J҉", $nik2);
$nik2 = str_replace("K", "K҉", $nik2);
$nik2 = str_replace("L", "L҉", $nik2);
$nik2 = str_replace("Z", "Z҉", $nik2);
$nik2 = str_replace("X", "X҉", $nik2);
$nik2 = str_replace("C", "C҉", $nik2);
$nik2 = str_replace("V", "V҉", $nik2);
$nik2 = str_replace("B", "B҉", $nik2);
$nik2 = str_replace("N", "N҉", $nik2);
$nik2 = str_replace("M", "M҉", $nik2);
$nik3 = $text;
$nik3 = str_replace('a', '𝕒', $nik3);
$nik3 = str_replace('b', '𝕓', $nik3);
$nik3 = str_replace('c', '𝕔', $nik3);
$nik3 = str_replace('d', '𝕕', $nik3);
$nik3 = str_replace('e', '𝕖', $nik3);
$nik3 = str_replace('f', '𝕗', $nik3);
$nik3 = str_replace('g', '𝕘', $nik3);
$nik3 = str_replace('h', '𝕙', $nik3);
$nik3 = str_replace('i', '𝕚', $nik3);
$nik3 = str_replace('j', '𝕛', $nik3);
$nik3 = str_replace('k', '𝕜', $nik3);
$nik3 = str_replace('l', '𝕝', $nik3);
$nik3 = str_replace('m', '𝕞', $nik3);
$nik3 = str_replace('n', '𝕟', $nik3);
$nik3 = str_replace('o', '𝕠', $nik3);
$nik3 = str_replace('p', '𝕡', $nik3);
$nik3 = str_replace('q', '𝕢', $nik3);
$nik3 = str_replace('r', '𝕣', $nik3);
$nik3 = str_replace('s', '𝕤', $nik3);
$nik3 = str_replace('t', '𝕥', $nik3);
$nik3 = str_replace('u', '𝕦', $nik3);
$nik3 = str_replace('v', '𝕧', $nik3);
$nik3 = str_replace('w', '𝕨', $nik3);
$nik3 = str_replace('x', '𝕩', $nik3);
$nik3 = str_replace('y', '𝕪', $nik3);
$nik3 = str_replace('z', '𝕫', $nik3); 
$nik3 = str_replace('A', '𝔸', $nik3);
$nik3 = str_replace('B', '𝔹', $nik3);
$nik3 = str_replace('C', 'ℂ', $nik3);
$nik3 = str_replace('D', '𝔻', $nik3);
$nik3 = str_replace('E', '𝔼', $nik3);
$nik3 = str_replace('F', '𝔽', $nik3);
$nik3 = str_replace('G', '𝔾', $nik3);
$nik3 = str_replace('H', 'ℍ', $nik3);
$nik3 = str_replace('I', '𝕀', $nik3);
$nik3 = str_replace('J', '𝕁', $nik3);
$nik3 = str_replace('K', '𝕂', $nik3);
$nik3 = str_replace('L', '𝕃', $nik3);
$nik3 = str_replace('M', '𝕄', $nik3);
$nik3 = str_replace('N', 'ℕ', $nik3);
$nik3 = str_replace('O', '𝕆', $nik3);
$nik3 = str_replace('P', 'ℙ', $nik3);
$nik3 = str_replace('Q', 'ℚ', $nik3);
$nik3 = str_replace('R', 'ℝ', $nik3);
$nik3 = str_replace('S', '𝕊', $nik3);
$nik3 = str_replace('T', '𝕋', $nik3);
$nik3 = str_replace('U', '𝕌', $nik3);
$nik3 = str_replace('V', '𝕍', $nik3);
$nik3 = str_replace('W', '𝕎', $nik3);
$nik3 = str_replace('X', '𝕏', $nik3);
$nik3 = str_replace('Y', '𝕐', $nik3);
$nik3 = str_replace('Z', 'ℤ', $nik3);
$nik4 = $text;
$nik4 = str_replace('a', '𝓪', $nik4);
$nik4 = str_replace('b', '𝓫', $nik4);
$nik4 = str_replace('c', '𝓬', $nik4);
$nik4 = str_replace('d', '𝓭', $nik4);
$nik4 = str_replace('e', '𝓮', $nik4);
$nik4 = str_replace('f', '𝓯', $nik4);
$nik4 = str_replace('g', '𝓰', $nik4);
$nik4 = str_replace('h', '𝓱', $nik4);
$nik4 = str_replace('i', '𝓲', $nik4);
$nik4 = str_replace('j', '𝓳', $nik4);
$nik4 = str_replace('k', '𝓴', $nik4);
$nik4 = str_replace('l', '𝓵', $nik4);
$nik4 = str_replace('m', '𝓶', $nik4);
$nik4 = str_replace('n', '𝓷', $nik4);
$nik4 = str_replace('o', '𝓸', $nik4);
$nik4 = str_replace('p', '𝓹', $nik4);
$nik4 = str_replace('q', '𝓺', $nik4);
$nik4 = str_replace('r', '??', $nik4);
$nik4 = str_replace('s', '𝓼', $nik4);
$nik4 = str_replace('t', '𝓽', $nik4);
$nik4 = str_replace('u', '𝓾', $nik4);
$nik4 = str_replace('v', '𝓿', $nik4);
$nik4 = str_replace('w', '𝔀', $nik4);
$nik4 = str_replace('x', '𝔁', $nik4);
$nik4 = str_replace('y', '𝔂', $nik4);
$nik4 = str_replace('z', '𝔃', $nik4); 
$nik4 = str_replace('A', '𝓐', $nik4);
$nik4 = str_replace('B', '𝓑', $nik4);
$nik4 = str_replace('C', '𝓒', $nik4);
$nik4 = str_replace('D', '𝓓', $nik4);
$nik4 = str_replace('E', '𝓔', $nik4);
$nik4 = str_replace('F', '𝓕', $nik4);
$nik4 = str_replace('G', '𝓖', $nik4);
$nik4 = str_replace('H', '𝓗', $nik4);
$nik4 = str_replace('I', '𝓘', $nik4);
$nik4 = str_replace('J', '𝓙', $nik4);
$nik4 = str_replace('K', '𝓚', $nik4);
$nik4 = str_replace('L', '𝓛', $nik4);
$nik4 = str_replace('M', '𝓜', $nik4);
$nik4 = str_replace('N', '𝓝', $nik4);
$nik4 = str_replace('O', '𝓞', $nik4);
$nik4 = str_replace('P', '𝓟', $nik4);
$nik4 = str_replace('Q', '𝓠', $nik4);
$nik4 = str_replace('R', '𝓡', $nik4);
$nik4 = str_replace('S', '𝓢', $nik4);
$nik4 = str_replace('T', '𝓣', $nik4);
$nik4 = str_replace('U', '𝓤', $nik4);
$nik4 = str_replace('V', '𝓥', $nik4);
$nik4 = str_replace('W', '𝓦', $nik4);
$nik4 = str_replace('X', '𝓧', $nik4);
$nik4 = str_replace('Y', '𝓨', $nik4);
$nik4 = str_replace('Z', '𝓩', $nik4); 
$nik5 = $text;
$nik5 = str_replace('a', '𝚊', $nik5);
$nik5 = str_replace('b', '𝚋', $nik5);
$nik5 = str_replace('c', '𝚌', $nik5);
$nik5 = str_replace('d', '𝚍', $nik5);
$nik5 = str_replace('e', '𝚎', $nik5);
$nik5 = str_replace('f', '𝚏', $nik5);
$nik5 = str_replace('g', '𝚐', $nik5);
$nik5 = str_replace('h', '𝚑', $nik5);
$nik5 = str_replace('i', '𝚒', $nik5);
$nik5 = str_replace('j', '𝚓', $nik5);
$nik5 = str_replace('k', '𝚔', $nik5);
$nik5 = str_replace('l', '𝚕', $nik5);
$nik5 = str_replace('m', '𝚖', $nik5);
$nik5 = str_replace('n', '𝚗', $nik5);
$nik5 = str_replace('o', '𝚘', $nik5);
$nik5 = str_replace('p', '𝚙', $nik5);
$nik5 = str_replace('q', '𝚚', $nik5);
$nik5 = str_replace('r', '𝚛', $nik5);
$nik5 = str_replace('s', '𝚜', $nik5);
$nik5 = str_replace('t', '𝚝', $nik5);
$nik5 = str_replace('u', '𝚞', $nik5);
$nik5 = str_replace('v', '𝚟', $nik5);
$nik5 = str_replace('w', '𝚠', $nik5);
$nik5 = str_replace('x', '𝚡', $nik5);
$nik5 = str_replace('y', '𝚢', $nik5);
$nik5 = str_replace('z', '𝚣', $nik5); 
$nik5 = str_replace('A', '𝙰', $nik5);
$nik5 = str_replace('B', '𝙱', $nik5);
$nik5 = str_replace('C', '𝙲', $nik5);
$nik5 = str_replace('D', '𝙳', $nik5);
$nik5 = str_replace('E', '𝙴', $nik5);
$nik5 = str_replace('F', '𝙵', $nik5);
$nik5 = str_replace('G', '𝙶', $nik5);
$nik5 = str_replace('H', '𝙷', $nik5);
$nik5 = str_replace('I', '𝙸', $nik5);
$nik5 = str_replace('J', '𝙹', $nik5);
$nik5 = str_replace('K', '𝙺', $nik5);
$nik5 = str_replace('L', '𝙻', $nik5);
$nik5 = str_replace('M', '𝙼', $nik5);
$nik5 = str_replace('N', '𝙽', $nik5);
$nik5 = str_replace('O', '𝙾', $nik5);
$nik5 = str_replace('P', '𝙿', $nik5);
$nik5 = str_replace('Q', '𝚀', $nik5);
$nik5 = str_replace('R', '𝚁', $nik5);
$nik5 = str_replace('S', '𝚂', $nik5);
$nik5 = str_replace('T', '𝚃', $nik5);
$nik5 = str_replace('U', '𝚄', $nik5);
$nik5 = str_replace('V', '𝚅', $nik5);
$nik5 = str_replace('W', '𝚆', $nik5);
$nik5 = str_replace('X', '𝚇', $nik5);
$nik5 = str_replace('Y', '𝚈', $nik5);
$nik5 = str_replace('Z', '𝚉', $nik5); 
$nik6 = $text;
$nik6 = str_replace("q", "𝙦", $nik6);
$nik6 = str_replace("w", "𝙬", $nik6);
$nik6 = str_replace("e", "𝙚", $nik6);
$nik6 = str_replace("r", "𝙧", $nik6);
$nik6 = str_replace("t", "𝙩", $nik6);
$nik6 = str_replace("y", "𝙮", $nik6);
$nik6 = str_replace("u", "𝙪", $nik6);
$nik6 = str_replace("i", "𝙞", $nik6);
$nik6 = str_replace("o", "𝙤", $nik6);
$nik6 = str_replace("p", "𝙥", $nik6);
$nik6 = str_replace("a", "𝙖", $nik6);
$nik6 = str_replace("s", "𝙨", $nik6);
$nik6 = str_replace("d", "𝙙", $nik6);
$nik6 = str_replace("f", "𝙛", $nik6);
$nik6 = str_replace("g", "𝙜", $nik6);
$nik6 = str_replace("h", "𝙝", $nik6);
$nik6 = str_replace("j", "𝙟", $nik6);
$nik6 = str_replace("k", "𝙠", $nik6);
$nik6 = str_replace("l", "𝙡", $nik6);
$nik6 = str_replace("z", "𝙯", $nik6);
$nik6 = str_replace("x", "𝙭", $nik6);
$nik6 = str_replace("c", "𝙘", $nik6);
$nik6 = str_replace("v", "𝙫", $nik6);
$nik6 = str_replace("b", "𝙗", $nik6);
$nik6 = str_replace("n", "𝙣", $nik6);
$nik6 = str_replace("m", "𝙢", $nik6);
$nik6 = str_replace("Q", "𝙌", $nik6);
$nik6 = str_replace("W", "𝙒", $nik6);
$nik6 = str_replace("E", "𝙀", $nik6);
$nik6 = str_replace("R", "𝙍", $nik6);
$nik6 = str_replace("T", "𝙏", $nik6);
$nik6 = str_replace("Y", "𝙔", $nik6);
$nik6 = str_replace("U", "𝙐", $nik6);
$nik6 = str_replace("I", "𝙄", $nik6);
$nik6 = str_replace("O", "𝙊", $nik6);
$nik6 = str_replace("P", "𝙋", $nik6);
$nik6 = str_replace("A", "𝘼", $nik6);
$nik6 = str_replace("S", "𝙎", $nik6);
$nik6 = str_replace("D", "𝘿", $nik6);
$nik6 = str_replace("F", "𝙁", $nik6);
$nik6 = str_replace("G", "𝙂", $nik6);
$nik6 = str_replace("H", "𝙃", $nik6);
$nik6 = str_replace("J", "𝙅", $nik6);
$nik6 = str_replace("K", "𝙆", $nik6);
$nik6 = str_replace("L", "𝙇", $nik6);
$nik6 = str_replace("Z", "𝙕", $nik6);
$nik6 = str_replace("X", "𝙓", $nik6);
$nik6 = str_replace("C", "𝘾", $nik6);
$nik6 = str_replace("V", "𝙑", $nik6);
$nik6 = str_replace("B", "𝘽", $nik6);
$nik6 = str_replace("N", "𝙉", $nik6);
$nik6 = str_replace("M", "𝙈", $nik6);

$nik7 = $text;
$nik7 = str_replace("q", "𝖖", $nik7);
$nik7 = str_replace("w", "𝖜", $nik7);
$nik7 = str_replace("e", "𝖊", $nik7);
$nik7 = str_replace("r", "𝖗", $nik7);
$nik7 = str_replace("t", "𝖙", $nik7);
$nik7 = str_replace("y", "𝖞", $nik7);
$nik7 = str_replace("u", "𝖚", $nik7);
$nik7 = str_replace("i", "𝖎", $nik7);
$nik7 = str_replace("o", "𝖔", $nik7);
$nik7 = str_replace("p", "𝖕", $nik7);
$nik7 = str_replace("a", "𝖆", $nik7);
$nik7 = str_replace("s", "𝖘", $nik7);
$nik7 = str_replace("d", "𝖉", $nik7);
$nik7 = str_replace("f", "𝖋", $nik7);
$nik7 = str_replace("g", "𝖌", $nik7);
$nik7 = str_replace("h", "𝖍", $nik7);
$nik7 = str_replace("j", "𝖏", $nik7);
$nik7 = str_replace("k", "𝖐", $nik7);
$nik7 = str_replace("l", "𝖑", $nik7);
$nik7 = str_replace("z", "𝖟", $nik7);
$nik7 = str_replace("x", "𝖝", $nik7);
$nik7 = str_replace("c", "𝖈", $nik7);
$nik7 = str_replace("v", "𝖛", $nik7);
$nik7 = str_replace("b", "𝖇", $nik7);
$nik7 = str_replace("n", "𝖓", $nik7);
$nik7 = str_replace("m", "𝖒", $nik7);
$nik7 = str_replace("Q", "𝕼", $nik7);
$nik7 = str_replace("W", "𝖂", $nik7);
$nik7 = str_replace("E", "𝕰", $nik7);
$nik7 = str_replace("R", "𝕽", $nik7);
$nik7 = str_replace("T", "𝕿", $nik7);
$nik7 = str_replace("Y", "𝖄", $nik7);
$nik7 = str_replace("U", "𝖀", $nik7);
$nik7 = str_replace("I", "𝕴", $nik7);
$nik7 = str_replace("O", "𝕺", $nik7);
$nik7 = str_replace("P", "𝕻", $nik7);
$nik7 = str_replace("A", "𝕬", $nik7);
$nik7 = str_replace("S", "𝕾", $nik7);
$nik7 = str_replace("D", "𝕯", $nik7);
$nik7 = str_replace("F", "𝕱", $nik7);
$nik7 = str_replace("G", "𝕲", $nik7);
$nik7 = str_replace("H", "𝕳", $nik7);
$nik7 = str_replace("J", "𝕵", $nik7);
$nik7 = str_replace("K", "𝕶", $nik7);
$nik7 = str_replace("L", "𝕷", $nik7);
$nik7 = str_replace("Z", "𝖅", $nik7);
$nik7 = str_replace("X", "𝖃", $nik7);
$nik7 = str_replace("C", "𝕮", $nik7);
$nik7 = str_replace("V", "𝖁", $nik7);
$nik7 = str_replace("B", "𝕭", $nik7);
$nik7 = str_replace("N", "𝕹", $nik7);
$nik7 = str_replace("M", "𝕸", $nik7);
$nik8 = $text;
$nik8 = str_replace("q", "ⓠ", $nik8);
$nik8 = str_replace("w", "ⓦ", $nik8);
$nik8 = str_replace("e", "ⓔ", $nik8);
$nik8 = str_replace("r", "ⓡ", $nik8);
$nik8 = str_replace("t", "ⓣ", $nik8);
$nik8 = str_replace("y", "ⓨ", $nik8);
$nik8 = str_replace("u", "ⓤ", $nik8);
$nik8 = str_replace("i", "ⓘ", $nik8);
$nik8 = str_replace("o", "ⓞ", $nik8);
$nik8 = str_replace("p", "ⓟ", $nik8);
$nik8 = str_replace("a", "ⓐ", $nik8);
$nik8 = str_replace("s", "ⓢ", $nik8);
$nik8 = str_replace("d", "ⓓ", $nik8);
$nik8 = str_replace("f", "ⓕ", $nik8);
$nik8 = str_replace("g", "ⓖ", $nik8);
$nik8 = str_replace("h", "ⓗ", $nik8);
$nik8 = str_replace("j", "ⓙ", $nik8);
$nik8 = str_replace("k", "ⓚ", $nik8);
$nik8 = str_replace("l", "ⓛ", $nik8);
$nik8 = str_replace("z", "ⓩ", $nik8);
$nik8 = str_replace("x", "ⓧ", $nik8);
$nik8 = str_replace("c", "ⓒ", $nik8);
$nik8 = str_replace("v", "ⓥ", $nik8);
$nik8 = str_replace("b", "ⓑ", $nik8);
$nik8 = str_replace("n", "ⓝ", $nik8);
$nik8 = str_replace("m", "ⓜ", $nik8);
$nik8 = str_replace("Q", "Ⓠ", $nik8);
$nik8 = str_replace("W", "Ⓦ", $nik8);
$nik8 = str_replace("E", "Ⓔ", $nik8);
$nik8 = str_replace("R", "Ⓡ", $nik8);
$nik8 = str_replace("T", "Ⓣ", $nik8);
$nik8 = str_replace("Y", "Ⓨ", $nik8);
$nik8 = str_replace("U", "Ⓤ", $nik8);
$nik8 = str_replace("I", "Ⓘ", $nik8);
$nik8 = str_replace("O", "Ⓞ", $nik8);
$nik8 = str_replace("P", "Ⓟ", $nik8);
$nik8 = str_replace("A", "Ⓐ", $nik8);
$nik8 = str_replace("S", "Ⓢ", $nik8);
$nik8 = str_replace("D", "Ⓓ", $nik8);
$nik8 = str_replace("F", "Ⓕ", $nik8);
$nik8 = str_replace("G", "Ⓖ", $nik8);
$nik8 = str_replace("H", "Ⓗ", $nik8);
$nik8 = str_replace("J", "Ⓙ", $nik8);
$nik8 = str_replace("K", "Ⓚ", $nik8);
$nik8 = str_replace("L", "Ⓛ", $nik8);
$nik8 = str_replace("Z", "Ⓩ", $nik8);
$nik8 = str_replace("X", "Ⓧ", $nik8);
$nik8 = str_replace("C", "Ⓒ", $nik8);
$nik8 = str_replace("V", "Ⓥ", $nik8);
$nik8 = str_replace("B", "Ⓑ", $nik8);
$nik8 = str_replace("N", "Ⓝ", $nik8);
$nik8 = str_replace("M", "Ⓜ", $nik8);
$nik9 = $text;
$nik9 = str_replace("q", "b", $nik9);
$nik9 = str_replace("w", "ʍ", $nik9);
$nik9 = str_replace("e", "ǝ", $nik9);
$nik9 = str_replace("r", "ɹ", $nik9);
$nik9 = str_replace("t", "ʇ", $nik9);
$nik9 = str_replace("y", "ʎ", $nik9);
$nik9 = str_replace("u", "n", $nik9);
$nik9 = str_replace("i", "ı", $nik9);
$nik9 = str_replace("o", "o", $nik9);
$nik9 = str_replace("p", "d", $nik9);
$nik9 = str_replace("a", "ɐ", $nik9);
$nik9 = str_replace("s", "s", $nik9);
$nik9 = str_replace("d", "p", $nik9);
$nik9 = str_replace("f", "ɟ", $nik9);
$nik9 = str_replace("g", "ƃ", $nik9);
$nik9 = str_replace("h", "ɥ", $nik9);
$nik9 = str_replace("j", "ɾ", $nik9);
$nik9 = str_replace("k", "ʞ", $nik9);
$nik9 = str_replace("l", "ן", $nik9);
$nik9 = str_replace("z", "z", $nik9);
$nik9 = str_replace("x", "x", $nik9);
$nik9 = str_replace("c", "ɔ", $nik9);
$nik9 = str_replace("v", "𐌡", $nik9);
$nik9 = str_replace("b", "q", $nik9);
$nik9 = str_replace("n", "u", $nik9);
$nik9 = str_replace("m", "ɯ", $nik9);
$nik9 = str_replace("Q", "b", $nik9);
$nik9 = str_replace("W", "ʍ", $nik9);
$nik9 = str_replace("E", "ǝ", $nik9);
$nik9 = str_replace("R", "ɹ", $nik9);
$nik9 = str_replace("T", "ʇ", $nik9);
$nik9 = str_replace("Y", "ʎ", $nik9);
$nik9 = str_replace("U", "n", $nik9);
$nik9 = str_replace("I", "ı", $nik9);
$nik9 = str_replace("O", "o", $nik9);
$nik9 = str_replace("P", "d", $nik9);
$nik9 = str_replace("A", "ɐ", $nik9);
$nik9 = str_replace("S", "s", $nik9);
$nik9 = str_replace("D", "p", $nik9);
$nik9 = str_replace("F", "ɟ", $nik9);
$nik9 = str_replace("G", "ƃ", $nik9);
$nik9 = str_replace("H", "ɥ", $nik9);
$nik9 = str_replace("J", "ɾ", $nik9);
$nik9 = str_replace("K", "ʞ", $nik9);
$nik9 = str_replace("L", "ן", $nik9);
$nik9 = str_replace("Z", "z", $nik9);
$nik9 = str_replace("X", "x", $nik9);
$nik9 = str_replace("C", "ɔ", $nik9);
$nik9 = str_replace("V", "𐌡", $nik9);
$nik9 = str_replace("B", "q", $nik9);
$nik9 = str_replace("N", "u", $nik9);
$nik9 = str_replace("M", "ɯ", $nik9);
$EN2 = $text;
$EN2 = str_replace('q', 'ᵠ' , $EN2);
$EN2 = str_replace('w', 'ʷ' , $EN2);
$EN2 = str_replace('e', 'ᵉ' , $EN2);
$EN2 = str_replace('r', 'ʳ' , $EN2);
$EN2 = str_replace('t', 'ᵗ' , $EN2);
$EN2 = str_replace('y', 'ʸ' , $EN2);
$EN2 = str_replace('u', 'ᵘ' , $EN2);
$EN2 = str_replace('i', 'ᶤ' , $EN2);
$EN2 = str_replace('o', 'ᵒ' , $EN2);
$EN2 = str_replace('p', 'ᵖ' , $EN2);
$EN2 = str_replace('a', 'ᵃ' , $EN2);
$EN2 = str_replace('s', 'ˢ' , $EN2);
$EN2 = str_replace('d', 'ᵈ' , $EN2);
$EN2 = str_replace('f', 'ᶠ' , $EN2);
$EN2 = str_replace('g', 'ᵍ' , $EN2);
$EN2 = str_replace('h', 'ʰ' , $EN2);
$EN2 = str_replace('j', 'ʲ' , $EN2);
$EN2 = str_replace('k', 'ᵏ' , $EN2);
$EN2 = str_replace('l', 'ˡ' , $EN2);
 $EN2 = str_replace('z', 'ᶻ' , $EN2);
$EN2 = str_replace('x', 'ˣ' , $EN2);
$EN2 = str_replace('c', 'ᶜ' , $EN2);
$EN2 = str_replace('v', 'ᵛ' , $EN2);
$EN2 = str_replace('b', 'ᵇ' , $EN2);
$EN2 = str_replace('n', 'ᶰ' , $EN2);
$EN2 = str_replace('m', 'ᵐ' , $EN2);
$EN = $text;
$EN = str_replace('q', '•🇶', $EN);
$EN = str_replace('w', '•🇼', $EN);
$EN = str_replace('e', '•🇪', $EN);
$EN = str_replace('r', '•🇷', $EN);
$EN = str_replace('t', '•🇹', $EN);
$EN = str_replace('y', '•🇾', $EN);
$EN = str_replace('v', '•🇻', $EN);
$EN = str_replace('i', '•🇮', $EN);
$EN = str_replace('o', '•🇴', $EN);
$EN = str_replace('p', '•🇵', $EN);
$EN = str_replace('a', '•🇦', $EN);
$EN = str_replace('s', '•🇸', $EN);
$EN = str_replace('d', '•🇩', $EN);
$EN = str_replace('f', '•🇫', $EN);
$EN = str_replace('g', '•🇬', $EN);
$EN = str_replace('h', '•🇭', $EN);
$EN = str_replace('j', '•🇯', $EN);
$EN = str_replace('k', '•🇰', $EN);
$EN = str_replace('l', '•🇱', $EN);
$EN = str_replace('z', '•🇿', $EN);
$EN = str_replace('x', '•🇽', $EN);
$EN = str_replace('c', '•🇨', $EN);
$EN = str_replace('u', '•🇺', $EN);
$EN = str_replace('b', '•🇧', $EN);
$EN = str_replace('n', '•🇳', $EN);
$EN = str_replace('m', '•🇲', $EN);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤵🏻Yigitlar uchun 👇

1️⃣ <code>$nik1</code> 

2️⃣ <code>★彡 $nik2 彡★</code> 

3️⃣ <code>☬⚡ $nik3 ⚡☬</code> 

4️⃣ <code> ꯭😻🪐 $nik4 🌪🌿➢❭🦅</code> 

5️⃣ <code>❮꯭❶꯭꯭➣꯭ $nik5 ✦꯭•꯭|꯭🖤 </code> 

6️⃣ <code>✺꯭➣꯭ꪾ🦅  $nik6 🌿✺➢ꪾ</code> 

7️⃣ <code>⛄✨ $nik7 ✨⛄</code> 

8️⃣ <code>⚡🌛 $nik8 🌜⚡</code> 

9️⃣ <code>🌟🖤 $nik9 🖤🌟</code> 

1️⃣ 0⃣ <code>$EN</code>

1️⃣ 1⃣ <code>$EN2</code>

🆕️Ko'rinmas Nick👉 <code>              </code> 👈

</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏪ Orqaga","callback_data"=>"nik_all:1"]], 
]
]),
]);
}

if(mb_stripos($callback, "nik_all:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>" Siz nikni kim uchun tayyorlamoqchisiz?
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤴🏻 O'g'il bola uchun ","callback_data"=>"nik_yas:1"],
['text'=>"👸Qiz bola uchun  ","callback_data"=>"nik_yasqiz:1"]],
[['text'=>"⏪ Orqaga","callback_data"=>"menu12:7"]],
]
])
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}




if(mb_stripos($callback, "nik_yasqiz:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
file_put_contents("step/$callcid/$callcid.txt","nikqiz");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"<b>📝 Nik yasash uchun ismingizni yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}
}




if($text!= "/start" and $text!= $back and $step == "nikqiz"){
unlink("step/$cid/$cid.txt");
file_put_contents("step/$cid/nik.txt","$text");
$nik1 = $text;
$nik1 = str_replace("q", "𝐪", $nik1);
$nik1 = str_replace("w", "𝐰", $nik1);
$nik1 = str_replace("e", "𝐞", $nik1);
$nik1 = str_replace("r", "𝐫", $nik1);
$nik1 = str_replace("t", "𝐭", $nik1);
$nik1 = str_replace("y", "𝐲", $nik1);
$nik1 = str_replace("u", "𝐮", $nik1);
$nik1 = str_replace("i", "𝐢", $nik1);
$nik1 = str_replace("o", "𝐨", $nik1);
$nik1 = str_replace("p", "𝐩", $nik1);
$nik1 = str_replace("a", "𝐚", $nik1);
$nik1 = str_replace("s", "𝐬", $nik1);
$nik1 = str_replace("d", "𝐝", $nik1);
$nik1 = str_replace("f", "𝐟", $nik1);
$nik1 = str_replace("g", "𝐠", $nik1);
$nik1 = str_replace("h", "𝐡", $nik1);
$nik1 = str_replace("j", "𝐣", $nik1);
$nik1 = str_replace("k", "𝐤", $nik1);
$nik1 = str_replace("l", "𝐥", $nik1);
$nik1 = str_replace("z", "𝐳", $nik1);
$nik1 = str_replace("x", "𝐱", $nik1);
$nik1 = str_replace("c", "𝐜", $nik1);
$nik1 = str_replace("v", "𝐯", $nik1);
$nik1 = str_replace("b", "𝐛", $nik1);
$nik1 = str_replace("n", "𝐧", $nik1);
$nik1 = str_replace("m", "𝐦", $nik1);
$nik1 = str_replace("Q", "𝐐", $nik1);
$nik1 = str_replace("W", "𝐖", $nik1);
$nik1 = str_replace("E", "𝐄", $nik1);
$nik1 = str_replace("R", "𝐑", $nik1);
$nik1 = str_replace("T", "𝐓", $nik1);
$nik1 = str_replace("Y", "𝐘", $nik1);
$nik1 = str_replace("U", "𝐔", $nik1);
$nik1 = str_replace("I", "𝐈", $nik1);
$nik1 = str_replace("O", "𝐎", $nik1);
$nik1 = str_replace("P", "𝐏", $nik1);
$nik1 = str_replace("A", "𝐀", $nik1);
$nik1 = str_replace("S", "𝐒", $nik1);
$nik1 = str_replace("D", "𝐃", $nik1);
$nik1 = str_replace("F", "𝐅", $nik1);
$nik1 = str_replace("G", "𝐆", $nik1);
$nik1 = str_replace("H", "𝐇", $nik1);
$nik1 = str_replace("J", "𝐉", $nik1);
$nik1 = str_replace("K", "𝐊", $nik1);
$nik1 = str_replace("L", "𝐋", $nik1);
$nik1 = str_replace("Z", "𝐙", $nik1);
$nik1 = str_replace("X", "𝐗", $nik1);
$nik1 = str_replace("C", "𝐂", $nik1);
$nik1 = str_replace("V", "𝐕", $nik1);
$nik1 = str_replace("B", "𝐁", $nik1);
$nik1 = str_replace("N", "𝐍", $nik1);
$nik1 = str_replace("M", "𝐌", $nik1);
$nik2 = $text;
$nik2 = str_replace("q", "q҉", $nik2);
$nik2 = str_replace("w", "w҉", $nik2);
$nik2 = str_replace("e", "e҉", $nik2);
$nik2 = str_replace("r", "r҉", $nik2);
$nik2 = str_replace("t", "t҉", $nik2);
$nik2 = str_replace("y", "y҉", $nik2);
$nik2 = str_replace("u", "u҉", $nik2);
$nik2 = str_replace("i", "i҉", $nik2);
$nik2 = str_replace("o", "o҉", $nik2);
$nik2 = str_replace("p", "p҉", $nik2);
$nik2 = str_replace("a", "a҉", $nik2);
$nik2 = str_replace("s", "s҉", $nik2);
$nik2 = str_replace("d", "d҉", $nik2);
$nik2 = str_replace("f", "f҉", $nik2);
$nik2 = str_replace("g", "g҉", $nik2);
$nik2 = str_replace("h", "h҉", $nik2);
$nik2 = str_replace("j", "j҉", $nik2);
$nik2 = str_replace("k", "k҉", $nik2);
$nik2 = str_replace("l", "l҉", $nik2);
$nik2 = str_replace("z", "z҉", $nik2);
$nik2 = str_replace("x", "x҉", $nik2);
$nik2 = str_replace("c", "c҉", $nik2);
$nik2 = str_replace("v", "v҉", $nik2);
$nik2 = str_replace("b", "b҉", $nik2);
$nik2 = str_replace("n", "n҉", $nik2);
$nik2 = str_replace("m", "m҉", $nik2);
$nik2 = str_replace("Q", "Q҉", $nik2);
$nik2 = str_replace("W", "W҉", $nik2);
$nik2 = str_replace("E", "E҉", $nik2);
$nik2 = str_replace("R", "R҉", $nik2);
$nik2 = str_replace("T", "T҉", $nik2);
$nik2 = str_replace("Y", "Y҉", $nik2);
$nik2 = str_replace("U", "U҉", $nik2);
$nik2 = str_replace("I", "I҉", $nik2);
$nik2 = str_replace("O", "O҉", $nik2);
$nik2 = str_replace("P", "P҉", $nik2);
$nik2 = str_replace("A", "A҉", $nik2);
$nik2 = str_replace("S", "S҉", $nik2);
$nik2 = str_replace("D", "D҉", $nik2);
$nik2 = str_replace("F", "F҉", $nik2);
$nik2 = str_replace("G", "G҉", $nik2);
$nik2 = str_replace("H", "H҉", $nik2);
$nik2 = str_replace("J", "J҉", $nik2);
$nik2 = str_replace("K", "K҉", $nik2);
$nik2 = str_replace("L", "L҉", $nik2);
$nik2 = str_replace("Z", "Z҉", $nik2);
$nik2 = str_replace("X", "X҉", $nik2);
$nik2 = str_replace("C", "C҉", $nik2);
$nik2 = str_replace("V", "V҉", $nik2);
$nik2 = str_replace("B", "B҉", $nik2);
$nik2 = str_replace("N", "N҉", $nik2);
$nik2 = str_replace("M", "M҉", $nik2);
$nik3 = $text;
$nik3 = str_replace('a', '𝕒', $nik3);
$nik3 = str_replace('b', '𝕓', $nik3);
$nik3 = str_replace('c', '𝕔', $nik3);
$nik3 = str_replace('d', '𝕕', $nik3);
$nik3 = str_replace('e', '𝕖', $nik3);
$nik3 = str_replace('f', '𝕗', $nik3);
$nik3 = str_replace('g', '𝕘', $nik3);
$nik3 = str_replace('h', '𝕙', $nik3);
$nik3 = str_replace('i', '𝕚', $nik3);
$nik3 = str_replace('j', '𝕛', $nik3);
$nik3 = str_replace('k', '𝕜', $nik3);
$nik3 = str_replace('l', '𝕝', $nik3);
$nik3 = str_replace('m', '𝕞', $nik3);
$nik3 = str_replace('n', '𝕟', $nik3);
$nik3 = str_replace('o', '𝕠', $nik3);
$nik3 = str_replace('p', '𝕡', $nik3);
$nik3 = str_replace('q', '𝕢', $nik3);
$nik3 = str_replace('r', '𝕣', $nik3);
$nik3 = str_replace('s', '𝕤', $nik3);
$nik3 = str_replace('t', '𝕥', $nik3);
$nik3 = str_replace('u', '𝕦', $nik3);
$nik3 = str_replace('v', '𝕧', $nik3);
$nik3 = str_replace('w', '𝕨', $nik3);
$nik3 = str_replace('x', '𝕩', $nik3);
$nik3 = str_replace('y', '𝕪', $nik3);
$nik3 = str_replace('z', '𝕫', $nik3); 
$nik3 = str_replace('A', '𝔸', $nik3);
$nik3 = str_replace('B', '𝔹', $nik3);
$nik3 = str_replace('C', 'ℂ', $nik3);
$nik3 = str_replace('D', '𝔻', $nik3);
$nik3 = str_replace('E', '𝔼', $nik3);
$nik3 = str_replace('F', '𝔽', $nik3);
$nik3 = str_replace('G', '𝔾', $nik3);
$nik3 = str_replace('H', 'ℍ', $nik3);
$nik3 = str_replace('I', '𝕀', $nik3);
$nik3 = str_replace('J', '𝕁', $nik3);
$nik3 = str_replace('K', '𝕂', $nik3);
$nik3 = str_replace('L', '𝕃', $nik3);
$nik3 = str_replace('M', '𝕄', $nik3);
$nik3 = str_replace('N', 'ℕ', $nik3);
$nik3 = str_replace('O', '𝕆', $nik3);
$nik3 = str_replace('P', 'ℙ', $nik3);
$nik3 = str_replace('Q', 'ℚ', $nik3);
$nik3 = str_replace('R', 'ℝ', $nik3);
$nik3 = str_replace('S', '𝕊', $nik3);
$nik3 = str_replace('T', '𝕋', $nik3);
$nik3 = str_replace('U', '𝕌', $nik3);
$nik3 = str_replace('V', '𝕍', $nik3);
$nik3 = str_replace('W', '𝕎', $nik3);
$nik3 = str_replace('X', '𝕏', $nik3);
$nik3 = str_replace('Y', '𝕐', $nik3);
$nik3 = str_replace('Z', 'ℤ', $nik3);
$nik4 = $text;
$nik4 = str_replace('a', '𝓪', $nik4);
$nik4 = str_replace('b', '𝓫', $nik4);
$nik4 = str_replace('c', '𝓬', $nik4);
$nik4 = str_replace('d', '𝓭', $nik4);
$nik4 = str_replace('e', '𝓮', $nik4);
$nik4 = str_replace('f', '𝓯', $nik4);
$nik4 = str_replace('g', '𝓰', $nik4);
$nik4 = str_replace('h', '𝓱', $nik4);
$nik4 = str_replace('i', '𝓲', $nik4);
$nik4 = str_replace('j', '𝓳', $nik4);
$nik4 = str_replace('k', '𝓴', $nik4);
$nik4 = str_replace('l', '𝓵', $nik4);
$nik4 = str_replace('m', '𝓶', $nik4);
$nik4 = str_replace('n', '𝓷', $nik4);
$nik4 = str_replace('o', '𝓸', $nik4);
$nik4 = str_replace('p', '𝓹', $nik4);
$nik4 = str_replace('q', '𝓺', $nik4);
$nik4 = str_replace('r', '??', $nik4);
$nik4 = str_replace('s', '𝓼', $nik4);
$nik4 = str_replace('t', '𝓽', $nik4);
$nik4 = str_replace('u', '𝓾', $nik4);
$nik4 = str_replace('v', '𝓿', $nik4);
$nik4 = str_replace('w', '𝔀', $nik4);
$nik4 = str_replace('x', '𝔁', $nik4);
$nik4 = str_replace('y', '𝔂', $nik4);
$nik4 = str_replace('z', '𝔃', $nik4); 
$nik4 = str_replace('A', '𝓐', $nik4);
$nik4 = str_replace('B', '𝓑', $nik4);
$nik4 = str_replace('C', '𝓒', $nik4);
$nik4 = str_replace('D', '𝓓', $nik4);
$nik4 = str_replace('E', '𝓔', $nik4);
$nik4 = str_replace('F', '𝓕', $nik4);
$nik4 = str_replace('G', '𝓖', $nik4);
$nik4 = str_replace('H', '𝓗', $nik4);
$nik4 = str_replace('I', '𝓘', $nik4);
$nik4 = str_replace('J', '𝓙', $nik4);
$nik4 = str_replace('K', '𝓚', $nik4);
$nik4 = str_replace('L', '𝓛', $nik4);
$nik4 = str_replace('M', '𝓜', $nik4);
$nik4 = str_replace('N', '𝓝', $nik4);
$nik4 = str_replace('O', '𝓞', $nik4);
$nik4 = str_replace('P', '𝓟', $nik4);
$nik4 = str_replace('Q', '𝓠', $nik4);
$nik4 = str_replace('R', '𝓡', $nik4);
$nik4 = str_replace('S', '𝓢', $nik4);
$nik4 = str_replace('T', '𝓣', $nik4);
$nik4 = str_replace('U', '𝓤', $nik4);
$nik4 = str_replace('V', '𝓥', $nik4);
$nik4 = str_replace('W', '𝓦', $nik4);
$nik4 = str_replace('X', '𝓧', $nik4);
$nik4 = str_replace('Y', '𝓨', $nik4);
$nik4 = str_replace('Z', '𝓩', $nik4); 
$nik5 = $text;
$nik5 = str_replace('a', '𝚊', $nik5);
$nik5 = str_replace('b', '𝚋', $nik5);
$nik5 = str_replace('c', '𝚌', $nik5);
$nik5 = str_replace('d', '𝚍', $nik5);
$nik5 = str_replace('e', '𝚎', $nik5);
$nik5 = str_replace('f', '𝚏', $nik5);
$nik5 = str_replace('g', '𝚐', $nik5);
$nik5 = str_replace('h', '𝚑', $nik5);
$nik5 = str_replace('i', '𝚒', $nik5);
$nik5 = str_replace('j', '𝚓', $nik5);
$nik5 = str_replace('k', '𝚔', $nik5);
$nik5 = str_replace('l', '𝚕', $nik5);
$nik5 = str_replace('m', '𝚖', $nik5);
$nik5 = str_replace('n', '𝚗', $nik5);
$nik5 = str_replace('o', '𝚘', $nik5);
$nik5 = str_replace('p', '𝚙', $nik5);
$nik5 = str_replace('q', '𝚚', $nik5);
$nik5 = str_replace('r', '𝚛', $nik5);
$nik5 = str_replace('s', '𝚜', $nik5);
$nik5 = str_replace('t', '𝚝', $nik5);
$nik5 = str_replace('u', '𝚞', $nik5);
$nik5 = str_replace('v', '𝚟', $nik5);
$nik5 = str_replace('w', '𝚠', $nik5);
$nik5 = str_replace('x', '𝚡', $nik5);
$nik5 = str_replace('y', '𝚢', $nik5);
$nik5 = str_replace('z', '𝚣', $nik5); 
$nik5 = str_replace('A', '𝙰', $nik5);
$nik5 = str_replace('B', '𝙱', $nik5);
$nik5 = str_replace('C', '𝙲', $nik5);
$nik5 = str_replace('D', '𝙳', $nik5);
$nik5 = str_replace('E', '𝙴', $nik5);
$nik5 = str_replace('F', '𝙵', $nik5);
$nik5 = str_replace('G', '𝙶', $nik5);
$nik5 = str_replace('H', '𝙷', $nik5);
$nik5 = str_replace('I', '𝙸', $nik5);
$nik5 = str_replace('J', '𝙹', $nik5);
$nik5 = str_replace('K', '𝙺', $nik5);
$nik5 = str_replace('L', '𝙻', $nik5);
$nik5 = str_replace('M', '𝙼', $nik5);
$nik5 = str_replace('N', '𝙽', $nik5);
$nik5 = str_replace('O', '𝙾', $nik5);
$nik5 = str_replace('P', '𝙿', $nik5);
$nik5 = str_replace('Q', '𝚀', $nik5);
$nik5 = str_replace('R', '𝚁', $nik5);
$nik5 = str_replace('S', '𝚂', $nik5);
$nik5 = str_replace('T', '𝚃', $nik5);
$nik5 = str_replace('U', '𝚄', $nik5);
$nik5 = str_replace('V', '𝚅', $nik5);
$nik5 = str_replace('W', '𝚆', $nik5);
$nik5 = str_replace('X', '𝚇', $nik5);
$nik5 = str_replace('Y', '𝚈', $nik5);
$nik5 = str_replace('Z', '𝚉', $nik5); 
$nik6 = $text;
$nik6 = str_replace("q", "𝙦", $nik6);
$nik6 = str_replace("w", "𝙬", $nik6);
$nik6 = str_replace("e", "𝙚", $nik6);
$nik6 = str_replace("r", "𝙧", $nik6);
$nik6 = str_replace("t", "𝙩", $nik6);
$nik6 = str_replace("y", "𝙮", $nik6);
$nik6 = str_replace("u", "𝙪", $nik6);
$nik6 = str_replace("i", "𝙞", $nik6);
$nik6 = str_replace("o", "𝙤", $nik6);
$nik6 = str_replace("p", "𝙥", $nik6);
$nik6 = str_replace("a", "𝙖", $nik6);
$nik6 = str_replace("s", "𝙨", $nik6);
$nik6 = str_replace("d", "𝙙", $nik6);
$nik6 = str_replace("f", "𝙛", $nik6);
$nik6 = str_replace("g", "𝙜", $nik6);
$nik6 = str_replace("h", "𝙝", $nik6);
$nik6 = str_replace("j", "𝙟", $nik6);
$nik6 = str_replace("k", "𝙠", $nik6);
$nik6 = str_replace("l", "𝙡", $nik6);
$nik6 = str_replace("z", "𝙯", $nik6);
$nik6 = str_replace("x", "𝙭", $nik6);
$nik6 = str_replace("c", "𝙘", $nik6);
$nik6 = str_replace("v", "𝙫", $nik6);
$nik6 = str_replace("b", "𝙗", $nik6);
$nik6 = str_replace("n", "𝙣", $nik6);
$nik6 = str_replace("m", "𝙢", $nik6);
$nik6 = str_replace("Q", "𝙌", $nik6);
$nik6 = str_replace("W", "𝙒", $nik6);
$nik6 = str_replace("E", "𝙀", $nik6);
$nik6 = str_replace("R", "𝙍", $nik6);
$nik6 = str_replace("T", "𝙏", $nik6);
$nik6 = str_replace("Y", "𝙔", $nik6);
$nik6 = str_replace("U", "𝙐", $nik6);
$nik6 = str_replace("I", "𝙄", $nik6);
$nik6 = str_replace("O", "𝙊", $nik6);
$nik6 = str_replace("P", "𝙋", $nik6);
$nik6 = str_replace("A", "𝘼", $nik6);
$nik6 = str_replace("S", "𝙎", $nik6);
$nik6 = str_replace("D", "𝘿", $nik6);
$nik6 = str_replace("F", "𝙁", $nik6);
$nik6 = str_replace("G", "𝙂", $nik6);
$nik6 = str_replace("H", "𝙃", $nik6);
$nik6 = str_replace("J", "𝙅", $nik6);
$nik6 = str_replace("K", "𝙆", $nik6);
$nik6 = str_replace("L", "𝙇", $nik6);
$nik6 = str_replace("Z", "𝙕", $nik6);
$nik6 = str_replace("X", "𝙓", $nik6);
$nik6 = str_replace("C", "𝘾", $nik6);
$nik6 = str_replace("V", "𝙑", $nik6);
$nik6 = str_replace("B", "𝘽", $nik6);
$nik6 = str_replace("N", "𝙉", $nik6);
$nik6 = str_replace("M", "𝙈", $nik6);

$nik7 = $text;
$nik7 = str_replace("q", "𝖖", $nik7);
$nik7 = str_replace("w", "𝖜", $nik7);
$nik7 = str_replace("e", "𝖊", $nik7);
$nik7 = str_replace("r", "𝖗", $nik7);
$nik7 = str_replace("t", "𝖙", $nik7);
$nik7 = str_replace("y", "𝖞", $nik7);
$nik7 = str_replace("u", "𝖚", $nik7);
$nik7 = str_replace("i", "𝖎", $nik7);
$nik7 = str_replace("o", "𝖔", $nik7);
$nik7 = str_replace("p", "𝖕", $nik7);
$nik7 = str_replace("a", "𝖆", $nik7);
$nik7 = str_replace("s", "𝖘", $nik7);
$nik7 = str_replace("d", "𝖉", $nik7);
$nik7 = str_replace("f", "𝖋", $nik7);
$nik7 = str_replace("g", "𝖌", $nik7);
$nik7 = str_replace("h", "𝖍", $nik7);
$nik7 = str_replace("j", "𝖏", $nik7);
$nik7 = str_replace("k", "𝖐", $nik7);
$nik7 = str_replace("l", "𝖑", $nik7);
$nik7 = str_replace("z", "𝖟", $nik7);
$nik7 = str_replace("x", "𝖝", $nik7);
$nik7 = str_replace("c", "𝖈", $nik7);
$nik7 = str_replace("v", "𝖛", $nik7);
$nik7 = str_replace("b", "𝖇", $nik7);
$nik7 = str_replace("n", "𝖓", $nik7);
$nik7 = str_replace("m", "𝖒", $nik7);
$nik7 = str_replace("Q", "𝕼", $nik7);
$nik7 = str_replace("W", "𝖂", $nik7);
$nik7 = str_replace("E", "𝕰", $nik7);
$nik7 = str_replace("R", "𝕽", $nik7);
$nik7 = str_replace("T", "𝕿", $nik7);
$nik7 = str_replace("Y", "𝖄", $nik7);
$nik7 = str_replace("U", "𝖀", $nik7);
$nik7 = str_replace("I", "𝕴", $nik7);
$nik7 = str_replace("O", "𝕺", $nik7);
$nik7 = str_replace("P", "𝕻", $nik7);
$nik7 = str_replace("A", "𝕬", $nik7);
$nik7 = str_replace("S", "𝕾", $nik7);
$nik7 = str_replace("D", "𝕯", $nik7);
$nik7 = str_replace("F", "𝕱", $nik7);
$nik7 = str_replace("G", "𝕲", $nik7);
$nik7 = str_replace("H", "𝕳", $nik7);
$nik7 = str_replace("J", "𝕵", $nik7);
$nik7 = str_replace("K", "𝕶", $nik7);
$nik7 = str_replace("L", "𝕷", $nik7);
$nik7 = str_replace("Z", "𝖅", $nik7);
$nik7 = str_replace("X", "𝖃", $nik7);
$nik7 = str_replace("C", "𝕮", $nik7);
$nik7 = str_replace("V", "𝖁", $nik7);
$nik7 = str_replace("B", "𝕭", $nik7);
$nik7 = str_replace("N", "𝕹", $nik7);
$nik7 = str_replace("M", "𝕸", $nik7);
$nik8 = $text;
$nik8 = str_replace("q", "ⓠ", $nik8);
$nik8 = str_replace("w", "ⓦ", $nik8);
$nik8 = str_replace("e", "ⓔ", $nik8);
$nik8 = str_replace("r", "ⓡ", $nik8);
$nik8 = str_replace("t", "ⓣ", $nik8);
$nik8 = str_replace("y", "ⓨ", $nik8);
$nik8 = str_replace("u", "ⓤ", $nik8);
$nik8 = str_replace("i", "ⓘ", $nik8);
$nik8 = str_replace("o", "ⓞ", $nik8);
$nik8 = str_replace("p", "ⓟ", $nik8);
$nik8 = str_replace("a", "ⓐ", $nik8);
$nik8 = str_replace("s", "ⓢ", $nik8);
$nik8 = str_replace("d", "ⓓ", $nik8);
$nik8 = str_replace("f", "ⓕ", $nik8);
$nik8 = str_replace("g", "ⓖ", $nik8);
$nik8 = str_replace("h", "ⓗ", $nik8);
$nik8 = str_replace("j", "ⓙ", $nik8);
$nik8 = str_replace("k", "ⓚ", $nik8);
$nik8 = str_replace("l", "ⓛ", $nik8);
$nik8 = str_replace("z", "ⓩ", $nik8);
$nik8 = str_replace("x", "ⓧ", $nik8);
$nik8 = str_replace("c", "ⓒ", $nik8);
$nik8 = str_replace("v", "ⓥ", $nik8);
$nik8 = str_replace("b", "ⓑ", $nik8);
$nik8 = str_replace("n", "ⓝ", $nik8);
$nik8 = str_replace("m", "ⓜ", $nik8);
$nik8 = str_replace("Q", "Ⓠ", $nik8);
$nik8 = str_replace("W", "Ⓦ", $nik8);
$nik8 = str_replace("E", "Ⓔ", $nik8);
$nik8 = str_replace("R", "Ⓡ", $nik8);
$nik8 = str_replace("T", "Ⓣ", $nik8);
$nik8 = str_replace("Y", "Ⓨ", $nik8);
$nik8 = str_replace("U", "Ⓤ", $nik8);
$nik8 = str_replace("I", "Ⓘ", $nik8);
$nik8 = str_replace("O", "Ⓞ", $nik8);
$nik8 = str_replace("P", "Ⓟ", $nik8);
$nik8 = str_replace("A", "Ⓐ", $nik8);
$nik8 = str_replace("S", "Ⓢ", $nik8);
$nik8 = str_replace("D", "Ⓓ", $nik8);
$nik8 = str_replace("F", "Ⓕ", $nik8);
$nik8 = str_replace("G", "Ⓖ", $nik8);
$nik8 = str_replace("H", "Ⓗ", $nik8);
$nik8 = str_replace("J", "Ⓙ", $nik8);
$nik8 = str_replace("K", "Ⓚ", $nik8);
$nik8 = str_replace("L", "Ⓛ", $nik8);
$nik8 = str_replace("Z", "Ⓩ", $nik8);
$nik8 = str_replace("X", "Ⓧ", $nik8);
$nik8 = str_replace("C", "Ⓒ", $nik8);
$nik8 = str_replace("V", "Ⓥ", $nik8);
$nik8 = str_replace("B", "Ⓑ", $nik8);
$nik8 = str_replace("N", "Ⓝ", $nik8);
$nik8 = str_replace("M", "Ⓜ", $nik8);
$nik9 = $text;
$nik9 = str_replace("q", "b", $nik9);
$nik9 = str_replace("w", "ʍ", $nik9);
$nik9 = str_replace("e", "ǝ", $nik9);
$nik9 = str_replace("r", "ɹ", $nik9);
$nik9 = str_replace("t", "ʇ", $nik9);
$nik9 = str_replace("y", "ʎ", $nik9);
$nik9 = str_replace("u", "n", $nik9);
$nik9 = str_replace("i", "ı", $nik9);
$nik9 = str_replace("o", "o", $nik9);
$nik9 = str_replace("p", "d", $nik9);
$nik9 = str_replace("a", "ɐ", $nik9);
$nik9 = str_replace("s", "s", $nik9);
$nik9 = str_replace("d", "p", $nik9);
$nik9 = str_replace("f", "ɟ", $nik9);
$nik9 = str_replace("g", "ƃ", $nik9);
$nik9 = str_replace("h", "ɥ", $nik9);
$nik9 = str_replace("j", "ɾ", $nik9);
$nik9 = str_replace("k", "ʞ", $nik9);
$nik9 = str_replace("l", "ן", $nik9);
$nik9 = str_replace("z", "z", $nik9);
$nik9 = str_replace("x", "x", $nik9);
$nik9 = str_replace("c", "ɔ", $nik9);
$nik9 = str_replace("v", "𐌡", $nik9);
$nik9 = str_replace("b", "q", $nik9);
$nik9 = str_replace("n", "u", $nik9);
$nik9 = str_replace("m", "ɯ", $nik9);
$nik9 = str_replace("Q", "b", $nik9);
$nik9 = str_replace("W", "ʍ", $nik9);
$nik9 = str_replace("E", "ǝ", $nik9);
$nik9 = str_replace("R", "ɹ", $nik9);
$nik9 = str_replace("T", "ʇ", $nik9);
$nik9 = str_replace("Y", "ʎ", $nik9);
$nik9 = str_replace("U", "n", $nik9);
$nik9 = str_replace("I", "ı", $nik9);
$nik9 = str_replace("O", "o", $nik9);
$nik9 = str_replace("P", "d", $nik9);
$nik9 = str_replace("A", "ɐ", $nik9);
$nik9 = str_replace("S", "s", $nik9);
$nik9 = str_replace("D", "p", $nik9);
$nik9 = str_replace("F", "ɟ", $nik9);
$nik9 = str_replace("G", "ƃ", $nik9);
$nik9 = str_replace("H", "ɥ", $nik9);
$nik9 = str_replace("J", "ɾ", $nik9);
$nik9 = str_replace("K", "ʞ", $nik9);
$nik9 = str_replace("L", "ן", $nik9);
$nik9 = str_replace("Z", "z", $nik9);
$nik9 = str_replace("X", "x", $nik9);
$nik9 = str_replace("C", "ɔ", $nik9);
$nik9 = str_replace("V", "𐌡", $nik9);
$nik9 = str_replace("B", "q", $nik9);
$nik9 = str_replace("N", "u", $nik9);
$nik9 = str_replace("M", "ɯ", $nik9);
$EN2 = $text;
$EN2 = str_replace('q', 'ᵠ' , $EN2);
$EN2 = str_replace('w', 'ʷ' , $EN2);
$EN2 = str_replace('e', 'ᵉ' , $EN2);
$EN2 = str_replace('r', 'ʳ' , $EN2);
$EN2 = str_replace('t', 'ᵗ' , $EN2);
$EN2 = str_replace('y', 'ʸ' , $EN2);
$EN2 = str_replace('u', 'ᵘ' , $EN2);
$EN2 = str_replace('i', 'ᶤ' , $EN2);
$EN2 = str_replace('o', 'ᵒ' , $EN2);
$EN2 = str_replace('p', 'ᵖ' , $EN2);
$EN2 = str_replace('a', 'ᵃ' , $EN2);
$EN2 = str_replace('s', 'ˢ' , $EN2);
$EN2 = str_replace('d', 'ᵈ' , $EN2);
$EN2 = str_replace('f', 'ᶠ' , $EN2);
$EN2 = str_replace('g', 'ᵍ' , $EN2);
$EN2 = str_replace('h', 'ʰ' , $EN2);
$EN2 = str_replace('j', 'ʲ' , $EN2);
$EN2 = str_replace('k', 'ᵏ' , $EN2);
$EN2 = str_replace('l', 'ˡ' , $EN2);
 $EN2 = str_replace('z', 'ᶻ' , $EN2);
$EN2 = str_replace('x', 'ˣ' , $EN2);
$EN2 = str_replace('c', 'ᶜ' , $EN2);
$EN2 = str_replace('v', 'ᵛ' , $EN2);
$EN2 = str_replace('b', 'ᵇ' , $EN2);
$EN2 = str_replace('n', 'ᶰ' , $EN2);
$EN2 = str_replace('m', 'ᵐ' , $EN2);
$EN = $text;
$EN = str_replace('q', '•🇶', $EN);
$EN = str_replace('w', '•🇼', $EN);
$EN = str_replace('e', '•🇪', $EN);
$EN = str_replace('r', '•🇷', $EN);
$EN = str_replace('t', '•🇹', $EN);
$EN = str_replace('y', '•🇾', $EN);
$EN = str_replace('v', '•🇻', $EN);
$EN = str_replace('i', '•🇮', $EN);
$EN = str_replace('o', '•🇴', $EN);
$EN = str_replace('p', '•🇵', $EN);
$EN = str_replace('a', '•🇦', $EN);
$EN = str_replace('s', '•🇸', $EN);
$EN = str_replace('d', '•🇩', $EN);
$EN = str_replace('f', '•🇫', $EN);
$EN = str_replace('g', '•🇬', $EN);
$EN = str_replace('h', '•🇭', $EN);
$EN = str_replace('j', '•🇯', $EN);
$EN = str_replace('k', '•🇰', $EN);
$EN = str_replace('l', '•🇱', $EN);
$EN = str_replace('z', '•🇿', $EN);
$EN = str_replace('x', '•🇽', $EN);
$EN = str_replace('c', '•🇨', $EN);
$EN = str_replace('u', '•🇺', $EN);
$EN = str_replace('b', '•🇧', $EN);
$EN = str_replace('n', '•🇳', $EN);
$EN = str_replace('m', '•🇲', $EN);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤵🏻‍♀️ Qizlar uchun

1️⃣ <code> ✿꯭➢꯭👒⃝  $nik1 🍒✿➢</code> 

2️⃣ <code> 💫 ➤ $nik2 🕊</code> 

3️⃣ <code> ❀꯭❥꯭❤️ $nik3 ᭞꯭🌼 ❀ ❥</code> 

4️⃣ <code> ꯭ 🌸༻ $nik4 ༺🌸</code> 

5️⃣ <code> ✿꯭❥꯭✨ $nik5 🍫 ❍❥ </code> 

6️⃣ <code> ➲꯭❣️⃝ $nik6 🍓✨🧸</code> 

7️⃣ <code> ❮꯭❤️҉꙰ 🦋 $nik7 🌝꙰꙰꯭꯭❯</code> 

8️⃣ <code>🌹🥀 $nik8 ☘️🌱🕊</code> 

9️⃣ <code>🌺•🎀$nik9 🎀•🌺</code> 

1️⃣0⃣ <code>$EN</code>

1️⃣1⃣  <code>$EN2</code>
</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⏪ Orqaga","callback_data"=>"menu12:7"]],
]
]),
]);
}












if(mb_stripos($callback, "menu11:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"⏪",
'parse_mode'=>'html',
'reply_markup'=>$home,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}



if(mb_stripos($callback, "menu12:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"⏪",
'parse_mode'=>'html',
'reply_markup'=>$vipp,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}
/*Ushbu Kod @UzBuilder Tomonidan Tuzib Chiqildi Va Tarqatildi
Manbaga Tegganni SOLAMAN
MANBA @UzBuilder Manba Bilan Ol*/

if(mb_stripos($callback, "menu13:")!==false){
$explode = explode("bulimlar:",$callback);
$explode = $explode[1];
$pul = file_get_contents("baza/$callcid/pul.txt");
if($pul>=0){
file_put_contents("baza/$callcid/numberb.txt","$explode");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
]);
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"⏪",
'parse_mode'=>'html',
'reply_markup'=>$bul11,
]);
}else{
bot('sendMessage', [
'chat_id'=>$callcid,
'text'=>"<b>Boʻlim tanlash uchun hisob raqam ochilmagan admin yozing</b>",
'parse_mode'=>'html',
'reply_markup'=>$ortga,
]);
}
}
