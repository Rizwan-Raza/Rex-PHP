<div class="container">
	<!-- Modal -->
	  <div class="modal fade" tabindex="-1" id="postRequirementModal" role="dialog">
	    <div class="modal-dialog">

	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-fw fa-pencil"></i> Post Requirement</h4>
	        </div>
			<form class="form" action="actions/client/props/post-requirement.php" method="post" enctype="multipart/form-data">
		        <div class="modal-body">
					<p>Fill the below info for the property.</p>
					<fieldset>
						<legend>Basic Info.</legend>
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="p-type"><i class="fa fa-fw fa-home"></i> Looking For</label>
								<select class="form-control" name="p-type" required>
									<option value="Residential House">Residential House</option>
									<option value="Residential Plot">Residential Plot</option>
									<option value="Appartment">Appartment</option>
									<option value="Office">Office</option>
									<option value="Shop">Shop</option>
									<option value="Commercial">Commercial</option>
									<option value="Industrial Land">Industrial Land</option>
									<option value="Industrial Building">Industrial Building</option>
								</select>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Location:</legend>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="city"><i class="fa fa-fw fa-map-signs"></i> City</label>
								<input type="text" name="city" class="form-control" placeholder="Enter City" required>
							</div>
							<div class="col-md-6 form-group">
								<label for="state"><i class="fa fa-fw fa-map-signs"></i> State</label>
								<input type="text" name="state" class="form-control" placeholder="Enter State" required>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Features:</legend>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="bhk"><i class="fa fa-fw fa-bed"></i> Bedroom/BHK</label>
								<input type="number" name="bhk" class="form-control" placeholder="Enter BHK Number" required max="1000" min="1">
							</div>
							<div class="col-md-6 form-group">
								<label for="bath"><i class="fa fa-fw fa-bath"></i> Bathrooms</label>
								<input type="number" name="bath" class="form-control" placeholder="Enter Number of Bathrooms" required max="1000" min="1">
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Area and Price:</legend>
						<div class="row">
							<div class="col-md-12 form-group">
								<p>
									<label for="c-area"><i class="fa fa-fw fa-home"></i> Covered Area Range:</label>
									<input type="text" id="c-area" readonly class="range" name="c-area">
								</p>
								<div id="area-slider-range"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<p>
									<label for="budget"><i class="fa fa-fw fa-money"></i> Budget Range:</label>
									<input type="text" id="budget" readonly class="range" name="budget">
								</p>
								<div id="budget-slider-range"></div>
							</div>
						</div>
					</fieldset>
		        </div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" type="submit" name="req-submit" value="preq_submit_btn"><i class="fa fa-fw fa-check"></i> Post Requirement</button>
				</div>
			</form>
	      </div>
	    </div>
	  </div> 
	</div>
</div>