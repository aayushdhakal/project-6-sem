   <?php
   if ($_SESSION['admin'] == true) {
   ?>
      <section class="admin__interaction">
         <div class="admin__interaction__actions">
            <a href="#"><button>Created Post</button></a>
            <a href="#"><button>Edit Post</button></a>
            <a href="#"><button>Remove Post</button></a>
            <a href="#"><button>View Reviews</button></a>
            <a href="#"><button>Block User</button></a>
            <a href="#"><button>Admin request list</button></a>
         </div>
      </section>
   <?php } ?>