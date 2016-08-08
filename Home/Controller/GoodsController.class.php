<?php 
// 声明命名空间
namespace Home\Controller;
use Tool\HomeController;

class GoodsController extends HomeController
{
	public function goodslist()
	{
		$cat_id = I('get.cat_id');
		$category = D('Category');
		$now_catinfo = $category -> find($cat_id);
		$now_catpath = $now_catinfo['cat_path'];
		$path_part = explode('-',$now_catpath);
		$one_path = $path_part[0];
		//给全路径的第一个分解内容做模糊查询
		$second_pathinfo = $category -> where(array('cat_path'=>array('like',$one_path.'-%'))) -> select();
		$first_catinfo = $category -> select($one_path);
		// $ji_catinfo = array_merge($first_catinfo,$second_catinfo);
		$this-> assign('ji_catinfo',$ji_catinfo);
		$this->display();
	}
	// 定义商品详情页面
	public function detail()
	{
		$this -> display();
	}
}
