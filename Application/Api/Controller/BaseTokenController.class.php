<?php
/**
 * Created by PhpStorm.
 * User: sheeran
 * Date: 2017/1/4
 * Time: 9:54
 */
namespace Api\Controller;

use Common\Common\Controller\BaseController;
use Common\Common\ErrorCode;

class BaseTokenController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->checkApiSecretParam();
        $login_user = $this->requireAuth();
        $this->_login_user = $login_user;
        $this->_login_user_id = $login_user['user_id'];
        $this->_login_user_type = $login_user['user_type'];
    }


    protected function checkApiSecretParam()
    {
        if (I('get.'.API_SECRET_PARAM) !== API_SECRET_CODE) {
            $this->_empty();
        }
    }

    /**
     * 用户
     */
    public function isUser()
    {
        if ($this->_login_user_type!='user') {
            $this->fail(ErrorCode::SYS_PERMISSION_DENY);
        }
    }

    /**
     * 后台运营
     */
    public function isAdmin()
    {
        if ($this->_login_user_type!='admin') {
            $this->fail(ErrorCode::SYS_PERMISSION_DENY);
        }
    }
}