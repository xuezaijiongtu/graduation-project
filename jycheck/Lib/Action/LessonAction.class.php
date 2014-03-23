<?php
    /*
    *@Description:课程操作类
    *@Author:学在囧途
    */
    class LessonAction extends RootAction{
        //显示课程所有信息
        public function allMsg(){
            $lesson     = D('Lesson');
            $pagesize    = 10;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $lesson->lessonList($pagefirst, $pagesize);
            $this->assign('data',$List);
            $this->assign('page',$lesson->page);
            $this->display('LessonList');
        }
    }

?>