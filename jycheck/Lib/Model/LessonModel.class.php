<?php
    /*
    *@Description:课程操作类Model层
    *@Author:学在囧途
    */
    class LessonModel extends Model{
        public $list;
        public $page;

        //课程列表
        public function lessonList($pagefirst, $pagesize){
            $num = $this->count();
            import('ORG.Util.Page');
            $page = new page($num,$pagesize);
            $this->page = $page->show();       
            $this->list = $this->query("SELECT lesson.*, xueyuan.* FROM lesson LEFT JOIN xueyuan ON lesson.xy_id = xueyuan.xy_id LIMIT {$pagefirst},{$pagesize}");
            if(!empty($this->list)){
                return $this->list;
            }else{
                return false;
            }
        }

        //根据课程名获得课程ID
        public function getLessonId($lesson_name){
            return $this->query("SELECT lesson_id FROM lesson WHERE lesson_name = '".$lesson_name."'");
		}
        //增加课程信息
        public function lessonAdd($xueyuan, $lessonName, $teacherName, $xuefen, $lessonAddress){
            //判断添加的课程是否重复
            $isexists = $this->query("SELECT lesson_id FROM lesson WHERE lesson_name ='".$lessonName."'");
            if($isexists[0]['lesson_id'] > 0){
               return '11';
            }
            $xueyuan = $this->query("SELECT xy_id FROM xueyuan WHERE xy_name = '".$xueyuan."'");
            if(($xy_id = $xueyuan[0]['xy_id']) < 0){
               return '22';
            }
            $result = $this->query("INSERT INTO lesson(`lesson_name`,`lesson_teacher`,`lesson_xuefen`,`lesson_address`,`xy_id`) VALUES('".$lessonName."','".$teacherName."','".$xuefen."','".$lessonAddress."','".$xy_id."')");
            return '33';
        }

        //删除课程信息
        public function lessonDelete($lessonID){
            $this->query("DELETE FROM lesson WHERE lesson_id = '".$lessonID."'");
        }

        //获取教师用户信息
        public function lessonInfoGet($lessonID){
            return $this->query("SELECT lesson.*, xueyuan.* FROM lesson LEFT JOIN xueyuan ON lesson.xy_id = xueyuan.xy_id WHERE lesson.lesson_id = '".$lessonID."'");
        }

        //修改课程信息
        public function lessonEdit($lessonID, $lessonName, $lessonTeacher, $lessonXueFen, $lessonAddress, $xyName){
            $xueyuan = $this->query("SELECT xy_id FROM xueyuan WHERE xy_name LIKE '%".$xyName."%'");
            $xy_id = $xueyuan[0]['xy_id']; 
            if($xy_id < 0){
                return '11';
            } 
            $result = $this->query("UPDATE lesson SET lesson_name = '".$lessonName."', lesson_teacher = '".$lessonTeacher."', lesson_xuefen = '".$lessonXueFen."', lesson_address = '".$lessonAddress."', xy_id = '".$xy_id."' WHERE lesson_id = '".$lessonID."'");
            if(!$result){
                return 'true';
            }
        }

        //搜索功能
        public function lessonSearch($keyword){
            $searchMsg = array();
            if(empty($keyword)){
                return $searchMsg;
            }else{
                $searchMsg = $this->query("SELECT * FROM lesson WHERE lesson_name LIKE '%".$keyword."%'");
                return $searchMsg;
            }
        }
    }

?>