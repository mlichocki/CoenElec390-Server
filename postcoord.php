<?php

	require "connect.php";

	$username = $_POST['username'];
	$guardian = $_POST['guardian'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$query = "UPDATE `$guardian` SET latitude = '$latitude', longitude = '$longitude' WHERE username = '$username';";
	$result = mysqli_query($connect, $query);

	if($result){
		
	}
	else{
	}

	mysqli_close($connect);

?>
