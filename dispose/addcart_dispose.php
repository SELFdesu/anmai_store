<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}
include_once '../common/database.php';

$productId=$_POST['productId'];
$productNum=$_POST['productnum'];

$sql="select * from product_show where id='{$productId}'";
$result=mysqli_query($link,$sql);
$catrow=mysqli_fetch_assoc($result);

$flag=true;
// 判断购物车内有无商品如没有则将当前商品以数组形式存入session中。
if(isset($_SESSION['cartid'])){
    //查看现有信息内有无与此次加入数据库商品相同的如有则将之前存入的对应商品数量增加。
    for($i=0;$i<count($_SESSION['cartid']);$i++){
        if($productId==$_SESSION['cartid'][$i]){
            $_SESSION['productnum'][$i]+=$productNum;
            $flag=false;
        }
    }
    //如没有相同的则将当前信息存入session中
    if($flag){
        $prosession=$_SESSION['cartid'];
        array_push($prosession,$productId);
        $_SESSION['cartid']= $prosession;

        $pronum=$_SESSION['productnum'];
        array_push($pronum,$productNum);
        $_SESSION['productnum']= $pronum;

        $proname=$_SESSION['productname'];
        array_push($proname,$catrow['productname']);
        $_SESSION['productname']= $proname;

        $proprice=$_SESSION['productprice'];
        array_push($proprice,$catrow['price']);
        $_SESSION['productprice']= $proprice;

        $prophoto=$_SESSION['productphoto'];
        array_push($prophoto,$catrow['photo']);
        $_SESSION['productphoto']= $prophoto;

    }
    


}else{
    $_SESSION['cartid']=array($productId);

    $_SESSION['productnum']=array($productNum);

    $_SESSION['productname']=array($catrow['productname']);

    $_SESSION['productprice']=array($catrow['price']);

    $_SESSION['productphoto']=array($catrow['photo']);
}



header('Location:../mycart.php')

?>