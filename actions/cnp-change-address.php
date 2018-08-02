<?php
session_start();
if (isset($_POST['submit_btn']) && $_POST['submit_btn'] == "clientEdit") {
	include '../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$add_id = $_GET['add_id'];
		$street = $_POST['street'];
		$town = $_POST['town'];
		$city = $_POST['city'];
		$state = $_POST['state'];

		$sql1 = "UPDATE addresses SET street_no='$street', town='$town', city='$city', state='$state' WHERE add_id=$add_id";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			if ($_GET['type'] == "client") {
				$email_query = "SELECT clients.email FROM clients, addresses WHERE addresses.add_id=$add_id AND addresses.add_id=clients.add_id";
				$result_email = mysqli_query($conn, $email_query);
				if ($result_email) {
					$data = mysqli_fetch_assoc($result_email)['email'];
					// To send HTML mail, the Content-type header must be set
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html;';

					// Additional headers
					$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
					mail($data,  "Address Changed | R.E.X", 'Your address has been changed successfully. Your new Address is:<br>Street Number: <b>'.$street.'</b><br>Town: <b>'.$town.'</b><br>City: <b>'.$city.'</b><br>State: <b>'.$state.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
				}
				header("Location: /?type=admin&client=edited");
			} else {
				$sql2 = "UPDATE properties SET edit=CURRENT_TIMESTAMP WHERE add_id=$add_id";
				$result2 = mysqli_query( $conn, $sql2);
				if ($result2) {
					$email_query = "SELECT clients.email, properties.title FROM clients, properties WHERE properties.pid=$pid AND properties.cid=clients.cid";
					$result_email = mysqli_query($conn, $email_query);
					if ($result_email) {
						$data = mysqli_fetch_assoc($result_email);
						// To send HTML mail, the Content-type header must be set
						$headers[] = 'MIME-Version: 1.0';
						$headers[] = 'Content-type: text/html;';

						// Additional headers
						$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
						mail($data['email'],  "Property Address Changed | R.E.X", 'Your property\'s (<b>'.$data["title"].'</b>) address has been changed by the administrator of our system <b>R.E.X.</b> due to any reasonable issue or by your demand. The informations are:<br>Street Number: <b>'.$street.'</b><br>Town: <b>'.$town.'</b><br>City: <b>'.$city.'</b><br>State: <b>'.$state.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
					}
					if ($_SESSION["log"] == "client") {
						header("Location: ../../index.php?tab=my&prop=edited");
					} else {
						header("Location: ../../index.php?tab=prop&prop=edited");
					}
				} else {
					header("Location: ../../index.php?prop=edited&error=prop&tab=prop");
					
				}
			}
			// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
		} else {
			header("Location: ../../index.php?type=admin&error=edit&msg=".mysqli_error($conn));
			// echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
		}
		closeDB($conn);
	} else {
		echo "Connection Error HTTP Code 400".mysqli_connect_error();
	}
}
?>