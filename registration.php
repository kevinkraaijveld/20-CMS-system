<!-- Kevin Kraaijveld - CMS system - registration
============================================================================
Frontend - displays registration form
-->

<!-- KK: includes Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: includes Header -->
<?php include 'includes/header.php'; ?>

<!-- KK: insert new user in database -->
<?php
if(isset($_POST['register'])){
  $register_username = $_POST['username'];
  $register_user_email  = $_POST['user_email'];
  $register_user_password  = $_POST['user_password'];

  $query ="SELECT username FROM users WHERE username = '$register_username'";
  $usercheck_query = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($usercheck_query)){
    $user_name = $row['username'];
  }

  $query ="SELECT user_email FROM users WHERE user_email = '$register_user_email'";
  $usermail_query = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($usermail_query)){
    $user_email = $row['user_email'];
  }

  if($user_name == ucfirst($register_username) || $user_name == $register_username){
    echo"<div class='alert alert-danger alert-dismissible'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username " . $register_username . " exists</div>";
  }elseif ($user_email == $register_user_email) {
    echo"<div class='alert alert-danger alert-dismissible'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email " . $register_user_email . " exists</div>";
  }else{
    if(!empty($register_username) && !empty($register_user_email) && !empty($register_user_password)){
      $register_username = mysqli_real_escape_string($connection, $register_username);
      $register_user_email = mysqli_real_escape_string($connection, $register_user_email);
      $register_user_password = mysqli_real_escape_string($connection, $register_user_password);

      $register_user_password = password_hash($register_user_password, PASSWORD_BCRYPT, array('cost'=>10) );

      $query = "INSERT INTO users(username, user_email, user_password, user_image, user_role) ";
      $query .= "VALUES('{$register_username}', '{$register_user_email}', '{$register_user_password}', 'avatar.jpg', 'Subscriber')";

      $register_user_query = mysqli_query($connection, $query);
        // KK: alert user registered
      echo"<div class='alert alert-success alert-dismissible'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Username $register_username registered</div>";
    }else{
        // KK: alert message empty fields
      echo"<div class='alert alert-danger alert-dismissible'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You can't submit an empty form</div>";

    }
  }



}

?>

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

            <!-- KK: Form -->
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

           <!-- KK: includes Sidebar -->
           <?php include 'includes/sidebar.php'; ?>

      </div>

<!-- KK: includes Footer -->
<?php include 'includes/footer.php'; ?>
