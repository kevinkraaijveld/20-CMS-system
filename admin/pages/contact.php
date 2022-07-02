<!-- Kevin Kraaijveld - CMS system - Contact

============================================================================

Shows a table to display all contact entries

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
                          Contact
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-envelope"></i> <a href="contact.php">Contact</a>
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

                      case 'view_contact':
                        include 'view_contact.php';
                        break;


                      case 'view':
                        include 'show_all_contact.php';
                        break;
                      default:
                        include 'show_all_contact.php';
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
