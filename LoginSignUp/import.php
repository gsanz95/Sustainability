<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 8:39 PM
 */

$host = 'sustainability.cpnngrjylxoa.us-east-2.rds.amazonaws.com';
$user = 'root';
$password = 'password123';

//mysql connection is created here

$mysql = new mysqli($host,$user,$password);
if($mysql -> connect_errno)
{
    printf("Connection failed: %s\n", $mysql->connect_error);
    die();
}

//create the accounts database
if( !$mysql -> query('CREATE DATABASE accounts') ) {
    printf("Error message: %s\n", $mysql->error);
    }




//this creates the users table with all of the fields
$mysql -> query('
CREATE TABLE `accounts`.`users`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR (50) NOT NULL,
    `email` VARCHAR (100) NOT NULL,
    `password` VARCHAR (100) NOT NULL,
    `hash` VARCHAR (32) NOT NULL,
    `active` BOOL NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
  );') or die ($mysql -> error);


?>