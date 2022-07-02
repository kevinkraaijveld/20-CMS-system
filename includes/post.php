<!-- Kevin Kraaijveld - CMS system - post
============================================================================
Shows single post in post.php
-->
<!-- KK: Content -->
<?php
if(isset($_GET['post_id'])){
  $post_id = $_GET['post_id'];

  // KK: views count
  $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
  $send_query = mysqli_query($connection, $view_query);

  if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin' ){
    $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
  }else{
    $query = "SELECT * FROM posts WHERE post_id = '$post_id' AND post_status = 'Published'";
  }

?>
<?php

  // KK: select all posts
  $select_all_posts = mysqli_query($connection, $query);

  $count = mysqli_num_rows($select_all_posts);
  if($count < 1){
    echo "<h2>Post not available</h2>";
  }else{

    while($row = mysqli_fetch_assoc($select_all_posts)){
      $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_user = $row['post_user'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_tags = $row['post_tags'];
      $post_status = $row['post_status'];
?>
      <!-- KK: post -->

      <!-- Title -->
      <h2>
          <?php echo $post_title ?>
          <?php
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'&&  $post_status == 'Draft' ){
              echo "Draft";
            }
          ?>
      </h2>

      <!-- Author -->
      <p class="lead">
        by
        <a href="/CMS_system/author/<?php echo $post_author?>">
            <?php
              $query = "SELECT * FROM users WHERE user_role = 'Author' OR user_role = 'Admin'";
              $select_all_authors = mysqli_query($connection, $query);
              while($row = mysqli_fetch_assoc($select_all_authors)){
                $user_id = $row['user_id'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_name = $row['username'];
                  if(empty($user_firstname) && empty($user_lastname)){
                    $user_firstname = $user_name;
                  }
                  if($user_id == $post_author){
                    $author = $user_firstname . " " .$user_lastname;
                  }
                }
              echo "$author";
            ?>
          </a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

      <hr>

      <!-- Preview Image -->
      <?php
      if(isset($post_image) && $post_image != ""){?>
        <img class="img-fluid rounded" src="/CMS_system/images/<?php echo $post_image ?>" alt="">

        <hr>
      <?php } ?>

      <!-- Post Content -->
      <p class="lead">
        <?php echo $post_content ?>
      </p>

      <hr>
<?php
    }
    // KK: Comment section
    include 'comments.php';
  }
}
?>
