<?php

	require "connect.php";

	$username = $_POST['username'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$status = $_POST['status'];


	$query = "SELECT * FROM `$username`;";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$tablename = $row["username"];
			
			if(($row["BeaconLatitude"] != null) && ($row["BeaconLongitude"] != null) && ($row["BeaconRadius"] != null)){ 
				$distancelat = ($row["BeaconLatitude"] - $latitude)*1000*1000/9;
				$distancelong = ($row["BeaconLongitude"] - $longitude)*1000*1000*cos(2*M_PI*latitude/360)/9;
				$distance = sqrt(pow($distancelat,2) + pow($distancelong,2));
				
				$query = "SELECT * FROM `$tablename` WHERE BINARY username = '$username';";
				$result2 = mysqli_query($connect, $query);
				$row2 = mysqli_fetch_assoc($result2);
				
				$prevdistancelat = ($row["BeaconLatitude"] - $row2["latitude"])*1000*1000/9;
				$prevdistancelong = ($row["BeaconLongitude"] - $row2["longitude"])*1000*1000*cos(2*M_PI*latitude/360)/9;
				$prevdistance = sqrt(pow($prevdistancelat,2) + pow($prevdistancelong,2));
				
				if($distance <= $row["BeaconRadius"] && $prevdistance > $row["BeaconRadius"]){
					//notification: 2 indicates entering the beacon
					$notification = 2;
				}
				else if ($distance > $row["BeaconRadius"] && $prevdistance <= $row["BeaconRadius"]){
					//notification: 1 indicates left beacon
					$notification = 1;
				}
				else{
					$notification = 0;
				}
			}
			else{
				//notification: 0 indicates no notification
				$notification = 0;
			}
			
			if((strcmp($status, "DISCONNECTED") == 0) && ($notification < 20)){
				//notification: 3 indicated lost connection
				$notification = $notification + 10;
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
