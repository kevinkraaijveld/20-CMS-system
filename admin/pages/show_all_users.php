<!-- Kevin Kraaijveld - CMS system - users content
============================================================================
Shows content for users table
-->
<!-- KK: Delete modal -->
<?php include '../includes/delete_modal.php'; ?>

<?php if($_SESSION['user_role'] === 'Admin'){?>
  <a href="users.php?source=add_user">Add user</a>
<?php } ?>
<br><br>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Image</th>
      <th>Role</th>
      <?php if($_SESSION['user_role'] === 'Admin'){?>
        <th>Edit</th>
        <th>Delete</th>
      <?php } ?>
      <th>View</th>
    </tr>
  </thead>
  <tbody>
    <!-- KK: index_users functions in functions.php -->
    <?php
    index_users();
    ?>
    <!-- KK: destroy_user functions in functions.php -->
    <?php
    destroy_user();
    ?>

  </tbody>

</table>
