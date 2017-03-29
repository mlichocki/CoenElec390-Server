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
			
			if(($row["BeaconLatitude"] != null) && ($row["BeaconLongitude"] != null) && ($row["BeaconRadius"] != null)){ 
				$distancelat = $row["BeaconLatitude"] - $latitude;
				$distancelong = $row["BeaconLongitude"] - $longitude;
				$distance = sqrt(pow($distancelat,2) + pow($distancelong,2));
				if($distance <= $row["BeaconRadius"]){
					$notification = 5;
				}
				else{
					$notification = 0;
				}
			}
			else{
				$notification = 0;
			}
			
			$query = "UPDATE `$tablename` SET latitude = '$latitude', longitude = '$longitude', notification = '$notification' WHERE username = '$username';";
			$result2 = mysqli_query($connect, $query);
		}
						     
		mysqli_close($connect);
	}
	else{
	}

	mysqli_close($connect);

?>
