<?php 
session_start();
session_unset();
session_destroy();
setcookie("login","true",time()-6000);

header("Location:login.php");
exit;


?>