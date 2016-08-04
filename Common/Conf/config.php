<?php
return array(
	//'配置项'=>'配置值'
    // 
	'MODULE_AllOW_LIST'      =>  array('Home','Admin','Api'),//分组的相关配置
	'TMPL_DENY_PHP'         =>  false,
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称
	  // 数据库配置
	 'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'sp_shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'zxc',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀
    'DB_DEBUG'             =>  true,    // 数据库调试模式，开启可以记录sql日志
    'DB_FIELDS_CACHE'             =>  true,    // 启用字段缓存
    'DB_CHARSET'             =>  'utf8',    // 数据库编码默认采用utf8
   
    // 'READ_DATA_MAP'         =>  true,
    
    // 关闭字段缓存
     // 'DB_FIELDS_CACHE' =>false,
    
    'HTML_CACHE_ON'     =>    true, 
    // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   
    // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀'
    // HTML_CACHE_RULES'  =>     array(  
    // // 定义静态缓存规则
     
      
     // 字段映射
     'READ_DATA_MAP'  => true,
     // 开启跟踪信息(以便查看function.php文件是否被引入)
     'SHOW_PAGE_TRACE' =>true,

     // 加载指定的自定义文件
     'LOAD_EXT_FILE' => 'test',
     'PLUGIN_URL' => '/Common/Plugin/',

     // 用户权限的控制
     // 'RBAC_ROLES' => array(
     //    1 => '高层管理',
     //    2 => '中层领导',
     //    3 => '职员',
     //    ),
     // 'RBAC_AUTH' => array(
     //    'AUTH1' => array('*/*'),
     //    'AUTH2' => array('User/*','Doc/*','Email/*'),
     //    'AUTH3' => array('Email/*'),
     //    )
     


);