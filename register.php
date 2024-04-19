<?php
$DB_HOST= 'localhost';
$DB_USER= 'root';
$DB_PASS= '';
$DB_NAME= 'register';

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user data into database
    $sql = "INSERT INTO registeration (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<html>
<head>
    <title>Registration Page</title>
</head>
<link rel="stylesheet" href="css/register.css">
<body>
    <div class="box">
        <div class="container">

            <h2>Registration Form</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>
                
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                
                <input type="submit" value="Register" id="btn"><br><br>
                <a href="login.php">Already have an Account Click Here!!!</a>
            </form>
        </div>        
</div>
</body>
</html>
