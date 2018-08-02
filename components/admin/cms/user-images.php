<div id="fs_<?php echo $type ?>" class="tab-pane fade fs-image">
	<h3>Registered <?php echo $type;?>s images resides on Filesystem</h3>
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

		$srcs = glob("uploads/users/".$type."s/*.*");
		$num = 0;
		$ex = 0;
		$bytes = 0.00;
		$str = "<srcs>";
		// print_r(glob("uploads/props/*.*"));
		foreach ($srcs as $src) {
			$num++;
			if ($type == "client") {
				$salt = "c";
			} else {
				$salt = "a";
			}
			$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT firstname, lastname, ".$salt."id FROM ".$type."s WHERE src='$src'"));
			$name = $data['firstname']." ".$data['lastname'];
			$id = $data[$salt."id"];
			$error = empty($data);			
	?>
			<tr>
				<td id="src-<?php echo md5($src) ?>"><?php echo $src; ?></td>
				<td style='position: relative;width: 45px;left: 4px;'><div class="user-dp user-dp-xs" style="background-image: url('<?php echo $src; ?>');" width='100%' height="100%" onclick="showImageModal('<?php if(!$error) echo $name; else {?>Not linked with any Client<?php }?>', '<?php echo $src; ?>')"></div></td>
				<td <?php if($error) echo "class='text-center' ";?>><?php if(!$error)echo $name; else echo "<i class='fa fa-minus'></i>"; ?></td>
				<td>
				<?php 
					if ($error) {
						$str .= '<src>'.$src.'</src>';
						$ex++;
						$bytes += filesize($src);
				?>
					<button class="btn btn-sm btn-danger" onclick="deleteImageFile('<?php echo $src;?>', '<?php echo $type ?>')"><i class="fa fa-trash"></i> Delete</button>
				<?php 
					} else {
						$id .= "&cms=".$type;
				?>
					<button class="btn btn-sm btn-primary" onclick="changePicture('<?php echo $src ?>', '<?php echo $name ?>', '<?php echo $id ?>')"><i class="fa fa-edit"></i> Replace</button>
				<?php
					}
				?>
					<button class="btn btn-sm btn-warning" onclick="renameImage('<?php echo $src ?>', '<?php echo $type ?>')"><i class="fa fa-edit"></i> Rename</button>
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
	<?php echo '$("#fs_'.$type.' h4 span:nth-child(1)").text("'.$ex.'");
	$("#fs_'.$type.' h4 span:nth-child(2)").text("'.$num.'");
	$("#fs_'.$type.' h4 span:nth-child(3)").text("'.($bytes/1024).'");
	$("#fs_'.$type.' #dirImgClr").attr("onclick", "deleteAllFSImages(\''.$str.'\', \''.$type.'\')");
	if ('.$ex.' == 0) $("#fs_'.$type.' #dirImgClr").addClass("disabled");';
	?>
</script>
