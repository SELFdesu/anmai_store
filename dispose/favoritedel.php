<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../login.php');
    }
    if(!isset($_GET['favid'])){
        header('Location:../favorite.php');
    }
    include_once '../common/database.php';
    $sql="delete from user_favorite where favID={$_GET['favid']}";
    mysqli_query($link,$sql);
    $sql="update product_show set star=star-1 where id={$_GET['proid']}";
    mysqli_query($link,$sql);
    header('Location:../favorite.php');
?>