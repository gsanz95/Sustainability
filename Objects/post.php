<?php
class Post
{
    // Variables
    public var $id;

    private var $author;
    private var $content;
    private var $media_location;

    // Constructor
    public function __construct($email, $post_content)
    {
        // Create Post and get post_id
        $this->author = $email;
        $this->content = $post_content;
    }

    // Notifies author of post received
    public function notify()
    {
        //Send Confirmation to Email Function
    }
}
/**
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 6/11/2018
 * Time: 5:15 PM
 */