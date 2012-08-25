<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Content-Type:text/html;charset=UTF-8");
require 'PHPExcel/Reader/Excel2007.php';
ini_set("memory_limit","1024M");

class  readerexcel
{
	private $currentSheet;
	private $allColumn;
	private $allRow;

	function __construct($filePath)
	{
		$PHPExcel = new PHPExcel();     
		$PHPReader = new PHPExcel_Reader_Excel2007();    //新建excel2007读对象   
		if(!$PHPReader->canRead($filePath)){     		 //如果读对象格式不合，新建excel5读对象   
			$PHPReader = new PHPExcel_Reader_Excel5();    
			if(!$PHPReader->canRead($filePath)){      	 //如果还不对，输出没有excel   
				echo 'Not Excel';   
				return false;   
			} 
		}  
		$PHPExcel = $PHPReader->load($filePath);   
		$this->currentSheet = $PHPExcel->getSheet(0);  //取得excel工作分页   

		/**取得一共有多少列*/  
		$this->allColumn = $this->currentSheet->getHighestColumn();   

		/**取得一共有多少行*/  
		$this->allRow = $this->currentSheet->getHighestRow();   
	}

	function reader()
	{	
		//获取excel文件数据到数组   
		for($currentRow = 1;$currentRow<=$this->allRow;$currentRow++){
			$body = null;
			//超过26列的处理
			if(strlen($this->allColumn)>1){
				if($currentRow == 1){
					//获取列名
					for($currentColumn='A';$currentColumn<="Z";$currentColumn++){  
						$address = $currentColumn.$currentRow;   
						$header[] =  $this->currentSheet->getCell($address)->getValue();  
					} 
					for($currentColumn='AA';$currentColumn<="AZ";$currentColumn++){   
						$address = $currentColumn.$currentRow;   
						$header[] =  $this->currentSheet->getCell($address)->getValue();  
					}  
				}else{
					//获取数据
					$lie=0;
					for($i=0,$currentColumn='A';$currentColumn<="Z";$i++,$currentColumn++){  
						$address = $currentColumn.$currentRow;  
						$zhi = $this->currentSheet->getCell($address)->getValue();
						$rep_arr = array("`","'");
						$zhi = str_replace($rep_arr,"",$zhi);	
						if(!empty($header[$i])){$body[$header[$i]] = $zhi;}
						if(empty($zhi)){$kong++;}
						$lie++;
					} 
					for($i=$i,$currentColumn='AA';$currentColumn<="AZ";$i++,$currentColumn++){   
						$address = $currentColumn.$currentRow;  
						$zhi = $this->currentSheet->getCell($address)->getValue();
						$rep_arr = array("`","'");
						$zhi = str_replace($rep_arr,"",$zhi);	
						if(!empty($header[$i])){$body[$header[$i]] = $zhi;}
						if(empty($zhi)){$kong++;}
						$lie++;
					}   
				}
			}else{
			//少于26列的处理
				if($currentRow == 1){
					//获取列名
					for($currentColumn='A';$currentColumn<=$this->allColumn;$currentColumn++){   
						$address = $currentColumn.$currentRow;   
						$header[] =  $this->currentSheet->getCell($address)->getValue();  
					}  
				}else{
					//获取数据
					$lie=0;
					for($i=0,$currentColumn='A';$currentColumn<=$this->allColumn;$i++,$currentColumn++){   
						$address = $currentColumn.$currentRow;  
						$zhi = $this->currentSheet->getCell($address)->getValue();
						$rep_arr = array("`","'");
						$zhi = str_replace($rep_arr,"",$zhi);	
						if(!empty($header[$i])){$body[$header[$i]] = $zhi;}
						if(empty($zhi)){$kong++;}
						$lie++;
					}  
				}	
			}
			
			if($i!=1 && $kong!=$lie){
				$data_line[] = $body;
			}
		} 
		return $data_line;
	} 
}

?>
