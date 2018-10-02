<?php
// Name the exchange
$ex = 'poloniex';
// Where do I get my JSON information from?
$url = "https://poloniex.com/public?command=returnTicker";
// Where do I get my BTC-JSON information from? 
$url2 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=USD_BTC]";
// Decode the JSON
$json = json_decode(file_get_contents($url), true);
// Decode the JSON 2
$json2 = json_decode(file_get_contents($url2), true);
// Where do I get my USD-BTC value from? "0" is for a [ bracket (key)
$price2 = $json2["Tickers"] ["0"] ["Last"];
// Go through every key from "Tickers" and set $key as $coinsname and last as $price 
foreach ($json as $key => $value) 
	{
		$price = $value["last"];
		$coinsname = $key;
		$priceUSD = $price * $price2;
		$ch = curl_init("http://127.0.0.1:8090/core/write-sql.php?ex=$ex&coin=$coinsname&price=$price&usd=$priceUSD");
		curl_exec($ch);
	}
$ch2 = curl_init ("http://127.0.0.1:8090/core/clean-db.php?ex=$ex");
curl_exec($ch2);
?>