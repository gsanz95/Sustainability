<?php

// Retrieves top 10 events with a query and returns assoc array
function getNewestEvents()
{
    require "./database.php";
    $newest_event_query = "SELECT * from events ORDER BY event_creation_datetime DESC limit 10";
    $event_obj = mysqli_query($conn, $newest_event_query);
    $event_table = $event_obj->fetch_all(MYSQLI_ASSOC);
    //print_r($event_table);
    return $event_table;
}

// Will take in an event table and print its content
function printEvents($event_table)
{
    foreach ($event_table as $event)
    {
        echo "<div class='w-100'>";
        echo "<a href='../registerComplete/eventpage.php?event_id=". $event['event_id'] ."'><h3>". $event['event_name'] ."</h3></a>";
        echo "<p>". $event['event_description'] . "</p>";
        echo "<p>Date & Time: ". $event['event_startdatetime'] ."</p>";
        echo "<p>Created by: ". "Insert Author Name" . "</p>";
        //print_r($event);
        echo "</div>";
    }
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/21/2018
 * Time: 1:38 PM
 */
