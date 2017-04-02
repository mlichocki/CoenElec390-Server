<?php
	require "connect.php";

	$guardianUsername = $_POST['guardianUsername'];
	$childUsername = $_POST['childUsername'];
	$Blatitude = $_POST['Blatitude'];
	$Blongitude = $_POST['Blongitude'];
	$Bradius = $_POST['Bradius'];

	$query = "UPDATE `$childUsername` SET BeaconLatitude = '$Blatitude', BeaconLongitude = '$Blongitude', BeaconRadius = '$Bradius' WHERE username = '$guardianUsername';";
	$result = mysqli_query($connect, $query);

	if($result){
		echo json_encode(array("status" => "success"));
		mysqli_close($connect);
	
	}
	else{
		echo json_encode(array("status" => "fail"));
		mysqli_close($connect);
	}
	
	mysqli_close($connect);
?>