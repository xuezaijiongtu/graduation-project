<?php
class ZhuanyeModel extends Model
{
    public $list;
    public $page;
    public function zhuanyeList($pagefirst, $pagesize){
        $num = $this->count();
        import('ORG.Util.Page');
        $page = new page($num,$pagesize);
        $this->page = $page->show();       
        $this->list = $this->query("SELECT zhuanye.*, xueyuan.xy_name AS xueyuan FROM zhuanye LEFT JOIN xueyuan ON zhuanye.xy_id = xueyuan.xy_id LIMIT {$pagefirst},{$pagesize}");
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
            $searchMsg = $this->query("SELECT zhuanye.*, xueyuan.xy_name AS xueyuan FROM zhuanye LEFT JOIN xueyuan ON zhuanye.xy_id = xueyuan.xy_id WHERE zhuanye.z_zhuanye LIKE '%".$keyword."%'");
            return $searchMsg;
        }
    }
}
?>