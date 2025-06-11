<?php
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'] ?? '';
$stmt = $conn->prepare("SELECT message FROM message_details WHERE email = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo htmlspecialchars($row["message"]);
} else {
    echo "No message available";
}
$stmt->close();
$conn->close();
?>