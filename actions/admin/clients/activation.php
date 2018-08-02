<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

include '../../../components/database.php';
$conn = connectDB();
$cid = $_POST['cid'];
$desicion = $_GET['activate'];
if ($desicion == "true") {
	$var = 1;
} else {
	$var = 0;
}
if ($conn) {
	$sql1 = "UPDATE clients SET active=$var WHERE cid=".$cid;
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		$email_query = "SELECT email FROM clients WHERE cid=$cid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			if ($desicion == "true") {
				$str = "A";
				$inf = "activated";
			} else {
				$str = "Dea";
				$inf = "deactivated";
			}
			$data = mysqli_fetch_assoc($result_email)['email'];
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data,  $str."ctivation | R.E.X", 'Your account <b>'.$data.'</b> has been <b>'.$inf.'</b> by administrator.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		echo '{"cid": "'.$cid.'"}';
		http_response_code(200);
	} else {
		echo '{"error": "Server Error HTTP Code 500 Error: '.mysqli_error($conn).'"}';
		http_response_code(500);
	}
	closeDB($conn);
} else {
	echo '{"error": "Connection Error HTTP Code 400 Error: '.mysqli_connect_error().'"}';
	http_response_code(400);
}
?>