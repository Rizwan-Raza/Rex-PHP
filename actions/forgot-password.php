<?php
session_start();

include '../../components/database.php';
$conn = connectDB();
$password = rand(10000,99999);
$email = $_POST['email'];
if ($conn) {
	$sql1 = "UPDATE ".$_SESSION['log']."s SET password=md5($password) WHERE email='$email'";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html;';

		// Additional headers
		$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
		mail($email, "Password Recovery | R.E.X", "Your Password has been changed, your current password is <b>".$password."</b>.<br><br>See more at <a href='http://rex.esy.es'>http://rex.esy.es</a>.", implode("\r\n", $headers));
		$password = $password + 11111;
		header("Location: /?type=admin&password=changed&salt=$password");
		// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
	} else {
		echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
}
?>