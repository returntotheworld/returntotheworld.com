<?php
namespace Home\Controller;
use Think\Controller;
/**
* 前端邻居页
* @author: Administrator
* @return:
*/
class FriendsController extends CommonController {
	
    public function index(){ 
		$this->assign('friends','active'); 
        $this->QQ = M('qq')->order('q_time desc')->select();
		if(!$links=S('links')){
        	$links = M('link')->where(array('l_view'=>2))->order('l_sort desc')->field(true)->select();
			setS("links",$links);
		}
		if(!$flinks=S('flinks')){
        	$flinks = M('link')->where(array('l_view'=>1))->order('l_sort desc')->field(true)->select();
        	setS("links",$links);
		}
		$this->links=$links;
		$this->flinks=$flinks;
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
			$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		} else {
			layout(true); //开启模板
			$this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		}
    }
    public function index1(){ 
		$this->assign('friends','active'); 
        $this->mingzhan= M('link')->where(array('c_id'=>1))->order('hit desc')->field(true)->select();
		if(!$links=S('links')){
        	$links = M('link')->where(array('c_id'=>2))->order('hit desc')->field(true)->select();
			setS("links",$links);
		}
		if(!$flinks=S('flinks')){
        	$flinks = M('link')->order('hit desc')->field(true)->select();
        	setS("flinks",$flinks);
		}
		if(!$flinks5=S('flinks5')){
        	$flinks5 = M('link')->where(array('c_id'=>5))->order('hit desc')->field(true)->select();
        	setS("flinks5",$flinks5);
		}
		if(!$flinks6=S('flinks6')){
        	$flinks6 = M('link')->where(array('c_id'=>6))->order('hit desc')->field(true)->select();
        	setS("flinks6",$flinks6);
		}
		if(!$flinks7=S('flinks7')){
        	$flinks7 = M('link')->where(array('c_id'=>7))->order('hit desc')->field(true)->select();
        	setS("flinks7",$flinks7);
		}
		if(!$flinks4=S('flinks4')){
        	$flinks4 = M('link')->where(array('c_id'=>4))->order('hit desc')->field(true)->select();
        	setS("flinks4",$flinks4);
		}
		$this->links=$links;
		$this->flinks=$flinks;
		$this->flinks5=$flinks5;
		$this->flinks6=$flinks6;
		$this->flinks7=$flinks7;
		$this->flinks4=$flinks4;
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
			$this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
		} else {
			layout(true); //开启模板
			$this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
		}
    }	
    public function linkhit($url=0){

    	$tmp = M('link');
    	$tmp->where(array("l_url"=>$url))->setInc('hit');
    	// $mingzhan= M('link')->where(array("l_id"=>$id))->select();
    	// $url=$mingzhan[0]['l_url'];
    	header("location:".$url);
    }	
    public function addLink(){
		if(!IS_AJAX){
			$this->error('提交方式不正确',0,0);
		}else{
			if(D('Admin/Link')->addH()){
				$content = "
				<div style='background-color:#d0d0d0;text-align:center;padding:40px;'>
				<div class='mmsgLetter' style='width:580px;margin:0 auto;padding:10px;color:#333;background-color:#fff;border:0px solid #aaa;border-radius:5px;-webkit-box-shadow:3px 3px 10px #999;-moz-box-shadow:3px 3px 10px #999;box-shadow:3px 3px 10px #999;font-family:Verdana, sans-serif; '>
				<div class='mmsgLetterHeader' style='height:23px;background:url(".C('SITE_URL')."/Public/Img/email/topline.png) repeat-x 0 0;'></div>
				<div class='mmsgLetterContent' style='text-align:left;padding:30px;font-size:14px;line-height:1.5;background:url(".C('SITE_URL')."/Public/Img/email/mark.png) no-repeat top right;'>
				<div>
				<p>亲爱的管理员，你好!</p>
				<p>您".C('NAME')."有人申请友情链接：</p>
				<p> 网站 [ <a> ".I('post.l_name')." </a> ] <small> ( ".I('post.l_email')." ) </smaill>给您留言到：</p>
				<p style='word-wrap:break-word;word-break:break-all;margin-left:25px;border:1px solid #cccccc;padding:20px;display:block;'>".reFace(I('post.l_content'))."</p>
				<p>此邮件为系统自动发出，请勿直接回复</p>
				</div>
				<div class='mmsgLetterHeader' style='height:23px;background:url(".C('SITE_URL')."/Public/Img/email/topline.png) repeat-x 0 0;'></div>
				</div></div></div>";				
				sendEmail(C('MAIL_USERNAME'),'您的'.C("NAME").'上的博客有了新的友情链接申请',$content);
				$data = array("error"=>0,"msg"=>"评论完成!");
			}
			else{
				$data = array("error"=>1,"msg"=>"评论时发生错误!");			
			}
		}		
		$this->ajaxReturn($data);	
    }

}
?>