<?php
namespace Home\Controller;
use Think\Controller;
/**
* 文章类管理
* @date: 2015年10月31日
* @author: Administrator
* @return:
*/
class VideoController extends CommonController {
    
    public function _before_index(){
        $id = I('get.id');
    }
    
    public function index(){
	  	$this->assign('video','active');
	    $id =I('get.id');
    	$tmp = M('video');
    	$count = $tmp->where(array('pid'=>$id))->count();
        $Page  = new \Think\PageHome($count,5);
        $show  = $Page->show();
        $article = $tmp->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('article',$article);
		$this->assign('page',$show);
        $this->display();
    }
    public function index1($id=0){
    	$article = M('video')->where(array("id"=>$id))->select();
        $article[0]['idd']="<iframe src='/danmu/miniplayer/player.php?id=".$article[0]['id']."' style='height:502px;width:740px;' allowfullscreen frameborder='no'></iframe>";
		$this->assign('info',$article[0]);
    	$this->display();
    }
    public function search($key=''){  
	    $this->assign('video','active');  
        $key = I('get.key');
		$tmp = M('article');
        $map['a_title']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count,5);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        $this->display();
    }
    public function tag($key=''){  
        $this->assign('class','active');  
        $key = I('get.key');
        $tmp = M('article');
        $map['a_keyword']=array('like',"%$key%");
        $map['a_view']=array('gt','0');
        $count = $tmp->where($map)->count();
        $Page  = new \Think\PageHome($count,5);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show  = $Page->show();
        $article = $tmp->where($map)->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('article',$article);
        $this->assign('page',$show);
        $this->display('search');
    }
}