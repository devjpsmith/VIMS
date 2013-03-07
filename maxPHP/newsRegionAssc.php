 <?php
// ============================================================================
/*
 * createNewsRegionAssc.php
 * file contains library of functions for associating the tables 'news' and 'region'
 * in the 'vims' database
 * Programed by Maxwell Clyke March 2013
 * 
 * */
// ============================================================================
/*
 * List of functions & parameters
 * 
 * createNewsRegionAssc($newsID [int], $regID [int], $con)
 * readNewsRegionAssc($con)
 * updateNewsRegionAssc($fieldName, $value, $newsID, $regID, $con)
 * 
 * */

// ============================================================================
//								Functions
// ============================================================================
/** 
 *	createNewsRegionAssc() builds an sql statement that creates the associates between the news and the region 
 *	@param ($newsID, $regID)
 *
 *	@return $sql	string containing sql statement
 */ 
	
	function createNewsRegionAssc($newsID, $regID, $con){
		
		$sql  = "INSERT INTO News_Region_Assc";
		$sql .= "(News_NEW_ID, Region_REG_ID)"
		$sql .= "VALUES (";
		$sql .= " ".$newsID.", ";
		$sql .= " ".$regID." ";
		$sql .= ")"
		
		return $sql;
	}
	
	/** 
 *	createNewsRegionAssc() builds an sql statement that reads the associates between the news and the region 
 *	@param ()
 *
 *	@return $sql	string containing sql statement
 */ 
	function readNewsRegionAssc($con){
		
		$sql  = "SELECT *";
		$sql .= "FROM News_Region_Assc";
		$sql .= "LEFT JOIN News ON (News_NEW_ID = NEW_ID)";
		$sql .= "LEFT JOIN Region ON (Region_REG_ID = REG_ID)";
		
		return $sql;
	}
	
	/** 
 *	createNewsRegionAssc() builds an sql statement that updates the associates between the news and the region  
 *	@param ($fieldName, $value, $newsID, $regID,  $con)
 *
 *	@return $sql	string containing sql statement
 */ 
	function updateNewsRegionAssc($fieldName, $value, $newsID, $regID,  $con){
		
		$sql  = "UPDATE News_Region_Assc";
		$sql .= "SET '".$fieldName."' = '".$value."' ";
		$sql .= "WHERE News_NEW_ID = ".$newsID." ";
		$sql .= "AND Region_REG_ID = ".$regID." ";
		
		return $sql;
	}


?>