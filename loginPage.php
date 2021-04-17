<?php
if ((isset($_COOKIE['username'])) && !empty($_COOKIE['username'])) {
   session_start();
   $_SESSION['username'] = $_COOKIE['username'];
   header('location:home.php');
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="./style/assests/travel.png">
   <link rel="stylesheet" href="./style/style.css">
   <link rel="stylesheet" href="./style/loginPage.css">
   <title>Passion Seekers | Login</title>
</head>

<body>

   <?php
   require_once './connection.php';
   $loggin = "<script>console.log('sucess')</script>";

   if (isset($_POST['login'])) {

      $err = [];

      if (isset($_POST['username']) && !empty($_POST['username'])) {
         $username = trim($_POST['username']);
      } else {
         array_push($err, 'username');
      }

      if (isset($_POST['password']) && !empty($_POST['password'])) {
         $password = trim($_POST['password']);
      } else {
         array_push($err, 'password');
      }

      if (isset($username) && isset($password)) {
         $sql = mysqlLoginQuery($username, $password);
         $result = $connection->query($sql);

         $result1 = $connection->query(isAdmin($_SESSION['username']));
         print_r($result1);

         $login = $result->num_rows == 1;

         if ($login) {
            $data = $result->fetch_assoc();

            session_start();

            $_SESSION['username'] = $username;
            setcookie('username', $username, time() + (60 * 60 * 24 * 7));
            setcookie('name', $data['name'], time() + (60 * 60 * 24 * 7));
            setcookie('id', $$data['id'], time() + (60 * 60 * 24 * 7));
            header('location:home.php');
         }
      }
   }

   ?>

   <div class="container">
      <div class="container__left">
         <div class="container__left__home__logo">
            <a href="./home.html">
               <img class="container__left__home__logo__img" src="./style/assests/logo home.png" alt="home-logo">
            </a>
         </div>
         <div class="container__left__logo__info">
            <a href="./index.html">
               <h3>Passion</h3>
               <h3>Seekers</h3>
            </a>
            <p>Making Dreams Comes True.</p>
         </div>
         <ul class="container__left__short__info">
            <li class="container__left__short__info__list">
               <div class="container__left__short__info__img">
                  <img src="./style/assests/search.png" alt="#">
               </div>
               <p>Search for locations</p>
            </li>
            <li class="container__left__short__info__list">
               <div class="container__left__short__info__img">
                  <img src="./style/assests/save.png" alt="#">
               </div>
               <p>Save your favorite location</p>
            </li>
            <li class="container__left__short__info__list">
               <div class="container__left__short__info__img">
                  <img src="./style/assests/location.png" alt="#">
               </div>
               <p>Find various Activities around you</p>
            </li>
         </ul>
      </div>
      <div class="container__right">
         <div class="container__right__form_login">
            <h2>Login</h2>
            <form action="#" class="container__right__form_login__form" method="POST">
               <div class="container__right__form__element">
                  <Label for="username">Username</Label>
                  <input type="text" placeholder="Enter Username here" id="username" name="username">
               </div>
               <div class="container__right__form__element">
                  <Label for="password">Password</Label>
                  <input type="text" placeholder="Enter password here" id="password" name="password">
               </div>
               <div class="container__right__form__element container__right__form__element--checkbox">
                  <Label for="remember">Remember Me</Label>
                  <input type="checkbox" id="remember">
               </div>
               <div class="container__right__form__element container__right__form__element--login__btn">
                  <input type="submit" value="Login" name="login">
               </div>
            </form>
            <hr>
         </div>
      </div>
   </div>
</body>

</html>