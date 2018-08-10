<?php

require './database.php';
include './navbar.php';

if(!isset($_GET['event_id'])){
    echo "<h1>No event has been selected!</h1>";
} else {

    $event_query = "SELECT * FROM events WHERE event_id='" . $_GET['event_id'] . "'";
    $event_obj = mysqli_query($conn, $event_query);
    $event_row = mysqli_fetch_array($event_obj,MYSQLI_ASSOC);

    $author_query = "SELECT * FROM users WHERE id='" . $event_row['event_author_id'] . "'";
    $author_obj = mysqli_query($conn, $author_query);
    $author_row = mysqli_fetch_array($author_obj,MYSQLI_ASSOC);

    $attend_query ="SELECT * FROM attendees WHERE event_id='" . $_GET['event_id'] ."'";
    $attend_obj =mysqli_query($conn, $attend_query);
    $attend_row =mysqli_fetch_all($attend_obj,MYSQLI_ASSOC);


    // Debug
    //print_r($event_row);

    echo "<head><meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta charset='UTF-8'>
    <title>" . $event_row['event_name'] . "</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='w-100'>
                <h1>" . $event_row['event_name'] . "</h1>
                <form action='../scripts/eventjoin.php'><button class='btn btn-primary btn-lg' type='submit' name='id' value='". $_GET['event_id'] ."' aria-label='Join Event'>Join</button></form>
                <span class='h4'>By:&nbsp;</span><span class='h5'>" . $author_row['first_name'] . "&nbsp;". $author_row['last_name'] ."</span>
            </div>
            <div class='content border border-dark'>
                <p><span class='h5'>Where:&nbsp;</span>". $event_row['event_location_name'] .
                "<p><span class='h5'>Address:&nbsp;</span>". $event_row['event_location_address']. "&nbsp;" . $event_row['event_location_zip'] ."&nbsp;" . $event_row['event_location_city'] . ", ". $event_row['event_location_state'] ."
                <p><span class='h5'>Date & Time:&nbsp;</span>". $event_row['event_startdatetime'] ."<br><br>
                <h5>Description:</h5><p>". $event_row['event_description'] ."</p>
                <p><span class='h5'>Type:&nbsp;</span>". $event_row['event_type'] ."</p>
                <p><span class='h5'>Attendees: </span>";

    // Print attendees
    $attendee_str = "";
    foreach ($attend_row as $attendee) {
        $attendee_query = "SELECT * FROM users WHERE id='". $attendee['user_id'] ."'";
        $attendee_obj = mysqli_query($conn, $attendee_query);
        $attendee_row = mysqli_fetch_row($attendee_obj);
        $attendee_str = $attendee_str . ", " . ucfirst($attendee_row[1]) . "&nbsp;" . ucfirst($attendee_row[2]);
    }

    $attendee_str = substr($attendee_str, 2);

             echo $attendee_str ,"</p>
            </div>
        </div>
    </div>
</body>
</html>";
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/24/2018
 * Time: 4:57 PM
 */
