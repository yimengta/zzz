<?php 
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model
{
	protected function _before_update(&$data,$options){
		dump($data);
		dump($options);
		$authinfo = D('Auth') -> select($data['role_auth_ids']);
		// dump($authinfo);die;
		$s = array();
		foreach ($authinfo as $k => $v) {
			$s[] = $v['auth_c'].'-'.$v['auth_a'];
		}
		$s = implode(',',$s);
		//  "Goods-showlist,Order-dayin,Role-showlist,Auth-showlist"
		dump($s);
	}
}
