<?php

require "connect.php";

	//Data entered in the application
	$username = $_POST["username"];

	$query = "select * from $username";
	$result = mysqli_query($connect, $query);

	if(mysqli_num_rows($result) > 0){

		$children = array();
		while($row = mysqli_fetch_assoc($result)){
			array_push($children,array("name"=>$row["name"], "username"=>$row["username"]));
		}
	}
	
	echo json_encode(array("children" => $children));

?>