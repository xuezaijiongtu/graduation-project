<?php
class AdminModel extends Model{
    //登陆验证
    public function AdminLogin($user, $pwd){
        if(!empty($user) && !empty($pwd)){
            $data                  = array();
            $data['name']          = $user;
            $result                = $this->where($data)->find();
            if($pwd == $result['password']){
                $Msg['last_login_time'] = date("Y-m-d H:i:s");
                $Msg['last_login_ip']   = get_client_ip();
                $this->query("UPDATE admin SET id = '".$result['id']."', last_login_ip = '". $Msg['last_login_ip']."', last_login_time ='". $Msg['last_login_time']."'");
                return true;
            }else{
                return false;
            }
        }
    }
    
}
?>