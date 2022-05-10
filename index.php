<!-- Kevin Kraaijveld - CMS system - index
============================================================================
Frontend - index.php
-->

<!-- KK: Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: Header -->
<?php include 'includes/header.php'; ?>


<div class="container">

    <div class="row">

        <div class="col-md-8">
          <br>
            <h1 class="page-header">
                CMS system by Kevin Kraaijveld
                <br>
                <small>Imagine that!</small>
            </h1>
            <br>
            <!-- KK: Content -->
            <?php include 'includes/content.php'; ?>

        </div>

        <!-- KK: Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
    </div>
<!-- KK: Footer -->
<?php include 'includes/footer.php'; ?>
