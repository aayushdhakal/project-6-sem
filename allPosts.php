<?php

session_start();
require_once './__assignSession.php';
require_once './__connection.php';
require_once './__loginAndSignupErrorMsg.php';
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="./style/style.css">
<link rel="stylesheet" href="./style/header-navigationBar.css">
<link rel="stylesheet" href="./style/all-posts.css">
<link rel="stylesheet" href="./style/admin-jobs.css">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>All Posts</title>
</head>

<body>
   <script>
      function confrimlogout() {
         const confrimation = confirm('Are you sure you wanna logout?');
         if (confrimation) {
            location.href = './logout.php';
         }
      }
   </script>


   <?php

   //fetching the data from the database to the UI if user is valid
   $checkAdminQuery = mysqlisAdmin($_SESSION['id'], $_SESSION['username']);
   $checkAdminResult = $connection->query($checkAdminQuery);

   if ($checkAdminResult->num_rows == 1) {

      $pageNumber = 1;

      if (isset($_GET['pageno']) && is_numeric($_GET['pageno']) && $_GET['pageno'] > 1) {
         $pageNumber = $_GET['pageno'];
      }

      $pageOfset = 10;
      $result = $connection->query(mysqlLocationAndImagesInfo($pageNumber - 1, $pageOfset));
      $postList = [];

      while ($row = $result->fetch_assoc()) {
         array_push($postList, $row);
      }
      // print_r($postList);
   } else {
      $err['user'] = 'Not a valid User';
   }

   ?>

   <header>
      <?php require_once './__navigationBar.php' ?>
   </header>

   <?php if ($checkAdminResult->num_rows == 1) { ?>
      <section class="all__posts">
         <h2 class="all__posts__title">Posts</h2>
         <div class="all__posts__body">
            <table border="1" class="all__posts__contents">
               <thead class="all__posts__contents__head">
                  <th>S.N</th>
                  <th>Post Id</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>lattitude</th>
                  <th>longitude</th>
                  <th>Status</th>
                  <th>No of Images on Post</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Last updated At</th>
                  <th colspan="2">Actions</th>
               </thead>
               <tbody>
                  <?php foreach ($postList as $index => $post) { ?>
                     <tr class="all__posts__contents__content">
                        <td><?php echo 2 * $pageNumber - 2 + $index + 1 ?></td>
                        <td><?php echo $post['id'] ?></td>
                        <td class="all__posts__contents__content__left"><?php echo $post['title'] ?></td>
                        <td class="all__posts__contents__content__left"><?php echo substr($post['description'], 0, 40) . ".... <a href='./individualPage.html?id=" . $post['id'] . "' class='all__posts__contents__content__more' >view more</a>" ?></td>
                        <td><?php echo $post['lattitude'] ?></td>
                        <td><?php echo $post['longitude'] ?></td>
                        <td><?php echo $post['status'] == 1 ? 'active' : 'hidden' ?></td>
                        <td><?php echo $post['image_count'] ?></td>
                        <td><?php echo $post['created_by'] ?></td>
                        <td><?php echo $post['created_at'] ?></td>
                        <td><?php echo $post['updated_at'] ? $post['updated_at'] : 'N/A' ?></td>
                        <td><a href="<?php echo "./editPost.php?id=" . $post['id'] ?>" class="all__posts__contents__content__edit">Modify</a></td>
                        <td><a href="<?php echo "./removePost.php?redirect=true&id=" . $post['id'] ?>" class="all__posts__contents__content__remove">Remove</a></td>
                     </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </section>

   <?php } ?>

   <?php require_once './__adminJobs.php' ?>

   <div style=" bottom:2rem;
                  display:flex;
                  flex-direction:column;
                  position:fixed;
                  right:20px;
         ">
      <?php
      if (count($err) > 0) {
         foreach ($err as $index => $message) {
            displayError(true, $message, $index + 1);
         }
      }
      ?>
   </div>
   <script src="./scripts/individualPage.js"></script>

</body>

</html>