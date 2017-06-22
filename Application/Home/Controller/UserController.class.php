<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/15
 * Time: 16:05
 */

namespace Home\Controller;


use Think\Controller;

class UserController extends Controller
{
    public function userCenter(){
        layout(true);
        $this->display();
    }
    public function userAddress(){
        layout(true);
        $this->display();
    }
    public function userOrder(){
        layout(true);
        $this->display();
    }
}