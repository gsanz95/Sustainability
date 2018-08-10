<?php

// Prepare and create poll
function createPoll($user_id, $question, $choiceNr)
{
    require "../registerComplete/database.php";
    require "./nameGenerator.php";
    $poll_id = genName("poll");
    $poll_query = "INSERT INTO poll (poll_id, user_id, q1,number_of_choices) VALUES ('" . $poll_id . "','" . $user_id . "','" . $question . "','" . $choiceNr . "')"; // TEMPORARY USER_ID

    $poll_result = mysqli_query($conn, $poll_query);
    if ($poll_result)
    {
        return $poll_id;
    }else
        return NULL;

}

// Insert choices into their respective choice table
function insertChoices($poll_id, $choiceNr, $choiceArr)
{
    require "../registerComplete/database.php";
    $x = 0;
    while ($x < $choiceNr) {

        //Check if number of choice tables is enough
        $check_query = "SELECT * FROM information_schema.tables WHERE table_schema = 'sus' AND table_name = 'choice" . ($choiceNr - $x)."' LIMIT 1";
        $table_exists = mysqli_query($conn, $check_query);
        $rowNr = mysqli_num_rows($table_exists);

        // If not enough, create highest choice table needed
        if($rowNr == 0)
        {
            $table_query = "CREATE TABLE choice". ($choiceNr - $x) ." LIKE choice1";
            $table_creation = mysqli_query($conn,$table_query);
        }

        echo $choiceArr[$x];
        echo "<br>";

        // Enter answer into choice table
        $choice_query = "INSERT INTO choice" . ($x+1) . " (poll_id, choice, vote_nr) VALUES ('" . $poll_id . "','" . $choiceArr[$x] . "','0')";
        $choice_result = mysqli_query($conn, $choice_query);

        if (!$choice_result)
        {
            return FALSE;
        }

        $x++;
    }

    return TRUE;
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/6/2018
 * Time: 1:13 PM
 */
