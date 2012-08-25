<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

require SUNSHINE_ROOT.'/config.php';
require SUNSHINE_ROOT.'/model/base.class.php';
/**
 * 应用的总控制器
 * @author wpf
 *
 */
class sunshine {
	
	//客户端请求的控制器类
	private $action='';
	//客户端请求的控制器类的方法
	private $method=''; 
	
	//
	function sunshine() {
		$this->init_request();
	}
	//初始化请求参数
	private function init_request() {
		//get请求方式
		$qstr = $_SERVER ['QUERY_STRING'];
		$qArr=explode('&',$qstr);
		foreach($qArr as $value){
			$oneparam=explode('=',strtolower($value));
			if(count($oneparam)>1){
				if($oneparam[0]=='action'){
					$this->action=$oneparam[1];
				}
				if($oneparam[0]=='method'){
					$this->method=$oneparam[1];
				}
			}
		}		
		//默认客户端请求首页
		if ($this->action == '') {
			$this->action = 'firstpage';
		}
		if($this->method==''){
			$this->method='dodefault';
		}
	}
	//运行
	public function run(){
		$ctlfile=SUNSHINE_ROOT.'/control/'.$this->action.'.php';
		if(false===@include($ctlfile)){
			exit('control '.$this->action.' not found!');
		}
		$ctrl=new $this->action();
		$method=$this->method;
		if(method_exists($ctrl,$method)){
			$ctrl->$method();	
		}else{
			exit("method $method of class $ctrl not found!");
		}				
	}
}
?>