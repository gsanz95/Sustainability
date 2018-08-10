<?php

include "./userbar.php";

if(!isset($_SESSION))
{
    //start session
    session_start();
}
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
            .container {
    width: 900px; /* this is needed */
                height: 100%;
                padding: 30px;
                position: relative; /* this is needed */
                margin-left: auto;  /* this is needed */
                margin-right: auto;
                margin-top: auto;
                left: 0; /* this is needed */
                right:0; /* this is needed */
                top: 0; /* this is needed */
                bottom: 0; /* this is needed */

            }

            .comment{
    width: 900px; /* this is needed */
                height: 100%;
                padding: 20px;
                position: relative; /* this is needed */
                margin-left: auto;  /* this is needed */
                margin-right: auto;
                margin-top: 20px;
                left: 0; /* this is needed */
                right:0; /* this is needed */
                top: 0; /* this is needed */
                bottom: 0; /* this is needed */
            }

            /*abdul&andy like&dislike and share link*/
            .morale{
    display:grid;
    grid-template-columns: auto auto auto;
                border-bottom-style: solid;
                border-bottom-width: .5px;
            }
            /*abdul&andy */
            .fa-facebook {
    background: #3B5998;
    color: white;
}
            .fa-twitter {
    background: #55ACEE;
    color: white;
}

            .fa-google {
    background: #dd4b39;
    color: white;
}
            .like{
    width:50%;
    font-size: 40px;
                }
            .dislike{
    font-size:40px;
                width:50%;
            }
            .share{
    width:100%;
    background-color: gray;
                 height: 100%;
            }


        </style>
    </head>
    <body>
    <!-- main container -->
    <div class="container"  style="border:2px solid #cecece; border-radius: 15px;">
        <h2>Profile page</h2>
        <dl>
            <dt>Name:</dt>
            <dd><?php echo  $_SESSION['first_name'] ," ",$_SESSION['last_name']?></dd>
            <dt>Email:</dt>
            <dd><?php echo $_SESSION['user'] ?></dd>
        </dl>
    </div>
    </body>
</html>
