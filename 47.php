<?php
require "./engine/functions.php";
$app = new wbApp();
$text = file(__DIR__."/47.txt");

$out = <<<OUT
<html>
<head>
    <script type="text/javascript" src="/engine/js/jquery.min.js"></script>
    <script type="text/javascript" src="forms/chat/qrcode.min.js"></script>
    <meta data-wb="role=snippet">
</head>

<ul></ul>

    <script>
		$(document).ready(function(){
			$("ul li > span").each(function(){
				var id = $(this).next("div").attr("id");
				var text = "mailto:"+$(this).attr("data");
				var qrcode = new QRCode(id, {
					text: text,
					width: 256,
					height: 256,
					colorDark : "#000000",
					colorLight : "#ffffff",
					correctLevel : QRCode.CorrectLevel.H
				});
				
			});
		});
   
    </script>
	<style>
		li {margin-bottom:100px;}
	</style>
</html>
OUT;

$out = $app->fromString($out);
foreach($text as $str) {
	$str = explode(";",$str);
	$id = "qr".md5($str[1]);
	$out->find("ul")->append("<li>{$str[1]}<span data='{$str[1]}'></span><div id='{$id}'></div></li>");
}



echo $out;
die;
?>
