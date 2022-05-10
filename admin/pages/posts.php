<!-- Kevin Kraaijveld - CMS system - Posts
============================================================================
Shows a table to display all posts
-->

<!-- KK: Database -->
<?php include '../includes/db.php'; ?>
<!-- KK: Header -->
<?php include '../includes/header.php'; ?>

  <div id="wrapper">

      <!-- KK: Navigation -->
      <?php include '../includes/navigation.php'; ?>

        <div id="page-wrapper">

          <div class="container-fluid">

              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Posts
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file-o"></i> <a href="posts.php">Posts</a>
                            </li>
                        </ol>
                </div>

                  <!-- KK: Posts table -->
                  <div class="col-lg-12">
                    <?php
                    if(isset($_GET['source'])){
                      $source = $_GET['source'];
                    }
                    switch ($source) {
                      case 'add_post':
                        include 'add_post.php';
                        break;

                      case 'edit_post':
                        include 'edit_post.php';
                        break;

                      default:
                        include 'show_all_posts.php';
                        break;
                    }
                    ?>
                  </div>
              </div>

          </div>

      </div>

  </div>

<!-- KK: Footer -->
<?php include '../includes/footer.php'; ?>
