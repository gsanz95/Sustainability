<?php
$userid = $_GET['userid'];
include_once './functions.php';
include_once './database.php';
$obj2 = new page_functions;
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
    <style>

body{       
    font: 16px sans-serif;

}

.sidenav {
    width: 350px;
    height:auto;
    position: fixed;
    margin-top:auto;
    right: 10px;
    box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
}
.polls{
    height: 25%;
}
.forums{
  height: 25%;
}
.events{
    height: 25%;
}
h3{
    text-align: center;
}
.rule{
    width: 70%;
}
.eventsinfo{
   text-align:left;
}
.closed{
    color:red;
}
</style>
</head>
<body>
<div class="sidenav">
<div class="polls">
<h3>popular polls</h3><br>
<a href="#">view more</a></div><hr class="rule"><!--end of polls-->
<div class="forums">
<h3>popular forums</h3><br>
<a href="#">view more</a>
</div><hr class="rule"><!--end of forums-->
<div class="events"> 
<h3>popular events</h3><br>
<?php 
$eventsinfo = $obj2->get_user_events($conn, $userid);?>
<div class="eventsinfo">
<p><?php echo $eventsinfo['name'];?> <a href="#"><span class="glyphicon glyphicon-exclamation-sign closed"></span></a><br>
<?php echo $eventsinfo['ends'] ?></p>
</div><!--end of eventsinfo-->
<hr>
<a href="#">view more</a>
</div><!--end of events-->
</div><!--end of sidenav-->
 </body>
 </html>