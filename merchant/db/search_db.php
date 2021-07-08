<?php
include '../conn/connectsql_db.php';
$sql = "SELECT a.orderid from product_order a, product_show c WHERE a.productid=c.id AND c.merchantid=1";
$result = mysqli_query($conn, $sql);
var_dump($result);
$num=mysqli_num_rows($result);
var_dump($num);
?>