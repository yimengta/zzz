<?php 
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model
{
	// 给一些字段设置自动完成，这些字段不在form表单体现
	protected $auto = array(
		array('add_time','time',1,'function'),//添加数据填充
		array('upd_time','time',3,'function'),//添加数据填充
		);
	// 插入成功后的回调方法
	protected function _after_insert($data,$options)
	{
		if (!empty($_POST['attr_id'])) {
			foreach ($_POST['goods_id'] as $k => $v) {
				foreach ($v as $kk => $vv) {
					$attr['goods_id'] = $data['goods_id'];
					$attr['attr_id'] = $k;
					$attr['goods_val'] = $vv;
					D('Goods_Attr')->add($arr);
				}
			}
		}
		// 处理扩展分类,把扩展分类添加到sp_goods_cat表中
		if (!empty($_POST['cat_ext_id'])) {
			foreach ($_POST['cat_ext_id'] as $kk => $vv) {
				if ($vv>0) {
					$arr2['goods_id'] = $data['goods_id'];
					$arr2['cat_id'] = $vv;
					D('GoodsCat') -> add($arr2);
				}
			}
		}
	}
}
