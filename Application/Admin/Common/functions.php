<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/16
 * Time: 19:09
 */
//输出数组的树形结构
function getTree($data,$pid=0,$level=0){
    static $a=array();
    foreach($data as $k=>$v){
        if($v['cate_pid']==$pid){
            $v['level']=$level;
            $a[]=$v;
            getTree($data,$v['id'],$level+1);
        }
    }
    return $a;
}
//上传文件的方法
function uploadFile(){
    $config = array(
        'maxSize'    =>    3145728,
        'rootPath'   =>    './Public/Uploads/',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,
        'subName'    =>    array('date','Ymd'),
    );
    $upload=new \Think\Upload($config);
    $res=$upload->upload();
    if(!$res){
        $this->error($upload->getError());
    }
    return $res;
}