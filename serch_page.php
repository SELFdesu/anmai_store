<?php
if(isset($_POST['serch_btn'])||isset($_GET['serch'])){
	if(isset($_POST['serch_btn'])){
		$serch_content=$_POST['serch_content'];
	}else{
		$serch_content=$_GET['serch'];
	}
   
    include_once './common/database.php';


	$sql="select count(id) from product_show where active=1 and productname like '%{$serch_content}%'";
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


    $sql="select * from product_show where active=1 and productname like '%{$serch_content}%' limit {$star_num},{$onePageNum} ";
    $result=mysqli_query($link,$sql);
    $serch_rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
}else{
	header('Location:index.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>搜索结果</title>
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/allPar.css"/>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
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
					<input class="txt" type="text" name="serch_content" />
					<input class="sub" type="submit" formaction="./serch_page.php" name="serch_btn" value="搜索" />
				</form>
			</div>
			<!-- 搜索框结束 -->





			<!-- 大分区块 -->
			<div id="allPar">
				<!-- 推荐专区 -->
				<div id="par3">
					<div class="parTitle"><i class="fa fa-search"></i><span>搜索结果</span></div>
					<div class="parRecContent">

                    <?php if(!!mysqli_num_rows($result)){ ?>
                        <?php foreach($serch_rows as $value){?>
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
                    <?php }else{ ?>
                        <div style="margin: 0 auto; width:500px;height:200px;line-height:200px;font-size:30px;text-align:center;">
                            <p>抱歉，没有搜索到您想要的商品。</p>
                        </div>
                    <?php } ?>
						
						<div class="clear"></div>
					</div>

					<?php if($proNum[0]>$onePageNum){ ?>
					<div class="paging">
						<?php if($nowPage!=1){ ?>
						<a href="?serch=<?php echo isset($_GET['serch'])?$_GET['serch']:$_POST['serch_content'] ?>&page=<?php echo $nowPage-1 ?>">
							<div class="page"><i class="fa fa-chevron-left"></i></div>
						</a>
						<?php } ?>
						<div class="pagenum">第<span><?php echo $nowPage ?></span>/<?php echo $pageNum ?>页</div>

						<?php if($nowPage!=$pageNum){ ?>
						<a href="?serch=<?php echo isset($_GET['serch'])?$_GET['serch']:$_POST['serch_content'] ?>&page=<?php echo $nowPage+1 ?>">
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
			<div class="clear"></div>
			
			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
	</body>
</html>
