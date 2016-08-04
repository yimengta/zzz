<?php 
namespace Admin\Controller;
use Tool\AdminController;


class IndexController extends AdminController
{
	public function index()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		$this -> display();//展示模板
	}
	public function center()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		$this -> display();//展示模板
	}
	public function top()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		$this -> display();//展示模板
	}
	public function down()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		$this -> display();//展示模板
	}

	public function left()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		// 获得用户的额角色的权限信息
		//用户的id信息session->id->角色id->权限信息
		$admin_id = session('admin_id');
		$admin_name = session('admin_name');
		// dump(array($admin_name,$admin_id));die;
		// 联表查询sp_manager/sp_role
		//获取角色对应的权限auth_ids信息
		// 实例化模型
		if ($admin_name==='admin') {
			// 超级管理员显示全部的权限
			$auth_infoA = D('Auth') -> where(array('auth_level'=>0)) -> 
				field('auth_id,auth_name,auth_pid,auth_a,auth_c')->
				select();//顶级权限
				// dump($auth_infoA);
		// select * from 'sp_auth' where 'auth_id' in () and 'auth_level' =0
			$auth_infoB = D('Auth') -> 
			where(array('auth_level'=>1)) ->
			field('auth_id,auth_name,auth_pid,auth_a,auth_c')->
			 select();//次级权限
			 // dump($auth_infoB);die;
		}else{
			$managerModel = D('Manager');
			// dump($managerModel);die();
			$authids = $managerModel -> alias('m') -> join('__ROLE__ r on m.role_id=r.role_id') -> where(array('m.mg_id' => $admin_id)) ->getfield('r.role_auth_ids');
			// dump($authids);die;
			// 根据auth_ids获取具体的权限信息
			$auth_infoA = D('Auth') -> where(array('auth_id'=>array('in',$authids),'auth_level'=>0)) -> 
			field('auth_id,auth_name,auth_pid,auth_a,auth_c')->
			select();//顶级权限
			// dump($auth_infoA);
			// select * from 'sp_auth' where 'auth_id' in () and 'auth_level' =0
			$auth_infoB = D('Auth') -> 
			where(array('auth_id'=>array('in',$authids),'auth_level'=>1)) ->
			field('auth_id,auth_name,auth_pid,auth_a,auth_c')->
			 select();//次级权限
			// dump($auth_infoB);die;
			// select * from 'sp_auth' where 'auth_id' in () and 'auth_level' =1
		}
		$this -> assign('auth_infoA',$auth_infoA);
		$this -> assign('auth_infoB',$auth_infoB);
		$this -> display();//展示模板
	}

	public function right()
	{
		layout(false);
		C('SHOW_PAGE_TRACE',false);
		$this -> display();//展示模板
	}
}
