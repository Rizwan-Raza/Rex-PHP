<?php
session_start();
if (isset($_POST['submit_btn']) && $_POST['submit_btn'] == "adminLogin") {
	include '../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$usrname = $_POST['usrname'];
		$psw = $_POST['psw'];
		$sql1 = "SELECT admins.aid, admins.add_id FROM admins WHERE admins.email='$usrname' AND admins.password='".md5("Rex123".$psw."Rex123")."'";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				$row = mysqli_fetch_assoc($result);
				$sql2 = "SELECT * FROM admins, addresses WHERE admins.aid=".$row['aid']." AND addresses.add_id=".$row['add_id'];
				$result2 = mysqli_query( $conn, $sql2);
				if ($result2) {
					if (mysqli_num_rows($result2) != 0) {
						$row2 = mysqli_fetch_assoc($result2);
						$_SESSION['aid'] = $row2['aid'];
						$_SESSION['fname'] = $row2['firstname'];
						$_SESSION['lname'] = $row2['lastname'];
						$_SESSION['email'] = $row2['email'];
						$_SESSION['gender'] = $row2['gender'];
						$_SESSION['contact'] = $row2['contact'];
						$_SESSION['city'] = $row2['city'];
						$_SESSION['street_no'] = $row2['street_no'];
						$_SESSION['town'] = $row2['town'];
						$_SESSION['state'] = $row2['state'];
						$_SESSION['dp_src'] = $row2['src'];
						$_SESSION['log'] = "admin";
						header("Location: /");
						// echo "<script>window.location.href='index.php'</script>";
					}
				}
				// header("Location: index.php");
			} else {
				// echo "<script>$('#adminAuthErrorModal').modal('show');</script>";
				header("Location: /?type=admin&error=auth&msg=".mysqli_error($conn));
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