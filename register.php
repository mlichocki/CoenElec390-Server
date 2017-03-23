<?php

	require "connect.php";

	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$role = $_POST["role"];
	$guardian = $_POST["guardian"];

	$query = "SELECT * FROM users WHERE BINARY username = '$username';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		echo json_encode(array("status" => "inuse"));
	}
	else{
		$query = "INSERT INTO users (username, password, role, guardian, email) VALUES ('$username', '$password', '$role', '$guardian', '$email')";
		$result = mysqli_query($connect, $query);
		
		if($result){
			// sql to create table
			$query = "CREATE TABLE '$username' (
			`id` INT NOT NULL,
			`name` TEXT(45) NOT NULL,
			`username` VARCHAR(45) NOT NULL,
			`latitude` DOUBLE NULL DEFAULT NULL,
			`longitude` DOUBLE NULL DEFAULT NULL,
			PRIMARY KEY (`id`))"; 
			
			$result = mysqli_query($connect, $query);

			if ($result) {
    				echo json_encode(array("status" => "success"));
			} 
			else {
				mysqli_query($connect, "DELETE FROM users where username = '$username'");
    				echo json_encode(array("status" => "fail"))
			}
		}
		else{
			echo json_encode(array("status" => "fail"));
		}
	}

	$connect->close();

?>
