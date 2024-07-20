<?php
#----------------------------------------------------------------------#
#   CODED BY: Avin-Knight                                              #
#   GATE: Bin Lookup 2                                                 #
#   CONF: SECUREPAY API              				                   #
#----------------------------------------------------------------------#

////==============[Bin Lookup Command]==============////

if ((strpos($message, "/gen") === 0) || (strpos($message, "!gen") === 0)){
$bin = substr($message, 5);

include "./Tools/functions/usefun.php";

  

//$lista = preg_replace('/[^0-9]+/', ' ', $lista);
//$lista = ltrim($lista);

$amt = "1";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://namsogen.me/ajax.php');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: namsogen.me',
'accept: */*',
'accept-language: en-GB,en;q=0.9',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
//'cookie: _ga_GFB3K65HB2=GS1.1.1655539732.1.0.1655539732.0; _ga=GA1.1.622929380.1655539732; __gads=ID=2d2edb17d6bbc7ba-22c2c5fa93d400a6:T=1655539732:RT=1655539732:S=ALNI_MZMc_qw3QOgrVOql027uj_wIUYewA; __gpi=UID=000006bfde8c9304:T=1655539732:RT=1655539732:S=ALNI_Ma8cqBLKMN7n0Qe5QJ_ccd-YFCC-Q; __atuvc=1%7C24; __atuvs=62ad8814f96be531000',
'origin: https://namsogen.me',
'referer: https://namsogen.me/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Safari/537.36',
'x-requested-with: XMLHttpRequest',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=3&bin='.$bin.'&date=on&s_date=&year=&csv=on&s_csv=&number='.$amt.'&format=pipe');
$fim = curl_exec($ch);
curl_close($ch);

$fim = ' '.$fim.' ';
$fems = str_replace("_"," ",$fim);

//$replace = str_replace('_', ' ', $fim, $fem);
//$fim = str_replace("_"," ", $fim);
//$fim = preg_replace("/_/",' ', $fim);

//$fim = ltrim($fim);



//$bininfo = "$bin2 - $brand - $type - $level - $bank - $country - $flag";
//echo "<br><br><b>BIN DATA:</b> $bininfo<br>;



sendMessage($chatId, '<b>🟢CC GEN :- </b>'.$fems.'%0A<b>✦ Bank:</b> '.$ban.'%0A<b>✦ Checked by</b>: @'.$username.'%0A<b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>BOT MADE BY:</b><a> [raven_ccs]</a>', $message_id);
}

////=============[Bin Command-END]==============////

?>