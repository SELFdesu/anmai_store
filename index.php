<?php 
session_start();
include_once './common/database.php';

//轮播图链接获取
$sql="select addr from index_carousel";
$result=mysqli_query($link,$sql);
$carousel=mysqli_fetch_all($result);

//par1展示内容
$sql='select * from product_show where active=1 order by id desc limit 4';
$result=mysqli_query($link,$sql);
$par1=mysqli_fetch_all($result,MYSQLI_ASSOC);

//par2展示内容
$sql='select * from product_show where active=1 order by id desc limit 4,10';
$result=mysqli_query($link,$sql);
$par2=mysqli_fetch_all($result,MYSQLI_ASSOC);

//分页start
$sql='select count(id) from product_show where active=1';
$result=mysqli_query($link,$sql);
$proNum=mysqli_fetch_row($result);

$onePageNum=20;
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
//分页end

//获取当前页数据
$sql="select * from product_show where active=1 order by id desc limit {$star_num},{$onePageNum};";
$result=mysqli_query($link,$sql);
$par3=mysqli_fetch_all($result,MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>安买商城</title>
		<script src="js/index_carousel.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/allPar.css"/>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/index_carousel.css" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	</head>
	<body>
		<div id="banerBackg"></div>

		<div id="all">

			<?php include_once './common/header.php' ?>

			<!-- banner -->
			<div id="banner"></div>
			<!-- banner结束 -->

			<!-- 搜索框开始 -->
			<div id="search">
				<div id="searchImg"></div>
				<form id="searchForm" action="" method="post">
					<input class="txt" type="text" name="serch_content"  required="required" />
					<input class="sub" type="submit" formaction="./serch_page.php" name="serch_btn" value="搜索" />
				</form>
			</div>
			<!-- 搜索框结束 -->
			

			<!-- 展示区 -->
			<section class="section_show">
				<div id="seLeft">
					<ul class="leftNav">
						<a href="classify.php?classify=0"><li class="Lli Llifirst" id="lNli1">数&nbsp;码&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=1"><li class="Lli" id="lNli2">办&nbsp;公&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=2"><li class="Lli" id="lNli3">服&nbsp;饰&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=3"><li class="Lli" id="lNli4">模&nbsp;玩&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=4"><li class="Lli" id="lNli5">食&nbsp;品&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=5"><li class="Lli" id="lNli6">箱&nbsp;包&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=6"><li class="Lli" id="lNli7">厨&nbsp;具&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=7"><li class="Lli" id="lNli8">茶&nbsp;酒&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=8"><li class="Lli" id="lNli9">家&nbsp;具&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
						<a href="classify.php?classify=9"><li class="Lli" id="lNli10">其&nbsp;他&nbsp;&nbsp;&nbsp;&nbsp;></li></a>
					</ul>
				</div>

				<div id="seRight">
					<!-- 右侧轮播区 -->
					<div id="carousel">
						<!-- 左侧大轮播 -->
						<div class="carLeft">
							<div class="leftShift">
								<i class="fa fa-angle-left"></i>
							</div>
							<div class="rightShift">
								<i class="fa fa-angle-right"></i>
							</div>
							<div id="carLInner">
								<a href="<?php echo $carousel[0][0] ?>" onclick="return false"><img src="./img/car0.png" alt=""></a>
								<a href="<?php echo $carousel[1][0] ?>" onclick="return false"><img src="img/car1.png" alt=""></a>
								<a href="<?php echo $carousel[2][0] ?>" onclick="return false"><img src="img/car2.png" alt=""></a>
								<a href="<?php echo $carousel[3][0] ?>" onclick="return false"><img src="img/car3.png" alt=""></a>
								<a href="<?php echo $carousel[4][0] ?>" onclick="return false"><img src="img/car4.png" alt=""></a>
							</div>
							<div id="allButton">
								<div class="button"></div>
								<div class="button"></div>
								<div class="button"></div>
								<div class="button"></div>
								<div class="button"></div>
							</div>

						</div>
						<!-- 右侧小轮播 -->
						<div class="carRight">
							<!-- 小轮播上部 -->
							<div class="crTop">
								<a href="<?php echo $carousel[5][0] ?>" onclick="return false"><img src="img/carTop.png"></a>
							</div>
							<!-- 小轮播下部 -->
							<div class="crButtom">
								<a href="<?php echo $carousel[6][0] ?>" onclick="return false"><img src="img/carBottom.png"></a>
							</div>

						</div>
					</div>
					<!-- 右侧轮播区结束 -->
				</div>

			</section>
			<!-- 展示区结束 -->


			<!-- 活动展示区 -->
			<div id="activity"><a href="<?php echo $carousel[7][0] ?>" onclick="return false"><img src="img/activity.png"></a></div>
			<!-- 活动展示区结束 -->

			<?php if(!!$proNum){ ?>
			<!-- 大分区块 -->
			<div id="allPar">

				<!-- 秒杀专区 -->
				<div id="par1">
					<div class="parTitle"><i class="fa fa-clock-o"></i><span>秒杀专区</span></div>

					<div class="par1Content">

						<div class="parLeft"><img src="img/seckill.png"></div>
						<div class="parRight">

							<?php foreach($par1 as $value){?>
							<div class="parInner">
								<a href="product.php?productId=<?php echo $value['id'] ?>">
									<img src="<?php echo $value['photo'] ?>">
									<div class="parText">
										<p class="proName"><?php echo $value['productname'] ?></p>
										<p class="message">销量&nbsp;<?php echo $value['sales'] ?>&nbsp;&nbsp;收藏&nbsp;<?php echo $value['star'] ?></p>
										<p class="price">&yen;<?php echo $value['price'] ?></p>
									</div>
								</a>
							</div>
							<?php }?>

						</div>
					</div>
					<div class="clear"></div>
				</div>
				<!-- 秒杀专区结束 -->

				<!-- 热卖专区 -->
				<div id="par2">
					<div class="parTitle"><i class="fa fa-fire"></i><span>热卖单品</span></div>
					<div class="parContent">

					<?php foreach($par2 as $value){?>
						<div class="parConInner">
							<a href="product.php?productId=<?php echo $value['id'] ?>">
								<img src="<?php echo $value['photo'] ?>" alt="">
								<div class="parciText">
									<p class="proName"><?php echo $value['productname'] ?></p>
									<p class="message">销量&nbsp;<?php echo $value['sales'] ?>&nbsp;&nbsp;收藏&nbsp;<?php echo $value['star'] ?></p>
									<p class="price">&yen;<?php echo $value['price'] ?></p>
								</div>
							</a>
						</div>
					<?php }?>

						
						<div class="clear"></div>
					</div>
				</div>
				<!-- 热卖专区结束 -->

				<!-- 推荐专区 -->
				<div id="par3">
					<div class="parTitle"><i class="fa fa-thumbs-o-up"></i><span>推荐专区</span></div>
					<div class="parRecContent">

					<?php foreach($par3 as $value){?>
						<div class="parConInner">
							<a href="product.php?productId=<?php echo $value['id'] ?>">
								<img src="<?php echo $value['photo'] ?>" alt="">
								<div class="parciText">
									<p class="proName"><?php echo $value['productname'] ?></p>
									<p class="message">销量&nbsp;<?php echo $value['sales'] ?>&nbsp;&nbsp;收藏&nbsp;<?php echo $value['star'] ?></p>
									<p class="price">&yen;<?php echo $value['price'] ?></p>
								</div>
							</a>
						</div>
					<?php }?>
						
						<div class="clear"></div>

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
				<!-- 推荐专区结束 -->
			</div>
			<!-- 大分区块结束 -->
			<?php }else{ ?>
				<p style="line-height: 200px;font-size:35px;text-align:center;">抱歉，网站暂无商品收录！</p> 
			<?php } ?>
			<div class="clear"></div>
			
			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
	</body>
</html>
