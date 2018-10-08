<?php
//Nova has no slow API but its big and this cause timeout
ini_set('max_execution_time', 300);
$ex = 'novaexchange';
$url = "https://novaexchange.com/remote/v2/markets";
$url2 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=USD_BTC]";
$json = json_decode(file_get_contents($url), true);
$json2 = json_decode(file_get_contents($url2), true);
$price2 = $json2["Tickers"] ["0"] ["Last"];
date_default_timezone_set('Europe/Berlin');
$date = date('Y/m/d H:i:s');
include('../../settings/mysql/settings-db.php');
foreach ($json["markets"] as $key => $value) 
	{
	//Nova has low volume, so we need to set "bid" that users get a proper value
	$price = $value["bid"];
	$coinsname = $value["currency"];
	$priceUSD = $price * $price2;
	//Nova has a field called basecurrency. This can be used to filter it.
	$filter = $value["basecurrency"];
	if ($filter === 'BTC')
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
//Dont need to clean, Nova has a nice API
$conn->close();
?>