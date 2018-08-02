<?php
session_start();
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$pid = $_GET['pid'];
	// $pid = $_POST['cid'];
	// $pid = $_POST['pid'];
	$p_type = $_POST['p_type'];
	$t_type = $_POST['t_type'];
	$title = $_POST['title'];
	$price = $_POST['price'];
	$d_price = $_POST['price_display'];
	$available = $_POST['available'];
	$sql1 = "UPDATE properties SET type='$p_type', t_type='$t_type', title='$title', price=$price, d_price=$d_price, availability=$available, edit=CURRENT_TIMESTAMP WHERE pid=$pid";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		// echo $pid;
		// http_response_code(200);
		$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email);
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data['email'],  "Property Updated | R.E.X", 'Your property (<b>'.$data["title"].'</b>) has been edited by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>Property Type: <b>'.$p_type.'</b><br>Transaction Type: <b>'.$t_type.'</b><br>Title: <b>'.$title.'</b><br>Price: <b>'.$price.'</b><br>Display Price Tag: <b>'.$d_price.'</b><br>Availability: <b>'.$available.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		if ($_SESSION['log'] == "admin") {
			header("Location: /?tab=prop&prop=edited");
		} else {
			header("Location: /?tab=my&prop=edited");
		}
	} else {
		// echo mysqli_error($conn);
		// http_response_code(500);
		header("Location: /?tab=prop&prop=error");
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>