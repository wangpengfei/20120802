<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Author: Wan Luoliang.
*	
********************************************************************************/
header("Content-Type:text/html;charset=UTF-8"); 
/** Error reporting */   
error_reporting(E_ERROR);
set_time_limit(0);
ini_set("memory_limit","512M");

/** PHPExcel */   
include 'PHPExcel.php';   
   
/** PHPExcel_Writer_Excel2005 */   
include 'PHPExcel/Writer/Excel5.php';   

/**check encode */
function isUTF8($str) {
	$encodestr = mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32");
	if ($str === $encodestr ) {
		return true;
	} else {
		return false;
	}
}   

/** encodeing conv*/
function checkandconv($str){
	$new_str="";
	for($i=0;$i<100;$i++){
		if(strlen($str)<10){
			$new_str .= $str;
		}else{
			break;
		}
	}
	if(!isUTF8($new_str)){
		$str = iconv('GB2312', 'UTF-8', $str);
	}

	if( strlen($str)>14 && is_numeric($str) ){
		return "`".$str;
	}else{
		return $str;
	}
}
 
function createxls($data_arr){

	global $tmp_dir, $root_directory;
	$fname = tempnam($root_directory.$tmp_dir, "merge2.xls");

	// Create new PHPExcel object   
	$objPHPExcel = new PHPExcel();   
	
	// Add some data   
	$objPHPExcel->setActiveSheetIndex(0);  
	// Rename sheet   
	$objPHPExcel->getActiveSheet()->setTitle('Simple');   
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet   
	$objPHPExcel->setActiveSheetIndex(0);  


	if(isset($data_arr))
	{	
		// Add some data   
		$header = array_keys($data_arr[0]);
		$headerlength = count($header);
		//写入表头
		for($k=0,$currentColumn='A';$k<$headerlength;$k++,$currentColumn++){   
			$address = $currentColumn."1";  
			$objPHPExcel->getActiveSheet()->setCellValue($address,checkandconv($header[$k]));   
		} 
	
		$bodyrows = count($data_arr);
		//写入数值
		$currentRow=2;
		foreach($data_arr as $key => $val){
			$currentColumn='A';
			foreach($val as $key1 => $val1){
				$address = $currentColumn.$currentRow;   
				$objPHPExcel->getActiveSheet()->setCellValue($address,checkandconv($val1)); 
				$length = strlen(trim($val1));
				if($length>14 && $currentRow==2 ){
$objPHPExcel->getActiveSheet()->getColumnDimension($currentColumn)->setWidth($length); 
				}else{
$objPHPExcel->getActiveSheet()->getColumnDimension($currentColumn)->setWidth(13); 
				}
				$currentColumn++; 	
			}
			$currentRow++;
		}
	}

	// Save Excel 2007 file   
	$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 
	$objWriter->save($fname); 
	
	if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	{
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	}

	header("Content-Type: application/x-msexcel");
	header("Content-Length: ".@filesize($fname));
	$filename= $_REQUEST['module'];
	header('Content-disposition: attachment; filename="'.$filename.'.xls"');
	$fh=fopen($fname, "rb");
	fpassthru($fh);
}

?>
