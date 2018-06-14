
<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 9:05 PM
 */



//set the session variables to be used on profile.php

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];


//escape post vars for account protection

$first_name = $mysqli->escape_string($_POST['firstname']) ;
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT ));
$hash = $mysqli->escape_string( md5(rand(0,1000) ) );

//this checks to see if the email entered already has a user
$result = $mysqli->query("SELECT * FROM useres WHERE email = '$email'") or die($mysqli -> error());

//if rows returned are more than 0, then the user email exists

if($result -> num_rows > 0){
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
}

else{
    //if this else statement is reached, then the email does not exist yet
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash)"
        . "VALUES ('$first_name', '$last_name', '$email','$password', '$hash')" ;

    //adds a user to the db
    if($mysqli -> query($sql)){
        $_SESSION['active'] = 0; //this stays 0 until users activate account
        $_SESSION['logged in'] = true; // this lets us know that the user has logged in
        $_SESSION['message'] =
            "Confirmation link has been sent to $email, please verify your account by clicking the link in the message!";



        //This sends the email so that the user can verify their account
        $to = $email;
        $subject = 'Account Verification (WEBSITENAME.com)';
        $message_body = '
            Hello '.$first_name.',
            
            Thank you for signing up to our website!
            Please click the this link to activate your account:
            http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;

            mail($to, $subject, $message_body);
            header("location: profile.php");

    }

    else{
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");

    }
}
