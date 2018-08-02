<?php
session_start();
$old_file = $_GET['old_dp'];
$target_dir = "uploads/users/".$_SESSION['log']."s/";
if ($_SESSION['log'] == "client") {
	$salt = $_SESSION['cid'];
} else {
	$salt = $_SESSION['aid'];
}
$target_file = $target_dir.$salt."_".basename($_FILES["dp"]["name"]);
$uploadOk = 1;
// if everything is ok, try to upload file
if (move_uploaded_file($_FILES["dp"]["tmp_name"], "../".$target_file)) {
	include '../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$sql1 = "UPDATE ".$_SESSION['log']."s SET src='$target_file' WHERE ";
		if ($_SESSION['log'] == "admin") {
			$sql1.= "a";
		} else {
			$sql1.= "c";
		}
		$sql1 .= "id=".$salt;
		$result = mysqli_query( $conn, $sql1);
		if ($result) {
			$_SESSION['dp_src'] = $target_file;
			if ($old_file != "uploads/users/temp.png") {
				if (unlink("../".$old_file)) {
			    	header("Location: /?type=".$_SESSION['log']."&picture=changed");
				}
			} else {
		    	header("Location: /?type=".$_SESSION['log']."&picture=changed");
			}
	    } else {
	    	echo "Error: ".mysqli_error($conn);
	    	// header("Location: ../index.php?type=".$_SESSION['log']."&error=picture&reason=insert");
	    }
		closeDB($conn);
	} else {
    	header("Location: /?type=".$_SESSION['log']."&error=picture&reason=db");
	}				    
// echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
	echo $target_file;
	header("Location: /?type=".$_SESSION['log']."&error=picture&reason=upload");
    // echo "Sorry, there was an error uploading your file.";
}
?>