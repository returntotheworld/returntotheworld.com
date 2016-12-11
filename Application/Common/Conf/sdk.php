<?php
/**
* 等三方登陆插件配置
* @date: 2015年10月17日
* @author: Administrator
* @return:
*/
$SITE_URL = "http://returntotheworld.com/";
define('URL_CALLBACK', "" . $SITE_URL . "Home/Common/callback?type=");
return array(    
    #腾讯QQ登录配置
    'THINK_SDK_QQ' => array(
        'APP_KEY' => '1105785285', # APP ID
        'APP_SECRET' => 'EM2HU5WRH057kkpk', # KEY
        'CALLBACK' => URL_CALLBACK . 'qq',
    ),
    
);