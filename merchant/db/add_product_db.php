<?php
if (isset($_POST['submit'])) {
    session_start();
    $merchantid = $_SESSION['merchantid'];
    $productname = $_POST['productname'];
    $classify = $_POST['classify'];
    $price = $_POST['price'];
    $detailText = $_POST['detailText'];
    $photofile = $_FILES;
    if (is_uploaded_file($photofile['photo']['tmp_name'])) {
        if(move_uploaded_file($photofile['photo']['tmp_name'], '../../img/product/' . $photofile['photo']['name'])){
            $photo = "img/product/".$photofile['photo']['name'];
            include '../conn/connectsql_db.php';
            $sql = "insert into product_show (merchantid, productname, classify, price, sales, star, photo, detailText) values ('$merchantid', '$productname', '$classify', '$price', '0', '0', '$photo', '$detailText')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "<script>alert('商品添加成功！'); window.location.href='../product_list.php';</script>";
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        }
    } else {
        echo "<script>alert('文件上传失败！');</script>";
    }
}
?>