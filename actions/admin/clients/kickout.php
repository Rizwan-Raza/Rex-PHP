<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	$cid = $_POST['cid'];

	$email_query = "SELECT email,src FROM clients WHERE cid=$cid";
	$result_email = mysqli_query($conn, $email_query);

	$sql1 = "DELETE FROM addresses WHERE add_id=(SELECT add_id FROM clients WHERE cid=$cid)";
	$result = mysqli_query( $conn, $sql1);

	if ($result) {
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email);
			$src  = "../../../".$data['src'];
			if($data['src'] != "uploads/users/temp.png") {
				unlink($src);
			}
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data['email'],  "Kickout | R.E.X", 'Your account <b>'.$data['email'].'</b> has been removed by the administrator of our system <b>R.E.X.</b> due to any reasonable issue. For using our system R.E.X, signup again.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		echo '{"cid": "'.$cid.'"}';
		http_response_code(200);
	} else {
		http_response_code(500);
	}
	closeDB($conn);
} else {
	echo '"error": "Connection Error HTTP Code 400'.mysqli_connect_error().'"}';
	http_response_code(400);
}
?>