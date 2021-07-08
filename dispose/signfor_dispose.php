<?php
    include_once '../common/database.php';
    date_default_timezone_set('PRC');
    $orderid=$_POST['orderid'];
    $nowdate=date('Y-m-d H:i:s');
    $sql="UPDATE product_order SET signfor='1',signfortime='{$nowdate}' WHERE orderid={$orderid}";
    mysqli_query($link,$sql);
    header('Location:../signfororder.php')
?>