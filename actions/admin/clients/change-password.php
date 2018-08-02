<?php
session_start();

$password = $_POST['npsw'];
include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	$cid = $_GET['cid'];
	$sql1 = "UPDATE clients SET password=md5($password) WHERE cid=$cid";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		$email_query = "SELECT email FROM clients WHERE cid=$cid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email)['email'];
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data, "Password Changed | R.E.X", 'Your Password of account <b>'.$data.'</b> has been changed to <b>'.$password.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		header("Location: /?type=admin&password=changed");
	} else {
		echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
}
?>