<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 6/13/2018
 * Time: 10:49 PM
 */
require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli -> query("SELECT * FROM users WHERE email = '$email'");

    if($result->num_rows ==0)
    {
        $_SESSION['message'] = "User with that email does not exist!";
        header("location: error.php");
    }
    else
    {
        $user = $result->fetch_assoc();
        $email = $user['email'];
        $first_name = $user['first_name'];

        $_SESSION['message']= "<p> Please check your email <span>$email</span>"
            . " for a confirmation link to complete your password reset!</p>";

        //sends registration link
        $to = $email;
        $subject = 'Password Reset Link (...)';
        $message_body = '
        Hello '.$first_name.',
        You have requested to reset your password!
        
        Please click the link below to reset your password!
        
        http://localhost/login-system/reset.php?email='.$email.'&hash='.$hash;

        mail($to, $subject, $message_body);
        header("location: success.php");

    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Reset your password!</title>
    <?php include 'css/css.html';?>
</head>

<body>
  <div class="form">
      <h1>Reset Your Password!</h1>
      <form action="forgotPass.php" method="post">
          <div class = "field-wrap">
              <label>
                  Email Address<span class="req">*</span>
              </label>
              <input type="email" required autocomplete="off" name="email"/>
          </div>
          <button class = "button button-block"/>Reset</button>
      </form>

  </div>

<script src = '' ></script>
<script src = '' ></script>
</body>
</html>
