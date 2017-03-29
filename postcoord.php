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
				/*$distanceToBeacon = ((($row["BeaconLatitude"] - $latitude)**2) + (($row["BeaconLongitude"] - $longitude)**2))**(1/2);
				if($distanceToBeacon <= $row["BeaconRadius"]){*/
					$notification = TRUE;
				/*}
				else{
					$notification = FALSE;
				}*/
			}
			else{
				$notification = FALSE;
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
