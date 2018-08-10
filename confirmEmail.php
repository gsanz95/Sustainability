<?php 
define('USER', 'root');
define('PASS', 'password123');
define('SERVER', 'sustainability.cpnngrjylxoa.us-east-2.rds.amazonaws.com:3306');
define('DBASE',"sus");
$conn = new mysqli(SERVER, USER, PASS,DBASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_GET["email"];
echo strlen($email);
$access = $_GET['confirm_code'];
echo  strlen($access);
$sql ="SELECT * FROM guest_table WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 0){
    echo "nothhing has happened";
}
while($row = mysqli_fetch_assoc($result)){
    echo "in the loop";
    $db_confirm_code = $row['confirm_code'];
}
//echo "out of the loop";
echo $db_confirm_code;
if($access == $db_confirm_code){
    //header('Location: sucess.php');
    echo "guest logged in";
    mysqli_query($conn,"UPDATE guest_table SET session_code =0, confirm_code = 0, time_sent = NULL where email='$email'");
    //mysqli_query($conn,"UPDATE guest_table SET ");
}else {
    echo "link is dead";
}
?>