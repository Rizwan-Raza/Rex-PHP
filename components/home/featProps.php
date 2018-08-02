<?php
include 'components/database.php';
$conn = connectDB();
if ($conn) {
	$sql = "SELECT DISTINCT properties.pid, properties.title, properties.bhk, properties.price, property_images.src FROM properties, property_images WHERE property_images.pid=properties.pid LIMIT 4";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$num = mysqli_num_rows($result);
		for ($i=0; $i < $num; $i++) { 
			$row = mysqli_fetch_assoc($result);
			echo '<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="img-gallery" style="background-image: url(\''.$row['src'].'\')">
					<div class="ui-in-text">
						<h4>'.$row['title'].'</h4>
						<h5>'.$row['bhk'].' BHK FLAT</h5>
						<h6>at '.$row['price'].' Lacs/flat</h6>
						<center><button class="btn btn-primary" onclick="asyncProcess(\'actions/props/view.php\', '.$row['pid'].', viewPropSuccess)"><i class="fa fa-fw fa-eye"></i> View Property</button></center>
					</div>
				</div>
				<br>
			</div>';
		}
	} else {
		echo "<label class='alert alert-warning center-block text-center'>Can&apos;t get recent posts, Query Error - ".mysqli_error($conn)."</label>";
	}
} else {
	echo "<label class='alert alert-danger center-block text-center'>Can&apos;t Connect to Database, Connection Error: - ".mysqli_connect_error()."</label>";
}
?>