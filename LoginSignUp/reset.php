<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 6/13/2018
 * Time: 11:18 PM
 */

require 'db.php';
session_start();

//checks to see if email and hash variable aren't empty

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);

    $result = $mysqli-> query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");

    if($result->num_rows == 0)
    {
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");

    }
}
else
{
    $_SESSION['message'] = "Sorry, verifacation failed, try again!";
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <?php include 'css/css.html'; ?>
</head>

<body>
  <div class ="form">
      <h1>Choose Your New Password</h1>
      <form action="reset_password.php" method="post">
          <div class="field-wrap">
              <label>
                  New Password<span class "req">*</span>
              </label>
              <input type="password"required name="newpassword" autocomplete="off"/>
          </div>

          <div class="field-wrap">
              <label>
                  Confirm New Password<span class="req">*</span>
              </label>
              <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>

          <input type="hidden" name="email" value="<?= $email ?>">
          <input type="hidden" name="hash" value="<?= $hash ?>">

          <button class="button button-block"/>Apply</button>
      </form>
  </div>

<script src=""></script>
<script src=""></script>
</body>
</html>
