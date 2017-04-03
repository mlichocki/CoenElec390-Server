<?php
	
	$username = "coenelec390";
	$password = "Cn6BC?M?6x65";
	$host = "mysql4.gear.host";
	$dbname = "coenelec390$";
	$connect = mysqli_connect($host, $username, $password, $dbname);

	if(!$connect){
		echo ("CONNECTION TO SERVER FAILED!")
	}

?>
