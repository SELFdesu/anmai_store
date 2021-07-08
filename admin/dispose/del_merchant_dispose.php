<?php
    $userid=$_GET['userid'];
    include_once '../../common/database.php';
    $sql="delete from merchant_users where id='{$userid}'";
    mysqli_query($link,$sql);
    header('Location:../manage-merchant.php');
?>