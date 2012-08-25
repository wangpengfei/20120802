<?php
!defined('IN_SUNSHINE') && exit('Access Denied');

require SUNSHINE_ROOT.'/lib/hddb.php';
require SUNSHINE_ROOT.'/lib/util.php';
require SUNSHINE_ROOT."/lib/template.inc";

/**
 *该类提供支持整个应用的基本功能 
 * @author wpf
 *
 */
abstract class base{
	 //用户ip
	protected $ip;
	//用户访问时间
	protected $time;
	//用户访问时间,已做格式化
	protected $format_time;
	//数据访问接口
	protected $db;
	//用户信息
	protected $user = array();	
	//模板文件所在路径
	protected $template_path;
	//请求参数
	protected $reqParams = array();
	
	//构造函数
	function base(){
		$this->time= time();
		$this->format_time=date('Y-m-d H:i:s',$this->time);
		$this->ip=util::getip();
		$this->init_db();
		$this->template_path=SUNSHINE_ROOT.'/view/';
		$this->init_user();
		$this->init_ReqParams();
	}
	//初始化请求参数
	private function init_ReqParams(){
		$this->reqParams=$_REQUEST;
	}
	//初始化数据库连接
	private function init_db(){
		$this->db=new hddb(DB_HOST,DB_USER,DB_PW,DB_NAME,DB_CHARSET,DB_CONNECT);
	}
	//取得应用设置参数
	protected function getv($key){
		global $setting;
		return $setting[$key];
	}
	//设置cookie
	public function hsetcookie($var, $value, $life = 0) {		
		$domain= $this->getv('cookie_domain');		
		$cookiepre=$this->getv('cookie_pre');
		setcookie($cookiepre.$var, $value,$life ? $this->time + $life : 0, '/',$domain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
	}
	//获取cookie
	public function hgetcookie($var) {
		$cookiepre=$this->getv('cookie_pre');
		return trim($_COOKIE[$cookiepre.$var]);
 	}
 	//初始化用户信息
	private function init_user() {		
		@$uid=$this->hgetcookie('uid');
		@$isreg=$this->hgetcookie('isreg');		
		if(!empty($uid)) {
			$this->setUserVar($uid,$isreg);			
			$this->setUserCookie($uid,$isreg);
			$this->updateUserSession($uid,$isreg);
		}else{
			//用户首次登录生成session id	
			$newUid=uniqid('sh',false);			
			$this->setUserVar($newUid,1);
			$this->createSession($newUid,1);
			$this->setUserCookie($newUid,1);		
		}	
	}
	//设置用户信息变量
	public function setUserVar($uid,$isreg){
		if($isreg==0){//如果是注册用户
			$this->user=$this->db->fetch_first("select * from sh_user where uid=$uid");
			$this->user['isreg']=0;		
		}else if($isreg==1){
			$this->user['uid']=$uid;
			$this->user['isreg']=1;
		}
	}
	//更新某个用户的最后登录时间
	public function updateUserSession($uid,$isreg){
		$qsql="select * from sh_session where sid='$uid'";
		$sqey=$this->db->fetch_first($qsql);
		$newloginc=intval($sqey['lcount'])+1;
		$this->db->query("update sh_session set lcount=$newloginc,uip='$this->ip',lasttime='$this->format_time' where sid='$uid'");	
	}
	//设置用户cookie及后台会话记录($isreg=0,注册用户，1，临时用户)
	public function setUserCookie($uid,$isreg){
		$ctimeout=$this->getv('cookie_timeout');	
		$this->hsetcookie('uid',$uid,$ctimeout);
		$this->hsetcookie('isreg',$isreg,$ctimeout);
	}
	//创建用户会话信息
	public function createSession($uid,$isreg){
		$this->db->query("insert into sh_session values('$uid','$this->ip',$isreg,1,'$this->format_time')");
	}
	//按照指定的格式得到一个时间或者日期
	public function getFormatDT($ft){
		return date($ft,$this->time);
	}
	//根据路径所表示的文件得到该文件的扩展名
	public function getFileEx($fpath){
		$extend = pathinfo($fpath);
		$extend = strtolower($extend["extension"]);
		return $extend;		
	}
	//每个控制类默认的处理方法
	abstract public function dodefault();
}

?>