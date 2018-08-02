<?php 
	include 'components/client/modals/login.html'; 
	include 'components/client/modals/authError.html';
	include 'components/client/modals/activeError.html';

	include 'components/admin/modals/login.html'; 
	include 'components/admin/modals/authError.html';
	echo '<div id="passwordChangedSnackbar">Password changed Successfully!</div>';
	
	include 'components/modals/signup.html'; 
	include 'components/modals/signupSuccess.html';
	include 'components/modals/forgotPassword.html'; 

	include 'components/modals/viewProp.html'; 

	include 'components/home/carousel.html'; 
?>

<div class="container-fluid">
	<div align="center">
		<br><br>
		<h3 style="font-weight: bold;">Featured Properties</h3>
		<br><br>
		<?php 
			include 'featProps.php';
		?>
	</div>
</div>


<div class="container-fluid">
	<div align="center">
		<br>
		<h3 style="font-weight: bold;">What Makes Us Preferred Choice</h3>
		<br><br>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="img-gallery">
				<img src="img/banner (3).jpg" class="img-responsive">
				<div class="ui-in-text">
					<h4>Expert Guidance</h4>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="img-gallery">
				<img src="img/banner (4).jpg" class="img-responsive">
				<div class="ui-in-text">
					<h4>Buyers Trust Us</h4>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="img-gallery">
				<img src="img/banner (2).jpg" class="img-responsive">
				<div class="ui-in-text">
					<h4>Seller Prefer Us</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
