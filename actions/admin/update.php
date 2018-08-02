<?php
session_start();
if (isset($_POST['submit_btn']) && $_POST['submit_btn'] == "adminEdit") {
	include '../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$aid = $_SESSION['aid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender'];
		$cont = $_POST['cont'];
		$street = $_POST['street'];
		$town = $_POST['town'];
		$city = $_POST['city'];
		$state = $_POST['state'];

		$sql1 = "UPDATE admins,addresses SET admins.firstname='$fname', admins.lastname='$lname', admins.gender='$gender', admins.contact='$cont', addresses.street_no='$street', addresses.town='$town', addresses.city='$city', addresses.state='$state' WHERE admins.add_id=addresses.add_id AND admins.aid=$aid";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {

			$_SESSION['fname'] = $fname;
			$_SESSION['lname'] = $lname;
			$_SESSION['gender'] = $gender;
			$_SESSION['contact'] = $cont;
			$_SESSION['street'] = $street;
			$_SESSION['town'] = $town;
			$_SESSION['city'] = $city;
			$_SESSION['state'] = $state;

			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($_SESSION['email'],  "Profile Updated | R.E.X", 'Your account\'s personal information has been edited. The informations are:<br>Firstname: <b>'.$fname.'</b><br>Lastname: <b>'.$lname.'</b><br>Gender: <b>'.$gender.'</b><br>Contact Number: <b>'.$cont.'</b><br>Street Number: <b>'.$street.'</b><br>Town: <b>'.$town.'</b><br>City: <b>'.$city.'</b><br>State: <b>'.$state.'</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));

			header("Location: /?type=admin&edit=true");
			// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
		} else {
			echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
		}
		closeDB($conn);
	} else {
		echo "Connection Error HTTP Code 400".mysqli_connect_error();
	}
}
?>