<?php
// TODO -> Clean for southexchange /DASH   /USD   /TUSD  and naming 

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
$sqldel1 = "DELETE FROM $exchange WHERE `coin` REGEXP '^ETH_'";
$sqldel2 = "DELETE FROM $exchange WHERE `coin` REGEXP '^USD_'";
$sqldel3 = "DELETE FROM $exchange WHERE `coin` REGEXP '^CNY_'";
$sqldel4 = "DELETE FROM $exchange WHERE `coin` REGEXP '^EUR_'";
$sqldel5 = "DELETE FROM $exchange WHERE `coin` REGEXP '^JPY_'";
$sqldel6 = "DELETE FROM $exchange WHERE `coin` REGEXP '^RUB_'";
$sqldel7 = "UPDATE $exchange SET `coin` = SUBSTRING(coin,5) WHERE `coin` REGEXP '^BTC_'";
$sqldel8 = "DELETE FROM $exchange WHERE `coin` REGEXP '^USDT_'";
$sqldel9 = "DELETE FROM $exchange WHERE `coin` REGEXP '^XMR_'";




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
if ($conn->query($sqldel8) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND USDT from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}	
if ($conn->query($sqldel9) === TRUE) 
	{
		echo "SUCCESSFULLY CLEAND XMR from $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}	

	
if ($conn->query($sqldel7) === TRUE) 
	{
		echo "SUCCESSFULLY CHANGED NAMES in $exchange <br />";
	} 
	else 
	{
		echo "Error: " . $sqlwr . "<br>" . $conn->error;
	}	
$conn->close();