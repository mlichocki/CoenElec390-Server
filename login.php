<?php

	require "connect.php";

	//Data entered in the application
	$username = $_POST['username'];
	$password = $_POST['password'];

	//Search through the users table for the associated username and password
	$query = "SELECT * FROM users WHERE BINARY username = '$username' AND BINARY password = '$password';";
	$result = mysqli_query($connect, $query);

	//If the user is found
	if(mysqli_num_rows($result) ==1){
		$row = mysqli_fetch_assoc($result);
		echo json_encode(array("role" => $row["role"], "guardian" => $row["guardian"]));
		mysqli_close($connect);

	}
	else{
		echo "Login unsuccessful";
		mysqli_close($connect);
	}

?>
