<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'loan_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, username, password FROM registration WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id']; // Set user_id
            $_SESSION['username'] = $username;
            header("Location: entry.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "Invalid Username!";
    }
    $stmt->close();
}
$conn->close();
?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="main">
        <div class="content">
            <h2>Login</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="post" action="">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit" class="btn">Login</button><br><br>
                <a href="register.php">Create Account</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>