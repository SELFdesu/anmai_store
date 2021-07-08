<!DOCTYPE html>
<html>

<head>
    <title>商品分类</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .menu-children .product_category {
            background: #f35844;
        }

        .menu-children .product_category:hover {
            background: #f35844;
        }
    </style>
</head>

<body>
    <div id="main">

        <?php
        include "./conn/top.php";
        include "./conn/menu.php";

        if (!isset($_SESSION['mer_username'])) {
            header('Location:./adminLogin.php');
        }

        include './conn/connectsql_db.php';
        $sql = "select classify from product_show where merchantid='{$_SESSION['merchantid']}'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if(!$rows){
            echo "<script>alert('暂无商品！');</script>";
        }
        $classify = array();
        foreach ($rows as $value) {
            array_push($classify, $value['classify']);
        }
        $classify_array = array();
        foreach ($classify as $value) {
            if (array_key_exists($value, $classify_array)) {
                $classify_array[$value]++;
            } else {
                $classify_array[$value] = 1;
            }
        }
        ?>
        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i></i><em>商品分类</em></span>
                </div>

                <table class="list-style">
                    <tr>
                        <th>分类名称</th>
                        <th>产品数量</th>
                    </tr>
                    <?php foreach ($classify_array as $key => $value) { ?>
                        <tr>
                            <td style="text-align: center;">
                                <span>
                                    <?php
                                    switch ($key) {
                                        case 0:
                                            echo '数码';
                                            break;
                                        case 1:
                                            echo '办公';
                                            break;
                                        case 2:
                                            echo '服饰';
                                            break;
                                        case 3:
                                            echo '模玩';
                                            break;
                                        case 4:
                                            echo '食品';
                                            break;
                                        case 5:
                                            echo '箱包';
                                            break;
                                        case 6:
                                            echo '厨具';
                                            break;
                                        case 7:
                                            echo '茶酒';
                                            break;
                                        case 8:
                                            echo '家具';
                                            break;
                                        case 9:
                                            echo '其他';
                                            break;
                                    }
                                    ?>
                                </span>
                            </td>
                            <td class="center">
                                <span>
                                    <em><?php echo $value ?></em>
                                    <i>件</i>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</body>

</html>