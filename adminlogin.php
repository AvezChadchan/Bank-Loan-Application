<html>
<head>
    <title>Admin Login Form</title>
</head>
<link rel="stylesheet" href="css/adminlogin.css">
<body>
<?php
$DB_HOST= 'localhost';
$DB_USER= 'root';
$DB_PASS= '';
$DB_NAME= 'adminlogin';

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from database
    $sql = "SELECT * FROM data WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result) 
    {
        while($data=$result->fetch_row())
        {
            if($data[1]==$password)
            {
                echo "Login successful!";
                header("Location:adminhomepage.php");  
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
<h2>Admin Login Form</h2>
<form method="post" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login" id="btn"> 
</form>
</div>
</div>



</body>

</html>
