<?php 
namespace Home\Model;
use Think\Model;
// 定义模型类
class TestModel extends Model
{
	protected function _after_insert($data,$options)
	{
		$auto=array(array('add_time','time',1,'function'));
	}
}
