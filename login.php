<html>
<style> .body-content{color : #d3305d !important;} </style>
<body>

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "Nikitha@123";
        $dbName = "arcade";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT username, email FROM register WHERE username = ? and password=? LIMIT 1";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->bind_result($resultName, $resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum != 1) {
                die("Username or password is incorrect");
            }

            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>


<form >
  <table class="body-content">
   <tr>
    <td><b>User Name : </b></td>
    <td><?php echo $resultName ?></td>
   </tr>
    <td><b>Email :</b></td>
    <td><?php echo $resultEmail ?></td>
   </tr> 
  </table>
</form>



</body>
</html>