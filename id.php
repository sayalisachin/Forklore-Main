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

if (!isset($_POST["Name"]) || !isset($_POST["Password"])) {
    echo "Name and Password fields are required.";
    exit();
}
$username = $_POST["Name"];
$password = $_POST["Password"];

// Add a new entry to the database
$sql = "INSERT INTO identity (Name, Password) VALUES ('$username', '$password')";
$conn->query($sql);

// Log the user in
session_start();
$_SESSION["username"] = $username;
header("Location: dashboard.php");

$conn->close();
?>