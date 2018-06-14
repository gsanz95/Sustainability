<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 9:48 PM
 */

//Database connection settings

$host = 'sustainability.cpnngrjylxoa.us-east-2.rds.amazonaws.com';
$user = 'root';
$pass = 'password123';
$db = 'accounts';
$mysql = new mysqli($host,$user,$pass,$db) or die($mysqli -> error);
?>