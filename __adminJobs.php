   <?php
   if ($_SESSION['admin'] == true) {
   ?>
      <section class="admin__interaction">
         <div class="admin__interaction__actions">
            <a href="./createPost.php"><button>Created Post</button></a>
            <a href=<?php echo isset($id) ? "./editPost.php?id=" . $id : "./editPost.php" ?>><button>Edit Post</button></a>
            <a href=<?php echo isset($id) ? "./removePost.php?id=" . $id . "&redirect=true" : "./removePost.php" ?>><button>Remove Post</button></a>
            <a href="./allPosts.php"><button>View Posts <br>(Tabular Form)</button></a>
            <a href="#"><button>View Reviews</button></a>
            <a href="#"><button>Block User</button></a>
            <a href="#"><button>Admin request list</button></a>
         </div>
      </section>
   <?php } ?>