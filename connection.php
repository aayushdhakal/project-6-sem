<?php
// object  = new classname();
$db_host = 'localhost';
$db_user = 'aayush';
$db_password = "root@1234";
$db_name = 'db_passion_seekers';
//database connection
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
$connection_status = $connection->connect_errno == 0 ? "Connected":"Not Connected"; 

//database connection error check
if ($connection->connect_errno != 0) {
  die('Database Connection Error : ' . $connection->connect_error);
}

function mysqlLoginQuery($username,$password){
  $query ="SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND status=1";
  return $query;
}

function isAdmin($username){
  $query = "SELECT * FROM tbl_admins WHERE username='$username' AND status=1";
  return $query;
}

$query1 = "SELECT * FROM tbl_users WHERE username='user' AND password='upassword' AND status=1";
print_r($connection->query($query1));



