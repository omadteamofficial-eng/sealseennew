<?php
ob_start();
date_default_timezone_set('Asia/Tashkent'); 
define('API_KEY',"8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk");
$soat = date('H:i');
$sana = date("d.m.Y");

/*manba: @education_coders*/
$EmeraldDev = "5753940532";
$oplatazz = "TezNakrutkachiNews"; //tolovlar kanal
$oplatachats = "TezNakrutkachiNews";//muhokama guruh
$sanaqachon = "202029";//bot ishga tushgan sana

$admins=file_get_contents("stat/admins.txt");
$admin = explode("\n", $admins);
array_push($admin,$EmeraldDev);

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
}}

///Avto Webhook!
$a=file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
echo $a;
//

function getAdmin($chat){
$url = "https://api.telegram.org/bot".API_KEY."/getChatAdministrators?chat_id=@".$chat;
$result = file_get_contents($url);
$result = json_decode ($result);
return $result->ok;
}

function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}

function joinchat($id){
global $mid;
$array = array("inline_keyboard");
$kanallar=file_get_contents("stat/kanal.txt");
if($kanallar == null){
return true;
}else{
$ex = explode("\n",$kanallar);
for($i=0;$i<=count($ex) -1;$i++){
$first_line = $ex[$i];
$first_ex = explode("@",$first_line);
$url = $first_ex[1];
$ism=bot('getChat',['chat_id'=>"@".$url,])->result->title;
$ret = bot("getChatMember",[
"chat_id"=>"@$url",
"user_id"=>$id,
]);
$stat = $ret->result->status;
if((($stat=="creator" or $stat=="administrator" or $stat=="member"))){
$array['inline_keyboard']["$i"][0]['text'] = "✅ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
}else{
$array['inline_keyboard']["$i"][0]['text'] = "❌ ". $ism;
$array['inline_keyboard']["$i"][0]['url'] = "https://t.me/$url";
$uns = true;
}
}
$array['inline_keyboard']["$i"][0]['text'] = "🔄 Tekshirish";
$array['inline_keyboard']["$i"][0]['callback_data'] = "check";
if($uns == true){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"<b>⚠️ Botdan to'liq foydalanish uchun quyidagi kanallarimizga obuna bo'ling!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode($array),
]);
exit();
return false;
}else{
return true;
}}}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$tx = $message->text;
$mid = $message->message_id;
$name1 = $message->from->first_name;
$fid = $message->from->id;
$name = $message->from->first_name;
$callback = $update->callback_query;
$data = $callback->data;
$callid = $callback->id;
$ccid = $callback->message->chat->id;
$cmid = $callback->message->message_id;
$from_id = $update->message->from->id;
$token = $message->text;
$text = $message->text;
$message_id = $callback->message->message_id;
$data = $update->callback_query->data;
$callcid=$update->callback_query->message->chat->id;
$botdel = $update->my_chat_member->new_chat_member; 
$botdelid = $update->my_chat_member->from->id;
$status= $botdel->status;
$doc = $update->message->document;
$doc_id = $doc->file_id;
$cqid = $update->callback_query->id;
$callfrid = $update->callback_query->from->id;
$botname = bot('getme',['bot'])->result->username;
$callname = $update->callback_query->from->first_name;
$frid= $update->callback_query->from->id;
#-----------------------------
if(!file_exists("kabinet/$fid.som")){
file_put_contents("kabinet/$fid.som","0");
}
$som = file_get_contents("kabinet/$fid.som");
if(!file_exists("kabinet/$fid.dpz")){
file_put_contents("kabinet/$fid.dpz","0");
}
$dpz = file_get_contents("kabinet/$fid.dpz");
if(file_get_contents("azo.dat")){
}else{
file_put_contents("azo.dat","");
}
if(file_get_contents("stat/kirit.txt")){
}else{
file_put_contents("stat/kirit.txt","0");
}
if(file_get_contents("stat/kanal.txt")){
}else{
file_put_contents("stat/kanal.txt","");
}
if(file_get_contents("stat/tolov.txt")){
}else{
file_put_contents("stat/tolov.txt","");
}
$krt = file_get_contents("stat/kirit.txt");
if(file_get_contents("stat/yech.txt")){
}else{
file_put_contents("stat/yech.txt","0");
}
$ych = file_get_contents("stat/yech.txt");
if(file_get_contents("stat/payments.txt")){
}else{
file_put_contents("stat/payments.txt","");
}
if(!file_exists("stat/date.txt")){  
file_put_contents("stat/date.txt","1");
}

if(!file_exists("sozlama/asosiy/adminuser.txt")){  
file_put_contents("sozlama/asosiy/adminuser.txt","shakh_akn");
}
if(!file_exists("sozlama/asosiy/cashback.txt")){  
file_put_contents("sozlama/asosiy/cashback.txt","2");
}
if(!file_exists("sozlama/asosiy/minimum.txt")){  
file_put_contents("sozlama/asosiy/minimum.txt","60000");
}
if(!file_exists("sozlama/asosiy/usluga.txt")){  
file_put_contents("sozlama/asosiy/usluga.txt","3");
}

$adminuser = file_get_contents("sozlama/asosiy/adminuser.txt");
$incashback = file_get_contents("sozlama/asosiy/cashback.txt");
$inminimum = file_get_contents("sozlama/asosiy/minimum.txt");
$inusluga = file_get_contents("sozlama/asosiy/usluga.txt");
$saved = file_get_contents("step/shoxrux.txt");
$pay = file_get_contents("stat/payments.txt");
#-----------------------------
mkdir("kabinet");
mkdir("sozlama");
mkdir("sozlama/asosiy");
mkdir("step");
mkdir("stat");
mkdir("ban");
mkdir("vip");
mkdir("tarif");
mkdir("tarif/$cid");
#-----------------------------
$shoxrux = file_get_contents("step/test.txt");
$test1 = file_get_contents("step/test1.txt");
$test2 = file_get_contents("step/test2.txt");

$turi = file_get_contents("vip/turi.txt");
$narxivip = file_get_contents("vip/$shoxrux/narxi.txt");
$kunlikvip = file_get_contents("vip/$shoxrux/kunlik.txt");
$vipinfo= file_get_contents("vip/$shoxrux/info.txt");
#----------+----------

$ban = file_get_contents("ban/$fid.txt");
$chans=file_get_contents("stat/kanal.txt");
$tkanal=file_get_contents("stat/tolov.txt");
$stat=file_get_contents("azo.dat");
$userstep=file_get_contents("step/$fid.txt");
$soat=date("H:i",strtotime("2 hour"));

if($tx){
if($ban == "ban"){
exit();
}else{
}}

if($data){
$ban = file_get_contents("ban/$ccid.txt");
if($ban == "ban"){
exit();
}else{
}}

if(isset($message)){
$get = file_get_contents("azo.dat");
if(mb_stripos($get,$fid)==false){
file_put_contents("azo.dat",  "$get\n$fid");
}}

$statistika = file_get_contents("azo.dat");
$soat=date("H:i",strtotime("2 hour"));

$main_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💎 VIP Market"]],
[['text'=>"💰 Hisobim"],['text'=>"💸 Pul ishlash"]],
[['text'=>"📚 Ma'lumot"],['text'=>"📝 Murojaat"]],
]]);

$main_menuad = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💎 VIP Market"]],
[['text'=>"💰 Hisobim"],['text'=>"💸 Pul ishlash"]],
[['text'=>"📚 Ma'lumot"],['text'=>"📝 Murojaat"]],
[['text'=>"🗄 Boshqarish"]],
]]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"⚙️ Asosiy sozlamalar"]],
[['text'=>"📢 Kanallar"],['text'=>"📊 Statistika"]],
[['text'=>"📩 Xabarnoma"],['text'=>"💎 VIP Sozlamalar"]],
[['text'=>"🔎 Foydalanuvchini boshqarish"]],
[['text'=>"👥 Adminlar"],['text'=>"◀️ Orqaga"]],
]]);

if(in_array($cid,$admin)){
$menyu = $main_menuad;
}
if(in_array($cid,$admin)){
}else{
$menyu = $main_menu;
}

if($soat == "00:00"){
$ikunm=file_get_contents("stat/date.txt");
$day = $ikunm + 1;
file_put_contents("stat/date.txt","$day");
}

$ikunmm=file_get_contents("stat/date.txt");


if(in_array($ccid,$admin)){
$menyus = $main_menuad;
}
if(in_array($ccid,$admin)){
}else{
$menyus = $main_menu;
}
//start

if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🏠 Asosiy menyudasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}

if($text == "◀️ Orqaga"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🏠 Asosiy menyudasiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
}




if($data=="orqagauzm" and joinchat($ccid)==true){
$kategoriya = file_get_contents("vip/turi.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"vipinfok-$title"];
$keyboard2 = array_chunk($key, 2);
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($kategoriya == null){
bot("answerCallbackQuery",[
"callback_query_id"=>$callid,
"text"=>"⚠️ VIP tizimlari mavjud emas!",
"show_alert"=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💎 VIP tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
}}

if($text=="💎 VIP Market" and joinchat($cid)==true){
$kategoriya = file_get_contents("vip/turi.txt");
$more = explode("\n",$kategoriya);
$soni = substr_count($kategoriya,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"vipinfok-$title"];
$keyboard2 = array_chunk($key, 2);
$bolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($kategoriya == null){
bot("sendmessage",[
"chat_id"=>$cid,
"text"=>"⚠️ VIP tizimlari mavjud emas!",
]);
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>💎 VIP tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$bolim,
]);
}}


if(mb_stripos($data, "vipinfok-")!==false){
$ex = explode("-",$data);
$aniqkategoruya = $ex[1];
$vipningprice = file_get_contents("vip/$aniqkategoruya/narxi.txt");
 $kunlikprice = file_get_contents("vip/$aniqkategoruya/kunlik.txt");
 $umumsumma=$kunlikprice*30;
$shutarif = file_get_contents("tarif/$ccid/vipdaraja.txt");
$turi = file_get_contents("tarif/$ccid/$ccid.txt");
$json = json_decode(file_get_contents("tarif/$ccid/tarif.json")); 
if($turi == "ViP"){
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"<i>✅ Siz <b>$shutarif</b> tarifdasiz</i>

💡 Tarif tugashiga: <b>".$json->kun."</b> kun qoldi",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Ortga",'callback_data'=>"orqagauzm"]],
]])
]);
}else{
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📌 VIP daraja:</b> <u>$aniqkategoruya</u>

💳 VIP narxi:<b> $vipningprice</b> so'm
💳 Kunlik daromad:<b> $kunlikprice</b> so'm

<b>📝 VIP Haqida: </b>
— VIP ga azo bo'lganingizdan so'ng siz kunlik daromadi har kuni $kunlikvipku so'mdan olib bo'rasiz.
Bu ko'stakich 30 kun davom etadi va 30 kundan ken buni yana aktivlashtirsangiz bo'ladi yoki boshqa VIP tariflarni olsangiz ham bo'ladi.

30 kun mobaynida siz o'z pulingizni  $umumsumma so'm qilib olasiz.!

Kutmang tezroq pul ishlashni boshlang.!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"💎 «VIP» tizimni sotib olish",'callback_data'=>"sotibolish-$aniqkategoruya-$vipningprice-$kunlikprice"]],
[['text'=>"◀️ Ortga",'callback_data'=>"orqagauzm"]],
]])
]);
}}

if(mb_stripos($data, "sotibolish-")!==false){
$ex = explode("-",$data);
$kats = $ex[1];
$vipninarxi = $ex[2];
$vipkunligi = $ex[3];
$umumsummam = file_get_contents("kabinet/$ccid.som");
if($umumsummam < "$vipninarxi"){
bot("answerCallbackQuery",[
"callback_query_id"=>$callid,
"text"=>"💸 Hisobingizda yetarli mablag' mavjud emas! 

💰 Iltimos hisobingizni to'ldiring.!",
"show_alert"=>true,
]);
}else{
unlink("tarif/$ccid/$ccid.txt");
$t=date("d");
$d['sana']=$t;
$d['kun']=30;
file_put_contents("tarif/$ccid/tarif.json",json_encode($d)); 
file_put_contents("tarif/$ccid/$ccid.txt","ViP");
file_put_contents("tarif/$ccid/id.txt","$ccid");
file_put_contents("tarif/$ccid/vipdaraja.txt","$kats");
file_put_contents("tarif/$ccid/vipkunligi.txt","$vipkunligi");
file_put_contents("tarif/$ccid/vipnarxi.txt","$vipninarxi");
$umumsummamku = file_get_contents("kabinet/$ccid.som");
$ayirgina = $umumsummamku - $vipninarxi;
file_put_contents("kabinet/$ccid.som",$ayirgina);
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"✅",
'parse_mode'=>'html',
]);
sleep(0.5);
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"🎊 Tabriklaymiz siz <b>$kats</b> ta'rifni sotib oldingiz!

✅ Sizni tarifingiz: <b>$kats</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Ortga",'callback_data'=>"orqagauzm"]],
]])
]);
}}


if($text == "💸 Pul ishlash"){
$shutarif = file_get_contents("tarif/$cid/vipdaraja.txt");
	$vipninarxi = file_get_contents("tarif/$cid/vipnarxi.txt");
	$vipkunligi = file_get_contents("tarif/$cid/vipkunligi.txt");
if($shutarif == null){
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>❗️ VIP Bo'lim sotib olmagansiz sizga pul ishlash imkonsiz</b>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
[['text'=>"🛒 VIP bo'lim sotib olish",'callback_data'=>"orqagauzm"]],
	]
	])
	]);
	exit();
}else{
	$shutarif = file_get_contents("tarif/$cid/vipdaraja.txt");
	$vipninarxi = file_get_contents("tarif/$cid/vipnarxi.txt");
	$vipkunligi = file_get_contents("tarif/$cid/vipkunligi.txt");
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Siz hozir $shutarif tarifdasiz va sizning kunlik daromadingiz $vipkunligi so'm</b> 

💸Kunlik daromad olishingi mumkin",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"💸 Kunlik daromad olish",'callback_data'=>"daromadiniu-$shutarif-$vipkunligi-$vipninarxi"]],
	]
	])
	]);
	exit();
}
}

$shoxauz = date("d.m.Y");

mkdir("bonus");
if(mb_stripos($data, "daromadiniu-")!==false){
$ex = explode("-",$data);
$katss = $ex[1];
$bonuskunlig = $ex[2];
$bonusnarx = $ex[3];
$bonus = file_get_contents("bonus/$ccid.txt");
if($bonus != $shoxauz){
$umumsummamkuu = file_get_contents("kabinet/$ccid.som");
$qowamiz = $umumsummamkuu + $bonuskunlig;
file_put_contents("kabinet/$ccid.som",$qowamiz);
file_put_contents("bonus/$ccid.txt","$sana");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"💸 Kunlik daromad  - $bonuskunlig so'm


✅ <b>Kunlik daromad berildi!</b> ✅",
'parse_mode'=>'html',
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🏠 Bosh menyu",'callback_data'=>"boshmenyu"]],
	]
	])
]);
}else{
	bot("answerCallbackQuery",[
        "callback_query_id"=>$callid,
'text'=>"❌ Bugun kunlik daromad olgansiz!",
        "show_alert"=>true,
 ]);
}
}else{
bot('answerCallbackQuery',[
		'callback_query_id'=>$bos,
		'text'=>"🚫 Texnik xatolik!",
		'show_alert'=>true,
		]);
}

if($data=="boshmenyu"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🏠 Bosh menyudasiz</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
}

$t=date("d"); 
$glob=glob("tarif/*/id.txt"); 
foreach($glob as $globa){ 
$ids = str_replace(["tarif/","/id.txt"], ["",""], $globa); 
$turi = file_get_contents("tarif/$ids/$ids.txt"); 
$files = json_decode(file_get_contents("tarif/$ids/tarif.json")); 
if($turi == "ViP"){ 
if($files->sana!=$t){ 
$d["sana"]=$t; 
$d["kun"]=$files->kun-1;
file_put_contents("tarif/$ids/tarif.json",json_encode($d)); 
} 
if($files->kun==0 or $files->kun<=0){ 
bot('sendMessage',[ 
'chat_id'=>$ids, 
'text'=>"🔄 <i>Sizning <b>ViP</b> tarfingiz tugadi.

<b>👤 Siz yana 💎 «VIP» sotib olib qaytadan aktivlashtirsangiz bo'ladi.!</b> </i>", 
'parse_mode'=>"html", 
]); 
deleteFolder("tarif/$ids");
deleteFolder("tarif/$cid");
}}
}



if($tx=="💰 Hisobim" and joinchat($cid)==true){
if(in_array($cid,$admin)){
$odam="Adminstrator";
}else{
$odam="Foydalanuvchi";
}
$taklif=file_get_contents("kabinet/$cid.txt");
if($taklif){
$name="<a href='tg://user?id=$taklif'>$taklif </a>";
}else{
$name="Hech kim";
}
bot('SendPhoto',[
'photo'=>"https://t.me/shakhfarm/35",
'chat_id'=>$cid,
'caption'=>"<b>┌🏛 Sizning botdagi kabinetingiz
├
├Botdagi vazifa:</b> $odam
<b>├ID raqamingiz:</b> <code>$cid</code>
<b>├Asosiy balans:</b> $som so'm
<b>├Depozitingiz:</b> $dpz so'm
<b>├Sizni taklif qildi:</b> $name
├
<b>└@$botname - Yuqori daromad!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📤 Pul kiritish",'callback_data'=>"kiritish"],['text'=>"📥 Pul yechish",'callback_data'=>"yechish"]],
[['text'=>"⚙️ Tarifni boshqarish",'callback_data'=>"tarifni_boshqar"]],
]])
]);
exit();
}

	
if($data == "tarifni_boshqar"){
	$shutarif = file_get_contents("tarif/$ccid/vipdaraja.txt");
	$vipninarxi = file_get_contents("tarif/$ccid/vipnarxi.txt");
	$vipkunligi = file_get_contents("tarif/$ccid/vipkunligi.txt");
	if($shutarif == null){
			bot('answerCallbackQuery',[
	'callback_query_id'=>$callid,
	'text'=>"⚙️ Sizda VIP tarifni boshqarish uchun tarifingiz mavjud emas.!",
	'show_alert'=>true,
	]);
}else{
        bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
        'text'=>"👇 <b>Sizning tarifingiz:</b>",
'parse_mode'=>"html",
        'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"$shutarif",'callback_data'=>"deleteqilaman-$cid"]],
	]
	])
]);
}
}

if(mb_stripos($data,"deleteqilaman-")!==false){
$foydalanuvchi=explode("-",$data)[1];
$shutarif = file_get_contents("tarif/$ccid/vipdaraja.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Eslatma:</b> Siz <b>$shutarif</b> tarifiga tikkan mablag'ingiz qaytarilmaydi va u o'chiriladi.!

<b>⛔ Bu narsa bo'yicha xech qanaqa etirozlar qabul qilinmaydi!</b>

Agar haqiqatanam o'chirmoqchi bo'lsangiz <b><u>«✅ Tasdiqlash»</u></b> tugmasini bosing:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"delettrue-$foydalanuvchi"]],
[['text'=>"⛔ Bekor qilish",'callback_data'=>"boshmenyu"]],
]])
]);
}

if(mb_stripos($data,"delettrue-")!==false){
$deletism=explode("-",$data)[1];
$del = file_get_contents("tarif");
$k = str_replace("\n".$deletism."","",$del);
file_put_contents("tarif",$k);
deleteFolder("tarif/$deletism");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Tarif o'chirildi</b>",
'parse_mode'=>"html",
]);
}

if($data=="yechish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📥 Pulingizni yechish uchun birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🅿️ Payeer",'callback_data'=>"pul=PAYEER"],['text'=>"💳 Humo / Uzcard",'callback_data'=>"pul=HUMO/UZCARD"]],
]])
]);
}

if($data=="kiritish"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📤 Pul kiritish uchun birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"HUMO (+$incashback%)",'callback_data'=>"krt=HUMO"]],
/*[['text'=>"PAYME[AVTO] (+7%)",'callback_data'=>"avto=PAYME"]],*/
]])
]);
}

if($data=="avto=PAYME"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 To'lov miqdorini yuboring:</b>

Har qanday to'lov uchun +7% bonus beriladi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","payme");
exit();
}

if($userstep == "payme"){
if(is_numeric($text)){
if($text >= 3000){
$amount = $text;
$card = "639728eaf9b3d2b5a8ea422b";
$description = "@$botname";
$checkout = json_decode(file_get_contents("http://m2886.myxvest.ru/TezNakrutkachiBot/payme.php?action=create&sum=".$amount."&desc=".urlencode($description)."&card=".$card.""),true);
$url = $checkout['_pay_url'];
$check_id = $checkout['_id'];
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📋 To'lov miqdori qabul qilindi!</b>

To'lovni bajarish uchun quyidagi tugmalardan foydalaning:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔐 Ilovaga kirish",'url'=>"$url"]],
[['text'=>"To'lovni tekshirish",'callback_data'=>"checkout=$check_id=$amount"]],
]])
]);
unlink("step/$cid.txt");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Minimal to'lov narxi 3000 so'm</b>

Qayta yuboring:",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🤷🏻‍♂ Raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
]);
exit();
}}

if(mb_stripos($data,"checkout=")!==false){
$check_id = explode("=",$data)[1];
$amount = explode("=",$data)[2];
$payments = file_get_contents("stat/payments.txt");
if(mb_stripos($payments,$check_id)!==false){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"🤷🏻‍♂ Ushbu to'lovga pul berilgan!",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
exit();
}else{
$get = json_decode(file_get_contents("http://m2886.myxvest.ru/TezNakrutkachiBot/payme.php?action=info&id=".$check_id.""),true);
$result = $get['mess'];
if($result == "successfully"){
file_put_contents("stat/payments.txt","\n".$check_id,FILE_APPEND);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$som=file_get_contents("kabinet/$ccid.som");
$som += $amount + $amount/100*7;
file_put_contents("kabinet/$ccid.som", $som);
$dpz=file_get_contents("kabinet/$ccid.dpz");
$dpz += $amount;
file_put_contents("kabinet/$ccid.dpz",$dpz);
bot('sendMessage',[
'chat_id'=>$tkanal,
'text'=>"<b>📤 Foydalanuvchi hisobini to'ldirdi!</b>

<b>▫️ Foydalanuvchi:</b> <a href='tg://user?id=$ccid'>$ccid</a>
<b>▫️ To'lov turi:</b> <u>PAYME[AVTO]</u>
<b>▫️ Summa:</b> $som(+7%) so'm 

<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖",'url'=>"https://t.me/$botname"]],
]])
]);
$caw = file_get_contents("kabinet/$ccid.txt");
$tkf = file_get_contents("kabinet/$caw.som");
$plus3 = $amount/100*3 + $tkf;
bot('SendMessage',[
'chat_id'=>$caw,
'text'=>"<b>📳 Do'stingiz hisobini to'ldirgani uchun sizga $plus3 so'm qo'shildi!</b>",
'parse_mode'=>'html',
]);
file_put_contents("kabinet/$caw.som",$plus3);
$krt = file_get_contents("stat/kirit.txt");
$plus4 = $krt + $amount;
file_put_contents("stat/kirit.txt",$plus4);
unlink("step/$cid.txt");
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Muvaffaqiyatli qabul qilindi!</b>

Hisobingizga $som so'm qo'shildi",
'parse_mode'=>'html',
'reply_markup'=>$menyus,
]);
exit();
}else{
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>🤷🏻‍♂ Ushbu toʻlov amalga oshirilmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyus,
]);
exit();
}}}

if(mb_stripos($data, "pul=")!==false){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$pulim=file_get_contents("kabinet/$ccid.som");
if($pulim>=$inminimum){
$ex = explode("=",$data);
$hamyon = $ex[1];
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>✅ Hamyon qabul qilindi!</b>

$hamyon - karta raqamini yuboring:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","hamyon=$hamyon");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Minimal pul yechish narxi: $inminimum so'm</b>",
'parse_mode'=>'html',
]);
exit();
}}

if(mb_stripos($userstep, "hamyon=")!==false){
$ex = explode("=",$userstep);
$hamyon = $ex[1];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 Pul yechish uchun miqdorni yuboring:

Balans:</b> $som so'm ($inusluga% komissiya)",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid.txt","miqdor=$hamyon=$text");
exit();
}}

if(mb_stripos($userstep, "miqdor=")!==false){
$ex = explode("=",$userstep);
$hamyon = $ex[1];
$raqam = $ex[2];
$foiz = $text/100*$inusluga;
$miqdor = $text - $foiz;
$pul = file_get_contents("kabinet/$cid.som");
$minus=$pul-$text;
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
if($text>=$inminimum){
if($pul>=$text){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"⏳ <b>Pul yechib olish uchun ariza yuborildi!

▫️ To'lov turi:</b> <u>$hamyon</u>
<b>▫️ Summa:</b> <del>$text</del> $miqdor so'm (-$inusluga%) 
<b>▫️ Karta raqam:</b> <code>$raqam</code>

Pulingiz to'lab berish oralig'i 1-daqiqadan 10-soatgacha davom etadi!
<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
file_put_contents("kabinet/$cid.som",$minus);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>📥 Pul yechish uchun ariza keldi!

• To'lov turi:</b> <u>$hamyon</u>
• <b>Pul miqdori:</b> $miqdor so'm
• <b>Hamyon raqami:</b> <code>$raqam</code>",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'landi",'callback_data'=>"tolandi-$cid-$hamyon-$raqam-$miqdor"]],
[['text'=>"❌ To'lanmadi",'callback_data'=>"tolanmadi-$cid-$miqdor"]],
]])
]);
unlink("step/$cid.txt");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"⚠️ <b>Mablag' yetarli emas!</b>",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⚠️ Minimal pul yechish narxi: $inminimum so'm</b>",
'parse_mode'=>'html',
]);
exit();
}}}

if(mb_stripos($data,"tolandi-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$hamyon = $ex[2];
$raqam = $ex[3];
$miqdor = $ex[4];
$investor = "$raqam"; 
$ohr = substr($investor,12,16); 
$bow = substr($investor,0,4); 
$investorFun =  "$bow****$ohr"; 
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Foydalanuvchi $miqdor so'm puli to'lab berildi!</b>",
'parse_mode'=>'html',
]);
$yech = file_get_contents("stat/yech.txt");
$plus = $yech + $miqdor;
file_put_contents("stat/yech.txt",$plus);
bot('sendMessage',[
'chat_id'=>$tkanal,
'text'=>"<b>📤 Foydalanuvchi puli to'lab berildi!</b>

<b>▫️ Foydalanuvchi:</b> <a href='tg://user?id=$id'>$id</a>
<b>▫️ To'lov turi:</b> <u>$hamyon</u>
<b>▫️️ Yechilgan summa:</b> $miqdor so'm 
<b>▫️ Karta raqam:</b> <code>$investorFun</code>

<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖",'url'=>"https://t.me/$botname"]],
]])
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"<b>✅ Pul yechish uchun so'rovingiz tasdiqlandi!</b>

Pullaringiz $hamyon kartangizga tushurib berildi, sarmoyalarni biz bilan amalga oshiring",
'parse_mode'=>'html',
]);
exit();
}

if(mb_stripos($data,"tolanmadi-")!==false){
$ex = explode("-",$data);
$id = $ex[1];
$miqdor = $ex[2];
$pul = file_get_contents("kabinet/$id.som");
$m = $pul + $miqdor;
file_put_contents("kabinet/$id.som",$m);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<a href='tg://user?id=$id'>Foydalanuvchi</a> <b>arizasi bekor qilindi!</b>",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$id,
'text'=>"<b>⛔️ Pul yechish uchun arizangiz bekor qilindi!</b>

Keyinroq qayta urining yoki ma'lumotlarni yaxshilab tekshiring",
'parse_mode'=>'html',
]);
exit();
}

if(mb_stripos($data, "krt=")!==false){
$ex = explode("=",$data);
$kategoriya = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📤 To‘lov turi:</b> <u>$kategoriya</u>

<b>💳 Karta:</b> <code>kartaraqami</code>
<b>📝 Izoh:</b> <code>#ID$ccid</code>

<b>📋 Ma'lumot:</b> 
Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «To'lov qildim ✅» tugmasini bosing; 
4) Qancha pul miqdoni yuborganingizni kiritin;
3) Toʻlov haqidagi suratni botga yuboring;
3) Operator tomonidan almashuv tasdiqlanishini kuting!

❗️ 1ta chekni ikki yoki undan ortiq tashlamang, Tasdiqlanish 60daqiqa vaqt oladi, Ushbu toʻlov tizimiga izoh kiritish majburiy emas!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"tolov"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kiritish"]],
]])
]);
exit();
}

if($data=="tolov"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 To'lovingizni miqdorini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt",'rasm');
exit();
}

if($userstep=="rasm"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🧾 To'lovingiz haqidagi chekni shu yerga yuboring:</b>",
'parse_mode'=>'html',
]);
file_put_contents("step/$cid.txt","tasdiq=$text");
exit();
}}

if(mb_stripos($userstep, "tasdiq=")!==false){
$ex = explode("=",$userstep);
$miqdor = $ex[1];
if($tx=="◀️ Orqaga"){
unlink("step/$fid.txt");
}else{
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
$bonus=$miqdor/100*$incashback+$miqdor;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏳ Hisob to'ldirish uchun ariza yuborildi!

▫️️ To'lov turi:</b> <u>HUMO</u>
<b>▫️ Summa:</b> $bonus(+$incashback%) so'm

To'lovingiz tasdiqlanish oralig'i 1-daqiqadan 2-soatgacha davom etadi!
<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$fid.txt");
bot('sendPhoto',[
'chat_id'=>$EmeraldDev,
'photo'=>$file,
'caption'=>"<b>📤 Hisob to'ldirish uchun ariza keldi!

▫️ Foydalanuvchi:</b> <a href='https://tg://user?id=$cid'>$cid</a>
<b>▫️️ To'lov turi:</b> <u>HUMO</u>
<b>▫️ Summa:</b> $miqdor so'm",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"on=$cid=$miqdor"]],
[['text'=>"❌ Bekor qilish",'callback_data'=>"off=$cid"]],
]])
]);
exit();
}}

if(mb_stripos($data,"on=")!==false){
$odam=explode("=",$data)[1];
$miqdor=explode("=",$data)[2];
$som = file_get_contents("kabinet/$odam.som");
$plus1 = $som + $miqdor/100*$incashback+$miqdor;
$dpz = file_get_contents("kabinet/$odam.dpz");
$plus2 = $dpz + $miqdor;
$caw = file_get_contents("kabinet/$odam.txt");
$tkf = file_get_contents("kabinet/$caw.som");
$plus3 = $miqdor/100*$incashback + $tkf;
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>✅ Hisob to'ldirish uchun arizangiz tasdiqlandi!</b>

Asosiy hisobingizga $plus1 so'm qo'shildi",
'parse_mode'=>'html',
]);
file_put_contents("kabinet/$odam.som",$plus1);
file_put_contents("kabinet/$odam.dpz",$plus2);
bot('sendMessage',[
'chat_id'=>$tkanal,
'text'=>"<b>📤 Foydalanuvchi hisobini to'ldirdi!</b>

<b>▫️ Foydalanuvchi:</b> <a href='tg://user?id=$odam'>$odam</a>
<b>▫️ To'lov turi:</b> <u>HUMO</u>
<b>▫️ Summa:</b> $plus1(+$incashback%) so'm 

<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖",'url'=>"https://t.me/$botname"]],
]])
]);
bot('SendMessage',[
'chat_id'=>$caw,
'text'=>"<b>📳 Do'stingiz hisobini to'ldirgani uchun sizga $plus3 so'm qo'shildi!</b>",
'parse_mode'=>'html',
]);
file_put_contents("kabinet/$caw.som",$plus3);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Foydalanuvchi hisobiga $miqdor so'm qo'shildi!</b>",
'parse_mode'=>'html',
]);
$krt = file_get_contents("stat/kirit.txt");
$plus4 = $krt + $miqdor;
file_put_contents("stat/kirit.txt",$plus4);
exit();
}

if(mb_stripos($data,"off=")!==false){
$odam=explode("=",$data)[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
$hisob=file_get_contents("step/hisob.$odam");
bot('SendMessage',[
'chat_id'=>$odam,
'text'=>"<b>⛔️ Hisob to'ldirish uchun arizangiz bekor qilindi!</b>

Keyinroq qayta urinib ko'ring yoki malumotlarni tekshiring",
'parse_mode'=>'html',
]);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Foydalanuvchi arizasi bekor qilindi!</b>",
'parse_mode'=>'html',
]);
exit();
}

if($tx=="📚 Ma'lumot" and joinchat($cid)==true){
$subs = substr_count($stat,"\n");
$sana=file_get_contents("stat/date.txt");
$kun=file_get_contents("stat/day.txt");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>@$botname - Loyiha statistikasi:

👥 Aktiv foydalanuvchilar:</b> $subs ta
<b>📥 Kiritilgan pullar:</b> $krt so'm
<b>📤 To'langan pullar:</b> $ych so'm
<b>📆 Botimiz ishlamoqda:</b> $ikunmm kun

<b>🕐 Bot ishga tushgan sana: $sanaqachon</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⁉️ Qoida va 📚 Bot haqida",'callback_data'=>"qoidailiha"]],
[['text'=>"💳 To'lovlar",'url'=>"t.me/$oplatazz"],['text'=>"💭 Muhokama",'url'=>"t.me/$oplatachats"]],
[['text'=>"☎️ Adminstrator",'url'=>"tg://user?id=$EmeraldDev"],['text'=>"🥇 Investorlar(TOP)",'callback_data'=>"investor"]],
]])
]);
exit();
}

if($data=="qoidailiha"){
$subs = substr_count($stat,"\n");
$sana=file_get_contents("stat/date.txt");
$kun=file_get_contents("stat/day.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🌵Botdan har kuni daromad qilish uchun siz balansingizni to'ldirishingiz KERAK!.</b>
— Balans to'ldirish faqatgina adminlar orqali amalga oshadi. Bu uchun menudagi To'lovlar tugmasini bosing!

<b>🌵Balansni to'ldirganingizdan so'ng siz BOT hamyoningizdagi PULINGIZ, DAROMADINGIZ va VIP A'ZOLIKni ko'rishingiz mumkin</b>
— Bu uchun pastdagi Hisobim tugmasini bosing!

<b>🌵SIZ balansni to'ldirganingizdan so'ng pullaringiz o'z-o'zidan ko'paymaydi!</b>
— Bu uchun SIZ menudagi VIP Market bo'limidan kerakli VIP ta'rifiga ulanishingiz kerak!

<b>🌵VIP a'zolikka ulanganingizdan so'ng ham har kuni daromadingizni balansingizga qo'shishingiz mumkin.</b>


<b>🌵 Shuningdek balansingizdagi pullarni kartangizga chiqarmoqchi bo'lsangiz ham adminlarga murojaat qilishingiz so'raladi!</b>
— Faqatgina pul chiqarishingizda $usluga% lik komissiya bor va buni adminlar to'liq tushuntiradi

<b>🌵 Bitning asosiy qoidalari va buni o'qishingiz shart .!</b>
— Adminga yolg'on ma'lumot berish va yolg'on cheklarni tashlash bu narsalar sizni bannga olib keladi va admin tomonidan bloklamasiz bloklangan
foydalanuvchi bandan chiqmaydi va shu jumladan botdagi pullaringiz kuyadi.!

⚡️ Agar sizda qandaydir savol bo'lsa aloqaga chiqing 👉🏼 @$adminuser

<b>🕐 Bot ishga tushgan sana: $sanaqachon</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malumot"]],
]])
]);
}

if($data=="malumot"){
$subs = substr_count($stat,"\n");
$sana=file_get_contents("stat/date.txt");
$kun=file_get_contents("stat/day.txt");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>@$botname - Loyiha statistikasi:

👥 Aktiv foydalanuvchilar:</b> $subs ta
<b>📥 Kiritilgan pullar:</b> $krt so'm
<b>📤 To'langan pullar:</b> $ych so'm
<b>📆 Botimiz ishlamoqda:</b> $ikunmm kun

<b>🕐 Bot ishga tushgan sana: $sanaqachon</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"⁉️ Qoida va 📚 Bot haqida",'callback_data'=>"qoidailiha"]],
[['text'=>"💳 To'lovlar",'url'=>"t.me/$oplatazz"],['text'=>"💭 Muhokama",'url'=>"t.me/$oplatachats"]],
[['text'=>"☎️ Adminstrator",'url'=>"tg://user?id=$EmeraldDev"],['text'=>"🥇 Investorlar(TOP)",'callback_data'=>"investor"]],
]])
]);
}

if($data =="investor"){
$daten = [];
$rev = [];
$fayllar = glob("kabinet/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".dpz")!==false){
$value = file_get_contents($file);
$id = str_replace(["kabinet/",".dpz"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}
asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>so'm</b>"."\n";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🏆 TOP10 - Investorlarimiz:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malumot"]],
]])
]);
}

if($data =="kabinet"){
$daten = [];
$rev = [];
$fayllar = glob("kabinet/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".som")!==false){
$value = file_get_contents($file);
$id = str_replace(["kabinet/",".som"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}
asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>so'm</b>"."\n";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🏆 TOP10 - Hisobdorlar:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"malumot"]],
]])
]);
}

if($tx=="📝 Murojaat" and joinchat($cid)==true){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📝 Murojaat matnini yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$cid.txt","suport");
exit();
}

if($userstep=="suport"){
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>📨 Yangi murojat keldi:</b> <a href='tg://user?id=$cid'>$cid</a>

<b>📑 Murojat matni:</b> $tx",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"yozish=$cid"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>✅ Murojaatingiz yuborildi.</b>

Tez orada javob qaytaramiz!",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
exit();
}}

if(mb_stripos($data,"yozish=")!==false){
$odam=explode("=",$data)[1];
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Javob matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Orqaga"]],
]])
]);
file_put_contents("step/$ccid.txt","otvet=$odam");
exit();
}

if(mb_stripos($userstep, "otvet=")!==false){
$ex = explode("=",$userstep);
$odam = $ex[1];
if($tx=="◀️ Orqaga"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$odam,
'text'=>"<b>💌 Admindan xabar keldi:</b>

$tx",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Javob yozish",'callback_data'=>"boglanish"]],
]])
]);
bot('sendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Javob yuborildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$menyu,
]);
unlink("step/$cid.txt");
exit();
}}

if($tx=="/panel" or $tx=="🗄 Boshqarish" or $tx == "🗄 Boshqaruv"){
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>🗄 Boshqaruv paneliga xush kelibsiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.text");
}}


if($tx == "💎 VIP Sozlamalar"){
	if(in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"💎 <b>VIP sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ VIP tarif qo'shish",'callback_data'=>"viptarifplus"]],
[['text'=>"⚙️ VIP tarif sozlash",'callback_data'=>"viptarifsozlash"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"tozalashvip"]],
]])
]);
}}

if($data=="viptarifsozlash" and joinchat($ccid)==true){
$vipbolim = file_get_contents("vip/turi.txt");
$more = explode("\n",$vipbolim);
$soni = substr_count($vipbolim,"\n");
$key=[];
for ($for = 1; $for <= $soni; $for++) {
$title = str_replace("\n","",$more[$for]);
$key[]=["text"=>"$title","callback_data"=>"tanlash=$title"];
$keyboard2 = array_chunk($key, 2);
$vipbolim = json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
if($vipbolim == null){
bot("answerCallbackQuery",[
"callback_query_id"=>$callid,
"text"=>"⚠️ VIP tizimlari mavjud emas!",
"show_alert"=>true,
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
'parse_mode'=>'html',
]);
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>💎 VIP tizimlaridan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>$vipbolim,
]);
}}

if(mb_stripos($data, "tanlash=")!==false){
$ex = explode("=",$data);
$vipbolimm = $ex[1];
$vipprice = file_get_contents("vip/$vipbolimm/narxi.txt");
$pricedate = file_get_contents("vip/$vipbolimm/kunlik.txt");
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>❓ Nimani o'zgartirmoqchisiz</b>

⬇️ Quyudagilardan birini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holat",'callback_data'=>"hozirgiholat=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"✏️ Nomini o'zgartirish",'callback_data'=>"nomi=$vipbolimm=$vipprice=$pricedate"],['text'=>"✏️ Narxini o'zgartirish",'callback_data'=>"narxi=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"✏️ Kunlik daromadini ozgartirish",'callback_data'=>"kunligi=$vipbolimm=$vipprice=$pricedate"],['text'=>"🗑 O'chirish",'callback_data'=>"deletvipbolim=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"◀️ Ortga",'callback_data'=>"bbosh"]],
]])
]);
}

if(mb_stripos($data, "hozirgiholat=")!==false){
$ex = explode("=",$data);
$vipbolimnow = $ex[1];
$vippricenow = $ex[2];
$vipkunliknow = $ex[3];
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>〽️ Bo'lim haqida batafsil ma'lumot</b>

<b>➡️Bo'lim nomi:</b> $vipbolimnow
<b>➡️Bo'lim narxi:</b> $vippricenow so'm
<b>➡️Bo'lim kunlik daromadi:</b> $vipkunliknow so'm

⬇️ Quyudagilardan birini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Ortga",'callback_data'=>"orqagaqayt-$vipbolimnow-$vippricenow-$vipkunliknow"]],
]])
]);
}

if(mb_stripos($data, "orqagaqayt-")!==false){
$ex = explode("-",$data);
$vipbolimm = $ex[1];
$vipprice = $ex[2];
$pricedate = $ex[3];
bot("editMessageText",[
"chat_id"=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>❓ Nimani o'zgartirmoqchisiz</b>

⬇️ Quyudagilardan birini tanlang:",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📋 Hozirgi holat",'callback_data'=>"hozirgiholat=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"✏️ Nomini o'zgartirish",'callback_data'=>"nomi=$vipbolimm=$vipprice=$pricedate"],['text'=>"✏️ Narxini o'zgartirish",'callback_data'=>"narxi=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"✏️ Kunlik daromadini ozgartirish",'callback_data'=>"kunligi=$vipbolimm=$vipprice=$pricedate"],['text'=>"🗑 O'chirish",'callback_data'=>"deletvipbolim=$vipbolimm=$vipprice=$pricedate"]],
[['text'=>"◀️ Ortga",'callback_data'=>"bbosh"]],
]])
]);
}

if(mb_stripos($data,"kunligi=")!==false){
$ismi=explode("=",$data)[1];
$vnarxi=explode("=",$data)[2];
$narxku=explode("=",$data)[3];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi qiymat yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","kunligiedit-$ismi-$vnarxi-$narxku");
exit();
}

if(mb_stripos($userstep, "kunligiedit-")!==false){
$ex = explode("-",$userstep);
$ismi = $ex[1];
$vvnarx = $ex[2];
$kunlikvv = $ex[3];
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
file_put_contents("vip/$ismi/kunlik.txt","$text"); 
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> - muvaffaqiyatli o'zgartirildi.",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}


if(mb_stripos($data,"narxi=")!==false){
$ismi=explode("=",$data)[1];
$vnarxi=explode("=",$data)[2];
$narxku=explode("=",$data)[3];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Yangi qiymat yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","narxiedit-$ismi-$vnarxi-$narxku");
exit();
}

if(mb_stripos($userstep, "narxiedit-")!==false){
$ex = explode("-",$userstep);
$ismi = $ex[1];
$vvnarx = $ex[2];
$kunlikvv = $ex[3];
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
file_put_contents("vip/$ismi/narxi.txt","$text"); 
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> - muvaffaqiyatli o'zgartirildi.",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}
}
if(mb_stripos($data,"deletvipbolim=")!==false){
$ismi=explode("=",$data)[1];
$vnarxi=explode("=",$data)[2];
$narxku=explode("=",$data)[3];
$del = file_get_contents("vip/turi.txt");
$k = str_replace("\n".$ismi."","",$del);
file_put_contents("vip/turi.txt",$k);
deleteFolder("vip/$ismi");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"$ismi <b>Oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"viptarifsozlash"]]
]])
]);
}

if(mb_stripos($data,"nomi=")!==false){
$ismi=explode("=",$data)[1];
$vnarxi=explode("=",$data)[2];
$narxku=explode("=",$data)[3];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Tahrirlash uchun yangi nomni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","EditBolim-$ismi-$vnarxi-$narxku");
exit();
}

if(mb_stripos($userstep, "EditBolim-")!==false){
$ex = explode("-",$userstep);
$ismi = $ex[1];
$vvnarx = $ex[2];
$kunlikvv = $ex[3];
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
$bolim = file_get_contents("vip/turi.txt");
$str = str_replace($ismi,$text,$bolim);
file_put_contents("vip/turi.txt",$str);
rename("vip/$ismi","vip/$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text</b> - muvaffaqiyatli o'zgartirildi.",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}




if($data == "tozalashvip"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>⚠️ Ushbu holatda bo'limlarni tozalasangiz, keyinchalik qayta tiklab bo'lmaydi</b>

Shu bilan birgalikda bo'lim, va VIP barchasi o'chiriladi!",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Tasdiqlash",'callback_data'=>"barcha2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"bbosh"]],
]])
]);
}

if($data=="barcha2"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Barcha malumotlar tozlalandi</b>",
'parse_mode'=>"html",
]);
deleteFolder("vip");
}

if($data == "bbosh"){ 
bot('deleteMessage',[ 
'chat_id'=>$ccid, 
'message_id'=>$cmid, 
]); 
bot('sendMessage',[ 
'chat_id'=>$ccid, 
'text'=>"💎 <b>VIP sozlash bo'limidasiz:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ VIP tarif qo'shish",'callback_data'=>"viptarifplus"]],
[['text'=>"⚙️ VIP tarif sozlash",'callback_data'=>"viptarifsozlash"]],
[['text'=>"🗑 Barchasini tozalash",'callback_data'=>"tozalashvip"]],
]])
]); 
} 

if($data == "viptarifplus"){ 
bot('sendMessage',[ 
'chat_id'=>$ccid, 
'text'=>"<b>📝 Yangi VIP Tarif nomini yuboring:</b>", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🗄 Boshqaruv"]], 
]]) 
]); 
file_put_contents("step/$ccid.txt",'AdKat'); 
} 
 
if($userstep == "AdKat"){ 
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
	mkdir("vip/$text"); 
$kategoriya = file_get_contents("vip/turi.txt"); 
file_put_contents("vip/turi.txt","$kategoriya\n$text"); 
file_put_contents("step/test.txt",$text);
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>$text - bo'lim qo'shildi!</b>

 $text -> narxini yuboring", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🗄 Boshqaruv"]], 
]]) 
]); 
file_put_contents("step/$cid.txt",'narxivip'); 
}} 

if($userstep =="narxivip"){
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
file_put_contents("vip/$shoxrux/narxi.txt","$narxivip\n$text"); 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>$text - narx belgilandi!</b>

 $text -> kunlik narxini yuboring", 
'parse_mode'=>'html', 
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🗄 Boshqaruv"]], 
]]) 
]); 
file_put_contents("step/$cid.txt",'oxirgisi'); 
}} 

if($userstep == "oxirgisi"){
if($tx=="🗄 Boshqaruv"){ 
unlink("step/$cid.txt"); 
}else{ 
file_put_contents("vip/$shoxrux/kunlik.txt","$kunlikvip\n$text"); 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'text'=>"<b>$text - Kunlik narx belgilandi!</b>

Yangi VIP bo'lim qoshildi✅", 
'parse_mode'=>'html', 
'reply_markup'=>$panel
]); 
unlink("step/$cid.txt");
}} 


if($tx=="/investorfunbot"){
$sanasi = date('d-m-Y', strtotime('2 hour'));
if(in_array($cid,$admin)){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>⏱ Bot $sanasi sanadan ishga tushdi!</b>",
'parse_mode'=>'html',
]);
file_put_contents("stat/date.txt",$sanasi);
file_put_contents("stat/day.txt","0");
exit();
}}

if($tx=="📊 Statistika" and in_array($cid,$admin)){
$odam=substr_count($stat,"\n");
$ishda=file_get_contents("stat/day.txt");
$load = sys_getloadavg();
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

◾️ <b>Aktiv obunachilar:</b> $odam ta
<b>▫️ Barcha sarmoyalar:</b> $sid ta
<b>▫️ Botimiz ishlamoqda:</b> $ikunmm kun",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🏆 Depozit",'callback_data'=>"investors"],['text'=>"🏆 Hisob",'callback_data'=>"hisobdors"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
exit();
}

if($data=="stats"){
$odam=substr_count($stat,"\n");
$ishda=file_get_contents("stat/day.txt");
$load = sys_getloadavg();
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>💡 O'rtacha yuklanish:</b> <code>$load[0]</code>

◾️ <b>Aktiv obunachilar:</b> $odam ta
<b>▫️ Barcha sarmoyalar:</b> $sid ta
<b>▫️ Botimiz ishlamoqda:</b> $ikunmm kun",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🏆 Depozit",'callback_data'=>"investors"],['text'=>"🏆 Hisob",'callback_data'=>"hisobdors"]],
[['text'=>"🔁 Yangilash",'callback_data'=>"stats"]],
]])
]);
exit();
}

if($data =="investors"){
$daten = [];
$rev = [];
$fayllar = glob("kabinet/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".dpz")!==false){
$value = file_get_contents($file);
$id = str_replace(["kabinet/",".dpz"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}
asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>so'm</b>"."\n";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🏆 TOP10 - Investorlar:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"stats"]],
]])
]);
}

if($data =="hisobdors"){
$daten = [];
$rev = [];
$fayllar = glob("kabinet/*.*");
foreach($fayllar as $file){
if(mb_stripos($file,".som")!==false){
$value = file_get_contents($file);
$id = str_replace(["kabinet/",".som"],["",""],$file);
$daten[$value] = $id;
$rev[$id] = $value;
}
echo $file;
}
asort($rev);
$reversed = array_reverse($rev);
for($i=0;$i<10;$i+=1){
$order = $i+1;
$id = $daten["$reversed[$i]"];
$text.= "<b>{$order}</b>. <a href='tg://user?id={$id}'>{$id}</a> - "."<code>".$reversed[$i]."</code>"." <b>so'm</b>"."\n";
}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>🏆 TOP10 - Hisobdorlar:</b>

$text",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"stats"]],
]])
]);
}

if($tx == "⚙️ Asosiy sozlamalar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>*⃣ Birlamchi sozlamalar bo'limidasiz!</b>

<b>1. Admin useri:</b> @$adminuser
<b>2. Cashback foizi:</b> $incashback%
<b>3. Minimal pul yechish:</b> $inminimum 
<b>4. Pul yechish komisa:</b> $inusluga%",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1",'callback_data'=>"valyuta_nomi"],['text'=>"2",'callback_data'=>"admin_user"],['text'=>"3",'callback_data'=>"r1"],['text'=>"4",'callback_data'=>"r2"]],
]])
]);
exit();
}

if($data == "valyuta_nomi"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring

@ siz yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","valyuta_nomi");
}

if($userstep == "valyuta_nomi"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlama/asosiy/adminuser.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}

if($data == "admin_user"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","admin_user");
}

if($userstep == "admin_user"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlama/asosiy/cashback.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}

if($data == "r1"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","r1");
}

if($userstep == "r1"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlama/asosiy/minimum.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}

if($data == "r2"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📝 Yangi qiymatni yuboring:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","r2");
}

if($userstep == "r2"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
file_put_contents("sozlama/asosiy/usluga.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Muvaffaqiyatli o'zgartirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}}


if($tx=="🔎 Foydalanuvchini boshqarish" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli foydalanuvchining ID raqamini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$cid.txt","idraqam");
exit();
}

if($userstep=="idraqam"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
if(file_exists("kabinet/$tx.som")){
$som=file_get_contents("kabinet/$tx.som");
$dpz=file_get_contents("kabinet/$tx.dpz");
$ban = file_get_contents("ban/$text.txt");
if($ban == null){
$bn = "🔔 Ban qilish";
}
if($ban == "ban"){
$bn = "🔕 Bandan olish";
}
bot("sendMessage",[
"chat_id"=>$cid,
"text"=>"<b>┌👤 Foydalanuvchi topildi!
├
├Balans:  $som so'm
├Depozit: $dpz so'm
├
└@$botname - Yuqori daromad!</b>",
'parse_mode'=>"html",
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"$bn",'callback_data'=>"ban=$tx"]],
[['text'=>"➕ Pul qo'shish",'callback_data'=>"qoshish=$tx"],['text'=>"➖ Pul ayirish",'callback_data'=>"ayirish=$tx"]],
]])
]); 
unlink("step/$cid.txt");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>",
'parse_mode'=>'html',
]);
exit();
}}}

if(mb_stripos($data, "ban=")!==false){
$ex = explode("=",$data);
$odam = $ex[1];
$ban = file_get_contents("ban/$odam.txt");
if($EmeraldDev != $odam){
if($ban == "ban"){
unlink("ban/$odam.txt");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Foydalanuvchi bandan olindi!</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$odam,
'text'=>"<b>Admin tomonidan bandan olindingiz!</b>",
'parse_mode'=>"html",
]);
exit();
}else{
file_put_contents("ban/$odam.txt",'ban');
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Foydalanuvchi banlandi!</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$odam,
'text'=>"<b>Admin tomonidan ban oldingiz!</b>",
'parse_mode'=>"html",
]);
exit();
}}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$callid,
'text'=>"Asosiy adminni bloklash mumkin emas!",
'show_alert'=>true,
]);
}}

if(mb_stripos($data, "qoshish=")!==false){
$ex = explode("=",$data);
$odam = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'parse_mode'=>"html",
'text'=>"<b>[$odam]ning hisobiga qancha pul qo'shmoqchisiz?</b>",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","qoshish=$odam");
exit();
}

if(mb_stripos($userstep, "qoshish=")!==false){
$ex = explode("=",$userstep);
$odam = $ex[1];
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
$som=file_get_contents("kabinet/$odam.som");
$som += $tx;
file_put_contents("kabinet/$odam.som", $som);
$dpz=file_get_contents("kabinet/$odam.dpz");
$dpz += $tx;
file_put_contents("kabinet/$odam.dpz",$dpz);
bot('sendMessage',[
'chat_id'=>$odam,
'text'=>"<b>Admin tomonidan hisobingiz $tx so'm to'ldirildi!</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$tkanal,
'text'=>"<b>📤 Foydalanuvchi hisobini to'ldirdi!</b>

<b>▫️ Foydalanuvchi:</b> <a href='tg://user?id=$odam'>$odam</a>
<b>▫️ To'lov turi:</b> <u>UZCARD</u>
<b>▫️ Summa:</b> $tx so'm 

<b>@$botname - Yuqori daromad!</b>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
'inline_keyboard'=>[
[['text'=>"🤖",'url'=>"https://t.me/$botname"]],
]])
]);
$caw = file_get_contents("kabinet/$odam.txt");
$tkf = file_get_contents("kabinet/$caw.som");
$plus3 = $tx/100*3 + $tkf;
bot('SendMessage',[
'chat_id'=>$caw,
'text'=>"<b>📳 Do'stingiz hisobini to'ldirgani uchun sizga $plus3 so'm qo'shildi!</b>",
'parse_mode'=>'html',
]);
file_put_contents("kabinet/$caw.som",$plus3);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobiga $tx so'm qo'shildi</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$krt = file_get_contents("stat/kirit.txt");
$plus4 = $krt + $tx;
file_put_contents("stat/kirit.txt",$plus4);
unlink("step/$cid.txt");
exit();
}}

if(mb_stripos($data, "ayirish=")!==false){
$ex = explode("=",$data);
$odam = $ex[1];
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'parse_mode'=>"html",
'text'=>"<b>[$odam]ning hisobidan qancha pul ayirmoqchisiz?</b>",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","ayirish=$odam");
exit();
}

if(mb_stripos($userstep, "ayirish=")!==false){
$ex = explode("=",$userstep);
$odam = $ex[1];
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
bot('sendMessage',[
'chat_id'=>$odam,
'text'=>"<b>Admin tomonidan hisobingizdan $tx so'm olib tashlandi!</b>",
'parse_mode'=>"html",
]);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi hisobidan $tx so'm olib tashlandi</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$som=file_get_contents("kabinet/$odam.som");
$som -= $tx;
file_put_contents("kabinet/$odam.som", $som);
$dpz=file_get_contents("kabinet/$odam.dpz");
$dpz -= $tx;
file_put_contents("kabinet/$odam.dpz", $dpz);
unlink("step/$cid.txt");
exit();
}}

if($data == "oddiy_xabar" and in_array($ccid,$admin)){
$odam=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$odam ta foydalanuvchiga yuboriladigan xabar matnini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","oddiy");
}
if($userstep=="oddiy"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$odam = explode("\n",$statistika);
foreach($odam as $odamlar){
$usr=bot("sendMessage",[
'chat_id'=>$odamlar,
'text'=>$text,
'parse_mode'=>'HTML'
]);
unlink("step/$cid.txt");
}}}
if($usr){
$odam=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>$odam ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
}

if($data =="forward_xabar" and in_array($ccid,$admin)){
$odam=substr_count($statistika,"\n");
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>$odam ta foydalanuvchiga yuboriladigan xabarni forward shaklida yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt","forward");
}
if($userstep=="forward"){
if($tx=="🗄 Boshqaruv"){
unlink("step/$cid.txt");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
$odam = explode("\n",$statistika);
foreach($odam as $odamlar){
$fors=bot("forwardMessage",[
'from_chat_id'=>$cid,
'chat_id'=>$odamlar,
'message_id'=>$mid,
]);
unlink("step/$cid.txt");
}}}
if($fors){
$odam=substr_count($statistika,"\n");
bot("sendmessage",[
'chat_id'=>$admin,
'text'=>"<b>$odam ta foydalanuvchiga muvaffaqiyatli yuborildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
}

if($data =="obuna_xabar" and in_array($ccid,$admin)){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Kerakli foydalanuvchi ID raqamini yuboring:</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqarish"]],
]])
]);
file_put_contents("step/$ccid.txt","odamtop");
exit();
}

if($userstep=="odamtop"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
	file_put_contents("step/shoxrux.txt",$text);
if(mb_stripos($statistika,"$text")!==false){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Foydalanuvchi topildi, yuboriladigan xabarni kiriting:</b>",
'parse_mode'=>"html",
]);
file_put_contents("step/$ccid.txt","yubor");
exit();
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Ushbu foydalanuvchi botdan foydalanmaydi!</b>",
'parse_mode'=>"html",
]);
exit();
}}}

if($userstep == "yubor"){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.txt");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>Xabar yuborildi!</b>",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
bot('sendmessage',[
'chat_id'=>$saved,
'text'=>"<b>☎️ Adminstrator:</b> $text",
'parse_mode'=>"html",
]);
exit();
}}

if($tx == "📢 Kanallar" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📢 Kanallar sozlash bo'limidasiz!</b>

Nimani o'zgartiramiz?",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Majburiy kanal",'callback_data'=>"majburiy_obuna"]],
[['text'=>"ℹ️ Qo'shimcha kanal",'callback_data'=>"qoshimcha"]],
]])
]);
exit();
}

if($data=="kanallar"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('sendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>📢 Kanallar sozlash bo'limidasiz!</b>

Nimani o'zgartiramiz?",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📢 Majburiy kanal",'callback_data'=>"majburiy_obuna"]],
[['text'=>"ℹ️ Qo'shimcha kanal",'callback_data'=>"qoshimcha"]],
]])
]);
}

if($data=="majburiy_obuna"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📢 Majburiy kanallar bo'limidasiz!</b>

Marhamat tanlang:",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕",'callback_data'=>"majburiy_obuna1"],['text'=>"📋",'callback_data'=>"majburiy_obuna3"],['text'=>"🗑",'callback_data'=>"majburiy_obuna2"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]],
]])
]);
unlink("step/$ccid.txt");
}

if($data=="qoshimcha"){
if($tkanal=="null"){
$ads="kiritilmagan";}else{$ads="$tkanal";}
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>ℹ️ Qo'shimcha kanallar ro'yaxti:

To'lovlar uchun:</b> $ads",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"To'lovlar uchun",'callback_data'=>"tolovlar"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"kanallar"]],
]])
]);
unlink("step/$ccid.txt");
}

if($data=="tolovlar"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @education_coders",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"qoshimcha"]],
]])
]);
file_put_contents("step/$ccid.txt","tolovlar");
}
if($userstep == "tolovlar"){
if(mb_stripos($text, "@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
file_put_contents("stat/tolov.txt","$text");
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qabul qilindi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas!</b>

Admin qilib qayta yuboring:",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>

Namuna: @education_coders",
'parse_mode'=>'html',
]);
exit();
}}

if($data=="majburiy_obuna1"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📢 Kerakli kanalni manzilini yuboring:</b>

Namuna: @education_coders",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
file_put_contents("step/$ccid.txt","majburiy1");
}
if($userstep == "majburiy1"){
if(mb_stripos($text, "@")!==false){
$get = bot('getChat',[
'chat_id'=>$text
]);
$types = $get->result->type;
$ch_name = $get->result->title;
$ch_user = $get->result->username;
if(getAdmin($ch_user)== true){
if($chans == null){
file_put_contents("stat/kanal.txt",$text);
}else{
file_put_contents("stat/kanal.txt","\n".$text,FILE_APPEND);
}
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal qo'shildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}else{
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Bot ushbu kanalda admin emas!</b>

Admin qilib qayta yuboring:",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>

Namuna: @education_coders",
'parse_mode'=>'html',
]);
exit();
}}

if($data == "majburiy_obuna2"){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>O'chiriladigan kanal manzilini yuboring:

Namuna:</b> @education_coders",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
file_put_contents("step/$ccid.txt","remove-channel");
exit();
}

if($userstep == "remove-channel"){
if(isset($text)){
if(mb_stripos($text, "@")!==false){
if(mb_stripos($chans, $text)!==false){
$soni = substr_count($chans,"@");
if($soni != "1"){
$files=file_get_contents("stat/kanal.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("stat/kanal.txt",$file);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>$text - kanal o'chirildi</b>",
'parse_mode'=>'html',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
unlink("sozlama/kanal.txt");
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Ro'yxatdan topilmadi!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kanal manzilini to'g'ri yuboring:</b>

Namuna: @education_coders",
'parse_mode'=>'html',
]);
exit();
}}}

if($data=="majburiy_obuna3"){
if($chans==null){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Kanallar ulanmagan!</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}else{
$soni = substr_count($chans,"@");
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Ulangan kanallar ro'yxati ⤵️</b>
➖➖➖➖➖➖➖➖

$chans

<b>Ulangan kanallar soni:</b> $soni ta",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"majburiy_obuna"]],
]])
]);
}}

if($tx=="📩 Xabarnoma" and in_array($cid,$admin)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"<b>📨 Yuboriladigan xabar turini tanlang:</b>",
'parse_mode'=>"html",
'reply_markup'=> json_encode([
'inline_keyboard'=>[
[['text'=>"Oddiy xabar",'callback_data'=>"oddiy_xabar"],['text'=>"Forward xabar",'callback_data'=>"forward_xabar"]],
/*[['text'=>"Foydalanuvchiga xabar",'callback_data'=>"obuna_xabar"]],*/
]])
]);
exit();
}

if($text == "👥 Adminlar"){
if(in_array($cid,$admin)){
if($cid == $EmeraldDev){
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"add"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
]])
]);
exit();
}}}

if($data == "admins"){
if($ccid == $EmeraldDev){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);	
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
[['text'=>"➕ Qo'shish",'callback_data'=>"add"],['text'=>"🗑 O'chirish",'callback_data'=>"remove"]],
]])
]);
exit();
}else{
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);	
bot('SendMessage',[
'chat_id'=>$ccid,
'text'=>"<b>Quyidagilardan birini tanlang:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"📑 Ro'yxatni ko'rish",'callback_data'=>"list"]],
]])
]);
exit();
}}

if($data == "list"){
$admins=file_get_contents("stat/admins.txt");
if($admins){
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>📑 Botdagi adminlar ro'yxati:</b>

$admins",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"admins"]],
]])
]);
}else{
bot('editMessageText',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
'text'=>"<b>Botda adminlar topilmadi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"◀️ Orqaga",'callback_data'=>"admins"]],
]])
]);
}}

if($data == "add"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"*Kerakli ID raqamni kiriting:*",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'add-admin');
exit();
}

if($userstep=="add-admin" and $cid == $EmeraldDev){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $EmeraldDev){
file_put_contents("stat/admins.txt","$admins\n$text");
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"✅ *$text* admin qilib tayinlandi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>Admin qilib tayinlandingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}}}

if($data == "remove"){
bot('deleteMessage',[
'chat_id'=>$ccid,
'message_id'=>$cmid,
]);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🗄 Boshqaruv"]],
]])
]);
file_put_contents("step/$ccid.txt",'remove-admin');
exit();
}

if($userstep == "remove-admin" and $cid == $EmeraldDev){
if($tx=="🗄 Boshqarish"){
unlink("step/$cid.step");
}else{
if(is_numeric($text)=="true"){
if($text != $EmeraldDev){
$files=file_get_contents("stat/admins.txt");
$file = str_replace("\n".$text."","",$files);
file_put_contents("statistika/admins.txt",$file);
bot('SendMessage',[
'chat_id'=>$EmeraldDev,
'text'=>"✅ *$text* adminlikdan olindi!",
'parse_mode'=>'MarkDown',
'reply_markup'=>$panel,
]);
unlink("step/$cid.txt");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"<b>Adminlikdan olindingiz!</b>",
'parse_mode'=>'html',
'reply_markup'=>$menyu,
]);
exit();
}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}}else{
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>Kerakli ID raqamni kiriting:</b>",
'parse_mode'=>'html',
]);
exit();
}}}


?>
