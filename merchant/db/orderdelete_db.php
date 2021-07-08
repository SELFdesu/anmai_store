<?php
include '../conn/connectsql_db.php';
if (isset($_GET['orderNumber']) && $_GET['orderNumber'] != '') {
    $orderid = $_GET['orderNumber'];
    $sql="delete from product_order where orderid='$orderid'";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('删除成功！'); window.location.href='../order_list.php';</script>";
    }
}
if(isset($_POST['checkbox'])){
    $arr=$_POST['checkbox'];
    $ordersid=implode(',', $arr);
    $sql="delete from product_order where orderid in ($ordersid)";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('删除成功！'); window.location.href='../order_list.php';</script>";
    }
}
mysqli_free_result($result);
mysqli_close($conn);
?>