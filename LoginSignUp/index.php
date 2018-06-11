<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 9:51 PM
 */

//Main page with sign up and log in buttons

require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //user is logging in
    if(isset($_POST['login']))
    {
        require 'login.php';
    }

    //user is registering
    elseif (isset($_POST['register']))
    {require 'createAccount.php';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign-Up/Login Form</title>
    <?php include 'css/css.html'; ?>
</head>

