<!-- Kevin Kraaijveld - CMS system - View contact
============================================================================
Displays a form to view a contact from the database
-->

<!-- KK: Load fields from user id url -->
<?php
  if (isset($_GET['contact_id'])){
    $contact_id = $_GET['contact_id'];

    $query = "SELECT * FROM contact WHERE id = {$contact_id}";

    $select_contact_by_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_contact_by_id)){

      $contact_id = $row['id'];
      $contact_name = $row['name'];
      $contact_mail = $row['email'];
      $contact_message = $row['message'];
    }
  }
?>

<h2>View Contact <?php echo $contact_id ?></h2>
  <form class="form-group" action="contact.php" method="post" enctype="multipart/form-data" autocomplete="off">

    <div class="form-group">
      <label for="cat_title">Contact name</label>
      <input class="form-control" type="text" name="contact_name" readonly value="<?php echo $contact_name?> " placeholder="contact name ">
    </div>

  <div class="form-group">
    <label for="post_author">Contact email</label>
    <input class="form-control" type="text" name="contact_mail" readonly value="<?php echo $contact_mail?>" placeholder="contact email">
  </div>


  <div class="form-group">
    <label for="post_content">Message</label>
    <br>
    <textarea class="form-control" name="contact_message" rows="10" style='width:-webkit-fill-available;' readonly><?php echo $contact_message?></textarea>
  </div>
    <div class="form-group">
      <input class="btn btn-primary" type="submit" value="Back">
    </div>

</form>
