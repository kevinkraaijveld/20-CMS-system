<!-- Kevin Kraaijveld - CMS system - view comments
============================================================================
View all the comments beloning to one post
-->
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Post</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>View</th>
    </tr>
  </thead>
  <tbody>
    <!-- KK: index_comments functions in functions.php -->
    <?php
    index_post_comments();
    ?>
    <!-- KK: destroy_comment functions in functions.php -->
    <?php
    destroy_comment();
    ?>

  </tbody>

</table>
