<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="showSellerModal" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-info-circle"></i> <span>Seller</span>&apos;s Information</h4>
	        </div>
	        <div class="modal-body">
	        	<div class="user-dp user-dp-lg pull-left image-triggerer" style="border-radius: 0px; background-image: url('uploads/user/temp.png');" onclick="showImageModal('Dummy User', 'uploads/user/temp.png')"></div>
	        	<div class="pull-left" style="margin: 10px 0px 0px 20px">
	        		<span><b>Name: </b><span id="name"></span></span><br>
	        		<span><b>Email: </b><span id="email"></span></span><br>
	        		<span><b>Gender: </b><span id="gender"></span></span><br>
	        		<span><b>Contact: </b><span id="contact"></span></span><br>
	        	</div>
	        	<div class="clearfix"></div>
	        	<br>
	        	<h4>Want to Mail the <span>Seller</span>? Go Ahead ...</h4>
	          <form role="form" onsubmit="return mailAction('actions/admin/clients/mail.php', this, 'seller')" method="post">
	             <div class="form-group" method="post">
	              <label for="from"><i class="fa fa-fw fa-envelope"></i> From</label>
	              <input type="text" class="form-control<?php if(isset($_SESSION['email'])){echo ' disabled';} ?>" name="from" <?php if(isset($_SESSION['email'])){echo 'disabled';} ?> required value="<?php echo @$_SESSION['email']?>" <?php if(isset($_SESSION['email'])){echo 'readonly';} ?>>
	            </div>
	             <div class="form-group">
	              <label for="to"><i class="fa fa-fw fa-envelope"></i> To</label>
	              <input type="text" class="form-control disabled" id="to" name="to" disabled required readonly>
	            </div>
	            <div class="form-group">
					<label for="msg"><i class="fa fa-fw fa-comment"></i> Message</label>
	            	<textarea placeholder="Enter your message" required class="form-control" rows="4" name="msg" autofocus></textarea>
	            </div>
	            <button type="submit" class="btn btn-default btn-success btn-block" name="submit_btn"><span class="fa fa-fw fa-send"></span> Send</button>
	          </form>
	        </div>
	      </div>
	    </div>
	  </div> 
	</div>
</div>
