<?php
// Include the mysql settings
include('..\settings\mysql\settings-db.php');
// Update all available coins from every exchange and write that into "coin"
// For now, its ok to have a dead coin on here because index will display an very old date
// if the coin gets not traded anymore. In future we should ask for new coins and throw out not needed.
$sqlask = "SELECT name FROM exchange";
$resultask = $conn->query($sqlask);
while ($row = $resultask->fetch_assoc())
	{	
	$ex = $row["name"];
	$sql = "SELECT coin FROM $ex"; 
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc())
		{
		$newcoin = $row["coin"];
		$sqlcoin = "INSERT IGNORE INTO coin SET coin = '$newcoin'"; 
		if ($conn->query($sqlcoin) === TRUE) {	
			echo "INSERTED $newcoin <br />";
		} else {
			echo "Error: " . $sqlcoin . "<br>" . $conn->error;
		}
		}	
	}
$conn->close();
?>