<?php
include('/var/www/html/API-reader/settings/mysql/settings-db.php');
$sql = "SELECT name FROM exchange "; 
$result = $conn->query($sql);
while ($row = $result->fetch_assoc())
	{
	$exchange = $row["name"];
	$sqlclean = "DELETE FROM `$exchange` WHERE `date` < ADDDATE(NOW(), INTERVAL -12 HOUR)";
	if ($conn->query($sqlclean) === TRUE) 
	{echo "SUCCESS. Cleaned old data from $exchange <br />\n";} 
	else 
	{echo "Error: " . $sqlclean . "<br>" . $conn->error;}
	}
$conn->close();
?>
