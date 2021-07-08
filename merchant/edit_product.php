<!DOCTYPE html>
<html>

<head>
    <title>产品列表</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
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
        include "./conn/top.php";
        include "./conn/menu.php";
        include "./conn/connectsql_db.php";
        if (isset($_POST['submit'])) {
            $merchantid = $_SESSION['merchantid'];
            $productname = $_POST['productname'];
            $classify = $_POST['classify'];
            $price = $_POST['price'];
            $detailText = $_POST['detailText'] != '' ? $_POST['detailText'] : '暂无商品详情！';
            $photofile = $_FILES;
            if (is_uploaded_file($photofile['photo']['tmp_name'])) {
                if (move_uploaded_file($photofile['photo']['tmp_name'], '../img/product/' . $photofile['photo']['name'])) {
                    $photo = "img/product/" . $photofile['photo']['name'];
                    if (isset($_GET['productid']) && $_GET['productid'] != '') {
                        $productid = $_GET['productid'];
                        $sql = "update product_show set productname='$productname', classify='$classify', price='$price', photo='$photo', detailText='$detailText' where id='$productid'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "<script>alert('商品修改成功！'); window.location.href='./product_list.php';</script>";
                        }
                    } else {
                        $sql = "insert into product_show (merchantid, productname, classify, price, sales, star, photo, detailText) values ('$merchantid', '$productname', '$classify', '$price', '0', '0', '$photo', '$detailText')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "<script>alert('商品添加成功！'); window.location.href='./product_list.php';</script>";
                            var_dump($detailText);
                        }
                    }
                }
            } else {

                    if (isset($_GET['productid']) && $_GET['productid'] != '') {
                        $productid = $_GET['productid'];
                        $sql = "update product_show set productname='$productname', classify='$classify', price='$price', detailText='$detailText' where id='$productid'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "<script>alert('商品修改成功！'); window.location.href='./product_list.php';</script>";
                        }
                    } else {
                        echo "<script>alert('文件上传失败！');</script>";
                    }
                
            }
        }
        if (isset($_GET['productid']) && $_GET['productid'] != '') {
            $productid = $_GET['productid'];
            $sql2 = "select * from product_show where id='$productid'";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            mysqli_free_result($result2);
        }
        ?>

        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i class="add"></i><em>编辑/添加产品</em></span>
                    <span class="modular fr"><a href="product_list.php" class="pt-link-btn">商品列表</a></span>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="list-style">
                        <tr>
                            <td style="text-align:right;width:15%;">商品名称：</td>
                            <td><input type="text" name="productname" class="textBox length-long" value="<?php echo (isset($_GET['productid']) && $_GET['productid'] != '') ? $row['productname'] : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">商品分类：</td>
                            <td>
                                <select class="textBox" name="classify">
                                    <option value="0" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 0) ? 'selected' : '' ?>>数码</option>
                                    <option value="1" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 1) ? 'selected' : '' ?>>办公</option>
                                    <option value="2" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 2) ? 'selected' : '' ?>>服饰</option>
                                    <option value="3" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 3) ? 'selected' : '' ?>>模玩</option>
                                    <option value="4" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 4) ? 'selected' : '' ?>>食品</option>
                                    <option value="5" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 5) ? 'selected' : '' ?>>箱包</option>
                                    <option value="6" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 6) ? 'selected' : '' ?>>厨具</option>
                                    <option value="7" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 7) ? 'selected' : '' ?>>茶酒</option>
                                    <option value="8" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 8) ? 'selected' : '' ?>>家具</option>
                                    <option value="9" <?php echo (isset($_GET['productid']) && $_GET['productid'] != '' && $row['classify'] == 9) ? 'selected' : '' ?>>其他</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">价格：</td>
                            <td>
                                <input type="text" name="price" class="textBox length-short" value="<?php echo (isset($_GET['productid']) && $_GET['productid'] != '') ? $row['price'] : ''; ?>" />
                                <span>元</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">商品图片：</td>
                            <td>
                                <input type="file" name="photo" id="suoluetu" />
                                <?php echo (isset($_GET['productid']) && $_GET['productid'] != '') ? "当前商品图为：<img src='../".$row['photo']."' width='60' height='60' class='mlr5' />" : ''; ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;">商品详情：</td>
                            <td><textarea name="detailText" class="textarea"><?php echo (isset($_GET['productid']) && $_GET['productid'] != '') ? $row['detailText'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td style="text-align:right;"></td>
                            <td><input type="submit" name="submit" value="发布/修改商品" class="tdBtn" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php
        mysqli_close($conn);
        ?>
    </div>
</body>

</html>