<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

$type = $_POST['type'];
$dir = "uploads/";
if ($type == "prop") {
	$dir .= "props/";
} else {
	$dir.= "users/".$type."s/";
}
$salt = $type."s";
if ($type == "prop") {
	$salt = $type."erty_images";
}
$newfile = $dir.$_POST['filename'];
$oldfile = $dir.$_POST['old'];
$new = "../../".$newfile;
$old = "../../".$oldfile;
if (rename($old, $new)) {
	http_response_code(200);
	include '../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$sql = "UPDATE $salt SET src='$newfile' WHERE src='$oldfile'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo '{"newName":"'.$newfile.'", "oldName": "'.md5($oldfile).'", "type": "'.$type.'", "newSalt": "'.md5($newfile).'"}';
			http_response_code(200);
		} else {
			http_response_code(504);
		}
	} else {
		http_response_code(400);
	}
} else {
	http_response_code(503);
}
?>