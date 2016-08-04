<?php
// 声明命名空间
namespace Admin\Controller;
// 引入需要的父类控制器类元素
use Think\Controller;
// 定义email控制器并且继承父类
class EmailController extends CommonController{
	public function send()
	{
		$model = M('User');//获取所有的发件人
		$data = $model -> select();
		$this -> assign('data',$data);
		$this -> display();//渲染模板

	}
	public function sendOk()
	{
		// 判断是否是post请求
		if (IS_POST) {
			$post = I('post.');
			// 处理附件
			if ($_FILES['file']['size']>0) {
				// 配置上传处理
				$config = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
				//实例化上传类
				$upload = new \Think\Upload($config);
				 //上传
				$info = $upload -> uploadOne($_FILES['file']);
				dump($info);die();
			 	//判断是否上传成功
			 	if ($info) {
			 	 	$post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
			 	 	// hasfile字段
			 	 	$post['hasfile'] = 1;
			 	 	// filename字段
			 	 	$post['filename'] = $info['name'];
			 	 } 
			}
		}
		//将时间和用户名传递数据库中
		$post['addtime'] = time();
		$post['from_id'] = session('uid'); 
		$model = M('Email');
		$file = $model -> add($post);
		if($file){
			$this -> success('上传成功',U('sendBox'),3);
		}else{
			$this -> error('上传失败',U('send'),3);
		}

	}

	// 读取已发的邮件信息
	public function sendBox()
	{
		$model = M('Email');
		// 读取当前用户的全部已发邮件
		$data = $model 
		-> table('tp_email as t1,tp_user as t2') 
		-> field('t1.*,t2.truename') 
		-> where('t1.to_id = t2.id and t1.from_id ='. session('uid')) 
		-> select();
		// echo $model -> _sql();die();
		$this -> assign('data',$data);
		// 渲染模板
		$this -> display();
	}

	// 附件下载的方法
	public function download()
	{
		$id = I('get.id');
		// dump($id);die();
		// 去查询对应id的邮件中的附件地址
		$model = M('Email');
		// 查询
		$data = $model -> find($id);
		$file = WORKING_PATH . $data['file'];
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header("Content-Length: ". filesize($file));
		readfile($file);		

	}
	// 用于读取当前用户所有的邮件，并且在模板中展示
	public function recBox()
	{
		//实例化模型
		$model = M('Email');
		//关联查询email/user
		$data = $model -> table('tp_email as t1,tp_user as t2') 
				->field('t1.*,t2.truename')
				->where('t1.from_id = t2.id and t1.to_id = ' . session('uid'))
				->select();
		$this -> assign('data',$data);
		// 
		$this ->display();

	} 
	// 输出当前用户未读信息的数量
	public function getMsgCount()
	{
		// 判断当前请求
		if (IS_AJAX) {
			// 实例化模型
			$model = M('Email');
			// 
			$count = $model -> where('isread = 0 and to_id =' . session('uid'))
			-> count();
			// 输出数量
			echo $count;
		}
	}
	// 获取邮件的内容
	public function getContent()
	{
		$id = I('get.id');
		// 查询邮件的信息
		// shilihaumox
		$model = M('Email');
		// 查询
		$data = $model -> where('to_id =' .session('uid')) ->find($id);
		if ($data) {
			$model -> save(array('id' => $id,'isread' => 1));
		}
		echo $data['content'];
	}

}





