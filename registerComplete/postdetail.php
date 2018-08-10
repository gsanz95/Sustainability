  <?php
  //if section varaible is set
    if(!isset($_SESSION))
        {
            //start session
            session_start();
        }
        //include nav bar script and data base
    include "database.php";
    include "navbar.php";
    include "userbar.php";
    
    //post comment function.
    if(isset($_POST['comment'])) {
        $comment_content = $_POST['comment_content'];
        $user_id = $_SESSION['id'];
        $post_id = $_GET['id'];

        $query = "INSERT into `comments` (post_id, user_id, com_content, com_date )
                  VALUES ('$post_id','$user_id','$comment_content','" . strtotime(date("Y-m-d h:i:sa")) . "')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($result) {
            header("Refresh:0");
        }
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


        <?php
        $post_id = '';
        // the post is clicked
        if( isset( $_GET['id'])) {
            //set post id.
            $post_id = $_GET['id'];
        }

        $m_id = $m_name = $m_type = "";

        //sql get post.
        $post_query = mysqli_query($conn,"SELECT *,UNIX_TIMESTAMP() - post_date as date FROM posts WHERE post_id = $post_id") or die("Could not execute query: " . mysqli_error($conn));
        if (!$post_query) {
            echo "The post could not be displayed, error";
        }
        elseif(mysqli_num_rows($post_query) == 0){
            echo "There are no new posts";
        }else {
            $post_row = mysqli_fetch_assoc($post_query);
            $user_id = $post_row['user_id'];
            $user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id") or die("Could not execute query: " . mysqli_error($conn));
            if (!$user_query) {
                echo "Unexpected error";
            } elseif (mysqli_num_rows($user_query) == 0) {
                echo "User of the post not found";
            }
            else{

        //check if there is a media file #abdul&#andy
        $media_query = mysqli_query($conn, "SELECT * FROM mediatable WHERE post_id = $post_id") or die("Could not execute query: " . mysqli_error($conn));
        if(mysqli_num_rows($media_query) > 0){

            //information about file #abdul&#andy
            $m_result = mysqli_fetch_assoc($media_query);
            $m_id = $m_result['media_id'];
            $m_name = $m_result['media_name'];
            $m_type = $m_result['media_type'];
            //get the file from the system.
        }
        // get neccessary informatiion need for page
                 $user_row = mysqli_fetch_assoc($user_query);
                 $id = $post_row['post_id'];
                 $post_content = $post_row['post_content'];
                 $subject = $post_row['post_subject'];
                 $date =  (int)$post_row['post_date'];
                 $full_name =  $user_row['first_name']." " .$user_row['last_name'];?>
                 <!-- row div -->
                 <!-- row div -->
             <div class="row">
                <div class="col-md-10">
                    <h3>
                        <span style="font-size: 20px" ><?php echo  $subject ?></span>
                    </h3>
                   <h5>
                    <span style="font-size: 14px">
                        <?php echo $post_content; ?></span></h5>

                        <?php if( $m_type == "img"){
                            $image_file_path = "../uploads/" . $m_name;?>
                            <hr style="border:1px solid #cecece;">
                           <img src = "<?= $image_file_path?>" width="500" height="300" >
                        <?php }
                        elseif($m_type == 'vid'){
                           $video_file_path = "../uploads/" . $m_name;?>
                            <hr style="border:1px solid #cecece;">
                             <video width="320" height="240" controls>
                                 <source src="<?= $video_file_path ?>" type="video/mp4"></video>

                       <?php  } ?>

                    <hr style="border:1px solid #cecece;">

                    <p  style="font-size: 14px">
                        <span class="glyphicon glyphicon-user "></span><?php echo " ",$full_name ?>
                    </p>

                   
                    <?php   // function to display date.
                    $days = floor($post_row['date'] / (60 * 60 * 24));
                    $remainder = $post_row['date'] % (60 * 60 * 24);
                    $hours = floor($remainder/ (60 * 60));
                    $remainder = $remainder % (60 * 60);
                    $minutes = floor($remainder / 60);
                    $seconds = $remainder % 60;
                    if($days > 0 or $hours > 0){ ?>
                        <p style="font-size: 14px"><span class="glyphicon glyphicon-time"></span><?php echo " ",date("F j, Y, g:i a",$date); ?></p>

                    <?php } elseif($days == 0 && $hours == 0 && $minutes == 0) {?>
                        <p style="font-size: 14px"><span class="glyphicon glyphicon-time"></span><?php echo "A few seconds ago"?></p>

                    <?php }elseif($days == 0 && $hours == 0) {?>
                        <p style="font-size: 14px"><span class="glyphicon glyphicon-time"></span><?php  echo $minutes.' minutes ago'?></p>

                    <?php }?>
                    <?php if(isset($_SESSION['user_lvl']) && $_SESSION['user_lvl'] == 1){ ?>
                        <div class='btn-group'>
                            <a class="btn btn-light" style="background-color: #B8DFF6;" href="#" role="button">Delete post</a>
                        </div>

                    <?php  }?>
                  </div>
                 </div>
                 </div>
            <?php } ?>
        <?php } ?>
  <div class = "comment" style="border:2px solid #cecece; border-radius: 15px;">
                
		<!-- abdul&andy-->
		<div class="morale">
        <button style="font-size: 25px"><i class=" like fa fa-thumbs-o-up" style="font-size:23px"></i></button>
               <button style="font-size: 30px"><i class=" dislike fa fa-thumbs-o-down" style="font-size:29px"></i> </button>
               <!--<button style="font-size:24px"> <i class="material-icons">share</i></button>-->
               <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle share" type="button" data-toggle="dropdown"><i class="material-icons">share</i>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#" class="fa fa-facebook">acebook</a></li>
                      <li><a href="#" class="fa fa-twitter">twitter</a></li>
                      <li><a href="#" class="fa fa-google">oogle</a></li>
                    </ul>
                  </div>
		</div> <!--end of like&dislike&share div-->
		<h2 class="lead">
                      <a >Comments
                  </h2>
                  
               <?php 
               // if user is not logged in?
               if(!isset($_SESSION['user'])): ?>
                     <div class='btn-group'>
                      <a class="btn btn-light" style="background-color: #B8DFF6;" href="login.php" role="button">Login</a>
                       </div>
                           <?php echo "  or  "?>
                     <div class='btn-group' >
                         <a class="btn btn-light" style="background-color: #B8DFF6;" href="register.php" role="button">Register</a>
                     </div>
                      <?php echo "to comment"?>
                   <hr style="border:1px solid #cecece;">
                    
                     <?php 
                     //if user is logged in?
                     else: ?>
                     <!-- the post content -->
                   <form method="post">
                       <input type="hidden" name="id" value="<?php echo ""; ?>">
                       <textarea name="comment_content" rows="4" cols="104" style="text-align:center;" placeholder="Type your comment" required></textarea><br>
                       <input  class="btn btn-light" type="submit" name="comment" style="background-color: #B8DFF6;">
                   </form>
                   <hr style="border:1px solid #cecece;">
                     <?php endif;
                     //get all comment associated with their commenters(user)  id.
                     $comment_query = mysqli_query($conn,"SELECT *,UNIX_TIMESTAMP() - com_date as date  FROM comments LEFT JOIN users on users.id = comments.user_id where comments.post_id = $post_id order by comment_id DESC") or die("Could not execute query: " . mysqli_error($conn));
                   if (!$comment_query) {
                    echo "The post could not be displayed, error";
                  }
                   elseif(mysqli_num_rows($comment_query) == 0){
                       echo "There are no new comments";
                   }
                   else{
                   while($comment_row = mysqli_fetch_array($comment_query)){
                      $comment_id = $comment_row['comment_id'];
                      $comment_content = $comment_row['com_content'];
                      $comment_by = $comment_row['first_name']. " ". $comment_row['last_name'];
                      $comment_date = (int)$comment_row['com_date']; ?>
                      <h5>
                      <span style="font-size: 14px">
                        <?php echo $comment_content; ?></span></h5>
                       <br>
                       <p  style="font-size: 12px">
                           <span class="glyphicon glyphicon-user "></span><?php echo " ",$comment_by ?>
                       </p>
                       
                       <?php  
                       // data function
                       $days = floor($comment_row['date'] / (60 * 60 * 24));
                       $remainder = $comment_row['date'] % (60 * 60 * 24);
                       $hours = floor($remainder/ (60 * 60));
                       $remainder = $remainder % (60 * 60);
                       $minutes = floor($remainder / 60);
                       $seconds = $remainder % 60;
                       if($days > 0 or $hours > 0){ ?>
                           <p style="font-size: 12px"><span class="glyphicon glyphicon-time"></span><?php echo " ",date("F j, Y, g:i a",$comment_date); ?></p>

                       <?php } elseif($days == 0 && $hours == 0 && $minutes == 0) {?>
                           <p style="font-size: 12px"><span class="glyphicon glyphicon-time"></span><?php echo "A few seconds ago"?></p>

                       <?php }elseif($days == 0 && $hours == 0) {?>
                           <p style="font-size: 12px"><span class="glyphicon glyphicon-time"></span><?php  echo $minutes.' minutes ago'?></p>

                       <?php }?>


                      <hr style="border:1px solid #cecece;">
                     <?php }?>
                  <?php }?>

              </div>
    </body>
    </html>
