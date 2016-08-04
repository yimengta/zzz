<?php 
// 命名空间
namespace Admin\Controller;
// 引入父类的元素
use Think\Controller;
// 定义控制器和继承父类
class CommonController extends Controller{
	// 构造方法
	// public function __construct()
	// {
	// 	parent::__construct();
	// }
	// // thinkphp中封装的构造方法
	// public function _initialize(){
	// 	// 判断用户是否登录
	// 	if (!session('uid')) {
	// 		$this -> error('请先登录',U('Public/login'),3);die();
	// 	}

	// 	// 获取当前的控制器去名和方法名
	// 	$controller = CONTROLLER_NAME;
	// 	$action = ACTION_NAME;
	// 	// 根据当前用户的用户组id取出它有的权限
	// 	$auth = C('RABC_AUTH');
	// 	$currentRoleAuth = $auth['AUTH'.session('role_id')];
	// 	// 
	// 	if (session('role_id') !=1) {
	// 		// 不是高层领导才会去进行验证
	// 		if (!in_array($controller . '/*' ,$currentRoleAuth) && !in_array($controller.'/'.$action,$currentRoleAuth)) {
	// 			// 没有权限处理
	// 			$this -> error('抱歉没有权限',U('Index/home'),3);
	// 		}
	// 	}
	// }
}
 ?>