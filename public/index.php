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
             $sql = "SELECT coin FROM crex"; 
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
	
// Make the SQL query
$sql = "SELECT coin, price_btc, price_usd, date FROM crex WHERE coin = '$coinsname' ORDER BY date DESC LIMIT 1;"; 
$result = $conn->query($sql);
while ($row = $result->fetch_assoc())
	{
	echo $row["price_btc"], " ", "BTC", " -> ", $row["price_usd"], " USD on Crex. The last update was ", $row["date"];	
	}	
?>
</body> 	
</html> 