<?php

	require "connect.php";

	$username = $_POST["username"];
	$password = $_POST["password"];
	$query = "insert into users (username, password) values ('$username', '$password');";

	if($connect->query($query) === TRUE){
		echo "Registration successful";
	}
	else{
		echo "Registration unsuccessful"
		//echo "Error: " . $query . "<br>" . $connect->error;
	}

	$connect->close();

?>