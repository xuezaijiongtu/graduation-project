<?php
    /**
    *
    *
    */
    class UnComeStudentAction extends RootAction{
        //显示所有缺勤的学生的信息
        public function unComeStudentInfo(){
            $UnComeStudent = D('UnComeStudent');
            //缺勤学生的uid
            $UnComeStudentUid = $UnComeStudent->getAllUncomeStudentUID();
            //所有学生的uid
            $studentUID = $UnComeStudent->getAllStudentUID();
            //print_r($studentUID);
            foreach($studentUID as $key => $uidarray) {
                $uncomeNumber = 0;
                //判断学生的逃课次数
                foreach($UnComeStudentUid as $key => $uncomeUid) {
                    if(in_array($uidarray['uid'], $uncomeUid)){
                        $uncomeNumber += 1; 
                    }
                }

                //获取逃课的学生的信息
                if ($uncomeNumber > 0) {
                    //记录逃课学生的数目
                    $uncomeStudentNumber[] = $uncomeNumber;
                    $unComeStudentInfo = $UnComeStudent->getStudentInfo($uidarray['uid']);
                    array_push($unComeStudentInfo[0], $uncomeNumber);
                    $UnComeStudentInfo[] = $unComeStudentInfo[0];
                }
            }
            //print_r($UnComeStudentInfo);
            //逃课学生的总人数
            $UnComeStudentNumber = count($uncomeStudentNumber); 
            $pagesize    = 10;
            $pageorder   = (isset($_GET['p']))?$_GET['p']:1;
            import('ORG.Util.Page');
            $page = new page($UnComeStudentNumber, $pagesize);   
            $pagefirst   = ($pageorder-1)*$pagesize;
            $pageend = $pagefirst + $pagesize;
            $array = array_splice($UnComeStudentInfo, $pagefirst, $pageend);    
            $this->assign('data', $array);
            $this->assign('page', $page->show());
            $this->display('UnComeStudentList');  
        }

        //显示缺勤学生的详细缺勤信息
        public function getUnComeStudentLessonInfo(){
            $uid = trim($_POST['uncomeuid']);
            if(isset($uid)){
                $UnComeStudent = D('UnComeStudent');
                $lessonInfoList = $UnComeStudent->getUncomelesson($uid);
                echo json_encode($lessonInfoList);
            }else{
                return false;
            }         
        }
    }
?>