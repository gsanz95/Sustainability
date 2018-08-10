<?php 
include_once './database.php';
include_once  './function.php';
if(isset($_POST['last_comment_id'])){
    $c_obj = new page_functions;
    echo json_encode($c_obj->getComments($conn,$_POST['postid'], $_POST['last_comment_id']));
    exit(0);
}{
//$obj = new page_functions;
//var_dump($obj->post_sql_query($conn));
 //$obj2 = new page_functions;
}

 
?>
