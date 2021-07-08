<?php
    if(isset($_GET['productid'])){
        session_start();

        $productid=$_GET['productid'];

        $flag=false;

        $push_flag;
    
        $mycart_carid_record=array();
        $mycart_productnum_record=array();
        $mycart_productname_record=array();
        $mycart_productprice_record=array();
        $mycart_productphoto_record=array();

        for($i=0;$i<count($_SESSION['cartid']);$i++){
                if($_SESSION['cartid'][$i]==$productid){
                    $push_flag=$i;
                    $flag=true;
                }
        }
    
        for($i=0;$i<count($_SESSION['cartid']);$i++){
            if($i!=$push_flag){
                array_push($mycart_carid_record,$_SESSION['cartid'][$i]);
                array_push($mycart_productnum_record,$_SESSION['productnum'][$i]);
                array_push($mycart_productname_record,$_SESSION['productname'][$i]);
                array_push($mycart_productprice_record,$_SESSION['productprice'][$i]);
                array_push($mycart_productphoto_record,$_SESSION['productphoto'][$i]);
            }
            
        }
    
    
        unset($_SESSION['cartid']);
        unset($_SESSION['productnum']);
        unset($_SESSION['productname']);
        unset($_SESSION['productprice']);
        unset($_SESSION['productphoto']);
        
        if(!count($mycart_carid_record)<1){
            $_SESSION['cartid']=$mycart_carid_record;
            $_SESSION['productnum']=$mycart_productnum_record;
            $_SESSION['productname']=$mycart_productname_record;
            $_SESSION['productprice']=$mycart_productprice_record;
            $_SESSION['productphoto']=$mycart_productphoto_record;
        }
        

        header('Location:../mycart.php');
        

    }else{
        header('Location:../mycart.php');
    }

?>