<?php
/*  Kevin Kraaijveld CMS system
============================================================================

0. System functions
1. Categories
2. Posts
3. Comments
4. Users
5. Users online

============================================================================ */

/* 0. System functions
/* Security Escape
---------------------------------------------------------------------------- */
function escape($string){
  global $connection;
  return mysqli_real_escape_string($connection, trim($string) );
}

/* recordCount widgets
---------------------------------------------------------------------------- */
function recordCount($table){
  global $connection;
  $query = "SELECT * FROM " . $table;
  $select_all_posts = mysqli_query($connection, $query);

  return mysqli_num_rows($select_all_posts);
}

/* chart widget
---------------------------------------------------------------------------- */
function checkStatus($table,$column,$status){
  global $connection;
  $query = "SELECT * FROM $table WHERE $column = '$status'";
  $select_all_posts = mysqli_query($connection, $query);
  return mysqli_num_rows($select_all_posts);
}

/* 1. Categories
Read
Create
Update
Delete
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

/* Read Categories
---------------------------------------------------------------------------- */
function index_categories(){
  global $connection;
  $query = "SELECT * FROM categories";

  $select_all_categories = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_categories)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    if($_SESSION['user_role'] === 'Admin'){
      echo "<td><a rel='$cat_id' href='javasctipt:void(0)' class='delete_link text-danger'>Delete</a></td>";
    }
    echo "</tr>";
  }
?>
  <script type='text/javascript'>
    $(document).ready(function(){
      $(".delete_link").on('click', function(){

        var id = $(this).attr("rel");
        var delete_url = "categories.php?delete="+ id +" ";

        $(".modal_delete").attr("href", delete_url);
        $("#myModal").modal("show");
      });
    });
  </script>
<?php
}

/* Create Category
---------------------------------------------------------------------------- */
function store_category(){
  global $connection;
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if($cat_title =="" || empty($cat_title)){
      echo"<div class='alert alert-danger alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>This field should not be empty</div>";
    }else{
      echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Category " . $cat_title . " created</div>";
      $query = "INSERT INTO categories (cat_title)";
      $query .= "VALUES ('$cat_title')";
      $result = mysqli_query($connection, $query);
    }
  }
}

/* Update Category
---------------------------------------------------------------------------- */
function change_category(){
  global $connection;
  if (isset($_POST['update'])) {
    $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['cat_title'];
    echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Category " . $cat_title . " updated</div>";

    $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
    $edit_query = mysqli_query($connection, $query);
  }
}

/* Delete Category
---------------------------------------------------------------------------- */
function destroy_category(){
  global $connection;
  if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
      if($_SESSION['user_role'] === 'Admin'){
        $delete_category = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_category}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php");
      }
    }
  }
}

/* 2. Posts
Read
Create
Update
Delete
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

/* Read Posts
---------------------------------------------------------------------------- */
function index_posts(){
  global $connection;

  $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
  $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
  $query .= "FROM posts ";
  $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY post_id desc";

  $select_all_posts = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_posts)){
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_views_count = $row['post_views_count'];
    $post_date = $row['post_date'];

    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo"<tr>";
      echo "<td>$post_id</td>";
      $query = "SELECT * FROM users WHERE user_role = 'Author' OR user_role = 'Admin' ";
      $select_all_authors = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_all_authors)){
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_name = $row['username'];
        if(empty($user_firstname) && empty($user_lastname)){
          $user_firstname = $user_name;
        }
        if($user_id == $post_author){
          $author = $user_firstname . " " .$user_lastname;
        }
      }
      echo "<td><a href='../../author/$post_author'>$author</a></td>";
      echo "<td><a href='../../post/$post_id'>$post_title</a></td>";

      echo "<td><a href='../../category/$post_category_id'>$cat_title</a></td>";
      if($_SESSION['user_id'] === $post_author || $_SESSION['user_role'] == 'Admin' ){
        if($post_status == "Published"){
          echo "<td><a href='posts.php?draft={$post_id}'>Published</a></td>";
        }elseif($post_status == "Draft"){
          echo "<td><a href='posts.php?published={$post_id}'>Draft</a></td>";
        }
      }else{
          echo "<td>$post_status</td>";
      }
      if(isset($post_image) && $post_image!=''){
        echo "<td><img src='../../images/$post_image' style='width:50px;'></td>";
      }else {
        echo "<td></td>";
      }
      echo "<td>$post_tags</td>";
      echo "<td><a href='comments.php?source=view&post_id=$post_id'>$post_comment_count</a></td>";
      echo "<td>$post_date</td>";
      if($_SESSION['user_id'] === $post_author || $_SESSION['user_role'] == 'Admin' ){
        echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
      }else{
          echo "<td></td>";
      }
      if($_SESSION['user_role'] === 'Admin'){
        echo "<td><a rel='$post_id' href='javasctipt:void(0)' class='delete_link text-danger'>Delete</a></td>";
      }
      echo "<td><a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
    echo"</tr>";

  }
?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $(".delete_link").on('click', function(){
      var id = $(this).attr("rel");
      var delete_url = "posts.php?delete="+ id +" ";
      $(".modal_delete").attr("href", delete_url);
      $("#myModal").modal("show");
    });
  });
  </script>
<?php
  if (isset($_GET['reset'])) {
    $post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$post_id}";
    $reset_query = mysqli_query($connection, $query);

    header("Location: posts.php");
  }

  if (isset($_GET['draft'])) {
    $post_id = $_GET['draft'];

    $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = {$post_id}";

    $pending_post = mysqli_query($connection, $query);

    header("Location: posts.php");
  }
  if (isset($_GET['published'])) {
    $post_id = $_GET['published'];

    $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = {$post_id}";
    $pending_post = mysqli_query($connection, $query);

    header("Location: posts.php");
  }
}
/* Create Post
---------------------------------------------------------------------------- */
function store_post(){

  global $connection;
  if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y H:i:s');

    move_uploaded_file($post_image_temp, "../../images/$post_image");
    echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Post created - <a href='/CMS_system/index.php'>View post</a></div>";


    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);

  }
}

/* Delete Post
---------------------------------------------------------------------------- */
function destroy_post(){
  global $connection;
  if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
      if($_SESSION['user_role'] === 'Admin'){
        $delete_post = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$delete_post}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
      }
    }
  }
}
/* 3. Comments
Read
Delete
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/* Read Comments
---------------------------------------------------------------------------- */
function index_comments(){
  global $connection;
  $query = "SELECT * FROM comments ORDER BY comment_id";

  $select_all_comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_comments)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo"<tr>";
      echo "<td>$comment_id</td>";
      $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
      $select_all_posts = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_all_posts)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
      }
      echo "<td><a href='posts.php?source=edit_post&post_id=$post_id'>$post_title</a></td>";
      echo "<td>$comment_author</td>";
      echo "<td>" . substr($comment_content, 0,20) . "</td>";
      echo "<td>$comment_email</td>";

      if($comment_status == "Approved"){
        echo "<td><a href='comments.php?pending={$comment_id}'>Approved</a></td>";
      }elseif($comment_status == "Pending"){
        echo "<td><a href='comments.php?approve={$comment_id}'>Pending</a></td>";
      }

      echo "<td>$comment_date</td>";
      echo "<td><a href='comments.php?source=edit_comment&comment_id={$comment_id}'>Edit</a></td>";
      echo "<td><a rel='$comment_id' href='javasctipt:void(0)' class='delete_link text-danger'>Delete</a></td>";
      echo "<td><a href='../../post.php?post_id=$post_id'>$post_title</a></td>";
      echo"</tr>";
  }
  ?>
    <script type='text/javascript'>
      $(document).ready(function(){
        $(".delete_link").on('click', function(){

          var id = $(this).attr("rel");
          var delete_url = "comments.php?delete="+ id +" ";
          $(".modal_delete").attr("href", delete_url);
          $("#myModal").modal("show");
        });
      });
    </script>
  <?php
  }

if (isset($_GET['pending'])) {
  $comment_id = $_GET['pending'];

  $query = "UPDATE comments SET comment_status = 'Pending' WHERE comment_id = {$comment_id}";
  $pending_comment = mysqli_query($connection, $query);

  header("Location: comments.php");
}
if (isset($_GET['approve'])) {
  $comment_id = $_GET['approve'];

  $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
  $approved_comment = mysqli_query($connection, $query);

  header("Location: comments.php");
}

/* Read Post Comments
---------------------------------------------------------------------------- */
function index_post_comments(){
  global $connection;
  $post_id=$_GET['post_id'];
  $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ORDER BY comment_id";

  $select_all_comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_comments)){
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo"<tr>";
      echo "<td>$comment_id</td>";
      $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
      $select_all_posts = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_all_posts)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
      }
      echo "<td><a href='posts.php?source=edit_post&post_id=$post_id'>$post_title</a></td>";
      echo "<td>$comment_author</td>";
      echo "<td>" . substr($comment_content, 0,20) . "</td>";
      echo "<td>$comment_email</td>";

      if($comment_status == "Approved"){
        echo "<td><a href='comments.php?pending={$comment_id}'>Approved</a></td>";
      }elseif($comment_status == "Pending"){
        echo "<td><a href='comments.php?approve={$comment_id}'>Pending</a></td>";
      }


      echo "<td>$comment_date</td>";
      echo "<td><a href='comments.php?source=edit_comment&comment_id={$comment_id}'>Edit</a></td>";
      echo "<td><a onclick=\" javascript: return confirm('Are you sure you want to delete this?'); \" href='comments.php?delete={$comment_id}' class='text-danger'>Delete</a></td>";
      echo "<td><a href='../../post.php?post_id=$post_id'>$post_title</a></td>";
    echo"</tr>";

  }
}
if (isset($_GET['pending'])) {
  $comment_id = $_GET['pending'];

  $query = "UPDATE comments SET comment_status = 'Pending' WHERE comment_id = {$comment_id}";
  $pending_comment = mysqli_query($connection, $query);

  header("Location: comments.php");
}
if (isset($_GET['approve'])) {
  $comment_id = $_GET['approve'];

  $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
  $approved_comment = mysqli_query($connection, $query);

  header("Location: comments.php");
}

/* Delete Comment
---------------------------------------------------------------------------- */
function destroy_comment(){
  global $connection;
  if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
      if($_SESSION['user_role'] === 'Admin'){
        $delete_comment = $_GET['delete'];

        $query = "SELECT * FROM comments WHERE comment_id = {$delete_comment}";
        $select_all_comments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_all_comments)){
          $comment_post_id = $row['comment_post_id'];
        }
        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
        $query .= "WHERE post_id = $comment_post_id";
        $update_comment_count = mysqli_query($connection, $query);

        $query = "DELETE FROM comments WHERE comment_id = {$delete_comment}";
        $delete_query = mysqli_query($connection, $query);


        $update_comment_count = mysqli_query($connection, $query);

        header("Location: comments.php");
      }
    }
  }
}
/* 4. Users
Read
Create
DETETE
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/* Read Users
---------------------------------------------------------------------------- */
function index_users(){
  global $connection;
  $query = "SELECT * FROM users ORDER BY user_id";

  $select_all_users = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_users)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

    echo"<tr>";
      echo "<td>$user_id</td>";
      echo "<td>$username</td>";
      echo "<td>$user_firstname</td>";
      echo "<td>$user_lastname</td>";
      echo "<td>$user_email</td>";


      echo "<td><img src='../../images/avatars/$user_image' style='width:100px;'></td>";

      if($_SESSION['user_role'] === 'Admin'){
        if($user_role == "Subscriber"){
          echo "<td><a href='users.php?author={$user_id}'>Subscriber</a></td>";
        }elseif($user_role == "Author"){
          echo "<td><a href='users.php?admin={$user_id}'>Author</a></td>";
        }elseif($user_role == "Admin"){
          echo "<td><a href='users.php?subscriber={$user_id}'>Admin</a></td>";
        }
      }
      if($_SESSION['user_role'] !== 'Admin'){
        if($user_role == "Subscriber"){
          echo "<td>Subscriber</td>";
        }elseif($user_role == "Author"){
          echo "<td>Author</td>";
        }elseif($user_role == "Admin"){
          echo "<td>Admin</td>";
        }
      }

      if($_SESSION['user_role'] === 'Admin'){
        echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
        echo "<td><a rel='$user_id' href='javasctipt:void(0)' class='delete_link text-danger'>Delete</a></td>";
      }
      echo "<td><a href='../../author/$user_id'>$username</a></td>";
    echo"</tr>";

  }
  ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $(".delete_link").on('click', function(){
      var id = $(this).attr("rel");
      var delete_url = "users.php?delete="+ id +" ";
      $(".modal_delete").attr("href", delete_url);
      $("#myModal").modal("show");
    });
  });
  </script>
<?php
}
if (isset($_GET['subscriber'])) {
  $user_id = $_GET['subscriber'];

  $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$user_id}";
  $subscriber_user = mysqli_query($connection, $query);

  header("Location: users.php");
}
if (isset($_GET['author'])) {
  $user_id = $_GET['author'];

  $query = "UPDATE users SET user_role = 'Author' WHERE user_id = {$user_id}";
  $author_user = mysqli_query($connection, $query);

  header("Location: users.php");
}
if (isset($_GET['admin'])) {
  $user_id = $_GET['admin'];

  $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id}";
  $admin_user = mysqli_query($connection, $query);

  header("Location: users.php");
}

/* Create User
---------------------------------------------------------------------------- */
function store_user(){

  global $connection;
  if(isset($_POST['create_user'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10) );

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../../images/avatars/$user_image");

    if(empty($user_image)){
      $user_image = "avatar.jpg";
    }

    if(!empty($username) && !empty($user_password)){
      echo"<div class='alert alert-success alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>User created</div>";

      $query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_image, user_password, user_role) ";
      $query .= "VALUES('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '$user_password', '{$user_role}')";

      $create_user_query = mysqli_query($connection, $query);
    }else{
      echo"<div class='alert alert-danger alert-dismissible '> <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter a username and password</div>";
    }

  }
}
/* Delete User
---------------------------------------------------------------------------- */
function destroy_user(){
  global $connection;
  if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
      if($_SESSION['user_role'] === 'Admin'){

        $delete_user = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$delete_user}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");
      }
    }
  }
}
/* Read Contact
---------------------------------------------------------------------------- */
function index_contact(){
  global $connection;
  $post_id=$_GET['post_id'];
  $query = "SELECT * FROM contact  ORDER BY id";

  $select_all_contacts = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_all_contacts)){
    $contact_id = $row['id'];
    $contact_name = $row['name'];
    $contact_mail = $row['email'];
    $contact_message = $row['message'];

    echo"<tr>";
      echo "<td>$contact_id</td>";
      echo "<td>$contact_name</td>";
      echo "<td>$contact_mail</td>";
      echo "<td>" . substr($contact_message, 0,20) . "</td>";
      echo "<td><a href='contact.php?source=view_contact&contact_id={$contact_id}'>View</a></td>";
      echo "<td><a onclick=\" javascript: return confirm('Are you sure you want to delete this?'); \" href='contact.php?delete={$contact_id}' class='text-danger'>Delete</a></td>";
    echo"</tr>";

  }
}

/* Delete contact
---------------------------------------------------------------------------- */
function destroy_contact(){
  global $connection;
  if (isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])){
      if($_SESSION['user_role'] === 'Admin'){
        $delete_contact = $_GET['delete'];
        $query = "DELETE FROM contact WHERE id = {$delete_contact}";
        $delete_query = mysqli_query($connection, $query);


        header("Location: contact.php");
      }
    }
  }
}





/* 6. Users_online
Read
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/* Read Users_online
---------------------------------------------------------------------------- */
function users_online(){
global $connection;
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

// KK: If new user / else recurring user
if($count == NULL){
  mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
}else{
  mysqli_query($connection, "UPDATE users_online SET time ='$time' WHERE session = '$session' ");
}
  $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
  return mysqli_num_rows($users_online);
}
?>
