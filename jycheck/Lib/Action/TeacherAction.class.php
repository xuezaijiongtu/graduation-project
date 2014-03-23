<?php
    /**
    *@Description:教师管理部分
    *@Author:学在囧途
    */
    class TeacherAction extends RootAction{
        //显示教师所有信息
        public function allMsg(){
            $student     = D('Teacher');
            $pagesize    = 20;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $student->teacherList($pagefirst, $pagesize);
            $this->assign('data',$List);
            $this->assign('page',$student->page);
            $this->display('TeacherList');
        }

        //搜索功能
        public function Search(){
            $keyword     = trim($_POST['keyword']);
            $search      = D("Teacher");
            $result      = $search->Search($keyword);
            if(!empty($result)){
                $this->assign('data',$result);
                $this->display('TeacherList');
            }else{
                echo '<script>alert("没有找到你要查找的教师信息")</script>';
                echo '<script>history.go(-1)</script>';
            }
        }

        //删除功能
        public function delete(){
            $Del      = D("Teacher");
            $uid      = $_GET['uid'];
            $Del->Delete($uid);
            $this->allMsg();
        }

        //增加教师用户
        public function addTeacher(){
            if(!empty($_POST['tech_name']) && !empty($_POST['password'])){
                $AddTeacher = D("Teacher");
                $techName   = trim($_POST['tech_name']);
                $password   = md5(trim($_POST['password']));
                $AddTeacher->addTeacher($techName, $password);
                $this->allMsg();
            }else{
                echo '<script>alert("必要添加信息不能为空，请重新输入")</script>';
                echo '<script>history.go(-1)</script>';
            }

        }

        //修改教师用户信息
        public function Edit(){
            $tech_id     = $_POST['tech_id'];
            $tech_name   = $_POST['tech_name'];
            $tech_status = $_POST['tech_status']; 
            if(isset($tech_id) && isset($tech_name) && isset($tech_status)){
                $editInfo = D("Teacher");
                $info = $editInfo->editTeacherInfo($tech_id, $tech_name, $tech_status);
                $this->allMsg();
            }else{
                echo '<script>alert("必要添加信息不能为空，请重新输入")</script>';
                echo '<script>history.go(-1)</script>';
            }
        }

        //查询教师用户信息
        public function getTeachInfo(){
            $tech_id = $_POST['tech_id'];
            if(!empty($tech_id)){
                $getTeacherInfo = D("Teacher");
                $info = $getTeacherInfo->getTeacherInfo($tech_id);
                echo json_encode($info);
            }
        }
    }
?>