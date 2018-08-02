<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	$piids = $_POST['cid'];
	$str = "[";
	if ($piids != "<piids></piids>") {
		$xml=simplexml_load_string($piids);
		$error = false;
		foreach ($xml as $key => $piid) {
			$sql = "DELETE FROM property_images WHERE piid=$piid";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				if ($str != "[") {
					$str .= ",";
				}
				$str .= '{"piid": "'.$piid.'"}';
			}
		}
		if (!$error) {
			echo $str."]";
			http_response_code(200);
		} else {
			http_response_code(503);
		}
	} else {
		http_response_code(504);
	}
} else {
	http_response_code(400);
}
?>
