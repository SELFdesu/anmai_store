<?php
$username=$_POST['username'];
$oldpasswd=md5($_POST['oldpasswd']);
$newpasswd=md5($_POST['passwd']);
$tel=$_POST['tel'];
$birthday=$_POST['birthday'];

include_once '../common/database.php';
$sql="select id from users where username='{$username}' and passwd='{$oldpasswd}' and tel='{$tel}' and birthday='{$birthday}'";
$result=mysqli_query($link,$sql);
if(!!mysqli_num_rows($result)){
    $userid=mysqli_fetch_row($result)[0];
    echo $userid;
    $sql="update users set passwd='{$newpasswd}' where id='{$userid}';";
    mysqli_query($link,$sql);
    header('Location:../login.php?resucceed=true');
}else{
    header('Location:../retrievepasswd.php?error=true');
}
?>