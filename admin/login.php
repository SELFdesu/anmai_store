<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安买商城后台管理系统</title>
		<meta name="description" content="">
		<meta name="author" content="templatemo">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
			type='text/css'>
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/templatemo-style.css" rel="stylesheet">


	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
				<div class="square"></div>
				<h1>安买商城后台管理系统</h1>
			</header>
			<form action="./dispose/login_dispose.php" method="post" class="templatemo-login-form">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
						<input type="text" name="username" class="form-control" placeholder="请输入管理员账号">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
						<input type="password" name="passwd" class="form-control" placeholder="请输入管理员密码">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="sub_btn" class="templatemo-blue-button width-100">登录</button>
				</div>
				<?php if(isset($_GET['error'])){ ?>
				<div><p style="text-align: center;color:red;">用户名或密码错误！</p></div>
				<?php } ?>
			</form>
		</div>
	</body>
</html>
