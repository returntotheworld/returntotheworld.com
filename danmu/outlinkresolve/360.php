<?php
//code by iippcc
ERROR_REPORTING(0);
$uri = $_SERVER["REQUEST_URI"];
preg_match("/360.php\/(.+)\//",$uri,$id);
$str=file_get_contents("http://jae.airdge.com/video/yunpan.php?id=http://yunpan.cn/".$id[1]);      
preg_match('|"downloadurl":"(.*)"|U', $str, $matches);
$matches = str_replace('\/',"/",$matches);
header('Content-Type:application/force-download');
header("Location:".$matches[1]);
?>