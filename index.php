<!-- Kevin Kraaijveld - CMS system - index
============================================================================
Frontend - displays all posts on index.php
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

            <!-- KK: Includes content.php to display all post -->
            <?php include 'includes/content.php'; ?>

        </div>

        <!-- KK: includes Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

    </div>

<!-- KK: includes Footer -->
<?php include 'includes/footer.php'; ?>
