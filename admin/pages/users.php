<!-- Kevin Kraaijveld - CMS system - Users
============================================================================
Shows a table to display all users
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
                          Users
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> <a href="users.php">Users</a>
                            </li>
                        </ol>
                </div>

                  <!-- KK: Users table -->
                  <div class="col-lg-12">
                    <?php
                    if(isset($_GET['source'])){
                      $source = $_GET['source'];
                    }
                    switch ($source) {

                      case 'add_user':
                        include 'add_user.php';
                        break;

                      case 'edit_user':
                        include 'edit_user.php';
                        break;

                      default:
                        include 'show_all_users.php';
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
