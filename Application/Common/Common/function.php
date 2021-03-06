<?php
/**
* 公用函数
* @date: 2015年10月17日
* @author: Administrator
* @return:
*/
	// 后台登陆日志
	function addLog(){
		$data = array(
			"lname"	=>	session("uname"),
			"ltime"	=>	time(),
			"lip"	=>	get_client_ip(),
		);
		M('log')->add($data);
	}
	
	// 获取最近时间
	function getTime($time) {   
        $rtime = date("m-d H:i",$time);    
        $rtime2 = date("Y-m-d H:i",$time);   
        $htime = date("H:i",$time); 
        $time = time() - $time;   
        if ($time < 60) {   
            $str = '刚刚';    
        }    
        elseif ($time < 60 * 60) {    
            $min = floor($time/60);   
            $str = $min.' 分钟前';    
        }   
        elseif ($time < 60 * 60 * 24) {    
            $h = floor($time/(60*60));   
            $str = $h.'小时前 '.$htime;   
        }  
        elseif ($time < 60 * 60 * 24 * 3) {    
            $d = floor($time/(60*60*24));   
            if($d==1)   
                $str = '昨天 '.$htime;  
            else   
                $str = '前天 '.$htime;   
        }  
        elseif ($time < 60 * 60 * 24 * 7) {  
            $d = floor($time/(60*60*24));  
            $str = $d.' 天前 '.$htime;  
        } elseif ($time < 60 * 60 * 24 * 30) {  
            $str = $rtime;  
        }   
        else {   
            $str = $rtime2;    
        }    
        return $str;   
    }
    
	// 获取访客系统
	function getOS(){
		$os='';
		$Agent=$_SERVER['HTTP_USER_AGENT'];
		//return $Agent;
		if(preg_match('/Win/',$Agent)&&preg_match('/NT 5.0/',$Agent))
			$os='Win 2000';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT 6.1/',$Agent))
			$os='Win 7';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT 5.1/',$Agent))
			$os='Win XP';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT 6.2/',$Agent))
			$os='Win 8';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT 6.3/',$Agent))
			$os='Win 8.1';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT 10/',$Agent))
			$os='Win 10';
		elseif(preg_match('/Win/',$Agent)&&preg_match('/NT/',$Agent))
			$os='Win';
		elseif(preg_match('/Win/',$Agent)&&ereg('/32/',$Agent))
			$os='Win 32';
		elseif(preg_match('/Mi/',$Agent))
			$os='小米';
		elseif(preg_match('/Android/',$Agent)&&ereg('/LG/',$Agent))
			$os='LG';
		elseif(preg_match('/Android/',$Agent)&&ereg('/M1/',$Agent))
			$os='魅族';
		elseif(preg_match('/Android/',$Agent)&&ereg('/MX4/',$Agent))
			$os='魅族4';
		elseif(preg_match('/Android/',$Agent)&&ereg('/M3/',$Agent))
			$os='魅族';
		elseif(preg_match('/Android/',$Agent)&&ereg('/M4/',$Agent))
			$os='魅族';
		elseif(preg_match('/Android/',$Agent)&&ereg('/H/',$Agent))
			$os='华为';
		elseif(preg_match('/Android/',$Agent)&&ereg('/vivo/',$Agent))
			$os='Vivo';
		elseif(preg_match('/Android/',$Agent))
			$os='Android';
		elseif(preg_match('/Linux/',$Agent))
			$os='Linux';
		elseif(preg_match('/Unix/',$Agent))
			$os='Unix';
		elseif(preg_match('/iPhone/',$Agent))
			$os='iPhone';
		elseif($os=='')
			$os='Unknown';
		
		return $os;
	}
	
	// 字符串剪裁
	function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = false) { 
	    if (function_exists("mb_substr")) { 
	        if ($suffix) 
	            return mb_substr($str, $start, $length, $charset) . "..."; 
	        else 
	            return mb_substr($str, $start, $length, $charset); 
	    }elseif (function_exists('iconv_substr')) { 
	        if ($suffix) 
	            return iconv_substr($str, $start, $length, $charset) . "..."; 
	        else 
	            return iconv_substr($str, $start, $length, $charset); 
	    } 
	    $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";  
	    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/"; 	 
	    $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/"; 	 
	    $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/"; 	 
	    preg_match_all($re[$charset], $str, $match); 	 
	    $slice = join("", array_slice($match[0], $start, $length)); 	 
	    if ($suffix) 
	        return $slice . "…"; 	 
	    return $slice; 
	}
	
	// 获取IP地址
	function getIp($ip,$newIp){
    	if(!isset($newIp)){
    		$newIp = new \Org\Util\IP();
		}
    	if($ip=='127.0.0.1'){
    		$ads = "本机地址";
    	}else{
			$tmp = $newIp->find($ip);
			if($tmp[1]==$tmp[2]){
				$ads = $tmp[1];
			}elseif($tmp[3]==''){				
				$ads = $tmp[1].'省'.$tmp[2].'市';
			}else{
				$ads = $tmp[1].'省'.$tmp[2].'市'.$tmp[3];
			}
    	}	    
    	return $ads;
	}

	// 文章缩略图
	function makeImg($str){
		$time = time();
		$s = base64_decode(str_replace('data:image/png;base64,', '', $str));
		file_put_contents('Upload/Thumb/'.$time.'.jpg',$s);
		$url = '/Upload/Thumb/'.$time.'.jpg';
		return $url;
	}

	// 写图片 
	function getImg($str){
		$time = time();
		$s = base64_decode(str_replace('data:image/png;base64,', '', $str));
		file_put_contents('Upload/Album/'.$time.'.jpg',$s);
		$url = '/Upload/Album/'.$time.'.jpg';
		return $url;
	}
	
	function getAThumb($str,$width=600,$height=300){
		$image = new \Think\Image(); 
        $image->open('.'.$str);
        $name = time();
        $image->thumb($width,$height,\Think\Image::IMAGE_THUMB_SCALE)->save('./Upload/Thumb/'.$name.'.jpg');
        $url = '/Upload/Thumb/'.$name.'.jpg';
		return $url;
	}
	
	// 发送邮件
	function sendEmail($to, $subject, $content) {
	    vendor('phpmailer.class#phpmailer');
	    $mail = new phpmailer();
	    if (C('MAIL_SMTP')) {
	        $mail->IsSMTP();
	    }
	    $mail->Host = C('MAIL_HOST');
	    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
	    $mail->Username = C('MAIL_USERNAME');
	    $mail->Password = C('MAIL_PASSWORD');
	    $mail->SMTPSecure = C('MAIL_SECURE');
	    $mail->CharSet = C('MAIL_CHARSET');
	    $mail->From = C('MAIL_USERNAME');
	    $mail->AddAddress($to);
	    $mail->FromName = '回这世界博客';
	    $mail->IsHTML(C('MAIL_ISHTML'));
	    $mail->Subject = $subject;
	    $mail->Body = $content;
	    if (!$mail->Send()) {
	        return FALSE;
	    } else {
	        return TRUE;
	    }
    }
	// 独立发送邮件
	function is_sendEmail($to, $subject, $content) {
	    vendor('phpmailer.class#phpmailer');
	    $mail = new phpmailer();
	    if (C('MAIL_SMTP')) {
	        $mail->IsSMTP();
	    }
	    $mail->Host = C('MAIL_HOST');
	    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
	    $mail->Username = C('MAIL_USERNAME');
	    $mail->Password = C('MAIL_PASSWORD');
	    $mail->SMTPSecure = C('MAIL_SECURE');
	    $mail->CharSet = C('MAIL_CHARSET');
	    $mail->From = C('MAIL_USERNAME');
	    $mail->AddAddress($to);
	    $mail->FromName = '回这世界博客';
	    $mail->IsHTML(C('MAIL_ISHTML'));
	    $mail->Subject = $subject;
	    $mail->Body = $content;
	    if (!$mail->Send()) {
	        return FALSE;
	    } else {
	        return TRUE;
	    }
    }
	// 获取日
	function getDay($date){
		if($date=='') return '0';
		$time1 = strtotime($date);
		$time2 = round((time()-$time1)/(60*60*24));
		return $time2;
	}
	
	// 检测数字是否存在
	function chenkNum($num){
		$num = $num ? $num : 0;
		return $num;
	}

	// 检查验证码
	function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
	}
	
	// 检测用户头像
	function check_img($email){
		if(session('qq_img')){
			return $tmp = session('qq_img');
		}
		$table = CONTROLLER_NAME.'_c';
		if($table=='Article_c'){
			$params = array('ac_email'=>$email);
			$tmp = 'ac_img';
		}elseif($table=='Feel_c'){
			$table = "Say_c";
			$params = array('sc_email'=>$email);
			$tmp = 'sc_img';
		}elseif($table=='Album_c'){
			$params = array('alc_email'=>$email);
			$tmp = 'alc_img';
		}elseif($table=='Gust_c'){
			$table = 'Gust';
			$params = array('g_email'=>$email);
			$tmp = 'g_img';
		}elseif($table=='Video_c'){
			$params = array('ac_email'=>$email);
			$tmp = 'ac_img';
		}
		$img = M($table)->where($params)->getField($tmp);
        if($img==''){
            $tmp = '/Public/Img/Portrait/'.mt_rand(1,100).'.jpg';
        }else{
        	$tmp = $img;
        }
		return $tmp;  
	}
	
	// 替换表情
	function reFace($str){
		for($i=0;$i<84;$i++){
			$str = str_replace("[mr:/$i]","<img src='".C('SITE_URL')."/Public/Img/Face/mr/$i.gif'/>",$str);
			$str = str_replace("[lxh:/$i]","<img src='".C('SITE_URL')."/Public/Img/Face/lxh/$i.gif'/>",$str);
			$str = str_replace("[gnl:/$i]","<img src='".C('SITE_URL')."/Public/Img/Face/gnl/$i.gif'/>",$str);
			$str = str_replace("[bzmh:/$i]","<img src='".C('SITE_URL')."/Public/Img/Face/bzmh/$i.gif'/>",$str);
		}
		return $str;
	}

	// 设置缓存
	function setS($key,$value){
		S($key,$value,C('S_TIME'));
	}
	
	// 删除表情
	function delFace($str){
		for($i=0;$i<84;$i++){
			$str = str_replace("[mr:/$i]","",$str);
			$str = str_replace("[lxh:/$i]","",$str);
			$str = str_replace("[gnl:/$i]","",$str);
			$str = str_replace("[bzmh:/$i]","",$str);
		}
		return $str;
	}
	
	// 获取关键词
	function getKeyword($str){
		$str = explode(',', $str);
		foreach($str as $v){
			$tmp .=  '&nbsp;&nbsp;<a href="/Class/tag.html?key='.$v.'" class="article-tag" data-toggle="tooltip" data-placement="top" title="'.$v.'">'.$v.'</a>&nbsp;&nbsp;'; 
		}
		return $tmp;
	}
	
	// 过滤关键词
	function getTag($str){
		$article = M('article');
		$map['a_keyword']=array('like',"%$str%");
        $map['a_view']=array('gt','0');
		$data = $article->where($map)->field('a_keyword,a_id,a_time')->order('a_time desc')->select();
		$strcount='（'.count($data).'）';
		if (count($data)>1) {
			$str =  '<a href="/Class/tag.html?key='.$str.'" >'.$str.$strcount.'</a>'; 
		}else{
			$str =  '<a href="/article-'.$data[0]['a_id'].'">'.$str.'</a>'; 
		}
		return $str;
	}
	// 财务收支类型
	function statustype($opertype){
    	static $type = array(
            // Informational 1xx
            0 => '无效',
            1 => '收入',
            2 => '支出',
    	);
    	if(isset($type[$opertype])) {
    	return $type[$opertype];
       }
       return false;

    }
    // 财务类型
	function cidtype($opertype){
    	static $type = array(
            // Informational 1xx
            0 => '未分类',
            1 => '伙食',
            2 => '交通',
            3 => '礼尚',
            4 => '住宿',
            5 => '投资',
            6 => '消费',
            7 => '用品',
    	);
    	if(isset($type[$opertype])) {
    	return $type[$opertype];
       }
       return false;

    }
    // 财务变化类型
	function locationtype($opertype){
    	static $type = array(
            // Informational 1xx
            0 => '现金',
            1 => '银行',
            2 => '债权',
            3 => '债务',
    	);
    	if(isset($type[$opertype])) {
    	return $type[$opertype];
       }
       return false;

    }
