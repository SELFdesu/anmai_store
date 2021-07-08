<?php
    $userid=$_GET['userid'];
    $active=!$_GET['active'];
    include_once '../../common/database.php';
    $sql="update merchant_users set active='{$active}' where id={$userid}";
    mysqli_query($link,$sql);
    $sql="update product_show set active='{$active}' where merchantid={$userid}";
    mysqli_query($link,$sql);
    header('Location:../manage-merchant.php');
?>