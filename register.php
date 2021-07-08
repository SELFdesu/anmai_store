<?php
session_start();
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>安买商城_注册</title>
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/register.css" />
	</head>

	<body>
		<div id="banerBackg"></div>
		<div id="all">
			<?php include_once './common/header.php' ?>
			
			<form action="./dispose/register_dispose.php" enctype="multipart/form-data" method="post">
			
				<div class="input_div">

					<div class="content_div content0">
						<div class='left_div'>用户头像:</div><input type="file" name="photo" required="required" />
					</div>
			
					<div class="content_div content1">
						<div class='left_div'>用户名:</div><input type="text" name="username" required="required" />
					</div>
			
					<div class="content_div content2">
						<div class='left_div'>密码:</div><input type="password" name="passwd" required="required" />
					</div>
			
					<div class="content_div  content3">
						<div class='left_div'>手机号:</div><input type="text" name="tel" required="required" />
					</div>
			
					<div class="content_div  content4">
						<div class='left_div'>性别:</div>
						<div class="radio_text">男</div><input type="radio" name="sex" value="男" />
						<div class="radio_text">女</div><input type="radio" name="sex" value="女" />
					</div>
			
					<div class="content_div  content5">
						<div class='left_div'>出生日期:</div><input type="date" name="birthday" />
					</div>
			
					<input type="submit" name="register"  value="注册" />

					<?php if(isset($_GET['error'])){ ?>
						<P style="font-size: 16px;font-weight:400;text-align:center;color:red;">用户名已存在，注册失败，请重试！</P>
					<?php } ?>

				</div>
				
			</form>
		</div>

	</body>

</html>
