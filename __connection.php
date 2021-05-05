<?php
// object  = new classname();
$db_host = 'localhost';
$db_user = 'aayush';
$db_password = "root@1234";
$db_name = 'db_passion_seekers';

//database connection
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
$connection_status = $connection->connect_errno == 0 ? "Connected" : "Not Connected";

//database connection error check
if ($connection->connect_errno != 0) {
  die('Database Connection Error : ' . $connection->connect_error);
}

function mysqlLoginQuery($username, $password)
{
  $query = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND status=1";
  return $query;
}

function mysqlLoginQueryAdmin($username, $password)
{
  $query = "SELECT * FROM tbl_admins WHERE username='$username' AND password='$password' AND status=1";
  return $query;
}

function mysqlisAdmin($id, $username)
{
  $query = "SELECT * FROM tbl_admins WHERE username='$username' AND status=1 AND id=$id";
  return $query;
}

//Query for Signup USERS
function mysqlSignUp($name = '', $username, $password, $email, $phoneNumber = '', $address = '')
{
  $query = "INSERT INTO `tbl_users`(`name`, `username`, `password`, `email`, `phone_number`, `address`) VALUES ('$name','$username','$password','$email','$phoneNumber','$address')";
  return $query;
}

//Quey to Signup ADMIN
function mysqlSignUpAdmin($name = '', $username, $password, $email, $phoneNumber = '', $address = '')
{
  $query = "INSERT INTO `tbl_admins`(`name`, `username`, `password`, `email`, `phone_number`, `address`) VALUES ('$name','$username','$password','$email','$phoneNumber','$address')";
  return $query;
}

//Query to check Username USERS
function mysqlCheckUsersUsername($username)
{
  $query = "SELECT * FROM tbl_users WHERE `username`='$username'";
  return $query;
}

//Query to check Email USERS
function mysqlCheckUsersEmail($email)
{
  $query = "SELECT * FROM tbl_users WHERE `email`='$email'";
  return $query;
}

//Query to check Username ADMIN
function mysqlCheckAdminsUsername($username)
{
  $query = "SELECT * FROM `tbl_admins` WHERE `username`='$username'";
  return $query;
}

//Query to check email ADMIN
function mysqlCheckAdminsEmail($email)
{
  $query = "SELECT * FROM `tbl_admins` WHERE `email`='$email'";
  return $query;
}

function mysqlCreatePost($title, $description, $adminId, $lattitude, $longitude)
{
  $query = "INSERT INTO `tbl_location`(`title`, `description`, `admin_id`, `lattitude`, `longitude`) VALUES ('$title','$description','$adminId','$lattitude','$longitude')";
  return $query;
}

function mysqlAddImage($image, $locationId)
{
  $query = "INSERT INTO `tbl_images`(`image`, `location_id`) VALUES ('$image',$locationId)";
  return $query;
}

function mysqlRemoveAllImagesByLocationId($id)
{
  $query = "DELETE FROM `tbl_images` WHERE location_id=$id";
  return $query;
}

function mysqlRemovePostAndImages($id){
  $query = "DELETE FROM `tbl_location` WHERE id=$id";
  $query1 = mysqlRemoveAllImagesByLocationId($id);

  return [$query,$query1];
}

function mysqlGetPost($id, $admin = false)
{
  $query = "SELECT l.id,l.title, l.description, a.username, l.lattitude, l.longitude, l.created_at,l.status 
            FROM   `tbl_location` AS l ,`tbl_admins` AS a
            WHERE l.admin_id = a.id AND l.id=$id AND l.status=true";

  $query1 = "SELECT `image` FROM `tbl_images` WHERE location_id=$id";

  if ($admin) {
    $query = "SELECT l.id,l.title, l.description, a.username, l.lattitude, l.longitude, l.created_at,l.status 
            FROM   `tbl_location` AS l ,`tbl_admins` AS a
            WHERE l.admin_id = a.id AND l.id=$id";
  }
  return [$query, $query1];
}

function mysqlUpdatePost($id, $title, $description, $lattitude, $longitude, $status)
{
  $query = "UPDATE
    `tbl_location`
SET
    `title` = '$title',
    `description` = '$description',
    `lattitude` = $lattitude,
    `longitude` = $longitude,
    `status` = $status
WHERE
    id=$id";

  return $query;
}

// $query1 = "SELECT * FROM tbl_users WHERE username='user' AND password='upassword' AND status=1";
// print_r($connection->query($query1));
