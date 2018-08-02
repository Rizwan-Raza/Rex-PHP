<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);

include '../../../components/database.php';
$conn = connectDB();
$cid = $_POST['cid'];
if ($conn) {
	$get_sql = "SELECT * FROM clients WHERE cid=$cid";
	$result1 = mysqli_query($conn, $get_sql);
	if ($result1) {
		$row = mysqli_fetch_assoc($result1);
		$newSrc = str_replace("client", "admin", $row['src']);
		$sql1 = "INSERT INTO admins(firstname, lastname, email, password, gender, contact, add_id, src) VALUES ('".$row['firstname']."', '".$row['lastname']."', '".$row['email']."', '".$row['password']."', '".$row['gender']."', '".$row['contact']."', ".$row['add_id'].", '".$newSrc."')";
		$result2 = mysqli_query( $conn, $sql1);
		if ($result2 and copy("../../../".$row['src'], "../../../".$newSrc)) {
			// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html;';

			// Additional headers
			$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
			mail($row['email'], "Congratulation | R.E.X", "<b>Congratulation</b>, you are now an <b>adminstrator</b> of our system <b>R.E.X.</b><br><br>You can login with<br>Username: <b>".$row['email']."<b> and password of your client account.<br><br>See more at <a href='http://rex.esy.es'>http://rex.esy.es</a>.", implode("\r\n", $headers));
			echo '{"name": "'.$row['firstname'].'", "cid": "'.$cid.'"}';
			http_response_code(200);
		} else {
			http_response_code(503);
		}
	} else {
		http_response_code(504);
	}
	closeDB($conn);
} else {
	http_response_code(400);
}
?>