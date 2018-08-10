<?php 
include_once './functions.php';
include_once './database.php';
include('./ratingScript.php');
include_once './serverQuery.php';
$obj = new page_functions;
?>
<!DOCTYPE html>
<html>
<head>
    <style> 
    .mkmk{

    }
   .body{
    background-color:lightgrey;
   }
    /*
        share style

    */
    .dropbtn{
        position:relative;
        left:50%;
        margin-top: 5px;
        up:100%;
       color:grey;
       padding:16px;
       font-size:16px;
       border:none;
       display:inline-block;
    }
    .get_comments:hover{
       text-decoration:underline;
    }
    .dropdown-content{
        display:none; 
        position:absolute;
        background-color:grey;
        min-width: 160px;
        box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
     .dropdown-content a{
      color:black;
      padding:12px 16px;
      text-decoration:none;
      display:block;
     } 

     .dropdown{
         position:relative;
         bottom: 20px;
     }

     .dropdown-content a:hover{background-color:white;}
     .dropdown:hover .dropdown-content{display:block;}
     .dropdown:hover .dropbtn{background-color:none;}
   /**
     main menu style 
   */
    .main{
       
        width:600px;
        height:100%;
        /*border-style: solid;
        border-color: red;*/
        position:relative;
        left:30%;

    }
     /**
        video div style 
     */
    .video{
        display:block;
        margin-left:auto;
        margin-right:auto;
    }


    .post{
         background-color:white;
        /*border-style:solid;
        /border-color:grey;
        //border-width:.5px;*/
        margin:40px; 
        box-shadow: 2px 2px 6px grey,  2px 2px 6px grey, 2px 2px 6px grey, 2px 2px 6px grey;
    }
    .choice{
       display:grid;
       grid-template-columns: auto auto auto;

    }
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
    i {
        color:blue;
    }
  .fa{
   font-size: 1.7em;
  }

    .fa-thumbs-down, .fa-thumbs-o-down{
          transform:rotateY(180deg);
    }

    .like {
        position:relative;
        left: 16.7%;
    }
    .fa-share{
      position:relative;
      down:100%;
    }
    </style>
    <script>
    </script>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./simple.js"></script>
   <!-- <script src="./ratingScript.js"></script>-->
    
</head>
<body class="body">
<div class="main">
<?php $postarray = $obj->post_sql_query($conn);?>
<?php
$int = 0;
foreach($postarray as $post){?>
<div class="post">
<div class="subject">
<p><?php echo "subject: " . $post['subject'] ?></p>
</div><!--end of subject-->
<div class="posttext">
<p><?php echo $post['content']?></p>
</div><!--end of posttext-->
<?php
if(array_key_exists('m_name', $post)){ 
    $file_path = "./files/Raindrops_Videvo.mp4"
    ?>
    <div class="media">
   <?php $type = "img";
 if($post["m_type"] != 'r'){
 $type = "vid2";?>
 <p> this is image </p>
 <?php }else{?>
<video class="video" width="500px" height="100%" controls autoplay>
				<source src=<?php echo $file_path?> type="video/mp4">
			 this video is not supported</video>
 <?php } ?>
</div><!--end of media content--> <?php }
?>
<hr>
<p  style="font-size: 14px">
Posted by
                        <span class="glyphicon glyphicon-user "></span><a href="#"><?php echo " " . $post['full_name'] ?></a>
                    </p><!-- end of user post-->
                    <p style="font-size: 14px"><span class="glyphicon glyphicon-time"></span><?php  echo $post['date']?></p>


<?php //check if content is video of img?>
<hr>
<div class="choice">
<div class="likediv">
  <i <?php if(check_like($conn, $post['post_id'], 66)){?>
   class="fa fa-thumbs-up like-btn like"
  <?php }else{?>
 class="fa fa-thumbs-o-up like-btn like"
  <?php }?>
  data-id="<?php echo $post['post_id']?>"></i><!--like done.. --></div>
<div class="dislikediv"><i 
<?php if(check_dislike($conn, $post['post_id'], 66)){?>
  class=" dislike fa fa-thumbs-down dislike-btn dislike"
<?php }else{?>
 class=" dislike fa fa-thumbs-o-down dislike-btn dislike"
<?php }?> data-id="<?php echo $post['post_id']?>"
></i><!--dislike done..--></div>
<div class="dropdown">
<i style="font-size:15px"class ="dropbtn fa fa-share"></i><!--end of dropdown-->
<div class="dropdown-content">
<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo "18.218.22.129/registerComplete/testfile.php?" .$post['post_id']?>" class="fa fa-facebook">acebook</a>
<a href="http://twitter.com/share?url=<URL>&text=<TEXT>&via=<VIA>" target="_blank" class="fa fa-twitter">twitter</a>
<a href="https://plus.google.com/share?url=<BTN>" class="fa fa-google" target="_blank">oogle</a>
</div><!-- end of dropdown-content-->
</div><!--end of dropdown-->
</div><!--end of choice-->
<div class="comments">
<h1 style="text-align:center"> comments</h1>
<?php //$obj->getComments($conn,$post['post_id']);?><br>
<div class="<?php echo $post['post_id']?>"></div>
<i class="getcomments" data-postid="<?php echo $post['post_id']?>" data-lastcommentid="<?php echo 0?>">view comments</i>

</div><!--end of comment-->
</div><!--end od post-->
<?php
}?>
</div><!--end of main--> 
</body>
</html>