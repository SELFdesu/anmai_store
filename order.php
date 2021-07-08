<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:./login.php');
}

if(!isset($_POST['productId'])){
    header('Location:./mycart.php');
}


include_once './common/database.php';

$productId=$_POST['productId'];

if(!is_array($productId)){
    $productnum=$_POST['productnum'];
}else{
    $productnum=array();
    $flag=false;
    $cart_id_record=array();

    for($i=0;$i<count($_SESSION['cartid']);$i++){
        for($j=0;$j<count($productId);$j++){
            if($_SESSION['cartid'][$i]==$productId[$j]){
                $flag=true;
            }
        }
        if($flag){
            array_push($productnum,$_SESSION['productnum'][$i]);
            $flag=false;
        }
    }
}




$all_price=0;
$order_row=array();

if(is_array($productId)){
    for($i=0;$i<count($productId);$i++){
        $sql="select * from product_show where id='{$productId[$i]}'";
        $result=mysqli_query($link,$sql);
        array_push($order_row,mysqli_fetch_assoc($result));
        $all_price+=$productnum[$i]*$order_row[$i]['price'];
    }
}else{
    $sql="select * from product_show where id='{$productId}'";
    $result=mysqli_query($link,$sql);
    array_push($order_row,mysqli_fetch_assoc($result));
    $all_price=$productnum*$order_row[0]['price'];
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>提交订单</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" />
    <link rel="stylesheet" type="text/css" href="css/order.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
</head>
<body>
    <div id="banerBackg"></div>
        <div id="all">
            <?php include_once './common/header.php' ?>
            <form action="./dispose/order_dispose.php" method="post">

                <div class="order">

                    <div class="order_address">
                        <div class="address_title">请填写收件人：</div>
                        <div>
                           <input class="order_recipients" type="text" name="recipients" required="required">
                        </div>
                    </div>

                    <div class="order_address">
                        <div class="address_title">请填写联系电话：</div>
                        <div>
                           <input class="order_tel" type="text" name="tel" required="required" >
                        </div>
                    </div>


                    <div class="order_address">
                        <div class="address_title">请填写您的收货地址：</div>
                        <div>
                            <textarea name="order_address" cols="100" rows="5"  required="required"></textarea>
                        </div>
                    </div>


                    <div class="order_detail">
                        <div class="product_title">确认商品信息：</div>
                        <div class="product_content">
                            <div class="content_title">
                                <div class="content_title_text">商品名</div>
                                <div class="content_title_text">单价</div>
                                <div class="content_title_text">商品数量</div>
                                <div class="content_title_text">小计</div>
                                <div class="clear"></div>
                            </div>
                            <?php if(is_array($productId)){ ?>
                                <?php for($i=0;$i<count($productId);$i++){ ?>
                                <div class="content_detail">
                                    <div class="content_detail_text">
                                        <div class="detail_img"> <img width="50px" height="50px" src="<?php echo $order_row[$i]['photo'] ?>" alt=""> </div>
                                        <div class="detail_name"> <span><?php echo $order_row[$i]['productname'] ?></span> </div>
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $order_row[$i]['price'] ?>元
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $productnum[$i] ?>
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $order_row[$i]['price']*$productnum[$i] ?>元
                                    </div>
                                    <input type="hidden" name="name[]" value="<?php echo $order_row[$i]['productname'] ?>">
                                    <input type="hidden" name="id[]" value="<?php echo $productId[$i] ?>">
                                    <input type="hidden" name="num[]" value="<?php echo $productnum[$i] ?>">
                                    <input type="hidden" name="allprice[]" value="<?php echo $order_row[$i]['price']*$productnum[$i] ?>">

                                    <div class="clear"></div>
                                </div>
                                <?php } ?>
                            <?php }else{?>
                                <div class="content_detail">
                                    <div class="content_detail_text">
                                        <div class="detail_img"> <img width="50px" height="50px" src="<?php echo $order_row[0]['photo'] ?>" alt=""> </div>
                                        <div class="detail_name"> <span><?php echo $order_row[0]['productname'] ?></span> </div>
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $order_row[0]['price'] ?>元
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $productnum ?>
                                    </div>
                                    <div class="content_detail_text">
                                        <?php echo $order_row[0]['price']*$productnum ?>元
                                    </div>
                                    <input type="hidden" name="name[]" value="<?php echo $order_row[0]['productname'] ?>">
                                    <input type="hidden" name="id[]" value="<?php echo $productId ?>">
                                    <input type="hidden" name="num[]" value="<?php echo $productnum ?>">
                                    <input type="hidden" name="allprice[]" value="<?php echo $order_row[0]['price']*$productnum ?>">
                                    <div class="clear"></div>
                                </div>
                            <?php } ?>
                            <div class="clear"></div>
                            <div class="sub_btn">
                                <div class="allprice">总额:<span class="allprice_title"><?php echo $all_price ?></span></div>
                                <?php if(isset($_POST['product_to_order'])){ ?>
                                    <input type="hidden" name="product_to_order" value="true">
                                <?php } ?>
                                <button type="submit">结算</button>
                            </div>
                        </div>

                    </div>

                </div> 
                
            </form>


            <div style="clear: both;"></div>
            <?php include_once './common/footer.php'?>
        </div>
        <div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
        
</body>
</html>