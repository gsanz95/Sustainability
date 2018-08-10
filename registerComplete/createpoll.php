<!DOCTYPE html >
<!-- jQuery Script: dynamically add more choices-->
<html lang = "en" >
<head >
    <meta charset = "UTF-8" >
    <title > Create a Poll </title >
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script >
    <script >
        $(document) . ready(
            function () {
                $("#add-opt") . click(
                    function () {
                        $("#poll-body") . append("Option: <input type=\"text\" name=\"answer[]\"/><br>");
                    });
            });
    </script >
</head >
<body>

<?php
include "./navbar.php";

// Check if logged in
if(!isset($_SESSION))
{
    session_start();
}
if($_SESSION['logged_in'] == false)
{
    header("Location: ./login.php");
}

?>

<h1 > Create a poll </h1 >
<form action = "../scripts/pollsscript.php" method = "post" >
    <fieldset id = "poll-body" >

        Question: <input type = "text" name = "question" required>
        <br >
        Option: <input type = "text" name = "answer[]" required/>
        <br >
    </fieldset >
    <input type = "button" id = "add-opt" value = "Add Another Choice" />
    <input type = "submit" >
</form >
<br>
</body >
</html >
