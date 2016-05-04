<?php

return array(
    'URL_MODEL' => '0', //URL模式
    'APP_AUTOLOAD_PATH' => 'Think.Util.,ORG.Util.,@.Behavior',
    'URL_CASE_INSENSITIVE' => FALSE,
    'DEFAULT_MODULE' => 'Index', //默认模块
    'SESSION_AUTO_START' => true, //是否开启session
    'APP_STATUS' => 'debug', //应用调试模式状态
    'APP_FILE_CASE' => TRUE,
    'COOKIE_EXPIRE' =>86400,
    'SHOW_ERROR_MSG' => TRUE,
    'APP_TAGS_ON' => true, //扩展开关
    'HTML_CACHE_ON' => FALSE, //关闭静态缓存
    'APP_DEBUG' => true,
    'DB_FIELD_CACHE' => false,
    'TMPL_CACHE_ON' => false,
    //数据库配置
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => '127.0.0.1', // 服务器地址
    'DB_NAME' => 'dxjixiao', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '123456', // 密码
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => 'dx_', // 数据库表前缀 
    'DEFAULT_CHARSET' => 'utf-8',
    'DB_SQL_BUILD_CACHE' => false, // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_LENGTH' => 20, // SQL缓存的队列长度
    'TMPL_TEMPLATE_SUFFIX' => '.html'//默认模板后缀
);
?>