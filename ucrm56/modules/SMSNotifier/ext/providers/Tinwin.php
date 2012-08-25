<?php

//** http://www.tinwin.com.cn **//

include_once dirname(__FILE__) . '/../ISMSProvider.php';
include_once 'vtlib/Vtiger/Net/Client.php';

class Tinwin implements ISMSProvider {
	
	private $_username;
	private $_password;
	private $_parameters = array();
	
	const SERVICE_URI = 'http://gateway.tinwin.com.cn/xunjiehttp/';
	private static $REQUIRED_PARAMETERS = array('AGENCY_ID');
	
	function __construct() {		
	}
	
	public function setAuthParameters($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}
	
	public function setParameter($key, $value) {
		$this->_parameters[$key] = $value;
	}
	
	public function getParameter($key, $defvalue = false)  {
		if(isset($this->_parameters[$key])) {
			return $this->_parameters[$key];
		}
		return $defvalue;
	}
	
	public function getRequiredParams() {
		return self::$REQUIRED_PARAMETERS;
	}
	
	public function getServiceURL($type = false) {		
		if($type) {
			switch(strtoupper($type)) {				
				case self::SERVICE_AUTH: return  self::SERVICE_URI . '/http/auth';
				case self::SERVICE_SEND: return  self::SERVICE_URI . '/Submit';
				case self::SERVICE_QUERY: return self::SERVICE_URI . '/http/querymsg';			
			}
		}
		return false;
	}	
	
	public function send($message, $tonumbers, $time) {
		if($time){
			$time = $time.':00';
		}
		if(!is_array($tonumbers)) {
			$tonumbers = array($tonumbers);
		}
		$serviceURL = $this->getServiceURL(self::SERVICE_SEND);

		$httpClient = new Vtiger_Net_Client($serviceURL);
		$response = $httpClient->doPost(array(
			'userName' => $this->getParameter('AGENCY_ID').':'.$this->_username,
			'password' => $this->_password,
			'dest_Id'   => implode(',', $tonumbers),
			'content' => mb_convert_encoding($message,'GBK','GBK,GB2312,UTF-8'),
			'sendTime' => $time,
		));

		switch($response){
			case 0:
				$error   = false;
				$err_msg = '';
				break;
			case -1:
				$error   = true;
				$err_msg = '操作失败';
				break;
			case -2:
				$error   = true;
				$err_msg = '用户名或者密码错误';
				break;
			case -3:
				$error   = true;
				$err_msg = '数据库错误';
				break;
			case -4:
				$error   = true;
				$err_msg = '余额不足';
				break;
			case -5:
				$error   = true;
				$err_msg = '内容超长';
				break;
			case -6:
				$error   = true;
				$err_msg = '时间格式错误';
				break;
			case -7:
				$error   = true;
				$err_msg = '非法手机号码';
				break;
			case -9:
				$error   = true;
				$err_msg = '访问过于频繁';
				break;
			case -10:
				$error   = true;
				$err_msg = '帐户被锁';
				break;
		}
		
		foreach($tonumbers as $phone){
			$result[] = array('error'=>$error, 'to'=>$phone,'statusmessage'=>$err_msg);
		}
		
		return $result;
	}
	
	public function get_overage($username, $password){		
		$httpClient = new Vtiger_Net_Client('http://gateway.tinwin.com.cn/xunjiehttp/GetBlance');
		$response = $httpClient->doPost(array(
			'userName' => $this->getParameter('AGENCY_ID').':'.$username,
			'password' => $password
		));
		
		switch($response){
			case -1:
				$response = '操作失败';
				break;
			case -2:
				$response = '用户名或者密码错误';
				break;
			case -3:
				$response = '数据库错误';
				break;
			case -4:
				$response = '余额不足';
				break;
			case -5:
				$response = '内容超长';
				break;
			case -6:
				$response = '时间格式错误';
				break;
			case -7:
				$response = '非法手机号码';
				break;
			case -9:
				$response = '访问过于频繁';
				break;
			case -10:
				$response = '帐户被锁';
				break;
		}
		
		return $response;
	}
	
	public function query($messageid) {
		return ;
	}
}
?>
