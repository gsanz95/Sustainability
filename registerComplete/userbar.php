<?php
if(!isset($_SESSION))
{
session_start();
}
?>

<!DOCTYPE html>
<html >
<head>
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");


    window.onclick = function(event) {
        if(!event.target.matches('.dropbtn3')) {
            var dropdowns=document.getElementsByClassName("dropdown-content1");
            var i;
            for (i=0; i< dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if(openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }}




    function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("show2");


    window.onclick = function(event2) {
        if(!event2.target.matches('.dropbtn2')) {
            var dropdowns2=document.getElementsByClassName("dropdown-info2");
            var i;
            for (i=0; i< dropdowns2.length; i++) {
                var openDropdown1= dropdowns2[i];
                if(openDropdown1.classList.contains('show2')) {
                    openDropdown1.classList.remove('show2');
                }
            }
        }}
    }

    </script>

    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        body{       font: 16px sans-serif;

        }
        .user {
            width: 250px; /* this is needed */
            height: 100%;
            padding: 20px;
            position: fixed; /* this is needed */
            top: 0;
            float: left;
        }

        .avatar{
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .dropbtn3 {
            background-color: #3498DB;
            color: white;
            width: 200px;
            padding: 16px;
            font-size 16px;
            border: none;
            cursor: pointer;
            display: inline-block;
        }
        .dropbtn3:hover, .dropbtn3:focus {
            background-color: #2980B9;
        }



        .dropbtn2 {
            background-color: #3498DB;
            color: white;
            width: 200px;
            padding: 16px;
            font-size 16px;
            border: none;
            cursor: pointer;
        }
        .dropbtn2:hover, .dropbtn2:focus {
            background-color: #2980B9;
        }

        .dropdown {
                     position: relative;
                     display: inline-block;
                 }

        .dropdown2 {
            position: relative;
            display: inline-block;
        }

        .dropdown-content1 {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 200px;
            overflow: auto
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content1 a {
            color:black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content1 a:hover {background-color: #ddd}

        .show{display:block;}


        .dropdown-info2 {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 200px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-info2 a {
            color:black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-info2 a:hover {background-color: #ddd}

        .show2{display:block;}

        .mainbutton {
            background: none ;
            border: none;
            color: black;
            padding: 0;
            font-size: 25px;
        }

        .menubtn {
            background-color: #3498DB;
            height: auto;
            color: white;
            width: 200px;
            padding: 16px;
            font-size 16px;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }


        ir {
            border: solid black;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
        }
        .down2 {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }






    </style>

</head>
<body>


<div class="user" style="border:2px solid #cecece; border-radius: 15px; background-color: #B8DFF6">

    <a class=mainbutton href="./home.php">RCYCLE</a>
    <br>
    </br>




     <?php if(isset($_SESSION['user'])): ?>

         <img src="avatar.png" alt="Avatar" width=100 height= 100>

         <hr style="border:1px solid #cecece;">
    <b>
        <?php echo 'Logged in as: '?>
    </b>
    <br>
       <?php echo  $_SESSION['first_name'] ," ",$_SESSION['last_name'];?>
    </br>
     <?php  $id = $_SESSION['id'] ?>
     <br>
    </br>

     <div class = "dropdown">
         <button   onclick="myFunction()" class="dropbtn3">My Information &nbsp<ir class ="down2"></ir></button>
        <div id="myDropdown" class="dropdown-content1">

            <a href="./userprofile.php?<?php echo '?id='.$id; ?>" class="text" style="color: #323232;">My profile</a>

         <a href="./userposts.php?<?php echo '?id='.$id; ?>" class="text" style="color: #323232;">My posts </a>

         <a href="#" class="text"  style="color: #323232;">My polls</a>

         <a href="#" class="text"  style="color: #323232;">My events</a>



</div>
     </div>




    <?php else: ?>
    <a class="menubtn" href="./register.php">Sign up</a>
    <a class="menubtn" href="./login.php">Login</a>
     <?php endif; ?>

    <div class = "dropdown2">
        <button onclick="myFunction2()" class="dropbtn2">Community &nbsp  <ir class ="down2"></ir></button>
        <div id="myDropdown2" class="dropdown-info2">

            <a href="postdetail.php">Forums</a>
            <a class="dropdown-item" href="events.php">Events</a>
            <a class ="dropdown-item" href="polls.php">Polls</a>
            <a class ="dropdown-item" href="createpost.php">Create post</a>
        </div>

        <a class="menubtn" href="./forums.php" >Forum</a>

        <a class="menubtn" href="./events.php">Events</a>

        <a class="menubtn" href="./polls.php">Polls</a>

        <a class="menubtn" href="./about.php">About</a>





    </div>
    <?php if(isset($_SESSION['user'])): ?>
    <a class="menubtn" href="./logout.php">Logout</a>
    <?php endif; ?>

</div>
 </body>
 </html>