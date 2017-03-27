<?php
	require "connect.php";
	$guardianUsername = $_POST['guardianUsername'];
	$childUsername = $_POST['childUsername'];
	$password = $_POST['password'];
	$name = $_POST['name'];

	$query = "SELECT * FROM users WHERE username = '$guardianUsername';";
	$result = mysqli_query($connect, $query);

	//Search for the guardian and get their email
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		$email = $row["email"];
	
	}
	else{
		echo json_encode(array("status" => "fail"));
		mysqli_close($connect);
	}

	//search if child already exists
	$query = "SELECT * FROM users WHERE BINARY username = '$childUsername';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		if($row["password"] == $password){
			$query = "INSERT INTO ".$guardianUsername." (username, name) VALUES ('$childUsername', '$name');";
			$result1 = mysqli_query($connect, $query);

			$query = "INSERT INTO ".$childUsername." (username) VALUES ('$guardianUsername');";
			$result2 = mysqli_query($connect, $query);
			if($result1 && $result2){
				echo json_encode(array("status" => "added"));
				mysqli_close($connect);
			}
			else{
				$query = "DELETE FROM ".$guardianUsername." where username = '$childUsername';";
				$result = mysqli_query($connect, $query);

				$query = "DELETE FROM ".$childUsername." where username = '$guardianUsername';";
				$result = mysqli_query($connect, $query);

				echo json_encode(array("status" => "fail"));
				mysqli_close($connect);
			}
		}
		else{
			echo json_encode(array("status" => "inuse"));
			mysqli_close($connect);
		}
	}
	else{
	
		$query = "INSERT INTO users (username, password, role, email) VALUES ('$childUsername', '$password', 'child', '$email');";
		$result = mysqli_query($connect, $query);

		if($result){
			
			$query = "INSERT INTO ".$guardianUsername." (username, name) VALUES ('$childUsername', '$name');";
			$result1 = mysqli_query($connect, $query);

			$query = "CREATE TABLE `$childUsername` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(45) NOT NULL DEFAULT `TEST`,
			`BeaconLatitude` DOUBLE NULL DEFAULT NULL,
			`BeaconLongitude` DOUBLE NULL DEFAULT NULL,
			`BeaconRadius` DOUBLE NULL DEFAULT NULL,
			PRIMARY KEY (`id`))";

			$result2 = mysqli_query($connect, $query);

			if($result1 && $result2){
				echo json_encode(array("status" => "success", "name" => ".$name.", "username" => ".$childUsername."));
				mysqli_close($connect);
			}
			else{
				mysqli_query($connect, "DELETE FROM users where username = '$childUsername'");
				echo json_encode(array("status" => "fail"));
				mysqli_close($connect);
			}

		} 
		else {
			$query = "DELETE FROM users where username = '$childUsername';";
			$result = mysqli_query($connect, $query);
    		echo json_encode(array("status" => "fail"));
			mysqli_close($connect);
		}
	}
	mysqli_close($connect);
?>
