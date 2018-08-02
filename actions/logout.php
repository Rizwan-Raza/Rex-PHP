<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == "true") {
	session_destroy();
	// echo "<script>window.location.href='index.php'; </script>";
	header("Location: /");
}
?>