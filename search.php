<!-- Kevin Kraaijveld - CMS system - search
============================================================================
Frontend - display all posts with searchword
-->

<!-- KK: Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: Header -->
<?php include 'includes/header.php'; ?>

<div class="container">

    <div class="row">

        <div class="col-md-8">

            <h1 class="page-header">
                CMS system by Kevin Kraaijveld
                <br>
                <small>Imagine that!</small>
            </h1>

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
          echo"<h1>Keyword: ". $search . "</h1>";

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $select_all_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_posts)){
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_user = $row['post_user'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_tags = $row['post_tags'];
  ?>
              <!-- KK: Post -->
              <h2>
                <a href="#"><?php echo $post_title ?></a>
              </h2>
              <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
              </p>
              <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
              <hr>
              <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
              <p><?php echo $post_content ?></p>
              <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
              <hr>
  <?php
            }
        }
    }
  ?>

</div>

<!-- KK: Sidebar -->
<?php include 'includes/sidebar.php'; ?>
</div>
<hr>
<!-- KK: Footer -->
<?php include 'includes/footer.php'; ?>
