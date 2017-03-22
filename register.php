<?php

	require "connect.php";

	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	$query = "SELECT * FROM users WHERE BINARY username = '$username';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		echo json_encode(array("status" => "inuse"));
	}
	else{
		$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
		$result = mysqli_query($connect, $query);
		
		if($result){
			echo json_encode(array("status" => "success"));
		}
		else{
			echo json_encode(array("status" => "fail"));
		}
	}

	$connect->close();

?>
