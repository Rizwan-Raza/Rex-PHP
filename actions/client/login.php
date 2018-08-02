<?php
session_start();

if (isset($_POST['submit_btn']) && $_POST['submit_btn'] == "Login") {
	include '../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$usrname = $_POST['usrname'];
		$psw = $_POST['psw'];
		$sql = "SELECT * FROM clients,addresses WHERE clients.add_id=addresses.add_id AND clients.email='$usrname' AND clients.password='".md5("Rex123".$psw."Rex123")."'";
		$result = mysqli_query( $conn, $sql);
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				$row = mysqli_fetch_assoc($result);
				if ($row['active'] != 0) {
					$_SESSION['fname'] = $row['firstname'];
					$_SESSION['lname'] = $row['lastname'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['gender'] = $row['gender'];
					$_SESSION['contact'] = $row['contact'];
					$_SESSION['street_no'] = $row['street_no'];
					$_SESSION['town'] = $row['town'];
					$_SESSION['city'] = $row['city'];
					$_SESSION['state'] = $row['state'];
					$_SESSION['dp_src'] = $row['src'];
					$_SESSION['cid'] = $row['cid'];
					$_SESSION['log'] = "client";
					header("Location: /");
				} else {
					header("Location: /?type=client&active=false");
				}
			} else {
				header("Location: /?type=client&error=auth&msg=".mysqli_error($conn));
				// echo "<script>$('#clientAuthErrorModal').modal('show');</script>";
				// echo "Authentication Error HTTP Code 502 ".mysqli_error($conn);
			}
		} else {
			echo "Server Error HTTP Code 500 Error: ".mysqli_error($conn)." ";
		}
		closeDB($conn);
	} else {
		echo "Connection Error HTTP Code 400".mysqli_connect_error();
	}
}
?>