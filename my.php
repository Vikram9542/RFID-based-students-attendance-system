<?php
$servername = "localhost";  // Change if your server has a different hostname
$username = "root";  // Change if your MySQL username is different
$password = "";  // Change if your MySQL password is different
$dbname = "test";  // Change if your database name is different

// Get RFID card ID from Arduino
$cardId = $_POST["cardId"];

// Create connection to MySQL database
$conn = new mysqli('localhost', 'root', '', 'test');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into the main table
$sql = "INSERT INTO 'main table' (Date, Day, cardId) VALUES (CURDATE(), CURTIME(), '$cardId')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
