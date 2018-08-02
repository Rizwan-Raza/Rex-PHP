<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

$src = $_POST['src'];
$size = filesize("../../../".$src)/1024;
if (unlink("../../../".$src)) {
	echo '{"src":"'.$src.'", "bytes":"'.$size.'", "type": "'.$_POST['type'].'"}';
	http_response_code(200);
} else {
	http_response_code(503);
}
?>