<?php
session_start();
if (isset($_POST['req-submit'])) {
	include '../../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$p_type = $_POST['p-type'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$bhk = $_POST['bhk'];
		$bath = $_POST['bath'];
		$from = explode(" ", $_POST['c-area'])[0];
		$from = trim($from);
		$to = explode(" ", $_POST['c-area'])[3];
		$c_area = $from . "-" . $to;
		$from = explode(" ", $_POST['budget'])[1];
		$to = explode(" ", $_POST['budget'])[4];
		$budget = $from . "-" . $to;
		$sql1 = "INSERT INTO post_requirement (cid, type, city, state, bhk, bath, area, budget) VALUES(".$_SESSION['cid'].",'".$p_type."','".$city."','".$state."', $bhk, $bath, '".$c_area."', '".$budget."');";
		if (mysqli_query( $conn, $sql1)) {
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($_SESSION['email'],  "Property Requested | R.E.X", 'Your property requirements has been successfully requested to our system <b>R.E.X.</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
			header("Location: /?post_req=done");
		} else {
			echo mysqli_error($conn);
			header("Location: /?error=addrs");
		}
		closeDB($conn);
	} else {
		echo mysqli_connect_error();
		header("Location: /?error=conn");
		// http_response_code(400);
	}
} else {
	header("Location: /?error=submittion");
}
?>