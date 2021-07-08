<?php
session_start();
include_once './common/database.php';

//轮播图连接获取
$sql="select addr from index_carousel";
$result=mysqli_query($link,$sql);
$carousel=mysqli_fetch_all($result);
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>安买商城_登录</title>
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/login.css" />
		<link rel="stylesheet" type="text/css" href="css/login_carousel.css"/>
		<script src="js/login_carousel.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<!-- banner背景 -->
		<div id="banerBackg"></div>

		<div id="all">
			<?php include_once './common/header.php' ?>
			
			<div id="leftimg">
				<div class="carLeft">
					<div class="leftShift">
						<i class="fa fa-angle-left"></i>
					</div>
					<div class="rightShift">
						<i class="fa fa-angle-right"></i>
					</div>
					<div id="carLInner">
						<a href="<?php echo $carousel[0][0] ?>"><img src="img/car0.png" alt=""></a>
						<a href="<?php echo $carousel[1][0] ?>"><img src="img/car1.png" alt=""></a>
						<a href="<?php echo $carousel[2][0] ?>"><img src="img/car2.png" alt=""></a>
						<a href="<?php echo $carousel[3][0] ?>"><img src="img/car3.png" alt=""></a>
						<a href="<?php echo $carousel[4][0] ?>"><img src="img/car4.png" alt=""></a>
					</div>
					<div id="allButton">
						<div class="button"></div>
						<div class="button"></div>
						<div class="button"></div>
						<div class="button"></div>
						<div class="button"></div>
					</div>
				
				</div>
			</div>
			
			<!-- 登录框开始 -->
			<div class="login_div">
				<p class="logo">安买商城</p>
				<form action="dispose/login_dispose.php" method="post">
					<input type="text" name="username" id="user" value="" placeholder="用户名" required="required" /><br>
					<input type="password" name="passwd" id="passwd" value="" placeholder="密码" required="required" /><br>
					<input type="submit" name="login" id="sub" value="登录" />
					<div id="bottomText">
						<div class="text01"><a class="text_left" href="register.php">注册账号</a></div>
						<div class="text02"><a class="text_right" href="retrievepasswd.php">找回密码</a></div>
						<?php if(isset($_GET['error'])){ ?>
							<p class="text03"><?php echo"账号或密码错误！" ?></p>
						<?php }elseif(isset($_GET['succeed'])){ ?>
							<p class="text03" style="color: green;"><?php echo"注册成功！" ?></p>
						<?php }elseif(isset($_GET['resucceed'])){ ?>
							<p class="text03" style="color: green;"><?php echo"密码修改成功！" ?></p>
						<?php }elseif(isset($_GET['active'])){ ?>
							<p class="text03"><?php echo"您的账号已被冻结！" ?></p>
						<?php } ?>
					</div>
				</form>
			</div>
			<!-- 登录框结束 -->
		</div>
	</body>

</html>
