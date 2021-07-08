<!DOCTYPE html>
<html>

<head>
    <title>商品列表</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/public.js" type="text/javascript"></script>
    <script src="js/allchecked.js" type="text/javascript"></script>
    <style type="text/css">
        .menu-children .product_list {
            background: #f35844;
        }

        .menu-children .product_list:hover {
            background: #f35844;
        }
    </style>
</head>

<body>
    <div id="main">
        <?php
        include "conn/top.php";
        include "conn/menu.php";
        $merchantid = $_SESSION['merchantid'];
        include_once './conn/connectsql_db.php';
        mysqli_query($conn, 'set names utf8');
        if (isset($_GET['keywords']) && $_GET['keywords'] != '') {
            $keywords = $_GET['keywords'];
            $sql = "select * from product_show where merchantid='$merchantid' and (productname like '%$keywords%' or detailText like '%$keywords%')";
        } else {
            $sql = "select * from product_show where merchantid='$merchantid'";
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
                $sql2 = "select * from product_show where merchantid='$merchantid' and (productname like '%$keywords%' or detailText like '%$keywords%') order by id desc limit $offset, $pagesize";
                $result2 = mysqli_query($conn, $sql2);
                $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                if (!$rows) {
                    echo "<script>alert('未找到商品名称或商品详情中带有关键字为‘" . $keywords . "’的信息！'); window.location.href='./product_list.php';</script>";
                }
            } else {
                $sql2 = "select * from product_show where merchantid='$merchantid' order by id desc limit $offset, $pagesize";
                $result2 = mysqli_query($conn, $sql2);
                $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                if (!$rows) {
                    echo "<script>alert('暂无商品信息！');</script>";
                }
            }
        }
        ?>

        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i></i><em>商品列表</em></span>
                    <span class="modular fr"><a href="edit_product.php" class="pt-link-btn">+添加商品</a></span>
                </div>
                <div class="operate">
                    <form action="" method="get">
                        <img src="images/icon_search.gif" />
                        <input type="text" name="keywords" class="textBox length-long" placeholder="情输入商品名称或商品详情内带有的关键字..." required />
                        <input type="submit" value="查询" class="tdBtn" />
                    </form>
                </div>
                <form action="" method="post">
                    <table class="list-style Interlaced">
                        <tr>
                            <th>ID编号</th>
                            <th>商品图片</th>
                            <th>商品名称</th>
                            <th>商品详情</th>
                            <th>商品价格</th>
                            <th>商品分类</th>
                            <th>添加时间</th>
                            <th>已售数量</th>
                            <th>收藏次数</th>
                            <th>操作</th>
                        </tr>
                        <?php for ($i = 0; $i < count($rows); $i++) { ?>
                            <tr>
                                <td>
                                    <span>
                                        <input type="checkbox" name="checkbox[]" value="<?php echo $rows[$i]['id']; ?>" class="middle checked_child" />
                                        <i><?php echo $rows[$i]['id']; ?></i>
                                    </span>
                                </td>
                                <td class="center pic-area"><img src="../<?php echo $rows[$i]['photo']; ?>" class="thumbnail" /></td>
                                <td class="td-name" style="width: 260px;">
                                    <span class="ellipsis td-name block" style="width: 260px;"><?php echo $rows[$i]['productname']; ?></span>
                                </td>
                                <td class="td-name" style="width: 220px;">
                                    <span class="ellipsis td-name block" style="width: 220px;"><?php echo $rows[$i]['detailText']; ?></span>
                                </td>
                                <td class="center">
                                    <span>
                                        <i>￥</i>
                                        <em><?php echo $rows[$i]['price']; ?></em>
                                    </span>
                                </td>
                                <td class="center">
                                    <i>
                                        <?php
                                        switch ($rows[$i]['classify']) {
                                            case 0:
                                                echo "数码类";
                                                break;
                                            case 1:
                                                echo "办公类";
                                                break;
                                            case 2:
                                                echo "服饰类";
                                                break;
                                            case 3:
                                                echo "模玩类";
                                                break;
                                            case 4:
                                                echo "食品类";
                                                break;
                                            case 5:
                                                echo "箱包类";
                                                break;
                                            case 6:
                                                echo "厨具类";
                                                break;
                                            case 7:
                                                echo "茶酒类";
                                                break;
                                            case 8:
                                                echo "家具类";
                                                break;
                                            default:
                                                echo "其他类";
                                        }
                                        ?>
                                    </i>
                                </td>
                                <td class="center">
                                    <i><?php echo $rows[$i]['time']; ?></i>
                                </td>
                                <td class="center">
                                    <span>
                                        <em><?php echo $rows[$i]['sales']; ?></em>
                                        <i>件</i>
                                    </span>
                                </td>
                                <td class="center">
                                    <span>
                                        <em><?php echo $rows[$i]['star']; ?></em>
                                        <i>次</i>
                                    </span>
                                </td>
                                <td class="center">
                                    <a href="edit_product.php?productid=<?php echo $rows[$i]['id']; ?>" title="编辑"><img src="images/icon_edit.gif" /></a>
                                    <a href="./db/product_delete_db.php?productid=<?php echo $rows[$i]['id']; ?>" title="删除"><img src="images/icon_drop.gif" /></a>
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
                            <input type="submit" formaction="./db/product_delete_db.php" value="批量删除" class="btnStyle" />
                        </div>
                        <!-- turn page -->
                        <div class="turnPage center fr">
                            <?php
                            echo '<a style="background-color: #f35844; pointer-events:none;" href="./product_list.php">共' . ($page_count ? $page_count : '1') . '页</a>';
                            if ($_GET['page'] > 1) {
                                echo '<a href="./product_list.php?page=1' . (isset($_GET['keywords']) ? ('&keywords='.$_GET['keywords']) : '') . '">首页</a>';
                                echo '<a href="./product_list.php?page=' . ($_GET['page'] - 1) . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') .  '">上一页</a>';
                            }
                            echo '<a style="background-color: #f35844;" href="./product_list.php?page=' . $_GET['page'] . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') . '">' . $_GET['page'] . '</a>';
                            if ($_GET['page'] < $page_count) {
                                echo '<a href="./product_list.php?page=' . ($_GET['page'] + 1) . (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') .  '">下一页</a>';
                                echo '<a href="./product_list.php?page=' . $page_count .  (isset($_GET['keywords']) ? ('&keywords=' . $_GET['keywords']) : '') .  '">尾页</a>';
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