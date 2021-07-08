<?php 
    if(isset($_POST['login'])){
        $user=$_POST['username'];
        $pw=md5($_POST['passwd']);

        include_once '../common/database.php';

        $sql = "select * from users where username='{$user}' and passwd='{$pw}'";
        $result=mysqli_query($link,$sql);
        $login_uid=mysqli_fetch_assoc($result);
        if(!mysqli_num_rows($result)){
            mysqli_close($link);
            header('Location:../login.php?error=true');
        }else{
            $sql = "select * from users where id='{$login_uid['id']}' and active='1';";
            $result=mysqli_query($link,$sql);
            if(!mysqli_num_rows($result)){
                mysqli_close($link);
                header('Location:../login.php?active=0');
            }else{
                mysqli_close($link);
                session_start();
                $_SESSION['uid']=$login_uid['id'];
                $_SESSION['username']=$user;
                $_SESSION['user_photo']=$login_uid['photo'];
                header('Location:../index.php');
            }
           
        }
    }
?>