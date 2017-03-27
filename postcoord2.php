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
			$query = "UPDATE "$row["username"]" SET latitude = `$latitude`, longitude = `$longitude` WHERE username = '$username';";
			$result = mysqli_query($connect, $query);
			echo json_encode(array("role" => $row["username"]));
			mysqli_close($connect);
		}
	}
	else{
	}

	mysqli_close($connect);

?>
