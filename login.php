<html>
<head>
    <title>Login Form</title>
</head>
<link rel="stylesheet" href="css/login.css">
<body>
<?php
$DB_HOST= 'localhost';
$DB_USER= 'root';
$DB_PASS= '';
$DB_NAME= 'register';

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from database
    $sql = "SELECT * FROM registeration WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result) 
    {
        while($data=$result->fetch_row())
        {
            if($data[1]==$password)
            {
                echo "Login successful!";
                header("Location:entry.php");  
            }
            else
            {
                echo "Invalid Password!!!";
            }
        }
    } 
    else 
    {
        echo "Error: ".mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<div class="main">
<div class="content">
<h2>Login Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login" id="btn"><br><br>
    <a href="register.php">Create Account Click Here!!!</a>
</form>
</div>
</div>
</html>