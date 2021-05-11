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

function mysqlCreatePost($title, $description, $adminId, $lattitude, $longitude, $typeOfActivities)
{
  $query = "INSERT INTO `tbl_location`(`title`, `description`, `admin_id`, `lattitude`, `longitude`,`type_of_activities`) VALUES ('$title','$description','$adminId','$lattitude','$longitude','$typeOfActivities')";
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

function mysqlRemovePostAndImages($id)
{
  $query = "DELETE FROM `tbl_location` WHERE id=$id";
  $query1 = mysqlRemoveAllImagesByLocationId($id);

  return [$query, $query1];
}

function mysqlGetPost($id, $admin = false)
{
  $query = "SELECT 
              l.id,l.title, 
              l.description, 
              a.username, 
              l.lattitude, 
              l.longitude, 
              l.type_of_activity,
              l.created_at,
              l.status,
              l.type_of_activity
            FROM   
              `tbl_location` AS l ,`tbl_admins` AS a
            WHERE 
              l.admin_id = a.id AND l.id=$id AND l.status=true";

  $query1 = "SELECT `image` FROM `tbl_images` WHERE location_id=$id";

  if ($admin) {
    $query = "SELECT l.id,l.title, l.description, a.username, l.lattitude, l.longitude,l.type_of_activity,l.created_at,l.status 
            FROM   `tbl_location` AS l ,`tbl_admins` AS a
            WHERE l.admin_id = a.id AND l.id=$id";
  }
  return [$query, $query1];
}

function mysqlUpdatePost($id, $title, $description, $lattitude, $longitude, $typeOfActivity, $status)
{
  $dateNow = date('Y:m:d') . " " . date('H:i:s');
  $query = "UPDATE
    `tbl_location`
SET
    `title` = '$title',
    `description` = '$description',
    `lattitude` = $lattitude,
    `longitude` = $longitude,
    `status` = $status,
    `updated_at` = '$dateNow',
    `type_of_activity` = '$typeOfActivity'
WHERE
    id=$id";

  return $query;
}

function mysqlLocationAndImagesInfo($pageNo, $pageOffset)
{
  $pageNo = $pageNo * $pageOffset;
  $query =
    "SELECT
    id,
    title,
    `description`,
    lattitude,
    longitude,
    `status`,
    image_count,
    type_of_activity,
  	created_by,
    created_by_id,
    created_at,
    updated_at
FROM
    `tbl_location` AS l,
    (
    SELECT
        COUNT(location_id) AS image_count,
        location_id
    FROM
        `tbl_images`
    GROUP BY
        location_id
) AS i,
(
    SELECT username AS created_by,id AS created_by_id FROM `tbl_admins`
) AS a
WHERE
    i.location_id = l.id AND
    l.admin_id = a.created_by_id
LIMIT $pageNo,$pageOffset";

  return $query;
}

function mysqlLocationPostCount()
{
  $query = "SELECT COUNT(id) as `total` FROM `tbl_location`";
  return $query;
}

function mysqlAdminRequestList($pageNo, $pageOffset)
{
  $pageNo = $pageNo * $pageOffset;
  $query = "SELECT
    id,
    `name`,
    username,
    email,
    `address`,
    phone_number,
    `status`,
    created_at
FROM
    `tbl_admins`
WHERE
    `status` = 0
LIMIT $pageNo,$pageOffset";

  return $query;
}

function mysqladminRequests($id, $accepted)
{

  if ($accepted == true) {
    $query = "UPDATE `tbl_admins` SET `status`=1 WHERE id=$id;";
  } else {
    $query = "DELETE FROM `tbl_admins` WHERE id=$id;";
  }

  return $query;
}

function mysqladminRequestsCount()
{
  return "SELECT COUNT(*) AS total  FROM `tbl_admins` WHERE `status`=0";
}

function mysqlInsertComment($userId, $location_id, $comment)
{
  $createdAt = date('Y-m-d') . " " . date('H:i:s');
  $query = "INSERT INTO `tbl_comments`(`user_id`, `location_id`, `comment`,`created_at`) VALUES ($userId,$location_id,'$comment','$createdAt')";
  return $query;
}

function mysqlgetComments($location_id, $pageNo, $pageOffset)
{
  $pageNo = $pageNo * $pageOffset;
  $query = "SELECT
    u.username,
    c.comment,
    c.created_at,
    c.location_id,
    c.id
FROM
    `tbl_comments` c
LEFT JOIN `tbl_users` u ON
    c.user_id = u.id
WHERE
	c.location_id=$location_id
ORDER BY
	c.created_at DESC
LIMIT $pageNo,$pageOffset";
  return $query;
}

// $query1 = "SELECT * FROM tbl_users WHERE username='user' AND password='upassword' AND status=1";
// print_r($connection->query($query1));
