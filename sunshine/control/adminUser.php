<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

class adminUser extends base{
	
	public function adminUser(){
		$this->base();
	}
	
	//默认后台管理员登录
	public function dodefault() {
		//创建一个实例 
		$tpl = new Template($this->template_path, "keep");
		//将整个文件读进来 
		$tpl->set_file("admin_login", "admin/admin_login.html");
		$tpl->parse("result","admin_login");
		//输出替换的结果		 
		$tpl->p("result");
	}
	
	//验证用户帐号是否合法
	public function validateUser(){
		$uname=trim($this->reqParams['uname']);
		$upwd=trim($this->reqParams['upassword']);
		$sql="select * from sh_user where uname='$uname'";
		$result=$this->db->fetch_first($sql);
		if($result==false){
			echo "2";//没有这个帐号
			return ;
		}
		if(md5($upwd)==$result['upasswd']){
			echo "0";//表示验证成功
			return ;
		}else{
			echo "1";//密码不对
			return;	
		}		
	}
	
	//经验证后管理员登录
	public function adminLogin(){
		$uname=trim($this->reqParams['uname']);
		$upwd=trim($this->reqParams['upassword']);
		$sql="select * from sh_user where uname='$uname'";
		$result=$this->db->fetch_first($sql);
		//如果是新用户就建立会话信息
		$uid=$result['uid'];
		$qsql="select * from sh_session where sid='$uid'";
		$sqey=$this->db->fetch_first($qsql);
		if($sqey==false){			
			$this->createSession($uid,0);			
		}		
		$this->setUserCookie($uid,0);
		$this->setUserVar($uid,0);
		//
		$this->adminDisplayMain();
	}
	
	//管理员登录后显示主界面
	public function adminDisplayMain(){		
		$tpl = new Template($this->template_path, "keep");		 
		$tpl->set_file("index", "admin/index.html");
		$tpl->parse("result","index");				 
		$tpl->p("result");
	}
	
	//显示主界面的top部分
	public function adminDspTopOfMain(){
		$tpl = new Template($this->template_path, "keep");		 
		$tpl->set_file("top", "admin/top.html");
		if($this->user['isreg']=='0'){
			$tpl->set_var("username",$this->user['udspname']);
		}else{
			$tpl->set_var("username","游客");
		}		
		$tpl->parse("result","top");				 
		$tpl->p("result");
	}
	//显示主界面的menu部分
	public function adminDspMenuOfMain(){
		$tpl = new Template($this->template_path, "keep");		 
		$tpl->set_file("menu", "admin/menu.html");
		$tpl->parse("result","menu");				 
		$tpl->p("result");
	}
	//显示主界面的main部分
	public function adminDspMainOfMain(){
		$tpl = new Template($this->template_path, "keep");		 
		$tpl->set_file("main", "admin/main.html");
		$tpl->parse("result","main");				 
		$tpl->p("result");
	}
	//查询用户列表
	public function usermanage(){
		//创建一个实例 
		$tpl = new Template($this->template_path, "remove");
		//将整个文件读进来 
		$tpl->set_file("adminUser", "admin/user_list.html");
		$tpl->set_block('adminUser', 'list', 'nlist');
		$sql = "select * from sh_user";
		$query=$this->db->query($sql);
		while (($crow=$this->db->fetch_array($query))!=false){
			$tpl->set_var('uid',$crow['uid']);
			$tpl->set_var('uname',$crow['uname']); 
			$tpl->set_var('udspname',$crow['udspname']);
			$tpl->set_var('uemail',$crow['uemail']);
			$tpl->set_var('uaddress',$crow['uaddress']);
			$tpl->set_var('ucompany',$crow['ucompany']);
			$tpl->parse('nlist', 'list', true);	
		}		
		$tpl->parse("result","adminUser");				 
		$tpl->p("result");		
	}
	//查看应用服务器配置信息
	public function viewsysconfig(){		
		phpinfo();
	}

}
?>