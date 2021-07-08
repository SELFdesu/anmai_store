<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    include_once './common/database.php';
    $userid=$_SESSION['uid'];



    $sql="select count(orderid) from product_order where userid={$userid} and whether_comment='0'";
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
    

    $sql="SELECT tb2.id,tb2.productname,tb2.photo,tb2.price,tb1.num,tb1.allprice,tb1.orderid,tb1.time FROM product_order tb1 INNER JOIN product_show tb2 ON tb1.productid=tb2.id and tb1.userid={$userid} and tb1.signfor='0' and tb1.send='1' ORDER BY tb1.orderid DESC LIMIT {$star_num},{$onePageNum};";
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>待收货</title>
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
                <div class="headtitle">待收货</div>
                <div class="head_title">
                    <div class="head_title1">订单</div>
                    <div class="head_title2">单价</div>
                    <div class="head_title3">数量</div>
                    <div class="head_title4">操作</div>
                    <div class="head_title6" style="width: 30%;">下单时间</div>
                </div>

                <div class="myorder_content">
                    <?php if(!count($rows)){ ?>
                        <p class="none_p">您暂时没有未签收的订单。</p>
                    <?php }else{ ?>
                        <?php for($i=0;$i<count($rows);$i++){?>
                            <div class="myorder_content_row">
                                <form action="" method="post">
                                    <div class="content_row_order">
                                        <div class="row_order_img"><img src="<?php echo $rows[$i]['photo'] ?>" alt=""></div>
                                        <div class="row_order_name"><span><?php echo $rows[$i]['productname'] ?></span></div>
                                    </div>
                                    <div class="content_row_price"><span><?php echo $rows[$i]['price'] ?></span>元</div>
                                    <div class="content_row_num"><span><?php echo $rows[$i]['num'] ?></span></div>
                                    <div class="content_row_allprice"><span><button type="submit" onclick="return confirm('是否确认签收？')" formaction="./dispose/signfor_dispose.php">签收</button></span></div>
                                    <div class="content_row_time" style="width: 30%;float:left"><span><?php echo $rows[$i]['time'] ?></span></div>
                                    <div class="clear"></div>
                                    <input type="hidden" name="productid" value="<?php echo $rows[$i]['id'] ?>">
                                    <input type="hidden" name="orderid" value="<?php echo $rows[$i]['orderid'] ?>">
                                    <input type="hidden" name="userid" value="<?php echo $_SESSION['uid'] ?>">
                                    

                                </form>
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