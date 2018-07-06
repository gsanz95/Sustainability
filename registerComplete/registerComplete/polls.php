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
include "../registerComplete/navbar.php";

// Variables
$questionErr = $optionErr = "";
$question = "";
$option = array();

// Check if page has been filled
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["question"]))
    {
        $questionErr = "Please enter a question for the poll";
    } else {
        $question = $_POST["question"];
    }
    if (empty($_POST["answer"]))
    {
        $optionErr = "Please enter at least one option";
    } else {
        $choices= $_POST["answer"];
    }
}
?>

<h1 > Create a poll </h1 >
<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post" >
    <fieldset id = "poll-body" >

        Question: <input type = "text" name = "question" required>
        <br >
            Option: <input type = "text" name = "answer[]" required/>
            <br >
    </fieldset >
<input type = "button" id = "add-opt" value = "Add Another Option" />
<input type = "submit" >
</form >
<br>
</body >
</html >

<?php
require "../scripts/pollcreator.php";

// When the page is filled, create poll
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create poll
    $choiceNr = count($_POST["answer"]);
    $poll_id = createPoll($_SESSION["id"], $_POST["question"], choiceNr);

    // Insert choices into tables
    if($poll_id != NULL) {
        $choice_result = insertChoices($poll_id, $choiceNr, $choices);
        if($choice_result) {
            echo "<h2>Poll #" . $poll_id . " has been Created!</h2>";
        }else
        {
            echo "<h2>Poll #" . $poll_id . " choice creation has FAILED!</h2>";
        }
    }
    else {
        echo "Poll creation FAILED! :(<br>";
    }
}
?>