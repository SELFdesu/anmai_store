<?php
session_start();
if (!isset($_SESSION['admin'])) {
	header('Location:./login.php');
}
$filePath = "../img";
$fileArr = array();
$filename = array('car0.png','car1.png','car2.png','car3.png','car4.png','carTop.png','carBottom.png','activity.png');
$flag = false;
if ($fileObj = opendir($filePath)) {
	while (false !== ($fileContext = readdir($fileObj))) {
		if ($fileContext != "." && $fileContext != "..") {
			for ($i = 0; $i < count($filename); $i++) {
				if ($fileContext == $filename[$i]) {
					$flag = true;
				}
			}
			if ($flag) {
				array_push($fileArr, $fileContext);
				$flag = false;
			}
		}
	}
	closedir($fileObj);
}

include_once '../common/database.php';
$sql="select id,addr from index_carousel";
$result=mysqli_query($link,$sql);
$carousel=mysqli_fetch_all($result);
$car_link_arr=array();
$car_id_arr=array();
for($i=0;$i<count($fileArr);$i++){
	switch($fileArr[$i]){
		case 'car0.png' :array_push($car_id_arr,$carousel[0][0]);array_push($car_link_arr,$carousel[0][1]);break;
		case 'car1.png' :array_push($car_id_arr,$carousel[1][0]);array_push($car_link_arr,$carousel[1][1]);break;
		case 'car2.png' :array_push($car_id_arr,$carousel[2][0]);array_push($car_link_arr,$carousel[2][1]);break;
		case 'car3.png' :array_push($car_id_arr,$carousel[3][0]);array_push($car_link_arr,$carousel[3][1]);break;
		case 'car4.png' :array_push($car_id_arr,$carousel[4][0]);array_push($car_link_arr,$carousel[4][1]);break;
		case 'carTop.png' :array_push($car_id_arr,$carousel[5][0]);array_push($car_link_arr,$carousel[5][1]);break;
		case 'carBottom.png' :array_push($car_id_arr,$carousel[6][0]);array_push($car_link_arr,$carousel[6][1]);break;
		case 'activity.png' :array_push($car_id_arr,$carousel[7][0]);array_push($car_link_arr,$carousel[7][1]);break;
	}
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>页面轮播图管理</title>
	<meta name="description" content="">
	<meta name="author" content="templatemo">

	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/templatemo-style.css" rel="stylesheet">



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
					<li><a href="index.php"><i class="fa fa-home fa-fw"></i>主页</a></li>
					<li><a href="manage-comment.php"><i class="fa fa-bar-chart fa-fw"></i>评论管理</a></li>
					<li><a href="manage-product.php"><i class="fa fa-database fa-fw"></i>商品管理</a></li>
					<li><a href="manage-order.php"><i class="fa fa-map-marker fa-fw"></i>订单管理</a></li>
					<li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>用户管理</a></li>
					<li><a href="manage-merchant.php"><i class="fa fa-user fa-fw"></i>商家管理</a></li>
					<li><a href="#" class="active"><i class="fa fa-sliders fa-fw"></i>网站轮播图管理</a></li>
					<li><a href="./dispose/logout.php"><i class="fa fa-eject fa-fw"></i>退出登录</a></li>
				</ul>
			</nav>
		</div>
		<!-- Main content -->
		<div class="templatemo-content col-1 light-gray-bg">

			<div class="templatemo-content-container">
				<div style="font-size: 20px;font-weight:bold;margin-left:10px">请上传PNG格式的图片（轮播图建议图片大小710×450,右侧展示图推荐大小290×220,banner图推荐大小1200×200）</div>
				<?php if(isset($_GET['error'])){?>
				<div style="color:red; font-size: 18px;font-weight:bold;margin-left:10px">上传失败！</div>
				<?php }elseif(isset($_GET['succeed'])){?>
				<div style="color:green; font-size: 18px;font-weight:bold;margin-left:10px">上传成功！</div>
				<?php }elseif(isset($_GET['formaterror'])){ ?>
				<div style="color:red; font-size: 18px;font-weight:bold;margin-left:10px">上传图片格式错误请上传png格式图片！</div>
				<?php } ?>
				<div class="templatemo-content-widget no-padding">
					<div class="panel panel-default table-responsive">
						<table class="table table-striped table-bordered templatemo-user-table">
							<thead>
								<tr>
									<td><a href="" class="white-text templatemo-sort-by">位置 <span class="caret"></span></a></td>
									<td><a href="" class="white-text templatemo-sort-by">轮播图预览 <span class="caret"></span></a></td>
									<td><a href="" class="white-text templatemo-sort-by">更改图片 <span class="caret"></span></a></td>
									<td><a href="" class="white-text templatemo-sort-by">更改链接地址 <span class="caret"></span></a></td>

								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i < count($fileArr); $i++) { ?>
									<tr>
										<td>
										<?php
										 	switch($fileArr[$i]){
												case 'car0.png' : echo'轮播图1';break;
												case 'car1.png' : echo'轮播图2';break;
												case 'car2.png' : echo'轮播图3';break;
												case 'car3.png' : echo'轮播图4';break;
												case 'car4.png' : echo'轮播图5';break;
												case 'carTop.png' : echo'右上展示图';break;
												case 'carBottom.png' : echo'右下展示图';break;
												case 'activity.png' : echo'活动Banner图';break;
											 }
										?>
										</td>
										<td><img width="150px" src="../img/<?php echo $fileArr[$i] ?>" alt=""></td>
										<td>
											<form method="post"  enctype="multipart/form-data">
												<input type="file" name="photo">
												<input type="hidden" name="photoname" value="<?php echo $fileArr[$i] ?>">
												<button style="margin-top:1em;" class="templatemo-edit-btn" formaction="./dispose/modify_carousel_dispose.php">修改</button>
											</form>
											
										</td>
										
										<td>
											<form method="post">
												<input type="text" name="addr" placeholder="<?php echo $car_link_arr[$i] ?>">
												<input type="hidden" name="car_id" value="<?php echo $car_id_arr[$i] ?>">
												<button style="margin-top:1em;" class="templatemo-edit-btn" formaction="./dispose/modify_carlink_dispose.php">修改</button>
											</form>
											
										</td>
									</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>



</body>

</html>