<!DOCTYPE html >
<!-- jQuery Script: dynamically add options-->
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
                    $("#poll-body") . append("<div class=\"row\">\n" +
                        "Option: <input type=\"text\" name=\"answer[]\"/>\n" +
                        "<br>\n" +
                        "</div>");
                });
        });
    </script >
</head >
<body>

<?php
require "database.php";

session_start();

// Variables
$questionErr = $optionErr = "";
$question = "";
$option = array();

// If page has been filled
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["question"]))
    {
        $questionErr = "Please enter a question for the poll";
    } else {
        $question = $_POST["question"];
    }
    if (empty($_POST["answer"]))
    {
        $optionErr = "Please enter at least an option";
    } else {
        $option= $_POST["answer"];
    }
}
?>

<h1 > Create a poll </h1 >
<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post" >
    <fieldset id = "poll-body" >

        Question: <input type = "text" name = "question" >
        <br >
        <div class="row" >
    Option: <input type = "text" name = "answer[]" />
            <br >
        </div >
    </fieldset >
<input type = "button" id = "add-opt" value = "Add Another Option" />
<input type = "submit" >
</form >
<br>
</body >
</html >

<?php
// Check values have been received
echo "<h2>Input Received:</h2>";
echo $question;
echo "<br>";
$arrlen = count($_POST["answer"]);
for($x = 0; $x < $arrlen; $x++) {
    echo $option[$x];
    echo "<br>";
}
?>