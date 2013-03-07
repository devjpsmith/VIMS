<?php 
function update()
{
	$sql  = "SELECT * FROM region";
	$sql .= " WHERE REG_ID > 99";
	$sql .= " ORDER BY REG_ID";
	
	return $sql;
}


function insertRegion($regionID, $regionName, $con)
{
	// clean inputs
	$regionName = mysqli_real_escape_string($con, $regionName);
	
	if(!is_numeric($regionID) || (strlen($$regionName) > 25)) 
		return "error";
	
	$sql  = "INSERT INTO region";
	$sql .= " (REG_ID, REG_Name)";
	$sql .= " VALUES(" . $regionID . ", '" . $regionName . "')";
}


function deleteRegion($regionID)
{
	$sql  = "DELETE FROM region WHERE REG_ID=" . $regionID;
	
	return $sql;
}
?>

	
