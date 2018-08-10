<?php

function sendConfirmationEmail($receiver){
    $content = 'Dear ' . $receiver . '\n\nWe have received your post and will be posting it shortly.\n\n Thank you for your patience\n';

    $msg = mail($receiver,"Your post has been received", $content);
    return $msg;
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 6/17/2018
 * Time: 5:49 PM
 */
