<?php

// Retrieves a question with a query and returns the object
function getNewestPolls($conn)
{
    $newest_poll_query = "SELECT * from poll ORDER BY createdat DESC limit 10";
    $polls_arr = mysqli_query($conn, $newest_poll_query);
    return $polls_arr;
}

// Will take in a row from the poll table and print out choices
function printRow($row,$conn)
{
    echo "<h5>Question: " . $row[2] . "</h5>";
    echo "<input type='hidden' name='poll_id' value='" . $row[0] . "'/>";

    for($i = 0; $i < $row[3]; $i++)
    {
        $choice_query = "SELECT * FROM choice" . ($i+1) . " WHERE poll_id = '" . $row[0] . "'";
        $choice_obj = mysqli_query( $conn, $choice_query);
        $choice_arr = mysqli_fetch_array($choice_obj,MYSQLI_NUM);
        echo "<input type='radio' name='answer' value='". ($i+1) ."'/>" . $choice_arr[1] . "<span style='float: right;'> Votes: " . $choice_arr[2] . "</span><br>";
    }
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/11/2018
 * Time: 6:24 PM
 */