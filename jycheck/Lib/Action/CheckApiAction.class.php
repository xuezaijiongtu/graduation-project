<?php
	/*
	*@Description:考勤系统API接口
	*@Author:学在囧途
	*/
	class CheckApiAction extends Action{
		/*
		*@Description:创建考勤记录
		*/
		public function CreateCheckRecord(){
			$teacher_id = trim($_POST['teacher_id']);                    //教师ID
			$class_name = trim($_POST['class_name']);                    //考勤班级
			$lesson_name  = trim($_POST['lesson_name']);                     //考勤课程ID
			$lesson = D("Lesson");
			$lesson_msg = $lesson->getLessonId($lesson_name);
			$lesson_id  = $lesson_msg[0]['lesson_id'];
			if(!empty($teacher_id) && !empty($class_name) && !empty($lesson_id)){
				$record     = D('CheckApi');
				$record_id['record_id']  = $record->getRecordId($teacher_id, $class_name, $lesson_id);
				echo json_encode($record_id);
			}else{
				return false;
			}
		}

		/*
		*@Description:判断是否记录该次考勤记录，并返回该学生学生信息
		*/
		public function CheckAction(){
			$uid       = trim($_GET['student_id']);
			$record_id = trim($_GET['record_id']); 
			if(!empty($uid) && !empty($record_id)){
				$info = $this->GetStudentInfo($uid);
				if(!empty($info)){
					$record     = D('CheckApi');
					$record->UpdataRecord($uid, $record_id);
					echo json_encode($info);
				}else{
					$Msg['error'] = "该学生不存在";
					echo json_encode($Msg);
				}
			}else{
				$Msg['error'] = "参数student_id或record_id不能为空";
				echo json_encode($Msg);
			}
		}

		/*
		*@Description:获取学生信息
		*/
		private function GetStudentInfo($uid){
			if(!empty($uid)){
				$student = D('Student');
				return $student -> getStudentInfo($uid);
			}else{
				return false;
			}
		}

		/*
		*@Description:手动提交此次考勤
		*/
		public function OnSetCheckRecord(){
			$record_id = trim($_GET['record_id']);
			if(!empty($record_id)){
				$record    = D("CheckApi");
				//执行提交事务
				$status = $record->OnSetCheckRecord($record_id);
				return $status;
			}
		}

		/*
		*@Description:超过设置时间为提交考勤，系统自动提交考勤
		*/
		public function AutoSetCheckRecord(){
			$setTime = C("AutoCommitTime");
			$record  = D("CheckApi");
			$record->AutoCommitCheckRecord($setTime);
		}

		/**
		*教师登录
		*/
		public function login(){
			if(!empty($_POST)){
				$username   = $_POST['username'];
				$password   = $_POST['password'];
				$login      = D('CheckApi');
				$Msg        = $login->getUserMsg($username, $password);
				echo json_encode($Msg);
			}
		}

		//根据教师ID获取旗下所有课程和所教班级
		public function getFormMsg(){
			if(!empty($_GET)){
				$tech_id      = $_GET['tech_id'];
				$getFormMsg   = D('CheckApi');
				$Msg          = $getFormMsg->getFormMsg($tech_id);
				echo json_encode($Msg);
			}
		}
	}
?>