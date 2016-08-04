<?php 
namespace Admin\Model;
use Think\Model;
class AttributeModel extends Model
{
	//表单验证
	protected $_validate = array(
		array('attr_name','require','属性名称必填'),
		array('type_id','','类型必须选择一个',0,'notequal')
		);
}
