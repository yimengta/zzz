<?php 
// 声明命名空间
namespace Admin\Model;
// 引入父类的模型元素
use Think\Model;

class DeptModel extends Model
{
	// 字段定义
	protected $fields = array('id','name','pid','sort','remark');
	// 字段映射
	// protected $_map = array(
	// 	'deptname' => 'name',//将模板中的deptname与数据表中的name字段映射
	// 	);
}
 ?>
