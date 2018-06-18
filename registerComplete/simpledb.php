<?php

/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 8:39 PM
 */


define('USER', 'root');
define('PASS', 'password123');
define('SERVER', 'sustainability.cpnngrjylxoa.us-east-2.rds.amazonaws.com:3306');
define('DBASE',"sus");
$conn = new mysqli(SERVER, USER, PASS,DBASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


//this creates the users table with all of the fields
$conn -> query('

CREATE TABLE `sus`.`users`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR (50) NOT NULL,
    `email` VARCHAR (100) NOT NULL,
    `password` VARCHAR (100) NOT NULL,
    `hash` VARCHAR (32) NOT NULL,
  PRIMARY KEY (`id`)
  );') or die ($conn -> error);

