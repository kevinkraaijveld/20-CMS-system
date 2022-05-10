<!-- Kevin Kraaijveld - CMS system - Login
============================================================================
Logout user
-->

<!-- KK: Database -->
<?php include 'db.php'; ?>
<!-- KK: Start session -->
<?php session_start(); ?>

<!-- KK: Login user and role check -->
<?php
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $user_password = $_POST['user_password'];

  $username = mysqli_real_escape_string($connection, $username);
  $user_password = mysqli_real_escape_string($connection, $user_password);

  $query = "SELECT * FROM users WHERE username = '{$username}'";
  $select_user = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_user)) {
    $db_user_id = $row['user_id'];
    $db_username= $row['username'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_email = $row['user_email'];
    $db_user_role = $row['user_role'];
    $db_user_image = $row['user_image'];
    $db_user_password = $row['user_password'];
  }

  $user_password = crypt($user_password, $db_user_password);

  if($username === $db_username && $user_password === $db_user_password  && $db_user_role === 'Admin' || $db_user_role === 'Author' ){
    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['user_firstname'] = $db_user_firstname;
    $_SESSION['user_lastname'] = $db_user_lastname;
    $_SESSION['user_email'] = $db_user_email;
    $_SESSION['user_role'] = $db_user_role;
    $_SESSION['user_image'] = $db_user_image;
    $_SESSION['user_password'] = $db_user_password;

    header("Location: ../admin/pages/index.php");

  }elseif($username === $db_username && $user_password === $db_user_password  && $db_user_role === 'Subscriber' ){
    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['user_firstname'] = $db_user_firstname;
    $_SESSION['user_lastname'] = $db_user_lastname;
    $_SESSION['user_email'] = $db_user_email;
    $_SESSION['user_role'] = $db_user_role;
    $_SESSION['user_image'] = $db_user_image;
    $_SESSION['user_password'] = $db_user_password;

    header("Location: ../index.php");
  }else{
    header("Location: ../index.php");
  }
}
?>
