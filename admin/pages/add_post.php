<!-- Kevin Kraaijveld - CMS system - Add a post
============================================================================
Displays a form to add a post to the database
-->

<?php
// KK: store_post function in functions.php
store_post();
?>


<form class="form-group" action="" method="post" enctype="multipart/form-data" autocomplete="off">
  <!-- KK: Title -->

  <div class="form-group">
    <label for="cat_title">Post title</label>
    <input class="form-control" type="text" name="post_title" placeholder="Post title">
  </div>
  <!-- KK: Category -->
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
          echo "<option value='{$cat_id}'>{$cat_id} {$cat_title}</option>";
        }
      ?>
    </select>
  </div>

    <!-- KK: Author -->

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
              $user_firstname = null;
              echo $user_firstname = $user_name;
            }
            echo "<option value='{$user_id}'>{$user_id} {$user_firstname} {$user_lastname}</option>";
          }
        ?>
      </select>
    </div>

    <!-- KK: Status -->
    <div class="form-group">
      <label for="post_status">Post status</label>
      <br>
      <select class="form-control" name="post_status">
          <option value='Draft'>Draft</option>
          <option value='Published'>Published</option>
      </select>
    </div>

    <!-- KK: Image -->
    <div class="form-group">
      <label for="post_image">Post image</label>
      <input class="form-control-file" type="file" name="post_image">
    </div>

    <!-- KK: Tags -->
    <div class="form-group">
      <label for="post_tags">Post tags</label>
      <input class="form-control" type="text" name="post_tags" placeholder="Post tags">
    </div>

    <!-- KK: Content -->
    <div class="form-group">
      <label for="post_content">Post content</label>
      <br>
      <textarea class="form-control" id="body" name="post_content" rows="10" style='width:-webkit-fill-available;'></textarea>
    </div>

    <!-- KK: Submit button -->

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_post" value="Submit">
    </div>

</form>
