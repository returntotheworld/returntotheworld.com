<?php
/**
* 前端首页管理
* @date: 2015年10月31日
* @author: Administrator
* @return:
*/
namespace Home\Controller;
use Think\Controller;
class AboutController extends CommonController {
    public function index(){    
		$this->assign('about','active');
        // $data['about'] = 'active';
		if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
			$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		} else {
			layout(true); //开启模板
			$this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		}
    }
}
?>