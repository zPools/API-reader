<?php
// Include db settings and make a connection
include ('..\settings\mysql\settings-db.php');

$sql = "SELECT name FROM exchange "; 
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) 
	{$data[] = $row;}

//free memory associated with result
$result->close();

//close connection
$conn->close();

//now print the data
print json_encode($data);
?>		