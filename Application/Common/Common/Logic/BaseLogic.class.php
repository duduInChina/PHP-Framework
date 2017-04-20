<?php

namespace Common\Common\Logic;


use Common\Common\ErrorCode;
use Library\Common\Validate;

class BaseLogic
{

    protected function throwException($error_code, $error_msg = '')
    {
        if (is_array($error_msg)) {
            $msg_arr = $error_msg;
            $error_msg = ErrorCode::getMessage($error_code);
            foreach ($msg_arr as $search => $msg) {
                $error_msg = str_replace(':' . $search, $msg, $error_msg);
            }
        } else {
            empty($error_msg) && $error_msg = ErrorCode::getMessage($error_code);
        }
        throw new \Exception($error_msg, $error_code);
    }

    protected function page($page_no = NULL, $page_num = NULL)
    {
        empty($page_no) && $page_no = I('page_no', 1, 'intval');
        empty($page_num) && $page_num = I('page_size', 10, 'intval');
        $offset = ($page_no - 1) * $page_num;
        $offset = max(0, $offset);
        $page_num = max(0, $page_num);
        return "$offset,$page_num";
    }

    /*
    * 数据验证
    * */
    protected function dataParamsCheck($params, $rule, $msg='')
    {
        $validate = new Validate($rule, $msg);
        if (!$validate->check($params)) {
            $this->throwException(ErrorCode::SYS_REQUEST_PARAMS_MISSING, $validate->getError());
        }
    }

    public function array_column_string($array, $column)
    {
        $res = [];
        if ($array) {
            $res = array_unique(array_filter(array_column($array, $column)));
        }
        return $res ? implode(',', $res) : 0;
    }

    protected function paginate($list, $number)
    {
        $response=[
            'page_no'  => I('page_no',   1,  'intval'),
            'page_num' => I('page_size', 10, 'intval'),
            'count' => $number,
            'data_list' => $list,
        ];
        return $response;
    }

    public function p($msg)
    {
        echo '<pre>';
        print_r($msg);
        echo '<pre>';die;
    }
}