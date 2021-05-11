<?php
session_start();
require_once './__assignSession.php';
require_once './__connection.php';
require_once './__loginAndSignupErrorMsg.php';

// 
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./style/style.css">
   <link rel="stylesheet" href="./style/header-navigationBar.css">
   <link rel="stylesheet" href="./style/admin-jobs.css">
   <link rel="stylesheet" href="./style/profile.css">
   <title>Passion Seekers | Profile</title>
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

   <header>
      <?php require_once './__navigationBar.php'; ?>
   </header>

   <section class="user__information">
      <div class="user__information__details">
         <h2 class="user__information__details__title">User Informations</h2>
         <hr>
         <form action="POST" class="user__information__details_form">

            <div class="users__information__detail">
               <Label for="name">Name</Label>
               <input type="text" id="name">
            </div>

            <div class="users__information__detail">
               <Label for="username">Username</Label>
               <input type="text" id="username">
            </div>

            <div class="users__information__detail">
               <Label for="email">Email</Label>
               <input type="text" id="email">
            </div>

            <div class="users__information__detail">
               <Label for="phone_number">Phone Number</Label>
               <input type="text" id="phone_number">
            </div>

            <div class="users__information__detail">
               <Label for="address">Address</Label>
               <input type="text" id="address">
            </div>

            <button type="submit" name="update_user" class="user__information__details__update__btn">Update</button>
         </form>
      </div>
   </section>

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