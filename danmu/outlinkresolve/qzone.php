<?php
$a = $_GET["id"];
$str=file_get_contents("http://qzone-music.qq.com/fcg-bin/cgi_playlist_xml.fcg?uin=$a");
preg_match( "/<xsong_url>(.*?)<\/xsong_url>/",$str,$durl);
preg_match("/CDATA\[(.*?)\]/",$durl[1],$url);
$url = $url[1];
header('Content-Type:application/force-download');
header("Location:".$url);
?>