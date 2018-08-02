<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
session_start();

include '../../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $wid = $_GET['wid'];
	$wid = $_POST['cid'];
	$pid = 0;
	$sql1 = "SELECT pid FROM wishlist WHERE wid=$wid";
	$result1 = mysqli_query( $conn, $sql1);
	if ($result1) {
		if (mysqli_num_rows($result1) != 0) {
			$pid = mysqli_fetch_assoc($result1)['pid'];
		}
		$sql2 = "DELETE FROM wishlist WHERE wid=$wid";
		$result2 = mysqli_query( $conn, $sql2);
		if ($result2) {
			// header("Location: /?type=admin&client=active");
			$email_query = "SELECT clients.email, properties.title FROM clients, properties, wishlist WHERE wishlist.wid=$wid AND properties.pid=wishlist.pid AND wishlist.cid=clients.cid AND properties.pid=$pid";
			$result_email = mysqli_query($conn, $email_query);
			if ($result_email) {
				$data = mysqli_fetch_assoc($result_email);
				// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html;';

				// Additional headers
				$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
				mail($data['email'],  "Property Unliked | R.E.X", 'You have been successfully unliked the property (<b>'.$data['title'].'</b>). The Property has been removed from your wishlist in our system <b>R.E.X.</b>To see, click <a href="rex.esy.es/index.php?tab=wish">rex.esy.es/index.php?tab=wish</a>.', implode("\r\n", $headers));
			}
			echo '{"pid": "'.$pid.'", "cid": "'.$_SESSION['cid'].'"}';
			http_response_code(200);
			// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
		} else {
			echo "Server Error HTTP Code 501 Error: ".mysqli_error($conn)." ";
			http_response_code(501);
		}
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