<?php
	$whitelist = array(
	    '127.0.0.1',
	    '::1'
	);
	date_default_timezone_set("Asia/Dhaka");
	define("DB_NAME", "xl_software11"); 	 // Database name
	define("HOST", "localhost"); 			// Database host
	define("USER", "root"); 			   // Database username

	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	    define("PASS", "");  			 // Database password (empty for localhost)
	} else {
		define("PASS", "webdev@2022");
	}

	
?>
