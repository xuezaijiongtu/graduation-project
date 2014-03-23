<?php
class StudentModel extends Model
{
    public $list;
    public $page;
    public function studentList($pagefirst, $pagesize){
        $num = $this->count();
        import('ORG.Util.Page');
        $page = new page($num,$pagesize);
        $this->page = $page->show();       
        $this->list = $this->query("SELECT uid, name, sex, xueyuan, zhuanye, class, grade, year, type, email, long_num FROM student LIMIT {$pagefirst},{$pagesize}");
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
        $searchMsg = array();
        if(empty($xueyuan)){
            if(empty($keyword)){
                return $searchMsg;
            }else{
                if(preg_match("/^\d*$/", $keyword)){
                    //如果keyword为学号
                    $searchMsg = $this->query("SELECT * FROM student WHERE uid = '".$keyword."'");
                }else{
                    //如果keyword为姓名
                    $searchMsg = $this->query("SELECT * FROM student WHERE name LIKE '%".$keyword."%'");
                }
                return $searchMsg;
            }
        }else{
            if(empty($keyword)){
                $searchMsg = $this->query("SELECT * FROM student WHERE xueyuan = '".$xueyuan."'");
            }else{
                if(preg_match("/[0-9]*/", $keyword)){
                    //如果keyword为学号
                    $searchMsg = $this->query("SELECT * FROM student WHERE name LIKE '%".$keyword."%' AND xueyuan = '".$xueyuan."'");
                }else{
                    //如果keyword为姓名
                    $searchMsg = $this->query("SELECT * FROM student WHERE uid = '".$keyword."' AND xueyuan = '".$xueyuan."'");
                }
            }
            return $searchMsg;
        }
    }

    //删除学生信息
    public function Delete($uid){
        $this->query("DELETE FROM student WHERE uid = '".$uid."'");
    }


    //获取学生信息
    public function getStudentInfo($uid){
        return $this->query("SELECT name, zhuanye, grade, xueyuan, sex FROM student WHERE uid = '".$uid."'");
    }

}
?>