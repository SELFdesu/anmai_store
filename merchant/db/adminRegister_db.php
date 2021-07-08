<?php
$username=$_POST['username'];
$mobile_phone=$_POST['mobile_phone'];
$password1=$_POST['pwd1'];
$password2=$_POST['pwd2'];
include '../conn/connectsql_db.php';
$sql="select * from merchant_users where username='$username' or mobile_phone='$mobile_phone'";
$result=mysqli_query($conn, $sql);
$num=mysqli_num_rows($result);
var_dump($num);
echo "<br>";
if($num==1){
    $row1=mysqli_fetch_assoc($result);
    var_dump($row1);
    if($username == $row1['username']){
        echo "<script>alert('用户名已存在！');window.location.href='../adminRegister.php';</script>";
    }elseif($mobile_phone == $row1['mobile_phone']){
        echo "<script>alert('手机号输入有误！');window.location.href='../adminRegister.php';</script>";
    }
}elseif($num==2){
    echo "<script>alert('用户名已存在并且手机号输入有误！');window.location.href='../adminRegister.php';</script>";
}else{
    if(!is_numeric($mobile_phone) || strlen($mobile_phone) != 11){
        echo "<script>alert('手机号输入的格式有误！');window.location.href='../adminRegister.php';</script>";
    }elseif($password1 !== $password2){
        echo "<script>alert('两次输入的密码不同！');window.location.href='../adminRegister.php';</script>";
    }else{
        $password=md5($password2);
        $sql2="insert into merchant_users(username, mobile_phone, password, active) values('$username', '$mobile_phone', '$password', '1')";
        $result2=mysqli_query($conn, $sql2);
        if($result2){
            echo "<script>alert('注册成功！');window.location.href='../adminLogin.php';</script>";
        }
    }
}
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($conn);
?>