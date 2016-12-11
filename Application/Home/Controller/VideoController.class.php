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
        $cid =I('get.cid');
        if(empty($cid)){
                $tmp = M('video');
                $count = $tmp->count();
                $Page  = new \Think\PageHome($count,5);
                $show  = $Page->show();
                $videolist = $tmp->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        }else{
            $tmp = M('video');
            $count = $tmp->where(array('cid'=>$cid))->count();
            $Page  = new \Think\PageHome($count,5);
            $show  = $Page->show();
            $videolist = $tmp->order('id desc')->where(array('cid'=>$cid))->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        
    	
		$this->assign('videolist',$videolist);
		$this->assign('page',$show);
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
            $this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
        } else {
            layout(true); //开启模板
            $this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
        }
    }
    public function index1($id=0){
        $this->assign('video','active');
        $tmp=M('video');
    	$article = $tmp->where(array("id"=>$id))->select();


        $article[0]['idd']="<iframe src='/danmu/miniplayer/player.php?id=".$article[0]['id']."' style='height:502px;width:740px;' allowfullscreen frameborder='no'></iframe>";
		$this->assign('videoplay',$article[0]);

        if(!$common = S("common_".$id)){
            $common = M('video_c')->where(array("ac_pid"=>$id))->where("ac_rtime >=0")->order("ac_time desc")->limit(5)->select();
            $newIp = new \Org\Util\IP();
            for ($i=0; $i < count($common); $i++) {
              $common[$i]['ip'] = getIp($common[$i]['ac_ip'],$newIp);
            }
            setS("common_".$id,$common);
        }
        $this->up   =  $tmp->where('id <'.$id)->order('id desc')->limit(1)->find();
        $this->down =  $tmp->where('id >'.$id)->order('id')->limit(1)->find();
        $this->info = $info;
        $this->common = $common;
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
            $this->display('','','','','pjax/'); //浏览器支持Pjax功能，直接渲染输出页面
        } else {
            layout(true); //开启模板
            $this->display(); //浏览器不支持Pjax功能，使用默认的链接响应机制（加载模板）
        }
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
    public function addVideoContent(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(check_verify(I('post.txt_check')) == false){
                // $this->ajaxReturn(array("att"=>1,"msg"=>"验证码错误！"));
            }
            // 判断是否是QQ登陆
            if($_SESSION['nickimg']){
                $data = array(
                    'ac_pid'        =>  I('post.ac_pid'),
                    'ac_name'       =>  I('post.ac_name'),
                    'ac_email'      =>  I('post.ac_email'),
                    'ac_url'        =>  I('post.ac_url'),
                    'ac_content'    =>  I('post.ac_content'),
                    'ac_img'        =>  session('nickimg'),
                    'ac_ip'         =>  get_client_ip(),
                    'ac_time'       =>  time(),
                    'ac_from'       =>  getOs(),    
                );
                $static = M('video_c')->add($data);
            }else{
                $static = D('Admin/VideoC')->addH();
            }
            
            if(I('post.send')=='on'){
                $content = "
                <div style='background-color:#d0d0d0;text-align:center;padding:40px;'>
                <div class='mmsgLetter' style='width:580px;margin:0 auto;padding:10px;color:#333;background-color:#fff;border:0px solid #aaa;border-radius:5px;-webkit-box-shadow:3px 3px 10px #999;-moz-box-shadow:3px 3px 10px #999;box-shadow:3px 3px 10px #999;font-family:Verdana, sans-serif; '>
                <div class='mmsgLetterHeader' style='height:23px;background:url(".C('SITE_URL')."/Public/Img/email/topline.png) repeat-x 0 0;'></div>
                <div class='mmsgLetterContent' style='text-align:left;padding:30px;font-size:14px;line-height:1.5;background:url(".C('SITE_URL')."/Public/Img/email/mark.png) no-repeat top right;'>
                <div>
                <p>亲爱的管理员，你好!</p>
                <p>您".C('NAME')."的视频：《".I('post.title')."》有新的评论</p>
                <p> 用户 [ <a> ".I('post.ac_name')." </a> ] <small> ( ".I('post.ac_email')." ) </smaill>给您评论到：</p>
                <p style='word-wrap:break-word;word-break:break-all;margin-left:25px;border:1px solid #cccccc;padding:20px;display:block;'><a href='".C('SITE_URL')."/article-".I('post.ac_pid')."' target='_blank'>".reFace(I('post.ac_content'))."</a></p>
                <p>此邮件为系统自动发出，请勿直接回复</p>
                </div>
                <div class='mmsgLetterHeader' style='height:23px;background:url(".C('SITE_URL')."/Public/Img/email/topline.png) repeat-x 0 0;'></div>
                </div>
                </div>
                </div>";
                            
                sendEmail(C('MAIL_USERNAME'),'您的'.C("NAME").'上的文章有了新的评论',$content);
            }
            if(I('post.rember')=='on'){
                cookie('name',I('post.ac_name'),3600); 
                cookie('email',I('post.ac_email'),3600); 
                cookie('url',I('post.ac_url'),3600); 
            }
            if($static){
                $data = array("error"=>0,"msg"=>"评论完成!");
            }
            else{
                $data = array("error"=>1,"msg"=>"评论时发生错误!");            
            }
        }       
        $this->ajaxReturn($data);   
    }
}