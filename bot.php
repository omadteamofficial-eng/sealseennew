<?php
define('API_KEY',"8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk"); 
$admin = "5753940532"; 
function put($fayl,$nima){
file_put_contents("$fayl","$nima");
}
function get($fayl){
$get = file_get_contents("$fayl");
return $get;
}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
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
$yangilash = json_decode(file_get_contents('php://input'));
$Personal_coders = $yangilash->message;
$id = $Personal_coders->chat->id;
$text = $Personal_coders->text;
$uid = $Personal_coders->from->id;
$name = $Personal_coders->from->first_name;
$step = file_get_contents("bot/$id.step"); 
mkdir("bot");
$orqa = "⬅️ Bekor qilish";
$PERSONAL_CODERS = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🤝 Sherik kerak"],['text'=>"💼 Ish joyi kerak"],],
]
]);  
$ha_yoq = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Ha"],['text'=>"Yo'q"],],
]
]);
$soroq = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$orqa"],],
]
]);
if(mb_stripos($Personal_coders->text,"/start")!==false){
bot('sendMessage',[
'chat_id'=>$Personal_coders->chat->id,
'text'=>"Bosh menu",
'parse_mode'=>'markdown',
'reply_markup'=>$PERSONAL_CODERS,
]);
}
if($Personal_coders->text == "$orqa" or $text == "Yo'q"){
bot('sendmessage',[
'chat_id'=>$Personal_coders->chat->id,
'text'=>"So'rovingizni bekor qildingiz.",
'parse_mode'=>"markdown",
'reply_markup'=>$PERSONAL_CODERS,
]);
unlink("bot/$id.step");
unlink("bot/$id.tmp1");
unlink("bot/$id.tmp2");
unlink("bot/$id.tmp3");
unlink("bot/$id.tmp4");
unlink("bot/$id.tmp5");
unlink("bot/$id.tmp6");
}
if($text == "🤝 Sherik kerak"){
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"*Sherik topish uchun ariza berish.*\n\nHozir sizga birnecha savollar beriladi. 
Har biriga javob bering. 
Oxirida agar hammasi to'g'ri bo'lsa, HA tugmasini bosing va arizangiz adminga yuboriladi.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish1");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"*Ism va familyangizni kiriting.*",
'parse_mode'=>"markdown",
'reply_markup'=>$soroq,
]);
}
if($step == "ish1"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.tmp1","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"📚 *Texnologiya:*

Talab qilinadigan texnologiyalarni kiriting.
Texnologiya nomlarini vergul bilan ajrating. 

Masalan: php, Java, C++.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish2");
}
}
if($step == "ish2"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.tmp2","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"🔏 *Siz bilan aloqa.*

Bog'lanish uchun raqamingizni kiriting.
Masalan: +998911234567",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish3");
}
}
if($step == "ish3"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.tmp3","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"📌 *Viloyatingizni kiriting.*

Masalan: Farg'ona",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish4");
}
}
if($step == "ish4"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.tmp4","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"👨🏻‍💻 *Kasbingizni kiriting.*

Masalan: Dasturchi",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish5");
}
}
if($step == "ish5"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.tmp5","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"🔎 *Maqsadingizni yozing.*

Maqsadingizni qisqacha yozib bering.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","ish6");
}
}
if($step == "ish6"){
put("bot/$id.tmp6","$text");
if($text == "⬅️ Bekor qilish"){
}else{
$get = file_get_contents("bot/$id.tmp1");
$get2 = file_get_contents("bot/$id.tmp2");
$get3 = file_get_contents("bot/$id.tmp3");
$get4 = file_get_contents("bot/$id.tmp4");
$get5 = file_get_contents("bot/$id.tmp5");
$get6 = file_get_contents("bot/$id.tmp6");
if($get and $get2 and $get3 and $get4 and $get5 and $get6){
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"🤝 Sherik kerak

1⃣ Ism familyasi: $get
2⃣ Texnalogiya: $get2
3⃣ Telegram manzili: <a href = 'tg://user?id=$uid'>$name</a> 
4⃣ Telefon raqami: $get3
5⃣ Yashash joyi: $get4
6⃣ Kasbi: $get5
7⃣ Maqsadi: $get6",
'parse_mode'=>"html",
]);
unlink("bot/$id.step");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"Barcha ma'lumotlar to'g'rimi",
'parse_mode'=>"html",
'reply_markup'=>$ha_yoq,
]);
}
}
}
if($text == "Ha"){
$get = file_get_contents("bot/$id.tmp1");
$get2 = file_get_contents("bot/$id.tmp2");
$get3 = file_get_contents("bot/$id.tmp3");
$get4 = file_get_contents("bot/$id.tmp4");
$get5 = file_get_contents("bot/$id.tmp5");
$get6 = file_get_contents("bot/$id.tmp6");
if($get and $get2 and $get3 and $get4 and $get5 and $get6){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"🤝 Sherik kerak

1⃣ Ism familyasi: $get
2⃣ Texnalogiya: $get2
3⃣ Telegram manzili: <a href = 'tg://user?id=$uid'>$name</a> 
4⃣ Telefon raqami: $get3
5⃣ Yashash joyi: $get4
6⃣ Kasbi: $get5
7⃣ Maqsadi: $get6",
'parse_mode'=>"html",
]);
unlink("bot/$id.step");
unlink("bot/$id.tmp1");
unlink("bot/$id.tmp2");
unlink("bot/$id.tmp3");
unlink("bot/$id.tmp4");
unlink("bot/$id.tmp5");
unlink("bot/$id.tmp6");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"📪*So'rovingiz tekshirish uchun adminga jo'natildi.*

E'lon 24-48 soat ichida kanalda chiqariladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$PERSONAL_CODERS,
]);
}else{
}
}
if($text == "💼 Ish joyi kerak"){
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"*Ish joy topish uchun ariza berish.*\n\nHozir sizga birnecha savollar beriladi. 
Har biriga javob bering. 
Oxirida agar hammasi to'g'ri bo'lsa, HA tugmasini bosing va arizangiz adminga yuboriladi.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh1");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"*Ism va familyangizni kiriting.*",
'parse_mode'=>"markdown",
'reply_markup'=>$soroq,
]);
}
if($step == "sh1"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.uzb1","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"*📚 Yoshingizni kiriting.*

Masalan: 19",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh2");
}
}
if($step == "sh2"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.uzb2","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"📚 *Texnologiya:*

Talab qilinadigan texnologiyalarni kiriting.
Texnologiya nomlarini vergul bilan ajrating. 

Masalan: php, Java, C++.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh3");
}
}
if($step == "sh3"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.uzb3","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"🔏 *Siz bilan aloqa.*

Bog'lanish uchun raqamingizni kiriting.
Masalan: +998911234567",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh4");
}
}
if($step == "sh4"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.uzb4","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"📌 *Viloyatingizni kiriting.*

Masalan: Farg'ona",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh5");
}
}
if($step == "sh5"){
if($text == "⬅️ Bekor qilish"){
}else{
put("bot/$id.uzb5","$text");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"🔎 *Maqsadingizni yozing.*

Maqsadingizni qisqacha yozib bering.",
'parse_mode'=>"markdown",
]);
put("bot/$id.step","sh6");
}
}
if($step == "sh6"){
put("bot/$id.uzb6","$text");
if($text == "⬅️ Bekor qilish"){
}else{
$get = file_get_contents("bot/$id.uzb1");
$get2 = file_get_contents("bot/$id.uzb2");
$get3 = file_get_contents("bot/$id.uzb3");
$get4 = file_get_contents("bot/$id.uzb4");
$get5 = file_get_contents("bot/$id.uzb5");
$get6 = file_get_contents("bot/$id.uzb6");
if($get and $get2 and $get3 and $get4 and $get5 and $get6){
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"💼 Ish joyi kerak

1⃣ Ism familyasi: $get
2⃣ Yoshi: $get2
3⃣ Telegram manzili: <a href = 'tg://user?id=$uid'>$name</a> 
4⃣ Texnalogiya: $get3
5⃣ Telfon raqami: $get4
6⃣ Yasash joyi: $get5
7⃣ Maqsadi: $get6",
'parse_mode'=>"html",
]);
unlink("bot/$id.step");
bot('sendmessage',[
'chat_id'=>$id,
'text'=>"Barcha ma'lumotlar to'g'rimi",
'parse_mode'=>"html",
'reply_markup'=>$ha_yoq,
]);
}
}
}
if($text == "Ha"){
$get = file_get_contents("bot/$id.uzb1");
$get2 = file_get_contents("bot/$id.uzb2");
$get3 = file_get_contents("bot/$id.uzb3");
$get4 = file_get_contents("bot/$id.uzb4");
$get5 = file_get_contents("bot/$id.uzb5");
$get6 = file_get_contents("bot/$id.uzb6");
if($get and $get2 and $get3 and $get4 and $get5 and $get6){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"💼 Ish joyi kerak

1⃣ Ism familyasi: $get
2⃣ Yoshi: $get2
3⃣ Telegram manzili: <a href = 'tg://user?id=$uid'>$name</a> 
4⃣ Texnalogiya: $get3
5⃣ Telfon raqami: $get4
6⃣ Yasash joyi: $get5
7⃣ Maqsadi: $get6",
'parse_mode'=>"html",
]);
unlink("bot/$id.step");
unlink("bot/$id.uzb1");
unlink("bot/$id.uzb2");
unlink("bot/$id.uzb3");
unlink("bot/$id.uzb4");
unlink("bot/$id.uzb5");
unlink("bot/$id.uzb6");
bot('sendmessage',[
'chat_id'=>$Personal_coders->chat->id,
'text'=>"📪*So'rovingiz tekshirish uchun adminga jo'natildi.*

E'lon 24-48 soat ichida kanalda chiqariladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$PERSONAL_CODERS,
]);
}else{
}
}
