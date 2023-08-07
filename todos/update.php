<?php
require "conn.php";
//checking for update id
if(isset($_GET['upd_id'])) {
    //assigned value to variable 
    $id = $_GET['upd_id'];

    $data = $conn->query ("SELECT * FROM tasks WHERE id='$id'");
    $rows = $data->fetch(PDO::FETCH_OBJ);
    
    //updating name 
    

    if(isset($_POST['update'])) {
        $task = $_POST['mytask'];
    
        $update = $conn->prepare ("UPDATE tasks SET name=:name WHERE id='$id'");
        $update->execute ([':name' => $task]);
    
        header("location: index.php");
    }



}

?>
<?php include "header.php"; ?>
<body>
    <h3>Todos checking list</h3>
    <form method="POST" action="update.php?upd_id=<?php echo $id; ?>">
        <label for="mytask"></label>
        <input type="text" name="mytask"  value="<?php echo $rows->name; ?>" />
        <input type="submit" name="update" value="Update" />

    </form>

</body>
</html>    
