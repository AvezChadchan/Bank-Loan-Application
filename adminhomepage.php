<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: adminlogin.php");
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Admin Homepage</title>
</head>
<body>
  <div class="container">
    <div class="main">
        <h1>Loan Approvals</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Loan Amount</th>
                    <th>Purpose</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "loan_system");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT name, email, loan_amount, purpose FROM loan_details";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td><?php echo htmlspecialchars($data['loan_amount']); ?></td>
                            <td><?php echo htmlspecialchars($data['purpose']); ?></td>
                            <td>
                                <form method="post" action="set_message.php">
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                                    <label for="message">Message for User:</label><br>
                                    <input type="text" id="message" name="message" required><br>
                                    <button type="submit" name="approve" class="btn approve">Approve</button>
                                    <button type="submit" name="decline" class="btn decline">Decline</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No pending applications</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
  </div>
</body>
</html>