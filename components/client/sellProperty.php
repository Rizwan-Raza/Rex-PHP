<div id="sell-property" class="tab-pane fade">
	<h3>Sell any Property</h3>
	<p>Fill the below info of the property.</p>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Freely Post Property</h4>
		</div>
		<form class="form" action="actions/client/props/sell-property.php" method="post" enctype="multipart/form-data">
			<div class="panel-body">
				<fieldset>
					<legend>Basic Info.</legend>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="p-type"><i class="fa fa-fw fa-home"></i> Property Type</label>
							<select class="form-control" name="p-type" required>
								<option value="Residential">Residential</option>
								<option value="Commercial">Commercial</option>
								<option value="Industrial">Industrial</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="t-type"><i class="fa fa-fw fa-home"></i> Transaction Type</label>
							<select class="form-control" name="t-type" required onchange="ageChecker()" id="t-type">
								<option value="New">New</option>
								<option value="Re-Sale">Re-Sale</option>
								<option value="Under Construction">Under Construction</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label class="control-label" for="title"><i class="fa fa-fw fa-home"></i> Property Title</label>
							<input type="text" name="title" class="form-control" placeholder="Enter Property Title" required>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Location:</legend>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="street"><i class="fa fa-fw fa-map-signs"></i> Street Number</label>
							<input type="text" name="street" class="form-control" placeholder="Enter Street Number" required>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="town"><i class="fa fa-fw fa-map-signs"></i> Town</label>
							<input type="text" name="town" class="form-control" placeholder="Enter Town Name" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="city"><i class="fa fa-fw fa-map-signs"></i> City</label>
							<input type="text" name="city" class="form-control" placeholder="Enter City" required>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="state"><i class="fa fa-fw fa-map-signs"></i> State</label>
							<input type="text" name="state" class="form-control" placeholder="Enter State" required>
						</div>
					</div>
					<div class="form-horizontal" style="width: 100%">
				    <!-- Map API 
				        <div class="form-group">
				            <label class="col-sm-2 control-label">Location:</label>

				            <div class="col-sm-10">
				                <input type="text" class="form-control" id="us3-address" />
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-sm-2 control-label">Radius:</label> 

				            <div class="col-sm-5">
				                <input type="text" class="form-control hidden" id="us3-radius" />
				            </div>
				        </div>
				        <div id="us3" style="width: 100%; height: 400px;"></div>
				        <div class="clearfix">&nbsp;</div>
				        <div class="m-t-small">
				            <label class="p-r-small col-sm-1 control-label">Lat.:</label>

				            <div class="col-sm-3">
				                <input type="text" class="form-control hidden" style="width: 110px" id="us3-lat" name="lat" />
				            </div>
				            <label class="p-r-small col-sm-2 control-label">Long.:</label>

				            <div class="col-sm-3">
				                <input type="text" class="form-control hidden" style="width: 110px" id="us3-lon" name="long" />
				            </div>
				        </div>
				        <div class="clearfix"></div>
				        <script>
					        // $("")
				            $('#us3').locationpicker({
				                location: {
				                    latitude: 28.56296442557279,
				                    longitude: 77.28902223432624
				                },
				                radius: 8,
				                inputBinding: {
				                    latitudeInput: $('#us3-lat'),
				                    longitudeInput: $('#us3-lon'),
				                    radiusInput: $('#us3-radius'),
				                    locationNameInput: $('#us3-address')
				                },
				                enableAutocomplete: true,
				                onchanged: function (currentLocation, radius, isMarkerDropped) {
				                    // Uncomment line below to show alert on each Location Changed event
				                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
				                }
				            });
				        </script>
				    </div>
				    Map API -->
				</fieldset>
				<fieldset>
					<legend>Features:</legend>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="bhk"><i class="fa fa-fw fa-bed"></i> Bedroom/BHK</label>
							<input type="number" name="bhk" class="form-control" placeholder="Enter BHK Number" required max="1000" min="1">
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="bath"><i class="fa fa-fw fa-bath"></i> Bathrooms</label>
							<input type="number" name="bath" class="form-control" placeholder="Enter Number of Bathrooms" required max="1000" min="1">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="age"><i class="fa fa-fw fa-home"></i> Age of Construction</label>
							<div class="input-group">
								<input type="number" name="age" class="form-control" placeholder="Enter Number of Years passed after Construction" required id="age" max="100" min="0">
								<span class="input-group-addon">Years</span>
							</div>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="furnished"><i class="fa fa-fw fa-home"></i> Furnished</label><br>
							<label class="control-label radio-inline">
								<input type="radio" name="furnished" value="yes" required> Yes 
							</label>
							<label class="control-label radio-inline">
								<input type="radio" name="furnished" value="no" required> No
							</label>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Area and Price:</legend>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="p-area"><i class="fa fa-fw fa-home"></i> Covered Area</label>
							<div class="input-group">
								<input type="number" name="p-area" class="form-control" placeholder="Enter Area Covered by Property" required step="100" max="1000000" min="100">
								<span class="input-group-addon">Sq-Ft.</span>
							</div>
						</div>
						<div class="col-md-6 form-group">
							<label class="control-label" for="land"><i class="fa fa-fw fa-home"></i> Land Area</label>
							<div class="input-group">
								<input type="number" name="land" class="form-control" placeholder="Enter Land Area" required step="100" max="1000000" min="100">
								<span class="input-group-addon">Sq-Ft.</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="control-label" for="price"><i class="fa fa-fw fa-money"></i> Total Price</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-rupee"></i></span>
								<input type="number" name="price" class="form-control" placeholder="Enter Price in Rupees" required step="100000" max="100000000" min="100000">
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						<div class="col-md-3 form-group">
							<label class="control-label" for="price-display"><i class="fa fa-fw fa-tag"></i> Display Price</label><br>
							<label class="control-label radio-inline">
								<input type="radio" name="price-display" value="yes" required> Yes 
							</label>
							<label class="control-label radio-inline">
								<input type="radio" name="price-display" value="no" required> No
							</label>
						</div>
						<div class="col-md-3 form-group">
							<label class="control-label" for="available"><i class="fa fa-fw fa-truck"></i> Available</label><br>
							<label class="control-label radio-inline">
								<input type="radio" name="available" value="yes" required> Yes 
							</label>
							<label class="control-label radio-inline">
								<input type="radio" name="available" value="no" required> No
							</label>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Amenities:</legend>
					<div class="row">
						<div class="col-md-12 form-group">
							<label class="control-label" for="desc"><i class="fa fa-fw fa-key"></i> In House</label>
							<br>
							<label class="control-label checkbox-inline">
								<input type="checkbox" name="in-house[]" value="net"> Internet / Wi-Fi
							</label>
							<label class="control-label checkbox-inline">
								<input type="checkbox" name="in-house[]" value="air"> Air-Conditioned
							</label>
							<label class="control-label checkbox-inline">
								<input type="checkbox" name="in-house[]" value="ro"> RO Water System
							</label>
							<label class="control-label checkbox-inline">
								<input type="checkbox" name="in-house[]" value="gas"> Gas Supply
							</label>
							<label class="control-label checkbox-inline">
								<input type="checkbox" name="in-house[]" value="water"> Water Supply and Pipeling
							</label>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Distance from Key Facility:</legend>
					<div class="row">
						<div class="col-md-4 form-group">
							<label class="control-label" for="h-dis"><i class="fa fa-fw fa-stethoscope"></i> Hospital</label>
							<div class="input-group">
								<input type="number" class="form-control" name="h-dis" placeholder="Distance from nearest Hospital in KMS" max="1000" min="0">
								<span class="input-group-addon">KMS</span>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="s-dis"><i class="fa fa-fw fa-mortar-board"></i> School</label>
							<div class="input-group">
								<input type="number" class="form-control" name="s-dis" placeholder="Distance from nearest School in KMS" max="1000" min="0">
								<span class="input-group-addon">KMS</span>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="r-dis"><i class="fa fa-fw fa-train"></i> Railway Station</label>
							<div class="input-group">
								<input type="number" class="form-control" name="r-dis" placeholder="Distance from nearest Railway Station in KMS" max="1000" min="0">
								<span class="input-group-addon">KMS</span>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Property Snapshot:</legend>
					<div class="row">
						<div class="col-md-4 form-group">
							<label class="control-label" for="units"><i class="fa fa-fw fa-building-o"></i> Available Units</label>
							<div class="input-group">
								<input type="number" name="units" class="form-control" placeholder="Enter Available Units" required max="1000" min="1">
								<span class="input-group-addon">Units.</span>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="floor"><i class="fa fa-fw fa-building-o"></i> Floor Number (0 for Ground, Optional)</label>
							<input type="number" name="floor" class="form-control" placeholder="Enter Floor Number" max="100" min="-3">
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="t-floor"><i class="fa fa-fw fa-building-o"></i> Total Floors</label>
							<input type="number" name="t-floors" class="form-control" placeholder="Enter Total Number of Floors" required max="100" min="1">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 form-group">
							<label class="control-label" for="desc"><i class="fa fa-fw fa-info-circle"></i> Brief Description (Optional)</label>
							<textarea name="desc" class="form-control" placeholder="Enter Breif Description of Property" rows="4"></textarea>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="tnc"><i class="fa fa-fw fa-info-circle"></i> Terms and Conditions (Optional)</label>
							<textarea name="tnc" class="form-control" placeholder="Enter Terms and Conditions of Property" rows="4"></textarea>
						</div>
						<div class="col-md-4 form-group">
							<label class="control-label" for="image"><i class="fa fa-fw fa-picture-o"></i> Property Images (at least 1) </label>
							<input type="file" name="images[]" accept="image/*" multiple id="s-p-images" onchange="readURLs(this)" required min="1" max="20">
							<div class="row insert-here">
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="panel-footer">
				<button class="btn btn-success btn-block" type="submit" name="sell-submit" value="sell_submit_btn">Post</button>
			</div>
		</form>
	</div>
</div>
