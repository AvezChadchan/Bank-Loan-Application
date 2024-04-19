<?php
    if(isset($_POST['submit']))
    {
    $b_name = $_POST['business_name'];
    $email = $_POST['business_email'];
    $income = $_POST['income'];
    
    echo "Name: " . $b_name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Income: " . $income . "<br>";
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_size = $_FILES["file"]["size"];
        $upload_dir = "business/uploads/";
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo "<strong>File uploaded successfully.</strong><br>";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: No file uploaded.";
    }
    }
?>


<html>
    <head>
        <title>
            Please Fill Your Business Details
        </title>
    </head>
    <body>
        <h2>Please Fill Your Business Details</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="business name">Business Name:</label><br>
        <input type="text" id="business_name" name="business_name" required><br><br>

        <label for="email">Business Email:</label><br>
        <input type="email" id="business_email" name="business_email" required><br><br>

        <label for="income">Monthly Income:</label><br>
        <input type="number" id="income" name="income" required><br><br>
        <input type="file" name="file"><br><br>
        <input type="submit" value="Submit Application" name="submit">
    </form>
    <div id="message"></div>
    <button onclick="getMessage()" value="check">Check Status</button><br><br>

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
