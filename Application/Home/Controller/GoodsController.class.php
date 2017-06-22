<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/15
 * Time: 15:20
 */

namespace Home\Controller;


use Think\Controller;

class GoodsController extends Controller
{
    public function goodsList(){
//        layout('layout/layout1');
        layout(true);
        $this->display();
    }
    public function goodsDetail(){
        layout(true);
        $this->display();
    }
}