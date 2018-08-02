<?php 
session_start(); 
if ($_SESSION['log'] == "admin") {
?>
<!DOCTYPE html>
<html>
<head>
	<title>C.M.S | R.E.X</title>
	<?php include 'components/head.php'; ?>
</head>
<body>
<?php 
	include 'components/navHead.php';
	include 'actions/detecter.php';

	include 'components/modals/image.html';	
	include 'components/modals/files/confirm.html'; 
	include 'components/modals/tables/confirm.html'; 
	include 'components/modals/files/replace.html'; 
	include 'components/admin/modals/clients/changePicture.html';
	include 'components/admin/modals/cms-rename.html';
	include 'components/database.php';
?>
<br>
<div class="container" id="cms">
	<div class="alert alert-success text-center fade in">
		<a class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<label>Welcome to C.M.S Panel <?php echo $_SESSION['fname']; ?>! </label>
	</div>
	<ul class="nav nav-tabs nav-justified">
		<li class="active"><a data-toggle="tab" href="#fs_prop">Property Images</a></li>
		<li><a data-toggle="tab" href="#fs_client">Client Images</a></li>
		<li><a data-toggle="tab" href="#fs_admin">Admin Images</a></li>
		<li><a data-toggle="tab" href="#db_prop">Property Images Table</a></li>
	</ul>

	<div class="tab-content">
		<?php 
			include 'components/admin/cms/prop-images.php'; 
			$type = "client";
			include 'components/admin/cms/user-images.php'; 
			$type = "admin";
			include 'components/admin/cms/user-images.php'; 
			include 'components/admin/cms/prop-images-table.php'; 
		?>
	</div>
</div>
<?php
	include 'components/footer.html';
?>
<script type="text/javascript" src="js/cms.js"></script>
<script type="text/javascript" src="js/active.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</body>
</html>
<?php 
} else {
	header("Location: /");
}
?>