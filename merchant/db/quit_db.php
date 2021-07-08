<?php
session_start();
if(isset($_SESSION['mer_username'])){
    unset($_SESSION['mer_username']);
    unset($_SESSION['merchantid']);
}
header('location:../adminLogin.php');
?>