<?php

include "../registerComplete/navbar.php";
require "../scripts/eventgetter.php";

// Check if logged in
if(!isset($_SESSION))
{
    session_start();
}
if($_SESSION['logged_in'] == false)
{
    header("Location: ./login.php");
}

echo "<div class='container-fluid pl-2'>";

$event_table = getNewestEvents();

//No events available
if($event_table == null)
{
    echo "<h2>No events were found at this time.</h2>";
}
else {
    echo "<div><h1>Events</h1><br></div>";

    echo "<form action='./createevent.php'><input class='btn btn-primary' type='submit' name='submit' value='Create An Event' aria-label='Create an Event button'></form>";
    printEvents($event_table);

}
echo "</div>";
?>
