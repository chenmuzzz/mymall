<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/15
 * Time: 13:47
 */

namespace Home\Controller;


use Think\Controller;

class OrderController extends Controller
{
    public function orderList(){
        layout('layout/layout_order');
        $this->display();
    }
    public function buy(){
        layout('layout/layout_order');
        $this->display();
    }
}