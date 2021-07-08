<?php
session_start();
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>安买商城_找回密码</title>
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/register.css" />
	</head>

	<body>
		<div id="banerBackg"></div>
		<div id="all">
			<?php include_once './common/header.php' ?>
			
			<form action="./dispose/retrievepasswd_dispose.php" enctype="multipart/form-data" method="post">
				<div class="input_div">
			
					<div class="content_div content1">
						<div class='left_div'>用户名:</div><input type="text" name="username" required="required" />
					</div>

                    <div class="content_div content2">
						<div class='left_div'>原密码:</div><input type="password" name="oldpasswd" required="required" />
					</div>
			
					<div class="content_div content2">
						<div class='left_div'>新密码:</div><input type="password" name="passwd" required="required" />
					</div>
			
					<div class="content_div  content3">
						<div class='left_div'>手机号:</div><input type="text" name="tel" required="required" />
					</div>
			
					<div class="content_div  content5">
						<div class='left_div'>出生日期:</div><input type="date" name="birthday"  required="required"/>
					</div>
			
					<input type="submit" name="register"  value="重置密码" />
                    <?php if(isset($_GET['error'])){ ?>
                    <p style="text-align: center;margin-top:1em;color:red;">输入信息错误！</p>
                    <?php } ?>
				</div>
			</form>
		</div>

	</body>

</html>
