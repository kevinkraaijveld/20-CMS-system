<!-- Kevin Kraaijveld - CMS system - Categories
============================================================================
Shows a table to display all categories
-->
<!-- KK: Delete modal -->
<?php include '../includes/delete_modal.php'; ?>
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
                          Categories
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-wrench"></i> Categories
                            </li>
                        </ol>
                      </div>
                  	<!-- KK: Leftside -->
                    <div class="col-lg-6">
                      <!-- KK: Create -->
                        <form class="form-group" action="categories.php" method="post" autocomplete="off">
                          <div class="form-group">
                            <label for="cat_title">Category title</label>
                            <input class="form-control" type="text" name="cat_title" placeholder="Category title">
                          </div>
                          <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                          </div>
                        </form>
                        <!-- KK: store_category functions in functions.php -->
                        <?php
                        store_category();
                        ?>

                        <!-- KK: Edit -->
                        <?php
                        if (isset($_GET['edit'])){
                          $cat_id = $_GET['edit'];

                          $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                          $select_categories_id = mysqli_query($connection ,$query);

                          while($row = mysqli_fetch_assoc($select_categories_id)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                        ?>

                            <form class="form-group" action="categories.php" method="post">
                              <div class="form-group">
                                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>"/>
                                <label for="cat_title">Edit title</label>
                                <input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)){echo $cat_title;} ?>" placeholder="Category title">
                              </div>
                              <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                              </div>
                            </form>
                          <?php } ?>
                        <?php  } ?>

                        <!-- KK: change_category functions in functions.php -->
                        <?php
                        change_category();
                        ?>
                      </div>

                  <!-- KK: Leftside -->
                  <div class="col-lg-6">
                    <!-- KK: Categories Table -->
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Category title</th>
                          <th>Edit</th>
                          <?php if($_SESSION['user_role'] === 'Admin'){?>
                            <th>Delete</th>
                          <?php } ?>
                        </tr>
                      </thead>

                      <tbody>
                        <!-- KK: index_categories functions in functions.php -->
                        <?php
                        index_categories();
                        ?>
                        <!-- KK: destroy_category functions in functions.php -->
                        <?php
                        destroy_category();
                        ?>
                      </tbody>
                    </table>

                  </div>

              </div>

          </div>

      </div>

  </div>

<!-- KK: Footer -->
<?php include '../includes/footer.php'; ?>
