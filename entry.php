<html>
<head>
    <title>Bank Loan Application Form</title>
</head>
<body>
    <h2>Bank Loan Application Form</h2>
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

        <input type="submit"  id="btn" value="Submit Application" name="submit"><br><br>
        <input type="submit" value="EMI calculator" name="calculator">

    </form>
</body>
</html>
