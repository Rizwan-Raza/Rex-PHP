<div id="buy-property" class="tab-pane fade in active">
	<h3>Buy any following Property or <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#postRequirementModal">Post Requirement</button></h3>
	<?php 
		if ($conn) {
			$sql = "SELECT * FROM properties, clients, addresses WHERE properties.add_id=addresses.add_id AND properties.sid=clients.cid AND clients.cid<>".$_SESSION['cid']."  ORDER BY properties.time DESC";
			$result = mysqli_query($conn, $sql);
			showPropsWithResult($result, $conn, "buy");
		} else {
			echo "<div class='alert alert-danger fade in'>
				<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Error!</b> Can't Connect to Database
			</div>";
		}
	?>
</div>