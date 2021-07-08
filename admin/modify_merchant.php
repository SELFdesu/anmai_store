<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:./login.php');
}
include_once '../common/database.php';
$userid=$_GET['userid'];
$sql = "select * from merchant_users where id={$userid};";
$result = mysqli_query($link, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户管理</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <link href="css/paging.css" rel="stylesheet">


</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1 style="font-size: 21px;">安买商城后台管理系统</h1>
            </header>

            <!-- Search box -->
            <form class="templatemo-search-form" role="search">
                <div class="input-group">
                    <button type="submit" class="fa fa-search"></button>
                    <input type="text" class="form-control" placeholder="回车搜索" name="srch-term" id="srch-term">
                </div>
            </form>
            <div class="mobile-menu-icon">
                <i class="fa fa-bars"></i>
            </div>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="index.php"><i class="fa fa-home fa-fw"></i>主页</a></li>
                    <li><a href="manage-comment.php"><i class="fa fa-bar-chart fa-fw"></i>评论管理</a></li>
                    <li><a href="manage-product.php"><i class="fa fa-database fa-fw"></i>商品管理</a></li>
                    <li><a href="manage-order.php"><i class="fa fa-map-marker fa-fw"></i>订单管理</a></li>
                    <li><a href="manage-users.php" class="active"><i class="fa fa-users fa-fw"></i>用户管理</a></li>
                    <li><a href="manage-merchant.php"><i class="fa fa-user fa-fw"></i>商家管理</a></li>
                    <li><a href="manage-carousel.php"><i class="fa fa-sliders fa-fw"></i>网站轮播图管理</a></li>
                    <li><a href="./dispose/logout.php"><i class="fa fa-eject fa-fw"></i>退出登录</a></li>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">

            <div class="templatemo-content-container">
                <div class="templatemo-content-container">
                    <div class="templatemo-content-widget white-bg">
                        <h2 class="margin-bottom-10">修改信息</h2>
                        <p> </p>
                        <hr>
                        <form action="./dispose/modify_merchant_dispose.php" class="templatemo-login-form" method="post">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label>用户名</label>
                                    <input type="text" class="form-control" id="inputFirstName" value="<?php echo $rows[0]['username'] ?>" name="username">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label>密码</label>
                                    <input type="password" class="form-control highlight" id="inputCurrentPassword" placeholder="********" name="password">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label>电话</label>
                                    <input type="text" class="form-control" value="<?php echo $rows[0]['mobile_phone'] ?>" name="tel">
                                </div>
                            </div>


                            <input type="hidden" name="userid" value="<?php echo $userid ?>">
                            
                            <div class="row form-group">
                                <button type="submit" class="templatemo-blue-button">修改</button>
                                <button type="reset" class="templatemo-white-button">重置</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- JS -->
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script> <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
        <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->


    </div>
    </div>
    </div>


</body>

</html>