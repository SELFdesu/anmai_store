<!DOCTYPE html>
<html>

<head>
    <title>商品管理系统</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/eject.js" type="text/javascript"></script>
    <script src="js/public.js" type="text/javascript"></script>
</head>
<body style="background: #313131;">
    <div id="main">
        <?php
        include "./conn/top.php";
        include "./conn/menu.php";
        include "./db/index_db.php";
        ?>

        <div class="main">
            <div class="wrap start-page">
                <h1><i class="home-icon"></i>欢迎回到安买站点管理中心</h1>
                <dl>
                    <dt>订单统计信息</dt>
                    <dd>
                        <ul>
                            <li>
                                <span>发货订单：</span>
                                <span>
                                    <?php echo $row2['sum(a.send)'] ? $row2['sum(a.send)'] : 0; ?>
                                </span>
                            </li>
                            <li>
                                <span>已成交订单：</span>
                                <span><?php echo $row2['sum(a.signfor)'] ? $row2['sum(a.signfor)'] : 0; ?></span>
                            </li>
                        </ul>
                    </dd>
                </dl>

                <dl>
                    <dt>商户统计信息</dt>
                    <dd>
                        <ul>
                            <li>
                                <span>商品总数量：</span>
                                <span><?php echo $row['count(productname)']; ?></span>
                            </li>
                            <li>
                                <span>在线实时交易总计：</span>
                                <span><?php echo $row2['sum(a.allprice)'] ? $row2['sum(a.allprice)'] : 0; ?></span>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</body>

</html>