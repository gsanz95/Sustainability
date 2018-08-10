<?php
define('USER', 'root');
define('PASS', 'password123');
define('SERVER', 'sustainability.cpnngrjylxoa.us-east-2.rds.amazonaws.com:3306');
define('DBASE',"sus");
$conn = new mysqli(SERVER, USER, PASS,DBASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

