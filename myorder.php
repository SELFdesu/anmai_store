<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    include_once './common/database.php';
    $userid=$_SESSION['uid'];

    $sql="select count(orderid) from product_order where userid={$userid}";
    $result=mysqli_query($link,$sql);

    $proNum=mysqli_fetch_row($result);
    $onePageNum=8;
    $pageNum=ceil($proNum[0]/$onePageNum);
    $nowPage;
    if(!isset($_GET['page'])){
        $nowPage=1;
    }else{
        $nowPage=$_GET['page'];
        if($_GET['page']<1){
            $_GET['page']=1;
            $nowPage=1;
        }elseif($_GET['page']>$pageNum){
            $_GET['page']=$pageNum;
            $nowPage=$pageNum;
        }
    }
    $star_num=($nowPage-1)*$onePageNum;

    $sql="SELECT tb2.productname,tb2.photo,tb2.price,tb2.id,tb1.num,tb1.allprice,tb1.signfor,tb1.time FROM product_order tb1 INNER JOIN product_show tb2 ON tb1.productid=tb2.id and tb1.userid={$userid} ORDER BY tb1.orderid desc LIMIT {$star_num},{$onePageNum};";
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的订单</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="css/search.css"/>
    <link rel="stylesheet" type="text/css" href="css/footer.css" />
    <link rel="stylesheet" type="text/css" href="css/myorder.css">
</head>
<body>
<div id="banerBackg"></div>
		<div id="all">
			<?php include_once './common/header.php' ?>	


			<!-- 搜索框开始 -->
			<div id="search">
				<div id='leftLogo'></div>
				<form id="searchForm" action="" method="post">
					<input class="txt" type="text" name="serch_content"  required="required" />
					<input class="sub" type="submit" formaction="./serch_page.php" name="serch_btn" value="搜索" />
				</form>
			</div>
			<!-- 搜索框结束 -->

            <div>
                <div class="headtitle">我的订单</div>
                <div class="head_title">
                    <div class="head_title1">订单</div>
                    <div class="head_title2">单价</div>
                    <div class="head_title3">数量</div>
                    <div class="head_title4">实付款</div>
                    <div class="head_title5">是否签收</div>
                    <div class="head_title6">下单时间</div>
                </div>

                <div class="myorder_content">
                    <?php if(!count($rows)){ ?>
                        <p class="none_p">您暂时没有订单。</p>
                    <?php }else{ ?>
                        <?php for($i=0;$i<count($rows);$i++){?>
                            <div class="myorder_content_row">
                            <a class="myorder_content_row_a" href="./product.php?productId=<?php echo $rows[$i]['id']  ?>">
                                <div class="content_row_order">
                                    <div class="row_order_img"><img src="<?php echo $rows[$i]['photo'] ?>" alt=""></div>
                                    <div class="row_order_name"><span><?php echo $rows[$i]['productname'] ?></span></div>
                                </div>
                                <div class="content_row_price"><span><?php echo $rows[$i]['price'] ?></span>元</div>
                                <div class="content_row_num"><span><?php echo $rows[$i]['num'] ?></span></div>
                                <div class="content_row_allprice"><span><?php echo $rows[$i]['allprice'] ?></span>元</div>
                                <div class="content_row_signfor"><span><?php echo $rows[$i]['signfor']==0?"未签收":"已签收" ?></span></div>
                                <div class="content_row_time"><span><?php echo $rows[$i]['time'] ?></span></div>
                                <div class="clear"></div>
                            </a>
                            </div>
                        <?php }?>
                    <?php }?>

                </div>

                <?php if($proNum[0]>$onePageNum){ ?>
                <div class="paging">
						<?php if($nowPage!=1){ ?>
						<a href="?page=<?php echo $nowPage-1 ?>">
							<div class="page"><i class="fa fa-chevron-left"></i></div>
						</a>
						<?php } ?>
						<div class="pagenum">第<span><?php echo $nowPage ?></span>/<?php echo $pageNum ?>页</div>

						<?php if($nowPage!=$pageNum){ ?>
						<a href="?page=<?php echo $nowPage+1 ?>">
							<div class="page"><i class="fa fa-chevron-right"></i></div>
						</a>
						<?php } ?>

						<div class="clear"></div>
                </div>
                <div class="clear"></div>
                <?php } ?>

            </div>
            <div class="clear"></div>
			

			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
</body>
</html>