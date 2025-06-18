<?php
// Database connection settings
$host = 'localhost';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'loan_system'; // Changed to loan_system

// Create a connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if email is provided (e.g., via POST or GET)
$email = isset($_POST['email']) ? $_POST['email'] : (isset($_GET['email']) ? $_GET['email'] : '');

if (empty($email)) {
    die("Error: Email parameter is required.");
}

// Prepare the SQL query
$query = "SELECT message_text FROM messages WHERE email = ?"; // Changed to message_text to match loan_system.sql
$stmt = $mysqli->prepare($query);

// Check if the prepare statement failed
if ($stmt === false) {
    die("Prepare failed: " . $mysqli->error);
}

// Bind the email parameter
$stmt->bind_param("s", $email);

// Execute the query
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Fetch and display the messages
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Message: " . htmlspecialchars($row['message_text']) . "<br>"; // Changed to message_text
    }
} else {
    echo "No messages found for this email.";
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>