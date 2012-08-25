<?php
//
// Turn off all error reporting
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//应用入口
define('IN_SUNSHINE', TRUE);
define('SUNSHINE_ROOT', dirname(__FILE__));
define('IS_PRODUCT', TRUE);

//设置中国时区
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set('PRC');
}
//进入应用总控制器
require SUNSHINE_ROOT.'/control/sunshine.php';
$sh=new sunshine();
$sh->run();
?>