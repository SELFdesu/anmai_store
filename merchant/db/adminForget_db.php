<?php
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $mobilephone=$_POST['userphone'];
    $newpassword=md5($_POST['pwd']);
    include '../conn/connectsql_db.php';
    $sql="update merchant_users set password='$newpassword' where username='$username' and mobile_phone='$mobilephone'";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_affected_rows($conn);
    var_dump($row);
    if($row){
        echo "<script>alert('新密码设置成功！'); window.location.href='../adminLogin.php';</script>";
    }else{
        echo "<script>alert('用户名或手机号输入有误！'); window.location.href='../adminForget.php';</script>";
    }
}
?>