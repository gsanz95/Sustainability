<?php
// Include config file

require_once 'database.php';
$user = $pass = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
if( isset($_POST['username']) and isset($_POST['password']) ) {
    //code is given below (used for database connection)
    if (empty(trim($_POST["username"]))) {
        $username_err = 'Please enter your email address.';
    } else {
        $user = trim($_POST["username"]);
    }
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $pass = md5(trim($_POST['password']));
    }

    if (empty($username_err) && empty($password_err)) {
        $ret = mysqli_query($conn, "SELECT * FROM users WHERE email='$user' AND password='$pass' ") or die("Could not execute query: " . mysqli_error($conn));
        $row = mysqli_fetch_assoc($ret);
        if (!$row) {
            header("Location: login.php");
        } else {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['user'] = $row['email'];

            }

            header('location: home.php');
        }
    }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <style type="text/css">
        body{

            font: 14px sans-serif; }
        .wrapper{
            width: 350px; /* this is needed */
            height: 550px; /* this is needed */
            padding: 20px; /* this is for styling only */
            position: absolute; /* this is needed */
            margin: auto; /* this is needed */
            left: 0; /* this is needed */
            right:0; /* this is needed */
            top: 0; /* this is needed */
            bottom: 0; /* this is needed */
            background-color: #B8DFF6;
    }
    </style>
</head>
<body>
<?php include "./navbar.php"?>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Email Address</label>
            <input type="text" name="username"class="form-control" value="<?php echo $user; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
    <?php include "./footer.php"; ?>
</div>

</body>
</html>