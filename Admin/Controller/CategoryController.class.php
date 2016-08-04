<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;

class CategoryController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '分类管理',
			'second' => '分类列表',
			'btn' => '添加',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		$CategoryModel = D('Category');
		$info = $CategoryModel 
		->order('cat_path')
		-> select();
		// dump($info);die;
		$this -> assign('info',$info);
		$this -> display();
	}
	function tianjia()
	{
		$Category = D('Category');

		if (IS_POST) {
			// dump($_POST);die;
			$shuju = $Category -> create();
			// dump($shuju);die;
			if ($Category -> add($shuju)) {
				// echo 'okok';
				$this -> success('添加分类成功',U('showlist'));
			}else{
				$this -> success('添加分类失败',U('tianjia'));
			}
		}else{
		// 传递差异导航内容
			$daohang = array(
				'first' => '分类管理',
				'second' => '分类列表',
				'btn' => '添加',
				'btn_link' => U('tianjia')
				);
			$this -> assign('daohang',$daohang);
		}
		$catinfo = D('Category') 
		-> where(array('cat_level'=>array('in','0,1')))
		-> order('cat_path') 
		-> select();
		$this -> assign('catinfo',$catinfo);
		$this -> display();
	}
	//获取次级分类信息
    function getCatInfoB(){
        $cat_ida = I('get.cat_ida');

        //通过"cat_pid"就可以找到当前分类下的次级分类信息
        $catinfo = D('Category')
            ->where(array('cat_pid'=>$cat_ida))
            ->field('cat_id,cat_name')
            ->select();
        echo json_encode($catinfo); //[{},{},{}...]
        //[Object { cat_id="5", cat_name="电子书"}, Object { cat_id="6", cat_name="数字音乐"}, Object { cat_id="7", cat_name="音像"}]
    }
}