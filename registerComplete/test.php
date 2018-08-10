<? php 

?>
<!DOCTYPE html>
<html>
<head></head>
<body
<?php 
include './functions.php';
include './database.php';
$obj = new page_functions;?>
<p><?php //var_dump($obj->post_sql_query($conn));?></p>
<?php $obj2 = new page_functions;?>
<p><?php var_dump($obj2->getUser($conn,46 ));?></p>
<p><?php var_dump($obj2->get_user_events($conn, 11))?></p>
<p><?php $obj->testdate()?></p>
</body>
</html>