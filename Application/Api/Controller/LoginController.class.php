<?php
namespace Api\Controller;

use Common\Common\Controller\BaseController;
use Think\Controller;

class LoginController extends BaseController {

    public function login(){
        try {
            $param=[
                'name'=>I('post.name'),
                'password'=>I('post.password')
            ];
            $res=D('Login', 'Logic')->login($param);
            $this->response($res);
        } catch (\Exception $e) {
            $this->getExceptionError($e);
        }
    }

}