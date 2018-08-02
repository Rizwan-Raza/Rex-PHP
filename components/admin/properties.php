<div id="posts" class="tab-pane fade">
	<h3>Properties posted by our clients</h3>
	<table class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Seller</th>
				<th>Title</th>
				<th title="Property Type">Type</th>
				<th>Transaction Type</th>
				<th title="Property Address">Adds.</th>
				<th title="Property Features">Feat.</th>
				<th>Price</th>
				<th title="Display Price">D. Price</th>
				<th title="Availability">Avail</th>
				<th title="Property Information">Info</th>
				<th title="Property Images">Images</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$conn = connectDB();
			if ($conn) {
				$sql = "SELECT * FROM properties, clients, addresses WHERE properties.add_id=addresses.add_id AND properties.sid=clients.cid ORDER BY properties.time DESC";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					$num = mysqli_num_rows($result);
					echo "<br><h4>Total number of properties is: <b id='post-num'>".$num."</b></h4>";
					for ($i=0; $i < $num; $i++) { 
						$row = mysqli_fetch_assoc($result);
						$pid = $row['pid'];
						echo "<tr id='for-prop-".$pid."'>
								<td style='position: relative;width: 45px;left: 4px;'><div class='user-dp user-dp-xs' title='".$row['firstname']." ".$row['lastname']."' data-toggle='popover' data-trigger='hover' data-content='".$row['email']."' style=\"background-image: url('".$row['src']."')\" onclick=\"showSeller('".$row['firstname']."','".$row['lastname']."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Seller')\"></div></td>
								<td>".$row['title']."</td>
								<td>".$row['type']."</td>
								<td>".$row['t_type']."</td>
								<td class='text-center'><a onclick=\"showPropAddress('".$row['street_no']."','".$row['town']."', '".$row['city']."', '".$row['state']."', ".$row['add_id'].")\">
									<i class='fa fa-map-signs'></i>
								</td>
								<td class='text-center'><a onclick=\"showPropFeatures('".$row['bhk']."','".$row['bathrooms']."', '".$row['age']."', '".$row['furnished']."', '".$row['area']."', '".$row['l_area']."', ".$row['hospital'].", ".$row['school'].", ".$row['rail'].", ".$pid.")\">
									<i class='fa fa-key'></i>
								</td>
								<td><span><i class='fa fa-rupee'></i></span> ".$row['price'].".00</td>
								<td class='text-center'><i class='fa fa-";
						if ($row['d_price'] == 1) {
							echo "check text-success";
						} else {
							echo "remove text-danger";
						}
						echo "'></i></td>
								<td class='text-center'><i class='fa fa-";
						if ($row['availability'] == 1) {
							echo "check text-success";
						} else {
							echo "remove text-danger";
						}
						$sql_4_amens = "SELECT amenity FROM property_amenities WHERE pid=$pid";
						$result_amn = mysqli_query($conn, $sql_4_amens);
						$string = "[";
						if ($result_amn) {
							$num_of_amn = mysqli_num_rows($result_amn);
							if ($num_of_amn > 0) {
								$string .= "'".mysqli_fetch_assoc($result_amn)['amenity']."'";
								for ($a_i=1; $a_i < $num_of_amn; $a_i++) { 
									$string .= ", '".mysqli_fetch_assoc($result_amn)['amenity']."'";
								}
								$string .= "]";
							} else {
								$string = "'NULL'";
							}
						} else {
							$string = "'NULL'";
						}
						if ($row['floor'] == "" or empty($row['floor']) or $row['floor'] == "NULL") {
							$row['floor'] = "'-*-'";
						}
						echo "'></i></td>
								<td class='text-center'><a onclick=\"showPropInfo($string,".$row['units'].",".$row['floor'].",".$row['t_floors'].",'".$row['b_desc']."','".$row['tnc']."','".date_format(date_create($row['time']),"<b>M jS, Y</b> \a\\t <b>g:i:s A</b>")."', '";
								if ($row['edit'] != NULL && $row['edit'] != "NULL" && !empty($row['edit'])) {
									echo date_format(date_create($row['edit']),"<b>M jS, Y</b> \a\\t <b>g:i:s A</b>");
								} else {
									echo "Not Edited Yet";
									// echo "<span class='bg-warning text-warning'>Not Edited Yet</span>";
								}
								echo "', $pid)\">
									<i class='fa fa-info-circle'></i>
								</td>
								<td class='text-center'><a onclick=\"showPropImages('";
								$sql_4_image = "SELECT src FROM property_images WHERE pid=".$pid;
								$result_img = mysqli_query($conn, $sql_4_image);
								if ($result_img) {
									$num_of_img = mysqli_num_rows($result_img);
									$srcs = "";
									for ($j=0; $j < $num_of_img - 1; $j++) { 
										$i_r = mysqli_fetch_assoc($result_img);
										$srcs .= $i_r['src'] ."-*-";
									}
									$i_r = mysqli_fetch_assoc($result_img);
									$srcs .= $i_r['src'];
									echo $srcs;
								}
								echo "', '".$row['title']."', $pid)\">
									<i class='fa fa-picture-o'></i>
								</td>
								<td>
									<button class='btn btn-primary btn-xs' onclick=\"editProp('".$row['title']."', '".$row['type']."', '".$row['t_type']."', ".$row['price'].",".$row['d_price'].", ".$row['availability'].", ".$pid.")\">
										<i class='fa fa-wrench'></i> Edit
									</button>
									<button class='btn btn-danger btn-xs' onclick=\"deleteProp('".$row['title']."', ".$pid.")\">
										<i class='fa fa-trash'></i> Delete
									</button>";
								echo "</td>
							</tr>";
					}
				}
			}
			mysqli_close($conn);
		?>
		</tbody>
	</table>
</div>
