<?php
$username=$_POST['username'];
$mobile_phone=$_POST['mobile_phone'];
$old_password=md5($_POST['old_password']);
$new_password1=$_POST['new_password1'];
$new_password2=$_POST['new_password2'];
include '../conn/connectsql_db.php';
$sql="select * from merchant_users where username='$username' and mobile_phone='$mobile_phone' and password='$old_password'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
if($row){
    if($new_password1 !== $new_password2){
        echo "<script>alert('两次输入的新密码不同！'); window.location.href='../revise_password.php';</script>";
    }else{
        $new_password=md5($new_password2);
        $sql2="update merchant_users set password='$new_password' where id={$row['id']}";
        $result2=mysqli_query($conn, $sql2);
        if($result2){
            session_start();
            echo "<script>alert('密码修改成功！'); window.location.href='../adminLogin.php';</script>";
            unset($_SESSION['mer_username']);
            unset($_SESSION['merchantid']);
        }
    }
}else{
    echo "<script>alert('用户名，手机号或旧密码输入有误！'); window.location.href='../revise_password.php';</script>";
}
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($conn);
?>