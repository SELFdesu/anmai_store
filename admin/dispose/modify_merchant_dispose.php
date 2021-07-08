<?php
    $userid=$_POST['userid'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $tel=$_POST['tel'];
    if($password==''){
        $sql="update merchant_users set username='{$username}',mobile_phone='{$tel}' where id='{$userid}'";
    }else{
        $password=md5($password);
        $sql="update merchant_users set username='{$username}',password='{$password}',mobile_phone='{$tel}' where id='{$userid}'";
    }
    include_once '../../common/database.php';
    mysqli_query($link,$sql);
    header('Location:../manage-merchant.php')

?>