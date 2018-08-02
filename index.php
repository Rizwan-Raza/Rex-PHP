<?php 
	session_start(); 
	function customError($errno, $errmsg, $errfile, $errline) {
		echo " ";
		error_log("Error: [$errno] $errmsg in $errfile at $errline",0);
		error_log("Error: [$errno] $errmsg in $errfile at $errline",1, "rizwan.raza987@gmail.com","From: Admin | R.E.X <admin@rex.esy.es>");
	}
	set_error_handler("customError", E_ALL);
	error_reporting(0)
?>
<!DOCTYPE html>
<html>
<head>
	<title>Real Estate eXplorer - REX</title>
	<?php include 'components/head.php'; ?>
</head>
<body>
	<?php
		include "actions/detecter.php";
		include "components/nav.php";
		include 'components/modals/image.html';	
		include 'components/modals/wait.html';	
		include 'components/modals/seller.php'; 

		if (isset($_SESSION['log'])) {
			// Common Modals, Snacks and Modules ...
			include 'components/modals/profilePicture.php'; 
			include 'components/modals/changePassword.html'; 
			include 'components/modals/logout.html';
			
			include 'components/snacks/common.html'; 
			
			include 'components/modals/props/edit.html'; 
			include 'components/modals/props/delete.html'; 
			include 'components/modals/props/changeFeatures.html'; 
			include 'components/modals/props/changeInfo.html'; 
			include 'components/modals/cnpChangeAddress.html'; 
			include 'components/admin/modals/props/images.html'; 
			include 'components/admin/modals/props/addImage.html'; 
			include 'components/admin/modals/props/removeImage.html'; 
			include 'components/modals/props/requestEdit.html'; 
			include 'components/modals/props/requestDelete.html'; 
			
			echo '<div class="seperator"></div>';

			if ($_SESSION['log'] == "client") {
				include "components/client/client.php";
				echo '<script type="text/javascript" src="js/client.js"></script>';
			} else {
				include "components/admin/admin.php";
				echo '<script type="text/javascript" src="js/admin.js"></script>';
			}

			echo '<script type="text/javascript" src="js/active.js"></script>';
		} else {
			include "components/home/home.php";
			echo '<script type="text/javascript" src="js/inactive.js"></script>';
		}
		include 'components/footer.html';
	?>
	<script type="text/javascript" src="js/common.js"></script>
</body>
</html>
