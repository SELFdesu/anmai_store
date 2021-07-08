<?php
$addr=$_POST['addr'];
$car_id=$_POST['car_id'];


include_once '../../common/database.php';
$sql="update index_carousel set addr='{$addr}' where id={$car_id}";
mysqli_query($link,$sql);

header('Location:../manage-carousel.php');
?>