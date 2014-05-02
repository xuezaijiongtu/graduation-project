<?php
    /**
    *@Description:专业管理部分
    *@Author:学在囧途
    */
    class ZhuanyeAction extends RootAction{
        //显示所有专业信息
        public function allMsg(){
            $zhuanye     = D('Zhuanye');
            $pagesize    = 20;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $zhuanye->zhuanyeList($pagefirst, $pagesize);
            $this->assign('data',$List);
            $this->assign('page',$zhuanye->page);
            $this->display('ZhuanyeList');
        }

        //搜索功能
        public function Search(){
            $keyword     = trim($_POST['keyword']);
            $search      = D("Zhuanye");
            $result      = $search->Search($keyword);
            if(!empty($result)){
                $this->assign('data',$result);
                $this->display('ZhuanyeList');
            }else{
                echo '<script>alert("没有找到你要查找的专业信息")</script>';
                echo '<script>history.go(-1)</script>';
            }
        }
    }
?>