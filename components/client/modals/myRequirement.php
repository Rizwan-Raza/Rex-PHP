<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="myRequirementModal" role="dialog" which="my">
	    <div class="modal-dialog modal-xl">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-fw fa-user-circle"></i> My Property Requests</h4>
	        </div>
        	<div class="modal-body">
	        	<table class="table table-responsive table-hover table-bordered table-striped">
	        		<thead>
	        			<tr>
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
	        			// runkit_function_remove("connectDB");
	        			include 'components/database.php';
	        			// print_r($GLOBALS);
	        			// $conn = mysqli_connect($GLOBALS['hostname'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dtbsname']);
	        			$conn = connectDB();
	        			$sql = "SELECT * FROM post_requirement WHERE cid=".$_SESSION['cid'];
	        			$result = mysqli_query($conn, $sql);
	        			if ($result) {
	        				$num = mysqli_num_rows($result);
	        				echo "<h3>$num properties are requested by you.</h3>";
	        				for ($i=0; $i < $num; $i++) { 
	        					$row = mysqli_fetch_assoc($result);
								$pr_id = $row['pr_id'];
	        					echo "<tr id='for-my-req-".$pr_id."'>
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
									<td data-toggle='tooltip' title='".date_format(date_create($row['time']),"M jS, Y \a\\t g:i:s A")."'>".date_format(date_create($row['time']),"M jS, Y").
									"</td>
									<td>
										<button class='btn btn-primary btn-xs' onclick=\"editRequest('".$row['type']."', '".$row['city']."', '".$row['state']."', ".$row['bhk'].", ".$row['bath'].", ".$area[0].", ".$area[1].", ".$budget[0].", ".$budget[1].", ".$pr_id.", 'client')\">
											<i class='fa fa-wrench'></i> Edit
										</button>
										<button class='btn btn-danger btn-xs' onclick=\"deleteRequest($pr_id, 'client')\">
											<i class='fa fa-trash'></i> Delete
										</button>
									</td>
	        					</tr>";
	        				}
	        			}
	        			closeDB($conn);
	        			?>
	        		</tbody>
	        	</table>
	        </div>
	      </div>
	    </div>
	  </div> 
	</div>
</div>