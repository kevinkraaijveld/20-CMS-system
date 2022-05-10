<!-- Kevin Kraaijveld - CMS system - navigation
============================================================================
Frontend - Navigation bar
-->
<!-- KK: Navigation -->
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Kevii CMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="nav navbar-nav">

        <?php
          $query = "SELECT * FROM categories";

          $select_all_categories = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($select_all_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            $category_class = '';
            $contact_class = '';
            $registration_class = '';

            $pageName = basename($_SERVER['PHP_SELF']);
            $contactPage = 'contact.php';
            $registerPage = 'registration.php';
            if(isset($_GET['category']) && $_GET['category'] == $cat_id){
              $category_class = 'active';
            }elseif($pageName === $contactPage){
              $contact_class = 'active';
            }elseif($pageName === $registerPage){
              $registration_class = 'active';
            }
            echo "<li class='nav-item $category_class'><a href='category.php?category=$cat_id' class='nav-link'>{$cat_title}</a></li>";
          }
        ?>

        <li class='nav-item <? echo $contact_class?>'><a href="contact.php" class='nav-link'>Contact</a></li>

        <!-- KK: If user is logged in -->
        <?php
          if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'Admin' || $_SESSION['user_role'] == 'Author'){?>

                <li class="nav-item"><a href="admin/pages/index.php"  class='nav-link'>Admin</a></li>
                <?php if(isset($_GET['post_id'])){
                  $post_id=$_GET['post_id'];
                  echo"<li class='nav-item'><a href='admin/pages/posts.php?source=edit_post&post_id=$post_id'  class='nav-link'>Edit post</a></li>";
                }
          ?>
          <?php
              }
          ?>
        </ul>
      </div>
      <!-- KK: user menu right -->
      <ul class="nav navbar-nav navbar-right">

          <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];?> <b class="caret"></b></a>
          </li>

          <li class='nav-item'>
              <a href="includes/logout.php" class='nav-link'><i class="fa fa-fw fa-power-off"></i> Log Out</a>
          </li>

      </ul>

    <!-- KK: If user is not logged in -->
    <?php

    }else{?>
    </ul>
    </div>
    <!-- KK: user menu right -->
    <ul class="nav navbar-nav navbar-right">
    <li class='nav-item <? echo $registration_class?>'><a href='registration.php' class='nav-link'>Register</a></li>
    </ul>
    <?php
    }
    ?>
  </div>
</nav>
