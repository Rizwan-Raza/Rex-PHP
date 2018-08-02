<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
session_start();

include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $pid = $_GET['pid'];
	// $cid = $_GET['cid'];
	$pid = $_POST['cid'];
	$cid = $_SESSION['cid'];
	$sql1 = "INSERT INTO wishlist(pid, cid) VALUES($pid, $cid)";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		$wid = mysqli_insert_id($conn);
		// header("Location: ../../index.php?type=admin&client=active");
		$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE clients.cid=$cid AND properties.pid=$pid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email);
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data['email'],  "Property Liked | R.E.X", 'You have been successfully liked property (<b>'.$data['title'].'</b>). The Property has been added to your wishlist in our system <b>R.E.X.</b>To see, click <a href="rex.esy.es/index.php?tab=wish">rex.esy.es/index.php?tab=wish</a>.', implode("\r\n", $headers));
		}
		echo '{"pid": "'.$pid.'", "wid": "'.$wid.'"}';
		http_response_code(200);
		// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
	} else {
		echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
		http_response_code(500);
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>