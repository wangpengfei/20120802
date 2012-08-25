<?php

class hddb {

	var $mlink;

	function hddb($dbhost, $dbuser, $dbpw, $dbname = '',$dbcharset='utf8', $pconnect=0){
		if($pconnect){
			if(!$this->mlink = @mysql_pconnect($dbhost, $dbuser, $dbpw)){
				$this->halt('Can not connect to MySQL');
			}
		} else {
			if(!$this->mlink = @mysql_connect($dbhost, $dbuser, $dbpw)){
				$this->halt('Can not connect to MySQL');
			}
		}
		if($this->version()>'4.1'){
			if('utf-8'==strtolower($dbcharset)){
				$dbcharset='utf8';
			}
			if($dbcharset){
				mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary", $this->mlink);
			}
			if($this->version() > '5.0.1'){
				mysql_query("SET sql_mode=''", $this->mlink);
			}
		}
		if($dbname){
			mysql_select_db($dbname, $this->mlink);
		}
	}

	function select_db($dbname){
		return mysql_select_db($dbname, $this->mlink);
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC){
		return (is_resource($query))? mysql_fetch_array($query, $result_type) :false;
	}
	//取得结果集第一个单元格的数据
	function result_first($sql){
		$query = $this->query($sql);
		return $this->result($query, 0);
	}
	//得到结果集的第一条记录
	function fetch_first($sql){
		$query = $this->query($sql);
		return $this->fetch_array($query);
	}
	
	function query($sql, $type = ''){
		global $debug ,$mquerynum;
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->mlink)) && $type != 'SILENT'){
			$this->halt(mysql_error(),$debug);
		}
		$mquerynum++;
		return $query;
	}

	function affected_rows(){
		return mysql_affected_rows($this->mlink);
	}

	function error(){
		return (($this->mlink) ? mysql_error($this->mlink) : mysql_error());
	}

	function errno(){
		return intval(($this->mlink) ? mysql_errno($this->mlink) : mysql_errno());
	}
	//查询一个单元格的数据
	function result($query, $row){
		$query = @mysql_result($query, $row);
		return $query;
	}
	//取得结果集中行数
	function num_rows($query){
		$query = mysql_num_rows($query);
		return $query;
	}
	//取得结果集中字段的数目
	function num_fields($query){
		return mysql_num_fields($query);
	}
	
	function free_result($query){
		return mysql_free_result($query);
	}

	function insert_id(){
		return ($id = mysql_insert_id($this->mlink)) >= 0 ? $id : $this->result($this->query('SELECT last_insert_id()'), 0);
	}
	//从结果集中取得一行作为枚举数组
	function fetch_row($query){
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_fields($query){
		return mysql_fetch_field($query);
	}

	function version(){
		return mysql_get_server_info($this->mlink);
	}
	//得到整个结果集
	function get_result($sql){
		$query = $this->query($sql);
		$result=array();
		while (($row=$this->fetch_array($query))!=false){
			$result[]=$row;
		}
		return $result;
	}
	
	function close(){
		return mysql_close($this->mlink);
	}

	function halt($msg, $debug=true){
		if(IS_DEBUG){
			echo "<html>\n";
			echo "<head>\n";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
			echo "<title>$msg</title>\n";
			echo "<br><font size=3 color='red'><b>$msg</b></font>";
			exit();
		}else{
			$def_msg="访问被强制退出，请稍后再访问！";
			echo "<html>\n";
			echo "<head>\n";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
			echo "<title>$def_msg</title>\n";
			echo "<br><font size=3 color='red'><b>$def_msg</b></font>";
			exit();
		}
	}
}

?>