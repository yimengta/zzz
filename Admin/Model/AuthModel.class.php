<?php 
namespace Admin\Model;
use Think\Model;
class AuthModel extends Model
{
	// 插入成功后的毁掉方法
	protected function _after_insert($data,$options){
		dump($data);
		// dump($options);die;
		if ($data['auth_pid']==0) {
			$path = $data['auth_id'];
		}else{
			$path2 = $this 
			-> where(array('auth_id'=>$data['auth_pid']))
			->getField('auth_path');
			$path = $path2.'-'.$data['auth_id'];
		}
		// dump($path);
		// auto_level维护：全路径
		$level = substr_count($path,'-');
		$arr = array(
			'auth_id' => $data['auth_id'],
			'auth_path' => $path,
			'auth_level' => $level,
			);
		$this -> save($arr);
	}
}
