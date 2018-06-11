<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 10:07 PM
 */

//Displays all of the error messages

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <?php include 'css/css.html'; ?>
</head>
<a>
<div class=""form">
    <h1>Error</h1>
    <p>
        <?php
        if(isset($_SESSION['message']) AND !empty($_SESSION['message'])):
            echo $_SESSION['message'];
        else:
            header( "location: index.php");
        endif
        ?>
    </p>
<a href="index.php><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
