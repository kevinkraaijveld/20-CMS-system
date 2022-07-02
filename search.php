<!-- Kevin Kraaijveld - CMS system - search
============================================================================
Frontend - displays all posts with searchword
-->

<!-- KK: includes Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: includes Header -->
<?php include 'includes/header.php'; ?>

<div class="container">

    <div class="row">

      <!-- KK: Title -->
        <div class="col-md-8">
          <br>
            <h1 class="page-header">
                CMS system by Kevin Kraaijveld
                <br>
                <small>Imagine that!</small>
            </h1>
          <br>

<!-- KK: Show all posts with searchword -->
  <?php
  if (isset($_POST['submit'])) {
     $search = $_POST['search'];

      $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
      $search_query = mysqli_query($connection, $query);

        if (!$search_query) {
          die ("QUERY FAILED" . mysqli_error($connection));
        }

        $count = mysqli_num_rows($search_query);
        if ($count==0) {
          echo "No result found";
        }else{
          echo"<h1>Keyword: ". $search . "</h1><br>";

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $select_all_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts)){
              $post_title = $row['post_title'];
              $post_id = $row['post_id'];
              $post_author = $row['post_author'];
              $post_user = $row['post_user'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_tags = $row['post_tags'];

  ?>

      <!-- KK: Post -->
              <!-- KK: title  -->
              <h2>
                <a href="/CMS_system/post/<?php echo $post_id?>"><?php echo $post_title ?></a>
              </h2>

              <!-- KK: Author -->
              <p class="lead">
                by <a href="/CMS_system/author/<?php echo $post_author?>">
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

              <!-- KK: Date -->
              <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
              <hr>

              <!-- KK: Image -->
              <?php
              if(isset($post_image) && $post_image != ""){?>
                <a href="/CMS_system/post/<?php echo $post_id?>">
                  <img class="card-img-top" src="images/<?php echo $post_image ?>" alt="Card image cap">
                </a>
                <br><br>
              <?php } ?>

              <!-- KK: Content -->
              <p><?php echo $post_content ?></p>

            </pre>

            <!-- KK: Read more -->
              <a class="btn btn-primary" href="/CMS_system/post/<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
              <hr>

  <?php
            }
        }
    }
  ?>

</div>

<!-- KK: includes Sidebar -->
<?php include 'includes/sidebar.php'; ?>

</div>

<!-- KK: includes Footer -->
<?php include 'includes/footer.php'; ?>
