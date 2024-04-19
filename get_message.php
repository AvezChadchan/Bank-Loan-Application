<?php
$conn = new mysqli("localhost","root","","message");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT message FROM message_details ORDER BY message DESC LIMIT 1";

$result = $conn->query($sql);

if ($result === false) 
{
    echo "Error executing query: " . $conn->error;
} 
else 
{
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_array())
        {
            echo $row["0"];
        }
    } 
    else 
    {
        echo "No message";
    }
}
$conn->close();
?>
