<?php
require '/var/www/html/database.php';

$media_dir = "/var/www/uploads/";
$media = $media_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadGranted = TRUE;

//Check file
if(isset($_POST["submit"])) {
    // Check if file is an image or a video
    $isImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $isVideo = preg_match('/video\/*/',$_FILES["fileToUpload"]["tmp_name"]);

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
if(file_exists($media)) {
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
    $storeSuccess = mysqli_query($conn,"INSERT INTO mediatable (media_name, media_type) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "','" . $mediaFileType . "')");
    if($storeSuccess){
        if(move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $media)){
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            // Undo saving of media info in Database
            mysqli_query($conn,"DELETE FROM mediatable WHERE media_name = '" . basename($_FILES["fileToUpload"]["name"]) . "'");
            echo "Sorry, there was an error uploading the file";
        }
    } else{
        echo "Sorry, there was an error uploading the file";
    }
}

/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 6/20/2018
 * Time: 3:54 PM
 */