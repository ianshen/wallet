<?php

error_reporting ( E_ALL );
ini_set ( 'display_errors', 'on' );

date_default_timezone_set ( 'Asia/Shanghai' ); //时区设置
//定义关键目录
define ( 'ROOT_DIR', dirname ( __DIR__ ) ); //根目录，必需
define ( 'SANTA_DIR', ROOT_DIR . '/Santa' ); //Santa框架目录，必需
define ( 'APP_DIR', __DIR__ ); //应用目录，必需
define ( 'CONF_DIR', APP_DIR . '/Conf' ); //配置文件目录，必需
define ( 'VIEW_DIR', APP_DIR . '/View' ); //模板视图目录，必需
define ( 'VENDOR_DIR', SANTA_DIR . '/Vendor' ); //第三方库目录，不用时可注释
require SANTA_DIR . '/App.php'; //引入核心类


try {
	//应用核心类设置
	Santa_App::init ( array ('view_engine' => 'Santa_View_Smarty2', 'enable_router_filters' => 0, 'enable_action_filters' => 0 ) );
	Santa_App::run ();
} catch ( Santa_Exception_404 $e ) {
	var_dump ( $e );
} catch ( Exception $e ) {
	var_dump ( $e );
}