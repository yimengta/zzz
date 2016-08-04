<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;

class AuthController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '权限管理',
			'second' => '权限列表',
			'btn' => '添加',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		$AuthModel = D('Auth');
		// dump($goodsModel);die;
		$info = D('Auth')->order('auth_path')->select();
		$this -> assign('info',$info);
		$this -> display();
	}
	function tianjia()
	{
		$auth = D('Auth');

		if (IS_POST) {
			// dump($_POST);die;
			$shuju = $auth -> create();
			// dump($shuju);die;
			if ($auth -> add($shuju)) {
				// echo 'okok';
				$this -> success('添加权限成功',U('showlist'));
			}else{
				$this -> success('添加权限失败',U('tianjia'));
			}
		}else{
		// 传递差异导航内容
			$daohang = array(
				'first' => '权限管理',
				'second' => '权限列表',
				'btn' => '添加',
				'btn_link' => U('tianjia')
				);
			$this -> assign('daohang',$daohang);
			$authinfo = D('Auth') -> order('auth_path') -> select();
			$this -> assign('authinfo',$authinfo);
			$this -> display();
		}
		
	}
}