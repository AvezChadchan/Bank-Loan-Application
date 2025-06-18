<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "loan_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>DEBUG: POST request received.</p>";
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo "<pre>DEBUG: POST data: " . print_r($_POST, true) . "</pre>";

    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and password are required.</p>";
    } else {
        $stmt = $conn->prepare("SELECT password, user_id FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<p>DEBUG: Rows found: " . $result->num_rows . "</p>";

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            echo "<p>DEBUG: Found user_id = " . $row['user_id'] . "</p>";
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row['user_id']; // Set the actual user_id
                echo "<p style='color:green;'>DEBUG: Login successful! Setting user_id = " . $_SESSION['user_id'] . "</p>";
                session_regenerate_id(true); // Regenerate session ID
                ob_start();
                header("Location: entry.php");
                ob_end_flush();
                exit();
            } else {
                echo "<p style='color:red;'>DEBUG: Invalid password.</p>";
            }
        } else {
            echo "<p style='color:red;'>DEBUG: Invalid email.</p>";
        }
        $stmt->close();
    }
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
                <form method="post" action="">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                    <button type="submit">Login</button><br><br>
                    <a href="register.php">Register</a>
                </form>
           </div>
       </div>
   </div>
</body>
</html>