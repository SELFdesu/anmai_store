<?php
$productid=$_GET['productid'];
include_once '../../common/database.php';
$sql="delete from product_show where id={$productid};";
mysqli_query($link,$sql);
header('Location:../manage-product.php');
?>