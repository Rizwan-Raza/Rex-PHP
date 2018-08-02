<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="clientMailModal" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-fw fa-envelope"></i> Mail to Client</h4>
	        </div>
	        <div class="modal-body">
	          <!-- <form role="form" onsubmit="return signup(this)" method="post"> -->
	          <form role="form" onsubmit="return mailAction('actions/admin/clients/mail.php', this, 'client')" method="post">
	             <div class="form-group">
	              <label for="from"><i class="fa fa-fw fa-envelope"></i> From</label>
	              <input type="text" class="form-control disabled" name="from" disabled required value="<?php echo $_SESSION['email']?>" readonly>
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
