<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>About Us | R.E.X</title>
	<?php include 'components/head.php'; ?>
</head>
<body>
<?php 
	include 'components/navHead.php';

	include 'components/about/page.html';
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