<!DOCTYPE html>
<html>

<head>
    <title>订单列表</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/public.js" type="text/javascript"></script>
    <script src="js/allchecked.js" type="text/javascript"></script>
    <style type="text/css">
        .menu-children .order_list {
            background: #f35844;
        }

        .menu-children .order_list:hover {
            background: #f35844;
        }
    </style>
</head>

<body>
    <div id="main">
        <?php
        include "./conn/top.php";
        include "./conn/menu.php";
        $merchantid = $_SESSION['merchantid'];
        include './conn/connectsql_db.php';
        if (isset($_GET['keywords']) && $_GET['keywords'] != '') {
            $keywords = $_GET['keywords'];
            $sql = "SELECT a.orderid from product_order a, product_show c WHERE a.productid=c.id AND c.merchantid='$merchantid'AND (a.orderid='$keywords' OR a.recipients='$keywords')";
        } else {
            $sql = "SELECT a.orderid from product_order a, product_show c WHERE a.productid=c.id AND c.merchantid='$merchantid'";
        }
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if (!isset($_GET['page']) || $_GET['page'] == '') {
            $_GET['page'] = 1;
        }
        if (is_numeric($_GET['page'])) {
            $pagesize = 5;
            $page_count = ceil((int)$num / $pagesize);
            $offset = (($_GET['page'] - 1) * $pagesize);
            if (isset($_GET['keywords']) && $_GET['keywords'] != '') {
                $sql2 = "SELECT a.orderid, a.recipients, a.contacttel, a.orderaddress, b.username, c.productname, a.num, a.allprice, a.time, a.send from product_order a, users b, product_show c WHERE a.userid=b.id AND a.productid=c.id AND c.merchantid='$merchantid' AND (a.orderid='$keywords' OR a.recipients='$keywords') ORDER BY a.orderid DESC LIMIT $offset, $pagesize";
                $result2 = mysqli_query($conn, $sql2);
                $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                if (!$rows) {
                    echo "<script>alert('未找到订单编号或收件人为‘" . $keywords . "’的信息！'); window.location.href='./order_list.php';</script>";
                }
            } else {
                $sql2 = "SELECT a.orderid, a.recipients, a.contacttel, a.orderaddress, b.username, c.productname, a.num, a.allprice, a.time, a.send from product_order a, users b, product_show c WHERE a.userid=b.id AND a.productid=c.id AND c.merchantid='$merchantid' ORDER BY a.orderid DESC LIMIT $offset, $pagesize";
                $result2 = mysqli_query($conn, $sql2);
                $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                if (!$rows) {
                    echo "<script>alert('暂无订单信息！');</script>";
                }
            }
        }
        ?>

        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i class="order"></i><em>订单列表</em></span>
                </div>
                <div class="operate">
                    <form action="" method="get">
                        <img src="images/icon_search.gif" />
                        <input type="text" class="textBox length-long" name="keywords" placeholder="请输入订单编号或收件人姓名..." required />
                        <input type="submit" value="查询" class="tdBtn" />
                    </form>
                </div>
                <form action="" method="post">
                    <table class="list-style Interlaced">
                        <tr>
                            <th>订单编号</th>
                            <th>收件人</th>
                            <th>订单用户</th>
                            <th>商品名称</th>
                            <th>购买数量</th>
                            <th>订单总额</th>
                            <th>下单时间</th>
                            <th>是否发货</th>
                            <th>操作</th>
                        </tr>
                        <?php for ($i = 0; $i < count($rows); $i++) { ?>
                            <tr>
                                <td style="width: 180px;">
                                    <input type="checkbox" class="checked_child" name="checkbox[]" value="<?php echo $rows[$i]['orderid']; ?>" />
                                    <a href="./order_detail.php?orderNumber=<?php echo $rows[$i]['orderid']; ?>"><?php echo $rows[$i]['orderid']; ?></a>
                                </td>
                                <td style="width: 260px;">
                                    <span class="block"><?php echo $rows[$i]['recipients'] . "[" . $rows[$i]['contacttel'] . "]"; ?></span>
                                    <span><?php echo $rows[$i]['orderaddress']; ?></span>
                                </td>
                                <td class="center" style="width: 120px;">
                                    <span class="block"><?php echo $rows[$i]['username']; ?></span>
                                </td>
                                <td style="width: 240px;" class="center">
                                    <span class="block"><?php echo $rows[$i]['productname']; ?></span>
                                </td>
                                <td style="width: 70px;" class="center">
                                    <span><b><?php echo $rows[$i]['num']; ?></b></span>
                                </td>
                                <td style="width: 90px;" class="center">
                                    <span><i>￥</i><b><?php echo $rows[$i]['allprice']; ?></b></span>
                                </td>
                                <td style="width: 120px;" class="center">
                                    <span class="block"><?php echo $rows[$i]['time']; ?></span>
                                </td>
                                <td style="width: 70px;" class="center">
                                    <span><?php echo $rows[$i]['send'] ? "已发货" : "未发货"; ?></span>
                                </td>
                                <td style="width: 60px;" class="center">
                                    <a href="./order_detail.php?orderNumber=<?php echo $rows[$i]['orderid']; ?>" class="inline-block" title="查看订单"><img src="images/icon_view.gif" /></a>
                                    <a href="./db/orderdelete_db.php?orderNumber=<?php echo $rows[$i]['orderid']; ?>" class="inline-block" title="删除订单"><img src="images/icon_trash.gif" /></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <!-- BatchOperation -->
                    <div style="overflow:hidden;">
                        <!-- Operation -->
                        <div class="BatchOperation fl" style="margin: 1em 0.45em;">
                            <input type="checkbox" id="del" />
                            <label for="del" class="btnStyle middle">全选</label>
                            <input type="submit" formaction="./waybill_number.php" value="发货" class="btnStyle" />
                            <input type="submit" formaction="./db/orderdelete_db.php" value="删除订单" class="btnStyle" />
                        </div>
                        <!-- turn page -->
                        <div class="turnPage center fr">
                            <?php
                            echo '<a style="background-color: #f35844; pointer-events:none;" href="./order_list.php">共' . ($page_count ? $page_count : '1') . '页</a>';
                            if ($_GET['page'] > 1) {
                                echo '<a href="./order_list.php?page=1' . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">首页</a>';
                                echo '<a href="./order_list.php?page=' . ($_GET['page'] - 1) . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">上一页</a>';
                            }
                            echo '<a style="background-color: #f35844;" href="./order_list.php?page=' . $_GET['page'] . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">' . $_GET['page'] . '</a>';
                            if ($_GET['page'] < $page_count) {
                                echo '<a href="./order_list.php?page=' . ($_GET['page'] + 1) . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">下一页</a>';
                                echo '<a href="./order_list.php?page=' . $page_count . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">尾页</a>';
                            }
                            mysqli_free_result($result);
                            mysqli_free_result($result2);
                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>