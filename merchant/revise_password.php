<!DOCTYPE html>
<html>

<head>
    <title>修改密码</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .top-link .revise_password{
            color: #f35844;
        }
        .top-link .revise_password:hover{
            color: #f35844;
        }
    </style>
</head>

<body>
    <div id="main">
        <?php
        include "./conn/top.php";
        include "./conn/menu.php";
        ?>

        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i class="user"></i><em>修改密码</em></span>
                </div>
                <form action="./db/revise_password_db.php" method="post">
                    <table class="noborder">
                        <tr>
                            <td width="15%" style="text-align:right;">用户名：</td>
                            <td><input type="text" name="username" class="textBox length-middle" required autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td width="15%" style="text-align:right;">手机号：</td>
                            <td><input type="text" name="mobile_phone" class="textBox length-middle" required autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">旧密码：</td>
                            <td><input type="password" name="old_password" class="textBox length-middle" required autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">新密码：</td>
                            <td><input type="password" name="new_password1" class="textBox length-middle" required autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">确认新密码：</td>
                            <td><input type="password" name="new_password2" class="textBox length-middle" required autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;"></td>
                            <td><input type="submit" class="tdBtn" value="保存" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>