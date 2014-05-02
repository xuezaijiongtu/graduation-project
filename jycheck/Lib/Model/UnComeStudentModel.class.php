<?php
    class UnComeStudentModel extends Model{
        //获取所有缺勤学生的UID
        public function getAllUncomeStudentUID(){
            $infoJson = $this->query("SELECT record_info FROM checkrecord");
            $number = count($infoJson);
            for($i = 0; $i < $number; $i++) {
                $info = json_decode($infoJson[$i]['record_info'], true);
                $uncomeStudentUid[] = $info['uncome_List'];
            }
            return $uncomeStudentUid;
        }

        //获取所有学生的UID
        public function getAllStudentUID(){
            return $studentUID = $this->query("SELECT uid FROM student");
        }

        //根据某个UID获取学生的信息
        public function getStudentInfo($uid){
            return $studentInfo = $this->query("SELECT uid, name, sex, xueyuan, zhuanye, class, grade, year, type FROM student WHERE uid = '".$uid."'"); 
        }

        //根据某学生的UID获取该学生所逃课程的信息
        public function getUncomelesson($uid){
            $uncomeStudentUid = $this->getAllUncomeStudentUID();
            $lesson_id_array = $this->query("SELECT lesson_id FROM checkrecord");
            $time_array = $this->query("SELECT record_time FROM checkrecord");
            $lesson_number = count($lesson_id_array);
            for($x = 0; $x < $lesson_number; $x++) {
                $time = split(' ',$time_array[$x]['record_time']);
                $data = $time['0'];
                if(in_array($uid, $uncomeStudentUid[$x])){
                    $lessoninfo = $this->query("SELECT lesson_name, lesson_teacher,lesson_address FROM lesson WHERE lesson_id = '".$lesson_id_array[$x]['lesson_id']."'");
                    $array = array(trim('课程名称:'.$lessoninfo[0]['lesson_name'].' 课程老师:'.$lessoninfo[0]['lesson_teacher'].' 上课时间:'.$data.' 上课地点:'.$lessoninfo[0]['lesson_address'].'<br/>'));
                    $lessonInfo[] = $array;
                }
            }
            return $lessonInfo;    
        }

        //将逃课的学生的个人信息入库
        public function AddInfoToDatabase(){
        	//逃课学生的uid
            $UnComeStudentUid = $this->getAllUncomeStudentUID();
            //所有学生的uid
            $studentUID = $this->getAllStudentUID();
            foreach($studentUID as $key => $uidarray) {
                $uncomeNumber = 0;
                //判断学生的逃课次数
                foreach($UnComeStudentUid as $key => $uncomeUid) {
                    if(in_array($uidarray['uid'], $uncomeUid)){
                        $uncomeNumber += 1; 
                    }
                }
                //获取逃课的学生的个人信息
                if ($uncomeNumber > 0) {
                    $result = $this->query("SELECT uid FROM uncomestudent WHERE uid='".$uidarray['uid']."'");
                    if($result){
                    	$this->query("UPDATE uncomestudent set uncome_number='".$uncomeNumber."' WHERE uid='".$uidarray['uid']."'");
                    }else{
                    	//return 'right';
                        $unComeStudentInfo = $this->getStudentInfo($uidarray['uid']);
                        array_push($unComeStudentInfo[0], $uncomeNumber);
                        $UnComeStudentInfo = $unComeStudentInfo[0];
                        //return $UnComeStudentInfo;
                      //  $ee = $this->query("INSERT INTO uncomestudent(`uid`,`name`,`sex`,`xueyuan`,`zhuanye`,`class`,`grade`,`type`,`uncome_number`) values('".$UnComeStudentInfo['uid']."','".$UnComeStudentInfo['name']."','".$UnComeStudentInfo['sex']."','".$UnComeStudentInfo['xueyuan']."','".$UnComeStudentInfo['zhuanye']."','".$UnComeStudentInfo['class'].",".$UnComeStudentInfo['grade']."','"$UnComeStudentInfo['type']."','".$UnComeStudentInfo['0']).')';
                        if($ee){
                        	return 'right';
                        }else{
                        	return 'error';
                        }
                    }
                }
            }
        }

         
    }

?>