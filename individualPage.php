<?php
session_start();
require_once './__assignSession.php';
require_once './__connection.php';
require_once './__loginAndSignupErrorMsg.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./style/style.css">
   <link rel="stylesheet" href="./style/header-navigationBar.css">
   <link rel="stylesheet" href="./style/individual-page.css">
   <link rel="stylesheet" href="./style/recommendation.css">
   <link rel="stylesheet" href="./style/admin-jobs.css">
   <link rel="icon" href="./style/assests/travel.png">
   <title>Passion Seekers | Post</title>
</head>

<body class="overflow__body">
   <script>
      function confrimlogout() {
         const confrimation = confirm('Are you sure you wanna logout?');
         if (confrimation) {
            location.href = './logout.php';
         }
      }
   </script>
   <?php
   if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
      $id = $_GET['id'];
      $query = mysqlGetPost($_GET['id']);
      $resultForlocationInfo = $connection->query($query[0]);

      if ($resultForlocationInfo->num_rows == 1) {
         $resultForlocationImages = $connection->query($query[1]);

         $images = [];
         while ($row = $resultForlocationImages->fetch_assoc()) {
            array_push($images, $row);
         }
         $resultForlocationInfo = $resultForlocationInfo->fetch_assoc();
      } else {
         $err['post'] = "Post doesn't exists" . ($_SESSION['admin'] == true ? " for id=$id. Post might be hidden" : " ") . " !";
      }

      // print_r($images);
      // print_r($resultForlocationInfo);
   } else {
      $err['id'] = "Invalid id value!";
   }
   ?>
   <header>
      <?php require_once './__navigationBar.php' ?>
   </header>
   <div class="post__content__container">
      <section>
         <?php if (count($err) == 0) { ?>
            <div class="post">
               <h2 class="post__title"><?php echo $resultForlocationInfo['title'] ?></h2>


               <div class="post__image__slider">
                  <?php
                  $imageCount = count($images); ?>
                  <div class="post__image__slider__container">
                     <?php foreach ($images as $index => $image) { ?>
                        <div class="post__image__slider__container__slides fade">
                           <div class="numbertext"><?php echo $index + 1 . "/" . $imageCount ?></div>
                           <img src=<?php echo "./images/posts/" . $image['image'] ?>>
                           <!-- <div class="text">Author one</div> -->
                        </div>
                     <?php } ?>

                     <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                     <a class="next" onclick="plusSlides(1)">&#10095;</a>

                  </div>
               </div>


               <h4 class="post__created__by"><?php echo $resultForlocationInfo['username'] ?></h4>
               <h4 class="post__created__at"><?php echo $resultForlocationInfo['created_at'] ?></h4>
               <p class="post__image__slider__typeOfActivity"><?php echo $resultForlocationInfo['type_of_activity'] ?></p>
               <p class="post__image__slider__description"><?php echo $resultForlocationInfo['description'] ?></p>
            <?php } ?>

            <?php if (!isset($err['post'])) { ?>
               <div class="individual__post__comments__section">
                  <h4 class="post__comment__title">Comments</h4>

                  <div class="post__comment__view">
                     <?php

                     //check if user is logged in
                     $queryToCheckUser = mysqlCheckUsersUsername($_SESSION['username']);
                     $isValidUser = ($connection->query($queryToCheckUser))->num_rows == 1 ? true : false;
                     //check if user is admin
                     $checkAdminQuery = mysqlisAdmin($_SESSION['id'], $_SESSION['username']);
                     $result = $connection->query($checkAdminQuery);

                     if (isset($_POST['post_comment'])) {
                        if (!empty($_POST['comment'])) {
                           if ($isValidUser || $result->num_rows != 1) {

                              $queryToInsertComment = mysqlInsertComment($_SESSION['id'], $id, $_POST['comment']);

                              $output = $connection->query($queryToInsertComment);
                              if ($output != 1) {
                                 $err['comment']  = "Failed to comment!";
                              }
                           } else {
                              $err['comment'] = 'Please login as Users to Comment.';
                           }
                        } else {
                           $err['comment'] = 'Enter valid comment.';
                        }
                     }

                     //fetching comments
                     $pageOffset = 10;
                     $pageNumberForComment =  (isset($_GET['comment']) && is_numeric($_GET['comment'])) ? $_GET['comment'] : 1;

                     $queryToGetComments = mysqlgetComments($id, $pageNumberForComment - 1, $pageOffset);
                     $comments = [];
                     $getComments = $connection->query($queryToGetComments);

                     while ($row = $getComments->fetch_assoc()) {
                        array_push($comments, $row);
                     }

                     if (count($comments) > 0) {
                        foreach ($comments as $comment) {
                     ?>
                           <div class="post_comment__comments">
                              <h3 class="post__comment__By" style="display: inline;"><?php echo $comment['username']; ?></h3>
                              <p class="post__comment__At" style="display: inline-block;"><?php echo $comment['created_at']; ?></p>
                              <p class=" post__comment__comment"><?php echo $comment['comment']; ?></p>
                              <hr>
                           </div>
                     <?php }
                     }

                     ?>
                  </div>
                  <div class=" post__comment__post">
                     <form method="POST">
                        <input type="text" name="comment" placeholder="Comment here">
                        <button type="submit" name="post_comment">Comment</button>
                     </form>
                  </div>
               </div>
            </div>
         <?php } ?>
      </section>
      <aside>
         <div class="aside__container">
            <div class="aside__recomendation">
               <a href="#">
                  <h3>place 1</h3>
                  <div class="aside__recomendation__content">
                     <img src="./style/assests/img-slider/big.jpg" alt="#">
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo delectus enim quidem quia! Tenetur
                        corrupti</p>
                  </div>
               </a>
            </div>
            <div class="aside__recomendation">
               <a href="#">
                  <h3>place 1</h3>
                  <div class="aside__recomendation__content">
                     <img src="./style/assests/img-slider/big.jpg" alt="#">
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo delectus enim quidem quia! Tenetur
                        corrupti</p>
                  </div>
               </a>
            </div>
            <div class="aside__recomendation">
               <a href="#">
                  <h3>place 1</h3>
                  <div class="aside__recomendation__content">
                     <img src="./style/assests/img-slider/big.jpg" alt="#">
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo delectus enim quidem quia! Tenetur
                        corrupti</p>
                  </div>
               </a>
            </div>
         </div>
      </aside>
   </div>

   <div class="recommendation recommendation--small">
      <h2>Recommendations</h2>
      <ul class="recommendation__list">

         <li class="recommendation__list__item">
            <div class="recommendation__list__item_images">
               <img src="./style/assests/img-slider/bhaktapur-tour.jpg" alt="#">
            </div>
            <div class="recommendation__list__item_info">
               <span class="tag">Created By</span>
               <h4>Lorem, ipsum</h4>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio veniam optio nemo alias saepe
                  sequi hic! Dignissimos autem error temporibus, eaque delectus est, sunt...<a class="recommendation__list__item_more">more</a></p>
            </div>
         </li>

         <li class="recommendation__list__item">
            <div class="recommendation__list__item_images">
               <img src="./style/assests/picture.jpg" alt="#">
            </div>
            <div class="recommendation__list__item_info">
               <span class="tag">Created By</span>
               <h4>Lorem, ipsum</h4>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio veniam optio nemo alias saepe
                  sequi hic! Dignissimos autem error temporibus, eaque delectus est, sunt...<a class="recommendation__list__item_more">more</a></p>
            </div>
         </li>

         <li class="recommendation__list__item">
            <div class="recommendation__list__item_images">
               <img src="./style/assests/img-slider/raimond-klavins-59Al83Zjtf8-unsplash.jpg" alt="#">
            </div>
            <div class="recommendation__list__item_info">
               <span class="tag">Created By</span>
               <h4>Lorem, ipsum</h4>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio veniam optio nemo alias saepe
                  sequi hic! Dignissimos autem error temporibus, eaque delectus est, sunt...<a class="recommendation__list__item_more">more</a></p>
            </div>
         </li>

      </ul>
   </div>
   <?php require_once './__adminJobs.php' ?>

   <div style=" bottom:2rem;
                  display:flex;
                  flex-direction:column;
                  position:fixed;
                  right:20px;
                  z-index:2;
         ">
      <?php
      if (count($err) > 0) {
         foreach ($err as $index => $message) {
            displayError(true, $message, $index + 1);
         }
      }
      ?>
   </div>

   <div class="end__of__page <?php echo isset($err['post']) ? "end__of__page--absolute" : ''; ?>"></div>

   <?php if (isset($err['post'])) { ?>
      <style>
         .overflow__body {
            overflow: hidden;
         }
      </style>
   <?php } ?>
   <script src="./scripts/individualPage.js"></script>
   <script>
      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
         showSlides(slideIndex += n);
      }

      function currentSlide(n) {
         showSlides(slideIndex = n);
      }

      function showSlides(n) {
         var i;
         var slides = document.getElementsByClassName("post__image__slider__container__slides");

         if (n > slides.length) {
            slideIndex = 1
         }
         if (n < 1) {
            slideIndex = slides.length
         }
         for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
         }

         slides[slideIndex - 1].style.display = "block";
      }
   </script>
</body>

</html>