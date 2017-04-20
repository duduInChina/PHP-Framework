<?php

namespace Api\Logic;

use Common\Common\Logic\BaseLogic;
use Common\Common\ErrorCode;
use Common\Common\Model\BaseModel;

/**
 * Created by PhpStorm.
 * User: Dzc
 * Date: 2017/4/21
 * Time: 上午5:12
 */
class LoginLogic extends BaseLogic
{

    public function login($param){

        $rule = [
            'name|username' => 'require',
            'password|password' => 'require',
        ];
        $this->dataParamsCheck($param, $rule);

        $params = [
            'where' => $param
        ];
        $model=BaseModel::getInstance('tb_user');
        $data = $model->getOne($params);

        if (!$data) {
            $this->throwException(ErrorCode::SYS_DATA_NOT_EXISTS, "用户不存在!");
        }

        return $data;
    }

}