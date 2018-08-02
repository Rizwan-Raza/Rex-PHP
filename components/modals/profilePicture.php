<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="profilePictureModal" role="dialog">
	    <div class="modal-dialog modal-sm">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-camera"></i> Profile Picture</h4>
	        </div>
			<form role="form" action="actions/profile.php?old_dp=<?php echo $_SESSION['dp_src']; ?>" method="post" enctype="multipart/form-data">
		        <div class="modal-body">
		        	<div class="user-dp user-dp-xl center-block image-triggerer" style="background-image: url('<?php echo $_SESSION['dp_src']; ?>');" onclick="showImageModal('<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>', '<?php echo $_SESSION['dp_src']; ?>')"></div>
		        	<br>
		            <div class="form-group">
		            	<input type="file" name="dp" id="dp" accept="image/*" onchange="readURL(this, '#profilePictureModal .user-dp-xl');">
		            </div>
				</div>
				<div class="modal-footer">
		            <button type="submit" class="btn btn-default btn-success btn-block" name="submit_btn" value="pictureEdit"><span class="fa fa-check"></span> Submit</button>
		        </div>
			</form>
	      </div>
	    </div>
	  </div> 
	</div>
</div>
