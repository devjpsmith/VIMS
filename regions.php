<?php
	include_once "php/config.php";
	session_start();
	if(!verifyUser()) header("Location: index.php");
	$myCon = new Connection();
	$con = $myCon->connect();
	
	//if its a post back, update the database and go back to manage regions
	if(isset($_POST['submit']))
	{
		$sql = "";
		if('new' == $_POST['id'])
		{
			$sql = "INSERT INTO Region(REG_ID, REG_Name) VALUES ('$_POST[regionId]'	, '$_POST[region]')";
		}
		else
		{
			$sql = "UPDATE Region SET REG_Name = '$_POST[region]'";
			$sql .= "WHERE REG_ID = $_POST[id]";
		}
		echo $sql;
		mysqli_query($con, $sql);
		// header('Location: manageRegions.php');
	}
	
	//get the region's information
	
	$results = array('REG_ID' => 'new', 'REG_Name' => '');
	if('new' != $_GET['id'])
	{
		$sql = "SELECT * FROM Region WHERE REG_ID = $_GET[id]";
		$results = mysqli_fetch_assoc(mysqli_query($con, $sql));
	}
	
	//show the page
	createHead("regions.css");
	createHeader($_SESSION['userName']);
	createNav($_SESSION['userAuth']);
	echo "<div id='content'>\n";
	echo "<form method='post'>\n";
	echo "<input type='hidden' name='id' value='$results[REG_ID]'>\n";
	echo "<label for='regionId'>Region Number</label>\n";
	if('new' == $_GET['id']){ echo "<input type='number' id='regionId' >";}
	else echo "<input type='number' id='regionId' value='$results[REG_ID]' disabled>\n";
	echo "<label for='region'>Region: </label>\n";
	echo "<input type='text' name='region' value='$results[REG_Name]'>\n";
	echo "<input type='submit' name='submit' value='submit'>\n";
	echo "</div>";
	createFoot();
	mysqli_close($con);
?>