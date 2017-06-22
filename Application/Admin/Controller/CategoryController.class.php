<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/16
 * Time: 18:03
 */

namespace Admin\Controller;


use Think\Controller;

class CategoryController extends Controller
{
    public function categoryList(){
        $cate_data=M('category')->select();
        $cate_data=getTree($cate_data);
        $this->assign('cate_data',$cate_data);
        $this->display();
    }
    public function categoryAdd(){
        if(IS_POST){
            $data=I('post.');
            $res=M('category')->add($data);
            if($res){
                $this->success('添加成功',U('categoryList'));
            }
        }else{
            $cate_data=M('category')->select();

            //树形结构
            $cate_data=getTree($cate_data);
            $this->assign('cate_data',$cate_data);
            $this->display();
        }
    }
    public function categoryEdit(){
        if(IS_POST ){
            $data=I('post.');
            $res=M('category')->save($data);
            if($res){
                $this->success('修改成功',U('categoryList'));
            }else{
                $this->error('修改失败');
            }
        }else{
            //对应ID的详细信息
            $cate_id=I('cate_id');
            $cate_data=M('category')->find($cate_id);
            $this->assign('cate_data',$cate_data);
            //分类信息
            $cate=M('category')->select();
            $cate=getTree($cate);
            $this->assign('cate',$cate);
            $this->display();
        }

    }
    public function categoryDel(){
            $id=I('id');

            $d=M('category')->where('cate_pid='.$id)->find();
            if($d){
               $this->error('该目录有子元素') ;
            }else{
                $res=M('category')->delete($id);
                if($res){
                    $this->success('删除成功哦');
                }
            }
    }
}