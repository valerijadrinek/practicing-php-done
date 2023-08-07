<?php require "includes/config.php";   ?>

<?php

if(isset($_POST['submit'])) {
    
    
      //initialing variables
      $username = $_POST['username'];
      $post_id = $_POST['post_id'];
      $comment = $_POST['comment'];

      //setting insert query to db auth-system
      $insert = $conn->prepare ("INSERT INTO comments (username, post_id, comment) values (:username, :post_id, :comment)");
      $insert->execute ([
                ':username' => $username,
                ':post_id' => $post_id,
                ':comment' => $comment,
        ]);
      
    }




