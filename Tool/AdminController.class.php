<?php 
namespace Tool;
use Think\Controller;
class AdminController extends Controller{
	public function __construct()
	{
		parent::__construct();
	}
	// thinkphp中封装的构造方法
	public function _initialize(){
		$admin_id = session('admin_id');
		$admin_name = session('admin_name');
		//当前访问的权限与对应的权限做对比
		// 正访问的权限
		$nowac = CONTROLLER_NAME.'-'.ACTION_NAME;
		if (!empty($admin_name)) {
			
			$role_auth_ac  = D('Manager')
			-> alias('m')
			-> join('left join __ROLE__ r on m.role_id=r.role_id')
			-> where(array('m.mg_id'=>$admin_id))
			-> getField('r.role_auth_ac');
			// get
			// 定义不需要控制，任何用户都可以访问的权限
			$allowac = "Manager-logout,Manager-login,Manager-captcha,Manager-checkVerify,Index-index,Index-left,Index-right,Index-center,Index-top,Index-down";
			if (strpos($role_auth_ac,$nowac)===false && strpos($allowac,$nowac)===false && $admin_name!='admin') {
				exit('没有访问权限');
			}
		}else{
			//跳转到登陆页面
			// 有几个页面，无论是否是登陆状态，都让访问
			$allowac = "Manager-logout,Manager-login,Manager-captcha,Manager-checkVerify";
			if (strpos($allowac,$nowac)===false){
				// $this -> redirect('Manager/login');
				$js=<<<eof
					<script type="text/javascript">
					window.top.location.href = "/Admin/Manager/login";
					</script>
eof;
				echo $js;
			}	
		}
	}
}