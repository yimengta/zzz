<?php 
namespace Admin\Controller;
//引入分类控制器的类元素
use Think\Controller;
// 定义类并且继承父类控制器
class DocController extends CommonController
{
	public function add()
	{
		$this->display();//渲染模板
	}
	// 负责接收用户的表单提交并将其写入数据库
	public function addOk()
	{
		$post = I('post.');
		// dump('post');
		// 添加当前事件
		$post['addtime'] = time();
		$model = M('Doc');
		// 配置路径
		$config = array(
			'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH
			);
		$upload = new Think\Upload();

		$info = $upload ->uploadOne($_FILES['file']);
		if($info){
			// 设置表中的filepath字段
			$post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
			// 设置表中的filename字段
			$post['filename'] = $info['name'];
			// 设置是否有附件额
			$post['hasfile'] = 1;
		}
		// 判断是否需要针对上传文件返回值的说明
		// 创建数据对象，可以用create和add方法
		$model  -> create($post);
		$result = $model -> add();//执行添加操作
		if ($result) {
			$this -> success('添加成功',U('showList'),3);
		}else{
			// 添加失败
			$this -> error('添加失败',U('add'),3);
		}
	}

	public function showList()
	{
		// 实例化模型关联数据表数据
		$model = M('Doc');
		// 查询总的记录数
		$count = $model -> count();
		// 实例化分页类，并且告知分页的总记录数和每页显示的记录数
		$page = new \Think\Page($count,3);
		// 设置分页控制显示的按钮提示
		$page -> lastSuffix = false;
		$page -> setConfig('prev','上一页');
		$page -> setConfig('next','下一页');
		$page -> setConfig('first','首页');
		$page -> setConfig('last','尾页');
		// 输出分页的控制器显示信息
		$show = $page -> show();
		// 改写原有的查询语句，添加Limit查询
		$data = $model -> limit($page -> firstRow,$page -> listRows) -> select();
		$this -> assign('show',$show);
		$this -> assign('data',$data);
		$this -> display();
	}
	// 定义down方法实现文件的下载功能
	public function download()
	{
		$id = I('get.id');
		// 实例化模型
		$model = M('Doc');
		// 根据id查询对应的记录信息
		$result = $model ->find($id);
		$file = WORKING_PATH.$info['result'];
		// 固定输出格式header头
		header("Content-type:application/octet-stream");
		header();
		header("Content-Length:".filesize($file));
		readfile($file);
	}
	// 用于输出公文内容
	public function content()
	{
		$id = I('post.');
		// 实例化模型
		$model = M('Doc');
		// 查到公文的信息
		$data = $model -> find($id);
		$content = $data['content'];
		// 需要将文章的内容中的字符转化为真实的字符
		echo html_entity_decode($content);
	}

	// 编辑需要编辑的公文id，并且展示原有的数据以供修改
	public function edit()
	{
		// 接收数据
		$id = I('get.id');
		// 实例化模型
		$model = M('Doc');
		// 查询原有的数据
		$data = $model ->find($id);
		$this -> assign('data',$data);
		// 渲染模板
		$this ->display();
	}
	// 创建editok方法，负责编辑入库
	public function editOk()
	{
		//IS_GET判断是否是get请求
		// IS_POST判断是否是post请求
		// 
		if (IS_POST) {
			$post = I('post.');
			// 对附件进行判断
			if ($_FILES['file']['size']>0 ){
				$config = array(
					'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH
					);
				// 上传类实例化
				$upload = new \Think\Upload();
				// 执行上传操作
				$info = $upload ->uploadOne($_FILES['file']);
				if ($info) {
					$post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
					// 表中的filename字段
					$post['filename'] = $info['name'];
					//表中的hasfile字段
					$post['hasfile'] = 1;
 				}
			}
		}
		// 实例化模型
		$model = M('Doc');
		$result = $model -> save($post);
		if ($result) {
			$this -> success('编辑成功',U('showList'));
		}else{
			$this -> error('修改失败',U('edit',array('id' => $post['id'])),3);
		}
	}
	// 删除方法
	public function del()
	{
		// 接收get中的id
		$id = I('get.id');
		// 实例化
		$model  = M('Doc');
		// 执行删除操作
		$result = $model -> delete($id);
		if ($result) {
			$this -> success('删除成功',U('showList'));
		}else{
			$this -> error('删除失败',U('showList'),3);
		}

	}
}
	
 ?>