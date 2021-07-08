<?php
    $userid=$_GET['userid'];
    $active=!$_GET['active'];
    include_once '../../common/database.php';
    $sql="update users set active='{$active}' where id={$userid}";
    mysqli_query($link,$sql);
    header('Location:../manage-users.php');
?>