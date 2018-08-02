<?php 
function showPropsWithResult($result, $conn, $which) {
	if ($result) {
		$num = mysqli_num_rows($result);
		if ($num > 0) {
			$lg = ceil($num/2);
			$count = $num;
			echo "<div class='row prop-posts-client-$which'>";
			if ($num > 1) {
				echo "<div class='col-md-6 st'></div>
				<div class='col-md-6 nd'></div>";
			} elseif ($which == "view") {
				echo "<div class='col-md-12 st'></div>";
			} else {
				echo "<div class='col-md-offset-3 col-md-6 st'></div>";
			}
			echo "</div>";
			for ($i=0; $i < $lg; $i++) {
				for ($j=1; $j <= 2 && $count != 0; $j++, $count--) { 
					$row = mysqli_fetch_assoc($result);

					$pid = $row['pid'];
					$fname = $row['firstname'];
					$lname = $row['lastname'];

					$sql3 = "SELECT amenity FROM property_amenities WHERE pid=$pid";
					$result3 = mysqli_query($conn, $sql3);

					$sql4 = "SELECT src FROM property_images WHERE pid=$pid";
					$result4 = mysqli_query($conn, $sql4);

					$str = "<div class='panel panel-primary panel-xs' id='prop-$pid'> <div class='panel-heading'> <h4><div class='user-dp user-dp-sm user-dp-inline";
					if ($which != "my") {
						$str .= " diggle";
					}
					$str .= "' style=\\\"background-image: url('".$row['src']."')\\\"";
					if ($which != "my") {
						$str .= " onclick=\\\"showSeller('".$fname."','".$lname."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Seller')\\\"";
					} else {
						$str .= " onclick=\\\"showImageModal('".$fname." ".$lname."', '".$row['src']."')\\\"";
					}
					$str .= "></div> ".$row['title'];
					if ($which == "my") {
						$str .= "<div class='pull-right dropdown'> <span class='dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-chevron-down fa-fw'></i> </span> <ul class='dropdown-menu'> <li class='dropdown-header'>Edit Posted Property</li> <li><a onclick=\\\"editProp('".$row['title']."', '".$row['type']."', '".$row['t_type']."', ".$row['price'].",".$row['d_price'].", ".$row['availability'].", ".$pid.")\\\"><i class='fa fa-fw fa-home'></i> Property</a></li> <li><a onclick=\\\"changeAddress('".$row['street_no']."', '".$row['town']."', '".$row['city']."', '".$row['state']."', ".$row['add_id'].", 'prop')\\\"><i class='fa fa-fw fa-map-signs'></i> Address</a></li> <li><a onclick=\\\"editPropFeatures(".$row['bhk'].",".$row['bathrooms'].",".$row['age'].",".$row['furnished'].",".$row['hospital'].",".$row['school'].",".$row['rail'].",".$row['area'].",".$row['l_area'].", ".$pid.")\\\"><i class='fa fa-fw fa-key'></i> Features</a></li> <li><a onclick=\\\"editPropInfo(";
						if ($result3 && mysqli_num_rows($result3) > 0) {
							$num_a_l_g = mysqli_num_rows($result3);
							$amen_arr = array();
							for ($a_l_g=0; $a_l_g < $num_a_l_g; $a_l_g++) { 
								array_push($amen_arr, mysqli_fetch_assoc($result3)['amenity']);
							}
							$str .= "'".implode(",", $amen_arr)."'";
						} else {
							$str .= "'NULL'";
						}
						if (empty($row['floor'])) {
							$row['floor'] = "'NULL'";
						}
						$str.=",".$row['units'].",".$row['floor'].",".$row['t_floors'].",'".$row['b_desc']."','".$row['tnc']."',".$pid.")\\\"><i class='fa fa-fw fa-info-circle'></i> Informations</a></li> <li><a onclick=\\\"showPropImages('";
						if ($result4 && mysqli_num_rows($result4) > 0) {
							$num_i_l_g = mysqli_num_rows($result4);
							$img_src_arr = array();
							for ($i_l_g=0; $i_l_g < $num_i_l_g; $i_l_g++) { 
								array_push($img_src_arr, mysqli_fetch_assoc($result4)['src']);
							}
							$str .= implode("-*-", $img_src_arr);
						}
						$str .="', '".$row['title']."', ".$pid.")\\\"><i class='fa fa-fw fa-picture-o'></i> Images</a></li> <li class='divider'></li> <li class='dropdown-header'>Delete Posted Property</li> <li><a onclick=\\\"deleteProp('".$row['title']."', ".$pid.")\\\"><i class='fa fa-fw fa-trash'></i> Remove Property</a></li> </ul> </div>";
					} elseif ($which == "view") {
						$str .= "<div class='pull-right close' data-dismiss='modal'><i class='fa fa-remove fa-fw'></i></div>";
					}
					$str .= "</h4> </div> <div class='panel-body'> <table class='table table-condensed table-striped'> <tr> <td><b>Property Type: </b></td> <td>".$row['type']."</td> <td><b>Transaction Type: </b></td> <td>".$row['t_type']."</td> </tr> </table> <div class='panel-group'> <div class='panel panel-info'> <div class='panel-heading' data-toggle='collapse' data-target='#addressAccordion$pid'> <h4 class='panel-title'><i class='fa fa-plus-square'></i> <b>Address</b></h4> </div> <div id='addressAccordion$pid' class='panel-collapse collapse'> <table class='table table-condensed table-striped'> <tr> <td><b>Street Number: </b></td> <td>".$row['street_no']."</td> <td><b>Town: </b></td> <td>".$row['town']."</td> </tr> <tr> <td><b>City: </b></td> <td>".$row['city']."</td> <td><b>State: </b></td> <td>".$row['state']."</td> </tr> </table> <!-- <div id='googleMap$pid' style='width:100%;height:400px'></div> --> </div> </div> </div> <div class='panel-group'> <div class='panel panel-info'> <div class='panel-heading' data-toggle='collapse' data-target='#featuresAccordion$pid'> <h4 class='panel-title'><i class='fa fa-plus-square'></i> <b>Features</b></h4> </div> <div id='featuresAccordion$pid' class='panel-collapse collapse'> <table class='table table-condensed table-striped'> <tr> <td><b>Bedrooms/BHK: </b></td> <td>".$row['bhk']."</td> <td><b>Bathrooms: </b></td> <td>".$row['bathrooms']."</td> </tr> <tr> <td><b>Construction Age: </b></td> <td>".$row['age']."</td> <td><b>Furnished: </b></td> <td>";
					if ($row['furnished'] == 1) {
						$str .= "Yes";
					} else {
						$str .= "No";
					}
					$str .= "</td> </tr> <tr> <td><b>Covered Area: </b></td> <td>".$row['area']." Sq-Ft</td> <td><b>Area of Land: </b></td> <td>".$row['l_area']." Sq-Ft</td> </tr> </table> </div> </div> </div> <div class='panel-group'> <div class='panel panel-info'> <div class='panel-heading' data-toggle='collapse' data-target='#infoAccordion$pid'> <h4 class='panel-title'><i class='fa fa-plus-square'></i> <b>More Information</b></h4> </div> <div id='infoAccordion$pid' class='panel-collapse collapse'> <table class='table table-condensed table-striped table-bordered'> <tr>";
					
					$result3 = mysqli_query($conn, $sql3);
					if ($result3 && mysqli_num_rows($result3) > 0) {
						$str .= "<td colspan='2'><b>Amenities:</b></td><td colspan='4'>";
						$a_num = mysqli_num_rows($result3);
						for ($a_i = 0; $a_i < $a_num; $a_i++) {
							$amen = mysqli_fetch_assoc($result3)['amenity'];
							$str .= "<code style='margin: 0px 5px;'>".$amen."</code>";
						}
						$str .= "</td></tr><tr>";
					}
					if ($row['floor'] != "NULL" && !empty($row['floor'])) {
						$str .= "<td><b>Available Units: </b></td> <td>".$row['units']."</td> <td><b>Floor Number: </b></td> <td>".$row['floor']."</td> <td><b>Total Floors: </b></td> <td>".$row['t_floors']."</td> </tr> <tr>";
					} else {
						$str .= "<td colspan='2'><b>Available Units: </b></td> <td>".$row['units']."</td> <td colspan='2'><b>Total Floors: </b></td> <td>".$row['t_floors']."</td> </tr> <tr>";
					}
					$str .= "<td colspan='6' class='text-center'><b>Distances from key facilities. </b></td> </tr> <tr> <td><b>Hospital: </b></td> <td>".$row['hospital']."</td> <td><b>School: </b></td> <td>".$row['school']."</td> <td><b>Railway Station: </b></td> <td>".$row['rail']."</td> </tr> <tr>";
					if ($row['b_desc'] != "NULL") {
						$str .= "<td colspan='2'><b>Brief Desciption: </b></td> <td colspan='4'>".$row['b_desc']."</td></tr><tr>";
					}
					if ($row['tnc'] != "NULL") {
						$str .= "<td colspan='2'><b>Terms and Condtions: </b></td> <td colspan='4'>".$row['tnc']."</td>";
					}
					$str .="</tr> </table> </div> </div> </div> <table class='table table-condensed'> <tr> <td><b>Price: </b></td> <td><span><i class='fa fa-rupee'></i></span> ";
					if ($row['d_price'] == 1) {
						$str .= $row['price'].".00";
					} else {
						$str .= "<a data-toggle='tooltip' data-placement='bottom' title='Ask Seller, for Price' onclick=\\\"showSeller('".$fname."','".$lname."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Seller')\\\"><s>999999.99</s></a>";
					}
					$str .= "</td> <td><b>Available: </b></td> <td>";
					if ($row['availability'] == 1) {
						$str .= "Yes";
					} else {
						$str .= "<a data-toggle='tooltip' data-placement='bottom' title='Ask Seller, for Availability' onclick=\\\"showSeller('".$fname."','".$lname."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Seller')\\\">No</a>";
					}
					$str .= "</td> </tr> <tr> </table>";
					$sql2 = "SELECT src FROM property_images WHERE pid=$pid";
					$result2 = mysqli_query($conn, $sql2);
					if ($result2) {
						$num_i = mysqli_num_rows($result2);
						if ($num_i > 0) {
							$str .= "<div class='row'>";
							$div = 12/$num_i;
							switch ($num_i) {
								case 1: case 3: 
									$div = 12/$num_i;
									break;
								case 2: case 4: 
									$div = 6;
									break;
								case 5: case 6: case 9:
									$div = 4;
									break;
								case 7: case 8: case 10: case 11: case 12:
									$div = 3;
									break;
								case 13: case 14:
									$div = 2;
									break;
								case 15: case 16:
									$div = 3;
									break;
								default:
									$div = 2;
									break;
							}
							for ($k=0; $k < $num_i; $k++) { 
								$src =  mysqli_fetch_assoc($result2)['src'];
								$str .= "<div class='col-md-".$div." col-sm-".$div." col-xs-".$div."'> <div class='buy-prop-image image-triggerer' style=\\\"background-image: url('".$src."')\\\" onclick=\\\"showImageModal('".$row['title']."', '".$src."');\\\"></div></div>";
							}
							if ($which == "buy" or $which == "wish") {
								$str .= "</div> <hr class='react'>";
								$sql_wid = "SELECT wid FROM wishlist WHERE pid=$pid AND cid=".$_SESSION['cid'];
								$result_wid = mysqli_query($conn, $sql_wid);
								if ($result_wid and $which != "wish") {
									$num_wid = mysqli_num_rows($result_wid);
									$str .= "<div class='prop-act'>	<button class='btn btn-";
									if ($num_wid == 0) {
										$str .= "info' onclick=\\\"asyncProcess('actions/client/props/like.php', ".$row['pid'].", likeSuccessBlock)\\\"> <i class='fa fa-heart-o'></i> Like";
									} else {
										$wid = mysqli_fetch_assoc($result_wid)['wid'];
										$str .= "danger' onclick=\\\"asyncProcess('actions/client/props/unlike.php', ".$wid.", unlikeSuccessBlock)\\\"> <i class='fa fa-heart'></i> Liked";
									}
									$str .= " </button> ";
								}
								if ($row['availability'] == 1) {
									$str .= "<button class='btn btn-success' data-toggle='modal' data-target='#buyPropModal'> <i class='fa fa-shopping-cart'></i> Buy </button> ";
								}
								$str .= "<button class='btn btn-primary' onclick=\\\"showSeller('".$fname."','".$lname."', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '".$row['src']."', 'Seller')\\\"> <i class='fa fa-envelope'></i> Mail Seller</button>";
								if ($result_wid and $which != "wish") {
									$str.= "</div>";
								}
							} else if ($which == "my") {
								$str .= "</div>";
								$sql_wid = "SELECT clients.firstname, clients.lastname FROM clients, wishlist WHERE wishlist.pid=$pid AND wishlist.cid=clients.cid ORDER BY wishlist.time DESC";
								$result_wid = mysqli_query($conn, $sql_wid);
								if ($result_wid) {
									$num_wid = mysqli_num_rows($result_wid);
									if ($num_wid > 0) {
										$str .= "<hr class='react'> <div class='prop-act'>";
										$first = mysqli_fetch_assoc($result_wid);
										$str .= "<a onclick=\\\"asyncProcess('actions/props/likers.php', $pid, showLikersSuccess);\\\">".$first['firstname']." ".$first['lastname']."</a>";
										if ($num_wid > 2) {
											$str .= " and <a onclick=\\\"asyncProcess('actions/props/likers.php', $pid, showLikersSuccess);\\\" data-toggle='tooltip' data-placement='auto' title='";
											$comma = false;
											for ($l=0; $l < $num_wid-1; $l++) {
												$liker_row = mysqli_fetch_assoc($result_wid);
												if ($comma) {
													$str .= ", ";
												}
												$comma = true;
												$str .= $liker_row['firstname']." ".$liker_row['lastname'];
											}
											$str .="'>".($num_wid-1)." others</a>";
										} elseif ($num_wid == 2) {
											$second = mysqli_fetch_assoc($result_wid);
											$str .= " and <a onclick=\\\"asyncProcess('actions/props/likers.php', $pid, showLikersSuccess);\\\">".$second['firstname']." ".$second['lastname']."</a>";
										}
										$str .= " like this</div>";
									}
								} else {
									echo mysqli_error($conn);
								}
							} else {
								$str .= "</div>";
							}

						}
					} else {
						echo mysqli_error($conn);
					}
					$str .= "</div> <div class='panel-footer'> <div> Posted on: ".date_format(date_create($row['time']),"<b>M jS, Y</b> \a\\t <b>g:i:s A</b>")."</div>";
					if (isset($row['edit']) and !empty($row['edit']) and $row['edit'] != "" and $row['edit'] != NULL) {
						$str .= "<hr class='slim'><div> Edited on: ".date_format(date_create($row['edit']),"<b>M jS, Y</b> \a\\t <b>g:i:s A</b>")."</div> </div> </div>";
					}
					echo "<script> var n;";
					if ($which == "buy" || $which == "search" || $which == "gallery") {
						echo "if ($('.prop-posts-client-$which > div.st').height() <= $('.prop-posts-client-$which > div.nd').height()) {
								n = 'st';
							} else {
								n = 'nd';
							}";
					} else {
						if ($j == 1) {
							echo "n = 'st';";
						} else {
							echo "n = 'nd';";
						}
					}
					echo "$('.prop-posts-client-$which > div.'+n).append(\"".$str."\");\n</script>";
					// if ($which != "search" and $which != "gallery") {
					// 	$coords = explode(",", $row['map']);
					// 	$GLOBALS['script'] .= "var myCenter$pid = new google.maps.LatLng(51.508742,-0.120850);
					// 	  var mapCanvas$pid = document.getElementById('googleMap$pid');
					// 	  var mapOptions$pid = {center: myCenter$pid, zoom: 5};
					// 	  var map$pid = new google.maps.Map(mapCanvas$pid, mapOptions$pid);
					// 	  var marker$pid = new google.maps.Marker({position:myCenter$pid});
					// 	  marker$pid.setMap(map$pid);";
					// }
				}
			}
		} else {
			echo "<div class='alert alert-danger fade in'>
					<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Oops!</b> Zero Properties are ";
			if ($which == "buy" or $which == "my" or $which == "gallery") {
				echo "present in our system<br> Try to <button class='btn btn-primary btn-sm' onclick=\"navTo('sell-property')\">Sell Property</button>";
			} else if ($which == "wish") {
				echo "liked by you, try to like some properties and then visit this section.";
			} else {
				echo "found with your need, try to change the city, property type or range in your search query, <a href='/'>Try again</a>";
			}
			echo "</div>";
		}
	} else {
		echo "<div class='alert alert-danger fade in'>
			<a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Error!</b> Can't Retrieve properties from database currently due to query error. ".mysqli_error($conn)."
		</div>";
	}
	// if ($which == "buy") {
	// 	echo "<script>function myMap1() { $vars }</script>";
	// 	echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCEq9Rz6ZI_LgkwBWA-2QT09nFhTBphPAU&callback=myMap1'></script>";
	// } else {
	// 	echo "<script>function myMap2() { $vars }</script>";
	// 	echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCEq9Rz6ZI_LgkwBWA-2QT09nFhTBphPAU&callback=myMap2'></script>";		
	// }
}
