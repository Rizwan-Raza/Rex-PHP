<?php
session_start();
$target_file = $_GET['src'];
if (move_uploaded_file($_FILES["dp"]["tmp_name"], "../../../".$target_file)) {
	header("Location: /cms.php?replace=done");
} else {
	header("Location: /cms.php?replace=undone");
    // echo "Sorry, there was an error uploading your file.";
}
?>