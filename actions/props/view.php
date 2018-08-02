<?php
$pid = $_POST['cid'];
include '../../components/client/showProps.php';
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$sql = "SELECT * FROM properties, clients, addresses WHERE properties.add_id=addresses.add_id AND properties.sid=clients.cid AND properties.pid=$pid";
	$result = mysqli_query($conn, $sql);
	showPropsWithResult($result, $conn, "view");
	http_response_code(200);
	// echo "Hello World";
	closeDB($conn);
} else {
	echo "<div class='alert alert-danger fade in'>
		<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Error!</b> Can't Connect to Database
	</div>";
	http_response_code(503);
}
?>