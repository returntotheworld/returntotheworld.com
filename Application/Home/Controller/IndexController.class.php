<?php
namespace Home\Controller;
use Think\Controller;
/**
* 前端首页管理
* @date: 2015年10月31日
* @author: Administrator
* @return:
*/
class IndexController extends CommonController {
	
    public function index(){
		$this->assign('index','active');
		if(!$articles=S('articles')){$articles = M('article')->where('a_view > 0')->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit(0,6)->select();setS("articles", $articles);}
		$this->articles=$articles;
		if(!$ppt=S('ppt')){$ppt = M('ppt')->where(array("pp_view"=>1))->order("pp_time desc")->limit(3)->select();setS("ppt", $ppt);}
		$this->ppt = $ppt;
		$this->display();
    }
    public function fetch_pages(){
    	$item_per_page = 6;  
		//sanitize post value  
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);  
		  // $page_number = filter_var(0, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		//throw HTTP error if page number is not valid  
		if(!is_numeric($page_number)){  
		    header('HTTP/1.1 500 Invalid page number!');  
		    exit();  
		}  
		  
		//get current starting point of records  
		$position = ($page_number * $item_per_page);  
		  
		//Limit our results within a specified range.   
		$results = M('article')->where('a_view > 0')->order('a_time desc')->join('lt_tag ON lt_tag.t_id = lt_article.pid')->limit($position, $item_per_page)->select();
		// $results = mysql_query("SELECT * FROM lt_article ORDER BY a_time DESC LIMIT $position, $item_per_page");  
		  
		//output results from database 
		// print_r($results);  
		// echo '<ul class="page_result">';  
		foreach($results as $key=>$v)
		// while($key = mysql_fetch_array($results))  
		{  
		    // echo '<li id="item_'.$v['a_id'].'"><span class="page_name">'.$v['a_id'].') <a class="article-img-a image-light hidden-xs" href="{:U("/article-".$v["a_id"])}">'.$v['a_title'].'</a></span><span class="page_message">'.$v['a_remark'].'</span></li>';  
		    echo '<article>
				<h5>
					<eq name="'.$v['a_original'].'" value="1">
						<span class="original">【原创】</span>
					<else />
						<span class="reprint">【转载】</span>
					</eq>
					<a href="/index.php?s=/article-'.$v["a_id"].'.html">'.$v['a_title'].'</a>
					<eq name="'.$v['a_view'].'" value="2">
						<img  class="title_r hidden-xs" src="/Public/Img/icon/tuijian.gif"/>
					</eq>
				</h5>
				<div class="clearfix" >           
					<p class="article-remark"> 
						<a class="article-img-a image-light hidden-xs" href="/index.php?s=/article-'.$v["a_id"].'.html"><img src="'.$v['a_img'].'" class="article-img" alt="'.$v['a_title'].'" title="'.$v['a_title'].'" /></a>
						'.$v['a_remark'].'
						<a href="/index.php?s=/article-'.$v["a_id"].'.html" class="article-look">继续阅读→</a>
					</p>
					<footer class="article-footer"> 
						<div class="article-footer-l">
							<span class="glyphicon glyphicon-tags blog-icon"></span>'.getKeyword($v['a_keyword']).'
						</div>
						<div class="article-footer-r">
							<span class="glyphicon glyphicon-fire blog-icon"></span>
							<a>'.$v['a_hit'].'</a>&nbsp;
							<span class="glyphicon glyphicon-comment blog-icon"></span>
							<a>'.$v['a_num'].'</a>
						</div>
					</footer>
				</div>
		</article>';
		}  
		// echo '</ul>';  
    }
}