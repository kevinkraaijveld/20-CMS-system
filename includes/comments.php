<div class="well">
    <h4>Leave a Comment:</h4>
    <!-- KK: Create comment-->
    <?php
      if(isset($_POST['create_comment'])){
        $post_id = $_GET['post_id'];

        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
          $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
          $query .= "VALUES($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Pending', now())";

          $create_comment = mysqli_query($connection, $query);
          echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Comment placed, awaiting approval</div>";

          $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
          $query .= "WHERE post_id = $post_id";

          $update_comment_count = mysqli_query($connection, $query);
        }else{
          echo"<div class='alert alert-danger alert-dismissible'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can't submit an empty form</div>";
        }

        header("Location: post.php?post_id=$post_id");
      }
    ?>

    <!-- KK: Comments Form -->
    <?php
    $user_firstname = $_SESSION['user_firstname'];
    $user_lastname = $_SESSION['user_lastname'];
    $user_email = $_SESSION['user_email'];
    ?>
    <form action="" method="post" class="form-group" autocomplete="off">
      <div class="form-group">
        <label for="comment_author">Name</label>
          <input class="form-control" type="text" name="comment_author" placeholder="Name" <?php if(isset($_SESSION['user_id'])){ echo "value='$user_firstname $user_lastname'";  }?> >
      </div>

      <div class="form-group">
        <label for="comment_email">Email</label>
          <input class="form-control" type="email" name="comment_email" placeholder="Email" <?php if(isset($_SESSION['user_id'])){ echo "value='$user_email'";  }?>>
      </div>

      <div class="form-group">
        <label for="comment_content">Comment</label>
          <textarea name="comment_content" class="form-control" rows="3"></textarea>
      </div>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>

</div>

<hr>

<!-- KK: Approved comments -->
<?php
$query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
$query .= "AND comment_status = 'Approved' ";
$query .= "ORDER BY  comment_id DESC ";

$select_comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_array($select_comments)){
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_date = $row['comment_date'];
?>

  <!-- KK: Approved comment -->
  <div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="images/avatars/avatar.jpg" id="comment_avatar" alt="">
    <div class="media-body">
          <h4 class="media-heading"><?php echo $comment_author?>
              <small><?php echo $comment_date?></small>
          </h4>
          <?php echo $comment_content?>
      </div>
  </div>

<?php
  }
?>
