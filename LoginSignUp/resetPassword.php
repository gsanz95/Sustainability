<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 6/13/2018
 * Time: 11:34 PM
 */
require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($_POST['newpassword']== $_POST['confirmpassword'])
    {

        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);

        $sql = "UPDATE users SET password =' $new_password', hash='$hash' WHERE email='$email'";

        if($mysqli->query($sql))
        {
            $_SESSION['message'] = "Your password has been successfully reset!";
            header("location: success.php");
        }
    }
    else
    {
        $_SESSION['message'] = "The two passwords you have entered do not match. Try again!";
        header("location: error.php");
    }
}