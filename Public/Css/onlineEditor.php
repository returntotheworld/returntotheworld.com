<?php

//在线文件编辑器
/*-------------------------------------
   使用工厂设计模式，MVC实现
*/

class onlineEditor{

	//设置全局变量路径
	public $filePath = null;
	//设置过滤信息
	private $fileFilter = array(
		'onlineEditor.php',         
		'viewEditor.html',
		'index.php',
		'.',
		'..'
	);
	
	//构造函数必须是私有的在单例设计模式中
	function __construct($filePath){
		$this->filePath = $filePath;
	}

	//当本类销毁的时候进行的操作
	function __destruct(){
		// echo $this->filePath;
	}

	//获取文件的内容
	function getContent($filePath){
		if (!isset($filePath)) {
			
		} else{
			//获取文件内容
			$fileContent = file_get_contents($filePath);
			return $fileContent;
		}
	}

	//放入文件内容
	function putContent($filePath,$fileContent){
		file_put_contents($filePath, $fileContent);
	}

	//判断目录是否存在
	private function judgeExist(){
		//判断目录是否为空或者没有文件
		if(is_dir($this->filePath) && file_exists($this->filePath)){
			return true;
		} else{
			return false;
		}
	}

	//创建文件
	function createFile($filename){
		if(!file_exists($filename)){
			fopen($filename, "w+");
		}
			
		else{
			echo "<a href = 'index.php' >点此返回</a>";
		 	die("文件已经存在");
		}
			
	}
	//删除文件
	function delFile($filename){
		if(file_exists($filename)){
			unlink($filename);
		}
	}

	//主函数
	function main(){
		if($this->judgeExist()){
			//获取打开文件夹对象
			$fileOpen = opendir($this->filePath);
			$fileMes = array();
			$i = 0;
			//遍历文件夹
			while ($file = readdir($fileOpen)) {
				
				//过滤
				if(in_array($file, $this->fileFilter)){
					continue;
				}
		        
		        $fileMesPush = array(
		        	'fileCode'  => $i,
		        	'fileName'  => $file,
		        	'fileType'  => fileType($file),
		        	'fileSize'  => fileSize($file),
		        	'filemtime' => filemtime($file)
		        );
		        
		        array_push($fileMes, $fileMesPush);
		        $i++;
		    }
		    //关闭文件
		   
		    return $fileMes;
		    fclose($fileOpen);
		} else{
			die("不存在此文件夹");
		}
	}

}

?>