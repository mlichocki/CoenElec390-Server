<?php

	require "connect.php";

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$role = $_POST['role'];

	$query = "SELECT * FROM users WHERE username = '$username';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		echo json_encode(array("status" => "inuse"));
	}
	else{
		$query = "INSERT INTO users (username, password, role, email) VALUES ('$username', '$password', '$role', '$email');";
		$result = mysqli_query($connect, $query);
		
		if($result){
			
			$query = "CREATE TABLE `$username` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(45) NOT NULL,
			`name` TEXT(45) NOT NULL,
			`latitude` TEXT(45) NULL DEFAULT NULL,
			`longitude` TEXT(45) NULL DEFAULT NULL,
			`notification` TEXT(45) NULL DEFAULT NULL,
			PRIMARY KEY (`id`))";
			
			$result = mysqli_query($connect, $query);
			
			if($result){
    				echo json_encode(array("status" => "success"));
				mysqli_close($connect);
			}
			else{
				mysqli_query($connect, "DELETE FROM users where username = '$username'");
    				echo json_encode(array("status" => "fail"));
				mysqli_close($connect);
			}
		} 
		else {
			//mysqli_query($connect, "DELETE FROM users where username = '$username'");
    			echo json_encode(array("status" => "fail"));
			mysqli_close($connect);
		}
	}

	mysqli_close($connect);

?>
