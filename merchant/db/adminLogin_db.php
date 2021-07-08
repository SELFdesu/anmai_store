<?php
$user=$_POST['user'];
$password=md5($_POST['pwd']);
include '../conn/connectsql_db.php';
$sql="select * from merchant_users where username='$user' or mobile_phone='$user'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
if($row['username'] != $user && $row['mobile_phone'] != $user){
    echo "<script>alert('用户名或手机号未注册！'); window.location.href='../adminLogin.php';</script>";
}elseif($row['password'] != $password){
    echo "<script>alert('密码错误！'); window.location.href='../adminLogin.php';</script>";
}else{
    if($row['active'] == 0){
        echo "<script>alert('用户已冻结！'); window.location.href='../adminLogin.php';</script>";
    }else{
        session_start();
        $_SESSION['mer_username'] = $row['username'];
        $_SESSION['merchantid']=$row['id'];
        header('location:../index.php');
    }
}
mysqli_free_result($result);
mysqli_close($conn);
?>
