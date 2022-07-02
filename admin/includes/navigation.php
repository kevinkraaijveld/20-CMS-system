<!-- KK: Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


    <!-- KK: Mobile menu -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../pages/index.php">CMS Admin</a>
    </div>


    <!-- KK: Menu Items top-->
    <ul class="nav navbar-right top-nav">
      <!-- KK: users_online functions.php 5 -->
      <li><a>Users online: <?php echo users_online();?></a></li>
      <li>
          <a href="../../index.php"><i class="fa fa-globe"></i> Front page</a>
      </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>


    <!-- KK Sidebar Menu -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <?php
      $dashboard_class = '';
      $posts_class = '';
      $categories_class = '';
      $comments_class = '';
      $users_class = '';
      $profile_class = '';


      $pageName = basename($_SERVER['PHP_SELF']);

      $dashboardPage = 'index.php';
      $postsPage = 'posts.php';
      $categoriesPage = 'categories.php';
      $commentsPage = 'comments.php';
      $usersPage = 'users.php';
      $profilePage = 'profile.php';

      switch ($pageName) {
          case $dashboardPage:
              $dashboard_class = 'active';
              break;
          case $postsPage:
              $posts_class = 'active';
              break;
          case $categoriesPage:
              $categories_class = 'active';
              break;
          case $commentsPage:
              $comments_class = 'active';
              break;
          case $usersPage:
              $users_class = 'active';
              break;
          case $profilePage:
              $profile_class = 'active';
              break;
      }
      ?>

        <ul class="nav navbar-nav side-nav">
            <li class='<? echo $dashboard_class?>'>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li  class='<? echo $posts_class?>'>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts" class="collapse">
                    <li>
                        <a href="posts.php">Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">New post</a>
                    </li>
                </ul>
            </li>
            <li  class='<? echo $categories_class?>'>
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li>
            <li  class='<? echo $comments_class?>'>
                <a href="comments.php"><i class="glyphicon glyphicon-comment"></i> Comments</a>
            </li>
            <li  class='<? echo $users_class?>'>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users" class="collapse">
                    <li>
                        <a href="users.php"><i class="fa fa-users"></i></i> Users</a>
                    </li>
                    <?php if($_SESSION['user_role'] === 'Admin'){?>
                      <li>
                          <a href="users.php?source=add_user"><i class="fa fa-user"></i> Add user</a>
                      </li>
                    <?php } ?>
                </ul>
            </li>
            <li  class='<? echo $contact_class?>'>
                <a href="contact.php"><i class="glyphicon glyphicon-envelope"></i> Contact</a>
            </li>
            <li  class='<? echo $profile_class?>'>
                <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
            </li>
        </ul>

    </div>

</nav>
