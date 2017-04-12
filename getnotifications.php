<?php
require "connect.php";

	//Data entered in the application
	$guardianUsername = $_POST["guardianUsername"];

	$query = "select * from $guardianUsername";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){
		$notifications = array();
		while($row = mysqli_fetch_assoc($result)){
			array_push($notifications,array("name"=>$row["name"], "notification"=>$row["notification"]));
			
			if($row["notification"] != 0){
				$query = "UPDATE `$guardianUsername` SET notification = 0;";
				$result2 = mysqli_query($connect, $query);
			}
		}
	}
	
	echo json_encode(array("notifications" => $notifications));
	mysqli_close($connect);
?>
