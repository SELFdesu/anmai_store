<?php
session_start();
 if(!isset($_SESSION['username'])){
	 header('Location:login.php');
 }
 $orderid=$_POST['orderid'];
 $userid=$_POST['userid'];
 $productid=$_POST['productid'];
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>评价商品</title>
		<link rel="stylesheet" href="./css/header.css">
		<link rel="stylesheet" type="text/css" href="css/search.css"/>
		<link rel="stylesheet" type="text/css" href="css/allPar.css"/>
		<link rel="stylesheet" href="./css/favorite.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" />
		<style>
			textarea{
				width: 1160px;
				margin-top: 50px;
				font-size: 20px;
				padding: 20px;
			}
			button{
				float: right;
				width: 200px;
				height: 50px;
				margin-top: 10px;
				margin-bottom: 10px;
				background-color: black;
				color: white;
				font-size: 20px;
				font-weight: bold;
				border: none;
				cursor: pointer;
			}
		</style>
	</head>

	<body>
		<div id="banerBackg"></div>
		<div id="all">

			<?php include_once './common/header.php' ?>


            <div>
                <form method="post">
                    <textarea name="content" cols="30" rows="5"></textarea>
					<input type="hidden" name="userid" value="<?php echo $userid ?>">
					<input type="hidden" name="productid" value="<?php echo $productid ?>">
					<input type="hidden" name="orderid" value="<?php echo $orderid ?>">
                    <button type="submit" formaction="./dispose/evaluatesub_dispose.php">提交</button>
                </form>

            </div>
			<div class="clear"></div>

			

			<?php include_once './common/footer.php'?>
		</div>
		<div id="fo_top_bac"></div>
		<div id="fo_bot_bac"></div>
	</body>

</html>
