<?php
$ex = 'bleu';
$url = "https://bleutrade.com/api/v2/public/getmarketsummaries";
$json = json_decode(file_get_contents($url), true);
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');
include('/var/www/html/API-reader/settings/mysql/settings-db.php');
$sqlread = "SELECT `value` FROM `options` WHERE `type` = 'btc-usd'";
$result = $conn->query($sqlread);
while ($row = $result->fetch_assoc()) 
	{$price2 = $row["value"];}
foreach ($json["result"] as $key => $value) 
	{
	$price = $value["Last"];
	$coinsname = $value["MarketName"];
	$priceUSD = $price * $price2;

	$filter = $value["BaseCurrency"];
	if ($filter === 'Bitcoin')
		{
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
	}
$ch2 = curl_init ("https://altcoinprice.io/clean-db.php?ex=$ex");
curl_exec($ch2);
$conn->close();
?>
