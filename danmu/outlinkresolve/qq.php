<?php
header('Content-type:text/xml;charset=utf-8');
$url=$_GET['url'];
if(strpos($url,'qq.com')){
ipcqq($url);
}
function ipcqq($url){
$con=curl($url);
preg_match('|vid:"(.*)"|U', $con, $vid);
$json_data=curl('http://v.video.qq.com/geturl?vid='.$vid[1].'&otype=json');
preg_match_all('|"url":"(.+)"|U',$json_data,$v);
$xmls = '<ckplayer><flashvars>{h->4}</flashvars>';
$xmls .= "<video><file><![CDATA[".$v[1][1]."]]></file></video>";
$xmls .= '</ckplayer>';
echo $xmls;
}
function curl($url){
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
$src = curl_exec($curl);
curl_close($curl);
return $src;
}
?>