<?php
namespace Admin\Controller;

use Think\Model;
use Think\Controller;

class DeptController extends  CommonController
{

	public function  readData()
	{
		$model = D('Dept');

		$data = $model -> select();
	}

	public function addData()
	{
		$model = D('Dept');
		$array = array('name' => '销售部','pid' => '0','sort' => '50','remark' => '销售部');
		$result = $model -> add($array);
		dump($result);
	}

	// 定义修改操作的方法
	public function saveData()
	{
		$model = D('Dept');
		$array = array('id' => 2,'name' => '市场部');
		$result = $model -> save($array);
		dump($result);
	}

	public function delData()
	{
		$model = D('Dept');
		$result = $model -> delete('1,2');

	}


	
	// 添加部门的方法
	public function add()
	{	
		// 实例化模型
		$model = D('Dept');
		$data = $model -> select();//查询全部部门的信息
		$this -> assign('data',$data);
		$this -> display();

	}

	public function addOk()
	{
		// 用I方法来接收数据
		// $post = I('post.');
		
		$model = D('Dept');
		$model -> create();//自动创建数据对象post方法不用写，get方法传参需要写
		$result = $model -> add();
		if ($result) {
			$this -> success('添加成功',U('add'),3);
		}else{
			$this -> error('添加失败',U('add'),3);
		}
	}

	// 编写edit方法展示修改模板
	public function edit()
	{
		// 获取get中的id信息
		$id = I('get.id');
		// 实例化模型
		$model = D('Dept');
		// 获得记录的原有信息
		$data = $model -> find($id);
		// 获取全部的部门信息
		$dept = $model -> where('id!='.$id) -> select();
		// 将获取的信息全部传递给模板
		$this -> assign('data',$data);
		$this -> assign('dept',$dept);
		// 渲染模板
		$this -> display();
	}
	// 编写editok方法
	public function editOk()
	{
		// 接收post信息
		$post = I('post.');
		// 实例化模型
		$model = D('Dept');
		$result = $model ->save($post);//编程
		if ($result !== false) {
			// 成功
			$this->success('修改成功',U('deptlist'),3);
		}else{
			$this -> error('修改失败:(',U('edit',array('id'=>$_POST['id'])),3);
		}
	}

	/*public function addOk()
	{
		// 用I方法来接收数据
		$post = I('post.');

		$model = D('Dept');
		$result = $model -> add($post);
		if ($result) {
			$this -> success('添加失败',U('add'),3);
		}else{
			$this -> error('添加失败',U('add'),3);
		}
	}*/
	

	public function deptlist()
	{
		$model = D('Dept');
		$data = $model -> select();

		// 引入递归方法文件
		// load('@/tree');
		// 将从数据表中查询到的数据传递给getTree方法进行处理
		// $data = getTree($data);
		$this -> assign('data',$data);
		$this -> display();
	}

	public function nextlist()
	{
		$id = I('get.id');
		// dump($id);die();
		$model = D('Dept');
		$data = $model -> where($id = 'pid') -> select();

		// 引入递归方法文件
		// load('@/tree');
		// 将从数据表中查询到的数据传递给getTree方法进行处理
		// $data = getTree($data);
		$this -> assign('data',$data);
		$this -> display();
	}

	// 删除方法
	public function del()
	{
		// 接收id的信息
		$ids = I('get.ids');
		// 实例化模型
		$model = D('Dept');
		
		$result = $model -> delete($ids);
		if ($result) {
			$this -> success('删除成功',U('deptlist'),3);
		}else{
			$this -> error('删除失败',U('deptlist'),3);
		}
	}
	//
	public function test1()
	{
		$model = D('Dept');
		dump($model);
	}
	// 字段映射的读取操作
	
	public function yingshe()
	{
		$model = D('Dept');
		$data = $model -> find(7);
		$data = $model ->parseFieldsMap($data);
		dump($data);
	}

	// 测试特殊表的实例化操作
	public function teshubiao()
	{

	}
	public function aropt()
	{
		$model = D('Dept');
		// ar模式中的查询操作
		// $model -> id = 7;
		// $info = $model -> find();
		$model -> name = '技术部';
		$model -> pid = '0';
		$model -> sort = '30';
		$model -> remark = 'this is jsb';
		$info  = $model ->add();
		// 打印输出
		dump($info);
	}

	public function fuzhu()
	{
		//实例化模型
		$model = D('Dept');
		// 使用where方法查询表中的id
		// $model -> where('id = 9');
		// $model -> where(array('id = 9'));
		// tp中支持使用辅助方法的时候可以使用数组和字符串形式
		// $info = $model -> select();//不需要加参数
		
		
		// 通过limit方法只查询部门表中的第二条数据
		// $model -> limit(1,1);
		// $info = $model -> select();
		

		// 通过field方法查询部门表中的id和那么的信息
		// $modle ->field('id,name');//指定需要查询的字段
		// $info = $model -> select();
		


		// order方法
		// $model -> order('id desc');//降序排列
		// $info = $model -> select();
		

		// group方法对查询结果按照指定的字段进行分组，也就是原生的sql中的group by语句
		$model -> field('name,count(*)');
		$model -> group('name');
		$info  = $model -> select();
		dump($info);
		
	}
	public function tongji()
	{
		// 先实例化模型
		$model = D('Dept');

		$data = $model -> count();//count方法不需要参数

		dump($data);
	}

	public function sqltest()
	{
		// 进行实例化
		$model = D('Dept');
		// 执行一句sql查询
		$data = $model -> select();
		// 使用getLastSql获取上一句sql语句
		// echo $model->getLastSql();
		// 使用_sql()获取最后一条执行sql
		// echo $model ->_sql();
		// 使用fetchSql()方法输出sql语句
		$sql = $model ->where('id=2')->fetchSql(true)->find();
		var_dump($sql);
	}
	// 演示在tp中执行原生的sql语句查询职员的全部信息，关联部门表
	public function lianbiao()
	{
		// 实例化父类，根据自身的需要，选择实例化父类模型或者自定义模型
		$model = M();
		// 定义sql语句
		// $sql = "Select 表1.字段，表2.字段...from 表1，表2 where 表1.字段=表2.字段";
		// $result = $model -> query($sql);//执行原生的sql
		// 使用连贯操作改写原生的sql语句
		$model 
		-> field('t1.*,t2.name') 
		-> table('tp_user as t1,tp_dept as t2') 
		-> where('t1.dept_id = t2.id') 
		-> select();
		dump($result);
	}
	// 查询部门表的详细信息，需要展现出部门的所属级部门名
	// select t1.*,t2,name ad dept_name from tp.dept as t1 left join tp_dept as t2 on t1.pid = t2.id;
	// 在tp中使用连贯操作join链表查询
	public function lb()
	{
		$model = D('Dept');
		// 连贯操作给表起别名
		$result = $model 
		-> alias('t1') 
		-> field('t1.*,t2.name as dept_name') 
		-> join('left join tp_dept as t2 on t1.pid = t2.id')
		->select();
		dump($result);
	}
	public function lbcx()
	{
		$model = D('Dept');
		$result = $model
		->alias('t1')
		->field('t1.*,t2,name as dept_name')
		->join('left join tp_dept as t2 on t1.pid = t2.id');
	}

}