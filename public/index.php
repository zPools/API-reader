<!DOCTYPE html>
<html>
    <head> 
	    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr.header
            {
                font-weight:bold;
				text-align:center;
            }
            tr.alt
            {
                background-color: #dbd7d2;
            }		
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.striped tr:even').addClass('alt');
            });
        </script>
        <title>Coin Price Info</title> 
    </head> 
<body>
 <form action="" method=""> 
    Coin:  
       <select name="coin"> 
            <?php
			$coinsname = $_REQUEST['coin'];
            include ('..\settings\mysql\settings-db.php');
			$conn = new mysqli($servername, $username, $password, $dbname);	
			
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 			
             // SQL-Query
             $sql = "SELECT coin FROM coin"; 
             $result = $conn->query($sql); 
			// Display the choosen coin as selected
			if ($coinsname)
			{echo "<option>$coinsname</option>";}			
             // make a option for every key               
            while ($row = $result->fetch_assoc()) { 
			$nameofcoin = $row["coin"];
            echo("<option>".$row['coin']."</option>");     } 
            $conn->close();
			?> 
            </select> 
            <input type="submit" value="Submit" /> 
</form>
<br />
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
	echo "<br /> Current last trade for <strong> $coinsname: </strong> <br /> ";
	}
else 
	{
	echo "<br /> Please select a coin from the dropdown menu above<br /> ";
	}
?>
        <table class="striped">
            <tr class="header">
                <td>Price in BTC:</td>
                <td>Price in USD:</td>
                <td>On Exchange:</td>
				<td>Last Update:</td>
            </tr>
<?php
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
		echo "<tr>";
		echo "<td>".$row["price_btc"]."</td>";
		echo "<td>".$row["price_usd"]."</td>";
		echo "<td>"."$ex"."</td>";
		echo "<td>".$row["date"]."</td>";
		echo "</tr>";
		}	
	}
?>
</body> 	
</html> 