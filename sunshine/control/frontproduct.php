<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

require SUNSHINE_ROOT."/model/pagehandler.php";

//前台产品列表处理类
class frontproduct extends base{
	
	public function frontproduct(){
		$this->base();
	}
	
	//根据类别名称得到产品列表
	public function dodefault() {		
		$instr="";//是否查询所有产品
		$req_ctname = isset($this->reqParams['ctname'])?$this->reqParams['ctname']:"";
		//如果是'关于我们'栏目就直接显示'关于我们'的页面
		if($req_ctname=='关于我们'){
			$tpl = new Template($this->template_path, "keep");		 
			$tpl->set_file("aboutus", "main/about_us.html");
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
			$tpl->parse("result","aboutus");				 
			$tpl->p("result");
			return ;
		}
		//
		if($req_ctname!=""){
			$instr=$this->getcidsbyname(trim($req_ctname));
		}		
		//
		$psql="select count(*) from sh_product";
		if($instr!=""){
			$psql="select count(*) from sh_product where cid in ($instr)";
		}
		$pageh=new pagehandler($psql,$this->db,$this->reqParams,8);		
		$qstart=$pageh->getStartIndex();
		$rsofpage=$pageh->getRsOfPage();
		$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
		"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
		"order by a.pid desc limit $qstart,$rsofpage";
		if($instr!=""){
			$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
			"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
			"where a.cid in (".$instr.") order by a.pid desc limit $qstart,$rsofpage";
		}
		$this->showProdunctList($sql,$pageh,'dodefault','ctname');
	}
	
	//根据查询到的结果显示产品列表
	private function showProdunctList($sql,$pageh,$mtd,$para){
		$tpl = new Template($this->template_path, "keep");
		//将整个文件读进来 
		$tpl->set_file("product", "main/product_list.html");
		$tpl->set_block('product', 'list', 'nlist');
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
		$tpl->set_var('cur_page',$pageh->getCurPage());
		$tpl->set_var('max_page',$pageh->getTotalPage());
		$tpl->set_var('bcmethod',$mtd);
		$tpl->set_var('bcparam',$para."=".$this->reqParams[$para]);
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
		//
		$tpl->parse("result","product");				 
		$tpl->p("result");
	}
	
	//根据分类名称得到该分类及该分类下所有子分类，以字符串形式返回
	private function getcidsbyname($ctname){
		$ret_arr=array();
		$csql="select cid,clevel from sh_category where ctitle like '%$ctname%'";
		$crow=$this->db->fetch_first($csql);
		if($crow!=false){
			$ret_arr[]=$crow['cid'];
			if($crow['clevel']==0){
				$nsql="select cid from sh_category where cpid=".$crow['cid'];
				$nquery=$this->db->query($nsql);
				while(($ncrow=$this->db->fetch_array($nquery))!=false){
					$ret_arr[]=$ncrow['cid'];
				}
			}	
		}
		$str=implode(",",$ret_arr);
		return $str; 		
	}	
	//根据产品id得到产品的详细信息
	public function getprodetail(){
		$pid = isset($this->reqParams['pid'])?$this->reqParams['pid']:1;
		$sql="select * from sh_product where pid=".$pid;
		$crow=$this->db->fetch_first($sql);
		if($crow!=false){
			$tpl = new Template($this->template_path, "keep");
			//将整个文件读进来 
			$tpl->set_file("product", "main/product_detail.html");
			//
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
			//
			$tpl->parse("result","product");			
			$tpl->p("result");
		}else{
			echo "没有找到产品信息";
		}
	}
	//按关键字查询
	public function searchByKey(){
		$keyword = isset($this->reqParams['keyword'])?$this->reqParams['keyword']:"";		
		$psql="select count(*) from sh_product";
		if($keyword!=""){
			$psql="select count(*) from sh_product where pname like '%$keyword%' "
			."or pdesc like '%$keyword%' or pcode like '%$keyword%'";
		}
		$pageh=new pagehandler($psql,$this->db,$this->reqParams,8);		
		$qstart=$pageh->getStartIndex();
		$rsofpage=$pageh->getRsOfPage();
		$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
		"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
		"order by a.pid desc limit $qstart,$rsofpage";
		if($keyword!=""){
			$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
			"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
			"where a.pname like '%$keyword%' or a.pdesc like '%$keyword%' or a.pcode like '%$keyword%' ".
			"order by a.pid desc limit $qstart,$rsofpage";
		}
		$this->showProdunctList($sql,$pageh,'searchByKey','keyword');
	}
}
?>