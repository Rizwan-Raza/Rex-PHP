<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
session_start();

include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	// $pid = $_GET['pid'];
	$pid = $_POST['cid'];
	// $pid = $_POST['pid'];

	$sql2 = "SELECT src FROM property_images WHERE pid=$pid";
	$result2 = mysqli_query( $conn, $sql2);

	$sql1 = "DELETE FROM addresses WHERE add_id=(SELECT add_id FROM properties WHERE pid=$pid)";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		if ($result2) {
			$error = false;
			$num_o_i = mysqli_num_rows($result2);
			// echo "Loop se pehle with $num_o_i AND pid=$pid <br>";
			for ($i=0; $i < $num_o_i; $i++) { 
				// echo "Hua kya fir ?? <br>";
				$path = "../../".mysqli_fetch_assoc($result2)['src'];
				if (!unlink($path)) {
					echo $path;
					$error = true;
					http_response_code(405);
					exit;
				}
				// echo $path."<br>";
			}
			// echo "Yahan aaya tha <br>";
			if (!$error) {
				$sql3 = "DELETE FROM properties WHERE pid=$pid";
				$result3 = mysqli_query( $conn, $sql3);
				if ($result3) {
					$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
					$result_email = mysqli_query($conn, $email_query);
					if ($result_email) {
						$data = mysqli_fetch_assoc($result_email);
						// To send HTML mail, the Content-type header must be set
						$headers[] = 'MIME-Version: 1.0';
						$headers[] = 'Content-type: text/html;';

						// Additional headers
						$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
						mail($data['email'],  "Property Deleted | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) has been deleted by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
					}
					echo '{"pid": "'.$pid.'", "log": "'.$_SESSION["log"].'"}';
					http_response_code(200);
				} else {
					echo mysqli_error($conn);
					http_response_code(503);
				}
			} else {
				echo mysqli_error($conn);
				http_response_code(502);
			}
		} else {
			echo mysqli_error($conn);
			http_response_code(501);
		}
		// header("Location: ../../index.php?type=admin&client=deleted");
	} else {
		echo mysqli_error($conn);
		// header("Location: ../../index.php?type=admin&error=delete&msg=".mysqli_error($conn));
		http_response_code(500);
	}
	closeDB($conn);
} else {
	echo "Connection Error HTTP Code 400".mysqli_connect_error();
	http_response_code(400);
}
?>