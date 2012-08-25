<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

class channel extends base{
	
	public function channel(){
		$this->base();
	}
	
	public function dodefault() {	
		//创建一个实例 
		$tpl = new Template($this->template_path, "remove");
		//将整个文件读进来 
		$tpl->set_file("channel", "admin/channel.html");
		$tpl->set_file("ch_channel","admin/ch_channel.html");
		$tpl->set_block('ch_channel', 'list', 'nlist');
		//查询		
		$sql="select * from sh_channel order by chid";
		$query=$this->db->query($sql);
		while (($crow=$this->db->fetch_array($query))!=false){			
			$tpl->set_var('chid',intval($crow['chid'])); 
			$tpl->set_var('chname',$crow['chname']);
			$tpl->set_var('chcrtdate',$crow['chcrtdate']); 
			$tpl->set_var('chdesc',$crow['chdesc']);			
			$tpl->parse('nlist', 'list', true);			
		}
		$tpl->parse("content_list","ch_channel");
		$tpl->parse("result","channel");
		//输出替换的结果		 
		$tpl->p("result");
	}
	//增加栏目
	public function addChannel(){
		$req_chname=$this->reqParams['chname'];
		$req_chdesc=$this->reqParams['chdesc'];
		$qsql="select count(*) from sh_channel where chname='$req_chname'";
		if($this->db->result_first($qsql)<=0){
			$sql="insert into sh_channel(chname,chcrtdate,chdesc) values('$req_chname','$this->format_time','$req_chdesc')";
			$this->db->query($sql);
		}
		$this->dodefault();
	}
	//删除栏目
	public function delChannel(){
		$catids = isset($this->reqParams['chids'])?$this->reqParams['chids']:null;
		if($catids!=null){
			$chid_arr=split("-",$catids);
			foreach($chid_arr as $vchid){
				$qsql="select count(*) from sh_product where chid=$vchid";
				if($this->db->result_first($qsql)>0) continue;
				$sql="delete from sh_channel where chid=$vchid";
				$this->db->query($sql);	
			}			
		}		
		$this->dodefault();
	}
	//根据栏目id得到该栏目下的所有产品
	public function getProductByChid(){
		$req_chid=$this->reqParams['chid'];
		$tpl = new Template($this->template_path, "remove");
		//将整个文件读进来 
		$tpl->set_file("channel", "admin/channel.html");
		$tpl->set_file("ch_product","admin/ch_product.html");
		$tpl->set_block('ch_product', 'list', 'nlist');
		$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
		"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
		"where a.chid=$req_chid order by a.pid desc";
		$query=$this->db->query($sql);
		while (($crow=$this->db->fetch_array($query))!=false){		
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
			$tpl->parse('nlist', 'list', true);		
		}
		$tpl->parse("content_list","ch_product");
		$tpl->parse("result","channel");
		//输出替换的结果		 
		$tpl->p("result");
	}
	//删除栏目下的产品
	public function delProductOfCh(){
		$pids = isset($this->reqParams['pids'])?$this->reqParams['pids']:null;
		if($pids!=null){
			$pid_str=implode(",",split("-",$pids));
			$sql="update sh_product set chid=null where pid in (".$pid_str.")";
			$this->db->query($sql);			
		}
		$this->dodefault();		
	}
	//得到栏目列表
	public function get_channel_list(){
		$sql="select * from sh_channel order by chid";
		return $this->db->get_result($sql);
	}
	
	//得到栏目列表对话框
	public function getChlDlg(){		
		$content = '<dl>';		
		$shcate=0;//上一级分类				
		$cats = $this->get_channel_list();	
		if(is_array($cats))	{			
			foreach($cats as $p){				
				$img = $img = '<input onclick="javascript:void(0)" type="image" src="images/admin/no_next.gif"/>';
				$content .= '<dd>'.$img.'<a href="javascript:producttoch.cateOk('.$p['chid'].',\''.$p['chname'].'\')">'.$p['chname'].'</a></dd>';			
			}
		}else{
			$content .= '<dd>分类不存在</dd>';
		}
		$content .= '<dt class="mar-t8 bor-gray-das">&nbsp;</dt></dl>';		
		echo $content; 
	}
	//把产品加到指定栏目下
	public function addproductToCh(){
		$pids = isset($this->reqParams['pids'])?$this->reqParams['pids']:"";
		$chid=$this->reqParams['chid'];	
		$pid_arr=split("-",$pids);
		foreach ($pid_arr as $pid_item){
			$sql="update sh_product set chid=$chid where pid=$pid_item";
			$this->db->query($sql);
		}
	}
}
?>