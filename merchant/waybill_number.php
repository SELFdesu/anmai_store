<!DOCTYPE html>
<html>

<head>
    <title>运单号</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .top-link .revise_password{
            color: #f35844;
        }
        .top-link .revise_password:hover{
            color: #f35844;
        }
    </style>
</head>

<body>
    <div id="main">
        <?php
        include "./conn/top.php";
        include "./conn/menu.php";
        ?>

        <div class="main">
            <div class="wrap">
                <div class="page-title">
                    <span class="modular fl"><i class="user"></i><em>运单号</em></span>
                </div>
                <form action="./db/order_shipments_db.php" method="post">
                    <table class="noborder">
                        <?php 
                            if(isset($_POST['checkbox'])){
                                for($i=0; $i<count($_POST['checkbox']); $i++){
                        ?>
                        <tr>
                            <td width="15%" style="text-align:right;">运单号：</td>
                            <td><input type="text" name="waybill[]" class="textBox length-middle" placeholder="订单编号为<?php echo $_POST['checkbox'][$i]; ?>" required autocomplete="off" /></td>
                        </tr>
                        <?php        
                                }
                            }
                        ?>
                        <tr>
                            <td style="text-align:right;"></td>
                            <input type="hidden" name="orderid" value="<?php echo implode(',',$_POST['checkbox']);  ?>">
                            <td><input type="submit" name="submit" class="tdBtn" value="提交" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>