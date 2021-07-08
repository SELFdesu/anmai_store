<?php
    $comid=$_GET['commentid'];
    $orderid=$_GET['orderid'];
    include_once '../../common/database.php';
    $sql="delete from product_comment where id='{$comid}'";
    mysqli_query($link,$sql);
    $sql="update product_order set whether_comment='0' where orderid='{$orderid}';";
    mysqli_query($link,$sql);
    header('Location:../manage-comment.php')
?>