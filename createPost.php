<?php
session_start();
require_once './__assignSession.php';
require_once './__connection.php';
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

      if (isset($_POST['title']) && !empty($_POST['title'])) {
         $title = trim($_POST['title']);
      } else {
         $err['title'] = "Invalid title!";
      }

      if (isset($_POST['description']) && !empty($_POST['description'])) {
         $description = trim($_POST['description']);
      } else {
         $err['description'] = "Invalid description!";
      }

      if (isset($_POST['lattitude']) && !empty($_POST['lattitude'])) {
         $lattitude = trim($_POST['lattitude']);
      } else {
         $err['lattitude'] = 'Invalid lattitude!';
      }

      if (isset($_POST['longitude']) && !empty($_POST['longitude'])) {
         $longitude = trim($_POST['longitude']);
      } else {
         $err['longitude'] = 'Invalid longitude!';
      }

      if (!isset($err['longitude']) && !isset($err['lattitude']) && !isset($err['title']) && !isset($err['description'])) {

         // saving images in server
         $imageNames = [];
         $countFiles = count($_FILES['images']['name']);
         if ($countFiles > 0) {
            echo "step 1 <br>";
            for ($i = 0; $i < $countFiles; $i++) {
               $filename = $_FILES['images']['name'][$i];
               // Upload file
               // move_uploaded_file($_FILES['file']['tmp_name'][$i], 'upload/' . $filename);
               // echo $filename . "<br>";
               // echo $_FILES['images']['error'][$i];

               //check for error on the each upload
               if ($_FILES['images']['error'][$i] == 0) {
                  echo "step 2 <br>";
                  if ($_FILES['images']['size'][$i] <= 1024000) {
                     echo "step 3 <br>";

                     $file_types = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];

                     if (in_array($_FILES['images']['type'][$i], $file_types)) {
                        echo "step 4 <br>";

                        //move upload file to server
                        $imageName = "imagePost" . uniqid().".png";
                        array_push($imageNames,$imageName);

                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], 'images/posts/' . $imageName)) {
                           echo 'Image uploaded';
                        } else {
                           $err['images'] = 'error on image uploaded';
                        }

                     } else {
                        $err['images'] = 'Select Valid format';
                     }
                  } else {
                     $err['images'] = 'Select images upto 10 mb';
                  }
               }
            }
         } else {
            $err['images'] = 'Please upload at least one file.';
         }

         //check if he is admin or not
         $checkAdminQuery = mysqlisAdmin($_SESSION['id'], $_SESSION['username']);
         $result = $connection->query($checkAdminQuery);

         if ($result->num_rows == 1) {
            if (count($err) == 0) {
               $queryToInsertData  = mysqlCreatePost($title, $description, $_SESSION['id'], $lattitude, $longitude);
               $output = $connection->query($queryToInsertData);

               $lastInsertedLocationId = mysqli_insert_id($connection);

               foreach ($imageNames as $name) {
                  $queryToInsertImage = mysqlAddImage($name,$lastInsertedLocationId);
                  $connection->query($queryToInsertImage);
               };
            }
         } else {
            $err['users'] = 'Users not valid';
         }
      }

      // print_r($err);
      // print_r($_FILES['images']);
   }
   ?>

   <header>
      <?php require_once './__navigationBar.php'; ?>
   </header>
   <hr>
   <section class="location__information">
      <h2 class="location__information__title">Create Post</h2>

      <form method="post" class="location__information_upload_form" enctype="multipart/form-data">

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
            <input type="number" name="lattitude" id="lattitude" placeholder="Enter lattitude here">
         </div>

         <div class="location_information_upload_form_item">
            <Label for="longitude">Longitude</Label>
            <input type="number" name="longitude" id="longitude" placeholder="Enter longitude here">
         </div>

         <div class="location_information_upload_form_item">
            <Label for="images">Upload Images</Label>
            <input type="file" name="images[]" id="images" title="&nbsp;" multiple>
         </div>

         <div class="location_information_upload_form_item">
            <button type="submit" name="upload" class="location_information_upload_form_item__submit">Submit</button>
         </div>

      </form>
   </section>

   <script src="./scripts/individualPage.js"></script>
</body>

</html>