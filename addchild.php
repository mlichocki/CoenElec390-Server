<?php
	require "connect.php";
	$guardianUsername = $_POST['username'];
	$childUsername = $_POST['password'];
	$password = $_POST['email'];

	$query = "SELECT * FROM users WHERE BINARY username = '$guardianUsername';";
	$result = mysqli_query($connect, $query);
	//If the user is found
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		//$email = $row["email"];
		echo json_encode(array("status" => $row["email"]));
		mysqli_close($connect);
	}
	else{
		echo json_encode(array("status" => "fail"));
				mysqli_close($connect);
	}
/*
	$query = "SELECT * FROM users WHERE BINARY username = '$username';";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		echo json_encode(array("status" => "inuse"));
		mysqli_close($connect);
	}
	else{

		$query = "INSERT INTO users (username, password, role, guardian, email) VALUES ('$childUsername', '$password', "child", '$guardianUsername', '$email');";
		$result = mysqli_query($connect, $query);

		if($result){

			$query = "INSERT INTO $guardianUsername (username, password, role, guardian, email) VALUES ('$childUsername', '$password', "child", '$guardianUsername', '$email');";
			$result = mysqli_query($connect, $query);

			if($result){
				echo json_encode(array("status" => "success"));
				mysqli_close($connect);
			}
			else{
				echo json_encode(array("status" => "fail"));
			mysqli_close($connect);
			}

		} 
		else {
    		echo json_encode(array("status" => "fail"));
			mysqli_close($connect);
		}
	}
	mysqli_close($connect);*/
?>
