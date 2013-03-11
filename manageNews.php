<?php 
	session_start();
	//error_reporting(0);
	include_once "php/config.php";
    $con = new Connection();
    $con = $con->connect();
    if (mysqli_errno($con)){
        
		echo "Connection to Database Failed.";
        
    }	//:: Program Variable Declarations
	//$userAuth   		= $_SESSION['userAuth'];
	$userName  		    =  "Tylor";//$_SESSION['userName'];
	//$venueID  		    = $_SESSION['venueId'];
	//$venueName  		= $_SESSION['venueName'];
	
	//:: Misc. c. Variables
	$error = " ";
	$css = "";
	$js = "";
	
	createHead($css, $js);
	createHeader($userName);
	
	echo '<div id="cont
	//:: Draws Content Blocks
	echo '<div id="content">';
	echo '<div class="headingDiv"><h2>Manage News</h2></div>';
		 
	echo '<div id="leftContent">';
	
	$p = $_GET['action'];

	switch($p){
		case "create":
			echo '<div id="subhead">';
			echo "<h3 class='center'><span class='yellow'>Create News Flash</span></h3>";
			echo '</div>';
			echo newNewsForm($con);

		break;
		
		case "modify":
			echo '<div id="subhead">';
			echo "<h3 class='center'><span class='yellow'>Modify News Flash</span></h3>";
			echo '</div>';
			echo modifyNewsForm($con);
		break;
		
		default:
			echo '<div class="center"><a href="manageNews.php?action=create" >'.IMG("new.gif", "Create a new News Article.").'</a></div>';
				drawNewsTable($con);
		break;
		
	}
	   
         
        
       
	echo '</div>';
	
	echo '<div id="rightContent">';
	//echo IMG("spotlights.jpg", "Spotlights");
	echo '</div>';
	
	echo "</div>"; //End of Content	
	
	

	

	
	createFoot();
	
	
//:: Start of Functions	
	function newNewsForm($con){
        $form  = '<div id="manageNews" >';
        $form .= '<form method="POST" action="manageNews.php">'."\n";
		$form .= '<label>Title:</label>';
		$form .= '<input type="text" value="" name="title" />'."\n";
		$form .= '<br /><br />';
		$form .= '<label>Date:</label>';
		$form .= '<input type="date" value="'.currTimeDate().'" name="newsDate" />';
		$form .= '<br /><br />';
		$form .= '<label on="regionName">Region:</label>';
		$form .= '<select><span>'.getRegionName($con).'</span></select>';
		$form .= '<br /><br />';
		$form .= '<label>Comments: </label>';
		$form .= '<textarea class="textarea">';
		$form .= '</textarea>';
		$form .= '<br /><br />';
		$form .= '<input type="submit" class="button" value="Submit" />';
		
		$form .= '</form>';
		$form .= '</div>';
		
		return $form;
	}
	
	function modifyNewsForm($con){
        $p = $_GET['id'];
		
		
		$defaults = array(getNews($con, "NEW_ID", $p), getNews($con, "NEW_Title", $p), getNews($con, "NEW_Date", $p), getNews($con, "NEW_Title", $p), getNews($con, "NEW_Content", $p));
		
		
		$form  = '<div id="manageNews" >';
        $form .= '<form method="POST" action="manageNews.php">'."\n";
		$form .= '<label>Title:</label>';
		$form .= '<input type="text" value="'.$defaults[1].'" name="title" />'."\n";
		$form .= '<br /><br />';
		
		$form .= '<label>Date:</label>';
		$form .= '<input type="date" value="'.$defaults[2].'" name="newsDate" />';
		$form .= '<br /><br />';
		
		$form .= '<label>Region:</label>';
		$form .= '<select><span></span></select>';
		$form .= '<br /><br />';
		
		$form .= '<label>Comments: </label>';
		$form .= '<textarea class="textarea">';
		$form .= $defaults[4];
		$form .= '</textarea>';
		$form .= '<br /><br />';
		
		$form .= '<input type="submit" class="button" value="Submit Changes" />';
		
		$form .= '</form>';
		$form .= '</div>';
		
		return $form;
	}
	
		
		/**
		 * Retrieves news data from the databse and prepares it for display within the
		 * Manage News page.
		 * @author Tylor Faoro
		 *
		 * @param object $con The database object
		 * @param string $column The desired column name from the DB (same column labels from DB)
		 * @param int    $p The integer ID number to ensure proper news article opened for modification
		 *
		 * @return mixed $results Results from the query to be used to modify current information within the DB
		*/
		function getNews($con, $column, $p){
	 	static $results = "";
		
		$sql = "SELECT * ";
		$sql .= "FROM news ";
		$sql .= "WHERE NEW_ID = ".$p;
		
		$column = mysqli_real_escape_string($con, $column);
		$query = mysqli_query($con, $sql);
		
		/*foreach($results as $value){
			echo $value[$results];	
		}*/
		while($data = mysqli_fetch_array($query)){
			$results = $data[$column];	
		}
		return $results;
	}
	
	/**
	 * Retrieves the Region name and Region ID from the database, places the Name value as an option within a Form Select
	 * element. Assigns the Region ID as the return value of the form select option element.
	 * @author Tylor Faoro
	 *
	 * @param Object $con The database connection object
	 * @return static mixed $data The options which can be selected from the Region select form element.
	*/
	function getRegionName($con){
		static $data;
		 
		$sql  = "SELECT * ";
		$sql .= "FROM region ";
		
		
		$query = mysqli_query($con, $sql);
		
		$results = array();

			while($row = mysqli_fetch_array($query)){
				$results[] = $row;
				if($row['REG_ID'] != 99){
					$data .= '<option value='.$row['REG_ID'].'>'.$row['REG_Name'].'</option>';
				}
				
			}
			return $data;
	
	}
	
	function getRegionNameByID($con, $id){
		
		
		$sql  = 'SELECT REG_Name ';
		$sql .= 'FROM region ';
		$sql .= 'WHERE REG_ID = '.$id.' ';
		
		$query = mysqli_query($con, $sql);
		
		while($data = mysqli_fetch_array($query)){
			echo $data['REG_Name'];
		}
	}
	

	
	function drawNewsTable($con){
		
		$sql = 'SELECT * ';
		$sql .= 'FROM news';
		//$sql .= '';
		//$sql .= 'WHERE '.$whereCond.' '.$operator.' '.$whereTestVal.' ';
		
		$query = mysqli_query($con, $sql);
		
		echo '<table class="tableCenter">';
		echo '<tr>';
		echo '<th>News Title</th>';
		echo '<th>News Date</th>';
		echo '<th>News Category</th>';
		echo '<th>News Region</th>';
		
		while($data = mysqli_fetch_array($query)){
			echo '<tr>';
			echo '<td>'.$data['NEW_Title'].'</td>';
			echo '<td>'.$data['NEW_Date'].'</td>';
			echo '<td>'.$data['NEW_Type'].'</td>';
			echo '<td>';
			echo getRegionNameByID($con, 101);
			echo '</td>';
			echo '<td class="hiddenEffects">';
			echo '<a href="manageNews.php?action=modify&id='.$data['NEW_ID'].'">'.IMG("edit.gif", "Edit the Entry").'</a>';
			echo '</td>';
			echo '</tr>';
		}
		
		echo '</table>';
			
	}

	
	/**
	 * Simply returns the current date and time
	 * 
	 * @return string $date A (Y/M/D H:M:S) datestring
	*/
	function currTimeDate(){
		
		$date = date('Y-m-d H:i:s');
		
		return $date;
		
	}
	
	

?>