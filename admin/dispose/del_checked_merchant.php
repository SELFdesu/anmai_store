<?php
$merchant_id=implode(',',$_POST['checked']);
include_once '../../common/database.php';

$sql="delete from merchant_users where id in ({$merchant_id})";
mysqli_query($link,$sql);

header('Location:../manage-merchant.php');
?>