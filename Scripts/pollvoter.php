<?php

require "../registerComplete/database.php";

if($_SESSION['logged_in'] == false)
{
    header("Location: ./home.php");
}

echo "Pollvoter accessed";

$vote_query = "UPDATE choice" . $_POST['answer'] . " SET vote_nr = vote_nr + 1 where poll_id = '". $_POST['poll_id'] ."'";

$voteSuccess = mysqli_query($conn, $vote_query);

if ($vote_query)
{
    header("Location: ../registerComplete/polls.php");
}
else {
    echo "<h2>Voting failed!!</h2>";
}



/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/11/2018
 * Time: 6:50 PM
 */
