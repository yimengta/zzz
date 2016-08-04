<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;

class RoleController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '角色管理',
			'second' => '角色列表',
			'btn' => '添加角色',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);


		$RoleModel = D('Role');
		// dump($goodsModel);die;
		$info = $RoleModel -> select();
		$this -> assign('info',$info);
		$this -> display();
	}
	function distribute()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '角色管理',
			'second' => '角色列表',
			'btn' => '添加角色',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		
		$role_id = I('get.role_id');
		$roleModel = D('Role');
		if (IS_POST) {
			// dump($_POST);die;
			$_POST['role_auth_ids'] = implode(',',$_POST['authid']);
			$shuju = $roleModel -> create();
			if ($roleModel -> save($shuju)) {
				// echo "okk";
				$this -> success('分配成功',U('showlist'));
			}else{
				// echo "fail";
				$this -> error('分配失败',U('showlist',array('role_id'=>$role_id)));
			}
		}else{
		$role_info = D('Role') -> find($role_id);
		// dump($role_info);die;
		$this -> assign('role_info',$role_info);
		// 获得顶级权限和次级权限
		$auth_infoA = D('Auth') 
		-> where(array('auth_level'=>0)) 
		->field('auth_id,auth_name,auth_pid,auth_a,auth_c')
		->select();//顶级权限
		// dump($auth_infoA);
		// select * from 'sp_auth' where 'auth_id' in () and 'auth_level' =0
		$auth_infoB = D('Auth') 
		->where(array('auth_level'=>1)) 
		->field('auth_id,auth_name,auth_pid,auth_a,auth_c')
		->select();//次级权限
		}
		$this -> assign('auth_infoA',$auth_infoA);
		$this -> assign('auth_infoB',$auth_infoB);
		$this -> display();
	}

}