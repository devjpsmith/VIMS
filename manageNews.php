<?php 
	session_start();
	
	include_once "php/config.php";
	
	//:: Program Variable Declarations
	//$userAuth   		= $_SESSION['userAuth'];
	$userName  		    =  "Tylor";//$_SESSION['userName'];
	//$venueID  		    = $_SESSION['venueId'];
	//$venueName  		= $_SESSION['venueName'];
	
	//:: Misc. Variables
	$error = " ";
	$css = "";
	$js = "";
	
	createHead($css, $js);
	createHeader($userName);
	
	echo '<div id="content">';
	$p = $_GET['action'];
	
	switch($p){
		case page1:
		echo "something";
		break;
		
		case page2:
		echo "something2";
		break;
		
	}
	
	echo '</div>';
	
	createFoot();

?>