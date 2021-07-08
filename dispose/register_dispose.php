<?php
    if(isset($_POST['register'])){
        
        if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
            if(!move_uploaded_file($_FILES["photo"]["tmp_name"],'../userphoto/'.$_POST['username'].'.'.substr(strrchr($_FILES["photo"]["name"], '.'), 1))){
                echo'移动失败';
                exit;
            }
        }
       
        $photo='userphoto/'.$_POST['username'].'.'.substr(strrchr($_FILES["photo"]["name"], '.'), 1);
        $user=$_POST['username'];
        $pw=md5($_POST['passwd']);
        $tel=$_POST['tel'];
        $sex=$_POST['sex'];
        $birthday=$_POST['birthday'];

        include_once '../common/database.php';
        
        $sql = "insert into users (username,passwd,tel,sex,birthday,photo) values ('{$user}','{$pw}','{$tel}','{$sex}','{$birthday}','{$photo}')";
        $result=mysqli_query($link,$sql);
        mysqli_close($link);
        if(! $result ){
            header('Location:../register.php?error=true');
            die();
        }
        header('Location:../login.php?succeed=true');
    }else{
        header('Location:../login.php');
    }
?>