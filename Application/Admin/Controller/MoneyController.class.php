<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 财务管理
* @date: 2015年10月21日
* @author: Administrator
* @return:
*/
    class MoneyController extends AuthController
    {
        public function index(){
        $this->assign("money","active open");
        $this->assign("moneyadd","class='active'");
        $this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->display();
        }
        public function moneyAdd(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('money')->addH())
                $data = array("error"=>0,"msg"=>"添加完成!");
            else
                $data = array("error"=>1,"msg"=>"添加时发生错误!");            
        }
        $this->ajaxReturn($data);   
        }
        public function moneyEdit(){
        $this->tag = M('tag')->where(array("t_view"=>1))->select();
        $this->assign("money","active open");
        $this->assign("moneylist","class='active'");
        $info = M('money')->where(array("id"=>I('get.id')))->find();
        if(!$info)
            $this->error('参数错误!',0,0);
        else{
            $this->assign("info",$info);
            $this->display('index');
        }
    }
    
    public function moneyEditH(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(D('money')->editH())
                $data = array("error"=>0,"msg"=>"修改文章完成!");
            else
                $data = array("error"=>1,"msg"=>"修改时发生错误!");            
        }
        $this->ajaxReturn($data);           
    }
        // public function index()
        // {
        //     $Blog = D('money_log');
        //     $count = $Blog->count();
        //     $Page = new \Think\Page($count, 20);
        //     $show = $Page->show();
        //     $list = $Blog->order('time DESC')->limit(($Page->firstRow . ',') . $Page->listRows)->select();

        //     $money = M('admin')->select();

        //     $this->assign('money', $money);

        //     $this->assign('list', $list);
        //     $this->assign('page', $show);
        //     $this->display('article_list');
        // }
        public function moneyList(){
        $this->assign("money","active open");
        $this->assign("moneylist","class='active'");
        $Article    = M('money'); 
        

        $count  = $Article->count();
        $this->assign("num",$count);
        $Page   = new \Think\Page($count,500);
        $show   = $Page->show();
        $list   = $Article->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $money_sum_1  = $Article->where(array('status'=>1))->sum('money');
        $money_sum_2  = $Article->where(array('status'=>2))->sum('money');
        $money_sum_gdp  = $Article->where(array('status != 0'))->sum('money');
        $money_sum    =floatval($money_sum_1)-floatval($money_sum_2);
        $this->assign('money_sum',$money_sum);
        $this->assign('money_sum_1',$money_sum_1);
        $this->assign('money_sum_2',$money_sum_2);
        $this->assign('money_sum_gdp',$money_sum_gdp);
        $this->assign('List',$list);
        $this->assign('page',$show);
        $this->display();
        }
        public function Article_add()
        {
	
            $cate=M('category');
            $condition['mid'] = '16';
            $condition['cid'] = '16';
            $condition['_logic'] = 'OR';
            $cate=$cate->where($condition)->select();
			$cate = Category::zifenlei($cate,'&nbsp;&nbsp;|--');
            $this->assign('cate',$cate);
            $this->display('write');
        }
        public function moneyDel(){
        if(!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            if(M('money')->where(array("id"=>I('post.id')))->delete())
                $data = array("error"=>0,"msg"=>"删除完成!");
            else
                $data = array("error"=>1,"msg"=>"删除时发生错误!");
        }
        $this->ajaxReturn($data);
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
            $article = M('money_log');
            $data['money'] = $_POST['money'];
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
            $capital=$data['money'];
            $cid=$data['cid'];
            $result=change_money($capital,$cid);
            $a=$article->add($data);
            if ($a&&$result) {
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
                $art = M('Article');
                $date = $art->where(array('aid' => $id))->find($id);
                $this->assign('conn', $date);
                $cat = M('category')->select();
				$cat = Category::zifenlei($cat,'&nbsp;&nbsp;|--');
                $this->assign('clist', $cat);
            }

            $this->display('article_mod');
        }
        public function del()
        {
            if (IS_POST) {
                $ids = $_POST;
                $db = M('money_log');
                if ($ids) {
                    foreach ($ids as $id) {
                        $db->where(array('id' => $id))->delete();
                    }
                }
                $this->success('<p>'.L('batchdell_success').'</p>');
            } else {
                $id = I('get.id');
                $db = M('money_log');
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

            $Form = M('Article');

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
    }
