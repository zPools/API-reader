<?php
// Include the mysql settings
include('..\settings\mysql\settings-db.php');
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
$sqldel16 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*/TUSD' OR `coin` REGEXP '\w*-TUSD' OR `coin` REGEXP '\w*-USDT'";
$sqldel18 = "DELETE FROM $exchange WHERE `coin` REGEXP '\w*-NEO' OR `coin` REGEXP '\w*-ETH' OR `coin` REGEXP '\w*-KCS'";
$sqldel17 = "UPDATE $exchange SET `coin` = CONCAT(LEFT(`coin`, CHAR_LENGTH(`coin`) -4), '') WHERE `coin` REGEXP '\w*/BTC' OR `coin` REGEXP '\w*-BTC'";


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
$conn->close();