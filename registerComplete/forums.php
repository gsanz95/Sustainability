
<?php
include "./userbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include "database.php";
    ?>

    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        body{       font: 16px sans-serif;

                                          }
        .container {
            width: 900px; /* this is needed */
            height: 100%;
            padding: 20px;
            position: relative; /* this is needed */
            margin-left: auto;  /* this is needed */
            margin-right: auto;
            margin-top: auto;
            left: 0; /* this is needed */
            right:0; /* this is needed */
            top: 0; /* this is needed */
            bottom: 0; /* this is needed */

        }
        .alignRight {
            float: right;
        }

    </style>
</head>

<body>


    <div class="container" style="border:2px solid #cecece; border-radius: 15px;">

        <?php $result = mysqli_query($conn,"SELECT posts.post_id as id, posts.post_date as time,posts.post_subject as subject ,UNIX_TIMESTAMP() - posts.post_date as date,users.first_name as first, users.last_name as last FROM posts LEFT JOIN users ON posts.user_id = users.id order by post_id DESC")or die("Could not execute query: " . mysqli_error($conn));
        if (!$result) {
            echo "The post could not be displayed, error";
        }
        elseif(mysqli_num_rows($result) == 0){
            echo "There are no new posts";
        }else { ?>
        <div class="row">
            <div class="col-md-10">

                <h1 class="page-header">
           Posts
           <small></small>
                </h1>
                <hr style="border:1px solid #cecece;">
            </div>
        </div>
     <?php  while($row = mysqli_fetch_assoc($result)){
           $id = $row['id'];
           $subject = $row['subject'];
           $date =  (int)$row['time'];
           $full_name =  $row['first']." " .$row['last'];

         $comment_query = mysqli_query($conn,"SELECT COUNT(*) as total_comments FROM comments where comments.post_id = $id") or die("Could not execute query: " . mysqli_error($conn));
              $num_comment = mysqli_fetch_assoc($comment_query);
         $media_query =  mysqli_query($conn,"SELECT COUNT(*) as media FROM mediatable where mediatable.post_id = $id") or die("Could not execute query: " . mysqli_error($conn));
                $num_media = mysqli_fetch_assoc($media_query);
           ?>
                <div class="row">
                    <div class="col-md-10">
                <h2>
                    <a href="postdetail.php<?php echo '?id='.$id; ?>"><?php echo  $subject ?></a>
                </h2>
                <p class="lead" style="font-size: large">
                  Posted by <a href="home.php"><?php echo $full_name ?></a>
                </p>
                        <table style="width: 100%;">
                        <?php  $days = floor($row['date'] / (60 * 60 * 24));
                        $remainder = $row['date'] % (60 * 60 * 24);
                        $hours = floor($remainder/ (60 * 60));
                        $remainder = $remainder % (60 * 60);
                        $minutes = floor($remainder / 60);
                        $seconds = $remainder % 60;
                        if( $days > 0 or $hours > 0){ ?>
                            <tr><td><span class="glyphicon glyphicon-time"></span><?php echo date("F j, Y, g:i a", $date) ; ?></td>
                        <?php } elseif($days == 0 && $hours == 0 && $minutes == 0) {?>
                            <tr><td><span class="glyphicon glyphicon-time"></span><?php echo "A few seconds ago"?></td>
                        <?php }elseif($days == 0 && $hours == 0) {?>
                            <tr><td><span class="glyphicon glyphicon-time"></span><?php  echo $minutes.' minutes ago'?></td>

                    <?php }?>
                                <td class="alignRight" style="font-size: smaller" ><?php echo $num_media['media']. ' video/pic   ' .$num_comment['total_comments']. ' comments' ?></td></tr>
                        </table>
                        <hr style="border:1px solid #cecece;">
                </div>
                    <hr style="border:1px solid #cecece;">
                </div>



        <?php } ?>

 <?php   } ?>

  </div>
</body>
</html>
