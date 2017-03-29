<?php

	require "connect.php";
	

	$guardianUsername = $_POST['guardianUsername'];
	$childUsername = $_POST['childUsername'];
	
	$query = "SELECT * FROM `$guardianUsername` WHERE BINARY username = '$childUsername';";
	$result = mysqli_query($connect, $query);
	//If the user is found
	if(mysqli_num_rows($result) ==1){
		$row = mysqli_fetch_assoc($result);
		echo json_encode(array("latitude" => $row["latitude"], "longitude" => $row["longitude"]));
		mysqli_close($connect);
	}
	else{
		echo "Login unsuccessful";
		mysqli_close($connect);
	}
?>