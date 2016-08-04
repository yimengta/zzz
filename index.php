<?php
// 应用入口文件


// 检测PHP环境
// if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 设置字符集
header('Content-Type:text/html;charset=utf-8');

// 常量和变量都是卸载incude之前便于访问
// 控制目录安全文件的开关
define('BUILD_DIR_SECURE',false);

// 生产模式和调试模式的切换,开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);//默认是false，表示关闭调试模式
define('WORKING_PATH',str_replace("\\", '/', __DIR__));
define('UPLOAD_ROOT_PATH','/Public/Uploads/');
// 定义应用目录
// define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单