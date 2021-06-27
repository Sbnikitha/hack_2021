<html>
<style> .body-content{color : #f3f3f3 !important;} </style>
<body>



<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['email'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "Nikitha@123";
        $dbName = "arcade";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(username, password, email) values(?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sss",$username, $password, $email);
                if ($stmt->execute()) {
                    echo "Registration sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registered using this email.";
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


<div class = "body-content">
<?php echo $resultEmail ?>
</div>

<button><a href='login.html'> Login </a></button>

</body>
</html>