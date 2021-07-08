<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    $orderid=$_POST['orderid'];
    $userid=$_POST['userid'];
    $productid=$_POST['productid'];
    $content=$_POST['content'];
    include_once '../common/database.php';
    $sql="INSERT INTO product_comment (userid,productid,orderid,content) VALUES ('{$userid}','{$productid}','{$orderid}','{$content}');";
    mysqli_query($link,$sql);
    $sql="UPDATE product_order SET whether_comment='1' WHERE orderid={$orderid}";
    mysqli_query($link,$sql);
    header('Location:../evaluate.php');
?>