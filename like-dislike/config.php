<?php 
try {
    //connection to db
    $host = "localhost";
    $dbname = "like-dislike";
    $username = "root";
    $password = "";
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Error when connecting to db : " . $e->getMessage ();
}



