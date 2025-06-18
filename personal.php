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
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $phone = $_POST['phnumber'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $experience = $_POST['experience'];
    $income = $_POST['g_income'];
    $bio = $_POST['bio'];
    $loan_email = $_POST['loan_email'] ?? $_SESSION['email']; // Fallback to session email
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $file_tmp = $_FILES["file"]["tmp_name"];
        $upload_dir = "personal/uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $file_path)) {
            $stmt = $conn->prepare("INSERT INTO additional_details (loan_email, type, name, email, age, dob, phone, gender, occupation, experience, income, bio, file_path) VALUES (?, 'personal', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("sssisisssdis", $loan_email, $name, $email, $age, $dob, $phone, $gender, $occupation, $experience, $income, $bio, $file_path); // Adjusted types
            if ($stmt->execute()) {
                echo "<p class='success'>Personal details submitted successfully!</p>";
                if ($experience >= 3 && $income > 50000) {
                    echo "<p class='success'>You are Eligible for the Loan, $name!</p>";
                } else {
                    echo "<p class='error'>You are Not Eligible for the Loan.</p>";
                }
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
    <title>Personal Loan Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<div class="container">
    <h2>Personal Loan Details</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="loan_email" value="<?php echo htmlspecialchars($_GET['email'] ?? $_SESSION['email'] ?? ''); ?>">
        <h3>Contact Information</h3>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>
        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>
        <label for="phnumber">Phone No:</label><br>
        <input type="text" id="phnumber" name="phnumber" required><br><br>
        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>
        <h3>Employment Information</h3>
        <label for="occupation">Occupation:</label><br>
        <input type="text" id="occupation" name="occupation" required><br><br>
        <label