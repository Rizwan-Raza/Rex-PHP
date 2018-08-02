<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
session_start();

include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $pid = $_GET['pid'];
	// $pr_id = $_POST['pr_id'];
	$pr_id = $_POST['cid'];
	// $pid = $_POST['pid'];
	$sql1 = "DELETE FROM post_requirement WHERE pr_id=$pr_id";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		$email_query = "SELECT clients.email FROM clients, post_requirement WHERE post_requirement.pr_id=$pr_id AND post_requirement.cid=clients.cid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email)['email'];
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data,  "Requested Property Deleted | R.E.X", 'Your one of the requested property has been deleted by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		echo '{"prId": "'.$pr_id.'", "log": "'.$_SESSION["log"].'"}';
		http_response_code(200);
	} else {
		echo mysqli_error($conn);
		// header("Location: /?type=admin&error=delete&msg=".mysqli_error($conn));
		http_response_code(500);
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>