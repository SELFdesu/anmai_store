<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:../login.php');
}
if(!isset($_SESSION['cartid'])||empty($_POST['productId'])){
    header('Location:../mycart.php');
}


$productid=$_POST['productId'];

$mycart_carid_record=array();
$mycart_productnum_record=array();
$mycart_productname_record=array();
$mycart_productprice_record=array();
$mycart_productphoto_record=array();

$cart_id_record=array();

$flag=false;
$flag_cart=0;
//比较session的cartid和传过来的商品id有一样的flag_cart就加一如果加了就把当前的session存入中间数组中然后把flag_cart归零进行下一次对比。
for($i=0;$i<count($_SESSION['cartid']);$i++){
    for($j=0;$j<count($productid);$j++){
        if($_SESSION['cartid'][$i]==$productid[$j]){
            $flag_cart++;
            break;
        }
    }
    if(!$flag_cart){
        array_push($mycart_carid_record,$_SESSION['cartid'][$i]);
        array_push($mycart_productnum_record,$_SESSION['productnum'][$i]);
        array_push($mycart_productname_record,$_SESSION['productname'][$i]);
        array_push($mycart_productprice_record,$_SESSION['productprice'][$i]);
        array_push($mycart_productphoto_record,$_SESSION['productphoto'][$i]);
        $flag=true;
    }
    $flag_cart=0;
}



unset($_SESSION['cartid']);
unset($_SESSION['productnum']);
unset($_SESSION['productname']);
unset($_SESSION['productprice']);
unset($_SESSION['productphoto']);


//如果没有相同的说明购物车内商品全部结算就不需写入session
if($flag){
    $_SESSION['cartid']=$mycart_carid_record;
    $_SESSION['productnum']=$mycart_productnum_record;
    $_SESSION['productname']=$mycart_productname_record;
    $_SESSION['productprice']=$mycart_productprice_record;
    $_SESSION['productphoto']=$mycart_productphoto_record;
}
header('Location:../mycart.php');
?>