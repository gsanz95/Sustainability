<?php
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

require "./pollcreator.php";

// When the page is filled, create poll
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create poll
    $choiceNr = count($_POST["answer"]);
    $poll_id = createPoll($_SESSION["id"], $_POST["question"],$choiceNr);

    // Insert choices into tables
    if($poll_id != NULL) {
        $choice_result = insertChoices($poll_id, $choiceNr, $choices);
        if($choice_result) {
            echo "<h2>Poll #" . $poll_id . " has been Created!</h2>";
            ob_start();
            header("Location: ../registerComplete/polls.php");
            ob_end_flush();
        }else
        {
            echo "<h2>Poll #" . $poll_id . " choice creation has FAILED!</h2>";
        }
    }
    else {
        echo "Poll creation FAILED! :(<br>";
    }
}
/** Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/11/2018
 * Time: 3:52 PM
 */
