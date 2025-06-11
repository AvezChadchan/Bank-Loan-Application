<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<head>
    <title>Bank Loan Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Bank Loan Application</h2>
    <form action="submit_loan_application.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
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
        <button type="submit" name="calculator" class="btn">EMI Calculator</button>
    </form>
</div>
</body>
</html>