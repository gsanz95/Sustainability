<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 9:32 PM
 */


/**
 * verify.php verifies the registered emails, the link to tis page is included in the register.php email message
 */


require 'db.php';
session_start();

//tests to see if email and hash vars are not empty
if(isset($_get['email']) && !empty($_get['email']) AND isset($_get['hash']) && !empty($_get['hash'])){
    $email = $mysql -> escape_string($_get['email']);
    $hash = $mysql -> escape_string($_get['hash']);

    //This gets the user with matching email and hash who has not verifed their account yet
    $result = $mysql -> query("SELECT * FROM users WHERE email = '$email' AND hash = '$hash' AND active = '0'");

    if($result -> num_rows == 0 )
    {
        $_session['message'] = "Account has already been activated or the URL is invalid.";

        header("location: error.php");
    }

    else{
        $_session['message'] = "Your account has been activated! Thank you!";

        //set the user to be active
        $mysql -> query("UPDATE users SET active = '1' WHERE email = '$email'") or die($mysql -> error);
        $_session['active'] = 1;

        header("location: success.php");
    }
}