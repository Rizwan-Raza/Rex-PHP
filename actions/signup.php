<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
if (isset($_POST['submit_btn'])) {
	include '../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$psw = $_POST['psw'];
		$repsw = $_POST['repsw'];
		if ($psw == $repsw) {
			$gender = $_POST['gender'];
			$cont = $_POST['cont'];
			$street = $_POST['street'];
			$town = $_POST['town'];
			$city = $_POST['city'];
			$state = $_POST['state'];

			$sql1 = "INSERT INTO addresses (street_no, town, city, state) VALUES('".$street."','".$town."','".$city."','".$state."');";
			if (mysqli_query( $conn, $sql1)) {
				$sql2 = "INSERT INTO clients (firstname, lastname, email, password, gender, contact, add_id) VALUES('".ucwords($fname)."','".ucwords($lname)."','".$email."','".md5("Rex123".$psw."Rex123")."', '".ucwords($gender)."', '".$cont."',".mysqli_insert_id($conn).");";
				if (mysqli_query($conn, $sql2)) {
					$cid = mysqli_insert_id($conn);
					$cid = $cid * 6 + 1111;
					$salt = md5("Rex");
					$hash = $salt."|".$cid."|".$salt;
					// To send HTML mail, the Content-type header must be set
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html;';

					// Additional headers
					$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
					$url = "rex.esy.es/actions/activate-me.php?cid_hash=$hash";
					mail($email, "Activate Yourself | R.E.X", "Here is the activation url. Just hit it for your activation. <a href='$url'>Activate Me</a><br><br>If the above text doesn&apos;t seems like URL then copy this text and paste in address bar of browser&apos;s tab. $url <br><br>After that you can login easily.<br><br>This procedure is neccessary because of fraud and illegal access.", implode("\r\n", $headers));
					echo '{"firstName": "'.ucwords($fname).'", "lastName": "'.ucwords($lname).'"}';
					http_response_code(200);
				} else {
					echo mysqli_error($conn);
					http_response_code(501);
				}
			} else {
				echo mysqli_error($conn);
				http_response_code(500);
			}
		} else {
			echo mysqli_error($conn);
			http_response_code(502);
		}
	} else {
		echo mysqli_connect_error();
		http_response_code(400);
	}
	closeDB($conn);	
} else {
	http_response_code(401);
}
?>