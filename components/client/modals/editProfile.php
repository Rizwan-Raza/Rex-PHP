<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="clientEditProfileModal" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-fw fa-pencil"></i> Edit Profile</h4>
	        </div>
	        <div class="modal-body">
	          <form role="form" action="actions/client/update.php" method="post">
				<label for="usrname"><i class="fa fa-fw fa-user-circle"></i> Username</label>
				<div class="row">
					<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="fname" required value="<?php echo $_SESSION['fname'] ?>">
					</div>
					<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="lname" value="<?php echo $_SESSION['lname'] ?>" required>
					</div>
				</div>
	            <div class="form-group row">
					<div class="col-md-3">
						<label for="gender"><i class="fa fa-fw <?php if ($_SESSION['gender'] == "Male") { ?>fa-mars<?php } else {?>fa-venus<?php } ?>" id="g_l_e"></i> Gender</label>
					</div>
					<div class="col-md-9">
						<label class="radio-inline">
							<input type="radio" name="gender" value="Male" required <?php if ($_SESSION['gender'] == "Male") {
			              	echo "checked";
							}?> onclick="$('#g_l_e').removeClass('fa-venus');$('#g_l_e').addClass('fa-mars');"> Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="Female" required <?php if ($_SESSION['gender'] == "Female") {
			              	echo "checked";
							}?> onclick="$('#g_l_e').removeClass('fa-mars');$('#g_l_e').addClass('fa-venus');"> Female
						</label>
					</div>
	            </div>
	            <div class="form-group">
	              <label for="cont"><i class="fa fa-fw fa-phone"></i> Contact Number</label>
	              <input type="text" class="form-control" name="cont" value="<?php echo $_SESSION['contact'] ?>" required>
	            </div>
	            <div class="form-group">
	              <label for="cont"><i class="fa fa-fw fa-map-marker"></i> Address</label>
	              <div class="row">
	              	<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="street" value="<?php echo $_SESSION['street_no'] ?>" required>
	              	</div>
	              	<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="town" value="<?php echo $_SESSION['town'] ?>" required>
	              	</div>
              	  </div>
	              <div class="row">
	              	<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="city" value="<?php echo $_SESSION['city'] ?>" required>
	              	</div>
	              	<div class="col-md-6 form-group">
						<input type="text" class="form-control" name="state" value="<?php echo $_SESSION['state'] ?>" required>
	              	</div>
	              </div>
	            </div>
	            <button type="submit" class="btn btn-default btn-success btn-block" name="submit_btn" value="clientEdit"><span class="fa fa-fw fa-check"></span> Submit</button>
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><i class="fa fa-fw fa-remove"></i> Cancel</button>
	          <p>Change <a data-dismiss="modal" data-toggle="modal" data-target="#changePasswordModal">Password?</a></p>
	        </div>
	      </div>
	    </div>
	  </div> 
	</div>
</div>
