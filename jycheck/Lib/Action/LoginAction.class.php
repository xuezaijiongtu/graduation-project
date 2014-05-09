<?php
	class LoginAction extends Action{
		//检验登陆
		public function CheckLogin(){
			if(!empty($_POST)){
				if($_SESSION['verify'] == md5($_POST['checkcode'])){
					$username  = trim($_POST['username']);
					$password  = md5(sha1(trim($_POST['password'])).C('Salt'));
					$checkcode = trim($_POST['checkcode']);
					$user = D("Admin");
                    $re = $user->AdminLogin($username, $password);
					if($re){
							$_SESSION['username']  = $username;
							$_SESSION['timestamp'] = time();
							$_SESSION['secret']    = sha1($username.$password);
							$data['status']        = 1;
							if(!empty($_SESSION['backUrl'])){
								$data['backUrl'] = $_SESSION['backUrl'];
							}
							echo json_encode($data);
					}else{
						$data['msg'] = '用户名或密码错误';
						echo json_encode($data);
					}
				}else{
					$data['msg'] = '验证码错误';
					echo json_encode($data);
				}
			}
		}

		//login页面调用
		public function Login(){
			$this->display('Login');
		}

		//验证码
	    public function CheckCode(){
	    	import('ORG.Util.Image');
	        Image::buildImageVerify();
	    }

	}
?>