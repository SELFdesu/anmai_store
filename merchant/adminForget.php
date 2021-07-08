<!DOCTYPE html>
<html>

<head>
    <title>管理员登录</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" >
    <style>
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: url(images/pc_loginBg.jpg) no-repeat;
            background-size: cover;
            position: absolute;
        }
    </style>
    <script src="js/jquery.js"></script>
    <script src="js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            $('body').particleground({
                dotColor: 'green',
                lineColor: '#c9ec6e'
            });
            $('.intro').css({
                'margin-top': -($('.intro').height() / 2)
            });
        });
    </script>

</head>

<body>
    <form action="./db/adminForget_db.php" method="post" class="loginform">
        <h1>管理员登录</h1>
        <ul>
            <li>
                <label>用户名：</label>
                <input type="text" name="username" class="textBox" placeholder="请输入用户名" required autocomplete="off"/>
            </li>
            <li>
                <label>手机号：</label>
                <input type="text" name="userphone" class="textBox" placeholder="请输入手机号" required autocomplete="off"/>
            </li>
            <li>
                <label>密码：</label>
                <input type="password" name="pwd" class="textBox" placeholder="设置新密码" required autocomplete="off"/>
            </li>
            <li>
                <input type="submit" name="submit" value="找回密码" />
            </li>
            <li style="text-align: center; margin-top: 20px; font-size: 18px;">
                <a href="./adminRegister.php" style="margin-right: 100px; color: #ffffff;">立即注册</a>
                <a href="./adminLogin.php" style="margin-left: 100px; color: #ffffff;">立即登录</a>
            </li>
        </ul>
    </form>
</body>

</html>