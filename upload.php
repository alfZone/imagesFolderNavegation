<?php
  
if (!empty($_FILES)) {
    //$path=$_REQUEST['pathinfo'];
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = "./";
    $targetPath = $_REQUEST['pathinfo'];
  //echo "ola";
    $targetFile =  $targetPath. $_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile);
}
?>
