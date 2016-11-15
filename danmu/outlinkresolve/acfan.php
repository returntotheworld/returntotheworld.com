<?php
$jurl='http://api.airdge.com/json/acfun.php';
$data = array( 'url'=>$_GET['url']);
$json_data = postData($jurl, $data);
$json=json_decode($json_data,1);
print_r( $json);
function postData($url, $data)
{
$ch = curl_init();
$timeout = 300;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$handles = curl_exec($ch);
curl_close($ch);
return $handles;
}
?>