<?php
$conn = new mysqli('localhost', 'root', '', 'loan_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO registration (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo "<p class='success'>Registration successful!</p>";
        header("Location: login.php");
        exit();
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
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
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>
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