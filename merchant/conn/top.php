<?php
session_start();
if(!isset($_SESSION['mer_username'])){
    header('Location:./adminLogin.php');
}
?>
<div class="header">
    <div class="logo">
        <img src="images/logo.png" title="logo" style="height: 55px;"/>
        <img src="images/admin_logo.png" title="logo">
    </div>
    <div class="fr top-link">
        <a href="#" title="管理员" style="pointer-events:none;"><i class="adminIcon"></i><span>管理员：<?php echo isset($_SESSION['mer_username']) ? $_SESSION['mer_username'] : '' ?></span></a>
        <a href="revise_password.php" title="修改密码" class="revise_password"><i class="revisepwdIcon"></i><span>修改密码</span></a>
        <a href="./db/quit_db.php" title="安全退出" style="background:rgb(60,60,60);"><i class="quitIcon"></i><span>安全退出</span></a>
    </div>
</div>