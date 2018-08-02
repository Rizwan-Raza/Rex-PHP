<?php
include '../components/database.php';
$conn = connectDB();
if ($conn) {
	$email = $_POST['email'];

	$sql1 = "SELECT email FROM clients WHERE email='$email'";
	if (mysqli_num_rows(mysqli_query( $conn, $sql1)) == 0) {
		http_response_code(200);
	} else {
		echo mysqli_error($conn);
		http_response_code(500);
	}
	closeDB($conn);	
} else {
	echo mysqli_connect_error();
	http_response_code(400);
}
?>