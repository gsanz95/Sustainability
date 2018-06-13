<?php
/**
 * Created by PhpStorm.
 * User: andrewhernandez
 * Date: 6/9/18
 * Time: 9:48 PM
 */

//Database connection settings

$host = '18.218.22.129';
$user = 'root';
$pass = 'password123';
$db = 'accounts';
$mysql = new mysqli($host,$user,$pass) or die($mysql -> error);
if($mysql->mysqli_connect_error())
{
    echo 'fail';
}
else{
    echo 'success';
}