<!-- Kevin Kraaijveld - CMS system - Contact content
============================================================================
Shows content for contacts table
-->
<!-- KK: Delete modal -->
<?php include '../includes/delete_modal.php'; ?>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>View</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <!-- KK: index_comments functions in functions.php -->
    <?php
    index_contact();
    ?>
    <!-- KK: destroy_comment functions in functions.php -->
    <?php
    destroy_contact();
    ?>

  </tbody>

</table>
