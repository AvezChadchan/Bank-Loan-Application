<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'loan_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Using email as the username field
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Prepare the SQL query for the users table
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    
    // Check if prepare failed
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("ss", $email, $password);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<p class='success'>Registration successful!</p>";
        header("Location: login.php");
        exit();
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="main">
        <div class="content">
            <h2>Registration</h2>
            <form method="post" action="">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit" class="btn">Register</button><br><br>
                <a href="login.php">Already have an Account?</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>