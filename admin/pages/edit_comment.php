<!-- Kevin Kraaijveld - CMS system - Edit a comment
============================================================================
Displays a form to edit a comment from the database
-->

<!-- KK: Load fields from user id url -->
<?php
  if (isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];

    $query = "SELECT * FROM comments WHERE comment_id = {$comment_id}";

    $select_comment_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comment_by_id)){
      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];

      $comment_author = $row['comment_author'];
      $comment_email = $row['comment_email'];
      $comment_status = $row['comment_status'];
      $comment_content = $row['comment_content'];
    }
  }
?>
<!-- KK: Send form to database -->
<?php
  if(isset($_POST['update_comment'])){
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_status = $_POST['comment_status'];
    $comment_content = $_POST['comment_content'];

    echo"<div class='alert alert-success alert-dismissible fade in'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Comment updated - <a href='../../post.php?post_id=$comment_post_id'>View post</a></div>";
    $query = "UPDATE comments SET ";
    $query .= "comment_author = '{$comment_author}', ";
    $query .= "comment_email = '{$comment_email}', ";
    $query .= "comment_status = '{$comment_status}', ";
    $query .= "comment_content = '{$comment_content}' ";
    $query .= "WHERE comment_id = {$comment_id}";
    $update_comment = mysqli_query($connection, $query);
  }
?>
<h2>Edit Comment</h2>
  <form class="form-group" action="" method="post" enctype="multipart/form-data" autocomplete="off">

    <div class="form-group">
      <label for="cat_title">Comment author</label>
      <input class="form-control" type="text" name="comment_author" value="<?php echo $comment_author?>" placeholder="Comment author">
    </div>

  <div class="form-group">
    <label for="post_author">Comment email</label>
    <input class="form-control" type="text" name="comment_email" value="<?php echo $comment_email?>" placeholder="Comment email">
  </div>


  <div class="form-group">
    <label for="post_tags">Comment status</label>
    <select class="form-control" name="comment_status">
      <?if($comment_status == "Pending"){
        echo"<option value='Pending' selected>Pending</option>";
        echo"<option value='Approved'>Approved</option>";
      }elseif($comment_status == "Approved"){
        echo"<option value='Pending'>Pending</option>";
        echo"<option value='Approved' selected>Approved</option>";
      }else{
        echo"<option value='Pending'>Pending</option>";
        echo"<option value='Approved'>Approved</option>";
      }?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_content">Comment content</label>
    <br>
    <textarea class="form-control" name="comment_content" rows="10" style='width:-webkit-fill-available;'><?php echo $comment_content?></textarea>
  </div>


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_comment" value="Submit">
  </div>

  </form>
