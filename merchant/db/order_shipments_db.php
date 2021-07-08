<?php
include '../conn/connectsql_db.php';
if(isset($_POST['submit'])){
    $waybillarr=$_POST['waybill'];
    $ordersid=$_POST['orderid'];
    $ordersidarr=explode(',',$ordersid);
    for($i=0; $i<count($ordersidarr); $i++){
        $sql="update product_order set send=1,airwaybill='$waybillarr[$i]' where orderid='$ordersidarr[$i]'";
        $result=mysqli_query($conn, $sql);
    }
    if($result){
        echo "<script>alert('发货成功！'); window.location.href='../order_list.php';</script>";
    }
}
mysqli_close($conn);
?>