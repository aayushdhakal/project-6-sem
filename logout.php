   <?php
   session_start();
   session_destroy();
   setcookie('username', '', time() - 1);
   setcookie('name', '', time() - 1);
   setcookie('id', '', time() - 1);
   header('location:home.php');
   ?>