<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location:login.php');
	}
	if(isset($_SESSION['cartid'])){
		$productid=$_SESSION['cartid'];
		$productname=$_SESSION['productname'];
		$productnum=$_SESSION['productnum'];
		$productprice=$_SESSION['productprice'];
		$productphoto=$_SESSION['productphoto'];
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/header.css">
		<link rel="stylesheet" type="text/css" href="css/search.css"/>
		<link rel="stylesheet" type="text/css" href="css/allPar.css"/>
		<link rel="stylesheet" type="text/css" href="css/footer.css"/>
		<link rel="stylesheet" href="./css/mycart.css">
		<link rel="stylesheet" href="./css/font-awesome.css">
		<script src="js/mycart.js" type="text/javascript" charset="utf-8"></script>
		<title>我的购物车</title>
	</head>

	<body>
		<!-- banner背景 -->
		<div id="banerBackg"></div>
		<!-- alldiv开始 -->
		<div id="all">
			<?php include_once './common/header.php' ?>
			<!-- 头部导航栏结束 -->

			<!-- 搜索框开始 -->
			<div id="search">
				<div id='leftLogo'></div>
				<form id="searchForm" action="" method="post">
					<input class="txt" type="text" name="serch_content"  required="required" />
					<input class="sub" type="submit" formaction="./serch_page.php" name="serch_btn" value="搜索" />
				</form>
			</div>
			<!-- 搜索框结束 -->

			<!-- 内容部分开始 -->
			<div id="content">
				<div class="conTitle">
					<i class="fa fa-shopping-cart"></i>
					<p>我的购物车</p>
				</div>
				<form action="" method="post">
					<!-- 商品栏和结算栏开始 -->
					<div class="conInner">
						<!-- 商品栏开始 -->
						<div class="product">
							<div class="product_title">
								<div class="proT1">
									<label>
										<input class="all_checkbox" type="checkbox">
										<span>全选</span>
									</label>
								</div>
								<div class="proT2">商品信息</div>
								<div class="proT3">单价</div>
								<div class="proT4">数量</div>
								<div class="proT5">金额</div>
								<div class="proT6">操作</div>
							</div>
							
							<div class="product_content">
								<?php if(!isset($_SESSION['cartid'])){ ?>
								<p>您的购物车里什么都没有，快去加购吧~</p>
								<?php }else{?>
									<?php for($i=0;$i<count($productid);$i++){ ?>
									<div class="content_row">
										<div class="content_row_line row_line0"> 
											<input class="son_check" type="checkbox" name="productId[]" value="<?php echo $productid[$i] ?>">
											<input type="hidden" name="productnum[]" value="<?php echo $productnum[$i] ?>">
										</div>

										<div class="content_row_line row_line1">
											<div class="row_line_photo"><img src="<?php echo $productphoto[$i];?>" width="70px" height="70px" alt=""></div>
											<div class="row_line_text"><span><?php echo $productname[$i];?></span></div>
										</div>
										<div class="content_row_line row_line2"><span><?php echo $productprice[$i];?></span>元</div>
										<div class="content_row_line row_line3"><span><?php echo $productnum[$i];?></span></div>
										<div class="content_row_line row_line4"><span class="product_price"><?php echo $productprice[$i]*$productnum[$i];?></span>元</div>
										<div class="content_row_line row_line5">
											 <a href="./dispose/delete_single_pro.php?productid=<?php echo $productid[$i] ?>" onclick="return confirm('是否确认删除？')" >删除</a> 
										</div>

									</div>
									<div class="clear"></div>
									<?php } ?>

								<?php } ?>
							</div>
						</div>
						<!-- 商品栏结束 -->

						<!-- 结算栏开始 -->
						<div class="toolbar">
							<!-- 全选 -->
							<div class="check_all">
								<label>
									<input class="all_checkbox" type="checkbox">
									<span>全选</span>
								</label>

							</div>
							<!-- 删除 -->
							<div class="delete">
								<button type="submit" onclick="return judgecheck('del')" formaction="./dispose/delete_checked_pro.php">删除</button>
							</div>
							<!-- 已选商品数 -->
							<div class="check_pro_num">
								<p>已选商品</p><span id='check_num'>0</span>
								<p>件</p>
							</div>
							<!-- 总价 -->
							<div class="aggregate_amount">
								<p>合计：</p><span id='check_price'>0</span>
								<p>元</p>
							</div>
							<!-- 结算按钮 -->
							<div class="settle_accounts">

									<input type="submit" onclick="return judgecheck('sub')" formaction='./order.php' name="cart_sub" value="结算">

							</div>
						</div>
						<!-- 结算栏结束 -->

					</div>
					<!-- 商品栏和结算栏结束 -->
				</form>
			</div>
			<!-- 内容部分结束 -->

			<div class="clear"></div>

			<?php include_once './common/footer.php'?>

		</div>
		<!-- alldiv结束-->
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>

		<script type="text/javascript">
			var son_check=document.getElementsByClassName('son_check');
			function judgecheck(type){
				var flag=false;
				for(var i=0;i<son_check.length;i++){
					if(son_check[i].checked){
						flag=true;
						break;
					}
				}
				if(type=='del'){
					if(flag){
						return confirm('是否确认删除?');
					}else{
						return false;
					}
				}else{
					if(!flag){
						return false;
					}
				}
				
			}
		</script>
		
	</body>

</html>
