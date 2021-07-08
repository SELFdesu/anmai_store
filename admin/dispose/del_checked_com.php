<?php
$com_id=implode(',',$_POST['checked']);
include_once '../../common/database.php';

$sql="select orderid from product_comment where id in ({$com_id})";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_all($result);
$orderArr=array();
foreach($rows as $value){
    array_push($orderArr,$value[0]);
}
$order_id=implode(',',$orderArr);

$sql="delete from product_comment where id in ({$com_id})";
mysqli_query($link,$sql);

$sql="update product_order set whether_comment='0' where orderid in ({$order_id});";
mysqli_query($link,$sql);


header('Location:../manage-comment.php');
?>