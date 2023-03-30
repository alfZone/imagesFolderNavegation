<?php

/**
 * The objective of the repository is to provide HTML, PHP, and JavaScript code to manage a folder where images are stored..
 * @author António Lira Fernandes
 * @version 1.1
 * @updated 301-03-2023 21:50:00
 https://github.com/alfZone/imagesFolderNavegation
 */

if (!empty($_FILES)) {
    //$path=$_REQUEST['pathinfo'];
    $tempFile = $_FILES['file']['tmp_name'];
    //$targetPath = "./";
    $targetPath = $_REQUEST['pathinfo'] . "/";
  //echo "ola";
    $targetFile =  $targetPath. $_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile);
}
?>
