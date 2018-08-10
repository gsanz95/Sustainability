<?php
require '/var/www/html/database.php';
include './nameGenerator.php';


$file_extension = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
$media_dir = "/var/www/html/uploads/";
$media = genName("media") . "." . strtolower($file_extension);
$media_w_path = $media_dir . $media;
$uploadGranted = TRUE;

$media = strtolower($media);

//Check file
if(isset($_POST["submit"])) {
    // Check if file is an image or a video
    $isImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $isVideo = preg_match('/video\/*/',$_FILES["fileToUpload"]["type"]);

    if($isImage !== FALSE) {
        $mediaFileType = 'img';
        echo "File is Image";
        $uploadGranted = TRUE;
    }
    else if($isVideo !== FALSE) {
        $mediaFileType = 'vid';
        echo "File is Video";
        $uploadGranted = TRUE;
    }
    else {
        $mediaFileType = 'err';
        echo "File uploaded isn't an image or a video format supported";
        $uploadGranted = FALSE;
    }
}

//Check if file already exists
if(file_exists($media_w_path)) {
    echo "Sorry, a file with the same name exists";
    $uploadGranted = FALSE;
}

//Reject if bigger than 153 MB
if($_FILES["fileToUpload"]["size"] > 160432128){
    echo "File is too large";
    $uploadGranted = FALSE;
}

// Check if Upload is Allowed
if($uploadGranted == FALSE){
    echo "Sorry, your file was not uploaded.";
}

// Upload is allowed, try to upload
else{
    // Save media info in Database
    echo $media;
    echo "<br>";

    $storeSuccess = mysqli_query($conn,"INSERT INTO mediatable (media_name, media_type, post_id) VALUES ('" . $media . "','" . $mediaFileType . "','12')"); // TEMPORARY POST ID

    if($storeSuccess){
        if(move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $media_w_path)){
            echo "The file " . $media . " has been uploaded.";
        } else {
            // Undo saving of media info in Database
            mysqli_query($conn,"DELETE FROM mediatable WHERE media_name = '" . $media . "'");
            echo "Sorry, there was an error uploading the file";
        }
    } else{
        echo "Sorry, there was an error uploading the file";
        echo $storeSuccess;
    }
}

/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 6/20/2018
 * Time: 3:54 PM
 */
