<?php
!defined ( 'IN_SUNSHINE' ) && exit ( 'Access Denied' );

class category extends base{
	
	public function category(){
		$this->base();
	}
	
	public function dodefault() {
		//请求参数		
		$req_cpid = isset($this->reqParams['cur_cpid'])?$this->reqParams['cur_cpid']:0;		
		$req_clevel=-1;//默认值
		//创建一个实例 
		$tpl = new Template($this->template_path, "remove");
		//将整个文件读进来 
		$tpl->set_file("category", "admin/categorylist.html");
		$tpl->set_block('category', 'list', 'nlist');
		//查询		
		$sql="select * from sh_category where cpid=$req_cpid";
		$query=$this->db->query($sql);
		while (($crow=$this->db->fetch_array($query))!=false){			
			$tpl->set_var('cpid',intval($crow['cpid'])); 
			$tpl->set_var('cid',$crow['cid']);
			$tpl->set_var('ctitle',$crow['ctitle']); 
			$tpl->set_var('cdesc',$crow['cdesc']);
			$tpl->set_var('csetuptime',$crow['csetuptime']);
			$tpl->set_var('clevel',intval($crow['clevel']));
			$tpl->set_var('clevelName',$this->getLevel($crow['clevel']));
			$tpl->set_var('cisinure',$this->getIsinure($crow['cisinure']));
			$tpl->parse('nlist', 'list', true);			
		}
		$tpl->set_var('cur_cpid',$req_cpid);
		//处理导航条 
		if($req_cpid>0){
			$pobj=$this->getRecById($req_cpid);
			$req_clevel=intval($pobj['clevel'])+1;
			if($req_clevel==1){			
				$turl="index.php?action=category&method=dodefault&cur_cpid=$req_cpid";			
				$tpl->set_var('secondLevel',$this->getNavHtml($turl,$pobj['ctitle']));
			}	
		}
		//$tpl->set_var('cur_clevel',$req_cpid);
		$tpl->parse("result","category");
		//输出替换的结果		 
		$tpl->p("result");
	}
	//根据id查询一条分类记录
	private function getRecById($cid){
		$qsql="select * from sh_category where cid=$cid";
		$pobj=$this->db->fetch_first($qsql);
		return $pobj; 
	}
	//根据一个分类id查询该分类下所有子分类
	public function get_subcate($cpid){
		$sql="select * from sh_category where cpid=$cpid";
		return $this->db->get_result($sql);		
	}
	//构造导航条某个节点的html代码
	private function getNavHtml($url,$title){
		$retStr='&gt;&gt;&nbsp;<a href="'.$url.'">'.$title.'</a>&nbsp;';		
		return $retStr;
	}
	//转换产品分类级别字段
	private function getLevel($level){
		if($level==0){
			return "一级分类";
		}else if($level==1){
			return "二级分类";
		}else if($level==2){
			return "三级分类";
		}
	}
	//转换生效标志字段
	private function getIsinure($isinure){
		if($isinure==0){
			return "已生效";
		}else{
			return "未生效";
		}
	}
	//增加产品分类
	public function addCategory() {
		$req_ctitle=$this->reqParams['ctitle'];
		$req_cdesc=$this->reqParams['cdesc'];
		$req_cur_cpid=$this->reqParams['cur_cpid'];		
		if($req_cur_cpid=='0'){
			$clevel=0;
		}else{
			$qsql="select clevel from sh_category where cid=$req_cur_cpid";
			$qresult=$this->db->fetch_first($qsql);
			$clevel=$qresult['clevel']+1;
		}
		//插入数据
		$sql="insert into sh_category(cpid,ctitle,csetuptime,clevel,cdesc,cisinure) ".
		"values ($req_cur_cpid,'$req_ctitle','$this->format_time',$clevel,'$req_cdesc',0)";
		$this->db->query($sql);
		//重新查询，显示界面
		$this->dodefault();
	}
	//得到分类对话框
	public function getCateDlg(){		
		$catid = isset($this->reqParams['cpid'])?$this->reqParams['cpid']:0;
		$catid = intval($catid);
		$content = '<dl>';		
		//$content .= '<dt class="r"></dt>';
		$shcate=0;//上一级分类
		if($catid!=0){
			$cat = $this->getRecById($catid);
			$content .= '<dd><a href="javascript:catevalue.cateOk('.$cat['cid'].',\''.$cat['ctitle'].'\')">'.$cat['ctitle'].'</a></dd><br></br>';
			$shcate=$cat['cpid'];
		}		
		$cats = $this->get_subcate($catid);		
		if(is_array($cats))	{			
			foreach($cats as $p){
				if($this->get_subcate($p['cid'])){
					$img = '<input onclick="javascript:catevalue.ajax('.$p['cid'].')" type="image" src="images/admin/add.gif"/>';
					$content .= '<dd>'.$img.'<a href="javascript:catevalue.cateOk('.$p['cid'].',\''.$p['ctitle'].'\')">'.$p['ctitle'].'</a></dd>';
				}else{
					 $img = $img = '<input onclick="javascript:void(0)" type="image" src="images/admin/no_next.gif"/>';
					$content .= '<dd>'.$img.'<a href="javascript:catevalue.cateOk('.$p['cid'].',\''.$p['ctitle'].'\')">'.$p['ctitle'].'</a></dd>';
				}
			}
		}else{
			$content .= '<dd>分类不存在</dd>';
		}
		$content .= '<dt>&nbsp;</dt>';
		$content .= '<dt class="mar-t8 bor-gray-das"><a href="javascript:catevalue.ajax('.$shcate.')" class="r">'.
		'<img alt="" src="images/admin/up.jpg" class="tag_help"/>上一级分类</a><a href="javascript:catevalue.ajax(0)" class="r">'.
		'<img alt="" src="images/admin/up.jpg" class="tag_help"/>一级分类</a></dt></dl>';
		//$content .= '<dt class="rclear bor-gray-das">&nbsp;</dt>';
		echo $content; 
	}
	//批量删除产品分类
	public function delCategory(){
		$catids = isset($this->reqParams['cids'])?$this->reqParams['cids']:null;
		if($catids!=null){
			$cid_str=implode(",",split("-",$catids));
			$sql="delete from sh_category where cid in (".$cid_str.")";
			$this->db->query($sql);
		}		
		$this->dodefault();
	}
}
?>
