<!-- Kevin Kraaijveld - CMS system - Contact
============================================================================
Frontend - contact.php
-->
<!-- KK: Database -->
<?php include 'includes/db.php'; ?>
<!-- KK: Header -->
<?php include 'includes/header.php'; ?>

<?php

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];


  $query = "INSERT INTO contact (name, email, message)";
  $query .= "VALUES('{$name}', '{$email}', '{$message}')";

  $submit_contact = mysqli_query($connection, $query);
  echo"<div class='alert alert-success alert-dismissible fade in'> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Message submitted</div>";

}

?>
  <!-- KK: Content -->
  <div class="container">

      <div class="row">

              <div class="col-xs-6 col-xs-offset-3">
                  <div class="form-wrap">
                  <h1>Contact</h1>
                      <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                          <div class="form-group">
                              <label for="name" class="sr-only">Name</label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                          </div>
                           <div class="form-group">
                              <label for="email" class="sr-only">Email</label>
                              <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                          </div>
                           <div class="form-group">
                              <label for="message" class="sr-only">Message</label>
                              <textarea class="form-control" name="message" rows="7" cols="73"></textarea>
                          </div>

                          <input type="submit" name="submit" class="btn btn-custom btn-lg btn-block" value="Submit">
                      </form>

                  </div>

              </div>

          </div>

<hr>
<!-- KK: Footer -->
<?php include 'includes/footer.php'; ?>
