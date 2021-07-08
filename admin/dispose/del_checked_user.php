<?php
$user_id=implode(',',$_POST['checked']);
include_once '../../common/database.php';

$sql="delete from users where id in ({$user_id})";
mysqli_query($link,$sql);

header('Location:../manage-users.php');
?>