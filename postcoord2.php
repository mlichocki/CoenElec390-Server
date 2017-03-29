<?php

	require "connect.php";

	$username = $_POST['username'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$query = "SELECT * FROM `$username`;";
	$result = mysqli_query($connect, $query);

	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$query = "UPDATE '"$row["username"]"' SET latitude = '$latitude', longitude = '$longitude' WHERE username = '$username';";
			$result = mysqli_query($connect, $query);
		}
		mysqli_close($connect);
	}
	else{
	}

	mysqli_close($connect);

?>
