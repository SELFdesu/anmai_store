<?php
$orderid=$_GET['orderid'];
include_once '../../common/database.php';
$sql="delete from product_order where orderid={$orderid};";
mysqli_query($link,$sql);
header('Location:../manage-order.php');
?>