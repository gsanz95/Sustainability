<?php
if(!isset($_SESSION))
{
session_start();
}
$userid = $_GET['userid'];
include_once './functions.php';
include_once './database.php';
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        body{       font: 16px sans-serif;

        }
        .user {
            width: 250px; /* this is needed */
            height: auto;
            padding: 40px;
            position: fixed; /* this is needed */
            margin-top: auto;
            float: right;
            box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
        }

        .avatar{
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        psandesandf.{
            width: 250px; /* this is needed */
            height: 35%;
            padding: 40px;
            position: fixed; /* this is needed */
            right: 90%;
            box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
        }

    </style>
</head>
<body>
 <?php 
 
 ?>

<div class="user">
    <?php $obj = new page_functions;
    $userprofile = $obj->getUser($conn, $userid);?>
    <img src="avatar.png" alt="Avatar" width=100 height= 100>
    <div class="about">
    <hr>
     <p> Name-: <a href="#"><?php echo $userprofile['username'];?></a> </p>
     <p><?php echo "Number of Posts: ". $userprofile['postcount'];  ?></p>
     <p><?php echo "Number of Events: ". $userprofile['postcount'];  ?></p>
     <p><?php echo "Number of Polls: ". $userprofile['postcount'];  ?></p>
     <p>GOAL: make San Antonio better!</p>
     </div><!--end of about-->
    </div><!--end of user-->

  <!--  <div class="psandesandf">
    <div><p>popular events</p></div>
    <div><p>popular polls</p><div>
    <div><p>polpular forums</p></div>
    <div>-->
 </body>
 </html>