<!-- Kevin Kraaijveld - CMS system - category
============================================================================
Frontend - display all posts from a single category
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

            <!-- KK: Content -->
            <?php include 'includes/category.php'; ?>

        </div>

        <!-- KK: Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
      </div>
<!-- KK: Footer -->
<?php include 'includes/footer.php'; ?>