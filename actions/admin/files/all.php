<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

$srcs = $_POST['srcs'];
$str = "[";
if ($srcs != "<srcs></srcs>") {
	$xml=simplexml_load_string($srcs);
	foreach ($xml as $key => $value) {
		if(unlink("../../../".$value)) {
			if ($str != "[") {
				$str .= ",";
			}
			$str .= '{"src": "'.$value.'"}';
		}
	}
	echo $str."]Rex123".$_POST['type'];
	http_response_code(200);
} else {
	// http_response_code(503);
}
?>