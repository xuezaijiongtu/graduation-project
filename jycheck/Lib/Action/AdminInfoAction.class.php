<?php
class AdminInfoAction extends RootAction
{
    //用户信息展示
    public function InfoShow()
    {
        $user = $_SESSION['username'];
        $admin = M("admin");
        $infos = $admin->where("name = '{$user}'")->field('name')->find();
        $this->assign('infos',$infos);
        $this->display('adminInfo');
    }
    
    //用户信息修改
    public function InfoChange()
    {
        $oldpwd = md5(sha1(trim($_POST['oldpwd'])).C('Salt'));
        $oldinfos = array();
        $oldinfos['name'] = $_SESSION['username'];
        $oldinfos['password'] = $oldpwd;
        $user = M('admin');
        $re = $user->where($oldinfos)->find();
        if($re)
        {
            $user->create($re);
            $user->name = $_POST['username'];
            $user->password = md5(sha1(trim($_POST['newpwd'])).C('Salt'));
            $ud = $user->save();
            if($ud)
            {
                $this->success("修改成功！");
            }
            else
            {
                $this->error("修改失败！");	
            }
        }
        else
        {
            $this->error("旧密码不正确",U('InfoShow'));    
        }
    }
}
?>