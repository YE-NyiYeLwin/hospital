<?php 
session_start();
session_destroy();
echo "<script> alert('Log Out.');window.location.assign('stafflogin.php'); </script>";
?>