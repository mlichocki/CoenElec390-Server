<?php

	require "connect.php";

	$username = $_POST['username'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$query = "SELECT * FROM `$username`;";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$tablename = $row["username"];
			$query = "UPDATE `$tablename` SET latitude = '$latitude', longitude = '$longitude' WHERE username = '$username';";
			$result2 = mysqli_query($connect, $query);
		}
		mysqli_close($connect);
	}
	else{
	}

	mysqli_close($connect);

?>
