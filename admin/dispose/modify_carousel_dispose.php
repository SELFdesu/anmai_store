<?php
$filePath = "../../img";
$photoname = $_POST['photoname'];
if ($_FILES["photo"]["type"] != "image/png") {
    header('Location:../manage-carousel.php?formaterror=true');
} else {
    if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $filePath . '/' . $photoname)) {
            header('Location:../manage-carousel.php?error=true');
        }
    }
    header('Location:../manage-carousel.php?succeed=true');
}
?>