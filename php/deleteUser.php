<?php
	include_once "connection.php";
	$myCon = new Connection();
	$con = $myCon->connect();
	
	date_default_timezone_set('America/Edmonton');
	$date = date('Y-m-d H:i:s');
	
	$sql = "UPDATE Venue_User_Assc SET VUA_STATUS_CHG='$date', VUA_Sys_Status=0 ";
	$sql .= "WHERE User_USE_ID=$_POST[id] and Venue_VEN_ID=$_POST[venue];";
	
	echo mysqli_query($con, $sql);
	
	mysqli_close($con);
?>