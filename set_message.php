<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: adminlogin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['approve']) || isset($_POST['decline'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $status = isset($_POST['approve']) ? 'approved' : 'declined';
    
    $stmt = $conn->prepare("INSERT INTO message_details (email, message, status) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); // Output the error if prepare fails
    }
    
    $stmt->bind_param("sss", $email, $message, $status);
    if ($stmt->execute()) {
        echo isset($_POST['approve']) ? "<p class='success'>Loan Approved!</p>" : "<p class='error'>Loan Rejected!</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
$conn->close();
header("Location: adminhomepage.php");
exit();
?>