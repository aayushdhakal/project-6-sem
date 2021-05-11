   <?php
   if ($_SESSION['is_user'] == true) {
   ?>
      <section class="user__interaction">
         <div class="user__interaction__actions">

            <a href="#"><button>Give Review</button></a>

            <a href=<?php echo isset($id) ? "./saveToFavorite.php?id=" . $id  : "" ?>><button>Save to favorite<?php echo isset($id) ? " id=" . $id  : "" ?></button></a>

            <a href=<?php echo isset($id) ? "./removeFromFavorite.php?id=" . $id : "" ?>><button>Remove from favorite</button></a>

            <!-- <a href="#"><button>Block User</button></a> -->
         </div>
      </section>
   <?php } ?>