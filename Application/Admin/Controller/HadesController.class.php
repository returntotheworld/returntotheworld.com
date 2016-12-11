<?php
namespace Admin\Controller;
use Think\Controller;
/**
* HADES管理
* @date: 2015年10月21日
* @author: Administrator
* @return:
*/
    class HadesController extends AuthController
    {
        public function index()
        {
            $Blog = D('h');
            $count = $Blog->count();
            $Page = new \Think\Page($count, 20);
            $show = $Page->show();
            $list = $Blog->order('id DESC')->limit(($Page->firstRow . ',') . $Page->listRows)->select();
            $list = $Blog->order('id DESC')->select();

            $this->assign('list', $list);

            $this->assign('page', $show);


            $cate=M('category');
            $condition['mid'] = '17';
            $condition['cid'] = '17';
            $condition['_logic'] = 'OR';
            $cate=$cate->where($condition)->select();
            $this->assign('cate',$cate);
            $this->display('article_list');
        }
        public function cid_show()
        {
            $cid=$_POST['cid'];
            $map['cid']=$cid;
            $Blog = D('h');
            $count = $Blog->where($map)->count();
            $Page = new \Think\Page($count, 20);
            $show = $Page->show();
            $list = $Blog->where($map)->limit(($Page->firstRow . ',') . $Page->listRows)->select();
            $this->success($list);

        }
        public function Article_add()
        {
	
            $cate=M('category');
            $condition['mid'] = '17';
            $condition['cid'] = '17';
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
            $article = M('h');
            $data['title'] = $_POST['title'];
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
			
			
			
            if ($article->add($data)) {
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
                $art = M('h');
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
                $db = M('h');
                if ($ids) {
                    foreach ($ids as $id) {
                        $db->where(array('id' => $id))->delete();
                    }
                }
                $this->success('<p>'.L('batchdell_success').'</p>');
            } else {
                $id = I('get.id');
                $db = M('h');
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

            $Form = M('h');

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
