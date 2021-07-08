<!DOCTYPE html>
<html>

<head>
    <title>订单详情</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/public.js" type="text/javascript"></script>
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
            if(isset($_GET['orderNumber']) && $_GET['orderNumber'] != ''){
                $order_number=$_GET['orderNumber'];
                include './conn/connectsql_db.php';
                $sql = "SELECT a.orderid, b.username, a.recipients, a.contacttel, a.orderaddress, a.send, a.time, a.signfortime, a.airwaybill, c.photo, c.productname, a.num, a.allprice from product_order a, users b, product_show c WHERE a.userid=b.id AND a.productid=c.id AND c.merchantid='$merchantid' AND a.orderid='$order_number'";
                $result=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
            }
        ?>

        <div class="main">
            <div class="wrap ">
                <div class="page-title ">
                    <span class="modular fl "><i class="order "></i><em>订单编号：<?php echo $row['orderid']; ?></em></span>
                    <span class="modular fl "><span style="display: inline-block; width: 23px; height: 19px; position: relative; top: 3px; margin-right: 5px"></span><em>订单用户：<?php echo $row['username']; ?></em></span>
                </div>
                <form action="./waybill_number.php" method="post">
                <input type="hidden" name="checkbox[]" value="<?php echo $row['orderid']; ?>">
                <dl class="orderDetail ">
                    <dt class="order-h ">订单详情</dt>
                    <dd>
                        <ul>
                            <li>
                                <span class="h-cont h-right ">收件人姓名：</span>
                                <span class="h-cont h-left "><?php echo $row['recipients']; ?></span>
                            </li>
                            <li>
                                <span class="h-cont h-right ">联系电话：</span>
                                <span class="h-cont h-left "><?php echo $row['contacttel']; ?></span>
                            </li>
                            <li>
                                <span class="h-cont h-right ">收货地址：</span>
                                <span class="h-cont h-left "><?php echo $row['orderaddress']; ?></span>
                            </li>
                            <li>
                                <span class="h-cont h-right ">是否发货：</span>
                                <span class="h-cont h-left "><?php echo $row['send'] ? '已发货' : '未发货'; ?></span>
                            </li>
                            <li>
                                <span class="h-cont h-right ">下单时间：</span>
                                <span class="h-cont h-left "><?php echo $row['time']; ?></span>
                            </li>
                            <li>
                                <span class="h-cont h-right ">签收时间：</span>
                                <span class="h-cont h-left "><?php echo $row['signfortime'] ? $row['signfortime'] : '未签收'; ?></span>
                            </li>
                        </ul>
                    </dd>
                    <dd>
                        <table class="list-style">
                            <tr>
                                <th>运单号</th>
                                <th>商品图</th>
                                <th>名称</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>总价</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><?php echo $row['airwaybill'] ? $row['airwaybill'] : '暂无运单号！'; ?></td>
                                <td style="text-align: center;"><img src="../<?php echo $row['photo']; ?>" class="thumbnail" /></td>
                                <td style="text-align: center;"><?php echo $row['productname']; ?></td>
                                <td style="text-align: center;">
                                    <span>
                                        <i>￥</i>
                                        <em><?php echo ($row['allprice']/$row['num']); ?></em>
                                    </span>
                                </td>
                                <td style="text-align: center;"><?php echo $row['num']; ?></td>
                                <td style="text-align: center;">
                                    <span>
                                        <i>￥</i>
                                        <em><?php echo $row['allprice']; ?></em>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="fr ">
                                        <span style="font-size:15px;font-weight:bold; ">
                                            <i>订单共计金额：￥</i>
                                            <b><?php echo $row['allprice']; ?></b>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </dd>
                    <dd>
                        <!-- Operation -->
                        <div class="BatchOperation ">
                            <input type="submit" value="发货 " class="btnStyle " />
                            <a href="./db/orderdelete_db.php?orderNumber=<?php echo $row['orderid'] ?>"><input type="button" value="删除订单 " class="btnStyle " /></a>
                        </div>
                    </dd>
                </dl>
            </div>
            </form>
        </div>
        <?php
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
    </div>
</body>

</html>