<?php 
// Assuming you have a database connection established here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>