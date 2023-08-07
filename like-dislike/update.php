<?php
require "config.php";
//inserting likes into db
if(isset($_POST['id']) AND isset($_POST['val'])) {
   $id = $_POST['id'];
   $val = $_POST['val'];

   $update = $conn->prepare("UPDATE posts SET likes='$val' WHERE id='$id'");
   $update->execute();


}

