<?php 
namespace Admin\Controller;
use Tool\AdminController;
class GoodsController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '商品管理',
			'second' => '商品列表',
			'btn' => '添加商品',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);
		// 测试数据库是否连接成功
		$goodsModel = D('Goods');
		// dump($goodsModel);die;
		$info = $goodsModel -> field('goods_id,goods_name,goods_shop_price,goods_number,goods_weight,goods_introduce') -> select();
		$this -> assign('info',$info);
		$this -> display();
	}
	// 定义添加商品的方法
	public function tianjia()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '商品管理',
			'second' => '商品列表',
			'btn' => '添加商品',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		// 将商品属性展现给添加页面
		$attrmodel = D('Type');
		$attrinfo = $attrmodel -> select();
		// dump($attrinfo);die;
		$this -> assign('attrinfo',$attrinfo);
		// 实例化模型
		$catinfo = D('Category')->where(array('cat_level'=>'0'))->select();
		$this -> assign('catinfo',$catinfo);

		$goods = D('Goods');
		if (IS_POST) {
			// dump(I('post.'));die;
			$data = $goods -> create();//过滤全部的$_POST的数据
			// 填充必须的表单域信息值
			$data['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
			$data['add_time'] = $data['upd_time'] = time();
			// 实现商品logo图片你的上传处理
			$this -> deal_logo($data);

			if ($newid = $goods -> add($data)) {
				// $this -> deal_pics($newid);
				$this -> success('添加数据成功',U('showlist',1));
			}else{
				$this -> error('添加数据失败',U('tianjia'),1);
			}
		}
		$this -> display();
	}
	// 实现商品logo图片的上传处理
	private function deal_logo(&$data)
	{
		// dump($_FILES);die;
		if ($_FILES['goods_logo']['error']===0) {
			// 附件没有问题，才进行后续处理
			$config = array(
				'rootPath' => './Public/Uploads/',//保存的路径
				'exts' => array('jpg','jpeg','png','gif')
			);
			$up = new \Think\Upload($config);
			$z =$up -> uploadOne($_FILES['goods_logo']);
			// dump($z);die;
		// 把上传好的附件保存到数据库中
			$big_path_name = $up -> rootPath.$z['savepath'].$z['savename'];//路径名
			$data['goods_big_logo'] = $big_path_name;

			// 给logo图片制作缩略图,具体通过\think\image.class.php实现
			$img = new \Think\Image();
			$img -> open($big_path_name);//打开原图
			$img -> thumb(200,200,6);//做缩略图
			$good_small_logo_name = $up -> rootPath.$z['savepath'].'s_'.$z['savename'];
			$img -> save($good_small_logo_name);//输出保存缩略图
			$data['good_small_logo'] = $small_path_name;
		}
		
	}
	public function update()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '商品管理',
			'second' => '商品列表',
			'btn' => '添加商品',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		
		$goods_id = I('get.goods_id');
		// dump($goods_id);die;
		// 查询被修改的商品信息
		$goodsModel = D('Goods');
		if (IS_POST) {
			$shuju = $goods -> create();
			$shuju['goods_introduce'] = \fangXSS($_POST['goods_introduce']);
			if ($goods->save($shuju)){
				$this -> success('修改商品成功',I('showlist'));
			}else{
				$this -> error('修改商品失败',U('upd',array('goods_id'=>$goods_id)));
			}
		}else{
			$this -> error($goodsModel -> getError());
		}
		$data  = D('Goods') -> find($goods_id);
		$this -> assign('info',$info);
		// 获取相册图片
		$picsinfo = D('GoodsPic') -> where(array('goods_id'=>$goods_id)) -> select();
		$this -> assign('picsinfo',$picsinfo);
		$this -> display();
	}
}
