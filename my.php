<?php	
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location:login.php');
	}

	include_once './common/database.php';
	$pro_id=array();
	$userid=$_SESSION['uid'];

	$sql="select count(favID) from user_favorite where userid={$userid}";
	$result=mysqli_query($link,$sql);
   
	$proNum=mysqli_fetch_row($result);
	$onePageNum=5;
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

	$sql="select tb1.favID,tb2.photo,tb2.productname,tb2.price,tb2.id from user_favorite tb1 inner join product_show tb2 on tb1.productid=tb2.id and tb1.userid={$userid} order by tb1.favID desc limit {$star_num},{$onePageNum}";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);

    $sql_order="select * from product_order where userid={$userid}";
    $result_order=mysqli_query($link,$sql_order);
	$order_num=mysqli_num_rows($result_order);

	$sql_evaluate="select * from product_order where whether_comment='0' and signfor='1' and userid={$userid}";
	$result_evaluate=mysqli_query($link,$sql_evaluate);
	$evaluate_num=mysqli_num_rows($result_evaluate);

	$sql_unsend="select count(orderid) from product_order where send='0' and userid={$userid}";
	$result_unsend=mysqli_query($link,$sql_unsend);
	$unsendnum=mysqli_fetch_row($result_unsend)[0];

	$sql_signfor="select count(orderid) from product_order where signfor='0' and send='1' and userid={$userid}";
	$result_signfor=mysqli_query($link,$sql_signfor);
	$signfornum=mysqli_fetch_row($result_signfor)[0];

	$sql_airwayBill="select airwayBill from product_order where send='1' and signfor='0' and userid={$userid} order by orderid desc";
	$result_airwayBill=mysqli_query($link,$sql_airwayBill);
	$airwayBill=mysqli_fetch_all($result_airwayBill);

	$sql_airway_detail="select tb2.productname,tb2.photo from product_order tb1 inner join product_show tb2 on tb1.productid=tb2.id and send='1' and signfor='0' and userid={$userid} order by tb1.orderid desc";
	$result_airway_detail=mysqli_query($link,$sql_airway_detail);
	$airway_detail=mysqli_fetch_all($result_airway_detail,MYSQLI_ASSOC);

if(isset($_SESSION['cartid'])){
	$proNum_cart=count($_SESSION['cartid']);
	$onePageNum_cart=5;
	if($proNum_cart<$onePageNum_cart){
		$onePageNum_cart=$proNum_cart;
	}
	$pageNum_cart=ceil($proNum_cart/$onePageNum_cart);
	$nowPage_cart;
	if(!isset($_GET['page_cart'])){
	   $nowPage_cart=1;
	}else{
	   $nowPage_cart=$_GET['page_cart'];
	   if($_GET['page_cart']<1){
		   $_GET['page_cart']=1;
		   $nowPage_cart=1;
	   }elseif($_GET['page_cart']>$pageNum_cart){
		   $_GET['page_cart']=$pageNum_cart;
		   $nowPage_cart=$pageNum_cart;
	   }

	}
	$star_num_cart=($nowPage_cart-1)*$onePageNum_cart;
	if(isset($_GET['page_cart'])){
		if($nowPage_cart==$pageNum_cart&&$proNum_cart%$onePageNum_cart){
			$onePageNum_cart=$proNum_cart%$onePageNum_cart;
		}	
	}		
	
}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的</title>
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
		<link rel="stylesheet" href="./css/header.css">
		<link rel="stylesheet" type="text/css" href="css/search.css"/>
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<link rel="stylesheet" href="./css/my.css">
		<script src="js/my.js" type="text/javascript" charset="utf-8"></script>
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

			<!-- 个人信息开始 -->
			<div id="status_bar">
				<div class="sta_left">
					<a href="#"><img src="<?php echo $_SESSION['user_photo'] ?>"></a>
					<a href="#">
						<p><?php echo $_SESSION['username'] ?></p>
					</a>
				</div>
				<div class="sta_right">
					<div class="payment">
						<div id="payNum"><?php echo $order_num ?></div>
						<a href="myorder.php">
							<div>
								<i class="fa fa-credit-card-alt"></i>
							</div>
							<p>我的订单</p>
						</a>
					</div>

					<div class="deliver">
						<div id="delNum"><?php echo $unsendnum ?></div>
						<a href="unfilledOrder.php">
							<div>
								<i class="fa fa-archive"></i>
							</div>
							<p>待发货</p>
						</a>
					</div>

					<div class="receiving">
						<div id="receNum"><?php echo $signfornum ?></div>
						<a href="signfororder.php">
							<div>
								<i class="fa fa fa-truck"></i>
							</div>
							<p>待收货</p>
						</a>
					</div>

					<div class="evaluate">
						<div id="evaNum"><?php echo $evaluate_num ?></div>
						<a href="evaluate.php">
							<div>
								<i class="fa fa-commenting-o"></i>
							</div>
							<p>待评价</p>
						</a>
					</div>


				</div>
			</div>
			<!-- 个人信息结束 -->

			<!-- 日历开始 -->
			<div id="calendar">
				<div class="calTitle">我的日历</div>
				<div id="allDate">
					<div class="week">
						<p id="weekInner"></p>
					</div>
					<div class="date">
						<div id="day"></div>
						<div id="year"></div>
					</div>
				</div>

			</div>
			<!-- 日历结束 -->

			<!-- 物流区开始 -->
			<div id="receiving_area">
				<div id="recTitle">
					<i class="fa fa fa-truck"></i>
					<p>物流信息</p>
				</div>

				<div class="recContent">
					<?php if(mysqli_num_rows($result_airwayBill)){ ?>
						<div class="recContent_title">
							<div class="recContent_title1">商品名</div>
							<div class="recContent_title2">快递单号</div>
						</div>
						<?php foreach($airwayBill as $key=>$value){ ?>
							<div class="recContent_row">
								<div class="recContent_row_left">
									<div class="recContent_row_photo"><img src="<?php echo $airway_detail[$key]['photo'] ?>" alt=""></div>
									<div class="recContent_row_title"><?php echo $airway_detail[$key]['productname'] ?></div>
								</div>
								<div class="recContent_row_right"><span><?php echo $value[0] ?></span></div>
							</div>
						<?php } ?>
					<?php }else{ ?>
					<p>暂无物流信息~</p>
					<?php } ?>
					<div class="clear"></div>
				</div>
			</div>
			<!-- 物流区结束 -->

			<!-- 购物车收藏夹情况展示区开始 -->
			<div class="cart_fa_show">
				<div class="show_left_div">
					<a href="./mycart.php">
						<div class="show_left_title">
							<i class="fa fa-shopping-cart"></i>
							<span>
								我的购物车
							</span>
						</div>
					</a>
					<div class="show_left_content">
						<?php if(!isset($_SESSION['cartid'])){ ?>
						<p>您的购物车为空~</p>
						<?php }else{ ?>
							<?php for($i=$star_num_cart;$i<$star_num_cart+$onePageNum_cart;$i++){ ?>
							<a class="my_cart_row_a" href="product.php?productId=<?php echo $_SESSION['cartid'][$i] ?>">
								<div class="my_cart_row">
									<div class="my_cart my_cart_photo"><img src="<?php echo $_SESSION['productphoto'][$i] ?>" width="50px" height="50px"></div>
									<div class="my_cart my_cart_name"><span><?php echo $_SESSION['productname'][$i] ?></span></div>
								</div>
							</a>
							<?php } ?>
							<div class="clear"></div>

							
							
						<?php } ?>


					<?php if(isset($_SESSION['cartid'])&&$proNum_cart>$onePageNum_cart){ ?>
					<div class="paging">
						<?php if($nowPage_cart!=1){ ?>
						<a href="?page_cart=<?php echo $nowPage_cart-1 ?><?php echo isset($_GET['page'])?'&page='.$_GET['page']:'' ?>">
							<div class="page"><i class="fa fa-chevron-left"></i></div>
						</a>
						<?php } ?>
						<div class="pagenum">第<span><?php echo $nowPage_cart ?></span>/<?php echo $pageNum_cart ?>页</div>

						<?php if($nowPage_cart!=$pageNum_cart){ ?>
						<a href="?page_cart=<?php echo $nowPage_cart+1 ?><?php echo isset($_GET['page'])?'&page='.$_GET['page']:'' ?>">
							<div class="page"><i class="fa fa-chevron-right"></i></div>
						</a>
						<?php } ?>

						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<?php } ?>


					</div>
				</div>

				<div class="show_right_div">
					<a href="./favorite.php">
						<div class="show_right_title">
							<i class="fa fa-th-large"></i>
							<span>我的收藏夹</span>
						</div>
					</a>
					<div class="show_right_content">
					<?php if(!count($rows)){ ?>
						<p>您的收藏夹为空~</p>
					<?php }else{ ?>
						<?php for($i=0;$i<count($rows);$i++){ ?>
						<a class="my_cart_row_a" href="product.php?productId=<?php echo $rows[$i]['id'] ?>">
							<div class="my_cart_row">
								<div class="my_cart my_cart_photo"><img src="<?php echo $rows[$i]['photo'] ?>" width="50px" height="50px"></div>
								<div class="my_cart my_cart_name"><span><?php echo $rows[$i]['productname'] ?></span></div>
							</div>
						</a>
						<?php } ?>
						<div class="clear"></div>
					<?php } ?>

					<?php if($proNum[0]>$onePageNum){ ?>
					<div class="paging">
						<?php if($nowPage!=1){ ?>
						<a href="?page=<?php echo $nowPage-1 ?><?php echo isset($_GET['page_cart'])?'&page_cart='.$_GET['page_cart']:'' ?>">
							<div class="page"><i class="fa fa-chevron-left"></i></div>
						</a>
						<?php } ?>
						<div class="pagenum">第<span><?php echo $nowPage ?></span>/<?php echo $pageNum ?>页</div>

						<?php if($nowPage!=$pageNum){ ?>
						<a href="?page=<?php echo $nowPage+1 ?><?php echo isset($_GET['page_cart'])?'&page_cart='.$_GET['page_cart']:'' ?>">
							<div class="page"><i class="fa fa-chevron-right"></i></div>
						</a>
						<?php } ?>

						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<?php } ?>

					</div>
				</div>
			</div>
			<!-- 购物车收藏夹情况展示区结束 -->
			<div class="clear"></div>

			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
	</body>
</html>
