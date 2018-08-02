<?php
session_start();
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$pid = $_GET['pid'];
	// $pid = $_POST['cid'];
	// $pid = $_POST['pid'];
	$bhk = $_POST['bhk'];
	$bath = $_POST['bath'];
	$age = $_POST['age'];
	$furnished = $_POST['furnished'];
	$h_dis = $_POST['h_dis'];
	$s_dis = $_POST['s_dis'];
	$r_dis = $_POST['r_dis'];
	$p_area = $_POST['p_area'];
	$land = $_POST['land'];
	$sql1 = "UPDATE properties SET bhk=$bhk, bathrooms=$bath, age=$age, furnished=$furnished, hospital=$h_dis, school=$s_dis, rail=$r_dis, area=$p_area, l_area=$land, edit=CURRENT_TIMESTAMP WHERE pid=$pid";
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
			mail($data['email'],  "Property Features Updated | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) features has been edited by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>BHK: <b>'.$bhk.'</b><br>Bathrooms: <b>'.$bath.'</b><br>Age: <b>'.$age.'</b><br>Furnished: <b>'.$furnished.'</b><br>Distance From Hospital: <b>'.$h_dis.'</b><br>Distance From School: <b>'.$s_dis.'</b><br>Distance From Railway: <b>'.$r_dis.'</b><br>Property Area: <b>'.$p_area.'</b><br>Land Area: <b>'.$land.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		if ($_SESSION["log"] == "admin") {
			header("Location: /?tab=prop&prop=edited");
		} else {
			header("Location: /?tab=my&prop=edited");
		}
	} else {
		// echo mysqli_error($conn);
		// http_response_code(500);
		header("Location: /?tab=prop&prop=error&msg=".mysqli_error($conn));
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>