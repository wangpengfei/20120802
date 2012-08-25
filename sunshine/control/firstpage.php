<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );
/**
 * 首页控制类
 * @author wpf
 *
 */
class firstpage extends base{

	public function firstpage(){
		$this->base();
	}
	
	//首页的默认动作
	public function dodefault(){	
		//创建一个实例 
		$tpl = new Template($this->template_path, "keep");
		//将整个文件读进来 
		$tpl->set_file("main", "main/main.html");
		$allcateArr=array(array("栏目1","part1",4),array("栏目2","part2",4),
			array("栏目3","part3",4));		
		//
		foreach($allcateArr as $value){
			$cateName=$value[0];
			$cateVar=$value[1];
			$prodcount=$value[2];
			//
			$qsql="select * from sh_channel where chname='".trim($cateName)."'";
			$result=$this->db->fetch_first($qsql);
			if($result!=false){
				$chid=$result['chid'];
				$psql="select * from sh_product where chid=$chid";
				$pquery=$this->db->query($psql);
				$rownum=$this->db->num_rows($pquery);
				if($rownum>=$prodcount){
					$tpl->set_block("main", $cateVar, 'n'.$cateVar);
					$countRow=0;		
					while (($crow=$this->db->fetch_array($pquery))!=false && $countRow<$prodcount){		
						$tpl->set_var('pid',intval($crow['pid'])); 
						$tpl->set_var('pname',$crow['pname']);
						$tpl->set_var('pcode',$crow['pcode']); 
						$tpl->set_var('pmarketprice',$crow['pmarketprice']);
						$tpl->set_var('pteamprice',$crow['pteamprice']);
						$tpl->set_var('pspec',$crow['pspec']);
						$tpl->set_var('pdesc',$crow['pdesc']);
						$tpl->set_var('pregtime',$crow['pregtime']);
						$tpl->set_var('pimage',$crow['pimage']);
						$tpl->set_var('cid',$crow['cid']);
						$tpl->parse('n'.$cateVar, $cateVar, true);	
						$countRow++;	
					}
					continue;	
				}
			}
			//显示栏目默认产品
			$psql="select * from sh_product order by pid limit 0,$prodcount";
			$pquery=$this->db->query($psql);				
			$tpl->set_block("main",$cateVar,'n'.$cateVar);		
			while (($crow=$this->db->fetch_array($pquery))!=false){		
				$tpl->set_var('pid',intval($crow['pid'])); 
				$tpl->set_var('pname',$crow['pname']);
				$tpl->set_var('pcode',$crow['pcode']); 
				$tpl->set_var('pmarketprice',$crow['pmarketprice']);
				$tpl->set_var('pteamprice',$crow['pteamprice']);
				$tpl->set_var('pspec',$crow['pspec']);
				$tpl->set_var('pdesc',$crow['pdesc']);
				$tpl->set_var('pregtime',$crow['pregtime']);
				$tpl->set_var('pimage',$crow['pimage']);
				$tpl->set_var('cid',$crow['cid']);
				$tpl->parse('n'.$cateVar,$cateVar,true);				
			}
		}		
		//设置界面用户信息	
		if($this->user['isreg']==0){
			$tpl->set_var('isreg',0);
			$tpl->set_var('userid',$this->user['uid']);
			$tpl->set_var('custname',$this->user['udspname']);		
		}else{
			$tpl->set_var('isreg',1);
			$tpl->set_var('userid',$this->user['uid']);
			$tpl->set_var('custname',"尊敬的用户");	
		}				
		$tpl->parse("result", "main"); 
		//输出替换的结果 
		$tpl->p("result");
	}
		
	//注册新用户
	public function regditUser(){
		$req_udspname=isset($this->reqParams['udspname'])?$this->reqParams['udspname']:"";
		$req_upasswd=isset($this->reqParams['upasswd'])?$this->reqParams['upasswd']:"";
		$req_ucompany=isset($this->reqParams['ucompany'])?$this->reqParams['ucompany']:"";
		$req_udepart=isset($this->reqParams['udepart'])?$this->reqParams['udepart']:"";
		$req_ulinkman=isset($this->reqParams['ulinkman'])?$this->reqParams['ulinkman']:"";
		$req_uphone=isset($this->reqParams['uphone'])?$this->reqParams['uphone']:"";
		$req_uemail=isset($this->reqParams['uemail'])?$this->reqParams['uemail']:"";
		if($req_udspname!="" && $req_upasswd!=""){
			$md5_pwd=md5($req_upasswd);
			$sql="insert into sh_user(uname,udspname,upasswd,uemail,ucompany,udepart,ulinkman,uphone,uisadmin) ".
			"values('$req_udspname','$req_udspname','$md5_pwd','$req_uemail','$req_ucompany','$req_udepart','$req_ulinkman','$req_uphone',1)";
			$this->db->query($sql);
			$userid=$this->db->insert_id();
			//如果是新用户就建立会话信息			
			$qsql="select * from sh_session where sid='$userid'";
			$sqey=$this->db->fetch_first($qsql);
			if($sqey==false){			
				$this->createSession($userid,0);			
			}		
			$this->setUserCookie($userid,0);
			$this->setUserVar($userid,0);
			//返回给客户
			echo $userid;		
			return;
		}
		echo "0";//表示注册失败
	}
	//普通用户登录
	public function userLogin(){
		$req_username=isset($this->reqParams['username'])?$this->reqParams['username']:"";
		$req_upasswd=isset($this->reqParams['upasswd'])?$this->reqParams['upasswd']:"";
		if($req_username!="" && $req_upasswd!=""){
			$trim_req_uname=trim($req_username);
			$sql="select * from sh_user where uname='$trim_req_uname'";
			$result=$this->db->fetch_first($sql);
			if($result==false){
				echo "0";//没有这个用户
				return;
			}else{
				$md5_req_pwd=md5(trim($req_upasswd));
				if($result['upasswd']!=$md5_req_pwd){
					echo "-1";//密码错误
					return ;
				}else{
					$this->setUserCookie($result['uid'],0);
					$this->setUserVar($result['uid'],0);
					echo $result['uid'];//登录成功
					return ;
				}
			}
		}
	} 
}
?>