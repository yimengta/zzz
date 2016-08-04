<?php 
// 声明命名空间
namespace Home\Controller;
// 引入命名空间
use Think\Controller;

class GoodsController extends Controller
{
	public function goodslist()
	{
		$this->display();
	}
	// 定义商品详情页面
	public function detail()
	{
		$this -> display();
	}
}
