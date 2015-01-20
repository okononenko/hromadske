<?php 
session_start();

header('Content-type: application/json');

define('EMAIL_SENDER', 'debate.kgtv.kremenchug@gmail.com');
define('EMAIL_RECEIVER', 'kgtv.kremenchug@gmail.com');

define('SYMBOLS_LIMIT', 1000);
define('DEBUG', false);

if(!DEBUG) error_reporting(0);

echo processRequest(array_merge($_GET, $_POST));

function processRequest($params){
	if(!isset($params['email'])) return errorResponse("feedback email not set");
	if(!isset($params['text'])) return errorResponse("text not set");
	if(!isset($params['name'])) return errorResponse("name not set");

	$email = clearText($params['email']);
	$text = clearText($params['text']);
	$name = clearText($params['name']);

	if(isEmptyStr($email)) return errorResponse("email is empty");
	if(isEmptyStr($text)) return errorResponse("text is empty");
	if(isEmptyStr($name)) return errorResponse("name is empty");
	if(isTextTooLong($text)) return errorResponse("text too long");
	if(!isEmail($email)) return errorResponse("wrong email format");

	//если нас пытаются прокидать, то морозимся мол все ок, но запрос не отправляем
	// if(!DEBUG && !isRequestFromWebsite()) return resultResponse("ok");

	try{
		sendMail($email, $name, $text);
		return resultResponse("ok");
	}catch(Exception $e){
		return errorResponse($e->getMessage());
	}
}

function sendMail($email, $name, $text){
	$headers = "From: ". EMAIL_SENDER . "\r\n" .
    "Reply-To: ". EMAIL_SENDER . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= "Content-type: text/html\r\n";

	$subject = "Вопрос: " . $name;

	$IP = getClientIP();

	$fullText = "<b>От:</b> $name <br/>";
	$fullText .= "<b>Email:</b> $email <br/>";
	$fullText .= "<b>IP:</b> $IP <br/><br/>";
	$fullText .= $text;

	mail(EMAIL_RECEIVER, $subject, $fullText, $headers);
	// for($i = 0; $i < count($mails); $i++){
	// 	mail($mails[$i], $subject, $fullText, $headers);
	// }
}

function filterText($text){
	if($text==null) return null;
	return $text;
}

// function sendMail($email, $name, $text){
// 	$method = "email";
// 	$ip = getClientIP();
// 	$params = array('email' => $email, 
// 					'name' => $name, 
// 					'text' => $text,
// 					'ip' => $ip);
// 	toolsApiRequest($method, $params);
// }

// function toolsApiRequest($method, $params = null){
// 	$url = "http://tools.kgtv.com.ua/api/v1/".$method;
// 	if($params){
// 		$i = 0;
// 		foreach ($params as $key => $value) {
// 			if($i == 0) $url .= "?".$key."=".$value;
// 			else $url .= "&".$key."=".$value;
// 			$i++;
// 		}
// 	}
// 	$data = getJSON($url);
// 	if(!$data) return null;
// 	if(isset($data -> error)) throw new Exception("Api error: " . $data -> error);
// 	if(!isset($data -> result)) throw new Exception("Api result not set");
// 	return $data -> result;
// }

function isRequestFromWebsite(){
	if(!isset($_SERVER['HTTP_REFERER'])) return false;
	$clientUrl = $_SERVER['HTTP_REFERER'];
	if(!isURL($clientUrl)) return false;

	$pageWithFormURL = "kgtv.com.ua/debati";
	if(!isStrContainStr($clientUrl, $pageWithFormURL)) return false;
	return true;
}

function isURL($str){
	if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) return false;
	return true;
}

function isStrContainStr($str1, $str2){
	if (strpos($str1, $str2) !== false) return true;
	return false;
}

function getClientIP() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getJSON($url){
	$str = file_get_contents($url);
	return json_decode($str);
}

function isEmail($email){
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
	else return false;
}

function isEmptyStr($str){
	if(strlen($str) == 0) return true;
	else return false;
}

function clearText($str){
	$str = trim($str);
	return $str;
}

function isTextTooLong($text){
	if(strlen($text) > SYMBOLS_LIMIT) return true;
	return false;
}

function resultResponse($data){
	return '{"result":"'.$data.'"}';
}

function errorResponse($err){
	return '{"error":"'.$err.'"}';
}

?>