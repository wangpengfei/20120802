<?php

//** http://www.clickatell.com **//

include_once dirname(__FILE__) . '/../ISMSProvider.php';
include_once 'vtlib/Vtiger/Net/Client.php';

class ClickATell implements ISMSProvider {
	
	private $_username;
	private $_password;
	private $_parameters = array();
	
	const SERVICE_URI = 'http://api.clickatell.com';
	private static $REQUIRED_PARAMETERS = array('api_id');
	
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
				case self::SERVICE_SEND: return  self::SERVICE_URI . '/http/sendmsg';
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
			'user' => $this->_username,
			'password' => $this->_password,
			'api_id' => $this->getParameter('api_id'),
			
			'text' => $message,
			'to'   => implode(',', $tonumbers)
		));
		$responseLines = split("\n", $response);		

		$results = array();
		$i=0;
		foreach($responseLines as $responseLine) {
			
			$responseLine = trim($responseLine);			
			if(empty($responseLine)) continue;
			
			$result = array( 'error' => false, 'statusmessage' => '' );
			if(preg_match("/ERR:(.*)/", trim($responseLine), $matches)) {
				$result['error'] = true; 
				$result['to'] = $tonumbers[$i++];
				$result['statusmessage'] = $matches[0]; // Complete error message
			} else if(preg_match("/ID: ([^ ]+)TO:(.*)/", $responseLine, $matches)) {
				$result['id'] = trim($matches[1]);
				$result['to'] = trim($matches[2]);
				$result['status'] = self::MSG_STATUS_PROCESSING;
				
			} else if(preg_match("/ID: (.*)/", $responseLine, $matches)) {
				$result['id'] = trim($matches[1]);
				$result['to'] = $tonumbers[0];
				$result['status'] = self::MSG_STATUS_PROCESSING;
			}
			$results[] = $result;
		}		
		return $results;
	}
	
	public function query($messageid) {

		$serviceURL = $this->getServiceURL(self::SERVICE_QUERY);
		$httpClient = new Vtiger_Net_Client($serviceURL);
		$response = $httpClient->doPost(array(
			'user' => $this->_username,
			'password'  => $this->_password,
			'api_id' => $this->getParameter('api_id'),		
			'apimsgid' => $messageid
		));
		
		$response = trim($response);

		$result = array( 'error' => false, 'needlookup' => 1, 'statusmessage' => '' );
		
		if(preg_match("/ERR: (.*)/", $response, $matches)) {
			$result['error'] = true;
			$result['needlookup'] = 0;
			$result['statusmessage'] = $matches[0];
			
		} else if(preg_match("/ID: ([^ ]+) Status: ([^ ]+)/", $response, $matches)) {
			$result['id'] = trim($matches[1]);
			$status = trim($matches[2]);

			// Capture the status code as message by default.
			$result['statusmessage'] = "CODE: $status";

			if($status == '002' || $status == '008' || $status == '011' ) {
				$result['status'] = self::MSG_STATUS_PROCESSING;
			} else if($status == '003' || $status == '004') {
				$result['status'] = self::MSG_STATUS_DISPATCHED;
				$result['needlookup'] = 0;
			} else {
				$statusMessage = "";
				switch($status) {
				case '001': $statusMessage = 'Message unknown';                 $needlookup = 0; break;
				case '005': $statusMessage = 'Error with message';              $needlookup = 0; break;
				case '006': $statusMessage = 'User cancelled message delivery'; $needlookup = 0; break;
				case '007': $statusMessage = 'Error delivering message';        $needlookup = 0; break;
				case '009': $statusMessage = 'Routing error';                   $needlookup = 0; break;
				case '010': $statusMessage = 'Message expired';                 $needlookup = 0; break;
				case '012': $statusMessage = 'Out of credit';                   $needlookup = 0; break;
				}			
				if(!empty($statusMessage)) {		
					$result['error'] = true;
					$result['needlookup'] = $needlookup;
					$result['statusmessage'] = $statusmessage;
				}
			}
		} 	
		return $result;
	}
	
	public function get_overage($username, $password){
		return 0;
	}
}
?>
