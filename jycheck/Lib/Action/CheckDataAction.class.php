<?php
    /**
    *@Description:考勤数据管理部分
    *@Author:学在囧途
    */
    class CheckDataAction extends RootAction{
        //显示用户所有信息
        public function allCheckMsg(){
            $DataList     = D('CheckData');
            $pagesize    = 10;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $DataList->DataList($pagefirst, $pagesize);
            $xueyuanList = $this->xueyuanList();
            $this->assign('xueyuan', $xueyuanList);
            $this->assign('data',$List);
            $this->assign('page',$DataList->page);
            $this->display('CheckDataList');
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
            $Del      = D("CheckData");
            $record_id      = $_GET['record_id'];
            $Del->Delete($record_id);
            $this->allMsg();
        }


        //根据record_id获取当次缺勤学生名字
        public function getAllUncomeStudentName(){
            $record_id = trim($_POST['record_id']);
            if(isset($record_id)){
                $record   = D("CheckData");
                $nameList = $record->getAllUncomeStudentName($record_id);
                echo json_encode($nameList);
            }else{
                return false;
            }
        }

        //根据record_id获取该次考勤人数
        public function getCheckNumInfo(){
            $record_id = trim($_POST['record_id']);
            if(isset($record_id)){
                $record = D("CheckData");
                $info   = $record->getCheckNumInfo($record_id);
                $info[0]['sum'] = $info[0]['record_come'] + $info[0]['record_uncome'];
                echo json_encode($info);
            }
        }

        //获取某个班级考勤数据
        public function CheckClassData(){
            $class_name = trim($_POST['class_name']);
            if(!empty($class_name)){
                $check = D("CheckData");
                $data  = $check->getClassData($class_name);
                echo json_encode($data);
            }
        }

        //显示所有考勤班级信息
        public function allClassCheckMsg(){
            $DataList    = D('CheckData');
            $pagesize    = 10;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            $pagefirst   = ($pageorder-1)*$pagesize;
            $List        = $DataList->getClassList($pagefirst, $pagesize);
            $xueyuanList = $this->xueyuanList();
            $this->assign('xueyuan', $xueyuanList);
            $this->assign('data',$List);
            $this->assign('page',$DataList->page);
            $this->display('CheckClassDataList');
        }
    }
?>