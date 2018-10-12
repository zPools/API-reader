<?php
// Reduce the API calls to Crex by saving the btc usd value once, then let the driver ask here
$url = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=USD_BTC]";
// Decode the JSON 
$json = json_decode(file_get_contents($url), true);
// Where do I get my USD-BTC value from? "0" is for a [ bracket (key)
$price = $json["Tickers"] ["0"] ["Last"];
include('/var/www/html/API-reader/settings/mysql/settings-db.php');
$sqlwr =   "UPDATE `options` SET `value`='".$price."' WHERE `type`= 'btc-usd';";
if ($conn->query($sqlwr) === TRUE)
	{echo " SUCCESS <br /> \n BTC-USD is at: ".$price."<br /> \n";}
else 
	{echo "Error: " . $sqlwr . "<br>" . $conn->error;}
$conn->close();
?>
