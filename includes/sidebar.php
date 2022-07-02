<!-- Kevin Kraaijveld - CMS system - sidebar
============================================================================
Frontend - Sidebar
-->

<!-- KK: Sidebar -->
<div class="col-md-4">

    <!-- KK: search section -->
    <div class="card my-4">
      <h4 class="card-header">
          Blog Search
      </h4>
      <div class="card-body">
        <form class="input-group" action="/CMS_system/search.php" method="post" autocomplete="off">
          <input name="search" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <input type="submit" class="btn btn-secondary" name="submit" value="Search">
            </span>
        </form>
      </div>
    </div>

    <!-- KK: login -->
    <?php if(!isset($_SESSION['user_id'])){ ?>
    <div class="card my-4">
        <h4 class="card-header">Login</h4>
        <div class="card-body">
          <form class="input-group" action="includes/login.php" method="post" autocomplete="off">
            <div class="form-group">
              <input name="username" type="text" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
              <input name="user_password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <span class="input-group-btn">
                <input type="submit" class="btn btn-secondary" name="login" value="Login">
              </span>
            </div>
          </form>
        </div>
    </div>
  <?php } ?>

    <!-- KK: Categories sidebar -->
    <div class="card my-4">
        <h4 class="card-header">Blog Categories</h4>
        <div class="card-body">
          <div class="row">
              <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <!-- KK:Select all categories and return as li -->
                    <?php
                    $query = "SELECT * FROM categories LIMIT 5";
                    $select_all_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_categories)){
                      $cat_id = $row['cat_id'];
                      $cat_title = $row['cat_title'];
                      echo "<li><a href='category/$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                  </ul>
              </div>
          </div>
        </div>
    </div>

    <!-- KK: side widget -->
    <div class="card my-4">
        <h4  class="card-header">About the CMS system</h4>
        <div class="card-body">
          <p>This is a personal CMS system for little code snippets to help with quick programming.</p>
        </div>
    </div>

</div>
