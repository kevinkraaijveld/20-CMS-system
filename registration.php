<!-- Kevin Kraaijveld - CMS system - registration
============================================================================
Frontend - registration.php
-->
<!-- KK: Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: Header -->
<?php include 'includes/header.php'; ?>

<?php
if(isset($_POST['register'])){
  $register_username = $_POST['username'];
  $register_user_email  = $_POST['user_email'];
  $register_user_password  = $_POST['user_password'];

  if(!empty($register_username) && !empty($register_user_email) && !empty($register_user_password)){
    $register_username = mysqli_real_escape_string($connection, $register_username);
    $register_user_email = mysqli_real_escape_string($connection, $register_user_email);
    $register_user_password = mysqli_real_escape_string($connection, $register_user_password);

    $register_user_password = password_hash($register_user_password, PASSWORD_BCRYPT, array('cost'=>10) );

    $query = "INSERT INTO users(username, user_email, user_password, user_image, user_role) ";
    $query .= "VALUES('{$register_username}', '{$register_user_email}', '{$register_user_password}', 'avatar.jpg', 'Subscriber')";

    $register_user_query = mysqli_query($connection, $query);
    echo"<div class='alert alert-success alert-dismissible fade in'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username $register_username registered</div>";

  }else{
    echo"<div class='alert alert-danger alert-dismissible fade in'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can't submit an empty form</div>";

  }


}
?>
  <!-- KK: Content -->
  <div class="container">

  <section id="login">
      <div class="container">
          <div class="row">
              <div class="col-xs-6 col-xs-offset-3">
                  <div class="form-wrap">
                  <h1>Register</h1>
                      <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                          <div class="form-group">
                              <label for="username" class="sr-only">username</label>
                              <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                          </div>
                           <div class="form-group">
                              <label for="email" class="sr-only">Email</label>
                              <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                          </div>
                           <div class="form-group">
                              <label for="password" class="sr-only">Password</label>
                              <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                          </div>

                          <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                      </form>

                  </div>

              </div>

          </div>

      </div>

  </section>

<hr>
<!-- KK: Footer -->
<?php include 'includes/footer.php'; ?>
