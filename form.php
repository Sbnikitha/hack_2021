<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['email']) &&
        isset($_POST['phonenumber']) && isset($_POST['type']) && isset($_POST['yearsofexperience']) && isset($_POST['bio']) && isset($_POST['twitter'])&&
        isset($_POST['facebook']) && isset($_POST['instagram']) && isset($_POST['linkedin'])&& isset($_POST['previousexp'])) {
        
        $username = $_POST['name'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $type = $_POST['type'];
        $yearsofexperience = $_POST['yearsofexperience'];
        $bio = $_POST['bio'];
        $twitter = $_POST['twitter'];
        $facebook= $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $linkedin = $_POST['linkedin'];
        $previousexp = $_POST['previousexp'];


        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "Nikitha@123";
        $dbName = "arcade";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
          //  $Select = "SELECT email FROM from1 WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO form1(name, email, phonenumber,type , yearsofexperience, bio, twitter, facebook, instagram, inkedin, previousexp) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

           // $stmt = $conn->prepare($Select);
            //$stmt->bind_param("s", $email);
           // $stmt->execute();
            //$stmt->bind_result($resultEmail);
            //$stmt->store_result();
            //$stmt->fetch();
            //$rnum = $stmt->num_rows;

           // if ($rnum == 0) {
                //$stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssssssss",$username, $email, $phonenumber, $type, $yearsofexperience, $bio, $twitter, $facebook, $instagram,$linkedin,$previousexp);
                if ($stmt->execute()) {
                    echo "sucessfully created your profile";
                }
                else {
                    echo $stmt->error;
                }
           // }
           // else {
               // echo "Someone ha alredy used the email";
            //}
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