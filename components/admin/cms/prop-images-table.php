<div id="db_prop" class="tab-pane fade db-image">
	<h3>Posted properties images resides on Database</h3>
	<br>
	<h4><span>0</span> out of <span>0</span> rows are unnessary</h4>
	<button class="btn btn-success" id="dbImgClr">Clean all the unnessary rows</button>
	<br>
	<br>
	<table class="table table-responsive table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Image</th>
				<th>For</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		$conn = connectDB();

		$ex = 0;
		$str = "<piids>";
		$sql = "SELECT property_images.src, properties.title, property_images.piid FROM property_images, properties WHERE property_images.pid=properties.pid";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
		// print_r(glob("uploads/props/*.*"));
		for ($i=0; $i < $num; $i++) { 
			$row = mysqli_fetch_assoc($result);
			$src = $row['src'];
			$title = $row['title'];
			$piid = $row['piid'];
			$error = !file_exists($src);
	?>
			<tr id="p_i_r_id-<?php echo $piid ?>">
				<td id="src-<?php echo md5($src) ?>"><?php echo $src; ?></td>
				<?php if(!$error) { ?>
					<td style='position: relative;width: 45px;left: 4px;'><div class="user-dp user-dp-xs" style="background-image: url('<?php echo $src; ?>');" width='100%' height="100%" onclick="showImageModal('<?php echo $title; ?>', '<?php echo $src; ?>')"></div></td>
				<?php
				} else { 
				?>
					<td class="text-center"><i class="fa fa-minus"></i></td>
				<?php
				}
				?>
				<td><?php echo $title; ?></td>
				<td>
				<?php 
					if ($error) {
						$str .= '<piid>'.$piid.'</piid>';
						$ex++;
				?>
					<button class="btn btn-sm btn-danger" onclick="deleteImageRow('<?php echo $piid; ?>')"><i class="fa fa-trash"></i> Delete</button>
				<?php 
					} else {
				?>
					<button class="btn btn-sm btn-warning" onclick="renameImage('<?php echo $src ?>', 'prop')"><i class="fa fa-edit"></i> Edit Source Text</button>
				<?php
					}
				?>
				</td>
			</tr>
	<?php
		}
		$str .= "</piids>";
		closeDB($conn);
	?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	<?php echo '$(".db-image h4 span:nth-child(1)").text("'.$ex.'");
	$(".db-image h4 span:nth-child(2)").text("'.$num.'");
	$(".db-image #dbImgClr").attr("onclick", "deleteAllImagesRows(\''.$str.'\')");
	if ('.$ex.' == 0) $(".db-image #dbImgClr").addClass("disabled");';
	?>
</script>
