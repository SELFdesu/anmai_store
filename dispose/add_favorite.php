<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../login.php');
    }
    if(!isset($_GET['productid'])||$_GET['productid']==''){
        header('Location:../index.php');
    }

    $productid=$_GET['productid'];
    $userid=$_SESSION['uid'];

    include_once '../common/database.php';
    $sql="insert into user_favorite (productid,userid) values ('{$productid}','{$userid}');";
    mysqli_query($link,$sql);

    $sql_insert="update product_show set star=star+1 where id='{$productid}';";
    mysqli_query($link,$sql_insert);


    mysqli_close($link);



    header('Location:../product.php?productId='.$_GET['productid']);
?>