<?php
// Include the mysql settings
include('..\settings\mysql\settings-db.php');
// Get the job out of the navigation (exchange.php?ex=crex&coin=XYZ&price=0.1234567890&usd=0.123123123)
$exchange = $_REQUEST['ex'];
$coinsname = $_REQUEST['coin'];
$price1 = $_REQUEST['price'];
$priceUSD = $_REQUEST['usd'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
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
if ($conn->query($sqlwr) === TRUE) {
    echo " SUCCESS <br /> Exchange : $exchange <br /> ID: $update <br /> COIN -> $coinsname <br /> price in btc -> ";
	echo sprintf('%0.8f', $price1);
	echo "<br /> price in usd -> $priceUSD <br />date -> $date <br /> <br />";
} else {
    echo "Error: " . $sqlwr . "<br>" . $conn->error;
}
$conn->close();
?>