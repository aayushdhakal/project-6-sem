<?php function displayError($err_val, $msg = "! Please fill the form properly")
{ ?>
   <?php if (isset($err_val)) { ?>
      <div class="output__message" style="
         background:rgb(139, 40, 40);
         border-radius: 20px;
         bottom:2rem; 
         color: white;
         display: block;
         font-weight: 600;
         position: fixed; 
         padding:10px;
         right:20px ; 
         transition: all ease 0.3s;
         z-index:1;
         ">
         <p><?php echo $msg ?></p>
      </div>
      <script>
         setTimeout(() => {
            let mesg = document.querySelector('.output__message').style.opacity = 0;
         }, 3000)
      </script>
   <?php } ?>

<?php } ?>