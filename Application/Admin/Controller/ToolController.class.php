<?php
namespace Admin\Controller;
use Think\Controller;
class ToolController extends AuthController {
	//后台首页
    public function index(){
    }
	
	public function out(){
	}
	//独立发邮件方法
	public function phpmailer(Request $request){

		
		//发送命令 返回布尔值 
		//PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
		$status = $this->is_sendEmail(I('post.alc_email'),'您在'.C('NAME').'上的说说有了回复',$content);
		 
		//简单的判断与提示信息
		if($status) {
		 echo '发送邮件成功';
		}else{
		 echo '发送邮件失败，错误信息未：'.$mail->ErrorInfo;
		}


	}		
}