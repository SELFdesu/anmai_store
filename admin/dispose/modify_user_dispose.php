<?php
    $userid=$_POST['userid'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $tel=$_POST['tel'];
    $birthday=$_POST['birthday'];
    $sex=$_POST['sex'];
    if($password==''){
        $sql="update users set username='{$username}',tel='{$tel}',birthday='{$birthday}',sex='{$sex}' where id='{$userid}'";
    }else{
        $password=md5($password);
        $sql="update users set username='{$username}',passwd='{$password}',tel='{$tel}',birthday='{$birthday}',sex='{$sex}' where id='{$userid}'";
    }
    include_once '../../common/database.php';
    mysqli_query($link,$sql);
    header('Location:../manage-users.php')

?>