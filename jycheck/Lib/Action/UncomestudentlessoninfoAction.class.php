<?php
	/**
	*
	*
	*/
	class UncomestudentlessoninfoAction extends RootAction{
		//显示学生的详细逃课信息
		public function showuncomestudentlessoninfo(){
			$uncomestudentlesson = D('Uncomestudentlessoninfo');
			$uncomestudentlessoninfo = $uncomestudentlesson->showinfo();
		}
	}
?>