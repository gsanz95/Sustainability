<?php
session_start();
if(isset($_GET['id'])){
    require "../registerComplete/database.php";

    $event_id = $_GET['id'];
    $attendee = $_SESSION['id'];
    $attendee_query = "SELECT * FROM attendees WHERE event_id='$event_id' AND user_id='$attendee'";
    $attendee_obj = mysqli_query($conn, $attendee_query);

    if(!$attendee_obj){

    $join_query = "INSERT INTO attendees(event_id, user_id, response) VALUES ('$event_id','$attendee','1')";
    $join_obj = mysqli_query($conn, $join_query);

    ob_start();
    header("Location: ../registerComplete/eventpage.php?event_id=$event_id");
    ob_end_flush();
    }else{
        ob_start();
        header("Location: ../registerComplete/eventpage.php?event_id=$event_id");
        ob_end_flush();
    }
}else{
    ob_start();
    header("Location: ../registerComplete/events.php");
    ob_end_flush();
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 8/8/2018
 * Time: 7:30 PM
 */