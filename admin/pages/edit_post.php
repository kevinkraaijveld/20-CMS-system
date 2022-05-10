<!-- Kevin Kraaijveld - CMS system - Edit a post
============================================================================
Displays a form to edit a post from the database
-->

<!-- KK: Load fields from user id url -->
<?php
  if (isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";

    $select_post_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_by_id)){
      $post_id = $row['post_id'];
      $post_author = $row['post_author'];
      $post_title = $row['post_title'];
      $post_category_id = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      $post_comments = $row['post_comments'];
      $post_date = $row['post_date'];
      $post_content = $row['post_content'];
    }
  }
?>
<!-- KK: Send form to database -->
<?php
  if(isset($_POST['update_post'])){
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../../images/$post_image");
    echo"<div class='alert alert-success alert-dismissible fade in'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Post updated - <a href='../../post.php?post_id=$post_id'>View post</a></div>";

    if(empty($post_image)){
      $query = "SELECT * from posts WHERE post_id =  {$post_id}";
      $empty_image = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($empty_image)){
        $post_image = $row['post_image'];
      }
    }
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$post_id}";
    $update_post = mysqli_query($connection, $query);
  }
?>
<h2>Edit Post</h2><small><a href="../../post.php?post_id=<?php echo $post_id?>">View post</a></small>
<form class="form-group" action="" method="post" enctype="multipart/form-data" autocomplete="off">

  <div class="form-group">
    <label for="cat_title">Post title</label>
    <input class="form-control" type="text" name="post_title" value="<?php echo $post_title?>" placeholder="Post title">
  </div>

  <div class="form-group">
    <label for="post_category_id">Post category</label>
    <br>
    <select class="form-control" name="post_category_id">
      <?php
        $query = "SELECT * FROM categories";

        $categories = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($categories)){
          $cat_id = $row['cat_id'];

          $cat_title = $row['cat_title'];

          if ($post_category_id==$cat_id){
              echo "<option value='{$cat_id}' selected>{$cat_id} {$cat_title}</option>";
             }
            else {
              echo "<option value='{$cat_id}'>{$cat_id} {$cat_title}</option>";
            }
          echo "<option value='{$cat_id}'>{$cat_id} {$cat_title}</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Post author</label>
    <br>
    <select class="form-control" name="post_author">
      <?php
        $query = "SELECT * FROM users WHERE user_role = 'Author' OR user_role = 'Admin'";

        $users = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($users)){
          $user_id = $row['user_id'];
          $user_firstname = $row['user_firstname'];
          $user_lastname = $row['user_lastname'];
          $user_name = $row['username'];
          if(empty($user_firstname) && empty($user_lastname)){
            echo $user_firstname = $user_name;
          }
          echo "<option value='{$user_id}' ";
          if($user_id == $post_author){echo "selected";}
          echo">{$user_id} {$user_firstname} {$user_lastname}</option>";
        }

      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_status">Post status</label>
    <br>
    <select class="form-control" name="post_status">
      <?if($post_status == "Draft"){
        echo"<option value='Draft' selected>Draft</option>";
        echo"<option value='Published'>Published</option>";
      }elseif($post_status == "Published"){
        echo"<option value='Draft'>Draft</option>";
        echo"<option value='Published' selected>Published</option>";
      }else{
        echo"<option value='Draft'>Draft</option>";
        echo"<option value='Published'>Published</option>";
      }?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_image">Post image</label>
    <br>
    <img src="../../images/<?php echo $post_image?>" style="width:150px;">
    <br><br>
    <input class="form-control-file" type="file" name="post_image" id ="post_image" >
  </div>

  <div class="form-group">
    <label for="post_tags">Post tags</label>
    <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags?>" placeholder="Post tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post content</label>
    <br>
    <textarea class="form-control" id="body"  name="post_content" rows="10" style='width:-webkit-fill-available;'><?php echo $post_content?></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Submit">
  </div>

</form>
