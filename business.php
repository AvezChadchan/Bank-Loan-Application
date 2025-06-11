<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "loan_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $business_name = $_POST['business_name'];
    $business_email = $_POST['business_email'];
    $income = $_POST['income'];
    $loan_email = $_POST['loan_email'];
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $file_tmp = $_FILES["file"]["tmp_name"];
        $upload_dir = "business/uploads/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $file_path = $upload_dir . $file_name;
            $stmt = $conn->prepare("INSERT INTO additional_details (loan_email, type, business_name, business_email, income, file_path) VALUES (?, 'business', ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $loan_email, $business_name, $business_email, $income, $file_path);
            $stmt->execute();
            $stmt->close();
            echo "<p class='success'>Business details submitted successfully!</p>";
        } else {
            echo "<p class='error'>Error uploading file.</p>";
        }
    }
    $conn->close();
}
?>
<html>
<head>
    <title>Business Loan Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Business Loan Details</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="loan_email" value="<?php echo $_GET['email'] ?? ''; ?>">
        <label for="business_name">Business Name:</label><br>
        <input type="text" id="business_name" name="business_name" required><br><br>
        <label for="business_email">Business Email:</label><br>
        <input type="email" id="business_email" name="business_email" required><br><br>
        <label for="income">Monthly Income:</label><br>
        <input type="number" id="income" name="income" required><br><br>
        <label for="file">Upload Document:</label><br>
        <input type="file" name="file" required><br><br>
        <button type="submit" name="submit" class="btn">Submit</button>
    </form>
    <div id="message"></div>
    <button onclick="getMessage()" class="btn">Check Status</button>
    <script>
        function getMessage() {
            fetch('get_message.php?email=<?php echo $_GET['email'] ?? ''; ?>')
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</div>
</body>
</html>