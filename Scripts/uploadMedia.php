<?php

$media_dir = "/var/www/uploads/";
$media = $media_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadGranted = 1;
$mediaFileType = strtolower(pathinfo($media,PATHINFO_EXTENSION));

//Check file
if(isset($_POST["submit"])) {
    // Check if file is an image or a video
    $isImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $isVideo = preg_match('/video\/*/',$_FILES["fileToUpload"]["tmp_name"]);

    if($isImage !== false) {
        echo "File is Image";
        $uploadGranted = 1;
    }
    else if($isVideo !== false) {
        echo "File is Video";
        $uploadGranted = 1;
    }
    else {
        echo "File uploaded isn't an image or a video format supported";
        $uploadGranted = 0;
    }
}

//Check if file already exists
if(file_exists($media)) {
    echo "Sorry, a file with the same name exists";
    $uploadGranted = 0;
}

//Reject if bigger than 153 MB
if($_FILES["fileToUpload"]["size"] > 160432128){
    echo "File is too large";
    $uploadGranted = 0;
}

// Check if Upload is Allowed
if($uploadGranted){
    echo "Sorry, your file was not uploaded.";
}
// Upload is allowed, try to upload
else{
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $media)){
        echo "The file" . basename( $_FILES["fileToUpload"]["name"]) . "has been uploaded.";
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