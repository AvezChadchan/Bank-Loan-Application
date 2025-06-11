<?php
session_start();

// Hardcoded credentials
$adminUsername = 'admin';
$adminPassword = 'admin123';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['user_id'] = 1; // dummy ID
        $_SESSION['username'] = $adminUsername;
        $_SESSION['role'] = 'admin';
        header("Location: adminhomepage.php");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Invalid admin credentials.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bank Loan Application</h1>
    </header>
   
    <div class="container">
        <div class="card">
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
