<?php
    $username=$_POST['username'];
    $passwd=md5($_POST['passwd']);

    include_once '../../common/database.php';
    $sql="select * from admin where username='{$username}' and passwd='{$passwd}'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_row($result)[0];
    if(!!mysqli_num_rows($result)){
        session_start();
        $_SESSION['admin']=$row;
        header('Location:../index.php');
    }else{
        header('Location:../login.php?error=true');
    }

?>