<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;


class modTwilio {
  function __construct($app) {
	$this->app = $app;
	$out = "";
	if ($app->vars("_route.mode") > '') {
		$mode = $app->vars("_route.mode");
		if (method_exists($this,$mode)) {
		    $out=@$this->$mode();
		}
	} else {
        $out=false;
	}
	echo $out;
	die;
}


function xml() {
	if ($mode!=="xml") header('Content-Type: application/json');
	$url="{$_ENV['route']['hostp']}/ajax/signup_get_code/";
	$code=wbAuthPostContents($url, array("usdot"=>$_ENV["route"]["usdot"]));
	$xml=false;
	if ($code) {
		header('Content-Type: application/xml; charset=utf-8');
		$xml=new VoiceResponse();
		$xml->say('Listen verification code:');
		$xml->pause(['length' => 1]);
		for($i=0; $i<strlen($code); $i++) {
			$xml->say($code[$i]);
			$xml->pause(['length' => 1]);
		}
		$xml->pause(['length' => 1]);
		$xml->say('Repeat:');
		$xml->pause(['length' => 1]);
		for($i=0; $i<strlen($code); $i++) {
			$xml->say($code[$i]);
			$xml->pause(['length' => 1]);
		}
	}
	echo $xml;
}

function sms() {
	$app = $this->app;
	include_once($app->vars('_env.path_app').'/functions.php');
	// Your Account SID and Auth Token from twilio.com/console
	$account_sid = $app->vars("_sett.modules.twilio.id");
	$auth_token = $app->vars("_sett.modules.twilio.token");
	// In production, these should be environment variables. E.g.:
	// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
	// A Twilio number you own with SMS capabilities
	$twilio_number = $app->vars("_sett.modules.twilio.number");
	$phone = "+".text2tel($app->vars("_post.phone"));
	$code = genSmsCode();
	$_SESSION["smscode"] = $code;
	echo $code;
//	die;
	$client = new Client($account_sid, $auth_token);
	$client->messages->create(
	    // Where to send a text message (your cell phone?)
	    '+79883471188',
	    array(
	        'from' => $twilio_number,
	        'body' => 'Код регистрации: '.$code
	    )
	);
}


function say_code() {
	if ($mode!=="xml") header('Content-Type: application/json');
	if (!isset($_POST["usdot"])) return json_encode(false);
	if ($_POST["usdot"] !== $_ENV["test_dot"]) {
		if (!isset($_ENV["mongo"])) $_ENV["mongo"] = new MongoDB\Driver\Manager($_ENV["mongo_server"]);
		$company=mongoItemRead($_ENV["mongo"],"dot.dot",$_POST["usdot"]);
	} else {
		$company=ajaxTestCompany();
	}
	$account_sid = $_ENV["twilio_acc"];
	$auth_token = $_ENV["twilio_token"];
	// In production, these should be environment variables. E.g.:
	// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
	// A Twilio number you own with Voice capabilities
	$twilio_number = $_ENV["twilio_number"];

	// Where to make a voice call (your cell phone?)

	if (isset($company["phone"])) {
		$to_number = preg_replace("/[^\+0-9]/", '', $company["phone"]);
		if ($to_number[0] !== "+") $to_number = "+1".$company["phone"];
		if ($company["phone"]=="(988) 347-1188") $to_number = "+7".$company["phone"];
	} else {
		return json_encode(false);
	}

	$client = new Client($account_sid, $auth_token);

	$call = $client->account->calls->create(
	    $to_number,
	    $twilio_number,
	    array(
		"url" => "{$_ENV["route"]["hostp"]}/module/twilio/{$_POST["usdot"]}.xml"
	    )
	);
	if ($call->sid) {$res =  true;} else {$res=false;}
	return json_encode($res);
}


function twilio_voice_fails() {}

function twilio_msg_fails() {}

function twilio_sender() {
	$out=wbFromFile(__DIR__ . "/twilio_sender_ui.php");
	$out->wbSetData();
	return $out->outerHtml();
}

function twilio_sender_listform() {
	$message = $_POST["text"];
	$to = array();
	$lines =  explode("\n",$_POST["list"]);
	foreach ($lines as &$line) {
		$line=movTelFormat($line,"+1##########");
		///////////$line=movTelFormat($line,"+7##########");
		$to[] = '{"binding_type":"sms", "address":"'.$line.'"}';
	}
	$twilio = new Client($_ENV["twilio_acc"], $_ENV["twilio_token"]);
	$notification = $twilio
	->notify->services($_ENV["twilio_service"])
	->notifications->create([
		"toBinding" => $to,
		"body" => $message,
		'sms' => ['status_callback' => "{$_ENV["route"]["hostp"]}/module/twilio/sender_callback"]
	]);
}

function twilio_sender_callback() {
	$file =  __DIR__ . "/sender.log";
	$text = "{$_REQUEST['To']} : {$_REQUEST['SmsStatus']}";
	$text .= "\n";
	$fOpen = fopen($file,'a');
	fwrite($fOpen, $text);
	fclose($fOpen);
}

function twilio_sender_logview() {
	$file =  __DIR__ . "/sender.log";
	echo file_get_contents($file);
}

}
?>
