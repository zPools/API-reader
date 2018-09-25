<?php
// Get the job out of the navigation (crex.php?coin=XYZ)
$coinsname = $_REQUEST['coin'];
// Load the database settings
include ('..\settings\mysql\settings-db.php');
// Where do I get my SONO-JSON information from? 
$url1 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=BTC_$coinsname]";
// Where do I get my BTC-JSON information from? 
$url2 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=USD_BTC]";
// Decode the JSON 1
$json1 = json_decode(file_get_contents($url1), true);
// Decode the JSON 2
$json2 = json_decode(file_get_contents($url2), true);
// Where do I get my SONO-BTC value from? "0" is for a [ bracket
$price1 = $json1["Tickers"] ["0"] ["Last"];
// Where do I get my USD-BTC value from? "0" is for a [ bracket
$price2 = $json2["Tickers"] ["0"] ["Last"];
// Calculate the USD price for SONO
$priceUSD = $price1 * $price2;
// Set timezone and set variable date with current date
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');
// Read the current pull id...
$sqlread = "SELECT pull FROM crex Order By pull DESC LIMIT 1";
$read = $conn->query($sqlread);
while ($row = $read->fetch_assoc())
	{
	$lastpull = $row["pull"];
	}
// ... and add 1
$update = $lastpull + 1;
// Write data into database "pull id, "coin", "price in btc", "price in usd" and "date"	
$sqlwr = "INSERT INTO crex (pull, coin, price_btc, price_usd, date)
VALUES ('$update', '$coinsname', '$price1', '$priceUSD', '$date')";
// Echo if success or throw error
if ($conn->query($sqlwr) === TRUE) {
    echo " SUCCESS <br /> ID: $update <br /> COIN -> $coinsname <br /> price in btc -> ";
	echo sprintf('%0.8f', $price1);
	echo "<br /> price in usd -> $priceUSD <br />date -> $date <br /> <br />";
} else {
    echo "Error: " . $sqlwr . "<br>" . $conn->error;
}
$conn->close();
?>