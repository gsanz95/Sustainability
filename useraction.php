<?php
include_once("database.php");
$email = $_GET["email"];
echo "$email";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "This is not a valid email";
} else{
 $sql = "SELECT * FROM users WHERE email='$email'";
//
 $result = mysqli_query($conn, $sql);
if($result->num_rows > 0){
    echo "fu&k off";
   //user is a registeed user.
}else{
    $sql ="SELECT * FROM guest_table WHERE email = '$email'";
   //
    $result = mysqli_query($conn,$sql);
    if($result->num_rows > 0){
        $session_code = 1;
        $confirm_code = rand();
        $header = "From: @me.example.com";
        $sql = "UPDATE guest_table SET session_code='$session_code', confirm_code='$confirm_code',time_sent = now() WHERE email ='$email' ";
        //
        mysqli_query($conn, $sql);
	$msg = " Guest Email confirmation
                    http://18.218.22.129/confirmEmail.php?email=$email&confirm_code=$confirm_code
    ";
        mail($email, "confirm guest email", $msg, $header);
        echo"1email sent";
    }else {
        $session_code = 1;
        $confirm_code = rand();
        $header = "From: @me.example.com";
        $sql = "INSERT INTO guest_table (email,session_code,confirm_code) VALUES('$email','$session_code','$confirm_code')";
        //
        mysqli_query($conn,$sql);
	$msg = "
              Guest Email confirmation
                        http://18.218.22.129/confirmEmail.php?email=$email&confirm_code=$confirm_code
            ";
        mail($email, "confirm guest email", $msg, $header);
        echo"2email sent";
    }
}
}
?>
