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
            $xueyuanList = $this->xueyuanList();
            $this->assign('xueyuan', $xueyuanList);
            $this->assign('data',$List);
            $this->assign('page',$lesson->page);
            $this->display('LessonList');
        }

        //显示学院列表
        public function xueyuanList(){
            $xueyuan = D("CheckData");
            $List    = $xueyuan->xueyuanList();
            return $List;
        }

        //增加课程信息
        public function addLesson(){
            $lesson = D('Lesson');
            if(isset($_POST['submit'])){
                if(!empty($_POST['xueyuan']) && !empty($_POST['lesson_name']) && !empty($_POST['teacher_name']) && !empty($_POST['xuefen']) && !empty($_POST['lesson_address'])){
                    $xueyuan = $_POST['xueyuan'];
                    $lessonName = $_POST['lesson_name'];
                    $teacherName = $_POST['teacher_name'];
                    $xuefen = $_POST['xuefen']; 
                    $lessonAddress = $_POST['lesson_address'];
                }else{
                    echo '<script>alert("必要添加信息不能为空，请重新输入")</script>';
                    echo '<script>history.go(-1)</script>';
                }
            }else{
                exit('非法入侵!');
            }
            $result = $lesson->lessonAdd($xueyuan, $lessonName, $teacherName, $xuefen, $lessonAddress);
            switch($result){
                case '11':
                    echo '<script>alert("所添加的课程重复了，请重新输入")</script>';
                    echo '<script>history.go(-1)</script>';
                    break;
                case '22':
                     echo '<script>alert("学院不存在，请重新输入")</script>';
                    echo '<script>history.go(-1)</script>';
                    break;
                default: 
                    if($result == '33'){
                        $this->allMsg();
                    }else{
                        echo '<script>alert("课程添加不成功!")</script>';
                        echo '<script>history.go(-1)</script>';
                    }
                    break;
            }
        }

        //删除课程信息
        public function deleteLesson(){
            $lessonID = isset($_GET['lesson_id'])?$_GET['lesson_id']:'';
            if(!empty($lessonID)){
               $lesson = D('Lesson');
               $lesson->lessonDelete($lessonID);
               $this->allMsg();
            }
        }

        //得到某一课程的详细信息
        public function getLessonInfo(){
            $lessonID =  isset($_POST['lessonid']) ? $_POST['lessonid'] : '';
            if(!empty($lessonID)){
                $lesson = D("Lesson");
                $info = $lesson->lessonInfoGet($lessonID);
                echo json_encode($info);
            }
        }

        //修改课程信息
        public function editLesson(){
            if(isset($_POST['submit'])){
                if(!empty($_POST['lesson_id']) && !empty($_POST['lesson_name']) && !empty($_POST['lesson_teacher']) && !empty($_POST['lesson_xuefen']) && !empty($_POST['lesson_address']) && !empty($_POST['xy_name'])){
                    $lessonID        = $_POST['lesson_id'];
                    $lessonName      = $_POST['lesson_name'];
                    $lessonTeacher   = $_POST['lesson_teacher'];
                    $lessonXueFen    = $_POST['lesson_xuefen'];
                    $lessonAddress   = $_POST['lesson_address'];
                    $xyName          = $_POST['xy_name'];
                }else{
                    echo '<script>alert("必要添加信息不能为空，请重新输入")</script>';
                    echo '<script>history.go(-1)</script>';
               } 
            }
            $lesson = D("Lesson");
            $result = $lesson->lessonEdit($lessonID, $lessonName, $lessonTeacher, $lessonXueFen, $lessonAddress, $xyName);
            switch($result){
                case '11':
                    echo '<script>alert("找不到该学院，请重新输入")</script>';
                    echo '<script>history.go(-1)</script>';
                    break;
                default: 
                    if($result){
                        $this->allMsg();
                    }else{
                        echo '<script>alert("课程修改不成功!")</script>';
                        echo '<script>history.go(-1)</script>';
                    }
                    break;
            }
        }

        //搜索功能
        public function searchLesson(){
            $keyword     = trim($_POST['keyword']);
            $lesson      = D("Lesson");
            $result      = $lesson->lessonSearch($keyword);
            if(!empty($result)){
                $this->assign('data',$result);
                $this->display('LessonList');
            }else{
                echo '<script>alert("没有找到你要查找的教师信息")</script>';
                echo '<script>history.go(-1)</script>';
            }
        }
    }

?>