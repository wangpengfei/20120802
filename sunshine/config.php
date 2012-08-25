<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );
//应用调试模式设置(TRUE,FALSE)
define ( 'IS_DEBUG', TRUE );

//数据库连接设置
if(IS_PRODUCT){
	define ( 'DB_HOST', 'localhost:3306' );
	define ( 'DB_USER', 'sq_gtoyg' );
	define ( 'DB_PW', '85596526' );
	define ( 'DB_NAME', 'sq_gtoyg' );
	define ( 'DB_CHARSET', 'utf8' );
	define ( 'DB_CONNECT', 0 );	
}else{
	define ( 'DB_HOST', 'localhost:3306' );
	define ( 'DB_USER', 'root' );
	define ( 'DB_PW', 'king1983' );
	define ( 'DB_NAME', 'sunshine' );
	define ( 'DB_CHARSET', 'utf8' );
	define ( 'DB_CONNECT', 0 );	
}

//应用参数设置
$setting['cookie_domain']="";
$setting['cookie_pre']="sh_";
$setting['cookie_timeout']=24*3600*365;

?>