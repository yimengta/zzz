<?php 
namespace Admin\Controller;
// 引入父类控制器中的类元素
use Think\Controller;
// 定义控制器并继承父类
class UserController extends CommonController
{
	// 展示职员的列表信息
	public function userList()
	{
		// 实例化模型关联数据表数据
		$model = D('User');
		// 查询总的记录数
		$count = $model -> count();
		// 实例化分页类。并且告知分页类的总记录和每页显示的记录数
		$page= new \Think\Page($count,2);
		// 设置分页控制显示的按钮提示
		$page -> lastSuffix = false;//
		$page -> setConfig('prev','上一页');
		$page -> setConfig('next','下一页');
		$page -> setConfig('first','首页');
		$page -> setConfig('last','末页');
		// 输出分页的控制器显示信息
		$show = $page -> show();
		 //改写原有的查询语句，添加limit查询
		$data = $model -> limit($page->firstRow,$page->listRows) -> select();//查询操作,返回的是二位数组
		// dump($data);
		// 遍历已有的职员信息,将其中的部门id转换真是的部门名
		$dept = D('Dept');
		foreach ($data as $key => $val) {
			// 根据当前职员所属的部门id转换真是的部门名字
			$info = $dept -> find($val['dept_id']);//返回的是一维数组
			
			// 取出部门信息中的部门名称,将其放到当前记录中的dept_name中去
			$data[$key]['dept_name'] = $info['name'];
		}
		// dump($data);
		$this -> assign('show',$show);

		$this ->assign('data',$data);
		$this ->display();//渲染模板	
	}

	// 展示职员的添加的模板
	public function add()
	{
		// 实例化模型
		$model = D('Dept');
		$data = $model ->select();

		load('@/tree');
		$data = getTree($data);
		$this -> assign('data',$data);
		$this -> display();
	}

	public function addOk()
	{
		$post = I('post.');//接收post数据
		// 实例化模型
		$model = D('User');
		// 添加当前时间
		$post['addtime'] = time();
		$ss = $model -> create($post);
		if (!$ss) {
			$this->error($model->getError(),U('add'),3);
		}
		dump($model -> getError());die;
		$result = $model -> add($post);//执行添加操作
		if ($result) {
			$this -> success('添加成功',U('userList'),3);
		}else{
			// 添加失败
			$this -> error('添加失败',U('add'),3);
		}

	}

	// 职员信息的编辑
	public function edit()
	{
		// 接收传过来的id
		$id = I('get.id');
		// 实例化模型
		$model = D('User');

		$dept = D('Dept');
		// 根据$id查询出原有的职员信息
		$data = $model -> find($id);
		$deptData = $dept -> select();
		// 载入无限极分类
		load('@/tree');
		$deptData = getTree($deptData);
		// 传递参数给模板
		$this -> assign('data',$data);
		$this -> assign('deptData',$deptData);
		// 渲染模板
		$this -> display();
	}

	// 定义编辑方法处理编辑操作
	public function editOk()
	{
		// 接收用户提交的数据
		$post = I('post.');
		// dump($post);
		// 实例化模型
		$model = D('User');
		// 判断密码,如果新密码存在则使用新密码覆盖原有的密码，如果新密码为空，则使用旧密码覆盖表中的密码
		if ($post['password'] == '') {
			$post['password'] = $post['oldpassword'];
			
		}
		unset($post['oldpassword']);//可以加可以不加，删除数组中的旧密码
		$result = $model -> save($post);

		// 半段修改操作的结果
		if ($result !== false) {
			// 成功
			$this ->success('修改成功',U('userList'),3);
		}else{
			// 失败,跳转到修改页面
			$this -> error('修改失败',U('edit',array('id'=>$post['id'])),3);
		}
	}

	// 删除职员信息
	public function delUser()
	{
		// 获取职员的id信息
		$id = I('get.id');
		// 实例化模型
		$model = D('User');
		// 执行删除的方法
		$result = $model -> delete($id);
		// 判断删除的结果
		if ($result) {
			$this -> success('删除成功',U('userList'),3);
		}else{
			$this -> error('删除失败',U('userList'),3);
		}
	} 

	// highcharts展示各个部门有多少员工
	public function chart()
	{
	// 统计各个部门有多少人
	// select t2.name as dept_name,count(*) as count from tp_user as t1,tp_dept as t2 where t1.dept_id = t2.id GROUP BY dept_name;
		$model = D('User');
		$result = $model 
		-> field('t2.name as dept_name,count(*) as count') 
		-> table('tp_user as t1,tp_dept as t2') 
		-> where('t1.dept_id = t2.id')
		-> group('dept_name') 
		-> select();
		// 对数据处理
		$str = '[';
		foreach ($result as $key => $value) {
			$str = $str."['".$value['dept_name']."',".$value['count']."],";
		}
		$str = rtrim($str,',');
		$str .= ']';
		$this ->assign('data',$str);
		$this -> display();
	}
}
 ?>
