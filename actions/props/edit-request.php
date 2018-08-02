<?php
session_start();
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$pr_id = $_GET['pr_id'];
	// $pr_id = $_POST['cid'];
	// $pr_id = $_POST['pr_id'];
	$p_type = $_POST['p_type'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$bhk = $_POST['bhk'];
	$bath = $_POST['bath'];
	$from = explode(" ", $_POST['c_area'])[0];
	$from = trim($from);
	$to = explode(" ", $_POST['c_area'])[3];
	$c_area = $from . "-" . $to;
	$from = explode(" ", $_POST['budget'])[1];
	$to = explode(" ", $_POST['budget'])[4];
	$budget = $from . "-" . $to;

	$sql1 = "UPDATE post_requirement SET type='$p_type', city='$city', state='$state', bhk=$bhk, bath=$bath, area='$c_area', budget='$budget', edit=CURRENT_TIMESTAMP WHERE pr_id=$pr_id";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		// echo $pr_id;
		// http_response_code(200);
		$email_query = "SELECT clients.email FROM clients, post_requirement WHERE post_requirement.pr_id=$pr_id AND post_requirement.cid=clients.cid";
		$result_email = mysqli_query($conn, $email_query);
		if ($result_email) {
			$data = mysqli_fetch_assoc($result_email)['email'];
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($data,  "Requested Property Updated | R.E.X", 'Your one of the requested property has been edited by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>Type: <b>'.$p_type.'</b><br>City: <b>'.$city.'</b><br>State: <b>'.$state.'</b><br>BHK: <b>'.$bhk.'</b><br>Bathrooms: <b>'.$bath.'</b><br>Area: <b>'.$c_area.'</b><br>Budget: <b>'.$budget.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
		}
		if ($_SESSION["log"] == "admin") {
			header("Location: /?tab=req&req=edited");
		} else {
			header("Location: /?req=edited");
		}
	} else {
		// echo mysqli_error($conn);
		// http_response_code(500);
		header("Location: /?tab=req&req=error");
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>