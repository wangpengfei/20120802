<?php

//** http://www.hl95.com **//

include_once dirname(__FILE__) . '/../ISMSProvider.php';
include_once 'vtlib/Vtiger/Net/Client.php';

class HongLian95 implements ISMSProvider {
	
	private $_username;
	private $_password;
	private $_parameters = array();
	
	const SERVICE_URI = 'http://sdkhttp.eucp.b2m.cn/sdkproxy/sendtimesms.action';
	private static $REQUIRED_PARAMETERS = array('addserial');
	
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
				case self::SERVICE_SEND: return  self::SERVICE_URI;
				case self::SERVICE_QUERY: return self::SERVICE_URI . '/http/querymsg';			
			}
		}
		return false;
	}	
	
	public function send($message, $tonumbers, $time) {
		if(!is_array($tonumbers)) {
			$tonumbers = array($tonumbers);
		}
		$serviceURL = $this->getServiceURL(self::SERVICE_SEND);
		if(!$time){
			$serviceURL = 'http://sdkhttp.eucp.b2m.cn/sdkproxy/sendsms.action';
		}
		$httpClient = new Vtiger_Net_Client($serviceURL);
		$responses = $httpClient->doPost(array(
			'cdkey' => $this->_username,
			'password' => $this->_password,
			'phone'   => implode(',', $tonumbers),
			'message' =>  mb_convert_encoding($message,'GBK','GBK,GB2312,UTF-8'),
			'sendtime' => $time ? str_replace(array('-',' ',':'),'',$time).'00' : date('YmdHis'),
			'addserial' => $this->getParameter('addserial'),
		));
		
		$response =  simplexml_load_string(trim($responses));

		switch($response->error){
			case 2:
				$err_msg = '重复登录';
				break;
			case 3:
				$err_msg = '连接过多';
				break;
			case 4:
				$err_msg = '参数格式错';
				break;
			case 7:
				$err_msg = '消息ID错';
				break;
			case 8:
				$err_msg = '信息长度错';
				break;
			case 9:
				$err_msg = '指令操作失败';
				break;
			case 12:
				$err_msg = '查询余额失败';
				break;
			case 17:
				$err_msg = '发送信息失败';
				break;
			case 18:
				$err_msg = '发送定时信息失败';
				break;
			case 303:
				$err_msg = '客户端发送后超时未返回';
				break;
			case 304:
				$err_msg = '客户端发送三次失败';
				break;
			case 305:
				$err_msg = '服务器返回了错误的数据，原因可能是通讯过程中有数据丢失';
				break;
			case 306:
				$err_msg = '发送队列或接受队列满,通常为发送队列满.';
				break;
			case 307:
				$err_msg = '目标手机号码中包含错误号码';
				break;
			case 308:
				$err_msg = '参数错误';
				break;
		}

		if($response->error == 0){
			foreach($tonumbers as $success){
				if($success){
					++ $success_c;
					if($time > time()){
						$result[] = array('status' => self::MSG_STATUS_PROCESSING, 'to' => $success,'statusmessage' => $err_msg);
					}else{
						$result[] = array('error' => false, 'to' => $success,'statusmessage' => $err_msg);
					}
				}
			}
		}

		if($response->error != 0){
			foreach($tonumbers as $faile){
				if($faile){
					++ $faile_c;
					$result[] = array('error' => true, 'to' => $faile,'statusmessage' => $err_msg);
				}
			}
		}
		
		return $result;
	}
	
	public function get_overage($username, $password){		
		$httpClient = new Vtiger_Net_Client('http://sdkhttp.eucp.b2m.cn/sdkproxy/querybalance.action');
		$responses = $httpClient->doPost(array(
			'cdkey' => $username,
			'password' => $password
		));
		$response =  simplexml_load_string(trim($responses));
		return $response->message;
	}
	
	public function query($messageid) {
		return ;
	}
}
?>
