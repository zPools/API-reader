<?php
// By "https://github.com/zPools" . Do not remove this Header

// Where do I get my SONO-JSON information from? 
$url1 = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=BTC_SONO]";
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

// Display the result. The 0.8 means: 8 digit after the seperator = 1 Satoshi
echo sprintf('%0.10f', $priceUSD).PHP_EOL;
?>