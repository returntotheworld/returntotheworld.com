<?php
namespace Home\Controller;
use Think\Controller;
/**
* 前端说说管理
* @date: 2015年10月31日
* @author: Administrator
* @return:
*/
class FeedController extends CommonController {
	
    public function index(){
        $name = '回这世界';
        $url = 'http://returntotheworld.com';
        $desc = '回这世界的是你的模样';
        $RSS = new \Org\Util\Rss($name, $url, $desc, ''); //依次为：网站名称，URL，描述，缩略图片
        $db = M('article');
        $result = $db->where('a_view > 0')->order('a_id desc')->limit(20)->select();
        // pre($result);die;
        foreach($result as $list){
            $RSS->AddItem($list['a_title'],$url.U('/article-'.$list['a_id']),'<img src="'.$url.$list['a_img'].'">'.$list['a_remark'].'[by'.getTime($list['a_time']).']',date('Y-m-d H:i:s', $list['a_time']),''.getTime($list['a_time']),$url.$list['a_img'],$list['a_keyword']); //查询的东西格式化，参考类文件
        }
        $RSS->display(); //输出


		// $this->assign('feel','active');  
		// $tmp =  M('say');    
  //       $count = $tmp->where('s_view = 1')->count();
  //       $Page  = new \Think\PageHome($count,8);
  //       $Page->url = 'feel/page';
  //       $show  = $Page->show();
  //       $say = $tmp->where('s_view = 1')->order('s_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
  //       $this->assign('say',$say);
  //       $this->assign('page',$show);
  //       if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
		// 	$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		// } else {
		// 	layout(true); //开启模板
		// 	$this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		// }
    }
}