<?php
// Include the mysql settings
include('/var/www/html/API-reader/settings/mysql/settings-db.php');
// Get the job out of the exchange out of the navigation
$exchange = $_REQUEST['ex'];
// Delete data from database "currently we only need btc price"	
// TODO: Make it with less commands
// TODO2: If more exchanges come, the naming of the JSON can be a issue. Make it that only needed sql cleans per exchange are made
$sqldel1 = "DELETE FROM $exchange WHERE `coin` REGEXP '^ETH_'";
$sqldel2 = "DELETE FROM $exchange WHERE `coin` REGEXP '^USD_'";
$sqldel3 = "DELETE FROM $exchange WHERE `coin` REGEXP '^CNY_'";
$sqldel4 = "DELETE FROM $exchange WHERE `coin` REGEXP '^EUR_'";
$sqldel5 = "DELETE FROM $exchange WHERE `coin` REGEXP '^JPY_'";
$sqldel6 = "DELETE FROM $exchange WHERE `coin` REGEXP '^RUB_'";
$sqldel7 = "UPDATE $exchange SET `coin` = SUBSTRING(coin,5) WHERE `coin` REGEXP '^BTC_'";
$sqldel8 = "DELETE FROM $exchange WHERE `coin` REGEXP '^USDT_'";
$sqldel9 = "DELETE FROM $exchange WHERE `coin` REGEXP '^XMR_'";
$sqldel10 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/USNBT' OR `coin` REGEXP '\w*-USNBT'";
$sqldel11 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/USD' OR `coin` REGEXP '\w*-USD'";
$sqldel12 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/BCH' OR `coin` REGEXP '\w*-BCH'";
$sqldel13 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/CNNBT' OR `coin` REGEXP '\w*-CNNBT'";
$sqldel14 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/DASH' OR `coin` REGEXP '\w*-DASH'";
$sqldel15 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/LTC' OR `coin` REGEXP '\w*-LTC'";
$sqldel16 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/TUSD' OR `coin` REGEXP '\w*-TUSD' OR `coin` REGEXP '\w*-USDT' OR `coin` REGEXP '\w*-USDC' OR `coin` REGEXP '\w*USDC_'";
$sqldel18 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*-NEO' OR `coin` REGEXP '\w*-ETH' OR `coin` REGEXP '\w*-KCS'";
$sqldel17 = "UPDATE $exchange SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -4), '') WHERE `coin` REGEXP '\w*/BTC' OR `coin` REGEXP '\w*-BTC'";

//Cryptopia
$sqldel19 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/LTC ' OR `coin` REGEXP '\w*/DOGE' OR `coin` REGEXP '\w*/USDT' OR `coin` REGEXP '\w*/NZDT'";
if ($exchange ==='crypt')
{
	if ($conn->query($sqldel19) === TRUE) 
		{echo "Crypt cleaning complete<br />";} 
	else 
		{echo "Error: " . $sqldel19 . "<br>" . $conn->error;}
}//Cryptopia end
//Stex
$sqldel20 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*_LTC' OR `coin` REGEXP '\w*_ETH' OR `coin` REGEXP '\w*_NXT' OR `coin` REGEXP '\w*_USD' OR `coin` REGEXP '\w*_JPY' OR `coin` REGEXP '\w*_USDT' OR `coin` REGEXP '\w*_EUR' OR `coin` REGEXP '\w*_RUB'";
$sqldel21 = "UPDATE $exchange SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -4), '') WHERE `coin` REGEXP '\w*_BTC'";
if ($exchange ==='stex')
{
	if ($conn->query($sqldel20) === TRUE) 
		{echo "Stex cleaning complete<br />";} 
	else 
		{echo "Error: " . $sqldel20 . "<br>" . $conn->error;}
		
	if ($conn->query($sqldel21) === TRUE) 
		{echo "Stex naming complete<br />";} 
	else 
		{echo "Error: " . $sqldel20 . "<br>" . $conn->error;}
} //Stex end
//Binance
$sqldel22 = "DELETE from binance where SUBSTRING(coin, -3) = 'ETH' or SUBSTRING(coin, -4) = 'USDT' or SUBSTRING(coin, -4) = 'USDT' or SUBSTRING(coin, -3) = 'BNB'";
$sqldel23 = "UPDATE binance SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -3), '') WHERE SUBSTRING(coin, -3) = 'BTC'";
if ($exchange ==='binance')
{
	if ($conn->query($sqldel22) === TRUE) 
		{echo "Binance cleaning complete<br />";} 
	else 
		{echo "Error: " . $sqldel22 . "<br>" . $conn->error;}
	
	if ($conn->query($sqldel23) === TRUE) 
		{echo "Binance RENAME complete<br />";} 
	else 
		{echo "Error: " . $sqldel23 . "<br>" . $conn->error;}	
} //Binance end

//HitBTC
$sqldel22 = "DELETE from hitbtc where SUBSTRING(coin, -3) = 'ETH' or SUBSTRING(coin, -4) = 'USDT' or SUBSTRING(coin, -4) = 'USDT' or SUBSTRING(coin, -3) = 'BNB' or SUBSTRING(coin, -3) = 'USD' or SUBSTRING(coin, -4) = 'EURS' or SUBSTRING(coin, -3) = 'EOS' or SUBSTRING(coin, -3) = 'DAI'";
$sqldel23 = "UPDATE hitbtc SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -3), '') WHERE SUBSTRING(coin, -3) = 'BTC'";
if ($exchange ==='hitbtc')
{
	if ($conn->query($sqldel22) === TRUE) 
		{echo "hitbtc cleaning complete<br />";} 
	else 
		{echo "Error: " . $sqldel22 . "<br>" . $conn->error;}
	
	if ($conn->query($sqldel23) === TRUE) 
		{echo "hitbtc RENAME complete<br />";} 
	else 
		{echo "Error: " . $sqldel23 . "<br>" . $conn->error;}	
} //HitBTC end
//Bleutrade
if ($exchange ==='bleu')
{
$sqldel24 = "UPDATE $exchange SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -4), '') WHERE `coin` REGEXP '\w*_BTC'";
if ($conn->query($sqldel24) === TRUE) 
		{echo "bleutrade cleaning complete<br />";} 
	else 
		{echo "Error: " . $sqldel22 . "<br>" . $conn->error;}
}
//Bleutrade end

//Every other
if ($exchange !='stex' && $exchange !='binance' && $exchange !='hitbtc' && $exchange !='bleu')
{
if ($conn->query($sqldel1) === TRUE) 
	{echo "SUCCESSFULLY CLEANED ETH from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel1 . "<br>" . $conn->error;}


if ($conn->query($sqldel2) === TRUE) 
	{echo "SUCCESSFULLY CLEANED USD from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel2 . "<br>" . $conn->error;}


if ($conn->query($sqldel3) === TRUE) 
	{echo "SUCCESSFULLY CLEANED CNY from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel3 . "<br>" . $conn->error;}


if ($conn->query($sqldel4) === TRUE) 
	{echo "SUCCESSFULLY CLEANED EUR from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel4 . "<br>" . $conn->error;}


if ($conn->query($sqldel5) === TRUE) 
	{echo "SUCCESSFULLY CLEANED JPY from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel5 . "<br>" . $conn->error;}


if ($conn->query($sqldel6) === TRUE) 
	{echo "SUCCESSFULLY CLEANED RUB from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel6 . "<br>" . $conn->error;}


if ($conn->query($sqldel8) === TRUE) 
	{echo "SUCCESSFULLY CLEANED USDT from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel8 . "<br>" . $conn->error;}	


if ($conn->query($sqldel9) === TRUE) 
	{echo "SUCCESSFULLY CLEANED XMR from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel9 . "<br>" . $conn->error;}	


if ($conn->query($sqldel10) === TRUE) 
	{echo "SUCCESSFULLY CLEANED USNBT from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel10 . "<br>" . $conn->error;}


if ($conn->query($sqldel11) === TRUE) 
	{echo "SUCCESSFULLY CLEANED USD from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel11 . "<br>" . $conn->error;}		


if ($conn->query($sqldel12) === TRUE) 
	{echo "SUCCESSFULLY CLEANED BCH from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel12 . "<br>" . $conn->error;}


if ($conn->query($sqldel13) === TRUE) 
	{echo "SUCCESSFULLY CLEANED CNNBT from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel13 . "<br>" . $conn->error;}


if ($conn->query($sqldel14) === TRUE) 
	{echo "SUCCESSFULLY CLEANED DASH from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel14 . "<br>" . $conn->error;}


if ($conn->query($sqldel15) === TRUE) 
	{echo "SUCCESSFULLY CLEANED LTC from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel15 . "<br>" . $conn->error;}


if ($conn->query($sqldel16) === TRUE) 
	{echo "SUCCESSFULLY CLEANED TUSD from $exchange <br />";} 
else 
	{echo "Error: " . $sqldel16 . "<br>" . $conn->error;}


if ($conn->query($sqldel18) === TRUE) 
	{echo "SUCCESSFULLY CLEANED -NEO -ETH -KCS in $exchange <br />";} 
else 
	{echo "Error: " . $sqldel18 . "<br>" . $conn->error;}


if ($conn->query($sqldel7) === TRUE) 
	{echo "SUCCESSFULLY CHANGED NAMES in $exchange <br />";} 
else 
	{echo "Error: " . $sqldel7 . "<br>" . $conn->error;}


if ($conn->query($sqldel17) === TRUE) 
	{echo "SUCCESSFULLY CHANGED SPECIALNAMES in $exchange <br />";} 
else 
	{echo "Error: " . $sqldel17 . "<br>" . $conn->error;}	
}
$conn->close();
?>
