<?php
/*
This page has a file inclusion vulnerability, used to test if a web shell can run properly!
*/
header("Content-Type:text/html;charset=utf-8");
$file = $_GET['file'];
if(isset($file)){
    include $file;
}else{
    show_source(__file__);
}
?>
