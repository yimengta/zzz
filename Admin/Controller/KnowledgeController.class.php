<?php 
// 声明命名空间
namespace Admin\Controller;
// 引入父类控制器的元素
use Think\Controller;
// 定义类并且继承父类控制器
class KnowledgeController extends CommonController
{
	// 定义add方法用于展示渲染模板
	public function add()
	{
		$this -> display();
	}
	// 编写addOk方法负责接收表单的数据并且处理文件上传和制作缩略图，最后写入数据表中中
	// 接收数据
	// 处理文件上传
	// 制作缩略图
	// 入库
	// 跳转
	public function addOk()
	{
		// 判断当前是否是post请求
		if (IS_POST) {
			$post = I('post.');
			// 处理文件的上传
			if ($_FILES['thumb']['size'] > 0) {
				# code...
				// 配置
				$config = array(
					'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH);
				$upload = new \Think\Upload($config);
				// 开始上传
				$info = $upload ->uploadOne($_FILES['thumb']);
				// 对上传结果进行判断
				if ($info) {
					$post['picture'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
					// 制作缩略图
					$image = new \Think\Image();
					$image -> open(WORKING_PATH.$post['picture']);//传递图片的绝对地址
					$image ->thumb(100,100);
					// 保存图片
					$image -> save(WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename']);
					$post['thumb'] = UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];

				}
			}
			// 补上添加时间
			$post['addtime'] = time();
			$model = M('Knowledge');
			// 添加
			$result = $model -> add($post);
			if ($result) {
				$this -> success('添加成功',U('showList'),3);
			}else{
				$this -> error('添加失败',U('add'),3);
			}
		}
	}
	// 定义方法用于展示知识的列表
	public function showList()
	{
		// 实例化模型
		$model = M('Knowledge');
		// 查询数据
		$data = $model -> select();
		// 传递数给模板
		$this -> assign('data',$data);
		// 渲染模板
		$this -> display();
	}
	// f
}
 ?>
