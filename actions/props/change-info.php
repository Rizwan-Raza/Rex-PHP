<?php
session_start();
// echo "<script>alert('In Script');</script>";
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$pid = $_GET['pid'];
	// $pid = $_POST['cid'];
	// $pid = $_POST['pid'];
	$amens = $_POST['in_house'];
	$units = $_POST['units'];
	$floor = $_POST['floor'];
	$t_floors = $_POST['t_floors'];
	$desc = $_POST['desc'];
	$tnc = $_POST['tnc'];
	if (empty($floor)) {
		$floor = "NULL";
	}
	if (empty($desc)) {
		$desc = "NULL";
	}
	if (empty($tnc)) {
		$tnc = "NULL";
	}
	$sql1 = "UPDATE properties SET units=$units, floor=$floor, t_floors=$t_floors, b_desc='$desc', tnc='$tnc', edit=CURRENT_TIMESTAMP WHERE pid=$pid";
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		$del = "DELETE FROM property_amenities WHERE pid=$pid";
		if (mysqli_query($conn, $del)) {
			foreach ($amens as $amen) {
				switch ($amen) {
					case 'net':
						$amen = "Internet / Wi-Fi";
						break;
					case 'air':
						$amen = "Air-Conditioned";
						break;
					case 'ro':
						$amen = "RO Water System";
						break;
					case 'gas':
						$amen = "Gas Supply";
						break;
					case 'water':
						$amen = "Water Supply and Pipeling";
						break;
					
					default:
						$amen = "+1 Amenity";
						break;
				}
				if (!mysqli_query($conn, "INSERT INTO property_amenities (pid, amenity) VALUES ($pid, '$amen')")) {
					$error = true;
					echo mysqli_error($conn);
				}
			}
			if ($error) {
				header("Location: /?tab=prop&prop=error&type=amen");
			} else {
				// echo "Done!!";
				$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
				$result_email = mysqli_query($conn, $email_query);
				if ($result_email) {
					$data = mysqli_fetch_assoc($result_email);
					// To send HTML mail, the Content-type header must be set
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html;';

					// Additional headers
					$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
					mail($data['email'],  "Property Informations Updated | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) informations has been edited by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>Units: <b>'.$units.'</b><br>Floor: <b>'.$floor.'</b><br>Total Floors: <b>'.$t_floors.'</b><br>Brief Description: <b>'.$desc.'</b><br>Terms and Conditions: <b>'.$tnc.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
				}
				if ($_SESSION["log"] == "admin") {
					header("Location: /?tab=prop&prop=edited");
				} else {
					header("Location: /?tab=my&prop=edited");
				}
			}
		} else {
			header("Location: /?tab=prop&prop=error&type=a_del");
		}
		// echo $pid;
		// http_response_code(200);
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