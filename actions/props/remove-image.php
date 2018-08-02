<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $pid = $_POST['cid'];
	$src = $_POST['cid'];
	if (unlink("../../".$src)) {
		$sql1 = "DELETE FROM property_images WHERE src='$src'";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
			$result_email = mysqli_query($conn, $email_query);
			if ($result_email) {
				$data = mysqli_fetch_assoc($result_email);
				// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html;';

				// Additional headers
				$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
				mail($data['email'],  "Property Image Removed | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) image has been removed successfully from our system <b>R.E.X.</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
			}
			echo '{"src": "'.$src.'"}';
			http_response_code(200);
		} else {
			http_response_code(500);
			// header("Location: /?tab=prop&prop=error");
		}
	} else {
		http_response_code(404);
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>