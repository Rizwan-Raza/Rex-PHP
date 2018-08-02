<?php
session_start();
if (isset($_POST['sell-submit'])) {
	include '../../../components/database.php';
	$conn = connectDB();
	if ($conn) {
		$target_dir = "uploads/props/";
		$total = count($_FILES['images']['name']);
		for ($i=0; $i < $total; $i++) { 
			$target_files[$i] = $target_dir."o_o".basename($_FILES["images"]["name"][$i]);
			$target_files[$i] = filter_var($target_files[$i], FILTER_SANITIZE_URL);
			$target_files[$i] = str_replace("'", "_", $target_files[$i]);
			// echo $target_files[$i];
		}
		$uploadOk = 1;
		$p_type = $_POST['p-type'];
		$t_type = $_POST['t-type'];
		$title = $_POST['title'];
		$street = $_POST['street'];
		$town = $_POST['town'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$bhk = $_POST['bhk'];
		$bath = $_POST['bath'];
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		} else {
			$age = 0;
		}
		$furnished = $_POST['furnished'];
		$p_area = $_POST['p-area'];
		$land = $_POST['land'];
		$price = $_POST['price'];
		$price_display = $_POST['price-display'];
		$available = $_POST['available'];
		$amens = $_POST['in-house'];
		$hosp = $_POST['h-dis'];
		$schl = $_POST['s-dis'];
		$rail = $_POST['r-dis'];
		$units = $_POST['units'];
		$floor = $_POST['floor'];
		// $lat = $_POST['lat'];
		// $long = $_POST['long'];
		$lat = 28.5465543; $long = 77.2998202;
		$t_floors = $_POST['t-floors'];
		$desc = $_POST['desc'];
		$tnc = $_POST['tnc'];
		if (empty($floor)) {
			$floor = "NULL";
		}
		if (empty($desc)) {
			$desc = "NULL";
		}
		if (empty($tnc)) {
			$tnc = "NULL";
		}
		$sql1 = "INSERT INTO addresses (street_no, town, city, state, map) VALUES('".$street."','".$town."','".$city."','".$state."', '@".$lat.",".$long.",18z');";
		if (mysqli_query( $conn, $sql1)) {
			$sql2 = "INSERT INTO properties (type, t_type, title, bhk, bathrooms, age, hospital, school, rail, furnished, area, l_area, price, d_price, availability, units, floor, t_floors, tnc, b_desc, add_id, sid) VALUES('$p_type','$t_type','$title',$bhk, $bath, $age, $hosp, $schl, $rail, ";
			if ($furnished == "yes") {
				$sql2 .= "1, ";
			} else {
				$sql2 .= "0, ";
			}
			$sql2 .= "$p_area, $land, $price, ";
			if ($price_display == "yes") {
				$sql2 .= "1, ";
			} else {
				$sql2 .= "0, ";
			}
			if ($available == "yes") {
				$sql2 .= "1, ";
			} else {
				$sql2 .= "0, ";
			}
			$sql2 .= "$units, $floor, $t_floors, '$tnc', '$desc', ";
			$sql2 .= mysqli_insert_id($conn).", ".$_SESSION['cid'].");";
			if (mysqli_query($conn, $sql2)) {
				$pid = mysqli_insert_id($conn);
				$error = false;
				for ($i=0; $i < $total; $i++) { 
					$target_files[$i] = str_replace("o_o", $pid."_", $target_files[$i]);
					if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], "../../../".$target_files[$i])) {
						$sql_image = "INSERT INTO property_images(pid, src) VALUES($pid, '".$target_files[$i]."')";
						if (!mysqli_query($conn, $sql_image)) {
							echo $target_files[$i];
							echo mysqli_error($conn);
							$error = true;
							// exit;
							// header("Location: ../../index.php?sell=error&type=query");
						}
					} else {
						echo $target_files[$i];
						$error = true;
						// exit;
						// header("Location: ../../index.php?upload=error&image=multi");
					}
				}
				if ($error) {
					// header("Location: /?post=error&type=image");
				} else {
					foreach ($amens as $amen) {
						switch ($amen) {
							case 'net':
								$amen = "Internet / Wi-Fi";
								break;
							case 'air':
								$amen = "Air-Conditioned";
								break;
							case 'ro':
								$amen = "RO Water System";
								break;
							case 'gas':
								$amen = "Gas Supply";
								break;
							case 'water':
								$amen = "Water Supply and Pipeling";
								break;
							
							default:
								$amen = "+1 Amenity";
								break;
						}
						if (!mysqli_query($conn, "INSERT INTO property_amenities (pid, amenity) VALUES ($pid, '$amen')")) {
							$error = true;
							echo mysqli_error($conn);
						}
					}
					if ($error) {
						header("Location: /?post=error&type=amen");
					} else {
						// echo "Done!!";
						// To send HTML mail, the Content-type header must be set
						$headers[] = 'MIME-Version: 1.0';
						$headers[] = 'Content-type: text/html;';

						// Additional headers
						$headers[] = 'From: Admin | R.E.X <admin@rex.esy.es>';
						mail($_SESSION['email'],  "Your Property Posted | R.E.X", 'Your property (<b>'.$title.'</b>) has been successfully posted to our system <b>R.E.X.</b>.<br><br>See more at <a href="http://rex.esy.es">http://rex.esy.es</a>.', implode("\r\n", $headers));
						header("Location: /?post=done");
					}
					// echo mysqli_error($conn);
				}
			} else {
				echo mysqli_error($conn);
				header("Location /?error=prop");
			}
		} else {
			header("Location /?error=addrs");
		}
		closeDB($conn);
	} else {
		header("Location /?error=conn");
		echo mysqli_connect_error();
		// http_response_code(400);
	}
} else {
	header("Location /?error=submittion");
}
?>