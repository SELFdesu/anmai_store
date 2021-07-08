<?php 
session_start();
include_once './common/database.php';
$sql_show="select * from product_show where id='{$_GET['productId']}';";
$result_show=mysqli_query($link,$sql_show);
$show_row=mysqli_fetch_assoc($result_show);
if($show_row['active']==0){
    header('Location:./error.html');
}


if(isset($_SESSION['uid'])){
    $sql_fav="select * from user_favorite where productid={$_GET['productId']} and userid={$_SESSION['uid']} ;";
    $result_fav=mysqli_query($link,$sql_fav);
}


$sql_comment="select tb1.content,tb1.time,tb2.username,tb2.photo from product_comment tb1 inner join users tb2 on tb1.userid=tb2.id and tb1.productid={$_GET['productId']}";
$result_com=mysqli_query($link,$sql_comment);
$rows_com=mysqli_fetch_all($result_com,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品页</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" />
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
    <script src="./js/product.js"></script>
</head>
<body>
    <div id="banerBackg"></div>
        <div id="all">
            <?php include_once './common/header.php' ?>



            <div class="pro_top">

                <div class="pro_left">

                    <img class="pro_photo" src="<?php echo $show_row['photo'] ?>" alt="">

                </div>


                <div class="pro_right">

                    <div class="pro_title">

                        <p><?php echo $show_row['productname'] ?></p>
                    
                    </div>

                    <div class="pro_price">

                        <p><?php echo $show_row['price'] ?></p>
                    
                    </div>

                    <div class="pro_starnum">

                        <p class="starnum_line starnum_left"> 销量：    <span class="starnum_text"><?php echo $show_row['sales'] ?> </span> </p>
                        <p class="starnum_line"> 收藏数：<span class="starnum_text"><?php echo $show_row['star'] ?>       </span> </p>
                    
                    </div>


                    <div class="pro_operate">
                        <form action="" method="post">

                            <div class="pro_num">
                                <input type="hidden" value="<?php echo $_GET['productId'] ?>" name="productId">
                                <p>数量：<input type="text" name="productnum" value="1"></p>
                            </div>
                            <?php if(isset($_SESSION['uid'])){ ?>
                                <?php if(!mysqli_num_rows($result_fav)){ ?>
                                    <div class="pro_star">
                                        <p><a href="./dispose/add_favorite.php?productid=<?php echo $_GET['productId'] ?>"><i class="fa fa-star"></i> <span>收藏</span> </a></p>
                                    </div>
                                <?php }else{ ?>
                                    <div class="pro_star_ed">
                                        <p><i class="fa fa-star"></i> <span>已收藏</span> </a></p>
                                    </div>
                                <?php }?>
                            <?php }else{?>

                                <div class="pro_star">
                                    <p><a href="login.php"><i class="fa fa-star"></i> <span>收藏</span> </a></p>
                                </div>

                            <?php }?>

                            <div class="pro_buy">
                                <input type="hidden" name="product_to_order" value="true">
                                <button type="submit" value="<?php echo $_GET['productId'] ?>" name="buy" formaction="./order.php">购买</button>
                            </div>

                            <div class="pro_addcart">
                               <button type="submit" value="<?php echo $_GET['productId'] ?>" name="addcart" formaction="./dispose/addcart_dispose.php">加入购物车</button>                            
                            </div>

                        </form>
                    </div>

                </div>
                <div style="clear: both;"></div>

            </div>




            <div class="pro_bot">
            
            <div class="pro_bot_title">
                <div class="introduce_title">产品介绍</div>
                <div class="evaluate_title">用户评价</div>
                <div class="clear"></div>
            </div>
            
            <?php if(!!mysqli_num_rows($result_show)){ ?>
            <div class="introduce_content">
                <p><img src="<?php echo $show_row['detailPhoto'] ?>" alt=""></p>
                <p><?php echo $show_row['detailText'] ?></p>
            </div>
            <?php }else{ ?>
                <p class="introduce_none introduce_content">该商品暂无简介。</p>
            <?php } ?>
            <div class="evaluate_content">
                <?php if(!!mysqli_num_rows($result_com)){ ?>
                    <?php foreach($result_com as $value){ ?>
                    <div class="evaluate_content_row">
                        <div class="con_left">
                            <div class="userphoto"><img src="<?php echo $value['photo'] ?>" alt=""></div>
                            <div class="username"><span><?php echo $value['username'] ?></span></div>
                        </div>
                        <div class="con_right">
                            <div class="evaluate_text"><?php echo $value['content'] ?></div>
                            <div class="evaluate_time"><?php echo $value['time'] ?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                <?php }else{?>
                    <p  class="evaluate_none evaluate_content_row">该商品暂无评论。</p>
                <?php }?>
            </div>
           
            
            
            </div>
            

            <div style="clear: both;"></div>
            <?php include_once './common/footer.php'?>
        </div>
        <div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
        
</body>
</html>