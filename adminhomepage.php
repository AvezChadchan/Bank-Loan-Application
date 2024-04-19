<html>
    <link rel="stylesheet" href="css/adminhomepage.css">
    <body>
        <div class="main">
            <h1>LOAN APPROVALS</h1>
        <table border="1px solid">
            <?php
            
                $conn = new mysqli("localhost", "root", "", "userdata");
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM loan_details";
                $result = mysqli_query($conn, $sql);
                while($data=$result->fetch_row())
                {
                    ?>
                    <tr id="datarow">
                        <td><?php echo $data[0]?></td>
                        <td><?php echo $data[1]?></td>
                        <td><?php echo $data[2]?></td>
                        <td><?php echo $data[3]?></td>
                        <td><form method="post" action="set_message.php">
                        <label for="message">Message for User:</label><br>
                        <input type="text" id="message" name="message"><br>
                            <input type="submit" value="Approve Loan" name="approve">
                            <input type="submit" value="Decline Loan"name="decline">
                        </form></td>
                    </tr>
                    <?php
                }
                ?>
        </table>
        </div>
    </body>
    
</html>