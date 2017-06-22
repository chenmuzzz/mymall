<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/15
 * Time: 13:41
 */

namespace Home\Controller;


use Think\Controller;

class CartController extends Controller
{
    public function cartList(){
        layout('layout/layout_order');
        $this->display();
    }
}