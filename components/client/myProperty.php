<div id="my-property" class="tab-pane fade in">
	<h3>Properties Posted by You. </h3>
	<?php 
		if ($conn) {
			$sql = "SELECT * FROM properties, clients, addresses WHERE properties.add_id=addresses.add_id AND properties.sid=clients.cid AND clients.cid=".$_SESSION['cid']."  ORDER BY properties.time DESC";
			$result = mysqli_query($conn, $sql);
			showPropsWithResult($result, $conn, "my");
		} else {
			echo "<div class='alert alert-danger fade in'>
				<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Error!</b> Can't Connect to Database
			</div>";
		}
	?>
</div>