<html>
<head>
    <title>EMI Calculator</title>
</head>
<body>
    <h2>EMI Calculator</h2>
    <form method="post">
        Loan Amount:<br> <input type="text" name="loan_amount" required><br><br>
        Interest Rate (annual):<br> <input type="text" name="interest_rate" required><br><br>
        Loan Tenure (months): <br><input type="text" name="loan_tenure" required><br><br>
        <input type="submit" name="submit" value="Calculate EMI">
    </form>

    <?php
    if(isset($_POST['submit'])) {
        $loan_amount = $_POST['loan_amount'];
        $interest_rate = $_POST['interest_rate'];
        $loan_tenure = $_POST['loan_tenure'];
        $monthly_interest_rate = ($interest_rate / 100) / 12;
        $emi = ($loan_amount * $monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_tenure)) / (pow(1 + $monthly_interest_rate, $loan_tenure) - 1);
        echo "<h3>Monthly EMI: " . round($emi, 2) . "</h3>";
    }
    ?>
</body>
</html>