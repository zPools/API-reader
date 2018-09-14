<?php
// Copyright 2018 --- zPools & The SONO development team. Do not remove this Header ---


// Where do I get my JSON information from?
$url = "https://api.crex24.com/CryptoExchangeService/BotPublic/ReturnTicker?request=[NamePairs=BTC_SONO]";
// Decode the JSON
$json = json_decode(file_get_contents($url), true);
// What information needs to be shown? "0" is for a [ bracket
$price = $json["Tickers"] ["0"] ["Last"];
// Display the result. The 0.8 means: 8 digit after the seperator = 1 Satoshi
echo PHP_EOL;
echo sprintf('%0.8f', $price).PHP_EOL;
?>