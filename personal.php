<html>
<head>
    <title>Personal Details Form</title>
</head>
<body>

<h1>Personal Details</h1>
<form method="post" action="" enctype="multipart/form-data">
    <h3>Contact Information</h3>
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" required><br><br>

    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" required><br><br>
    
    <label for="phno">Phone No:</label><br>
    <input type="number" id="phnumber" name="phnumber" required><br><br>

    <label for="gender">Gender:</label><br>
    <select id="gender" name="gender" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br><br>

    <h3>Employment Information</h3>
    <label for="Occupation">Occupation:</label><br>
    <input type="text" name="occupation" id="occupation" required><br><br>

    <label for="experience">Years of Experience:</label><br>
    <input type="number" name="experience" id="experience" required><br><br>

    <label for="g_income">Gross Monthly Income:</label><br>
    <input type="number" name="g_income" id="g_income"><br><br>
    
    <label for="bio">Short Bio:</label><br>
    <textarea id="bio" name="bio"></textarea><br><br>
    
    <label for="file">Upload Your Documents:</label><br>
    <input type="file" name="file" required > <br><br>

    <input type="submit" name="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $age=$_POST['age'];
        $date=$_POST['dob'];
        $phno=$_POST['phnumber'];
        $gender=$_POST['gender'];
        $occupation=$_POST['occupation'];
        $experience=$_POST['experience'];
        $gincome=$_POST['g_income'];
        $bio = $_POST["bio"];
        echo "<h3>Submitted Details:</h3>";
        echo "<strong>Name: $name</strong><br>";
        echo "<strong>Email: $email</strong><br>";
        echo "<strong>Age: $age</strong><br>";
        echo "<strong>Date of Birth: $date</strong><br>";
        echo "<strong>Gender: $gender</strong><br>";
        echo "<strong>Occupation: $occupation</strong><br>";
        echo "<strong>Work Experience: $experience</strong><br>";
        echo "<strong>Monthly Income: $gincome</strong><br>";  
        echo "<strong>Bio: $bio</strong><br>";
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $file_name = basename($_FILES["file"]["name"]);
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_size = $_FILES["file"]["size"];
        $upload_dir = "personal/uploads/";
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo "<strong>File uploaded successfully.</strong><br>";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: No file uploaded.";
    }
    if($experience>=3 && $gincome>50000)
    {
        echo "<p><strong>!!!!!!You are Eligible For Loan Mr. ".$name."!!!!!!<br></strong></p>";
    }
    else
    {
        echo "<strong>You are Not Eligible For Loan,Sorry!!!!</strong><br>";
    }
}
?>
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
