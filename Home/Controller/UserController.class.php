<?php 
// 声明命名空间
namespace Home\Controller;
use Tool\HomeController;
// 引入验证码类元素
use Think\Verify;

class UserController extends HomeController
{
	public function login(){
        $this -> display();
    }

    public function regist(){
    	$user = D('User');
    	if (IS_POST) {
    		$shuju = $user -> create();
    		if ($user -> add($shuju)) {
    			$this -> redirect('Index/index');
    		}else{
    			$this -> redirect('regist');
    		}
    	}else{
        	$this -> display();
    	}
    }

    public function logout(){
        session(null);
        $this -> redirect('Index/index');
    }
}

