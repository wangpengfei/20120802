<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

require SUNSHINE_ROOT."/model/pagehandler.php";

class product extends base{
	
	public function product(){
		$this->base();
	}
	
	//在管理页面分页查询产品列表
	public function dodefault() {		
		$psql="select count(*) from sh_product";
		$pageh=new pagehandler($psql,$this->db,$this->reqParams);
		//
		$tpl = new Template($this->template_path, "remove");
		//将整个文件读进来 
		$tpl->set_file("product", "admin/product.html");
		$tpl->set_block('product', 'list', 'nlist');
		//查询		
		$qstart=$pageh->getStartIndex();
		$rsofpage=$pageh->getRsOfPage();
		$sql="select pid,pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,".
		"pimage,(select ctitle from sh_category where cid=a.cid) as cid from sh_product a ".
		"order by a.pid desc limit $qstart,$rsofpage";
		$query=$this->db->query($sql);
		while (($crow=$this->db->fetch_array($query))!=false){		
			$tpl->set_var('pid',intval($crow['pid'])); 
			$tpl->set_var('pname',$crow['pname']);
			$tpl->set_var('pcode',$crow['pcode']); 
			$tpl->set_var('pmarketprice',$crow['pmarketprice']);
			$tpl->set_var('pteamprice',$crow['pteamprice']);
			$tpl->set_var('pspec',util::getbriefstr($crow['pspec']));
			$tpl->set_var('pdesc',util::getbriefstr($crow['pdesc']));
			$tpl->set_var('pregtime',$crow['pregtime']);
			$tpl->set_var('pimage',$crow['pimage']);
			$tpl->set_var('cid',$crow['cid']);
			$tpl->parse('nlist', 'list', true);		
		}
		$tpl->set_var('cur_page',$pageh->getCurPage());
		$tpl->set_var('max_page',$pageh->getTotalPage());
		$tpl->parse("result","product");
		//输出替换的结果		 
		$tpl->p("result");
	}
	
	//增加产品信息
	public function addproduct(){
		$temp_dir=$this->getFormatDT('Y-m-d');
		$ext_name=$this->getFileEx(basename($_FILES['pimage']['name']));
		$des_fname=$this->getFormatDT('His').floor(microtime()*1000).'.'.$ext_name;
		//存储文件的路径,如果不存在这样的目录就创建
		//$uploaddir=SUNSHINE_ROOT.'/images/product/'.$temp_dir;
		$uploaddir='images/product/'.$temp_dir;
		if(is_dir($uploaddir)!=true){
			mkdir($uploaddir);
		}
		$abs_path='images/product/'.$temp_dir.'/'.$des_fname;
		//$uploadfile  = SUNSHINE_ROOT.'/'.$abs_path;		
		if (move_uploaded_file($_FILES['pimage']['tmp_name'], $abs_path)) {
    		$pname=$this->reqParams['pname'];
    		$pmarketprice=$this->reqParams['pmarketprice'];
    		$pteamprice=$this->reqParams['pteamprice'];
    		$pcode=$this->reqParams['pcode'];
    		$cid=$this->reqParams['cid'];
    		$pspec=$this->reqParams['pspec'];
    		$pdesc=$this->reqParams['pdesc'];
    		//保存数据
    		$sql="insert into sh_product(pname,pcode,pmarketprice,pteamprice,pspec,pdesc,pregtime,pimage,cid)".
    		" values('$pname','$pcode','$pmarketprice','$pteamprice','$pspec','$pdesc','$this->format_time','$abs_path',$cid)";    		
    		$this->db->query($sql);
		}
		$this->dodefault();
	}
	//批量删除产品
	public function delProducts(){
		$pids = isset($this->reqParams['pids'])?$this->reqParams['pids']:null;
		if($pids!=null){
			$pid_arr=split("-",$pids);
			foreach ($pid_arr as $value){
				$qsql="select * from sh_product where pid=".$value;
				$itemprod=$this->db->fetch_first($qsql);
				if($itemprod==false) continue;
				$file_path=SUNSHINE_ROOT."/".$itemprod['pimage'];
				if(unlink($file_path)){
					$sql="delete from sh_product where pid=".$value;
					$this->db->query($sql);		
				}
			}						
		}
		$this->dodefault();		
	}
	//根据id得到某一个产品的详细信息
	public function jsongetprodbyid(){
		$ret="";
		$pid = isset($this->reqParams['pid'])?$this->reqParams['pid']:null;
		if($pid!=null){			
			$sql="select b.ctitle,a.*  from sh_product as a inner join sh_category as b on a.cid=b.cid where a.pid=".$pid;			
			$itemprod=$this->db->fetch_first($sql);
			if($itemprod!=false){
				$ret=json_encode($itemprod);
			}
		}		
		echo $ret;
	}
	//更新产品信息
	public function updateprodinfo(){
		$pid = isset($this->reqParams['pid'])?$this->reqParams['pid']:null;
		$pname = isset($this->reqParams['pname'])?$this->reqParams['pname']:"";
		$pmarketprice = isset($this->reqParams['pmarketprice'])?$this->reqParams['pmarketprice']:"0.00";
		$pteamprice = isset($this->reqParams['pteamprice'])?$this->reqParams['pteamprice']:"0.00";
		$pcode = isset($this->reqParams['pcode'])?$this->reqParams['pcode']:"";
		$cid = isset($this->reqParams['cid'])?$this->reqParams['cid']:null;
		$pspec = isset($this->reqParams['pspec'])?$this->reqParams['pspec']:"";
		$pdesc = isset($this->reqParams['pdesc'])?$this->reqParams['pdesc']:"";
		//
		if($pid!=null){			
			$sql="update sh_product set pname='$pname',pmarketprice='$pmarketprice',pteamprice='$pteamprice',"
			."pcode='$pcode',cid=$cid,pspec='$pspec',pdesc='$pdesc' where pid=$pid";			
			$this->db->query($sql);
		}
		$this->dodefault();
	}
}
?>