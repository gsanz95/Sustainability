<?php
if(!isset($_SESSION))
{
    session_start();
}
include "navbar.php";
include "database.php";
$post_content = $post_subject = "";
$subject_err = $body_err = "";
$subject = $content = "";
$user_id= 0;
if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    if (isset($_POST['subject']) and isset($_POST['body'])) {
        $subject = $_POST['subject'];
        $content = $_POST['body'];
        $user_id = $_SESSION['id'];

        if (empty($_POST['subject'])) {
            $post_subject = "Please enter the subject of post";
        } elseif (empty($_POST['body'])) {
            $post_content = "Please enter text in the box";
        } else {
            $query = "INSERT into `posts` (post_content, post_date, post_subject, user_id)
                      VALUES ('$content','" . strtotime(date("Y-m-d h:i:sa")) . "','$subject','$user_id')";

            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if ($result) {
                $last_id = mysqli_insert_id($conn);
                echo $last_id;
                header('location: home.php');
            }

        }

    }


    include "../scripts/nameGenerator.php";

    $file_extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    $media_dir = "../uploads/";
    $media = genName("media") . "." . strtolower($file_extension);
    $media_w_path = $media_dir . $media;
    $uploadGranted = TRUE;
    $media = strtolower($media);
    if ( isset($_POST['create']) && isset($_FILES['fileToUpload'])) {

       
        $isImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $isVideo = preg_match('/video\/*/', $_FILES["fileToUpload"]["tmp_name"]);

        if ($isImage !== FALSE) {
            $mediaFileType = 'img';
            echo "File is Image";
            $uploadGranted = TRUE;
        } else if ($isVideo !== FALSE) {
            $mediaFileType = 'vid';
            echo "File is Video";
            $uploadGranted = TRUE;
        } else {
            $mediaFileType = 'err';
            echo "File uploaded isn't an image or a video format supported";
            $uploadGranted = FALSE;
        }
    }


//Check if file already exists
    if (file_exists($media_w_path)) {
        echo "Sorry, a file with the same name exists";
        $uploadGranted = FALSE;
    }

//Reject if bigger than 153 MB
    if ($_FILES["fileToUpload"]["size"] > 160432128) {
        echo "File is too large";
        $uploadGranted = FALSE;
    }

// Check if Upload is Allowed
    if ($uploadGranted == FALSE) {
        echo "Sorry, your file was not uploaded.";
    } // Upload is allowed, try to upload
    else {
        // Save media info in Database
        echo $media;
        echo "<br>";

        $storeSuccess = mysqli_query($conn, "INSERT INTO mediatable (media_name, media_type, post_id) VALUES ('" . $media . "','" . $mediaFileType . "','" . $last_id ."')"); // TEMPORARY POST ID

        if ($storeSuccess) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $media_w_path)) {
                echo "The file " . $media . " has been uploaded.";
            } else {
                // Undo saving of media info in Database
                mysqli_query($conn, "DELETE FROM mediatable WHERE media_name = '" . $media . "'");
                echo "Sorry, there was an error uploading the file";
            }
        } else {
            echo "Sorry, there was an error uploading the file";
            echo $storeSuccess;
        }

    }
}



?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style type="text/css">
        body{

            font: 16px sans-serif; }
        .wrapper{
            width: 500px; /* this is needed */
            height: 100%; /* this is needed */
            padding: 20px; /* this is for styling only */
            position: relative; /* this is needed */
            margin: auto; /* this is needed */
            left: 0; /* this is needed */
            right:0; /* this is needed */
            top: 0; /* this is needed */
            bottom: 0; /* this is needed */
        }
    </style>
</head>
<body>

<div class="wrapper">
    <?php if(!isset($_SESSION['user'])): ?>
        <div class='btn-toolbar'>
            <div class='btn-group'>
                <a class="btn btn-light" style="background-color: #B8DFF6;" href="login.php" role="button">Login</a>
            </div>
            <?php echo "  or  "?>
            <div class='btn-toolbar' >
                <a class="btn btn-light" style="background-color: #B8DFF6;" href="register.php" role="button">Register</a>
            </div>
            <?php echo "to post"?>
        </div>

    <?php else: ?>

        <h2>Create post</h2>
    <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
            <label>Subject:</label>
            <input type="text" class="form-control" name="subject" placeholder="Enter Post Subject" required=""/>
            <span class="help-block"><?php echo $subject_err; ?></span>
      </div>
        <div class="form-group <?php echo (!empty($body_err)) ? 'has-error' : ''; ?>">
            <label>Post:</label>
    <textarea  rows="10" cols="80" name="body"   placeholder="Enter Text" class = "form-control"  ><?php echo $post_content; ?></textarea>
            <span class="help-block"><?php echo $body_err; ?></span>
       </div>
          <div>
          Upload media: <input type="checkbox" id="myCheck" >
          </div>
        <div>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <script>
                //gets the element by its id
                let myFile = document.getElementById('fileToUpload');

                //binds to onchange event of the input field
                myFile.addEventListener('change', function() {
                    //this.files[0].size gets the size of your file.
                    if(this.files[0].size > 160432128)
                    {
                        alert('Max file size (153MB) exceeded');
                    }
                });</script>


        <div class="form-group" >
        <button type="submit" class="btn btn-default" style="background-color: #B8DFF6;" name="create">Submit</button>
        </div>

    <?php endif; ?>
   </form>
   </div>
 </body>
</html>


