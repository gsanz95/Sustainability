<?php 
//include './database.php';
//if 1
if(isset($_POST['action'])){
//echo "post is set";
$post_id = $_POST['post_id'];
$action = $_POST['action'];
$user_id = $_POST['user_id'];
//switch 
switch($action){
    case 'like':
	// insert a new record into the table for like
         $sql =  "INSERT INTO like_dislike (post_id, users_id, user_action) VALUES('$post_id','$user_id','like') ON DUPLICATE KEY UPDATE user_action='like'";
	break;
    case 'dislike':
	//insert a new record into the table for dislike
         $sql = "INSERT INTO like_dislike (post_id, users_id, user_action) VALUES('$post_id', '$user_id', 'dislike') ON DUPLICATE KEY UPDATE user_action='dislike'";   
        break;
    case 'unlike':
	//delete record on data base that indicates user liked post
	$sql = "DELETE FROM like_dislike WHERE like_dislike.post_id = '$post_id' and like_dislike.users_id = '$user_id'";
   	break;
    case 'undislike':
       //delete record on database that indicates user dislikes post
	$sql = "DELETE FROM like_dislike WHERE like_dislike.post_id = '$post_id' and like_dislike.users_id = '$user_id'";
     	break;
     default:
        break;
}
//end of switch
mysqli_query($conn, $sql);
//echo get_rating_summary($conn,$post_id);
exit(0);
}//end of if 1
//run sql
//function($conn, $sql){
//}//end of function 
//get total number of likes
function getlikesCount($conn, $post_id){
	$sql = "SELECT COUNT(*) FROM like_dislike WHERE like_dislike.post_id = $post_id AND like_dislike.user_action='like'";
	$query = mysqli_query($conn, $sql);
	//if 1
	if(mysqli_num_rows($query) == 0){
		echo "no count collected";
	}// end if 1
	else {
		$result = mysqli_fetch_assoc($query);
		return $result[0]; 
	}//end of else 
}
//end of function

//get total number of dislikes
function getDislikesCount($conn,$post_id){
	$sql = "SELECT COUNT(*) FROM like_dislike WHERE like_dislike.post_id = $post_id AND like_dislike.user_action='dislike'";
	$query = mysqli_query($conn, $sql);
	// if 1 
	if(mysqli_num_rows($query) == 0){
 		echo "no count returned";
	}//end of if 1
	else{
 		$result = mysqli_fetch_assoc($query);
 		return $result[0];
	}//end of else
}//end of function 


//get the number of likes and dislikes
function get_rating_summary($conn, $post_id){
         $rating = array();
	$rating = ["likes"=>$this->getlikesCount($conn, $post_id), "dislikes"=>$this->getDislikesCount($conn, $post_id)];
        return json_encode($rating);

}//end of function 


//check if user already likes post 
function check_like($conn, $post_id, $user_id){
	//check if user is logged in 
	$sql = "SELECT * FROM like_dislike WHERE like_dislike.users_id = '$user_id' AND like_dislike.post_id = '$post_id' AND like_dislike.user_action ='like'";
	$result = mysqli_query($conn, $sql);
	//if 1
	if(mysqli_num_rows($result) > 0){
		 return true;
	}//end of if 1
	else {
		return false; 
	}//end of else
}//end of function

//check if user already disliked post
function check_dislike($conn, $post_id, $user_id){
	$sql ="SELECT * FROM like_dislike WHERE like_dislike.users_id = '$user_id' AND like_dislike.post_id = '$post_id' AND like_dislike.user_action = 'dislike'";
	$result = mysqli_query($conn, $sql);
	//if 1
	if(mysqli_num_rows($result) > 0){
 		return true;
	}//end of if 1
	else{
		return false;
	}//end of else 
}//end of function