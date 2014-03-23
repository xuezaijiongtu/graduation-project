<?php
	//fridaysystem分组控制ACTION器
	class RootAction extends Action{
		public function __construct(){
			parent::__construct();
			if(empty($_SESSION['username']) || empty($_SESSION['timestamp']) || empty($_SESSION['secret'])){
	    		$_SESSION['backUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	    		$this->display('Login:Login');
	    		exit;
	    	}
		}
	}
?>