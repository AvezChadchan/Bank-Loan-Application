<?php
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$next_page = '';
$email = '';

if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "loan_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Verify that the user_id exists in the users table
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        echo "<p class='error'>Error: User ID not found. Please log in again.</p>";
        session_destroy();
        echo "<a href='login.php'>Go to Login</a>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $loan_amount = $_POST['loan_amount'];
    $purpose = $_POST['purpose'];
    $created_at = date('Y-m-d H:i:s');
    
    if ($loan_amount <= 100000) {
        echo "<p class='error'>Loan Amount must be greater than 100000</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO loan_details (name, email, loan_amount, purpose, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssdisi", $name, $email, $loan_amount, $purpose, $user_id, $created_at); // Corrected to "ssdisi"
        if ($stmt->execute()) {
            echo "<p class='success'>Loan Application Submitted!</p>";
            // Set the next page based on the purpose
            if ($purpose == "Business") {
                $next_page = "business.php?email=" . urlencode($email);
            } elseif ($purpose == "Personal") {
                $next_page = "personal.php?email=" . urlencode($email);
            } elseif ($purpose == "Education") {
                $next_page = "education.php?email=" . urlencode($email);
            }
        } else {
            echo "<p class='error'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
    $conn->close();
} elseif (isset($_POST['calculator'])) {
    header("Location: emicalculator.php");
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div id="message"></div>
    <?php if ($next_page): ?>
        <p><a href="<?php echo htmlspecialchars($next_page); ?>" class="btn">Proceed to Additional Details</a></p>
    <?php endif; ?>
    <button onclick="getMessage('<?php echo htmlspecialchars($email); ?>')" class="btn">Check Status</button>
    <script>
        function getMessage(email) {
            if (!email) {
                document.getElementById('message').innerHTML = "Please submit an application first.";
                return;
            }
            fetch(`get_message.php?email=${encodeURIComponent(email)}`)
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