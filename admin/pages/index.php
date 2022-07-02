<!-- Kevin Kraaijveld - CMS system - index
============================================================================
Dashboard - index.php
-->

<!-- KK: Header -->
<?php include '../includes/header.php'; ?>

    <div id="wrapper">

        <?php include '../includes/navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            CMS admin pannel
                            <small>by Kevin Kraaijveld</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-12">
                      <h2>Welcome <?php echo $_SESSION['user_firstname'];?></h2>
                    </div>
                    <div class="col-lg-12">
                      <?php include '../includes/admin_widgets.php'; ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

<!-- KK: Footer -->
<?php include '../includes/footer.php'; ?>
