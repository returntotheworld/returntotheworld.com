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
    public function jiang(){    
		$this->assign('about','active');
        // $data['about'] = 'active';
		if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
			$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		} else {
			layout(true); //开启模板
			$this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		}
    }
    public function css(){    
		$this->assign('shiyanwo','active');  
        // $key = I('get.key');
        $key = "CSS";
        $tmp = M('article');
        $map['a_keyword']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        // $data['about'] = 'active';
		// if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
		// 	$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		// } else {
		// 	layout(true); //开启模板
			$this->display(""); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		// }
    }
    public function tool(){    
		$this->assign('shiyanwo','active');  
        // $key = I('get.key');
        $key = "工具";
        $tmp = M('article');
        $map['a_keyword']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        // $data['about'] = 'active';
		// if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
		// 	$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		// } else {
		// 	layout(true); //开启模板
			$this->display(""); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		// }
    }
        public function web(){    
		$this->assign('shiyanwo','active');  
        // $key = I('get.key');
        $key = "编程日记";
        $tmp = M('article');
        $map['a_keyword']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        // $data['about'] = 'active';
		// if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
		// 	$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		// } else {
		// 	layout(true); //开启模板
			$this->display(""); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		// }
    }
        public function sql(){    
		$this->assign('shiyanwo','active');  
        // $key = I('get.key');
        $key = "SQL";
        $tmp = M('article');
        $map['a_keyword']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        // $data['about'] = 'active';
		// if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
		// 	$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		// } else {
		// 	layout(true); //开启模板
			$this->display(""); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		// }
    }
}
?>