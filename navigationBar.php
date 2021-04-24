<nav>
   <h1>Passion Seekers</h1>
   <ul>
      <li>
         <div class="search__posts">
            <form action="./loginPage.html" name="search__post">
               <button type="button" class="search__form__btn">
                  <img src="./style/assests/search.png" alt="search">
               </button>
               <input type="text" class="search__form__field">
            </form>
         </div>
      </li>
      <li><a href="#">Explore</a></li>
      <li><a href="#">Activities</a></li>
      <li><a href="#">Trending places</a></li>
      <?php

      if (isset($_SESSION['username'])) {
         echo "<li><a href='#'>" . $_SESSION['username'] . "</a></li>";

         echo "<li class='logout__btn'>
                  <button 
                     href='./logout.php' 
                     class='logout__img'
                     onclick=\"confrimlogout()\"
                  ><img src='./style/assests/logout.png' width='18px' height='18px'>
                  </button>
                  <p>Logout<p>
               </li>";
      } else {
         echo "<li><a href='./signupPage.php'>Sign up</a></li>";
         echo "<li>|</li>";
         echo "<li><a href='./loginPage.php'>Login</a></li>";
      }

      ?>
   </ul>
</nav>