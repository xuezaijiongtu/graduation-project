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

        //得到某个学生的详细信息
        public function getStudentInfo(){
            $Get = D("Student");
            $uid = $_POST['uid'];
            if(!empty($uid)){
                $info = $Get->Get($uid);
                echo json_encode($info);
            }
        }

        //修改功能
        public function edit(){
            if(isset($_POST['submit'])){
                $uid        = $_POST['uid']; 
                $name       = $_POST['name'];
                $sex        = $_POST['sex'];
                $xueyuan    = $_POST['xueyuan'];
                $zhuanye    = $_POST['zhuanye'];
                $class      = $_POST['class'];
                $grade      = $_POST['grade'];
                $year       = $_POST['year'];
                $type       = $_POST['type'];
                $long_num   = $_POST['long_num'];
                $email      = $_POST['email'];
            }else{
                echo '<script>alert("不正确操作!")</script>';
                echo '<script>history.go(-1)</script>';
            }
            if(!( !empty($uid) && !empty($name) && !empty($sex) && !empty($xueyuan)&& !empty($zhuanye) && !empty($class) && !empty($grade) && !empty($year)&&!empty($type))){
                echo '<script>alert("重要信息不能为空!")</script>';
                echo '<script>history.go(-1)</script>';
            }
            $Edit = D("Student");
            $Edit->Edit($uid, $name, $sex, $xueyuan, $zhuanye, $class, $grade, $year,$type, $long_num, $email);
            $this->allMsg();
        }
    }
?>