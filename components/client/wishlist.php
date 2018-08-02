<div id="wishlist" class="tab-pane fade in">
	<h3>Properties, which you liked recently.</h3>
	<p>Here&apos;s the list of properties which you bookmarked for future use.</p>
	<p><a href="index.php?tab=wish"> <i class="fa fa-refresh"></i> Refresh</a> for recent Bookmarked Properties</p>
	<br>
	<?php 
		if ($conn) {
			$sql = "SELECT * FROM properties, clients, addresses, wishlist WHERE properties.pid=wishlist.pid AND properties.add_id=addresses.add_id AND properties.sid=clients.cid AND wishlist.cid=".$_SESSION['cid']." ORDER BY wishlist.time DESC";
			$result = mysqli_query($conn, $sql);
			showPropsWithResult($result, $conn, "wish");
		} else {
			echo "<div class='alert alert-danger fade in'>
				<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Error!</b> Can't Connect to Database
			</div>";
		}
	?>
</div>