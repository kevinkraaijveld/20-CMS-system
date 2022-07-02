<!-- Kevin Kraaijveld - CMS system - db
============================================================================
Frontend - crate database connection
-->

<?php
// KK: database variables
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "mysql";
$db['db_name'] = "cms";

// KK: as constances
foreach($db as $key => $value){
  define(strtoupper($key), $value);
}

// KK: make the connection
$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);


$query = "SET NAMES utf8";
mysqli_query($connection,$query);

// KK: database connection check
  // if($connection) {
  //   echo "We are connected";
  // }

?>
