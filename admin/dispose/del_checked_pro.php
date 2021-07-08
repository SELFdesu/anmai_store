<?php
$pro_id=implode(',',$_POST['checked']);
include_once '../../common/database.php';

$sql="delete from product_show where id in ({$pro_id})";
mysqli_query($link,$sql);

header('Location:../manage-product.php');
?>