<?php
session_start();
require_once './__loginAndSignupErrorMsg.php';
require_once './__connection.php';
require_once './__assignSession.php';
if ((isset($_COOKIE['username'])) && !empty($_COOKIE['username'])) {
   header('location:index.php');
}
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
   <link rel="stylesheet" href="./style/adminRequests.css">
   <title>Passion Seekers</title>
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
   <?php
   //fetching the data from the database to the UI if user is valid
   $checkAdminQuery = mysqlisAdmin($_SESSION['id'], $_SESSION['username']);
   $checkAdminResult = $connection->query($checkAdminQuery);

   if ($checkAdminResult->num_rows == 1) {

      if (isset($_GET['pageno']) && is_numeric($_GET['pageno']) && $_GET['pageno'] > 1) {
         $pageNumber = $_GET['pageno'];
      } else {
         $pageNumber = 1;
      }

      $pageOfset = 10;
      $result = $connection->query(mysqlAdminRequestList($pageNumber - 1, $pageOfset));
      $adminList = [];

      while ($row = $result->fetch_assoc()) {
         array_push($adminList, $row);
      }

      if (isset($_GET['confrimation']) && $_GET['confrimation'] == 'true') {

         if (isset($_GET['accept']) && $_GET['accept'] == 'true') {
            echo 'accepted';
            $adminState = $connection->query(mysqladminRequests($_GET['id'], true));
   ?>
            <script>
               alert('User has Accepted. Redirecting to Admin lists');
               location.href = './adminRequests.php';
            </script>
         <?php
         }

         if (isset($_GET['accept']) && $_GET['accept'] == 'false') {
            $adminState = $connection->query(mysqladminRequests($_GET['id'], false));
         ?>
            <script>
               alert('User has Declined and Removed .Redirecting to Admin lists');
               location.href = './adminRequests.php';
            </script>
         <?php
         }
      }

      if (isset($_GET['id']) && is_numeric($_GET['id'])) {
         if (isset($_GET['accept']) && $_GET['accept'] == "true") {
         ?>
            <script>
               let confrim = confirm("Are you sure you want to make the user Admin?");
               if (confrim) {
                  location.href = "<?php echo "./adminRequests.php?id=" . $_GET['id'] . "&accept=true&pageno=" . $pageNumber . "&confrimation=true" ?>";
               }
            </script>
         <?php
         } elseif (isset($_GET['accept']) && $_GET['accept'] == "false") {
         ?>
            <script>
               let confrim = confirm("Are you sure you want to Decline the user as Admin? It will remove the user Info");
               if (confrim) {
                  location.href = "<?php echo "./adminRequests.php?id=" . $_GET['id'] . "&accept=false&pageno=" . $pageNumber . "&confrimation=true" ?>";
               }
            </script>
   <?php
         } else {
            $err['server'] = 'Internal Server Error';
         }
      }

      print_r($adminList);
   } else {
      $err['user'] = 'Not a valid user !';
   }
   ?>

   <header>
      <?php require_once './__navigationBar.php'; ?>
   </header>

   <?php if ($checkAdminResult->num_rows == 1) { ?>

      <section class="admin__request__list">
         <table border="1" width="80%">
            <thead class="admin__request__list__contents">
               <th>S.N</th>
               <th>Id</th>
               <th>Name</th>
               <th>Username</th>
               <th>Email</th>
               <th>Address</th>
               <th>Phone Number</th>
               <th>Current Status</th>
               <th>Created At</th>
               <th colspan="2">Actions</th>
            </thead>
            <tbody>
               <?php foreach ($adminList as $index => $admin) {
               ?>
                  <tr class="admin__request__list__contents">
                     <td><?php echo $pageOfset * $pageNumber - $pageOfset + $index + 1 ?></td>
                     <td><?php echo $admin['id'] ?></td>
                     <td><?php echo $admin['name'] ?></td>
                     <td><?php echo $admin['username'] ?></td>
                     <td><?php echo $admin['email'] ?></td>
                     <td><?php echo $admin['address'] ?></td>
                     <td><?php echo $admin['phone_number'] ?></td>
                     <td><?php echo $admin['status'] == 0 ? "Not Active" : 'N/A' ?></td>
                     <td><?php echo $admin['created_at'] ?></td>
                     <td><a href="<?php echo "./adminRequests.php?id=" . $admin['id'] . "&accept=true&pageno=" . $pageNumber ?>">Accept</a></td>
                     <td><a href="<?php echo "./adminRequests.php?id=" . $admin['id'] . "&accept=false&pageno=" . $pageNumber ?>">Decline</a></td>
                  </tr>
               <?php }
               ?>
            </tbody>
         </table>
      </section>
   <?php } ?>



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