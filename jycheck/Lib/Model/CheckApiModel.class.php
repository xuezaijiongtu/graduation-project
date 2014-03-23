<?php
	/*
	*@Description:考勤接口的Model层
	*@Author:学在囧途
	*/
	class CheckApiModel extends Model{
		private $dbhandle;        //句柄

		public function __construct(){
			$this->dbhandle = new model('checkrecord', '', '');
		}

		//创建record记录并返回记录ID
		public function getRecordId($teacher_id, $class_name, $lesson_id){
			$this->dbhandle->query("INSERT INTO checkrecord(tech_id, lesson_id, record_class, record_time) VALUES('".$teacher_id."', '".$lesson_id."', '".$class_name."', '".date("Y-m-d H:i:s", time())."')");
			return mysql_insert_id();
		}

		//更新record
		public function UpdataRecord($uid, $record_id){
			if(!empty($uid) && !empty($record_id)){
				$recordData = $this->dbhandle->query("SELECT record_come, record_info FROM checkrecord WHERE record_id = '".$record_id."'");
				if(empty($recordData[0]['record_info'])){
					$recordinfo['come_uidList'][0] = $uid;
					$info = json_encode($recordinfo);
				}else{
					$info    = json_decode($recordData[0]['record_info'], true);
					//判断该学生是否已经存在于考勤记录表中
					if(!in_array($uid, $info['come_uidList'])){
						$record_come = $recordData[0]['record_come'] + 1;
						$info['come_uidList'][]  = $uid;
					}else{
						$Msg['error'] = "请勿重复扫描该学生图书证进行考勤";
						echo json_encode($Msg);
						exit();
					}	
				}
				$info = json_encode($info);
				$this->dbhandle->query("UPDATE checkrecord SET record_come = '".$record_come."', record_info = '".$info."' WHERE record_id = '".$record_id."'");
			}
		}

		//commit考勤记录
		public function OnSetCheckRecord($record_id){
			if(!empty($record_id)){
				//获取班级名称
				$record       = $this->dbhandle->query("SELECT record_come ,record_class, record_info FROM checkrecord WHERE record_id = '".$record_id."'");
				$record_class = $record[0]['record_class'];
				$record_come  = $record[0]['record_come'];
				$record_info  = json_decode($record[0]['record_info'], true);
				$record_info  = $record_info['come_uidList'];

				//获取该班级总人数
				$class_num    = $this->GetClassNum($record_class);
				//var_dump($class_num);
				//获取班级所有人员的uid
				$allUid       = $this->GetClassAllUid($record_class);

				//入库record_info
				$info         = array();
				foreach ($allUid as $key => $value) {
					if(!in_array($value['uid'], $record_info)){
						$info['uncome_List'][] = $value['uid']; 
					}else{
						$info['come_uidList'][] = $value['uid'];
					}
				}
				//未签到人数
				$uncomeNum          = count($info['uncome_List']);
				//签到人数
				$comeNum            = count($info['come_uidList']);
				$info['comeNum']    = $comeNum;
				$info['uncomeNum']  = $uncomeNum;
				$info['sumNum']     = $class_num;
				$infoMsg            = json_encode($info);
				$this->dbhandle->query("UPDATE checkrecord SET record_uncome = '".$uncomeNum."', record_info = '".$infoMsg."' WHERE record_id = '".$record_id."'");
				$Msg['status']      = $record_class."此次考勤结束并有效";
				echo json_encode($Msg);

			}else{
				$Msg['error'] = "所提交的考勤记录表ID为空，请联系管理员";
				echo json_encode($Msg);
			}
		}

		//自动Commit考勤记录
		public function AutoCommitCheckRecord($setTime){
			//获取过期未Commit的Record
			$List = $this->dbhandle->query("SELECT record_id FROM checkrecord");
			foreach ($List as $key => $value) {
				$this->OnSetCheckRecord($value['record_id']);
			}
		}

		//根据班级名称获取班级总人数
		private function GetClassNum($class_name){
			if(!empty($class_name)){
				$class_num    = $this->dbhandle->query("SELECT COUNT(uid) AS num FROM student WHERE class = '".$class_name."'");
				$class_num    = $class_num[0]['num'];
				return $class_num;
			}else{
				return false;
			}
		}

		//根据班级名称获取该班级所有人的uid
		private function GetClassAllUid($class_name){
			if(!empty($class_name)){
				return $this->dbhandle->query("SELECT uid FROM student WHERE class = '".$class_name."'");
			}else{
				return false;
			}
		}
	}
?>