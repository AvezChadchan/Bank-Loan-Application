<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $university = $_POST['university'];
        $course = $_POST['course'];
        $amount = $_POST['amount'];
        echo "<p><strong>Full Name: $full_name</strong></p>";
        echo "<p><strong>Email: $email</strong></p>";
        echo "<p><strong>Phone Number: $phone</strong></p>";
        echo "<p><strong>University/College Name: $university</strong></p>";
        echo "<p><strong>Course Name: $course</strong></p>";
        echo "<p><strong>Loan Amount Needed: $amount</strong></p>";

        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $file_name = basename($_FILES["file"]["name"]);
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_size = $_FILES["file"]["size"];
            $upload_dir = "education/uploads/";
            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                echo "<strong>!!!!!!File uploaded successfully!!!!!!.</strong>";
            } else {
                echo "<strong>!!!Error uploading file.!!!</strong>";
            }
        } else {
            echo "Error: No file uploaded.";
        }
    }   
    
    ?>
    <html>
<body>
    <h2>Education Loan Application Form</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required>
        <br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required>
        <br>
        <label for="university">University/College Name:</label><br>
        <input type="text" id="university" name="university" required>
        <br>
        <label for="course">Course Name:</label><br>
        <input type="text" id="course" name="course" required>
        <br>
        <label for="amount">Loan Amount Needed:</label><br>
        <input type="text" id="amount" name="amount" required>
        <br><br>
        <label for="file">Upload Your College ID</label><br>
        <input type="file" name="file">
        <br><br>
        <input type="submit" value="Submit Application" name="submit">
    </form>
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

