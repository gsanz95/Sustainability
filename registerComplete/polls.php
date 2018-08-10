<?php
include "./navbar.php";
require "./database.php";
include "../scripts/pollgetter.php";

if(!isset($_SESSION))
{
    session_start();
}
if($_SESSION['logged_in'] == false)
{
    header("Location: ./login.php");
}


$polls_arr = getNewestpolls($conn);

if($polls_arr == null)
{
    echo "<h2>No polls were found at this time.</h2>";
}
else {

    echo "<div><h1>Polls</h1><br></div>";

    echo "<form action='./createpoll.php'><input type='submit' name='submit' value='Create new poll'></form>";

    while ($poll_table = mysqli_fetch_array($polls_arr, MYSQLI_NUM)) {
            echo "<div class='col-sm-4'><form action='../scripts/pollvoter.php' method='post'><br>";

        printRow($poll_table,$conn);

        echo "<input type='submit' value='Submit'><br></form></div>";
    }
}
?>
