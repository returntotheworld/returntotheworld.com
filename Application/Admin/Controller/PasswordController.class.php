<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 联系人管理
* @date: 2015年10月21日
* @author: Administrator
* @return:
*/
    class PasswordController extends AuthController
    {
        public function index(){
        $this->assign("password","active open");
        $this->assign("passwordadd","class='active'");
        $this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->display();
        }
        public function passwordAdd(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('password')->addH())
                $data = array("error"=>0,"msg"=>"添加完成!");
            else
                $data = array("error"=>1,"msg"=>"添加时发生错误!");            
        }
        $this->ajaxReturn($data);   
        }
        public function passwordEdit(){
        $this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->assign("password","active open");
        $this->assign("passwordlist","class='active'");
        $info = M('password')->where(array("id"=>I('get.id')))->find();
        if(!$info)
            $this->error('参数错误!',0,0);
        else{
            $this->assign("info",$info);
            $this->display('index');
        }
    }
    
    public function passwordEditH(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('password')->editH())
                $data = array("error"=>0,"msg"=>"修改文章完成!");
            else
                $data = array("error"=>1,"msg"=>"修改时发生错误!");            
        }
        $this->ajaxReturn($data);           
    }
    public function passwordDel(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(M('password')->where(array("id"=>I('post.id')))->delete())
                $data = array("error"=>0,"msg"=>"删除完成!");
            else
                $data = array("error"=>1,"msg"=>"删除时发生错误!");
        }
        $this->ajaxReturn($data);
    }
        // public function index()
        // {
        //     $name = I('nickname');
        //     if(is_numeric($name)){
        //         $map['id|nickname']=   array(intval($name),array('like','%'.$name.'%'),'_multi'=>true);
        //     }else{
        //         $map['nickname']    =   array('like', '%'.(string)$name.'%');
        //     }

        //     $Blog = D('Password');
        //     $count = $Blog->where($map)->count();
        //     $Page = new \Think\Page($count, 20);
        //     $show = $Page->show();
        //     $list = $Blog->where($map)->order('id DESC')->limit(($Page->firstRow . ',') . $Page->listRows)->select();
        //     $this->assign('list', $list);
        //     $this->assign('page', $show);
        //     $this->display('password_list');
        // }
        public function passwordList(){
        $this->assign("password","active open");
        $this->assign("passwordlist","class='active'");
        $Article    = M('password'); 
        $count  = $Article->count();
        $this->assign("num",$count);
        $Page   = new \Think\Page($count,500);
        $show   = $Page->show();
        $list   = $Article->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('List',$list);
        $this->assign('page',$show);
        $this->display();
        }
        public function Password_add()
        {
            $cate=M('category');
            $condition['mid'] = '37';
            $condition['cid'] = '37';
            $condition['_logic'] = 'OR';
            $cate=$cate->where($condition)->select();
			$cate = Category::zifenlei($cate,'&nbsp;&nbsp;|--');
            $this->assign('cate',$cate);
            $this->display('write');
        }
        public function addcontent()
        {
            $upload = new \Think\Upload();
            $upload->maxSize = C('mi_maxSize');
		   $mi_extss =explode(',',C('mi_exts'));
           $upload->exts=$mi_extss; 

            $upload->savePath = './thumbnail/';
            $upload->autoSub = true;
            $upload->subName = array('date', 'Ymd');
	
			
            $info = $upload->upload();
            foreach ($info as $file) {
                $file['savepath'] . $file['savename'];
            }
            $password = M('Password');
            $data['loginwed'] = $_POST['loginwed'];
            $data['nickname'] = $_POST['nickname'];
            $data['account'] = $_POST['account'];
            $data['pwing'] = $_POST['pwing'];
            $data['paypw'] = $_POST['paypw'];
            $data['querypw'] = $_POST['querypw'];
            $data['cid'] = $_POST['cid'];
            $data['phone'] = $_POST['phone'];
            $data['email'] = $_POST['email'];
            $data['account'] = $_POST['account'];

            $data['content'] = I('post.content');
            $data['cid'] = I('post.cid');
			
            if ($_POST['time'] == '') {
                $data['time'] = time();
            } else {
                $data['time'] = strtotime($_POST['time']);
            }
            // $data['tag'] = I('post.tag');
            // $data['click'] = I('post.click');
            // $data['hot'] = I('post.hot');
            // $data['summary'] = I('post.summary');

            // if ($_POST['img'] == '') {
            //     $data['img'] = $_POST['img'] .$file['savename'];
            // } else {
            //     $data['img'] = $_POST['img'] .$file['savename'];
            // }
			
			
			
            if ($password->add($data)) {
                $this->success(L('Write_success'));
            } else {
                $this->error(L('Write_error'));
            }
        }
		
		
		
	function newsDate() {
		return date('Y-m-d H:i:s');
	}
		

		
        public function mod()
        {
	
            $id = I('get.id');
	
            if (!empty($id)) {
                $art = M('password');
                $date = $art->where(array('id' => $id))->find($id);
                $this->assign('conn',$date);
                $cat=M('category');
                $condition['mid'] = '37';
                $condition['cid'] = '37';
                $condition['_logic'] = 'OR';
                $cat=$cat->where($condition)->select();
				$cat = Category::zifenlei($cat,'&nbsp;&nbsp;|--');
                $this->assign('cate', $cat);
            }

            $this->display('password_mod');
        }
        public function del()
        {
            if (IS_POST) {
                $ids = $_POST;
                $db = M('password');
                if ($ids) {
                    foreach ($ids as $id) {
                        $db->where(array('id' => $id))->delete();
                    }
                }
                $this->success('<p>'.L('batchdell_success').'</p>');
            } else {
                $id = I('get.id');
                $db = M('Password');
                $status = $db->where(array('id' => $id))->delete();
                if ($status) {
                    $this->success(L('dell_success'));
                } else {
                    $this->error(L('dell_error'));
                }
            }
        }
        public function hot()
        {
            $id = $_GET['id'];
            $hot = $_GET['hot'];
            $result = $this->setHot($id, $hot);
            if ($result) {
                $this->success(L('set_success'));
            } else {
                $this->error(L('set_error'));
            }
        }
        public function update()
        {

            $Form = M('Password');

            if ($Form->create()) {
			
                $result = $Form->save();
                if ($result) {
                    $this->success(L('success'));
                } else {
                    $this->error(L('error'));
                }
            } else {
            	// 这是一个错误
                // $this->error($Form->getError(L('error'));
            }
        }
        public function excel(){
       // echo session($_POST['mail']);
       $this->display();
    }
    // public function add(){ 
    //         $pw = rand(1000,9999);
    //         session($_POST['mail'],$pw);
    //         $content = "你好,你的邮箱动态验证码为：".session($_POST['mail'])."";  
    //         if(SendMail($_POST['mail'],$_POST['title'],$content)){
    //             $this->success('发送成功！',U('Index/yz'));}else{
    //             $this->error('发送失败');
    //         }
    //         echo session($_POST['mail']);
            
    // }
    // public function yz(){
    //     if($_POST){
    //         $pw = $_POST['password'];
    //     $mm = session($_POST['mail']);
    //     if($pw == $mm){
    //         echo "<h1>验证成功</h1>";
    //         }else{
    //         echo "<h1>验证失败</h1>";
    //         }
    //         }else{
    //             $this->display();
    //             }
        
    // }
    //上传方法
    public function upload()
    {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('xls', 'xlsx');// 设置附件上传类
        $upload->savePath  =      '/'; // 设置附件上传目录
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['excelData']);
        $filename = './Uploads'.$info['savepath'].$info['savename'];
        $exts = $info['ext'];
        //print_r($info);exit;
        if(!$info) {// 上传错误提示错误信息
              $this->error($upload->getError());
          }else{// 上传成功
                  $this->goods_import($filename, $exts);
        }
    }

    //导入数据页面
    public function import()
    {
        $this->display('goods_import');
    }

    //导入数据方法
    protected function goods_import($filename, $exts='xls')
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }


        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //数据坐标
                $address=$currentColumn.$currentRow;
                //读取到的数据，保存到数组$arr中
                $data[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
            }

        }
        $this->save_import($data);
    }

    //保存导入数据
    public function save_import($data)
    {
        //print_r($data);exit;

        $Goods = M('password');
        $add_time = date('Y-m-d H:i:s', time());
        foreach ($data as $k=>$v){
            $date['nickname'] = $v['A'];//中文称谓
            $date['account'] = $v['B'];
            $date['pwing'] = $v['C'];
            
            
            $result = M('password')->add($date);
        }
        if($result){
            $this->success('产品导入成功', 'excel');
        }else{
            $this->error('产品导入失败');
        }
        //print_r($info);

    }

    //导出数据方法
    public function goods_export()
    {
        $goods_list = M('password')->select();
        // print_r($goods_list);exit;
        $data = array();
        foreach ($goods_list as $k=>$goods_info){
            $data[$k][id] = $goods_info['id'];
            $data[$k][name] = $goods_info['name'];
            $data[$k][sex] = $goods_info['sex'];
        }
        //print_r($goods_list);
        //print_r($data);exit;

        foreach ($data as $field=>$v){
            if($field == 'id'){
                $headArr[]='序号';
            }

            if($field == 'name'){
                $headArr[]='姓名';
            }
            
            if($field == 'sex'){
                $headArr[]='年龄';
            }
        }

        $filename="goods_list";

        $this->getExcel($filename,$headArr,$data);
    }


    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

}
