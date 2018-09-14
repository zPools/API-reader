<?php
// Include the mysql settings
include('..\settings\mysql\settings-db.php');
// Get the job out of the exchange out of the navigation
$exchange = $_REQUEST['ex'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Delete data from database "currently we only need btc price"	
$sqldel1 = "DELETE FROM $exchange WHERE coin LIKE 'ETH%'";
$sqldel2 = "DELETE FROM $exchange WHERE coin LIKE 'USD%'";
$sqldel3 = "DELETE FROM $exchange WHERE coin LIKE 'CNY%'";
$sqldel4 = "DELETE FROM $exchange WHERE coin LIKE 'EUR%'";
$sqldel5 = "DELETE FROM $exchange WHERE coin LIKE 'JPY%'";
$sqldel6 = "DELETE FROM $exchange WHERE coin LIKE 'RUB%'";



if ($conn->query($sqldel1) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND ETH from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
	
if ($conn->query($sqldel2) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND USD from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
	
if ($conn->query($sqldel3) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND CNY from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
if ($conn->query($sqldel4) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND EUR from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
if ($conn->query($sqldel5) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND JPY from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
if ($conn->query($sqldel6) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND RUB from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}
$conn->close();