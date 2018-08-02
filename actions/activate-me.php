<?php 
if (isset($_GET['cid_hash'])) {
	// session_start();
	include '../components/database.php';
	$conn = connectDB();
	$num = explode("|", $_GET['cid_hash'])[1];
	$cid = ($num - 1111)/6;
	$sql1 = "UPDATE clients SET active=1 WHERE cid=".$cid;
	$result = mysqli_query( $conn, $sql1);
	if ($result) {
		header("Location: /?activation=done");
	}
}
?>