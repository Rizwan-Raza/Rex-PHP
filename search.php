<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Result | R.E.X</title>
	<?php include 'components/head.php'; ?>
</head>
<body>
<?php 
	include 'components/client/modals/login.html'; 
	include 'components/client/modals/authError.html';
	include 'components/client/modals/activeError.html';

	include 'components/admin/modals/login.html'; 
	include 'components/admin/modals/authError.html';
	echo '<div id="passwordChangedSnackbar">Password changed Successfully!</div>';
	
	include 'components/modals/signup.html'; 
	include 'components/modals/signupSuccess.html';
	include 'components/modals/forgotPassword.html'; 
	include 'components/modals/seller.php'; 

	include 'components/nav.php';
	echo '<div class="seperator"></div>';
?>
<div class="container">
<?php 
if(isset($_GET['q']) and isset($_GET['type']) and isset($_GET['range'])) {
	include 'components/client/showProps.php';
	include 'components/database.php';
	$conn = connectDB();
	$q = $_GET['q'];
	$type = $_GET['type'];
	$range = $_GET['range'];
	if (!isset($_GET['range-all'])) {
		$from = explode(" ", $_GET['range'])[1];
		$to = explode(" ", $_GET['range'])[4];
		if ($type != "All") {
			$sql = "SELECT * FROM properties, addresses, clients WHERE properties.add_id=addresses.add_id AND addresses.city LIKE '%$q%' AND properties.type='$type' AND price BETWEEN $from AND $to AND clients.cid=properties.sid";
		} else {
			$sql = "SELECT * FROM properties, addresses, clients WHERE properties.add_id=addresses.add_id AND addresses.city LIKE '%$q%' AND price BETWEEN $from AND $to AND clients.cid=properties.sid";
		}
	} else {
		if ($type != "All") {
			$sql = "SELECT * FROM properties, addresses, clients WHERE properties.add_id=addresses.add_id AND addresses.city LIKE '%$q%' AND properties.type='$type' AND clients.cid=properties.sid";
		} else {
			$sql = "SELECT * FROM properties, addresses, clients WHERE properties.add_id=addresses.add_id AND addresses.city LIKE '%$q%' AND clients.cid=properties.sid";
		}
	}
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$num = mysqli_num_rows($result);
		echo "<h3>$num  properties matched with your need</h3>";
		showPropsWithResult($result, $conn, "search");
		// for ($i=0; $i < $num; $i++) { 
		// }
	} else {
		echo mysqli_error($conn);
	}
} else {
	header("Location: /");
}
?>
</div>
<?php 
	include 'components/footer.html';
	if (isset($_SESSION['log'])) {
		echo '<script type="text/javascript" src="js/active.js"></script>';
	} else {
		echo '<script type="text/javascript" src="js/inactive.js"></script>';
	}
?>
<script type="text/javascript" src="js/common.js"></script>
</body>
</html>