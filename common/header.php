<?php
    $nowpage=explode('/',$_SERVER['SCRIPT_NAME']);
    $nowpage=end($nowpage);
    include_once './common/database.php';
	if(isset($_SESSION['username'])){
        $name=$_SESSION['username'];
		$sql="select * from users where username='{$name}'";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_assoc($result);
        mysqli_close($link);
	}
?>
<!-- 顶部header -->
    <header id="topHeader">
        <!-- 登录图标 -->
        <div id="logo">
            <?php if (isset($_SESSION['username'])){ ?>
                <a href="my.php">
                    <img class="logo_img" src="<?php echo $row['photo'] ?>" width="32px" height="32px">
                </a>
                <a href="./dispose/logout.php"  onclick="return confirm('是否确认退出登录？')">
                    <div id="logout">登出</div>
                </a>
            <?php }else{ ?>
                <a href="login.php"><img class="logo_img" src="./img/login.png" width="32px" height="32px"></a>
            <?php } ?>
           
        </div>
        <!-- 头部导航栏 -->
        <nav class="headerNav">
            <a href="index.php" <?php echo $nowpage=='index.php'?'style="color: rgb(255, 215, 0);background-color: rgba(255, 255, 255, 0.2);"' :'' ?>>		
                主页
            </a>
            <a href="mycart.php" <?php echo $nowpage=='mycart.php'?'style="color: rgb(255, 215, 0);background-color: rgba(255, 255, 255, 0.2);"' :'' ?>>
                购物车
            </a>
            <a href="favorite.php" <?php echo $nowpage=='favorite.php'?'style="color: rgb(255, 215, 0);background-color: rgba(255, 255, 255, 0.2);"' :'' ?>>
                收藏夹
            </a>
            <a href="my.php" <?php echo $nowpage=='my.php'?'style="color: rgb(255, 215, 0);background-color: rgba(255, 255, 255, 0.2);"' :'' ?>>
                我的
            </a>
        </nav>
        <!-- 头部导航栏结束 -->
	</header>
<!-- 顶部header结束 -->