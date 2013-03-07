

<?php
// ============================================================================
/*
 * NewsFunctions.php
 * file contains library of functions for interfacing with the table 'News'
 * in the 'vims' database
 * Programed by Maxwell Clyke March 2013
 * 
 * */
// ============================================================================
/*
 * List of functions & parameters
 * 
 * saveNews($NEWS_Date [Datetime], $NEWS_Comment [mediumtext], $NEWS_typs [tinyint])
 * updateNews()
 * deleteNews($NEWS_ID [int])
 * 
 * */

// ============================================================================
//								Functions
// ============================================================================
/** 
 *	readNews() builds an sql statement to present all records from the region table to the browser
 *	@param none
 *
 *	@return $sql	string containing sql statement
 */

function readNews()
{
	// build statement
	$sql  = "SELECT * FROM news";
	$sql .= "WHERE NEWS_ID > 1";
	$sql .= "ORDER BY NEWS_Date";

	return $sql;
}

// ============================================================================
/** 
 *	saveRegion() builds an sql statement to list insert the new region into the database
 *	@param $NEWS_Date		contains the News Date [datetime]
 *	@param $NEWS_Comment	contains the comments of the news [mediumtext]
 *	@param $NEWS_Type		contains the type of news (gov. or corp.) [tinyint]
 * 
 *	@return $sql	string containing sql statement
 */
function saveNews($NEWS_Date, $NEWS_Comment, $NEWS_Type, $con)
{
    // clean inputs
	$NewsDate  = mysqli_real_escape_string($con, $NEWS_Date);
    $NewsComment = mysqli_real_escape_string($con, $NEWS_Comment);
	$NewsType = mysqli_real_escape_string($con, $NEWS_type);
    
	// build statement
	$sql  = "INSERT INTO region (NEWS_Date, NEWS_Comment, NEWS_Type)";
	$sql .= "VALUES ('2013-03-06', 'This is the news', '1')";

	return $sql;
}

// ============================================================================
/** 
 *	deleteNews() builds an sql statement to delete the selected row assosciated with a choosen News Date
 *	@param $NEWS_Date contains News Date [datetime]
 * 
 *	@return $sql	string containing sql statement
 */

function deleteRegion($NEWS_Date)
{
	// build statement
	$sql  = "DELETE FROM news";
	$sql .= "WHERE NEWS_Date = 2013-03-06)";

	return $sql;
}