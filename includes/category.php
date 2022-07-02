<!-- Kevin Kraaijveld - CMS system - category
============================================================================
Shows all posts with category in category.php
-->
<!-- KK: Content -->
<?php
if(isset($_GET['category'])){
  $category_id = $_GET['category'];
}
?>
<!-- KK: Pagination -->
<?php
$per_page = 3;
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = "";
}
if($page == "" || $page == 1){
  $page_1 = 0;
}else{
  $page_1 = ($page * $per_page) - $per_page;
}
$select_posts_count = "SELECT * FROM posts WHERE post_status = 'Published' AND post_category_id = '$category_id' ";
$find_count = mysqli_query($connection, $select_posts_count);
$count = mysqli_num_rows($find_count);
if($count < 1){
  echo "<h2>No posts available</h2>";
}
$count = ceil ($count / $per_page);
?>

<!-- KK: Title -->
  <h2><?php
    $query = "SELECT * FROM categories WHERE cat_id =$category_id ";
    $select_all_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_categories)){
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
      echo "$cat_title";
    }
  ?></h2>
</br>

<?php
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin' ){
  $query = "SELECT * FROM posts WHERE post_category_id = '$category_id' ORDER BY post_date DESC LIMIT $page_1, $per_page";
}else{
  $query = "SELECT * FROM posts WHERE post_status = 'Published' AND post_category_id = '$category_id' ORDER BY post_date DESC LIMIT $page_1, $per_page";
}


  $select_all_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_posts)){
      $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_user = $row['post_user'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = substr($row['post_content'], 0,250);
      $post_tags = $row['post_tags'];
      $post_status = $row['post_status'];
?>
      <!-- KK: posts -->
      <div class="card mb-4">

        <div class="card-body">
          <h2 class="card-title">
              <a href="/CMS_system/post/<?php echo $post_id?>">
                <?php echo $post_title ?>
              </a>
              <?php
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'&&  $post_status == 'Draft' ){
                  echo "Draft";
                }
              ?>
          </h2>

          <!-- KK: Image -->
          <?php
          if(isset($post_image) && $post_image != ""){?>
            <a href="/CMS_system/post/<?php echo $post_id?>">
              <img class="card-img-top" src="/CMS_system/images/<?php echo $post_image ?>" alt="Card image cap">
            </a>
            <br><br>
          <?php } ?>

          <!-- Post Content -->
          <p class="card-text">
            <?php echo $post_content ?>
          </p>
        </pre>
        <a href="/CMS_system/post/<?php echo $post_id?>" class="btn btn-primary">Read More &rarr;</a>
      </div>

        <div class="card-footer text-muted">
          <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> by

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
          </div>
        </div>

<?php } ?>

<!-- KK: Pagination -->
<ul class="pagination justify-content-center mb-4">
  <?php
  for ($i=1; $i <= $count ; $i++) {
    if($i == $page){
      echo "<li class='page-item'><a class='page-link active'  href='index.?page={$i}'>{$i}</a></li>";
    }else{
      echo "<li class='page-item'><a class='page-link' href='/CMS_system/category/$cat_id?page={$i}'>{$i}</a></li>";
    }

  }
  ?>
</ul>
