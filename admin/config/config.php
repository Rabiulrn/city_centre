<?php
	$whitelist = array(
	    '127.0.0.1',
	    '::1'
	);
	date_default_timezone_set("Asia/Dhaka");
	define("DB_NAME", "xl_software2"); //utf-8 die kora
	define("HOST", "localhost");
	define("USER", "root");

	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	    define("PASS", "");
	} else {
		define("PASS", "yeezy@002");
	}

	// http://27.147.195.221:8086/city_center1/admin/index.php
	// http://27.147.195.221:8086/phpmyadmin
?>
