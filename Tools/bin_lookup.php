<?php

////==============[Bin Lookup Command]==============////

if ((strpos($message, "/bin") === 0) || (strpos($message, "!bin") === 0)){
$bin = substr($message, 4);
$bin = preg_replace('/[^0-9]+/', ' ', $bin);
$bin = ltrim($bin);
$first6 = substr("$bin", 0, 6);

if (empty($bin) || (strlen($bin) < 6) ) {
  $respo = urlencode ("<b>Invalid or Empty Input </b>❌\n<b>Format:</b> <code>/bin xxxxxx..</code>");
  sendMessage($chatId, $respo , $message_id); 
  return;  }


sendaction($chatId, "typing");
$text = urlencode ("<b>BIN LookUP : </b> Checking.. ♻️ <b>\n
Bin      :</b>   <code>$first6 </code><b>
Result :</b>  <i>Please wait for a second. ⏳</i>");
$msg_result = reply($chatId, $text , $message_id);
$msg_json = json_decode($msg_result, TRUE);
$msg_id = $msg_json['result']['message_id'];   


$bin = substr("$bin", 0, 8);
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
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$type = GetStr($fim, '"type":"', '"');
//$ban = " .$bank ";
  

$respo = urlencode ("<b>BIN LookUP : </b> VALID ✅ <b>\n
✦ Bin     :</b>  <code>$first6 </code><b>
✦ Card  :</b>  <i>$scheme </i><b>
✦ Type  :</b>  <i>$type </i><b>
✦ Level :</b>  <i>$brand </i><b>
✦ Bank :</b>   <i>$bank </i><b>
✦ Type  :</b>  <i>$name ($emoji) </i>\n
═══════════════════ \n<b>Bot Made by:</b><a> [raven_ccs]</a>");
  editMessage($chatId, $respo , $msg_id); 
  return;
}
////=============[Bin Command-END]==============////

?>