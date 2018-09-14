<?php
// Include the mysql settings
include('settings\mysql\settings-db.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Find what to do
$sqlfind = "SELECT * FROM exchanges";
$readfind = $conn->query($sqlfind);
while ($row = $readfind->fetch_assoc())
	{
	$coinsname = $row["Coin"];
	$ch = curl_init("http://127.0.0.1:8080/core/crex/crex-single.php?coin=$coinsname");
	curl_exec($ch);
	}
$conn->close();
?>


//Next => Make an "Admin panel => a site like "new coins" => you can easy import coins to the MySQL