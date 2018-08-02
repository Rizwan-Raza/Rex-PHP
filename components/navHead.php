<?php
	include 'components/nav.php';
	include 'components/modals/seller.php'; 
	echo '<div class="seperator"></div>';
	if (isset($_SESSION['log'])) {
		include 'components/modals/profilePicture.php'; 
		include 'components/modals/changePassword.html'; 
		include 'components/modals/logout.html';
		include 'components/snacks/common.html'; 
		if ($_SESSION['log'] == "admin") {
			include 'components/admin/snacks/me.html';
			include 'components/admin/modals/editProfile.php'; 
			include 'components/errorSnacks.html';
		} else {
			include 'components/client/modals/editProfile.php'; 
		}
	} else {
		include 'components/client/modals/login.html'; 
		include 'components/client/modals/authError.html';
		include 'components/client/modals/activeError.html';

		include 'components/admin/modals/login.html'; 
		include 'components/admin/modals/authError.html';
		echo '<div id="passwordChangedSnackbar">Password changed Successfully!</div>';
		
		include 'components/modals/signup.html'; 
		include 'components/modals/signupSuccess.html';
		include 'components/modals/forgotPassword.html'; 
	}
?>