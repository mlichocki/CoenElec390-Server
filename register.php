<?php

	require "connect.php";

	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	$guardian = $_POST['guardian'];

	$query = "SELECT * FROM users WHERE BINARY username = '$username';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		echo json_encode(array("status" => "inuse"));
	}
	else{
		$query = "INSERT INTO users (username, password, role, guardian, email) VALUES ('$username', '$password', '$role', '$guardian', '$email');";
		$result = mysqli_query($connect, $query);
		
		if($result){
			
			$query = "CREATE TABLE `$username` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(45) NOT NULL,
			`name` TEXT(45) NOT NULL,
			`latitude` DOUBLE NULL DEFAULT NULL,
			`longitude` DOUBLE NULL DEFAULT NULL,
			`Blongitude` DOUBLE NULL DEFAULT NULL,
			`Blatitude` DOUBLE NULL DEFAULT NULL,
			`Blatitude` DOUBLE NULL DEFAULT NULL,
			`Bradius` DOUBLE NULL DEFAULT NULL,
			`notification` DOUBLE NULL DEFAULT NULL,
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
