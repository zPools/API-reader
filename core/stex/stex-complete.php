<?php
// Name the exchange
$ex = 'stex';
// Where do I get my JSON information from?
$url = "https://app.stex.com/api2/prices";
// Where do I get my BTC-JSON information from? 
$url2 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=USD_BTC]";
// Decode the JSON
$json = json_decode(file_get_contents($url), true);
// Decode the JSON 2
$json2 = json_decode(file_get_contents($url2), true);
// Where do I get my USD-BTC value from? "0" is for a [ bracket (key)
$price2 = $json2["Tickers"] ["0"] ["Last"];

// Set timezone and set variable date with current date
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');

include('/var/www/html/API-reader/settings/mysql/settings-db.php')
// Go through every key from "Tickers" and set PairName as $coinsname and Last as $price
foreach ($json as $key => $value) 
	{
		//Stex dont provide "last" so we assume sell as last
		$price = $value["sell"];
		$coinsname = $value["market_name"];
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
$ch2 = curl_init ("http://127.0.0.1:8090/core/clean-db.php?ex=$ex");
curl_exec($ch2);
$conn->close();
?>
