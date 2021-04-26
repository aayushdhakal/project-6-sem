<?php
session_start();
if ((isset($_COOKIE['username'])) && !empty($_COOKIE['username'])) {
   $_SESSION['username'] = $_COOKIE['username'];
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./style/style.css">
   <link rel="stylesheet" href="./style/header-navigationBar.css">
   <link rel="stylesheet" href="./style/createPost.css">
   <title>Passion Seekers | Create Post</title>
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
   if (isset($_POST['upload'])) {
      echo "this is working";
   }
   ?>

   <header>
      <?php require_once './navigationBar.php'; ?>
   </header>
   <hr>
   <section class="location_information">
      <h2>Create Post</h2>
      <form method="post" name="location_information_upload_form" enctype="multipart/form-data">

         <div class="location_information_upload_form_item">
            <Label for="title">Title</Label>
            <input type="text" name="title" id="title" placeholder="Enter title here">
         </div>

         <div class="location_information_upload_form_item">
            <Label for="description">Description</Label>
            <textarea type="text" name="description" id="description" placeholder="Enter description here"></textarea>
         </div>

         <div class="location_information_upload_form_item">
            <Label for="lattitude">Lattitude</Label>
            <input type="text" name="lattitude" id="lattitude" placeholder="Enter lattitude here">
         </div>

         <div class="location_information_upload_form_item">
            <Label for="longitude">Longitude</Label>
            <input type="text" name="longitude" id="longitude" placeholder="Enter longitude here">
         </div>

         <div class="location_information_upload_form_item">
            <Label for="images">Upload Images</Label>
            <input type="file" name="images[]" id="images" title="&nbsp;" multiple>
         </div>

         <div class="location_information_upload_form_item">
            <button type="submit" name="upload">Submit</button>
         </div>

      </form>

   </section>

   <script src="./scripts/individualPage.js"></script>
</body>

</html>