<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($email) || empty($message)) {
        die("Error: Both email and message parameters are required.");
    }

    // Debug: Check session and POST data
    echo "<p>DEBUG: Session user_id = " . ($_SESSION['user_id'] ?? 'Not set') . "</p>";
    echo "<p>DEBUG: Received email = " . htmlspecialchars($email) . "</p>";

    // Get user_id from session or fetch from users table
    $user_id = $_SESSION['user_id'];
    if (!$user_id || $user_id <= 0) { // Ensure user_id is valid
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            echo "<p>DEBUG: Fetched user_id = " . $user_id . "</p>";
        } else {
            die("Error: Email not found in users table or multiple matches.");
        }
        $stmt->close();
    } else {
        echo "<p>DEBUG: Using session user_id = " . $user_id . "</p>";
    }

    // Verify user_id exists in users table
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die("Error: user_id " . $user_id . " not found in users table.");
    }
    $stmt->close();

    // Prepare the SQL query to insert the message
    $stmt = $conn->prepare("INSERT INTO messages (email, message_text, user_id) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssi", $email, $message, $user_id); // s for string, s for string, i for integer
    if ($stmt->execute()) {
        echo "Message successfully saved!";
    } else {
        echo "Execute failed: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>