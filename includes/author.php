<!-- Kevin Kraaijveld - CMS system - author
============================================================================
Frontend - include for author.php
-->

<!-- KK: Content -->
<?php
    if(isset($_GET['author'])){
      $author = $_GET['author'];
    }
?>

<?php
  $query = "SELECT * FROM users WHERE user_id = $author";
  $select_all_authors = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($select_all_authors)){
    $user_id = $row['user_id'];
    $username = $row['$username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_name = $row['username'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
      if(empty($user_firstname) && empty($user_lastname)){
        $user_firstname = $user_name;
      }
      echo "<h2>" . $user_firstname . " " . $user_lastname . "</h2>" ;
      echo "<div class='container'>";
      echo "<img  style='width:150px; float:left; margin:20px' class='img-responsive' src='/CMS_system/images/avatars/" . $user_image . " '>";
      echo "<br>";
      echo "Username: " . $user_name;
      echo "<br>";
      echo "First name: " . $user_firstname;
      echo "<br>";
      echo "Last name: " . $user_lastname;
      echo "<br>";
      echo "Email: " . $user_email;
      echo "</div>";

    }
?>

<br><br><br>
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
$select_posts_count = "SELECT * FROM posts WHERE post_status = 'Published' AND post_author = '$author' ";
$find_count = mysqli_query($connection, $select_posts_count);
$count = mysqli_num_rows($find_count);
if($count < 1){
  echo "<h2>No posts available</h2>";
}
$count = ceil ($count / $per_page);
?>

<?php

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin' ){
  $query = "SELECT * FROM posts WHERE post_author = '$author'  ORDER BY post_date DESC LIMIT $page_1, $per_page";
}else{
  $query = "SELECT * FROM posts WHERE post_author = '$author' AND post_status = 'Published' ORDER BY post_date DESC LIMIT $page_1, $per_page";
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
      <!-- KK: post -->
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
              <img class="card-img-top" src="images/<?php echo $post_image ?>" alt="Card image cap">
            </a>
            <br><br>
          <?php } ?>

          <!-- Post Content -->
          <p class="card-text">
            <?php echo $post_content ?>
          </p>
        </pre>

          <a class="btn btn-primary" href="/CMS_system/post/<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
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
            </a>
          </div>
        </div>

<?php
    }
?>
