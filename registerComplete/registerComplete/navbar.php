<?php
session_start();?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <style type="text/css">
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #B8DFF6;">
    <a class="navbar-brand" href="./home.php">RCYCLE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./home.php">Home</a>
            </li>
            <li class="nav-item dropdown" >
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Community</a>
                    <div class="dropdown-menu" style="background-color: #B8DFF6;">
                        <a class="dropdown-item" href="forumpage.php">Forums</a>
                        <a class="dropdown-item" href="events.php">Events</a>
                        <a class ="dropdown-item" href="polls.php">Polls</a>
                        <a class ="dropdown-item" href="createpost.php">Create post</a>
                </div>
        <li class="nav-item">
            <a class="nav-link" href="forumpage.php">Forum</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./events.php">Events</a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="./about.php">About</a>
            </li>
     </div>
       </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['user'])): ?>
            <li class = "nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION['user']; ?></a>
            </li>
        <li class = "nav-item">
            <a class="nav-link" href="./logout.php">Logout</a>
            </li>
        <?php else: ?>
        <li class = "nav-item">
            <a class="nav-link" href="./register.php">Sign up</a>
        </li>
        <li class = "nav-item">
            <a class="nav-link" href="./login.php">Login</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>