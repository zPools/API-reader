<!DOCTYPE html>
<html>
    <head> 
        <title>Coin Price Info</title> 
    </head> 
<body>
 <form action="" method=""> 
    Coin:  
       <select name="coin"> 
            <?php
			
            include ('..\settings\mysql\settings-db.php');
			$conn = new mysqli($servername, $username, $password, $dbname);	
			
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 			
             // SQL-Query erzeugen 
             $sql = "SELECT coin FROM coin"; 
             $result = $conn->query($sql); 
 
             // für jeden Eintrag ein Option-Tag erstellen                 
            while ($row = $result->fetch_assoc()) { 
			$nameofcoin = $row["coin"];
            echo '<option value="'.$row['coin'].'"'.($_POST['coin'] == $row['coin'] ? " selected": "").'>'.$row['coin'].'</option>';    } 
            $conn->close();
			?> 
            </select> 
            <input type="submit" value="Submit" /> 
</form> 
<?php
$coinsname = $_REQUEST['coin'];
// Include db settings and make a connection
include ('..\settings\mysql\settings-db.php');
$conn = new mysqli($servername, $username, $password, $dbname);	
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 	

if ($coinsname)
	{
	echo "<br /> Current last trade for $coinsname: <br /> ";
	}
else 
	{
	echo "<br /> Please select a coin from the dropdown menu above<br /> ";
	}

// Ask for all exchange we have (1st while) and echo their results (2nd while)
$sqlask = "SELECT name FROM exchange";
$resultask = $conn->query($sqlask);
while ($row = $resultask->fetch_assoc())
	{	
	$ex = $row["name"];
	$sql = "SELECT coin, price_btc, price_usd, date FROM $ex WHERE coin = '$coinsname' ORDER BY date DESC LIMIT 1;"; 
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc())
		{
		echo $row["price_btc"], " ", "BTC", " -> ", $row["price_usd"], " USD on $ex. The last update was ", $row["date"], "<br />";	
		}	
	}
?>
</body> 	
</html> 