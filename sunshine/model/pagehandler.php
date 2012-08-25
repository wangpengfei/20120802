<?php

//分页处理类
class pagehandler {
	
	private $mdb=null;//数据库访问接口
	private $msql=null;//分页sql
	private $rs_of_page=10;//每页要显示的数据
	private $total_rs=0;//总记录数
	private $total_page=1;//总页数
	private $cur_page=1;//当前页
	
	//初始化
	function __construct($sql,$db,$reqArr,$rsofpage=10) {
		$this->mdb=$db;
		$this->msql=$sql;
		$this->rs_of_page=$rsofpage;
		//得到用户访问的当前页
		$reqCurPage=isset($reqArr['vpage'])?$reqArr['vpage']:1;		
		$this->cur_page=$reqCurPage;
		//
		$this->initpage();
	}
	
	//计算出总记录数和总页数
	private function initpage(){		
		$this->total_rs=$this->mdb->result_first($this->msql);
		if($this->total_rs>0){
			$ysh=$this->total_rs%$this->rs_of_page;
			if($ysh>0){
				$this->total_page=(($this->total_rs-$ysh)/$this->rs_of_page)+1;
			}else{
				$this->total_page=$this->total_rs/$this->rs_of_page;
			}
			//总页数默认为1
			if($this->total_page==0) $this->total_page=1;	
		}		
	}
	//得到总页数
	public function getTotalPage(){
		return $this->total_page;
	}
	//得到查询的起始索引
	public function getStartIndex(){
		if($this->cur_page>$this->total_page) $this->cur_page=$this->total_page;
		if($this->cur_page<=0) $this->cur_page=1;
		return $this->rs_of_page*($this->cur_page-1);
	}
	//得到每页要显示的记录
	public function getRsOfPage(){
		return $this->rs_of_page;
	}
	//得到当前访问的页数
	public function getCurPage(){
		return $this->cur_page;
	}
}

?>