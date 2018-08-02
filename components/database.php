<?php
$GLOBALS['hostname'] = "mysql.hostinger.in";
$GLOBALS['dbusername'] = "u388783525_root";
$GLOBALS['dbpassword'] = "Raza12345";
$GLOBALS['dtbsname'] = "u388783525_rex";
// $GLOBALS['hostname'] = "localhost";
// $GLOBALS['dbusername'] = "root";
// $GLOBALS['dbpassword'] = "";
// $GLOBALS['dtbsname'] = "rex";
function connectDB() {
	return mysqli_connect($GLOBALS['hostname'], $GLOBALS['dbusername'], $GLOBALS['dbpassword'], $GLOBALS['dtbsname']);
}
function closeDB($conn) {
	return mysqli_close($conn);
}
?>