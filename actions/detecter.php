<?php
if (isset($_GET)) {
	$GLOBAL['refresh'] = false;
	echo "<script>$(document).ready(function(){";
	// if (isset($_GET['signup']) and $_GET['signup'] == "Done") {
	// 	// echo "<script>$('#signupSuccess .modal-info span').text(data); $('#signupSuccess').modal('show');</script>";
	// 	echo "alert('Hello');$('#myCarousel').css('display','none');";
	// }
	if (isset($_GET['activation']) and $_GET['activation'] == "done") {
		echo "snackbar('You are successfully activated for login.');";
		// echo "$('#clientMailedModal').modal('show');";
	}
	if (isset($_GET['mail']) and $_GET['mail'] == "done") {
		echo "showSnackbar('clientMailedSnackbar');";
		// echo "$('#clientMailedModal').modal('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "prop") {
		echo "$('.nav-tabs a[href=\"#posts\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "req") {
		echo "$('.nav-tabs a[href=\"#requires\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "sell") {
		echo "$('.nav-tabs a[href=\"#sell-property\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "buy") {
		echo "$('.nav-tabs a[href=\"#buy-property\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "my") {
		echo "$('.nav-tabs a[href=\"#my-property\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "wish") {
		echo "$('.nav-tabs a[href=\"#wishlist\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "fs_p") {
		echo "$('.nav-tabs a[href=\"#fs_prop\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "fs_c") {
		echo "$('.nav-tabs a[href=\"#fs_client\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "fs_a") {
		echo "$('.nav-tabs a[href=\"#fs_admin\"]').tab('show');";
	}
	if (isset($_GET['tab']) and $_GET['tab'] == "db_p") {
		echo "$('.nav-tabs a[href=\"#db_prop\"]').tab('show');";
	}
	if (isset($_GET['prop']) and $_GET['prop'] == "edited") {
		echo "showSnackbar('propEditedSnackbar');";
	}
	if (isset($_GET['prop']) and $_GET['prop'] == "added") {
		echo "showSnackbar('propImageAddedSnackbar');";
	}
	if (isset($_GET['req']) and $_GET['req'] == "edited") {
		echo "showSnackbar('requestEditedSnackbar');";
	}
	if (isset($_GET['req']) and $_GET['req'] == "error") {
		echo "showSnackbar('requestErrorSnackbar');";
	}
	if (isset($_GET['post']) and $_GET['post'] == "done") {
		echo "showSnackbar('propertyPostedSnackbar');";
	}
	if (isset($_GET['post_req']) and $_GET['post_req'] == "done") {
		echo "showSnackbar('postReqSnackbar');";
	}
	if (isset($_GET['replace']) and $_GET['replace'] == "done") {
		echo "snackbar('Property image has been replaced successfully');";
		if ($GLOBAL['refresh']) {
			echo "window.location.href = window.location.href;";
			$GLOBAL['refresh'] = false;
		}
	}
	if (isset($_GET['replace']) and $_GET['replace'] == "undone") {
		echo "snackbar('Can\'t replace property image, Try again.');";
	}
	if (isset($_GET['type']) and $_GET['type'] == "client") {
		if (isset($_GET['error']) and $_GET['error'] == "auth") {
			echo "$('#clientAuthErrorModal').modal('show');";
		}
		if (isset($_GET['error']) and $_GET['error'] == "picture") {
			echo "$('#clientEditErrorModal').modal('show');";
		}
		if (isset($_GET['active']) and $_GET['active'] == "false") {
			echo "$('#clientActiveErrorModal').modal('show');";
		}
		if (isset($_GET['edit']) and $_GET['edit'] == "true") {
			// echo "$('#clientUpdatedModal').modal('show');";
			echo "showSnackbar('clientUpdatedSnackbar');";
		}
		if (isset($_GET['password']) and $_GET['password'] == "changed") {
			echo "showSnackbar('passwordChangedSnackbar');";
		}
		if (isset($_GET['picture']) and $_GET['picture'] == "changed") {
			echo "showSnackbar('clientProfileEditedSnackbar');";
			// echo "$('#clientEditedModal').modal('show');";
		}
	}
	if (isset($_GET['type']) and $_GET['type'] == "admin") {
		if (isset($_GET['error']) and $_GET['error'] == "auth") {
			echo "$('#authErrorModal').modal('show');";
		}
		if (isset($_GET['error']) and $_GET['error'] == "delete") {
			// echo "$('#kickoutErrorModal').modal('show');";
			echo "showSnackbar('kickedoutErrorSnackbar');";
		}
		if (isset($_GET['error']) and $_GET['error'] == "edit") {
			echo "$('#clientEditErrorModal').modal('show');";
		}
		if (isset($_GET['error']) and $_GET['error'] == "picture") {
			echo "$('#clientEditErrorModal').modal('show');";
		}
		if (isset($_GET['edit']) and $_GET['edit'] == "true") {
			// echo "$('#adminUpdatedSnackbar').modal('show');";
			echo "showSnackbar('adminUpdatedSnackbar');";
		}
		if (isset($_GET['client']) and $_GET['client'] == "edited") {
			// echo "$('#clientEditedModal').modal('show');";
			echo "showSnackbar('clientEditedSnackbar');";
		}
		if (isset($_GET['password']) and $_GET['password'] == "changed") {
			echo "showSnackbar('passwordChangedSnackbar');";
			// echo "$('#passwordChangedModal').modal('show');";
		}
		if (isset($_GET['picture']) and $_GET['picture'] == "changed") {
			echo "showSnackbar('clientProfileEditedSnackbar');";
			// echo "$('#clientEditedModal').modal('show');";
		}
	}
	echo "});</script>";
}
?>