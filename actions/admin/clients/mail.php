<?php 
	session_start();
	$to = $_POST['to'];
	if (mail($to , "Admin Notice | R.E.X", "Here are some notice send by the Administrator of R.E.X. '<b><code>".$_POST['msg']."'</code></b><br>See more at <a href='http://rex.esy.es'>http://rex.esy.es</a>.", implode("\r\n", $headers))) {
		http_response_code(200);
	} else {
		http_response_code(503);
	}
?>