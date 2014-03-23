<?php
class TeacherModel extends Model
{
    public $list;
    public $page;
    public function TeacherList($pagefirst, $pagesize){
        $num = $this->count();
        import('ORG.Util.Page');
        $page = new page($num,$pagesize);
        $this->page = $page->show();       
        $this->list = $this->query("SELECT tech_id, tech_name, tech_status FROM teacher LIMIT {$pagefirst},{$pagesize}");
        if(!empty($this->list)){
            return $this->list;
        }else{
            return false;
        }
    }

	//搜索功能
    public function Search($keyword){
        $searchMsg = array();
        if(empty($keyword)){
            return $searchMsg;
        }else{
            $searchMsg = $this->query("SELECT * FROM teacher WHERE tech_name LIKE '%".$keyword."%'");
            return $searchMsg;
        }
    }

    //删除学生信息
    public function Delete($uid){
        $this->query("DELETE FROM teacher WHERE tech_id = '".$uid."'");
    }

    //添加教师用户
    public function addTeacher($techName, $password){
        $this->query("INSERT INTO teacher(tech_name, password) VALUES('".$techName."', '".$password."')");
    }

    //获取教师用户信息
    public function getTeacherInfo($tech_id){
        return $this->query("SELECT tech_id, tech_name, tech_status FROM teacher WHERE tech_id = '".$tech_id."'");
    }

    //修改教师用户信息
    public function editTeacherInfo($tech_id, $tech_name, $tech_status){
        $this->query("UPDATE teacher SET tech_name ='".$tech_name."', tech_status = '".$tech_status."' WHERE tech_id = '".$tech_id."'");
    }

}
?>