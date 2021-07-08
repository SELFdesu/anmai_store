<?php
session_start();
 if(!isset($_SESSION['username'])){
	 header('Location:login.php');
 }
 include_once './common/database.php';

 $userid=$_SESSION['uid'];

 $sql="select count(favID) from user_favorite where userid={$userid}";
 $result=mysqli_query($link,$sql);

 $proNum=mysqli_fetch_row($result);
 $onePageNum=12;
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

 

 $sql="select tb1.favID,tb1.productid,tb2.photo,tb2.productname,tb2.price,tb2.id from user_favorite tb1 inner join product_show tb2 on tb1.productid=tb2.id and tb1.userid={$userid} order by tb1.favID desc limit {$star_num},{$onePageNum}";
 $result=mysqli_query($link,$sql);
 $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
 
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>收藏夹</title>
		<link rel="stylesheet" href="./css/header.css">
		<link rel="stylesheet" type="text/css" href="css/search.css"/>
		<link rel="stylesheet" type="text/css" href="css/allPar.css"/>
		<link rel="stylesheet" href="./css/favorite.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
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
			
			<section class="content">
				<!-- 收藏夹内容区开始 -->
				<div class="header">
					<div class="all_product">我的收藏</div>
				</div>
				
				<!-- 标题对应内容区开始 -->
				<div class="all_inner">
 					<?php if(!count($rows)){?>
						<p>您的收藏夹里什么都没有，快去添加收藏吧~</p>
					<?php }else{?>
						<?php for($i=0;$i<count($rows);$i++){ ?>
							<div class="inner_row_div">
								<div class="del_logo"><a href="./dispose/favoritedel.php?proid=<?php echo $rows[$i]['productid'] ?>&favid=<?php echo $rows[$i]['favID'] ?>" onclick="return confirm('是否确认删除？')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
								<a href="./product.php?productId=<?php echo $rows[$i]['id'] ?>">
									<div class="inner_row_img"><img src="<?php echo $rows[$i]['photo'] ?>" alt=""></div>
									<div class="inner_row_title"><?php echo $rows[$i]['productname'] ?></div>
									<div class="inner_row_price">&yen;<?php echo $rows[$i]['price'] ?></div>
								</a>
							</div>
						
						<?php } ?>
						<div class="clear"></div>
					<?php } ?>
					
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

				<!-- 标题对应内容区结束 -->
				
				<!-- 收藏夹内容区结束 -->


			</section>

			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
	</body>

</html>
