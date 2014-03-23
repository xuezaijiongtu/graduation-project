<?php
	/*
	*@Description:考勤数据生成测试用例
	*@Author:学在囧途
	*/
	class UtilTestAction extends Action{
		private $UtilHandle;
		private $RandomLessonNum = 5;
		public function __construct(){
			$this->UtilHandle = D('UtilTest');
		}
		//入口方法
		public function Run(){
			$lessonList = $this->RandomLessonOfEach();
			echo json_encode($lessonList);
		}

		//随机生成所有学院相等数量的随机课程
		private function RandomLessonOfEach(){
			return $this->UtilHandle->getRandomLessonMsg($this->RandomLessonNum);
		}

		//为生成的随机课程，填充课程表、教师表中的信息
		private function FillDataOfLesson(){

		}

		//为课程所属班级，生成5次随机考勤记录
		private function RandCheckRecordForEachClass($lesson_id){

		}


	}
?>