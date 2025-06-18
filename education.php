<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) { // Changed from 'username' to 'user_id'
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $conn = new mysqli("localhost", "root", "", "loan_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $university = $_POST['university'];
    $course = $_POST['course'];
    $amount = $_POST['amount'];
    $loan_email = $_POST['loan_email'] ?? $_SESSION['email']; // Fallback to session email
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $file_tmp = $_FILES["file"]["tmp_name"];
        $upload_dir = "education/uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $file_path)) {
            $stmt = $conn->prepare("INSERT INTO additional_details (loan_email, type, full_name, email, phone, university, course, amount, file_path) VALUES (?, 'education', ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("ssssssds", $loan_email, $full_name, $email, $phone, $university, $course, $amount, $file_path); // Adjusted types
            if ($stmt->execute()) {
                echo "<p class='success'>Education details submitted successfully!</p>";
            } else {
                echo "<p class='error'>Error executing query: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p class='error'>Error uploading file.</p>";
        }
    }
    $conn->close();
}
?>
<html>
<head>
    <title>Education Loan Application</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<div class="container">
    <h2>Education Loan Application</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="loan_email" value="<?php echo htmlspecialchars($_GET['email'] ?? $_SESSION['email'] ?? ''); ?>">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br>
        <label for="university">University/College:</label><br>
        <input type="text" id="university" name="university" required><br>
        <label for="course">Course Name:</label><br>
        <input type="text" id="course" name="course" required><br>
        <label for="amount">Loan Amount:</label><br>
        <input type="number" id="amount" name="amount" required><br><br>
        <label for="file">Upload College ID:</label><br>
        <input type="file" name="file" required><br><br>
        <button type="submit" name="submit" class="btn">Submit</button>
    </form>
    <div id="message"></div>
    <button onclick="getMessage()" class="btn">Check Status</button>
    <script>
        function getMessage() {
            fetch('get_message.php?email=<?php echo urlencode($_GET['email'] ?? $_SESSION['email'] ?? ''); ?>')
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