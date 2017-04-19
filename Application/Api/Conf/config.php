<?php
define('API_SECRET_PARAM', 'api_url_secret');
define('API_SECRET_CODE',  '0A1B0c2D0e3F0G');
return array(
    //'配置项'=>'配置值'
    'TOKEN_CRYPT_CODE' => 'followbee',//加解密秘钥
    'LOGIN_EXPIRE_TIME'=>84600,      //登录过期时间
    'URL_ROUTER_ON'     => true,    // 开启路由
    //自定义路由配置
    'URL_ROUTE_RULES'=>array(

        // 接口错误码对照表
        ['error/all', 'apiCommon/errorCodes', API_SECRET_PARAM.'='.API_SECRET_CODE, ['method' => 'get']],

        //example
        ['Index', 'Index/index', API_SECRET_PARAM.'='.API_SECRET_CODE, ['method' => 'get']],
    ),
);