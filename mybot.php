<?php

$token = "1476182121:AAGC6nCqPVL2j-LA4IPYjjBFWfEQbI9mtFg";

$json = file_get_contents('php://input');
$telegram = urldecode ($json);
$results = json_decode($telegram); 


$message = $results->message;
$text = $message->text;
$chat = $message->chat;
$user_id = $chat->id;


//Send Text Message With Inline Keyboard
function bot_keyboardmessage ($user_id,$message,$token,$keyboard) {
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
	$replyMarkup = array(
				'keyboard' => $keyboard,
				'resize_keyboard' => true);
				$encodedMarkup = json_encode($replyMarkup);
				$message = urlencode($message);
				$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_markup='.$encodedMarkup;
				$update = file_get_contents($url);
			
}
if ($text == '/start'){
	$message = "سلام !"."\r\n"."به پنهان چت خوشومدی\xF0\x9F\x98\x89"."\r\n"."چه کاری می تونم برات انجام بدم؟🥰";
	$keyboard = array(
					array( 'امتیاز من',"امتیاز های برتر"),
					array( 'شارژ رایگان' , "راهنما"),
				);

	bot_keyboardmessage ($user_id,$message,$token,$keyboard);

}
else {
	$message = "ورودی درست نیس!";
	bot_sendmessage ($user_id,$message,$token);
}

function bot_sendmessage ($user_id,$message,$token) {
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message;
	$update = file_get_contents($url);
}


?>
