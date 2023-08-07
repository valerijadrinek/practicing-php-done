<?php
require "conn.php";

//checking submit button
if(isset($_POST['submit'])) {
    $task = $_POST['mytask'];

    $insert = $conn->prepare ("INSERT INTO tasks (name) VALUES(:name)");
    $insert->execute ([':name' => $task]);

    header("location: index.php");
}  else {
    //echo "<script>alert('You must enter new task, your input is empty!');</script>";
}
