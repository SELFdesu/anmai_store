<?php 
session_start();
unset($_SESSION['uid']);
unset($_SESSION['username']);
unset($_SESSION['user_photo']);
header('Location:../index.php');
?>