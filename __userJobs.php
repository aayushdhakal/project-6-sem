   <?php
   require_once './__connection.php';
   if ($_SESSION['is_user'] == true) {
   ?>
      <section class="user__interaction">
         <div class="user__interaction__actions">
            <?php
            if (isset($id) && !isset($err['post'])) {
               if (!isset($err['post'])) {
                  $queryToCheckFavorite = mysqlCheckInFavorite($_SESSION['id'], $id);
                  $isInFavorite = $connection->query($queryToCheckFavorite);
            ?>

                  <?php if ($isInFavorite->num_rows == 1) { ?>
                     <a href=<?php echo isset($id) ? "./removeFromFavorite.php?id=" . $id : "" ?>><button>Saved. Remove from favorite?</button></a>
                  <?php } else { ?>
                     <a href=<?php echo isset($id) ? "./saveToFavorite.php?id=" . $id  : "" ?>><button>Save to favorite<?php echo isset($id) ? " id=" . $id  : "" ?>?</button></a>
               <?php }
               }
               ?>
            <?php } ?>
            <a href="./favoriteList.php"><button>Favorite List</button></a>
            <a href="./postReview.php"><button>Give Review</button></a>
            <!-- <a href="#"><button>Block User</button></a> -->
         </div>
      </section>
   <?php } ?>