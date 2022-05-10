<!-- Kevin Kraaijveld - CMS system - Add a User
============================================================================
Displays a form to add a user to the database
-->

<?php
// KK: store_user function in functions.php
store_user();
?>

<form class="form-group" action="" method="post" enctype="multipart/form-data" autocomplete="off">

  <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" type="text" name="username" placeholder="Username" >
  </div>

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input class="form-control" type="text" name="user_firstname" placeholder="Firstname">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input class="form-control" type="text" name="user_lastname" placeholder="Lastname">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input class="form-control" type="email" name="user_email" placeholder="Email" >
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input class="form-control" type="text" name="user_password" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="user_image">User image</label>
    <input class="form-control-file" type="file" name="user_image">
  </div>

  <div class="form-group">
    <label for="user_role">Role</label>
    <br>
    <select class="form-control" name="user_role">
        <option value='Subscriber'>Subscriber</option>
        <option value='Author'>Author</option>
        <option value='Admin'>Admin</option>
    </select>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Submit">
  </div>

</form>
