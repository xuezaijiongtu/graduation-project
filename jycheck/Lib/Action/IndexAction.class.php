<?php
class IndexAction extends RootAction {
    public function Index(){
    	$this->display('Index');
    }

   	//登出操作
	public function LoginOut(){
	   	header('Content-Type:text/html;charset=utf8');
	    unset($_SESSION['username']);
		unset($_SESSION['hash']);
		unset($_SESSION['timestamp']);
		session_destroy();
		$this->redirect('Login/Login', '', 1, '1秒后退出系统');
	}

	//清除缓存
	public function CacheClear(){
		$dir = ROOT."/jycheck/Runtime/Cache/";
	  	$dh  = opendir($dir);
	  	while($file=readdir($dh)){
		    if($file!="." && $file!=".."){
		        $fullpath=$dir."/".$file;
		        if(!is_dir($fullpath)){
		            unlink($fullpath);
		        }else{
		            deldir($fullpath);
		        }
		    }
		}
		$this->redirect('Index/welcome', '', 1, '缓存清除成功,1秒后跳转...');
	}

	//欢迎页面
	public function Welcome(){
		$this->display('Welcome');
	}

}