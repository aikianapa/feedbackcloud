<?php
wbRouterAdd("/module/twilio/(:num).xml", '/module/twilio/xml/usdot:$1');

function modLoginBeforeShow($dom) {
  $app = $dom->app;
  return $dom;
}

function text2tel($str) {
    return preg_replace("/\D/", '', $str);
}

function genSmsCode() {
    $code = rand(0,9999);
    $code = sprintf("%04s", $code);
    return $code;
}

function ajax_checkcode() {
  $res = false;
  $code1 = intval($_SESSION["smscode"]);
  $code2 = intval($_POST["smscode"]);
  if ($code1 == $code2) $res = true;
  return json_encode(["result"=>$res]);
}

function chatQuery($uri, $data) {

	$data = json_decode($data,true);

                $context = stream_context_create(array(
                     'http'=>array(
                             'method'=>"POST",
                             'header'=>	"Accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7\r\n" .
                             "Cache-Control: no-cache\r\n" .
                             'Content-Type:' . " application/x-www-form-urlencoded\r\n" .
                             'Cookie: ' . $_SERVER['HTTP_COOKIE']."\r\n" .
                             'Connection: ' . " Close\r\n\r\n",
                             'content' => http_build_query($data)
                     ),
                     "ssl"=>array(
                         "verify_peer"=>false,
                         "verify_peer_name"=>false,
                     )
                 ));
                session_write_close();
                $res=@file_get_contents("https://feedbackcloud.ru{$uri}", true, $context);
                echo $res;
}

?>
