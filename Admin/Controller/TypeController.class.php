<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;

class TypeController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '类型管理',
			'second' => '类型列表',
			'btn' => '添加',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		$TypeModel = D('Type');
		// dump($goodsModel);die;
		$info = $TypeModel -> select();
		$this -> assign('info',$info);
		$this -> display();
	}
	function tianjia()
	{
		$type = D('Type');
		if (IS_POST) {
			$shuju = $type -> create();
			if ($type -> add($shuju)) {
				// echo 'okok';
				$this -> success('添加商品类型成功',U('showlist'));
			}else{
				$this -> success('添加商品类型失败',U('tianjia'));
			}
		}else{
		// 传递差异导航内容
			$daohang = array(
				'first' => '类型管理',
				'second' => '类型列表',
				'btn' => '添加',
				'btn_link' => U('tianjia')
				);
			$this -> assign('daohang',$daohang);
		}
		$this -> display();
	}
}