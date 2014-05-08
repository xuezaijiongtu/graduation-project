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
    }

?>