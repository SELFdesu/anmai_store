<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:./login.php');
    }

    $productid=$_POST['id'];
    $recipients=$_POST['recipients'];
    $tel=$_POST['tel'];
    $address=$_POST['order_address'];
    $num=$_POST['num'];
    $allprice=$_POST['allprice'];
    $uid=$_SESSION['uid'];

    include_once '../common/database.php';
    for($i=0;$i<count($productid);$i++){
        $sql="update product_show set sales=sales+'{$num[$i]}' where id='{$productid[$i]}'";
        mysqli_query($link,$sql);
    }


    $mycart_carid_record=array();
    $mycart_productnum_record=array();
    $mycart_productname_record=array();
    $mycart_productprice_record=array();
    $mycart_productphoto_record=array();

    $cart_id_record=array();

    $flag=false;
    $flag_cart=0;

    include_once '../common/database.php';
    for($i=0;$i<count($productid);$i++){
        $sql="INSERT INTO product_order (productid,recipients,contacttel,orderaddress, num, allprice,userid) VALUES ('{$productid[$i]}','{$recipients}','{$tel}','{$address}','{$num[$i]}','{$allprice[$i]}','{$uid}')";

        if (mysqli_query($link, $sql)) {
            echo "订单'{$_POST['name'][$i]}×{$num[$i]}'提交成功";
            echo "<br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
            echo "<br/>";
        }
    }


    if(!isset($_POST['product_to_order'])){

        for($i=0;$i<count($_SESSION['cartid']);$i++){
            for($j=0;$j<count($productid);$j++){
                if($_SESSION['cartid'][$i]==$productid[$j]){
                    $flag_cart++;
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
        
    
    
        if($flag){
            $_SESSION['cartid']=$mycart_carid_record;
            $_SESSION['productnum']=$mycart_productnum_record;
            $_SESSION['productname']=$mycart_productname_record;
            $_SESSION['productprice']=$mycart_productprice_record;
            $_SESSION['productphoto']=$mycart_productphoto_record;
        }

    }

    echo "界面将在3秒后转跳到首页！";

?>

<script type="text/javascript">
	window.onload=function(){
        setTimeout(function(){
            window.location.href="../index.php";
        },3000)
    }
</script>