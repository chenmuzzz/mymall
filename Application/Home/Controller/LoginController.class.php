<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/6/15
 * Time: 16:23
 */

namespace Home\Controller;


use Think\Controller;

class LoginController extends Controller
{
    public function login(){
        layout('layout/layout_login');
        $this->display();
    }
    public function register(){
        layout('layout/layout_login');
        $this->display();
    }
}