<?php
    /**
    *@Description:学生管理部分
    *@Author:学在囧途
    */
    class StudentAction extends RootAction{
        //显示用户所有信息
        public function allMsg(){
            $student     = D('Student');
            $pagesize    = 20;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $student->studentList($pagefirst, $pagesize);
            $xueyuanList = $this->xueyuanList();
            $this->assign('xueyuan', $xueyuanList);
            $this->assign('data',$List);
            $this->assign('page',$student->page);
            $this->display('StudentList');
        }

        //显示学院列表
        public function xueyuanList(){
            $xueyuan = D("Student");
            $List    = $xueyuan->xueyuanList();
            return $List;
        }

        //搜索功能
        public function Search(){
            $xueyuan     = trim($_POST['xueyuan']);
            $keyword     = trim($_POST['keyword']);
            $search      = D("Student");
            $result      = $search->Search($xueyuan, $keyword);
            if(!empty($result)){
                $xueyuanList = $this->xueyuanList();
                $this->assign('xueyuan', $xueyuanList);
                $this->assign('data',$result);
                $this->display('StudentList');
            }else{
                echo '<script>alert("没有找到你要查找的学生信息")</script>';
                echo '<script>history.go(-1)</script>';
            }
        }

        //删除功能
        public function delete(){
            $Del      = D("Student");
            $uid      = $_GET['uid'];
            $Del->Delete($uid);
            $this->allMsg();
        }
    }
?>