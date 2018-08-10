<?php
// Variables
$servername = "localhost";
$db_username = "root";
$db_password = "password123";
$db_name = "rCycle";

// Creating a connection
$db_conn = new mysqli( $servername, $db_username, $db_password, $db_name);

// Check Connection
if($db_conn->connect_error)
{
    die("Connection Failed: " . $db_conn->connect_error);
}
else
{
   echo "Success";
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 6/9/2018
 * Time: 4:40 PM
 */
