<?php

$servername = "zuc353.encs.concordia.ca";
$username = "zuc353_4";
$password = "potatoal";
$dbname = "zuc353_4";

// Create connection
$conn = new mysqli("127.0.0.1", "jacobguirguis");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if (isset($_GET['bar'])) {
    $sql = "SELECT * FROM zuc_Patients;";
    $result = $conn->query($sql);
    
}



$conn->close()

?>
