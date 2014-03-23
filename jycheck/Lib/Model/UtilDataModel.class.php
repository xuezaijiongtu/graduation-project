<?php
   /*
	*@Description:考勤数据生成测试用例
	*@Author:学在囧途
	*/
	class UtilDataModel extends Model{
		//获取一定数量某学院的课程信息
		public function getRandomLessonMsg($num){
			if(isset($num)){
				$xueyuan     = new model("xueyuan", "", "");
				$xueyuanList = $xueyuan->query("SELECT * FROM zhuanyelesson WHERE l_studentxueyuan IN (SELECT xy_name FROM xueyuan)");
			}else{
				return false;
			}
		}
	}
?>