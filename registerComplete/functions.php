<?php

/*$last = $_POST['last_comment_id'];
if (isset($last)){
    $last = 2;
    echo json_encode($last);
}else{

    //do nothing
}*/
session_start();
$currenttime = $_SESSION['time'];
class page_functions{
 
// constat time 
/**define('CONST_SERVER_TIMEZONE', 'UTC');
define('CONST_SERVER_DATEFORMAT', 'ymdhis');
//get the currnt time base on users timezone
public function currentTime($str_user_timezone, $str_server_timezone = CONST_SERVER_TIMEZONE, $str_server_dateformat=CONST_SERVER_DATEFORMAT){
//set timzone ot user timezone
data_default_timezone_set($str_user_timezone);
$date = new DateTime('now');
$date->setTimeZone(new DataTimeZone($str_server_timezone));
$str_server_now = $date->format($str_server_dateformat);
//return timezone to server default
data_default_timezone_set($str_server_timezone);
return $str_server_now;
}//end of function*/

// don't forget to add include for db.
//@safans date function.
public function timePosted($date){
 $final_msg = '';
  $days = floor($date/(60* 60 *24));
  $remainder =   $date % (60 * 60 * 24);
  $hours= floor($remainder/ (60 * 60));
  $ramainder = $remainder % (60*60);
  $minutes = floor($remainder / 60);
  $seconds = $remainder % 60;
   if( $days > 0 or $hours > 0){
   $final_msg=  date("F j, Y, g:i a", $date); 
   } 
   elseif($days == 0 && $hours == 0 && $minutes == 0) {
   $final_msg = "A few seconds ago";
   }
   elseif($days == 0 && $hours == 0) {
   $final_msg =  $minutes.' minutes ago';
    }
   return $final_msg; 
}

// to retrieve multiple post with their rows with pagination.s
 public function post_sql_query($conn){
      $array_posts = array();
	//last values returned id
      //include_once './database.php';
    $sql_query = mysqli_query($conn,"SELECT posts.post_content as content, posts.post_id as id, posts.post_date as time,posts.post_subject as subject ,UNIX_TIMESTAMP() - posts.post_date as date, users.id as userid, users.first_name as first, users.last_name as last FROM posts LEFT JOIN users ON posts.user_id = users.id order by post_id DESC")or die("Could not execute query: " . mysqli_error($conn));
    if (!$sql_query) {
            echo "The post could not be displayed, error";
        }
        elseif(mysqli_num_rows($sql_query) == 0){
            echo "There are no new posts";
        }else {
	while($row = mysqli_fetch_assoc($sql_query)){
           $array_post = array();
           $array_post['post_id'] = $row['id'];
           $id = $row['id'];
           $date =  (int)$row['time']; 
           $date_posted = $this->timePosted($date);
           $array_post += ["subject"=>$row['subject'], "date"=>$date_posted, "full_name"=>$row['first']." " . $row['last'], "content"=>$row['content'], "post_by_id"=>$row['userid']];
           //$subject = $row['subject'];
           //$full_name =  $row['first']." " .$row['last'];
          
     	   $sql_query_media = mysqli_query($conn, "SELECT mediatable.media_name, mediatable.media_type FROM mediatable WHERE mediatable.post_id = $id")or die("Could not execute query: " . mysqli_error($conn));
           if(mysqli_num_rows($sql_query_media) > 0){
	    while($rows_media = mysqli_fetch_assoc($sql_query_media)){
                 // can be use to check if there are multiple media file associated with a post.
		//$m_name = $rows_media['media_name'];
  		//$m_type = $rows_media['media_type'];
               $array_post += ["m_name"=>$rows_media['media_name'], "m_type"=>$rows_media['media_type']];
	   }
         }
         // add this array to the posts array.
         $array_posts += ["$id"=>$array_post] ;
        }
    return $array_posts;
    }

}// end of function
public function get_user_post($conn , $userid){
 $posts = array();
 $sqlRes = mysqli_query($conn, "SELECT *  FROM posts where posts.user_id = $userid") or die("Could not execute query: " . mysqli_error($conn));
 if(!$sqlRes){
     echo "could not execute query";
 }elseif(mysqli_num_rows($sqlRes) == 0){
     echo "There is post for user";
 }else{
     while($rows = mysqli_fetch_assoc($sqlRes)){
         $post = array();
         $id = $rows['post_id'];
         $post['post_id'] = $id;
        // $date =  (int)$row['time']; 
         //$date_posted = $this->timePosted($date);
         $post += ["subject"=>$rows['post_subject'], "content"=>$rows['post_content']];
         //fetch media
       // add this array to the posts array.
       $posts += ["$id"=>$post] ;
      }
  return $posts;
 }
}///end of function

public function getComments($conn,$post_id, $last){
    $comms_array = array();
    $values = array('a','b','c','d','e');
    $limit = 5;
    //include_once './database.php';
    //get all comment associated with their commenters(user)  id.
    if((int)$last != 0){
        $comment_query = mysqli_query($conn,"SELECT *,UNIX_TIMESTAMP() - com_date as date FROM comments LEFT JOIN users on users.id = comments.user_id where comments.post_id = $post_id and comments.comment_id > $last order by comment_id DESC limit $limit") or die("Could not execute query*>>: " . mysqli_error($conn));
    }else{
        $comment_query = mysqli_query($conn,"SELECT *,UNIX_TIMESTAMP() - com_date as date FROM comments LEFT JOIN users on users.id = comments.user_id where comments.post_id = $post_id order by comment_id DESC limit $limit") or die("Could not execute query*>>: " . mysqli_error($conn));
    } 
    $num_of_rows  = mysqli_num_rows($comment_query);
    if (!$comment_query) {
        echo "The post could not be displayed, error";
    }
    elseif($num_of_rows == 0){
        echo "There are no new comments";
    }
    else{
        $count= 0;
        $last_id ;
        while($comment_row = mysqli_fetch_array($comment_query)){
            $comm_array = array();
            $comment = $comment_row['com_content'];
            $comment_by = $comment_row['first_name'].' '. $comment_row['last_name'];
            $comm_array += [['com'=>$comment, 'comby'=>$comment_by]];
           $comms_array += [$values["$count"]=>$comm_array];
           $count++; 
           if($count == $num_of_rows){
                 $comms_array += ['last'=>$comment_row['comment_id']];
           }
          
           
        }
        return $comms_array;

      // echo json_encode($comms_array);
}

}//end of  function

public function getUser($conn, $id){
    $userid = (int)$id;
    $sql = "SELECT * FROM users where users.id = '$id'";
    //get users 
    $sqluserres = mysqli_query($conn, $sql)or die("Could not execute query*>>: " . mysqli_error($conn));
    // get number of post
    if(!$sqluserres){
        echo "could not execute query";
        }
    if(mysqli_num_rows($sqluserres) == 0){
        echo "there is no match";
    }else{
    $sql = "SELECT COUNT(*) as postcount FROM posts WHERE posts.user_id = '$id'";
    $sqlpost = mysqli_query($conn, $sql) or die("could not count posts! " . mysqli_error($conn));
    $rowp = mysqli_fetch_assoc($sqlpost);
    $userprofile = array(); 
    $row = mysqli_fetch_array($sqluserres);
    $userprofile['id'] = $row['id'];
    $userprofile += ['username'=>$row['first_name']." ".$row['last_name'], 'email'=>$row['email'], "postcount"=>$rowp['postcount']];
    return $userprofile;
    }
}//end of function 


public function get_user_events($conn, $id){
    $sql = "SELECT events.event_startdatetime as start, events.event_enddatetime as ends, events.event_location_name as lname, events.event_location_address laddress, events.event_location_city as lcity, events.event_location_state lstate, events.event_location_zip as lzip, events.event_name name FROM `events` WHERE events.event_author_id = $id ORDER BY events.event_creation_datetime DESC LIMIT 1";
    $sqlres = mysqli_query($conn, $sql)or die("could not execute query!!" . mysqli_error($conn));
    if(mysqli_num_rows($sqlres) == 0){
        echo "no row retured";
    }else{
    $row = mysqli_fetch_assoc($sqlres);
    $event = array();
    $event['name'] = $row['name'];
    $event  += ["laddress" => $row['laddress'], "start"=>$row['start'], "ends"=>$row['ends'], "lcity"=>$row['lcity'], "lstate"=>$row['lstate'], "lzip"=>$row['lzip']];
    return $event;
}
}//end of function 

public function convertdate($datetime){
$time = new DateTime($datetime);
$date = $time->format('n.j.y');
$time = $time->format('H:i');
echo $date;
}//end of function 

public function testdate(){
   

}

public function comparedate($datetime){
    echo $currenttime;
}



}//end of class
?>
