<?php
include '../conn/connectsql_db.php';
if(isset($_GET['productid']) && $_GET['productid'] !=''){
    $productid=$_GET['productid'];
    $sql="delete from product_show where id='$productid'";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('删除成功！'); window.location.href='../product_list.php';</script>";
    }
}
if(isset($_POST['checkbox'])){
    $arr=$_POST['checkbox'];
    $productsid=implode(',', $arr);
    var_dump($productsid);
    $sql="delete from product_show where id in ($productsid)";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('删除成功！'); window.location.href='../product_list.php';</script>";
    }
}
?>