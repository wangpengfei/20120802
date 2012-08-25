<?php

$selectmainmenusql = "SELECT * FROM vtiger_parenttab order by sequence";
$result =  $adb->pquery($selectmainmenusql,array());
if($result && $adb->num_rows($result)) {
	while($resultrow = $adb->fetch_array($result)) {
			$menu[$resultrow['parenttabid']] = $resultrow['parenttab_label'];
	}
}

$selectitemmenusql = "SELECT * FROM vtiger_parenttabrel";
$result =  $adb->pquery($selectitemmenusql,array());
if($result && $adb->num_rows($result)) {
	while($resultrow = $adb->fetch_array($result)) {
		$menuitem[$resultrow['parenttabid']][] = $resultrow['tabid'];
	}
}

$fd = fopen("parent_tabdata.php","w");

if($fd){
	$bk = chr( 10 );
	$qo = "  ";
	
	fwrite( $fd, "<?php".$bk );
	
	//写入主菜单
	$string = "";
	$string .= '$parent_tab_info_array=array(';
	foreach($menu as $key => $val){
	$string .= $key ."=>'".$val."',";
		if($val=="Settings"){
			$flag = $key;
		}
	}
	$string .= ');'.$bk;
	fwrite( $fd, $string );
	
	//写入子菜单
	
	if(!array_key_exists($flag,$menuitem))
	{
		$menuitem[$flag][]="";
	}
	
	$string = "";
	$string .= '$parent_child_tab_rel_array=array(';
	foreach($menuitem as $key => $val){
		$arr_val="array(";
		foreach($val as $key1=>$val1){
			$arr_val .= $val1.",";
		}
		$arr_val = substr($arr_val,0,-1);
		$arr_val.=")";
		$string .= $key ."=>".$arr_val.",";
	}
	$string .= ');'.$bk;
	fwrite( $fd, $string );
	

	fwrite( $fd, $bk."?>" );
	fclose( $fd );
}else{
	echo "please check parent_tabdata.php access";
}



?>