<?php
// Define database parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "names";

// Create a new PDO object
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; // Commented out to avoid outputting text in the response
} catch(PDOException $error) {
    echo "Connection error: " . $error->getMessage();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["Name"];
    $password = $_POST["Password"];

    // Prepare the SQL statement
    $sql = "INSERT INTO identity (name, password) VALUES (:name, :password)";
    $stmt = $conn->prepare($sql);

    // Bind values to the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Display "Record created successfully" message
        echo "Record created successfully";

        // Redirect to choice.html after a few seconds
        header("Refresh: 3; url=http://localhost/choice.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn = null;
?>
