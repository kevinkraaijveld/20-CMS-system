<!-- KK: Start session -->
<?php ob_start(); ?>

<!-- KK: Database -->
<?php require '../includes/db.php'; ?>

<!-- KK: Functions.php -->
<?php include '../includes/functions.php'; ?>


<!-- KK: Start session -->
<?php session_start(); ?>

<!-- KK: Send user back if they are not logged in or if they are a subscriber -->
<?php
if(isset($_SESSION['user_role'])){
  if($_SESSION['user_role'] == 'Subscriber'){
    header("Location: ../../index.php");
  }
}else{
  header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog">
    <meta name="author" content="Kevin Kraaijveld">

    <title>CMS Admin system by Kevin Kraaijveld</title>

    <!-- KK: Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- KK: Page CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- KK: Custom Fonts -->
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- KK: Custom CSS-->
    <link href="../css/stylesheet.css" rel="stylesheet">

    <!-- KK: Google chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- KK: jQuery -->
    <script src="../js/jquery.js"></script>
    
    <!-- KK: Text editor-->
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


</head>

<body>
