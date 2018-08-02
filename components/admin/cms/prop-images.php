<div id="fs_prop" class="tab-pane fade in active fs-image">
	<h3>Posted properties images resides on Filesystem</h3>
	<br>
	<h4><span>0</span> out of <span>0</span> files are unnessary, <span>0.00</span> kilobytes can be cleaned</h4>
	<button class="btn btn-success" id="dirImgClr">Clean all the unnessary files</button>
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

		$srcs = glob("uploads/props/*.*");
		$num = 0;
		$ex = 0;
		$bytes = 0.00;
		$str = "<srcs>";
		// print_r(glob("uploads/props/*.*"));
		foreach ($srcs as $src) {
			$num++;
			$title = mysqli_fetch_assoc(mysqli_query($conn, "SELECT properties.title FROM properties, property_images WHERE property_images.src='$src' AND properties.pid=property_images.pid"))['title'];
			$error = empty($title);
	?>
			<tr>
				<td id="src-<?php echo md5($src) ?>"><?php echo $src; ?></td>
				<td style='position: relative;width: 45px;left: 4px;'><div class="user-dp user-dp-xs" style="background-image: url('<?php echo $src; ?>');" width='100%' height="100%" onclick="showImageModal('<?php if(!$error) echo $title; else {?>Not linked with any property<?php }?>', '<?php echo $src; ?>')"></div></td>
				<td <?php if($error) echo "class='text-center' ";?>><?php if(!$error)echo $title; else echo "<i class='fa fa-minus'></i>"; ?></td>
				<td>
				<?php 
					if ($error) {
						$str .= '<src>'.$src.'</src>';
						$ex++;
						$bytes += filesize($src);
				?>
					<button class="btn btn-sm btn-danger" onclick="deleteImageFile('<?php echo $src;?>', 'prop')"><i class="fa fa-trash"></i> Delete</button>
				<?php 
					} else {
				?>
					<button class="btn btn-sm btn-primary" onclick="replacePropImage('<?php echo $src ?>', '<?php echo $title ?>')"><i class="fa fa-edit"></i> Replace</button>
				<?php
					}
				?>
					<button class="btn btn-sm btn-warning" onclick="renameImage('<?php echo $src ?>', 'prop')"><i class="fa fa-edit"></i> Rename</button>
				</td>
			</tr>
	<?php
		}
		$str .= "</srcs>";
		closeDB($conn);
	?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	<?php echo '$("#fs_prop h4 span:nth-child(1)").text("'.$ex.'");
	$("#fs_prop h4 span:nth-child(2)").text("'.$num.'");
	$("#fs_prop h4 span:nth-child(3)").text("'.($bytes/1024).'");
	$("#fs_prop #dirImgClr").attr("onclick", "deleteAllFSImages(\''.$str.'\', \'prop\')");
	if ('.$ex.' == 0) $("#fs_prop #dirImgClr").addClass("disabled");';
	?>
</script>
