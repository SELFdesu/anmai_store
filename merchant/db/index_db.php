<?php
if(!isset($_SESSION['mer_username'])){
    header('location:./adminLogin.php');
}
$merchantid=$_SESSION['merchantid'];
include './conn/connectsql_db.php';
$sql="select count(productname) from product_show where merchantid = $merchantid";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$sql2="select count(a.send), sum(a.send), sum(a.signfor), sum(a.allprice) from product_order a JOIN product_show b ON a.productid = b.id and b.merchantid = $merchantid";
$result2=mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($conn);
?>