<?php
include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	$cid = $_GET['cid'];
	// $cid = $_POST['cid'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$cont = $_POST['cont'];

	$sql1 = "UPDATE clients SET firstname='$fname', lastname='$lname', email='$email', gender='$gender', contact='$cont' WHERE cid=$cid";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html;';

		// Additional headers
		$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
		mail($email,  "Profile Updated | R.E.X", 'Your account\'s (<b>'.$email.'</b>) personal information has been edited by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>Firstname: <b>'.$fname.'</b><br>Lastname: <b>'.$lname.'</b><br>Email: <b>'.$email.'</b><br>Gender: <b>'.$gender.'</b><br>Contact Number: <b>'.$cont.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		header("Location: /?type=admin&client=edited");
		// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
		// echo $cid."-*-".$fname."-*-".$lname."-*-".$email."-*-".$gender."-*-".$cont;
		// http_response_code(200);
	} else {
		header("Location: /?type=admin&error=edit&msg=".mysqli_error($conn));
		// echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
		// http_response_code(500);
	}
	closeDB($conn);
} else {
	header("Location: /?type=admin&error=conn&msg=".mysqli_connect_error($conn));
	// echo "Connection Error HTTP Code 400".mysqli_connect_error();
	// http_response_code(400);
}
?>