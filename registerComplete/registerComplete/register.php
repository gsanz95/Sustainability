<?php


require_once 'database.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$first_name = $first_name_err = "";
$last_name = $last_name_err = "";

// Processing form data when form is submitted

// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($conn, $username);

    $first_name = stripcslashes($_REQUEST['first_name']);
    $first_name = mysqli_real_escape_string($conn, $first_name);

    $last_name = stripcslashes($_REQUEST['last_name']);
    $last_name = mysqli_real_escape_string($conn, $last_name);

    $password = md5(stripslashes($_REQUEST['password']));
    //$confirm_password = md5(stripslashes($_REQUEST['confirm_password']));

    $password = mysqli_real_escape_string($conn, $password);



    // Check if user with that email already exists
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$username'") or die(mysqli_error($conn));

    // We know user email exists if the rows returned are more than 0
    if (mysqli_num_rows($result) > 0)
    {
       $username_err = "User with this email already exists!";

    }
    elseif($_POST['password'] != $_POST['confirm_password'])
    {
        $password_err = "The Passwords you entered do not match!";
        $confirm_password ="";
        $password = "";
    }
    elseif (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a valid email address!";
        $confirm_password = "";
        $password = "";
    }
    elseif (empty(trim($_POST["first_name"])))
    {
        $first_name_err = "Please enter your first name!";
        $confirm_password ="";
        $password = "";
    }
    elseif (empty(trim($_POST["last_name"])))
    {
        $last_name_err = "Please enter your last name!";
        $confirm_password ="";
        $password = "";
    }
    else{
        $query = "INSERT into `users` (email, first_name, last_name, password)
                      VALUES ('$username','$first_name','$last_name','$password')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($result)
        {
            echo "Registration Successful";
            header("Location: login.php");
        }

    }


}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style type="text/css">
        body{       font: 14px sans-serif; }
        .wrapper{
            width: 350px; /* this is needed */
            height: 660px; /* this is needed */
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="first_name" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="last_name" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
        <?php include "./footer.php";?>
    </div>

</body>

</html>