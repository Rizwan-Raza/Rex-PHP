<?php
session_start();

$old_password = $_POST['opsw'];
$old_password = trim($old_password);
$password = $_POST['npsw'];
$password = trim($password);
$cpassword = $_POST['repsw'];
$cpassword = trim($cpassword);
if ($password == $cpassword) {
	include '../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$needle = substr($_SESSION['log'], 0, 1);
		$check = "SELECT password FROM ".$_SESSION['log']."s WHERE password='".md5("Rex123".$old_password."Rex123")."' AND ".$needle."id=".$_SESSION[$needle.'id'];
		$result = mysqli_query( $conn, $check);
		if (mysqli_num_rows($result) == 1) {
			$sql1 = "UPDATE ".$_SESSION['log']."s SET password='".md5("Rex123".$password."Rex123")."' WHERE ".$needle."id=".$_SESSION[$needle.'id'];
			$result = mysqli_query( $conn, $sql1);
			if ($result) {
				$data = mysqli_fetch_assoc($result_email);
				// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html;';

				// Additional headers
				$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
				mail($_SESSION['email'],  "Password Changed | R.E.X", 'Your password of account <b>'.$_SESSION['email'].'</b> has been changed. The new password is <b>'.$password.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
				header("Location: /?type=".$_SESSION['log']."&password=changed");
				// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
			} else {
				echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
			}
		} else {
			echo "Authentication Error ".mysqli_error($conn);
		}
		closeDB($conn);
	} else {
		echo "Connection Error HTTP Code 400".mysqli_connect_error();
	}
} else {
	echo "Password Not Matched";	
}
?>