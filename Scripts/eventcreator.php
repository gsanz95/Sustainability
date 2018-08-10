<?php
session_start();
require '../registerComplete/database.php';
require './nameGenerator.php';

$id = genName('event');

$author = $_SESSION['id'];

$creation_query = makeQuery($author, $id);

//Make the author the first attendee (can change)
$attend_query = "INSERT INTO attendees (event_id, user_id, response) VALUES('$id','$author','1')";
$attend_obj = mysqli_query($conn,$attend_query);


// Send query to database
$event_obj = mysqli_query($conn,$creation_query);
if(!$event_obj){
    echo 'Event creation Failed!';
}else{
    echo 'Event Created!';
    ob_start();
    header("Location: ../registerComplete/events.php");
    ob_end_flush();
}

//Debug
foreach ($_POST as $key => $value) {
    echo "<br>";
    echo $key;
    echo "&nbsp; => &nbsp;";
    echo $value;
    echo "<br>";
}
echo "id &nbsp; => &nbsp;";
echo $id;
echo "<br>";
echo "Query => ". $creation_query;
echo "Author =>". $author;

// Create query for all the values
function makeQuery($event_author, $event_id){
    if($event_author == NULL){
        return false;
    }
    else {
        $event_query = "INSERT INTO `events` (`event_id`, `event_creation_datetime`, `event_startdatetime`, `event_enddatetime`, `event_location_name`, `event_location_address`, `event_location_city`, `event_location_state`, `event_location_zip`, `event_author_id`, `event_name`, `event_description`, `event_type`) VALUES ('"
            . $event_id . "', CURRENT_TIMESTAMP, '" . $_POST['event_startdatetime'] . "', ";

        if (empty($_POST['event_enddatetime'])) {
            $event_query = $event_query . "NULL, ";
        } else {
            $event_query = $event_query . "'" . $_POST['event_enddatetime'] . "', ";
        }

        $event_query = $event_query . "'" . $_POST['event_location_name'] . "', ";

        if (empty($_POST['event_location_address'])) {
            $event_query = $event_query . "NULL, ";
        } else {
            $event_query = $event_query . "'" . $_POST['event_location_address'] . "', ";
        }

        if (empty($_POST['event_location_city'])) {
            $event_query = $event_query . "NULL, ";
        } else {
            $event_query = $event_query . "'" . $_POST['event_location_city'] . "', ";
        }

        $event_query = $event_query . "'" . $_POST['event_location_state'] . "', ";

        if (empty($_POST['event_location_zip'])) {
            $event_query = $event_query . "NULL, ";
        } else {
            $event_query = $event_query . "'" . $_POST['event_location_zip'] . "', ";
        }

        $event_query = $event_query . "'" . $event_author . "', ";
        $event_query = $event_query . "'" . $_POST['event_name'] . "', ";


        if (empty($_POST['event_description'])) {
            $event_query = $event_query . "NULL, ";
        } else {
            $event_query = $event_query . "'" . $_POST['event_description'] . "', ";
        }

        $event_query = $event_query . "'" . $_POST['event_type'] . "')";
    }
    return $event_query;
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/22/2018
 * Time: 2:15 PM
 */
