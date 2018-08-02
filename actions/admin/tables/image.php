<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	$piid = $_POST['cid'];
	$sql = "DELETE FROM property_images WHERE piid=$piid";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo '{"piid": "'.$piid.'"}';
		http_response_code(200);
	} else {
		http_response_code(503);
	}
} else {
	http_response_code(400);
}
?>