<?php
$pid = $_POST['cid'];
include '../../components/database.php';
$conn = connectDB();
if ($conn) {
	$sql = "SELECT clients.firstname, clients.lastname, clients.src, clients.email, clients.gender, clients.contact, wishlist.time FROM clients, wishlist WHERE wishlist.pid=$pid AND wishlist.cid=clients.cid ORDER BY wishlist.time DESC";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$num = mysqli_num_rows($result);
		$str = "";
		for ($i=0; $i < $num; $i++) { 
			$row = mysqli_fetch_assoc($result);
			$fname = $row['firstname'];
			$lname = $row['lastname'];
			$src = $row['src'];
			$name = $fname." ".$lname;
			$str .= "<tr>";
			$str .= "<td class='f-o-f-dp up'><div class='user-dp user-dp-xs' style=\"background-image: url('$src')\" data-dismiss='modal' onclick=\"showSeller('$fname', '$lname', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '$src', 'Seller')\"></div></td>";
			$str .= "<td>$fname</td>";
			$str .= "<td>$lname</td>";
			$str .= "<td><a data-dismiss='modal' onclick=\"showSeller('$fname', '$lname', '".$row['email']."', '".$row['gender']."', '".$row['contact']."', '$src', 'Seller')\">".$row['email']."</a></td>";
			$str .= "<td>".$row['gender']."</td>";
			$str .= "<td>".$row['contact']."</td>";
			$str .= "<td>".date_format(date_create($row['time']),"<b>M jS, Y</b> \a\\t <b>g:i:s A</b>")."</td>";
			$str .= "</tr>";
		}
		echo $str;
		http_response_code(200);
	} else {
		// http_response_code(503);
	}
	closeDB($conn);
} else {
	http_response_code(400);
}
?>