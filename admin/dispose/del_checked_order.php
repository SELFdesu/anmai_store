<?php
$order_id=implode(',',$_POST['checked']);
include_once '../../common/database.php';

$sql="delete from product_order where orderid in ({$order_id})";
mysqli_query($link,$sql);

header('Location:../manage-order.php');
?>