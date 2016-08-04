<?php 
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
	// 插入成功后的毁掉方法
	protected function _after_insert($data,$options){
		// dump($data);
		// dump($options);die;
		if ($data['cat_pid']==0) {
			$path = $data['cat_id'];
		}else{
			$path2 = $this 
			->where(array('cat_id'=>$data['cat_pid']))
			->getField('cat_path');
			$path = $path2 .'-'. $data['cat_id'];
		}
		// dump($path);die;
		// auto_level维护：全路径
		$level = substr_count($path,'-');
		$arr = array(
			'cat_id' => $data['cat_id'],
			'cat_path' => $path,
			'cat_level' => $level,
			);
		$this -> save($arr);
	}
}
