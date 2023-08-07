<?php require "includes/config.php";   ?>

<?php 
// deleting comments
if(isset($_POST['delete'])) {
 $id = $_POST['id']; //both got from ajax data in show.php

$delete = $conn->prepare("DELETE FROM comments WHERE id='$id'");
$delete->execute();
}