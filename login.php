<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "names";

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user's input
$Name = $_POST["Name"];
$Password = $_POST["Password"];

// Add a new entry to the database
$sql = "INSERT INTO identity (Name, Password) VALUES ('$Name', '$Password')";
$conn->query($sql);

// Log the user in
session_start();
$_SESSION["Name"] = $Name;
header("Location: dashboard.php");

$conn->close();
?>