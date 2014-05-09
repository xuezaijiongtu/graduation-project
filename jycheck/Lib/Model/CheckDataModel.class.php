<?php
class CheckDataModel extends Model{
    public $list;
    public $page;
    public function DataList($pagefirst, $pagesize){
        $check = new model("checkrecord", "", "");
        $num = $check->count();
        import('ORG.Util.Page');
        $page = new page($num,$pagesize);
        $this->page = $page->show();       
        $this->list = $this->query("SELECT checkrecord.*, lesson.*, teacher.* FROM checkrecord LEFT JOIN lesson ON checkrecord.lesson_id = lesson.lesson_id LEFT JOIN teacher ON checkrecord.tech_id = teacher.tech_id ORDER BY checkrecord.record_time DESC LIMIT {$pagefirst},{$pagesize}");
        if(!empty($this->list)){
            return $this->list;
        }else{
            return false;
        }
    }

    //学院列表
    public function xueyuanList(){
        return $this->query("SELECT * FROM xueyuan");
    }
    
    //搜索功能
    public function Search($xueyuan, $keyword){
        if(!empty($xueyuan) && !empty($keyword)){
            //学院名称不为空，课程名称也不为空
            $tech_id = $this->query("SELECT tech_id FROM teacher WHERE tech_name = (SELECT lesson_teacher FROM lesson WHERE lesson_name LIKE '%".$keyword."%')");
            $lesson_id = $this->query("SELECT lesson_id FROM lesson WHERE lesson_name LIKE '%".$keyword."%' and xy_id = (SELECT xy_id FROM xueyuan WHERE xy_name LIKE '%".$xueyuan."%')");
            $searchMsg = $this->query("SELECT checkrecord.*, lesson.*, teacher.* FROM checkrecord LEFT JOIN teacher ON checkrecord.tech_id = teacher.tech_id = '".$tech_id[0]['tech_id']."' LEFT JOIN lesson ON checkrecord.lesson_id = lesson.lesson_id WHERE lesson.lesson_id = '".$lesson_id[0]['lesson_id']."'");
        }elseif(!empty($keyword)){
            //学院名称为空，课程名称不为空
            $searchMsg = $this->query("SELECT checkrecord.*, lesson.*, teacher.* FROM checkrecord LEFT JOIN lesson ON checkrecord.lesson_id = lesson.lesson_id LEFT JOIN teacher ON checkrecord.tech_id = teacher.tech_id WHERE lesson.lesson_name = '".$keyword."' ORDER BY checkrecord.record_time DESC;");
        }elseif(!empty($xueyuan)){
            //学院名称不为空，课程名称为空
            $tech_id = $this->query("SELECT tech_id FROM teacher WHERE xy_id = (SELECT xy_id FROM xueyuan WHERE xy_name LIKE '%".$xueyuan."%')");
            $searchMsg = $this->query("SELECT checkrecord.*, lesson.*, teacher.* FROM checkrecord LEFT JOIN lesson ON checkrecord.lesson_id = lesson.lesson_id LEFT JOIN teacher ON checkrecord.tech_id = teacher.tech_id = '".$tech_id."' ORDER BY checkrecord.record_time DESC;");
        }else{
            $searchMsg = array();
        }
            return $searchMsg;
    }

    //删除考勤记录
    public function Delete($record_id){
        $this->query("DELETE FROM checkrecord WHERE record_id = '".$record_id."'");
    }

    //根据record_id获取缺勤学生姓名
    public function getAllUncomeStudentName($record_id){
        $infoJson = $this->query("SELECT record_info FROM checkrecord WHERE record_id = '".$record_id."'");
        $info = json_decode($infoJson[0]['record_info'], true);
        $info = $info['uncome_List'];
        $returnNameList = "";
        foreach ($info as $key => $value) {
            $name = $this->query("SELECT name FROM student WHERE uid = '".$value."'");
            $name = $name[0]['name'];
            if($value == end($info)){
                $returnNameList .= $name; 
            }else{
                $returnNameList .= $name.",";
            }
        }
        $Msg['studentName'] = $returnNameList;
        return $Msg;
    }

    //获取考勤数量信息
    public function getCheckNumInfo($record_id){
        return $this->query("SELECT record_come, record_uncome FROM checkrecord WHERE record_id = '".$record_id."'");
    }

    //获取某个班级考勤数据
    public function getClassData($class_name){
        return $this->query("SELECT record_uncome, DATE_FORMAT(record_time, '%m-%d') AS record_time FROM checkrecord WHERE record_class = '".$class_name."' ORDER BY record_time");
    }

    //获取考勤班级列表
    public function getClassList($pagefirst, $pagesize){
        $check = new model("checkrecord", "", "");
        $num = $check->query("SELECT COUNT(DISTINCT record_class) AS num FROM checkrecord");
        $num = $num[0]['num'];
        import('ORG.Util.Page');
        $page = new page($num,$pagesize);
        $this->page = $page->show();  
        return $this->query("SELECT DISTINCT record_class FROM checkrecord LIMIT {$pagefirst},{$pagesize}");
    }
}
?>