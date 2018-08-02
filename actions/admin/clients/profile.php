<?php
session_start();
$old_file = $_GET['old_dp'];
$cid = $_GET['cid'];
$type = "client";
$salt = "c";
if (isset($_GET['cms'])) {
	$type = $_GET['cms'];
	if ($_GET['cms'] == "admin") {
		$salt = "a";
	}
}
$target_dir = "uploads/users/".$type."s/";
$target_file = $target_dir.$cid."_".basename($_FILES["dp"]["name"]);
$target_file = filter_var($target_file, FILTER_SANITIZE_URL);
$target_file = str_replace("'", "_", $target_file);

$uploadOk = 1;
// if everything is ok, try to upload file
if (move_uploaded_file($_FILES["dp"]["tmp_name"], "../../../".$target_file)) {
	include '../../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$sql1 = "UPDATE ".$type."s SET src='$target_file' WHERE ".$salt."id=$cid";
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			if ($old_file != "uploads/users/temp.png") {
				unlink("../../../".$old_file);
			}
			$email_query = "SELECT email FROM ".$type."s WHERE ".$salt."id=$cid";
			$result_email = mysqli_query($conn, $email_query);
			if ($result_email) {
				$data = mysqli_fetch_assoc($result_email)['email'];
			// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html;';

				// Additional headers
				$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
				mail($data,  "Profile Picture | R.E.X", 'Your account\'s (<b>'.$data.'</b>) profile picture has been changed by the administrator of our system <b>R.E.X.</b> due to any reasonable issue.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
			}
			if (isset($_GET['cms'])) {
		    	header("Location: /images.php?type=".$type);
			} else {
		    	header("Location: /?type=admin&picture=changed");
			}
	    } else {
	    	header("Location: /?type=client&error=picture&reason=insert");
	    	// echo "Error: ".mysqli_error($conn);
	    }
		closeDB($conn);
	} else {
    	header("Location: /?type=client&error=picture&reason=db");
	}				    
	// echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
	echo $target_file;
	header("Location: /?type=client&error=picture&reason=upload");
    // echo "Sorry, there was an error uploading your file.";
}
?>