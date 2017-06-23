<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/16
 * Time: 17:19
 */

namespace Admin\Controller;


use Think\Controller;

class BrandController extends Controller
{
    public function brandAdd(){
        if(IS_POST){
            $data=I('post.');
            $res=M('brand')->add($data);
            if($res){
                $this->success('品牌添加成功',U('brandList'));
            }else{
                $this->error('服务器繁忙，稍后再试');
            }
        }else{
            $cate_data=M('category')->where('cate_pid=0')->select();
            $this->assign('cate_data',$cate_data);
            $this->display();
        }

    }
    public function brandList(){
        $brand_data=M('brand')->alias('a')->field('a.*,b.cate_name')->join('left join category as b on a.cate_id=b.id')->select();
        $this->assign('brand_data',$brand_data);
        $this->display();
    }
//接收商品添加页 商品分类的多级联动ajax请求
    public function sendAjax(){
        $id=I('id');
        $cate=M('category')->where('cate_pid='.$id)->select();
        $str=json_encode($cate);
        echo $str;
    }

    //修改品牌
    public function brandEdit(){
        $id=I('id');
        if(IS_POST){
            $data=I('post.');
            if($_FILES['brand_logo']['name']!=''){
                $res=uploadFile();
                $a=$res['brand_logo']['savepath'].$res['brand_logo']['savename'];
                $image=new \Think\Image();
                $image->open(UPLOAD.$a);
                $logo_path=$res['brand_logo']['savepath'].'_logo'.$res['brand_logo']['savename'];
                $image->thumb(50,50)->save(UPLOAD.$logo_path);
                $data['brand_logo']=$logo_path;
            }

            $res=M('brand')->save($data);
            if($res){
                $this->success('修改品牌成功哦',U('brandList'));
            }else{
                $this->error('服务器繁忙');
            }
        }else{
            //显示该ID下的默认信息
            $data=M('brand')->find($id);
            $this->assign('brand_data',$data);
            //cate id
            $cate_id=$data['cate_id'];
            //返回当前分类ID的 所有上级分类
            $data=$this->getParentCate($cate_id);
            //数组倒序
            $data=array_reverse($data);
            //查找各级PID的所有值
            foreach($data as $k=>$v){
                $cate_all[]=M('category')->where('cate_pid='.$v['cate_pid'])->field('id,cate_name')->select();
            }
            $this->assign('cate_all',$cate_all);
            $this->assign('cate_data',$data);
            $this->display();
        }
    }
    //返回当前分类ID的 所有上级分类
    public function getParentCate($cate_id){
        static $a=array();
        if($cate_id){
            $res=M('category')->field('id,cate_name,cate_pid')->where('id='.$cate_id)->find();
            if($res){
                $a[]=$res;
                $this->getParentCate($res['cate_pid']);
            }
        }
        return $a;
    }
    //删除
    public function brandDel(){
        $id=I('id');
        $res=M('brand')->delete($id);
        if($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}