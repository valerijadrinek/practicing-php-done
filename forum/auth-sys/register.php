<?php require "includes/header.php"; ?>
<?php require "includes/config.php"  ?>

<?php
//checking for session
if(isset($_SESSION['username'])) {
    header ("location: index.php");
}

//form submit
if(isset($_POST['submit'])) {
    //checking on empty values
    if(empty($_POST['email']) OR empty($_POST['username']) OR empty($_POST['password'])) {

      echo "<script>alert('One or more inputs are empty');</script>";
    
    } else {
      //initialing variables
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      //setting insert query to db auth-system
      $insert = $conn->prepare ("INSERT INTO users (email, username, mypassword) values (:email, :username, :mypassword)");
      $insert->execute ([
                ':email' => $email,
                ':username' => $username,
                ':mypassword' => password_hash ($password, PASSWORD_DEFAULT),
        ]);
      //linking to login.php
      header ("location: login.php");
    }
}

?>


<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">register</button>
    <h6 class="mt-3">Already have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>
<?php require "includes/footer.php"; ?>
