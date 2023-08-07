<?php require "includes/header.php"; ?>
<?php require "includes/config.php";   ?>



<!-- Logic from pulling data from base -->
<?php
$select = $conn->query("SELECT * FROM posts");
$select->execute();
$rows = $select->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Posts core -->
<main class="form-signin w-50 m-auto mt-5">
  <?php foreach($rows as $row):  ?>
  <div class="card text-center">
    <div class="card-body ">
      <h5 class="card-title"><?php echo $row->title;  ?></h5>
      <p class="card-text"><?php echo substr($row->body, 0, 30) . ".....";  ?></p>
      <a href="show.php?id=<?php echo $row->id; ?>" class="btn btn-primary">Read more</a>
    </div>
    <div class="card-footer text-muted"><?php echo $row->created_at;  ?></div>
  </div>
  <br>
  <?php  endforeach; ?>
  
</main> 


<?php require "includes/footer.php"; ?>
