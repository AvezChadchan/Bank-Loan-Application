<?php
if (isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $loan_amount = $_POST['loan_amount'];
    $purpose = $_POST['purpose'];
    $conn = new mysqli("localhost", "root", "", "userdata");
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO loan_details values('$name', '$email','$loan_amount','$purpose')";
    if($loan_amount<=100000)
    {
        echo "<strong>Application not Submitted</strong><br>";
        echo "Loan Amount must be greater than 100000<br>";
    }
    else if($conn->query($sql) === TRUE) 
    {
    echo "!!!!!!Loan Application Submitted!!!!!!<br>";
    } 
    if($loan_amount<=100000)
    {
        echo "";
    }
    else if($purpose=="Business")
    {
        header("Location:business.php");
    }
    else if($purpose=="Personal")
    {
        header("Location:personal.php");
    }
    else if($purpose=="Education")
    {
        header("Location:education.php");
    }
    else if($loan_amount<=100000)
    {
        echo "Application not Subbmitted<br>";
        echo "Loan Amount must be greater than 100000<br>";
    }
    
    $conn->close();
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Loan Amount: " . $loan_amount . "<br>";
    echo "Purpose of Loan: " .$purpose . "<br>";
    
}
if(isset($_POST['calculator']))
{
    header("Location:emicalculator.php");
}
?>
<html>
    <body>    
    <div id="message"></div>
    <button onclick="getMessage()" value="check">Check Status</button>

    <script>
        function getMessage() {
            fetch('get_message.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    </body>
</html>