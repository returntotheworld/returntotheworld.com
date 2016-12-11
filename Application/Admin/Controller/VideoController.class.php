<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 系统管理
* @date: 2015年10月21日
* @author: Administrator
* @return:
*/
class VideoController extends AuthController{
			
	public function index(){
		$this->assign("video","active open");
		$this->assign("videoadd","class='active'");
		$this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->display();
	}
	public function videoList(){
        $this->assign("video","active open");
        $this->assign("videolist","class='active'");
        $Article    = M('video'); 
        $count  = $Article->count();
        $this->assign("num",$count);
        $Page   = new \Think\Page($count,500);
        $show   = $Page->show();
        $list   = $Article->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('List',$list);
        $this->assign('page',$show);
        $this->display();
        }
	public function videoAdd(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('video')->addH())
                $data = array("error"=>0,"msg"=>"添加完成!");
            else
                $data = array("error"=>1,"msg"=>"添加时发生错误!");            
        }
        $this->ajaxReturn($data);   
        }
        public function videoEdit(){
        $this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->assign("video","active open");
        $this->assign("videolist","class='active'");
        $info = M('video')->where(array("id"=>I('get.id')))->find();
        if(!$info)
            $this->error('参数错误!',0,0);
        else{
            $this->assign("info",$info);
            $this->display('index');
        }
    }
    
    public function videoEditH(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('video')->editH())
                $data = array("error"=>0,"msg"=>"修改完成!");
            else
                $data = array("error"=>1,"msg"=>"修改时发生错误!");            
        }
        $this->ajaxReturn($data);           
    }
    public function videoDel(){
		if(!IS_AJAX){
			$this->error('提交方式不正确',0,0);
		}else{
			if(M('video')->where(array("id"=>I('post.id')))->delete())
				$data = array("error"=>0,"msg"=>"删除完成!");
			else
				$data = array("error"=>1,"msg"=>"删除时发生错误!");
		}
		$this->ajaxReturn($data);
	}
	public function basic(){
		if(!IS_AJAX){
			$this->error('提交方式不正确',0,0);
		}else{
			$data = I('post.');
			$data['footer'] = $_POST['footer'];
			if(M('Video')->add($data))
				$data = array("error"=>0,"msg"=>"修改系统基本设置完成!");
			else
				$data = array("error"=>0,"msg"=>"你没有修改任何信息!");			
		}
		$this->ajaxReturn($data);
	}	
			
	public function email(){
		$this->assign("system","active open");
		$this->assign("systememail","class='active'");
		$this->display();		
	}
	
	public function emailH(){
		$str = "<?php\n/**\n* 发送邮件参数\n* @date: 2015年10月17日\n* @author: Administrator\n* @return:\n*/\nreturn array(\n	'MAIL_SMTP'     => 'TRUE',\n	'MAIL_HOST'     => '".I('post.HOST')."',\n	'MAIL_SMTPAUTH' => 'TRUE',\n	'MAIL_SECURE'   => 'tls',\n	'MAIL_CHARSET'  => 'utf-8',\n	'MAIL_USERNAME' => '".I('post.MAIL_USERNAME')."',#邮箱账号\n    'MAIL_PASSWORD' => '".I('post.MAIL_PASSWORD')."',#密码\n	'MAIL_ISHTML'   => 'TRUE',\n    'SORT'			=> ".I('post.SORT').",\n    'HIT'			=> ".I('post.HIT').",\n);";
		if(file_put_contents('Application/Common/Conf/email.php', $str)){
			$this->ajaxReturn(array("error"=>0,"msg"=>"修改系统高级设置完成！"));
		}else{
			$this->ajaxReturn(array("error"=>1,"msg"=>"修改系统高级失败！"));
		}
	}
	
	public function ppt(){
		$this->assign("system","active open");
		$this->assign("systemppt","class='active'");
		$this->ppt = M('ppt')->select();
		$this->display();
	}
	
	public function pptH(){
	    $upload = new \Think\Upload();
	    $upload->maxSize   =     3145728 ;
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
	    $upload->rootPath  =     './Public/Img/ppt/';
		$upload->autoSub   =	false;
	    $upload->saveName  =	'time';
	    $info   =   $upload->upload();
	    if(!$info) {
	        $this->error($upload->getError());
	    }else{
	         foreach($info as $file){
		       $url = "/Public/Img/ppt/".$file['savepath'].$file['savename'];
			   M('ppt')->save(array("pp_id"=>I('post.id'),"pp_url"=>I('post.url'),"pp_img"=>$url,"pp_time"=>time(),"pp_from"=>getOS(),"pp_ip"=>get_client_ip(),"pp_root"=>session('uname'),"pp_view"=>1));
			   $this->success("修改完成！",'ppt');
		    }
	    }	
	}	
}
