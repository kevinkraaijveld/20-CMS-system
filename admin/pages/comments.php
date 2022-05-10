<!-- Kevin Kraaijveld - CMS system - Comments
============================================================================
Shows a table to display all comments
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
                          Comments
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-comment"></i> <a href="comments.php">Comments</a>
                            </li>
                        </ol>
                </div>

                  <!-- KK: Comments table -->
                  <div class="col-lg-12">
                    <?php
                    if(isset($_GET['source'])){
                      $source = $_GET['source'];
                    }
                    switch ($source) {

                      case 'edit_comment':
                        include 'edit_comment.php';
                        break;

                      case 'view':
                        include 'view_comments.php';
                        break;

                      default:
                        include 'show_all_comments.php';
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
