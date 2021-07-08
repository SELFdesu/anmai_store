<?php
session_start();
if (!isset($_SESSION['admin'])) {
	header('Location:./login.php');
}
include_once '../common/database.php';



$sql = "select count(id) from users";

if (isset($_GET['btn'])) {
	$sql = "select count(id) from users where username='{$_GET['srch-term']}'";
}
if (isset($_GET['btn']) && $_GET['srch-term'] == '') {
	$sql = "select count(id) from users";
}

$result = mysqli_query($link, $sql);

$proNum = mysqli_fetch_row($result);
$onePageNum = 15;
if (!!$proNum[0]) {
	$pageNum = ceil($proNum[0] / $onePageNum);
	$nowPage;
	if (!isset($_GET['page'])) {
		$nowPage = 1;
	} else {
		$nowPage = $_GET['page'];
		if ($_GET['page'] < 1) {
			$_GET['page'] = 1;
			$nowPage = 1;
		} elseif ($_GET['page'] > $pageNum) {
			$_GET['page'] = $pageNum;
			$nowPage = $pageNum;
		}
	}
	$star_num = ($nowPage - 1) * $onePageNum;

	$sql = "select * from users order by id desc limit {$star_num},{$onePageNum};";
	if (isset($_GET['btn'])) {
		$sql = "select * from users where username='{$_GET['srch-term']}' order by id desc limit {$star_num},{$onePageNum};";
	}
	if (isset($_GET['btn']) && $_GET['srch-term'] == '') {
		$sql = "select * from users order by id desc limit {$star_num},{$onePageNum};";
	}
	$result = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>用户管理</title>
	<meta name="description" content="">
	<meta name="author" content="templatemo">

	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/templatemo-style.css" rel="stylesheet">
	<link href="css/paging.css" rel="stylesheet">


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
			<form class="templatemo-search-form" role="search">
				<div class="input-group">
					<button type="submit" name="btn" class="fa fa-search"></button>
					<input type="text" class="form-control" placeholder="回车搜索" name="srch-term" id="srch-term">
				</div>
			</form>
			<div class="mobile-menu-icon">
				<i class="fa fa-bars"></i>
			</div>
			<nav class="templatemo-left-nav">
				<ul>
					<li><a href="index.php"><i class="fa fa-home fa-fw"></i>主页</a></li>
					<li><a href="manage-comment.php"><i class="fa fa-bar-chart fa-fw"></i>评论管理</a></li>
					<li><a href="manage-product.php"><i class="fa fa-database fa-fw"></i>商品管理</a></li>
					<li><a href="manage-order.php"><i class="fa fa-map-marker fa-fw"></i>订单管理</a></li>
					<li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>用户管理</a></li>
					<li><a href="manage-merchant.php"><i class="fa fa-user fa-fw"></i>商家管理</a></li>
					<li><a href="manage-carousel.php"><i class="fa fa-sliders fa-fw"></i>网站轮播图管理</a></li>
					<li><a href="./dispose/logout.php"><i class="fa fa-eject fa-fw"></i>退出登录</a></li>
				</ul>
			</nav>
		</div>
		<!-- Main content -->
		<div class="templatemo-content col-1 light-gray-bg">

			<div class="templatemo-content-container">
				<form method="post">
					<input type="submit" value="删除" formaction="./dispose/del_checked_user.php" class="btn-danger" style="margin-left: 10px;">
					<div class="templatemo-content-widget no-padding">
						<div class="panel panel-default table-responsive">
							<?php if (!!$proNum[0]) { ?>
								<table class="table table-striped table-bordered templatemo-user-table">
									<thead>
										<tr>
											<td><input style="display: block;" type="checkbox" id="all_check"></td>
											<td><a href="" class="white-text templatemo-sort-by">id <span class="caret"></span></a></td>
											<td><a href="" class="white-text templatemo-sort-by">用户名 <span class="caret"></span></a></td>
											<td><a href="" class="white-text templatemo-sort-by">电话 <span class="caret"></span></a></td>
											<td><a href="" class="white-text templatemo-sort-by">性别 <span class="caret"></span></a></td>
											<td><a href="" class="white-text templatemo-sort-by">生日 <span class="caret"></span></a></td>
											<td>账号状态</td>
											<td>修改账号状态</td>
											<td>修改信息</td>
											<td>删除用户</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rows as $value) { ?>
											<tr>
												<td> <input class="check_child" style="display: block;" type="checkbox" name="checked[]" value="<?php echo $value['id'] ?>"> </td>
												<td><?php echo $value['id'] ?></td>
												<td><?php echo $value['username'] ?></td>
												<td><?php echo $value['tel'] ?></td>
												<td><?php echo $value['sex'] ?></td>
												<td><?php echo $value['birthday'] ?></td>
												<td style="color: <?php echo $value['active'] ? 'green' : 'red' ?>;"><?php echo $value['active'] ? '正常' : '冻结' ?></td>
												<td><a href="./dispose/modify_useractive_dispose.php?userid=<?php echo $value['id'] ?>&active=<?php echo $value['active'] ?>" class="templatemo-edit-btn"><?php echo $value['active'] ? '冻结' : '恢复' ?></a></td>
												<td><a href="modify_user.php?userid=<?php echo $value['id'] ?>" class="templatemo-edit-btn">修改</a></td>
												<td><a href="./dispose/del_user_dispose.php?userid=<?php echo $value['id'] ?>" onclick="return confirm('是否确认删除?')" class="templatemo-edit-btn">删除</a></td>
											</tr>
										<?php } ?>

									</tbody>
								</table>
							<?php } else { ?>
								<div style="text-align: center;line-height:100px;font-size:30px">网站中暂无注册用户！</div>
							<?php } ?>
						</div>
					</div>

					<?php if ($proNum[0] > $onePageNum) { ?>
						<div class="paging">
							<?php if ($nowPage != 1) { ?>
								<a href="?page=<?php echo $nowPage - 1 ?>">
									<div class="page"><i class="fa fa-chevron-left"></i></div>
								</a>
							<?php } ?>
							<div class="pagenum">第<span><?php echo $nowPage ?></span>/<?php echo $pageNum ?>页</div>

							<?php if ($nowPage != $pageNum) { ?>
								<a href="?page=<?php echo $nowPage + 1 ?>">
									<div class="page"><i class="fa fa-chevron-right"></i></div>
								</a>
							<?php } ?>

							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>

	<script src="./js/check_all.js"></script>
</body>

</html>