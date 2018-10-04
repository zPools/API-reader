<?php
// Include the mysql settings
include('../settings/mysql/settings-db.php');
// Get the job out of the navigation (exchange.php?ex=crex&coin=XYZ&price=0.1234567890&usd=0.123123123)
$exchange = $_REQUEST['ex'];
$coinsname = $_REQUEST['coin'];
$price1 = $_REQUEST['price'];
$priceUSD = $_REQUEST['usd'];
// Read the current pull id...
$sqlread = "SELECT pull FROM $exchange Order By pull DESC LIMIT 1";
$read = $conn->query($sqlread);
while ($row = $read->fetch_assoc())
	{
	$lastpull = $row["pull"];
	}
// ... and add 1
$update = $lastpull + 1;

// Set timezone and set variable date with current date
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');

// Write data into database "pull id, "coin", "price in btc", "price in usd" and "date"	
$sqlwr = "INSERT INTO $exchange (pull, coin, price_btc, price_usd, date)
VALUES ('$update', '$coinsname', '$price1', '$priceUSD', '$date')";
// Echo if success or throw error
if ($conn->query($sqlwr) === TRUE) 
	{
	echo " SUCCESS <br /> \n Exchange : $exchange <br />\n ID: $update <br />\n COIN -> $coinsname <br />\n price in btc -> ";
	echo sprintf('%0.8f', $price1);
	echo "<br />\n price in usd -> $priceUSD <br />\n date -> $date <br />\n  <br />\n";
	} 
else 
	{echo "Error: " . $sqlwr . "<br>" . $conn->error;}
$conn->close();
?>