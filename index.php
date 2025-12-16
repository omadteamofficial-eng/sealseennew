<?php
ob_start();



define('API_KEY','8398800703:AAHhCmdBlLdHvop4KvlehTbmbQLlzmC4jZk');

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



//code by @ahzee


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$text = $message->text;

//Callback_data
$data = $update->callback_query->data;
$mid = $update->callback_query->message->message_id;
$cid = $update->callback_query->message->chat->id;
$uid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id; 
$tx = $update->callback_query->message->text; 
$frid = $update->callback_query->from->id; 
$cfname = $update->callback_query->from->first_name;  
$ctitle = $update->callback_query->message->chat->title; 
$cuser = $update->callback_query->message->chat->username; 



$hyper_link="[$first_name](tg://user?id=$chat_id)";
//foydalanuvchi chati giper linki

$host="xvil.cf/Life";
//index.php manzili

$privacy="t.me/LifegramBot?start=privacy";
//shartnoma va qonun qoidalar linki

$examples="@ExampleLifegramBot";
//namuna uchun bot

$reply_info="https://telegram.org/tour/groups#replies";
//rasmiy Telegramni javob qaytarish haqidagi ma'lumoti

@mkdir("file");
//foydalanuvchilar sozlamalari

$lfsupport="@LifegramSupportBot";
//qo'llab quvvatlash markazi 


if(isset($message)){
bot('SendChatAction',[
'chat_id'=>$chat_id,
'action'=>"typing"]);
}
if(isset($data)){
bot('SendChatAction',[
'chat_id'=>$cid,
'action'=>"typing"]);
}




@mkdir("language");
$setnext=file_get_contents("file/".$chat_id."settings.next");
$sudo="1317186088";
$language=file_get_contents("language/$chat_id.language");
$dlanguage=file_get_contents("language/$cid.language");
$members=file_get_contents("file/stats.ic");
$tokens=file_get_contents("file/token.ic");
/*$mas=file_get_contents("file/us.me");

if($text=="true" && $chat_id==$sudo){
	file_put_contents("file/us.me","i");
	}
	if($text=="false" && $chat_id==$sudo){
		file_put_contents("file/us.me","ok");
		}*/
		
$explode=explode("\n",$members);
$count=count($explode);
$botstatic=file_get_contents("file/you.are");

if(strpos($text,"/start")!==false){
if(strpos($members,"$chat_id")!==false){
}else{
file_put_contents("file/stats.ic","$members\n$chat_id");

$ulast="Киритилмаган!";
if(isset($last_name)){
$ulast=$last_name;
}
$usen=$ulast;
if(isset($username)){
$usen=$username;
}
bot('SendMessage',[
	'chat_id'=>"-1001377187472",
	'text'=>"
Янги аъзо:

Ник: [$first_name]
ИД: [$chat_id]
Фамилия: [$ulast]
Юзер: [$usen]
Хабар ИД: $message_id
[Чат Чат Чат Чат Чат Чат](tg://user?id=$chat_id) ","parse_mode"=>markdown,
"reply_markup"=>json_encode(["inline_keyboard"=>[
[['text'=>"🌝Ban $first_name","callback_data"=>"Banan|$chat_id"],['text'=>"🌝Unban $first_name","callback_data"=>"Yemasakan|$chat_id"]]
]])
]);
}
}
/*if($message && $mas=="ok" && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Bot hozirda ish faliyatida emas noqulayliklar uchun uzir so'raymiz bot tez orada ishga tushadi.",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"ما از مشکل پیش آمده عذرخواهی می کنیم زیرا ربات در حال حاضر کار نمی کند. ربات به زودی فعال و راه اندازی می شود.",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Wir entschuldigen uns für die Unannehmlichkeiten, da der Bot derzeit nicht in Betrieb ist. Der Bot wird bald betriebsbereit sein.",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Приносим извинения за неудобства, так как бот в настоящее время не работает. Бот скоро будет запущен..",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="en" or $language==null){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"We apologize for the inconvenience as the bot is not currently in operation. The bot will be up and running soon.",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Nous vous prions de nous excuser pour la gêne occasionnée car le bot n'est pas actuellement en service. Le bot sera bientôt opérationnel.",
	]);
	return false;
}
if($message && $mas=="ok" && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"很抱歉給您帶來不便，因為該漫遊器目前尚未運行，它將很快啟動並運行.",
	]);
	return false;
}*/
//508
$banan=file_get_contents("ban.id");


if(strpos($data,"Banan")!==false){
  $ex=explode("|",$data);
  $ex=$ex[1];
  file_put_contents("ban.id","$banan|$ex");
  bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"$ex successfully banned!👌",
                'show_alert'=>false
        ]);
        bot("sendMessage",[
   "chat_id"=>$ex,"text"=>"You banned 🚫"]);
        }
        
        if(strpos($data,"delhook")!==false){
  $ex=explode("|",$data);
  $ex=$ex[1];
  bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"$ex successfully banned!👌",
                'show_alert'=>false
        ]);
        file_get_contents("https://api.telegram.org/bot".$ex."/deletewebhook");
        }
        
        if(strpos($data,"Yemasakan")!==false){
  $ex=explode("|",$data);
  $ex=$ex[1];
$banan=str_replace($ex,$banan,"🌝");
  file_put_contents("ban.id","$banan");
  bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"$ex successfully banned!👌",
                'show_alert'=>false
        ]);
                bot("sendMessage",[
   "chat_id"=>$ex,"text"=>"You unbanned😉"]);
        }
                if(strpos($text,"unban")!==false && $chat_id==$sudo){
  $ex=explode(" ",$data);
  $ex=$ex[1];
$banan=str_replace($ex,$banan,"🌝");
  file_put_contents("ban.id","$banan");
  bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"$ex bandan chiqazildi!👌",        
        ]);
                bot("sendMessage",[
   "chat_id"=>$ex,"text"=>"You unbanned😉"]);
        }

        

if(strpos($text,"/static")!==false && $from_id==$sudo){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Аъзолар: $count\nЖаъми ботлар: $botstatic"]);
	}
	
	
if(strpos($text,"/cancel")!==false && $setnext=="ok"){
file_put_contents("file/".$chat_id."settings.next","unlink");
bot('SendMessage',[
	'chat_id'=>$chat_id,"parse_mode"=>markdown,
	'text'=>"Cancelled: *Create Bot*"]);
	}
	

$langkey=json_encode([
'inline_keyboard'=>[
[['text'=>'🇳🇿English','callback_data'=>'en'],['text'=>'🇺🇿Ӯзбекча','callback_data'=>'uz']],
[['text'=>'🇷🇺Русский','callback_data'=>'ru']],
[['text'=>'🇮🇷فارسی','callback_data'=>'fa'],['text'=>'🇨🇳中國','callback_data'=>'ch']],
/*[['text'=>'🇩🇪Deutsch','callback_data'=>'de'],['text'=>'🇪🇦Español','callback_data'=>'es']],*/
]]);


if($text=="/feed" && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"LifegramBot хақида таклиф, шикоят, камчиликлар учун @LifegramSupportBot га ёзинг.",
	]);
}
if($text=="/feed" && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Напишите нам на $lfsupport, если у вас возникнут проблемы или вопросы о Lifegram Bot..",
	]);
}
if($text=="/feed" && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Message us at $lfsupport if you have any issues or questions about Lifegram Bot.",
	]);
}
if($text=="/feed" && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Envíenos un mensaje a $lfsupport si tiene algún problema o pregunta sobre Lifegram Bot.",
	]);
}
if($text=="/feed" && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"如果您對Lifegram Bot有任何問題或疑問，請通過 $lfsupport 向我們發送消息",
	]);
}
if($text=="/feed" && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"اگر در مورد LifegramBot سالی دارید به ما درLifegramSupportBot پیام دهید",
	]);
}
if($text=="/feed" && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Schreiben Sie uns unter @LifegramSupportBot, wenn Sie Probleme oder Fragen zu Lifegram Bot haben.",
	]);
}
if($message){
if(strpos($banan,"$chat_id")!==false){
bot("deletemessage",['chat_id'=>$chat_id,"message_id"=>$message_id]);
bot("sendMessage",['chat_id'=>$chat_id,"text"=>"You banned by the bot administrators! use /feed for help"]);
return false;
}
}
if($data){
if(strpos($banan,"$cid")!==false){
bot("deletemessage",['chat_id'=>$cid,"message_id"=>$mid]);
bot("sendMessage",['chat_id'=>$cid,"text"=>"You banned by the bot administrators! use /feed for help"]);
return false;
}
}
//code by @ahzee
if($text=="/ex" && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Ушбу бот орқали яратилган намуна бот: @ExampleLifegramBot",
	]);
}
if($text=="/ex" && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Вот примеры ботов, которые были созданы с помощью Lifegram Bot:

$examples - пример бота, созданного с помощью Lifegram Bot.",
	]);
}
if($text=="/ex" && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Here is examples of bots that were made using Lifegram Bot:

$examples — example of a bot made using Lifegram Bot.
",
	]);
}
if($text=="/ex" && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Aquí hay ejemplos de bots que se crearon con Lifegram Bot:

$examples: ejemplo de un bot creado con Lifegram Bot.",
	]);
}
if($text=="/ex" && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"以下是使用Lifegram Bot製作的機器人示例：

$examples —使用Lifegram Bot製造的機器人的示例。",
	]);
}
if($text=="/ex" && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"در اینجا نمونه هایی از ربات هایی که با استفاده از Lifegram Bot ساخته شده اند آورده شده است:

$examples - نمونه ربات ساخته شده با استفاده از Lifegram Bot.",
	]);
}
if($text=="/ex" && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"Hier sind Beispiele für Bots, die mit Lifegram Bot erstellt wurden:

$examples - Beispiel eines mit Lifegram Bot erstellten Bots.",
	]);
}

if($text=="/start" && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"


*Салом* $hyper_link

*LifegramBot* - Бу *Телеграм*-да фойдаланувчилар билан осон мулоқот қилишингиз мақсадида яратилган!

Ушбу *бот*ни бошқариш учун *буйруқ*лардан фойдаланинг
    
*Буйруқлар*
/newbot - Янги бот яратиш
/language - Тилни танлаш



","parse_mode"=>markdown]);
return false;
}





if($text=="/start" && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"



*Здравствуйте* $hyper_link

*Lifegram Bot* - Создан для удобного общения с пользователями в * Telegram *!

Используйте эти *команды* для управления этим *ботом*:
  
*Команды*
use /language to choose language
/newbot - добавить *бот*



","parse_mode"=>markdown]);
return false;
}



if($text=="/start" && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"

*Hello* $hyper_link

*LifegramBot* - this is designed for easy communication with users in *Telegram*!

Use these *commands* to manage this *bot*:
    
*Commands*
use /language to choose language
use /newbot - to add new *bot*



","parse_mode"=>markdown]);
return false;
}


if($text=="/start" && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"

$hyper_link *سلام*

*LifegramBot* - سلام * تلگرام * برای ارتباط آسان با کاربران ایجاد شد!

*برای مدیریت این * ربات * از این دستورات * استفاده کنید:
    
*دستورات*
use /language to choose language
/newbot - * ربات * اضافه کنید
	
	


","parse_mode"=>markdown]);
return false;
}


if($text=="/start" && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"

*Hallo* $hyper_link

*LifegramBot* - Dies ist für die einfache Kommunikation mit Benutzern in *Telegram* konzipiert!

Verwenden Sie diese *Befehle*, um diesen *Bot* zu verwalten:
    
*Befehle*
use /language to choose language
/newbot - *bot* hinzufügen



","parse_mode"=>markdown]);
return false;
}


if($text=="/start" && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"



*您好* $hyper_link

* LifegramBot *-旨在通過*電報*與用戶輕鬆通信！

使用以下*命令*管理此*機器人*：
    
*命令*
use /language to choose language
/newbot-* bot *添加



","parse_mode"=>markdown]);
return false;
}


if($text=="/start" && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"


* Hola * $hyper_link

*LifegramBot *: ¡está diseñado para facilitar la comunicación con los usuarios en * Telegram *!

Utilice estos * comandos * para administrar este * bot *:
    
* Comandos *
use /language to choose language
/newbot - * bot * agregar


","parse_mode"=>markdown]);
return false;
}






if($text=="/start" or $text=="/language"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Please Choose your language / Пожалуйста выберите язык
Илтимос тилни танланг / Илтимос забонро интихоб кунед*
","parse_mode"=>markdown,"reply_to_message_id"=>$message_id,"reply_markup"=>$langkey]);
}




//Language Uzbek

if($data=="uz"){
file_put_contents("language/$cid.language","uz");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"Ӯзбек тили сақланди👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"



*Салом* [$cfname](tg://user?id=$cid)

*LifegramBot* - ушбу бот *Телеграм*-да фойдаланувчилар билан осон мулоқот қилишингиз мақсадида яратилган!

Ушбу *бот*ни бошқариш учун *буйруқ*лардан фойдаланинг
    
*Буйруқлар*
/newbot - Янги бот яратиш
/language - Тилни танлаш

","parse_mode"=>markdown]);
}


$done=json_encode([
'inline_keyboard'=>[
[['text'=>'✔️Қабул қилиш ва давом этиш','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*
Давом этаётган экансиз сиз қуйидагиларга рози бӯлишингиз шарт!

- Мамлакатингиз қонунларини яратилган ботларингиз орқали бузмайсиз
- Яратилган ботлар орқали зӯравонликни тарғиб қилмайсиз
- Яратилган ботлар орқали порнографик ва бошка шунга ӯхшиаш материаллар таркатмайсиз

Ушбу фойдаланиш* [шартлар]($privacy)*ини кейинроқ янгилаш хуқуқига эгамиз.* ","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="uz"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"*
Давом этаётган экансиз сиз қуйидагиларга рози бӯлишингиз шарт!

- Мамлакатингиз қонунларини яратилган ботларингиз орқали бузмайсиз!
- Яратилган ботлар орқали зӯравонликни тарғиб қилмайсиз!
- Яратилган ботлар орқали порнографик ва бошка шунга ӯхшаш материаллар тарқатмайсиз!

Ушбу фойдаланиш* [шартлар]($privacy)*ини кейинроқ янгилаш хуқуқига эгамиз.*

✅ *Сиз фойдаланиш* [шартлар]($privacy)*ига рози бӯлдингиз!*","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"
Сиз ботингизни яратиш учун 3 та босқични бажаришингиз керак

1. @BotFather га киринг, *START* тугмачасини босинг ва `/newbot` буйруғини юборинг
2. *бот* номини, ва кейин фойдаланувчи номини ёзинг
3. *бот* яратилгандан сӯнг токендан нусха олинг ва ушбу ботга юборинг

*Бот* яратиш хақида [батафсил бу ерда](t.me/LifegramBot?start=createbot)","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="uz")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");

@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");
$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("uzbek.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave"); 
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;$newname=$first_name;




file_put_contents("file/you.are",$add);
if($status=="true" && $language=="uz"){

bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] *LifegramBot* - га муваффакқиятли уланди

✅Мухим қулланма:

*Келган хабарга қандай жавоб бераман?*
Келган хабарга сиз [Reply]($reply_info) билан жавоб ёзинг

[/start](t.me/$botusername?start=start) *Босгандаги хабарни қандай ӯзгартириш мумкин?*
Ботга  [/start](t.me/$botusername?start=start) босгандаги хабарни ӯзгартириш учун ботга [/start](t.me/$botusername?start=start) босинг ва `/stext` буйруғини ботингизга юборинг ва [/start](t.me/$botusername?start=start) босилгандаги (саломлашиш) сӯзни тахрирланг

*Агар сизда бот билан қандайдир қийинчилик пайдо бӯлса $lfsupport-га ёзишингиз мумкин.*

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);



bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true
,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
$mrand=rand(123456789,99999999);
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*Бу бот токени эмас.*

*Токен* қуйидагича бӯлади: `".$mrand.":GTo-sEF1234ghIkl-FhbvD-EEEoLksa
`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Ботдан фойдаланиш шартлари*
Бизнинг хизматларимиздан фойдаланиш учун сиз қуйидаги шартларга розилик билдирасиз, илтимос шартларни дикқат билан ӯқинг

Бизнинг *бот*имиздан фойдаланган холда мамлакатингиз қонунларини бузмайсиз
Яратилган ботлар оркали *зӯравонлик*ни тарғиб қилмайсиз
Яратилган *бот*лар орқали порнографик ва шунга ӯхшаш материалларни тарқатмайсиз
Терористик материалларни тарқатмайсиз

*Ушбу шартларни кейинчалик ӯзгартириш хуқуқига эгамиз.*
*Биз* билан боғланиш учун, $lfsupport-*га* ёзинг.
Шартлар охирги марта: *2020* йил *14*-ноябрь да янгиланди","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="uz"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Мен ботни қандай яратаман?*

Бот яратиш учун @BotFather га ӯтинг /start деб юборинг ва `/newbot` буйруғини юборинг кейин эса ботингиз номини ёзинг
Кейин эса, ботингиз фойдаланувчи номини киритинг (bot) билан тугаши шарт!
Шуларни бажарсангиз қарабсизки сизнинг ботингиз тайёр. Келган токен ни нусхаланг ва ушбу ботга юборинг
","parse_mode"=>"markdown",
]);
}


//End Language Uzbek
























































//Language Russian

if($data=="ru"){
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"Русский язык сохранен👌",
                'show_alert'=>false
        ]);
	file_put_contents("language/$cid.language","ru");
bot('editmessagetext',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"*Здравствуйте* [$cfname](tg://user?id=$cid)

*Lifegram Bot* - Создан для удобного общения с пользователями в * Telegram *!

Используйте эти *команды* для управления этим *ботом*:
  
*Команды*
use /language to choose language
/newbot - добавить *бот*

","parse_mode"=>markdown]);
}


$done=json_encode([
'inline_keyboard'=>[
[['text'=>'Принять и продолжить','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*
Продолжая, вы соглашаетесь не допускать:

- не использовать наши услуги с целью нарушения законов вашей страны.
- Насилие через подключенных ботов

Мы оставляем за собой право обновить это использование* [условия]($privacy) *позже.* ","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="ru"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
Продолжая, вы соглашаетесь не допускать:

- не использовать наши услуги с целью нарушения законов вашей страны.
- Продвижение насилия через связанных ботов.
- Распространение порнографии через связанные боты.

Мы оставляем за собой право обновлять настоящие Условия использования позднее.

✅ *Вы соглашаетесь с использованием* [условия]($privacy)","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"
Для подключения бота необходимо выполнить три шага:

1. Перейдите к боту @BotFather, нажмите кнопку *START* и отправьте команду `/newbot`
2. Введите имя *бота*, затем имя пользователя бота.
3. После создания *бота* отправьте ему ответное сообщение или скопируйте токен бота и отправьте его этому боту.

Важно: не подключайте ботов, используемых в других сервисах (Manybot, Chatfuel и т. Д.).

С подробными инструкциями по созданию *бота* [читать здесь](T.me/LifegramBot?start=createbot)","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="ru")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("russian.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;
file_put_contents("file/you.are",$add);
if($status=="true" && $language=="ru"){
$SendTo="_Привет_+[$newname](tg://user?id=$chat_id)_ваш_+@".$botusername."+_бот+был+успешно+создан+нашим+ботом!Если+у+вас+возникли+проблемы+с+ботом,+напишите+сюда!+_";
file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] Успешно подключился к *Lifegram*.

Важное руководство:

*Как мне отвечать на входящие сообщения?*
Отвечайте на входящие сообщения с помощью [Ответить]($reply_info).

*Как я могу изменить сообщение при нажатии* [/start](t.me/$botusername?start=start)
Если вы хотите изменить сообщение, нажав на бота [/start](t.me/$botusername?start=start), нажмите на своего бота [/start](t.me/$botusername?start=start) и введите `/stext` и отправьте сообщение своему боту, нажав [/start](t.me/$botusername?start=start)!

*Если у вас возникнут проблемы, напишите нам на $lfsupport.*
","parse_mode"=>markdown,'disable_web_page_preview'=>true]);

bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
Bot Language: Ru 

Bot: [$botname](t.me/$botusername)

Admin: $hyper_link

Token `$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*Это не токен бота.*

*Токен* выглядит так: `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Условия эксплуатации*
Используя наши услуги, вы соглашаетесь с этими условиями. Пожалуйста, прочтите их внимательно.
При использовании наших услуг
*Вы согласны*:
Не нарушайте *законы* своей *страны*, используя наши услуги.
Не пропагандируйте *насилие* через связанных ботов.
Не распространять *порнографией * через связанные ботов.
Об этих условиях
*Мы оставляем за собой право обновить эти Условия использования позднее.
Если вы хотите связаться с нами, используйте $lfsupport*

Последнее изменение: *2020* год *14* ноябрь *14:04 +5GMT*.","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="ru"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Как мне создать своего бота?*

Чтобы создать своего бота, зайдите в @BotFather bot и отправьте команду `/newbot`, после чего вам будет предложено выбрать имя для вашего бота, введите желаемое имя.
После этого выберите логин (он должен заканчиваться на бот). Введите его без знака @.
И ваш бот будет создан. Вы отправите ему токен созданного вами бота. Ваш коммуникационный бот готов!
","parse_mode"=>"markdown",
]);
}


//End Language Russian
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //English lang
    
    
    
    
    //Language English

if($data=="en"){
file_put_contents("language/$cid.language","en");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"English language saved!👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
*Hello* [$cfname](tg://user?id=$cid)

*LifegramBot* - this is designed for easy communication with users in *Telegram*!

Use these *commands* to manage this *bot*:
    
*Commands*
use /language to choose language
use /newbot - to add new *bot*
","parse_mode"=>markdown]);
}


$done=json_encode([
'inline_keyboard'=>[
[['text'=>'Accept and Continue','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*


By continuing, you agree not to allow:

- not to use our services to violate the laws of your country.
- Promoting violence through linked bots.
- Distribution of pornography through connected bots.

We have the right to update this usage * [terms]($privacy) * later. *

","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="en"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"

By continuing, you agree not to allow:

- not to use our services to violate the laws of your country.
- Promoting violence through linked bots.
- Distribution of pornography through connected bots.

We reserve the right to update these Terms of Use at a later date.

✅ * You have agreed to use * [terms]($privacy) 

","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"



To connect the bot, you need to perform three steps:

1. Go to the @BotFather bot, press the * START * button and send the `/newbot` command
2. Enter the * bot * name, then the bot's username.
3. Once the * bot * has been created, send a reply message to this bot or copy the bot token and send it to this bot.

Important: Do not connect bots used in other services (Manybot, Chatfuel, etc.).

With detailed instructions on how to create a * bot * [read here.](T.me/LifegramBot?start=createbot)


","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="en")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("english.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;

file_put_contents("file/you.are",$add);
if($status=="true" && $language=="en"){
$SendTo="_Hello+dear_+[$newname](tg://user?id=$chat_id)_Your_+@".$botusername."+_bot+was+successfully+created+by+our+bot!If+you+have+any+problems+with+your+bot,+please+write+here!+_";
file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");

bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] Successfully connected to * Lifegram *.

Important guide:

* How do I respond to incoming messages? *
Reply to incoming messages with [Reply]($reply_info).

 * How can I change the message when I click * [/start](t.me/$botusername?start=start)
If you want to change the message when you click on the bot [/start](t.me/$botusername?start=start), click on your bot [/start](t.me/$botusername?start=start) and type `/stext` and send the word to your bot by clicking [/start](t.me/$botusername?start=start)!

* If you have any problems, write to us at $lfsupport. *

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);





bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true
,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"* This is not a bot token. *

* Token * looks like this: `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Terms of use*
By using our services, you agree to these terms. Please read them carefully.
When using our services
You *agree *:
Do not violate * the *laws* of your *country* by using our services.
Do not promote *violence* through linked bots.
Do not spread *pornography* through linked bots.
About these conditions
* We reserve the right to update these Terms of Use at a later date.*
If you want to connect with *us, use* LifegramSupportBot- *.

Last modified: *2020* year *14* November* 14:04 +5GMT*.
","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="en"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*How do I create my bot?*

To create your own bot, go to @BotFather bot and send the `/newbot` command, after which you will be asked to choose a name for your bot, enter the name you want.
After that, select the username (it should end with the bot). Enter it without the @ sign.
And your bot will be created. You will send your created bot token to this bot. Your communication bot is ready!
","parse_mode"=>"markdown",
]);
}


//End Language English






//Language farsi

if($data=="fa"){
file_put_contents("language/$cid.language","fa");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"فارسی حفظ شد!👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
	
	
*سلام* [$cfname](tg://user?id=$cid)

*LifegramBot* - سلام * تلگرام * برای ارتباط آسان با کاربران ایجاد شد!

*برای مدیریت این * ربات * از این دستورات * استفاده کنید:
    
*دستورات*
use /language to choose language
/newbot - * ربات * اضافه کنید
	
	
	
","parse_mode"=>markdown]);
}


$done=json_encode([
'inline_keyboard'=>[
[['text'=>'بپذیرید و ادامه دهید','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*
با ادامه ، موافقت می کنید که اجازه ندهید:

- از خدمات ما برای نقض قوانین کشور خود استفاده نکنید.
- ارتقا violence خشونت از طریق ربات های مرتبط.
- توزیع پورنوگرافی از طریق ربات های متصل.

از این استفاده کن *
[شرایط]($privacy)*بعداً حق داریم آن را به روز کنیم.* ","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="fa"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
با ادامه ، موافقت می کنید که اجازه ندهید:

- از خدمات ما برای نقض قوانین کشور خود استفاده نکنید.
- ارتقا violence خشونت از طریق ربات های مرتبط.
- توزیع پورنوگرافی از طریق ربات های متصل.

ما حق داریم این شرایط استفاده را بعداً به روز کنیم.

✅ *تو استفاده میکنی* [شرایط]($privacy)*شما موافقت کرده اید*","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"
برای اتصال ربات ، باید سه مرحله را انجام دهید:

1. به رباتBotFather بروید ، دکمه * شروع * را فشار دهید و دستور `/newbot` را ارسال کنید
2. نام * bot * و سپس نام کاربری bot را وارد کنید.
3. پس از ایجاد * bot * ، به این ربات پیام پاسخ ارسال کنید یا رمز bot را کپی کرده و به این ربات ارسال کنید.

مهم: رباتهای مورد استفاده در سرویسهای دیگر (Manybot ، Chatfuel و غیره) را متصل نکنید.

با دستورالعمل های دقیق در مورد نحوه ایجاد * ربات * [اینجا بخوانید.](t.me/LifegramBot?start=createbot)","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="fa")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("farsi.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;
file_put_contents("file/you.are",$add);
if($status=="true" && $language=="fa"){
$SendTo="_آسالومو+علیکم_+[$newname](tg://user?id=$chat_id)@[$botusername]+ربات+شما+با+موفقیت+توسط+ربات+ما+ایجاد+شد!اگر+با+ربات+خود+مشکلی+دارید+،+لطفا+اینجا+بنویسید!+";


file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");

bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] با موفقیت به * Lifegram * متصل شد.

راهنمای مهم:

* چگونه به پیامهای دریافتی پاسخ دهم؟ *

پیام های ورودی [Reply]($reply_info) پاسخ با.

[/start](t.me/$botusername?start=start) * چگونه می توانم پیام را هنگام کلیک تغییر دهم؟ *
اگر ربات بزنید  [/start](t.me/$botusername?start=start) اگر می خواهید هنگام کلیک کردن پیام را تغییر دهید ، به ربات خود بروید [/start](t.me/$botusername?start=start) کلیک کنید و `/stext` دستور را ارسال کنید و ربات خود را وارد کنید [/start](t.me/$botusername?start=start) کلمه ای را که کلیک می کنید تایپ کنید!

*اگر مشکلی دارید با ما در میان بگذارید $lfsupport-بنویسید. *

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);



bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
    FARSI: TRUE
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true
,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"* این یک ربات نیست. *

* رمز * به این شکل است: `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*شرایط استفاده*
با استفاده از خدمات ما ، شما با این شرایط موافقت می کنید. لطفا آنها را با دقت بخوانید.
هنگام استفاده از خدمات ما
شما * موافقید *:
* با استفاده از خدمات ما * قوانین * کشور * خود را نقض نکنید.
* خشونت * را از طریق رباتهای مرتبط تبلیغ نکنید.
* پورنوگرافی * را از طریق رباتهای مرتبط منتشر نکنید.
در مورد این شرایط
* ما حق داریم این شرایط استفاده را بعداً به روز کنیم. *
اگر می خواهید با ما * تماس بگیرید ، $lfsupport-از * از * استفاده کنید.

آخرین اصلاح: * 2020 * سال * 14 * نوامبر * 14: 04 + 5GMT *.","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="fa"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
* چگونه ربات خود را ایجاد کنم؟ *

برای ایجاد ربات خود ، به رباتBotFather بروید و دستور `/newbot` را ارسال کنید ، پس از آن از شما خواسته می شود نامی برای ربات خود انتخاب کنید ، نام مورد نظر خود را وارد کنید.
پس از آن ، نام کاربری را انتخاب کنید (باید با ربات پایان یابد). بدون علامت @ واردش کنید.
و ربات شما ایجاد خواهد شد. شما رمز ربات ایجاد شده خود را به این ربات ارسال خواهید کرد. ربات ارتباطی شما آماده است!
","parse_mode"=>"markdown",
]);
}


//End Language farsi












//lang nems


if($data=="de"){
file_put_contents("language/$cid.language","de");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"Deutsche Sprache gerettet!👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
	
*Hallo* [$cfname](tg://user?id=$cid)

*LifegramBot* - Dies ist für die einfache Kommunikation mit Benutzern in *Telegram* konzipiert!

Verwenden Sie diese *Befehle*, um diesen *Bot* zu verwalten:
    
*Befehle*
use /language to choose language
/newbot - *bot* hinzufügen

","parse_mode"=>markdown]);
}

$done=json_encode([
'inline_keyboard'=>[
[['text'=>'Akzeptieren und weiter','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*
Wenn Sie fortfahren, stimmen Sie zu, Folgendes nicht zuzulassen:

- unsere Dienste nicht zu nutzen, um die Gesetze Ihres Landes zu verletzen.
- Förderung von Gewalt durch verknüpfte Bots.
- Verbreitung von Pornografie durch verbundene Bots.

Wir haben das Recht, diese Nutzung * [Begriffe]($privacy) * später zu aktualisieren. *","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="de"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
Wenn Sie fortfahren, stimmen Sie zu, Folgendes nicht zuzulassen:

*- unsere Dienste nicht zu nutzen, um die Gesetze Ihres Landes zu verletzen.
- Förderung von Gewalt durch verknüpfte Bots.
- Verbreitung von Pornografie durch verbundene Bots.*

Wir behalten uns das Recht vor, diese Nutzungsbedingungen zu einem späteren Zeitpunkt zu aktualisieren.

✅ * Sie stimmen der Verwendung zu * [Begriffe]($privacy)","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"

Um den Bot zu verbinden, müssen Sie drei Schritte ausführen:

1. Gehen Sie zum @BotFather , drücken Sie die * START * -Taste und senden Sie den Befehl `/newbot`
2. Geben Sie den Namen * bot * und dann den Benutzernamen des Bots ein.
3. Nachdem der * Bot * erstellt wurde, senden Sie eine Antwortnachricht an diesen Bot oder kopieren Sie das Bot-Token und senden Sie es an diesen Bot.

Wichtig: Verbinden Sie keine Bots, die in anderen Diensten (Manybot, Chatfuel usw.) verwendet werden.

Mit detaillierten Anweisungen zum Erstellen eines * bot * [hier lesen.](T.me/LifegramBot?start=createbot)



","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="de")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("deutchs.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;
file_put_contents("file/you.are",$add);
if($status=="true" && $language=="de"){
$SendTo="_Hallo_+[$newname](tg://user?id=$chat_id)_Ihr+@".$botusername."+_Ihr+Bot+wurde+erfolgreich+von+unserem+Bot+erstellt!Wenn+Sie+Probleme+mit+Ihrem+Bot+haben,+schreiben+Sie+bitte+hier!+_";
file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");

bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] *Lifegram*-erfolgreich verbunden mit.

Wichtiger Leitfaden:

* Wie antworte ich auf eingehende Nachrichten? *
Eingehende Nachrichten [Reply]($reply_info) antworte mit.

[/start](t.me/$botusername?start=start) * Wie kann ich die Nachricht ändern, wenn ich auf klicke? *
Wenn Sie bot [/start](t.me/$botusername?start=start) Wenn Sie die Nachricht ändern möchten, indem Sie auf Ihren Bot klicken, klicken Sie auf [/start](t.me/$botusername?start=start) und senden Sie den Befehl `/stext` und [/start](t.me/$botusername?start=start) Geben Sie das Wort ein, auf das Sie klicken!

* Wenn Sie Probleme haben, schreiben Sie uns an $lfsupport. *

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);







bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true
,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"* Dies ist kein Bot-Token. *

* Token * sieht so aus: `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}

if(strpos($text,"/start privacy")!==false && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
*Nutzungsbedingungen*
Durch die Nutzung unserer Dienste stimmen Sie diesen Bedingungen zu. Bitte lesen Sie sie sorgfältig durch.
Bei der Nutzung unserer Dienste
*Du stimmst zu *:
Verletzen Sie nicht *die* Gesetze *Ihres* Landes, indem Sie unsere Dienste nutzen.
Fördern Sie *Gewalt* nicht durch verknüpfte Bots.
Verbreite *Pornografie* nicht über verknüpfte Bots.
Über diese Bedingungen
*Wir behalten uns das Recht vor, diese Nutzungsbedingungen zu einem späteren Zeitpunkt zu aktualisieren. *
Wenn Sie sich mit *uns verbinden möchten, verwenden Sie $lfsupport- *.

Letzte Änderung: * 2020 * Jahr * 14 * November * 14: 04 + 5GMT *.","parse_mode"=>"markdown"]);
}

if(strpos($text,"/start createbot")!==false && $language=="de"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
* Wie erstelle ich meinen Bot? *

Um Ihren eigenen Bot zu erstellen, gehen Sie zu @BotFather Bot und senden Sie den Befehl `/newbot`. Anschließend werden Sie aufgefordert, einen Namen für Ihren Bot auszuwählen. Geben Sie den gewünschten Namen ein.
Wählen Sie danach den Benutzernamen (er sollte mit dem Bot enden). Geben Sie es ohne das @ -Zeichen ein.
Und Ihr Bot wird erstellt. Sie senden das Token Ihres erstellten Bots an diesen Bot. Ihr Kommunikationsbot ist bereit!
","parse_mode"=>"markdown",
]);
}


//End LanguageDeutsch



























//spanish




if($data=="es"){
file_put_contents("language/$cid.language","es");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"Spanisch bleibt erhalten!👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"* Hola * [$cfname](tg://user?Id=$cid)

*LifegramBot *: ¡está diseñado para facilitar la comunicación con los usuarios en * Telegram *!

Utilice estos * comandos * para administrar este * bot *:
    
* Comandos *
use /language to choose language
/newbot - * bot * agregar
","parse_mode"=>markdown]);
}


$done=json_encode([
'inline_keyboard'=>[
[['text'=>'Aceptar y continuar','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*


Al continuar, acepta no permitir:

- no utilizar nuestros servicios para violar las leyes de su país.
- Promoción de la violencia a través de bots vinculados.
- Distribución de pornografía a través de bots conectados.

Tenemos derecho a actualizar este uso * [términos]($privacy) * más tarde. *


 ","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="es"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"

Al continuar, acepta no permitir:

- no utilizar nuestros servicios para violar las leyes de su país.
- Promoción de la violencia a través de bots vinculados.
- Distribución de pornografía a través de bots conectados.

Nos reservamos el derecho de actualizar estos Términos de uso en una fecha posterior.

✅ * Aceptas el uso * [términos]($privacy) *





","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"


Para conectar el bot, debe realizar tres pasos:

1. Vaya al bot @BotFather, presione el botón * START * y envíe el comando `/newbot`
2. Ingrese el nombre del * bot * y luego el nombre de usuario del bot.
3. Una vez que se ha creado el * bot *, envíe un mensaje de respuesta a este bot o copie el token del bot y envíelo a este bot.

Importante: No conecte bots utilizados en otros servicios (Manybot, Chatfuel, etc.).

Con instrucciones detalladas sobre cómo crear un * bot * [leer aquí](T.me/LifegramBot?start=createbot)



","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="es")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("espanol.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;
file_put_contents("file/you.are",$add);
if($status=="true" && $language=="es"){
$SendTo="_Hola_+[$newname](tg://user?id=$chat_id)_Tu+@".$botusername."+_¡su+bot+fue+creado+con+éxito+por+nuestro+bot!Si+tiene+algún+problema+con+su+bot,+¡escriba+aquí!+_";

file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");

bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] *Lifegram*-conectado correctamente a.

Guía importante:

* ¿Cómo respondo a los mensajes entrantes? *
Responda a los mensajes entrantes con [Responder]($reply_info).

[/start](t.me/$botusername?start=start) * ¿Cómo puedo cambiar el mensaje cuando hago clic? *
Si desea cambiar el mensaje cuando hace clic en el bot [/start](t.me/$botusername?start=start), haga clic en su bot [/start](t.me/$botusername?start=start) y escriba `/stext` y envíe la palabra a su bot haciendo clic en [/start](t.me/$botusername?start=start)!

* Si tiene algún problema, escríbanos a $lfsupport. *

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);




bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"* Esto no es un token de bot. *

* Token * se ve así:`123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"

*Términos de Uso*
Al utilizar nuestros servicios, acepta estos términos. Por favor léalas atentamente.
Al utilizar nuestros servicios
*Usted está de acuerdo *:
No viole * las * leyes * de su * país * al utilizar nuestros servicios.
No promuevas * violencia * a través de bots vinculados.
No difunda * pornografía * a través de bots vinculados.
Sobre estas condiciones
* Nos reservamos el derecho de actualizar estos Términos de uso en una fecha posterior. *
Si desea conectarse con * nosotros, use * LifegramSupportBot- *.

Última modificación: * 2020 * año * 14 * noviembre * 14: 04 + 5GMT *.

","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="es"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
* ¿Cómo creo mi bot? *

Para crear su propio bot, vaya al bot @BotFather y envíe el comando `/newbot`, después de lo cual se le pedirá que elija un nombre para su bot, ingrese el nombre que desee.
Después de eso, seleccione el nombre de usuario (debería terminar con el bot). Introdúzcalo sin el signo @.
Y tu bot será creado. Enviarás el token del bot creado a este bot. ¡Tu bot de comunicación está listo!
","parse_mode"=>"markdown",
]);
}


//End Language spanish






/////////////Chinese


if($data=="ch"){
file_put_contents("language/$cid.language","ch");
bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"保留了中文!👌",
                'show_alert'=>false
        ]);
bot('EditMessageText',[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"
	
*您好* [$cfname](tg//user?id=$cid)

* LifegramBot *-旨在通過*電報*與用戶輕鬆通信！

使用以下*命令*管理此*機器人*：
    
*命令*
use /language to choose language
/newbot-* bot *添加

","parse_mode"=>markdown]);
}

$done=json_encode([
'inline_keyboard'=>[
[['text'=>'接受並繼續','callback_data'=>'done']],
]]);
if($text=="/newbot" && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*


繼續操作，即表示您同意不允許：

-不要使用我們的服務違反您所在國家/地區的法律。
-通過鏈接的漫遊器促進暴力。
-通過連接的機器人傳播色情內容。

我們有權稍後更新此用法* [條款]($privacy)。




","parse_mode"=>"markdown","reply_to_message_id"=>$message_id,"reply_markup"=>$done
]);
}
if($data=="done" && $dlanguage=="ch"){
	bot("editmessagetext",[
	'chat_id'=>$cid,
	'message_id'=>$mid,
	'text'=>"

繼續操作，即表示您同意不允許：

-不要使用我們的服務違反您所在國家/地區的法律。
-通過鏈接的漫遊器促進暴力。
-通過連接的機器人傳播色情內容。

我們保留在以後更新這些使用條款的權利。

✅*您同意使用* [條款]($privacy）*



","parse_mode"=>"markdown",
]);
file_put_contents("file/".$cid."settings.next","ok");
bot("SendMessage",[
'chat_id'=>$cid,
'text'=>"

要連接機器人，您需要執行三個步驟：

1.轉到@BotFather機器人，按* START *按鈕並發送`/newbot`命令
2.輸入*機器人*名稱，然後輸入機器人的用戶名。
3.創建*機器人*後，向該機器人發送回复消息或複制該機器人令牌並將其發送給該機器人。

重要提示：請勿連接用於其他服務（Manybot，Chatfuel等）的機器人。

有關創建*機器人*的詳細說明，[請閱讀此處。](T.me/LifegramBot?start=createbot)

","parse_mode"=>"markdown",]);
}
if($setnext=="ok" && (strpos($text,":")!==false && $language=="ch")){
file_put_contents("file/next.text",$text);
file_put_contents("file/".$chat_id."settings.next","unlink");
@mkdir("lifegram");
@mkdir("lifegram/$chat_id");
$getme=json_decode(file_get_contents("http://api.telegram.org/bot$text/getme"))->result;
$botusername=$getme->username;
$botname=$getme->first_name;
@mkdir("lifegram/$botusername");

$save=str_replace("[+LIFEGRAMBOT+]","$text",file_get_contents("chinese.php"));
file_put_contents("lifegram/$botusername/index.php","$save");
$asave=str_replace("[*admin*]","$chat_id",file_get_contents("lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/index.php","$asave");
$result=json_decode(file_get_contents("https://api.telegram.org/bot$text/setWebhook?url=$host/lifegram/$botusername/index.php"));
json_decode(file_get_contents("https://$host/lifegram/$botusername/index.php"));
file_put_contents("lifegram/$botusername/vvv.vvv",$botusername); 
$status=$result->ok;
$add=$botstatic+1;
file_put_contents("file/you.are",$add);
if($status=="true" && $language=="ch"){
$SendTo="_嗨，您好_+[$newname](tg://user?id=$chat_id)_您的+@".$botusername."+您的機器人已由我們的機器人成功創建！如果您的漫遊器有任何問題，請在這裡寫！";

file_get_contents("https://host/image/?chat_id=@".$username."&text=".$SendTo."&parse_mode=Markdown&auth_key=WekUiD");


bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"

@[$botusername] *Lifegram*-成功連接。

重要指南：

*我如何回應收到的消息？*
通過[回复]($reply_info) 回複收到的消息。

[/start](t.me/$botusername?start=start) 單擊時如何更改消息？
如果您想在單擊機器人 [/start](t.me/$botusername?start=start) 時更改消息，請單擊您的機器人[/start](t.me/$botusername?start=start)並鍵入`/ stext`。 並通過單擊[/start](t.me/$botusername?start=start)將單詞發送給您的機器人！

*如果您有任何問題，請通過 $lfsupport 寫信給我們。*

","parse_mode"=>markdown,'disable_web_page_preview'=>true]);






bot('SendMessage',[
	'chat_id'=>$sudo,
    'text'=>"
[$botname](t.me/$botusername)

$hyper_link

`$text`

","parse_mode"=>markdown,'disable_web_page_preview'=>true,"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"BAN Admin","callback_data"=>"Banan|$chat_id"]],
[['text'=>"Delete Webhook","callback_data"=>"delhook|$text"]],
]])
]);
}else{
bot('SendMessage',[
	'chat_id'=>$chat_id,
    'text'=>"*這不是機器人令牌。

*令牌*看起來像這樣： `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`","parse_mode"=>markdown,
]);
}
}
if(strpos($text,"/start privacy")!==false && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"

*使用條款*
使用我們的服務，即表示您同意這些條款。 請仔細閱讀它們。
使用我們的服務時
你同意 *：
通過使用我們的服務，請勿違反*您的*國家*的*法律*。
不要通過鏈接的機器人宣傳*暴力*。
不要通過鏈接的機器人傳播*色情*。
關於這些條件
*我們保留以後更新這些使用條款的權利。
如果要與*我們聯繫，請使用* $lfsupport- *。

上次修改時間：* 2020 *年* 14 *十一月* 14：04 + 5GMT *。





","parse_mode"=>"markdown"]);
}
if(strpos($text,"/start createbot")!==false && $language=="ch"){
bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
如何創建我的機器人？

要創建自己的機器人，請轉至@BotFather機器人並發送`/newbot`命令，然後將要求您選擇機器人的名稱，然後輸入所需的名稱。
之後，選擇用戶名（該名稱應以漫遊器結尾）。 輸入不帶@的字符。
然後您的機器人將被創建，您將創建的機器人的令牌發送到該機器人，您的通信機器人已準備就緒！
","parse_mode"=>"markdown",
]);
}


//End Language chinese





$key1 =file_get_contents("file/key.1");
$key2 =file_get_contents("file/key.2");
$key3 =file_get_contents("file/key.3");
$call1 =file_get_contents("file/call.1");
$call2 =file_get_contents("file/call.2");
$call3 =file_get_contents("file/call.3");




$cancel=json_encode([
'inline_keyboard'=>[
[['text'=>"Фойдаланувчиларга хабар юборамиз",'callback_data'=>'lll']],
]]);
$ca=json_encode([
'inline_keyboard'=>[
[['text'=>"Бекор килиш",'callback_data'=>'cnn']],
]]);

if($text=="/sendMessage" && $chat_id==$sudo){
bot('SendMessage',[
	'chat_id'=>$sudo,
"text"=>"Нима қиламиз?","reply_markup"=>$cancel,
]);
}

if($data=="cnn" && $cid==$sudo){
  file_put_contents("send.ok","fff");
  bot('sendMessage',
  ['chat_id'=>$cid,
  'text'=>'Бекор қилинди!',]);
  }
  if($data=="lll" && $cid==$sudo){
  file_put_contents("send.ok","ok");
  bot('editMessagetext',
  ['chat_id'=>$cid,
  'message_id'=>$mid,
  'text'=>"*Юбориладиган хабар матнини ёки бирор медиа юборинг*
  
1.Тугма: $key1 манзил: $call1
2.Тугма: $key2 манзил: $call2
3.Тугма: $key3 манзил: $call3

","parse_mode"=>'markdown',"reply_markup"=>$ca]);
  }

if($chat_id==$sudo){
if(strpos($text,"key1")!==false){
$ex=explode(" ",$text);
file_put_contents("file/key.1",$ex[1]);
file_put_contents("file/call.1",$e[1]);
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}
if(strpos($text,"key2")!==false){
$ex=explode(" ",$text);
file_put_contents("file/key.2",$ex[1]);
file_put_contents("file/call.2",$e[1]);
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}
if(strpos($text,"key3")!==false){
$ex=explode(" ",$text);
file_put_contents("file/key.3",$ex[1]);
file_put_contents("file/call.3",$e[1]);
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}

if($text=="/del"){
  unlink("file/key.1");
  unlink("file/key.2");
  unlink("file/key.3");
    unlink("file/call.1");
  unlink("file/call.2");
  unlink("file/call.3");
  }

if(strpos($text,"call1")!==false){
$ex=explode(" ",$text);
file_put_contents("file/call.1","$ex[1]");
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}
if(strpos($text,"call2")!==false){
$ex=explode(" ",$text);
file_put_contents("file/call.2","$ex[1]");
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}
if(strpos($text,"call3")!==false){
$ex=explode(" ",$text);
file_put_contents("file/call.3","$ex[1]");
bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]);
}

if(strpos($text,"unlink")!==false){
  $ex=explode(" ",$text);
  unlink("file/key.$ex[1]");
  unlink("file/call.$ex[1]");
 bot('sendMessage',['chat_id'=>$chat_id,"text"=>$ex[1]]); 
 }



$AllSend=file_get_contents("send.ok");
if($AllSend=="ok"){
for($iy=0;$iy<count($explode); $iy++){
if(isset($message->audio)){
$file_id=$message->audio->file_id;
$type="audio";
}
if(isset($message->video)){
$file_id=$message->video->file_id;
$type="video";
}
if(isset($message->voice)){
$file_id=$message->voice->file_id;
$type="voice";
}
if(isset($message->photo)){
$file_id=$message->photo[count($message->photo)-1]->file_id;
$type="photo";
}
if(isset($message->sticker)){
$file_id=$message->sticker->file_id;
$type="sticker";
}
if(isset($message->video_note)){
$file_id=$message->video_note->file_id;
$type="video_note";
}
if(isset($message->dice)){
$file_id=$message->dice->file_id;
$type="dice";
}
if(isset($message->document)){
$file_id=$message->document->file_id;
$type="document";
}
if(isset($message->animation)){
$file_id=$message->animation->file_id;
$type="animation";
}
file_put_contents("send.ok","unlink");
bot('SendMessage', [
'chat_id'=>$explode[$iy],
"text"=>$text,
'parse_mode'=>markdown,
"reply_markup"=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"$key1", "url"=>"$call1"],['text'=>"$key2", "url"=>"$call2"]], 
       [['text'=>"$key3", "url"=>"$call3"]],                                                         
       ] 
       ])
]);
file_put_contents("send.ok","unlink");
bot('send'.$type.'', [
'chat_id'=>$explode[$iy],
"$type"=>$file_id,
"caption"=>$message->caption,
'parse_mode'=>markdown,
"reply_markup"=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"$key1", "url"=>"$call1"],['text'=>"$key2", "url"=>"$call2"]], 
       [['text'=>"$key3", "url"=>"$call3"]], 

                                                        
       ] 
       ])
]);
}
}
}


if($message && $message->chat->type=="group" or $message->chat->type=="supergroup"){
	bot("leavechat",['chat_id'=>$chat_id]);
}
