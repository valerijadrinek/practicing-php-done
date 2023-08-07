<?php

require "conn.php";

$data = $conn->query ("SELECT * FROM tasks");


?>
<?php include "header.php"; ?>



<body>
    <h3>Todos checking list</h3>
    <form method="POST" action="insert.php">
        <label for="myTask"></label>
        <input type="text" name="mytask" placeholder="Insert your next todo!" />
        <input type="submit" name="submit" value="Submit" />

    </form>
    <table>
    <caption>ToDo list</caption>
        <?php while($rows = $data->fetch (PDO::FETCH_OBJ)) :  ?>
        <tr>
            <td><?php echo $rows->name; ?></td>
            <td><a href="delete.php?del_id=<?php  echo $rows->id; ?>">Delete</a></td>
            <td><a href="update.php?upd_id=<?php  echo $rows->id; ?>" class="update">Update</a></td>
            
        </tr>
    
        
        <?php endwhile;?>
    </table>
</body>