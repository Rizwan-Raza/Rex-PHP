<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gallery | R.E.X</title>
	<?php include 'components/head.php'; ?>
</head>
<body>
<?php 
	include 'components/navHead.php';
	include 'components/modals/image.html';	
?>
<br>
<div class="container">
	<h4>Here is the list of properties posted by our sellers.
		For more information, try to <a data-toggle="modal" data-target="#clientLoginModal"> Login </a>
	</h4>
	<br>
<?php
	include 'components/database.php';
	include 'components/client/showProps.php';
	$conn = connectDB();
	if ($conn) {
			$sql = "SELECT * FROM properties, clients, addresses WHERE properties.add_id=addresses.add_id AND properties.sid=clients.cid ORDER BY properties.time DESC";
			$result = mysqli_query($conn, $sql);
			showPropsWithResult($result, $conn, "gallery");
	} else {
		echo "<div class='alert alert-danger fade in'>
			<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Error!</b> Can't Connect to Database
		</div>";
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