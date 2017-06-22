<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/16
 * Time: 16:02
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Crypt\Driver\Think;

class GoodsController extends Controller
{
    public function goodsAdd(){
        if(IS_POST){
            $data=I('post.');
            if($_FILES){
                $res=uploadFile();
                //写入Pic的路径
                $data['goods_pic']=$res['goods_pic']['savepath'].$res['goods_pic']['savename'];
                //生成缩略图  写入路径
                $image=new \Think\Image();
                $image->open($data['goods_pic']);
                $image->thumb(100, 100)->save(UPLOAD.$res['goods_pic']['savepath'].'_thumb'.$res['goods_pic']['savename']);
                 $data['goods_smallpic']=$res['goods_pic']['savepath'].'_thumb'.$res['goods_pic']['savename'];
            }else{
                $message='但是没有上传文件哦';
            }

            $data['goods_addtime']=time();
            $res=M('goods')->add($data);
//            echo M('goods')->_sql();die;
            if($res){
                $this->success('添加商品成功'.$message,U('goodsList'));
            }else{
                $this->error('服务器繁忙');
            }
        }else{
            //商品品牌 只加载顶级分类
            $cate_data=M('category')->where('cate_pid=0')->select();
            $this->assign('cate_data',$cate_data);
            //加载品牌信息
            $brand_data=M('brand')->select();
            $this->assign('brand_data',$brand_data);
            $this->display();
        }

    }
    public function goodsEdit(){
        $this->display();
    }
    public function goodsList(){
        if(IS_POST){ fFWDA
            $str=I('str');
            //将brand all id字符串处理为数组
            $brand=I('brand');
            for($i=0;$i<strlen($brand);$i++){
                $d[$i]=$brand[$i];
            }

            //传来的各项条件的字符串形式 转化为数组
            $data=explode(';',$str);
            foreach ($data as $v){
                $vv=explode(',',$v);
                $formdata[$vv[0]]=$vv[1];
            }
            $where='1=1';
            if($formdata['cate_id'] && $brand==''){
                $where.=' and cate_id='.$formdata['cate_id'];
            }
            if($formdata['cate_id'] && $brand!='' && $formdata['brand_id']==0){
                for($i=0;$i<count($d);$i++){
                    if ($i==0){
                        $where.=' and brand_id='.$d[$i];
                    }else{
                        $where.=' or brand_id='.$d[$i];
                    }

                }
            }

            if($formdata['brand_id']){
                $where.=' and brand_id='.$formdata['brand_id'];
            }
            if($formdata['tuijian']){
                $where.=' and '.$formdata["tuijian"].'=1';
            }
            if($formdata['is_show']!=''){
                $where.=' and is_show='.$formdata['is_show'];
            }
            $data=M('goods')->where($where)->select();
//            echo M('goods')->_sql();
            $goodsStr=json_encode($data);
            echo $goodsStr;

        }else{
            //添加分类信息 供查询
            $cate_data=M('category')->select();
            $cate_data=getTree($cate_data);
            $this->assign('cate_data',$cate_data);
            //添加品牌信息 供查询
            $brand_data=M('brand')->select();
            $this->assign('brand_data',$brand_data);
            //所有的商品信息
            $data=M('goods')->select();
            $this->assign('goods_data',$data);
            $this->display();
        }

    }
    public function goodsTrash(){
        $this->display();
    }
    //接收ajax数据   用于改变商品的上下架状态
    public function showEdit(){
        $id=I('id');
        $tag=I('tag');
        $data['is_show']=$tag>0 ? 0 : 1;
        $res=M('goods')->where('id='.$id)->save($data);
        if($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }
    //接收ajax数据  用于查询对应的cate_id   下 所拥有的品牌
    public function cateEdit(){
        $cate_id=I('cate_id');
        foreach ($cate_id as $v){
            $brand[]=M(brand)->where('cate_id='.$v)->select();
        }
        foreach ($brand as $v){
            foreach ($v as $vv){
                $brand_data[]=$vv;
            }
        }
        $str=json_encode($brand_data);
        echo $str;
    }
}