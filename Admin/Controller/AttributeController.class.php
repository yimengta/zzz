<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;

class AttributeController extends AdminController
{
	public function showlist()
	{
		// 传递差异导航内容
		$daohang = array(
			'first' => '类型管理',
			'second' => '类型列表',
			'btn' => '添加',
			'btn_link' => U('tianjia')
			);
		$this -> assign('daohang',$daohang);

		$typeinfo = D('Type') -> select();
		$this -> assign('typeinfo',$typeinfo);

		$AttributeModel = D('Attribute');
		// dump($goodsModel);die;
		$info = $AttributeModel 
		-> alias('a')
		-> join('__TYPE__ t on a.type_id=t.type_id')
		-> field('a.*,t.type_name')
		-> select();
		$this -> assign('info',$info);
		$this -> display();
	}
	function tianjia()
	{
		$Attribute = D('Attribute');
		if (IS_POST) {
			$shuju = $Attribute -> create();
			if ($shuju === false) {
				$errorinfo = $Attribute->getError();
				$this -> assign('errorinfo',$errorinfo);
			}else{
				if ($Attribute -> add($shuju)) {
				// echo 'okok';
				$this -> success('添加商品类型成功',U('showlist'));
				}else{
					$this -> success('添加商品类型失败',U('tianjia'));
				}
				exit;
			}
			
		}
		// 传递差异导航内容
			$daohang = array(
				'first' => '类型管理',
				'second' => '类型列表',
				'btn' => '添加',
				'btn_link' => U('tianjia')
				);
			$this -> assign('daohang',$daohang);
			// 获得可选择类型的信息
			$typeinfo = D('Type') -> select();
			$this -> assign('typeinfo',$typeinfo);
			$this -> display();
	}
		
	
	// 根据类型信息获得对应的属性信息
	function getAttributeByType(){
        $type_id = I('get.type_id');
        $attrinfo = D('Attribute')
            ->alias('a')
            ->join('__TYPE__ t on a.type_id=t.type_id')
            ->field('a.*,t.type_name')
            ->where(array('a.type_id'=>$type_id))
            ->select();
        echo json_encode($attrinfo); //[{},{},{},{}....]
        //[Object { attr_id="1", attr_name="出版社", type_id="1", 更多...}, Object { attr_id="2", attr_name="作者", type_id="1", 更多...}, Object { attr_id="3", attr_name="出版日期", type_id="1", 更多...}, Object { attr_id="4", attr_name="字数", type_id="1", 更多...}]
    }
}