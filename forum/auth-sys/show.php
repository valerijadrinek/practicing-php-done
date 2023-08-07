<?php require "includes/header.php"; ?>
<?php require "includes/config.php";   ?>

<?php
// post handling
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $onePost = $conn->query("SELECT * FROM posts WHERE id='$id'");
    $onePost->execute();
    $post = $onePost->fetch(PDO::FETCH_OBJ);

   
}
 //comments handling
 $comment = $conn->query("SELECT * FROM comments WHERE post_id='$id' ORDER BY created_at DESC");
 $comment->execute();
 $comments = $comment->fetchAll(PDO::FETCH_OBJ);


 //rating system managing
 $ratings = $conn->query("SELECT * FROM rates WHERE post_id='$id'");
 $ratings->execute();
 $rating = $ratings->fetch(PDO::FETCH_OBJ);


?>

<!-- Single post -->
<div class="row mt-5">
   <div class="card text-center">
       <div class="card-body ">
         <h5 class="card-title"><?php echo $post->title;  ?></h5>
         <p class="card-text"><?php echo $post->body ?></p>
         <form method="POST" id="form-data">
            <div class="my-rating"></div>
            <input id="rating" type="hidden" name="rating" value="" /> 
            <input id="post_id" type="hidden" name="post_id" value="<?php echo $post->id;  ?>" /> 
            <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
         </form>
       </div>
   </div>
</div>


<!-- Form for creating comments-->
<main class="form-signin w-50 m-auto">
  <form method="POST" id="comment_data">
    
    <!-- Hidden part of comments for base handling -->
    <div class="form-floating">
      <input name="username" type="hidden" value="<?php echo $_SESSION['username']; ?>" class="form-control" id="username" >
    </div>

    <div class="form-floating">
      <input name="post_id" type="hidden" value="<?php echo $post->id; ?>" class="form-control" id="post_id">
    </div>
    <!-- comment's body-->
    <div class="form-floating mt-4">
      <textarea rows="9" name="comment" placeholder="Enter your comment" class="form-control" id="comment"></textarea>
      <label for="comment">Create your comment</label>
    </div>

    <button name="submit" id="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">Create Comment</button>
    <!-- Showing message of successfully added coment or deleted comment-->
    <div class="nothing" id="msg">
    <div class="nothing" id="deletemsg">
  </form>
<!-- End of form -->

<!-- Displaying comments -->

<div class="row mt-5">
<?php foreach ($comments as $singleComment) : ?>
   <div class="card text-center mt-2">
       <div class="card-body ">
         <h5 class="card-title"><?php echo $singleComment->username;  ?></h5>
         <p class="card-text"><?php echo $singleComment->comment; ?></p>
         <?php if(isset($_SESSION['username']) AND $_SESSION['username'] == $singleComment->username):   ?>
         <button  id="delete-btn" value="<?php echo $singleComment->id; ?>" class="btn btn-danger mt-2" >Delete</button>
         <?php endif; ?>
       </div>
   </div>
   <?php endforeach; ?>
</div>




</div>


</main>



<?php require "includes/footer.php"; ?>

<script>
  $(document).ready(function() {

    // refreshing comments
     $(document).on('submit', function(e) {
      e.preventDefault();
      var formData = $("#comment_data").serialize()+'&submit=submit';

      $.ajax({
        type: 'POST',
        url: 'insert-comments.php',
        data: formData,

        success: function() {
          $("#comment").val(null);
          $("#username").val(null);
          $("#post_id").val(null);

          $("#msg").html("Added successfully.").toggleClass("alert alert-success bg-success text-white mt-3");
          fetch();
        }
      });
   });

  
   


   // Deleting comments
   $("#delete-btn").on('click', function(e) {
      e.preventDefault();
      var id = $(this).val();

      $.ajax({
        type: 'POST',
        url: 'delete-comments.php',
        data: {
          delete: 'delete',
          id: id
        },

        success: function() {
          //alert(id);
          $("#deletemsg").html("Deleted successfully.").toggleClass("alert alert-success bg-success text-white mt-3");
          fetch();
        }
      });
   });

   function fetch() {
      setInterval(()=> {
        $("body").load("show.php?id=<?php echo $_GET['id']; ?>")
      }, 4000);
   }

   
  //rating system
   $(".my-rating").starRating({

    starSize: 25,
    initialRating: "<?php 

    if(isset($rating->rating)) {
       echo $rating->rating;
    } else {
      echo '0';
    }
  
    ?>",

    callback: function(currentRating, $el){
        $("#rating").val(currentRating);

        $(".my-rating").click(function(e){
          e.preventDefault;

          var formdata = $("#form-data").serialize()+'&insert=insert';

          $.ajax({
            type: 'POST',
            url: 'insert-ratings.php',
            data: formdata,

            success: function() {
              //alert(formdata);

            }

          });

        }); 
    }
});

});


</script>
