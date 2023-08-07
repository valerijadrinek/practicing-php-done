
<?php require "includes/header.php"; ?>
<?php require "includes/config.php";   ?>

<?php
// controlling access
if(!isset($_SESSION['username'])) {
  header ("location: index.php");
}


//form handling  
if(isset($_POST['submit'])) {
  //checking on empty values
  if(empty($_POST['title']) OR empty($_POST['body'])) {

    echo "<script>alert('One or more inputs are empty');</script>";
  
  } else {
    //initialing variables
    $title = $_POST['title'];
    $body = $_POST['body'];
    $username = $_SESSION['username'];

    //setting insert query to db auth-system
    $insert = $conn->prepare ("INSERT INTO posts (title, body, username) values (:title, :body, :username)");
    $insert->execute ([
              ':title' => $title,
              ':body' => $body,
              ':username' => $username
      ]);
    //linking to login.php
    header ("location: login.php");

  }

}

?>

<!-- Form for including posts -->
<main class="form-signin w-50 m-auto">
  <form method="POST" action="create.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Create Post</h1>

    <div class="form-floating">
      <input name="title" type="text" class="form-control" id="floatingInput" placeholder="Title">
      <label for="floatingInput">Title</label>
    </div>

    <div class="form-floating">
      <input name="username" type="hidden" class="form-control" id="floatingInput" >
    </div>

    <div class="form-floating mt-4">
      <textarea rows="9" name="body" placeholder="Enter your post" class="form-control" ></textarea>
      <label for="floatingPassword">Create your post</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">Create Post</button>
    

  </form>
</main>

<?php require "includes/footer.php"; ?>
