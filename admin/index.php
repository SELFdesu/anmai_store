<?php 
	session_start();
	if(!isset($_SESSION['admin'])){
		header('Location:./login.php');
	}

	include_once '../common/database.php';
	$sql="select count(id) from users";
	$result=mysqli_query($link,$sql);
	$rows_user=mysqli_fetch_row($result)[0];

	$sql="select count(id) from merchant_users";
	$result=mysqli_query($link,$sql);
	$rows_merchant=mysqli_fetch_row($result)[0];

	$sql="select count(orderid) from product_order";
	$result=mysqli_query($link,$sql);
	$rows_order=mysqli_fetch_row($result)[0];

	$sql="select count(id) from product_show";
	$result=mysqli_query($link,$sql);
	$rows_show=mysqli_fetch_row($result)[0];

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>管理界面主页</title>
		<meta name="description" content="">
		<meta name="author" content="templatemo">


		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/templatemo-style.css" rel="stylesheet">
		<style type="text/css">
			.num_div{
				margin-top: 50px;
			}
			.num_div p{
				font-size: 4em;
				font-weight: bold;
			}
		</style>



	</head>
	<body>
		<!-- Left column -->
		<div class="templatemo-flex-row">
			<div class="templatemo-sidebar">
				<header class="templatemo-site-header">
					<div class="square"></div>
					<h1 style="font-size: 21px;">安买商城后台管理系统</h1>
				</header>

				<!-- Search box -->

				<div class="mobile-menu-icon">
					<i class="fa fa-bars"></i>
				</div>
				<nav class="templatemo-left-nav">
					<ul>
						<li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>主页</a></li>
						<li><a href="manage-comment.php"><i class="fa fa-bar-chart fa-fw"></i>评论管理</a></li>
						<li><a href="manage-product.php"><i class="fa fa-database fa-fw"></i>商品管理</a></li>
						<li><a href="manage-order.php"><i class="fa fa-map-marker fa-fw"></i>订单管理</a></li>
						<li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>用户管理</a></li>
						<li><a href="manage-merchant.php"><i class="fa fa-user fa-fw"></i>商家管理</a></li>
						<li><a href="manage-carousel.php"><i class="fa fa-sliders fa-fw"></i>网站轮播图管理</a></li>
						<li><a href="./dispose/logout.php"><i class="fa fa-eject fa-fw"></i>退出登录</a></li>
					</ul>
				</nav>
			</div>
			<!-- Main content -->
			<div class="templatemo-content col-1 light-gray-bg">
				<div class="templatemo-flex-row flex-content-row">
					<div class="col-1">
						<div class="templatemo-content-widget orange-bg">
							<i class="fa fa-times"></i>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
									</a>
								</div>
								<div class="media-body">
									<h2 class="media-heading">欢迎您，管理员:<?php echo $_SESSION['admin'] ?>。</h2>
									<p>祝您拥有美好的一天！</p>
								</div>
							</div>
						</div>

					</div>

				</div> <!-- Second row ends -->

				<div class="templatemo-content-container">
					<div class="templatemo-flex-row flex-content-row">
						<div class="templatemo-content-widget white-bg col-1 text-center">
							<i class="fa fa-times"></i>
							<h2 class="text-uppercase">用户人数</h2>
							<h3 class="text-uppercase margin-bottom-10"></h3>
							<div class="num_div">
								<p><?php echo $rows_user ?></p>
							</div>
						</div>
						<div class="templatemo-content-widget white-bg col-1 text-center">
							<i class="fa fa-times"></i>
							<h2 class="text-uppercase">商家数</h2>
							<h3 class="text-uppercase margin-bottom-10"></h3>
							<div class="num_div">
								<p><?php echo $rows_merchant ?></p>
							</div>
						</div>
						<div class="templatemo-content-widget white-bg col-1 text-center">
							<i class="fa fa-times"></i>
							<h2 class="text-uppercase">订单数</h2>
							<h3 class="text-uppercase margin-bottom-10"></h3>
							<div class="num_div">
								<p><?php echo $rows_order ?></p>
							</div>
						</div>
						<div class="templatemo-content-widget white-bg col-1 text-center">
							<i class="fa fa-times"></i>
							<h2 class="text-uppercase">商品总数</h2>
							<h3 class="text-uppercase margin-bottom-10"></h3>
							<div class="num_div">
								<p><?php echo $rows_show ?></p>
							</div>
						</div>

					</div>


				</div>
			</div>
		</div>

		<!-- JS -->
		<script src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
		<script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
		<script>
			$(document).ready(function() {
				if ($.browser.mozilla) {

					$(window).bind('resize', function(e) {
						if (window.RT) clearTimeout(window.RT);
						window.RT = setTimeout(function() {
							this.location.reload(false); /* false to get page from cache */
						}, 200);
					});
				} else {
					$(window).resize(function() {
						drawChart();
					});
				}
			});
		</script>
		<script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->

	</body>
</html>
