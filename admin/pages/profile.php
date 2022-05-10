<!-- Kevin Kraaijveld - CMS system - Users
============================================================================
Shows a table to display all users
-->

<!-- KK: Database -->
<?php include '../includes/db.php'; ?>
<!-- KK: Header -->
<?php include '../includes/header.php'; ?>
<!-- KK: Send form to database -->

<?php
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    $select_user = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user)) {
      $user_id = $row['user_id'];
      $username= $row['username'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_password = $row['user_password'];
    }
  }

?>
<?php
  if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../../images/avatars/$user_image");

    if(empty($user_image)){
      $query = "SELECT * from users WHERE user_id =  {$user_id}";
      $empty_image = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($empty_image)){
        $user_image = $row['user_image'];
      }
    }
    if(!empty($user_password)){
      $query_password = "SELECT user_password from users WHERE user_id = {$user_id}";
      $get_user_query = mysqli_query($connection, $query_password);

      $row = mysqli_fetch_assoc($get_user_query);
      $db_user_password = $row['user_password'];

      if($db_user_password !== $user_password){
        $options = ['cost'=>10];
        $user_password = password_hash("$user_password", PASSWORD_BCRYPT, $options );
      }else{
        $user_password = $db_user_password;
      }

      $query = "UPDATE users SET ";
      $query .= "username = '{$username}', ";
      $query .= "user_firstname = '{$user_firstname}', ";
      $query .= "user_lastname = '{$user_lastname}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_password = '{$user_password}', ";
      $query .= "user_image = '{$user_image}' ";
      $query .= "WHERE user_id = {$user_id}";
      $update_user = mysqli_query($connection, $query);
    }

  }
?>

  <div id="wrapper">

      <!-- KK: Navigation -->
      <?php include '../includes/navigation.php'; ?>

        <div id="page-wrapper">

          <div class="container-fluid">

              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Profile
                          <small>by Kevin Kraaijveld</small>
                      </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> <a href="profile.php">Profile</a>
                            </li>
                        </ol>
                </div>

                  <!-- KK: Users table -->
                  <div class="col-lg-12">


                    <h2>Edit Profile</h2><small></small>
                    <form class="form-group" action="" method="post" enctype="multipart/form-data" autocomplete="off">

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $username?>" placeholder="Username">
                      </div>

                      <div class="form-group">
                        <label for="user_firstname">Firstname</label>
                        <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname?>" placeholder="Firstname">
                      </div>

                      <div class="form-group">
                        <label for="user_lastname">Lastname</label>
                        <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname?>" placeholder="Lastname">
                      </div>

                      <div class="form-group">
                        <label for="user_email">Email</label>
                        <input class="form-control" type="email" name="user_email" value="<?php echo $user_email?>" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label for="user_password">Password</label>
                        <input class="form-control" type="text" name="user_password" placeholder="Password">
                      </div>

                      <div class="form-group">
                        <label for="user_image">User image</label>
                        <br>
                        <img src="../../images/avatars/<?php echo $user_image?>" style="width:150px;">
                        <br><br>
                        <input class="form-control-file" type="file" name="user_image" id ="user_image" >
                      </div>

                      <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_profile" value="Submit">
                      </div>

                    </form>
                  </div>
              </div>

          </div>

      </div>

  </div>

<!-- KK: Footer -->
<?php include '../includes/footer.php'; ?>
