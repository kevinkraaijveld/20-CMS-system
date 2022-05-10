<!-- Kevin Kraaijveld - CMS system - posts content
============================================================================
Shows content for posts table
-->
<!-- KK: Delete modal -->
<?php include '../includes/delete_modal.php'; ?>

<a href="posts.php?source=add_post">Add post</a>
<br><br>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Title</th>
      <th>Category</th>
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Date</th>
      <th>Edit</th>
      <?php if($_SESSION['user_role'] === 'Admin'){?>
        <th>Delete</th>
      <?php } ?>
      <th>Views</th>
    </tr>
  </thead>
  <tbody>
    <!-- KK: index_posts functions in functions.php -->
    <?php
    index_posts();
    ?>
    <!-- KK: destroy_post functions in functions.php -->
    <?php
    destroy_post();
    ?>

  </tbody>

</table>
