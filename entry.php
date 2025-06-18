<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) { // Changed from 'username' to 'user_id'
    header("Location: login.php");
    exit();
}

// Pre-fill email from session
$email = $_SESSION['email'] ?? '';
?>
<html>
<head>
    <title>Bank Loan Application</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<div class="container">
    <h3>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?> | <a href="login.php">Logout</a></p>
    </h3>
    <h2>Bank Loan Application</h2>
    <form action="submit_loan_application.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly><br><br>
        <label for="loan_amount">Loan Amount:</label><br>
        <input type="number" id="loan_amount" name="loan_amount" required><br><br>
        <label for="purpose">Loan Purpose:</label><br>
        <select id="purpose" name="purpose" required>
            <option value="">Select</option>
            <option value="Home Improvement">Home Improvement</option>
            <option value="Car Purchase">Car Purchase</option>
            <option value="Education">Education</option>
            <option value="Business">Business</option>
            <option value="Personal">Personal</option>
        </select><br><br>
        <button type="submit" name="submit" class="btn">Submit Application</button>
        <button type="submit" name="calculator" formaction="emicalculator.php" class="btn">EMI Calculator</button> <!-- Separate action for calculator -->
    </form>
</div>
</body>
</html>