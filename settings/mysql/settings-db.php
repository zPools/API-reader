<?php
// Should there be a timeout for mysql? If not, set to "0"
ini_set('max_execution_time', 0);
// User credentials
$servername = "localhost";
$username = "root";
$password = "";
// Database name
$dbname = "data";
// Make the connection
$conn = new mysqli($servername, $username, $password, $dbname);	
if ($conn->connect_error) 
{die("Connection failed: " . $conn->connect_error);} 
?>