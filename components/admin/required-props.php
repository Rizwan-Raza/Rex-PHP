<div id="requires" class="tab-pane fade">
	<h3>Properties Requested by our clients</h3>
	<table class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th rowspan="2">Client</th>
				<th rowspan="2" title="Looking for | Property Type">Looking For</th>
				<th rowspan="2">City</th>
				<th rowspan="2">State</th>
				<th rowspan="2" title="BHK or Bedrooms">BHK</th>
				<th rowspan="2" title="Bathrooms">B. R.</th>
				<th colspan="2" class='compact-col'>Covered Area</th>
				<th colspan="2" class='compact-col'>Budget</th>
				<th rowspan="2">Requested On</th>
				<th rowspan="2">Actions</th>
			</tr>
			<tr>
				<th class='compact-col'>From</th>
				<th class='compact-col'>To</th>
				<th class='compact-col'>From</th>
				<th class='compact-col'>To</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$conn = connectDB();
			if ($conn) {
				$sql = "SELECT * FROM post_requirement, clients WHERE post_requirement.cid=clients.cid ORDER BY post_requirement.time DESC";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					$num = mysqli_num_rows($result);
					echo "<br><h4>Total number of requested properties is: <b id='request-num'>".$num."</b></h4>";
					for ($i=0; $i < $num; $i++) { 
						$row = mysqli_fetch_assoc($result);
						$pr_id = $row['pr_id'];
						echo "<tr id='for-req-".$pr_id."'>
								<td style='position: relative;width: 45px;left: 4px;'><div class='user-dp user-dp-xs' title='".$row['firstname']." ".$row['lastname']."' data-toggle='popover' data-trigger='hover' data-content='".$row['email']."' style=\"background-image: url('".$row['src']."')\" onclick=\"showSeller('".$row['firstname']."','".$row['lastname']."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Client')\"></div></td>
								<td>".$row['type']."</td>
								<td>".$row['city']."</td>
								<td>".$row['state']."</td>
								<td>".$row['bhk']."</td>
								<td>".$row['bath']."</td>";
								$area = explode("-", $row['area']);
								$budget = explode("-", $row['budget']);
								echo "<td>".$area[0]." Sq-Ft</td>
								<td>".$area[1]." Sq-Ft.</td>
								<td><i class='fa fa-rupee'></i> ".$budget[0]."</td>
								<td><i class='fa fa-rupee'></i> ".$budget[1]."</td>
								<td data-toggle='tooltip' title='".date_format(date_create($row['time']),"M jS, Y \a\\t g:i:s A")."'>".date_format(date_create($row['time']),"M jS, Y")."</td>
								<td>
									<button class='btn btn-primary btn-xs'' onclick=\"editRequest('".$row['type']."', '".$row['city']."', '".$row['state']."', ".$row['bhk'].", ".$row['bath'].", ".$area[0].", ".$area[1].", ".$budget[0].", ".$budget[1].", ".$pr_id.", 'admin')\">
										<i class='fa fa-wrench'></i> Edit
									</button>
									<button class='btn btn-danger btn-xs' onclick=\"deleteRequest($pr_id, 'admin')\">
										<i class='fa fa-trash'></i> Delete
									</button>
								</td>
							</tr>";
					}
				}
			}
			mysqli_close($conn);
		?>
		</tbody>
	</table>
</div>
