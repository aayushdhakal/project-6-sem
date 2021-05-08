<?php

// session_start();
// $_SESSION['name'] = "aayush";
// exit();

echo "<h1>this is file 1</h1>";

echo "</h3>The time is ".date("Y-m-d")."  " .date("H:i:s")."</h3>";

require_once "./__connection.php";

$query = mysqlUpdatePost(60,'title','description',50,50,1);
echo $query;
?>
