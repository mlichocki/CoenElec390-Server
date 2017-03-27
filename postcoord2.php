<?php

	require "connect.php";

	$username = $_POST['username'];
	$guardian = $_POST['guardian'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$query = "SELECT * FROM `$username`;";
	$result = mysqli_query($connect, $query);

	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$query = "INSERT INTO $row["username"] (latitude, longitude) VALUES ($latitude, $longitude);";
			$result = mysqli_query($connect, $query);
		}
	}
	else{
	}

	mysqli_close($connect);

?>
