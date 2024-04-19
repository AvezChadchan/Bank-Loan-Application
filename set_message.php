<?php

$conn = new mysqli("localhost","root","","message");
// $conn2=new mysqli("localhost","root","","userdata");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['approve']))
{
$messages = $_POST['message'];
$stmt = $conn->prepare("INSERT INTO message_details (message) VALUES (?)");
$stmt->bind_param("s", $messages);
$stmt->execute();
echo "!!!!Loan Approved!!!";
}

if(isset($_POST['decline']))
{
$messages = $_POST['message'];
$stmt = $conn->prepare("INSERT INTO message_details (message) VALUES (?)");
$stmt->bind_param("s", $messages);
$stmt->execute();
echo "!!!!Loan Rejected!!!";
}
$stmt->close();
$conn->close();
?>