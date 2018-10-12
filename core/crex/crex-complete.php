<?php
// Name the exchange
$ex = 'crex';
// Where do I get my JSON information from?
$url = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker";
// Decode the JSON
$json = json_decode(file_get_contents($url), true);

// Set timezone and set variable date with current date
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');

include('/var/www/html/API-reader/settings/mysql/settings-db.php');
$sqlread = "SELECT `value` FROM `options` WHERE `type` = 'btc-usd'";
$result = $conn->query($sqlread);
while ($row = $result->fetch_assoc()) 
	{$price2 = $row["value"];}

// Go through every key from "Tickers" and set PairName as $coinsname and Last as $price
foreach ($json["Tickers"] as $key => $value) 
	{
		$price = $value["Last"];
		$coinsname = $value["PairName"];
		$priceUSD = $price * $price2;
		$sqlwr =   "INSERT INTO $ex (coin, price_btc, price_usd, date)
					VALUES ('$coinsname', '$price', '$priceUSD', '$date')";
		if ($conn->query($sqlwr) === TRUE)
			{
			echo " SUCCESS <br /> \n Exchange : $ex <br />\n COIN -> $coinsname <br />\n price in btc -> ";
			echo sprintf('%0.8f', $price);
			echo "<br />\n price in usd -> $priceUSD <br />\n date -> $date <br />\n  <br />\n";
			}
		else 
			{echo "Error: " . $sqlwr . "<br>" . $conn->error;}
	} 			
$ch2 = curl_init ("https://altcoinprice.io/clean-db.php?ex=$ex");
curl_exec($ch2);
$conn->close();
?>
