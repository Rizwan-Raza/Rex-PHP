<?php
session_start();
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $pid = $_POST['cid'];
	$pid = $_GET['pid'];
	$target_dir = "uploads/props/";
	$target_file = $target_dir.$pid."_".basename($_FILES["propImage"]["name"]);
	$target_file = filter_var($target_file, FILTER_SANITIZE_URL);
	$target_file = str_replace("'", "_", $target_file);
	$uploadOk = 1;

	if (move_uploaded_file($_FILES["propImage"]["tmp_name"], "../../".$target_file)) {
		$sql1 = "INSERT INTO property_images(pid, src) VALUES($pid, '".$target_file."')";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
			$result_email = mysqli_query($conn, $email_query);
			if ($result_email) {
				$data = mysqli_fetch_assoc($result_email);
				// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html;';

				// Additional headers
				$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
				mail($data['email'],  "Property Image Added | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) image has been added successfully to our system <b>R.E.X.</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
			}
			if ($_SESSION["log"] == "admin") {
				header("Location: /?tab=prop&prop=added");
			} else {
				header("Location: /?tab=my&prop=added");
			}
		} else {
			// http_response_code(500);
			unlink("../../".$target_file);
			header("Location: /?tab=prop&prop=error&error=query&msg=".mysqli_error($conn));
		}
	} else {
		// http_response_code(404);
		header("Location: /?tab=prop&prop=error&error=image");
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
	header("Location: /?error=conn");
}
?>