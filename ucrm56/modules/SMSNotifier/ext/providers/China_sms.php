<?php

//** http://www.china-sms.com **//

include_once dirname(__FILE__) . '/../ISMSProvider.php';
include_once 'vtlib/Vtiger/Net/Client.php';

class China_sms implements ISMSProvider {
	
	private $_username;
	private $_password;
	private $_parameters = array();
	
	const SERVICE_URI = 'http://www.china-sms.com/send';
	private static $REQUIRED_PARAMETERS = array('INFO_NUM');
	
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
				case self::SERVICE_SEND: return  self::SERVICE_URI . '/gsend.asp';
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

		$httpClient = new Vtiger_Net_Client($serviceURL);
		$response = $httpClient->doPost(array(
			'name' => $this->_username,
			'pwd' => $this->_password,
			'dst'   => implode(',', $tonumbers),
			'msg' =>  mb_convert_encoding($message,'GBK','GBK,GB2312,UTF-8'),
			'time' => str_replace(array('-',' ',':'),'',$time),
			'sender' => $this->getParameter('INFO_NUM'),
		));
		$responseLines = explode("&", $response);

		$tonumbers_c = count($tonumbers);
		
		$success_arr = explode(',',substr($responseLines[1],8));
		$faile_arr   = explode(',',substr($responseLines[2],6));
		$err_msg     = mb_convert_encoding(substr($responseLines[3],4),'UTF-8','GBK,GB2312,UTF-8');
		
		if(!empty($success_arr)){
			foreach($success_arr as $success){
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

		if(!empty($faile_arr)){
			foreach($faile_arr as $faile){
				if($faile){
					++ $faile_c;
					$result[] = array('error' => true, 'to' => $faile,'statusmessage' => $err_msg);
				}
			}
		}
		
		if($faile_c + $success_c != $tonumbers_c){
			foreach($tonumbers as $phone){
				if(!in_array($phone,$success_arr) && !in_array($phone,$faile_arr)){
					$result[] = array('error' => true, 'to' => $phone,'statusmessage' => 'wrong number');
				}
			}
		}
		
		return $result;
	}
	
	public function get_overage($username, $password){		
		$httpClient = new Vtiger_Net_Client('http://www.china-sms.com/send/getfee.asp');
		$response = $httpClient->doPost(array(
			'name' => $username,
			'pwd' => $password
		));
		
		$response = iconv("GBK", "UTF-8", $response);
		$access_num_arr  = explode("&",$response); 
		$access_num_arr = explode("=",$access_num_arr[0]); 
		return $access_num_arr[1]/10;
	}
	
	public function query($messageid) {
		return ;
	}
}
?>
