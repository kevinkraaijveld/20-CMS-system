<!-- Kevin Kraaijveld - CMS system - Logout
============================================================================
Logout user - include for navigation.php
-->

<!-- KK: Start session -->
<?php session_start(); ?>

<!-- KK: nullify all sessions -->
<?php
$_SESSION['user_id'] = null;
$_SESSION['username'] = null;
$_SESSION['user_firstname'] = null;
$_SESSION['user_lastname'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_password'] = null;

header("Location: ../index.php");
?>
