<!-- Kevin Kraaijveld - CMS system - Edit a user
============================================================================
Displays a form to edit a user from the database
-->

<!-- KK: Load fields from user id url -->

<?php

  if (isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_by_id)){
      $username = $row['username'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_password = $row['user_password'];
      $user_role = $row['user_role'];
      $user_image = $row['user_image'];
    }
?>

<!-- KK: Send form to database -->

<?php
  if(isset($_POST['update_user'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../../images/avatars/$user_image");

    if(empty($user_image)){
      $query = "SELECT user_image from users WHERE user_id =  {$user_id}";
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
    }else{
      $query_password = "SELECT user_password from users WHERE user_id = {$user_id}";
      $get_user_query = mysqli_query($connection, $query_password);
      while($row = mysqli_fetch_assoc($get_user_query)){
        $user_password = $row['user_password'];
      }
    }

      $query = "UPDATE users SET ";
      $query .= "username = '{$username}', ";
      $query .= "user_firstname = '{$user_firstname}', ";
      $query .= "user_lastname = '{$user_lastname}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_password = '{$user_password}', ";
      $query .= "user_role = '{$user_role}', ";
      $query .= "user_image = '{$user_image}' ";
      $query .= "WHERE user_id = {$user_id}";
      $update_user = mysqli_query($connection, $query);

    echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>User updated</div>";
  }
}else{
  header("Location: users.php");
}
?>

<h2>Edit user</h2><small></small>

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
    <label for="user_role">Role</label>
    <br>
    <select class="form-control" name="user_role">
      <?if($user_role == "Subscriber"){
        echo"<option value='Subscriber' selected>Subscriber</option>";
        echo"<option value='Author'>Author</option>";
        echo"<option value='Admin'>Admin</option>";
      }elseif($user_role == "Author"){
        echo"<option value='Subscriber'>Subscriber</option>";
        echo"<option value='Author' selected>Author</option>";
        echo"<option value='Admin'>Admin</option>";
      }elseif($user_role == "Admin"){
        echo"<option value='Subscriber'>Subscriber</option>";
        echo"<option value='Author'>Author</option>";
        echo"<option value='Admin' selected>Admin</option>";
      }else{
        echo"<option value='Subscriber'>Subscriber</option>";
        echo"<option value='Author'>Author</option>";
        echo"<option value='Admin'>Admin</option>";
      }?>
    </select>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_user" value="Submit">
  </div>

</form>
