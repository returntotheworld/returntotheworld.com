<?php
namespace Admin\Model;
use Think\Model;
/**
* 文章模型
* @date: 2015年10月21日
* @author: Administrator
* @return:
*/
class ContactsModel extends Model{
	
	protected $_auto = array(
		array('time','strtotime',self::MODEL_BOTH,'function'),
		array('c_content','htmlspecialchars_decode',self::MODEL_BOTH,'function'),
		array('a_ip','get_client_ip',self::MODEL_BOTH,'function'),
		array('a_from','getOs',self::MODEL_BOTH,'function'),
		array('img','makeImg',self::MODEL_BOTH,'function'),
	);
	
	public function addH(){
		if(!$this->create())
			return $this->getError();
		else{
			$this->add();
			return TRUE;
		}
	}
	
	public function editH(){
		if(!$this->create())
			return $this->getError();
		else{
			$this->save();
			return TRUE;
		}
	}
	
	
	
	
}
