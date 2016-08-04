<?php 
// 定义命名空间
namespace Admin\Controller;
// 引入核心控制器
use Tool\AdminController;
// 引入验证码类元素
use Think\Verify;

class ManagerController extends AdminController
{
	public function login()
	{
		if(IS_POST){
			// 校验验证码
			// dump($_POST);
			$verify = new Verify();
			if ($verify->check($_POST['chknumber'])) {
				// 用户名，密码校验
				$name = $_POST['user'];
				$pwd = $_POST['pwd'];
				$info = D('Manager') -> where(array('mg_name'=>$name,'mg_pwd'=>$pwd)) -> find();
				// dump($info);die;
				if ($info!==null) {
					// session持久化信息
					session('admin_id',$info['mg_id']);
					session('admin_name',$info['mg_name']);
					// 跳转到后台
					$this -> redirect('Index/index');
				}else{
					echo '用户名或者密码错误';
				}
			}
				echo '验证码不正确';
			
		}
		$this -> display();
		// fetch没有输出模板的功能
	}
	// 退出方法
	public function logout()
	{
		session(null);//删除全部的session信息
		$this -> success('退出成功',U('Manager/login'));//退出到登录页面	
		// $this -> redirect('Manager/login');//退出到登录页面	
	}
	// 定义验证码的输出方法
	public function captcha()
	{
		// ob.clean();
		$config = array(
		'fontSize'  =>  14,// 验证码字体大小(px)
        'useCurve'  =>  false,// 是否画混淆曲线
        'useNoise'  =>  false,// 是否添加杂点	
        'imageH'    =>  30, // 验证码图片高度
        'imageW'    =>  100, // 验证码图片宽度
        'length'    =>  4, // 验证码位数
        'fontttf'   =>  '4.ttf'
			);
		// 实例化验证码类
		$verify = new Verify($config);

		// 输出验证码
		$verify -> entry();
	}	
	// 处理验证码的函数
	//客户端通过ajax，实现校验验证码
    function checkVerify(){
        $code = I('get.code');
        $very = new Verify();

        //Verify::check()方法对正确的验证码只允许验证一次
        //(验证成功的校验码就立即被删除了)
        //所以如下就是对check方法的具体实现
        $key = $this->auth_my_code($very,$very->seKey);
        // 验证码不能为空
        $secode = session($key);

        //对$code进行加密，在比较校验
        if($this->auth_my_code($very,strtoupper($code)) == $secode['verify_code']) {
            echo json_encode(array('flag'=>1,'cont'=>'验证码正确'));
        }else{
            echo json_encode(array('flag'=>2,'cont'=>'验证码错误'));
        }
    }

    private function auth_my_code($vry,$str){
        $key = substr(md5($vry->seKey), 5, 8);
        $str = substr(md5($str), 8, 10);
        return md5($key . $str);
    }
}
 ?>
