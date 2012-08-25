<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
********************************************************************************/
?>
<html>
<body>
<script>
if (document.layers)
{
	document.write(alert_arr.Higher_Brower);
	document.write("<br><br>"+alert_arr.Click+" <a href='#' onclick='window.history.back();'>"+alert_arr.Here+"</a> "+alert_arr.Return_Previous_Page+"<br><br>");
}	
else if (document.layers || (!document.all && document.getElementById))
{
	document.write(alert_arr.Higher_Brower);
	document.write("<br><br>"+alert_arr.Click+" <a href='#' onclick='window.history.back();'>"+alert_arr.Here+"</a> "+alert_arr.Return_Previous_Page+"<br><br>");	
}
else if(document.all)
{
	document.write("<br><br>"+alert_arr.Click+" <a href='#' onclick='window.history.back();'>"+alert_arr.Here+"</a> "+alert_arr.Return_Previous_Page+"<br><br>");
	document.write("<OBJECT Name='vtigerCRM' codebase='modules/Settings/vtigerCRM.CAB#version=1,5,0,0' id='objMMPage' classid='clsid:0FC436C2-2E62-46EF-A3FB-E68E94705126' width=0 height=0></object>");
}
</script>
<?php
require_once('include/database/PearDatabase.php');
require_once('config.php');
ini_set('display_errors','Off');
global $default_charset,$app_strings;

// Fix For: http://trac.vtiger.com/cgi-bin/trac.cgi/ticket/2107
$randomfilename = "vt_" . str_replace(array("."," "), "", microtime());

$templateid = $_REQUEST['mergefile'];
if($templateid == "")
{
	die('<font color=red>'.$app_strings['Select_Merge_Template'].'</font>');
}
//get the particular file from db and store it in the local hard disk.
//store the path to the location where the file is stored and pass it  as parameter to the method 
$sql = "select filename,data,filesize from vtiger_wordtemplates where templateid=?";

$result = $adb->pquery($sql, array($templateid));
$temparray = $adb->fetch_array($result);

$fileContent = $temparray['data'];
$filename=html_entity_decode($temparray['filename'], ENT_QUOTES, $default_charset);

// Fix For: http://trac.vtiger.com/cgi-bin/trac.cgi/ticket/2107
$filename= $randomfilename . "_word.doc";

$filesize=$temparray['filesize'];
$wordtemplatedownloadpath =$root_directory ."/test/wordtemplatedownload/";


$handle = fopen($wordtemplatedownloadpath .$filename,"wb");
fwrite($handle,base64_decode($fileContent),$filesize);
fclose($handle);

//for mass merge
$mass_merge = $_REQUEST['allselectedboxes'];
$single_record = $_REQUEST['record'];

if($mass_merge != "")
{	
	$mass_merge = explode(";",$mass_merge);
	//array_pop($mass_merge);
	$temp_mass_merge = $mass_merge;
	if(array_pop($temp_mass_merge)=="")
		array_pop($mass_merge);
	//$mass_merge = implode(",",$mass_merge);
}else if($single_record != "")
{
	$mass_merge = $single_record;	
}else
{
	die('<font color=red>'.$app_strings['Record_Not_Found'].'</font>');
}

//<<<<<<<<<<<<<<<<header for csv and select columns for query>>>>>>>>>>>>>>>>>>>>>>>>

global $current_user;
require('user_privileges/user_privileges_'.$current_user->id.'.php');
if($is_admin == true || $profileGlobalPermission[1] == 0 || $profileGlobalPermission[2] == 0 || $module == "Users" || $module == "Emails")
{
	$query1="select tablename,columnname,fieldlabel from vtiger_field where tabid=7 and vtiger_field.presence in (0,2) order by tablename";
	$params1 = array();
}
else
{
	$profileList = getCurrentUserProfileList();
	$query1="select vtiger_field.tablename,vtiger_field.columnname,vtiger_field.fieldlabel from vtiger_field INNER JOIN vtiger_profile2field ON vtiger_profile2field.fieldid=vtiger_field.fieldid INNER JOIN vtiger_def_org_field ON vtiger_def_org_field.fieldid=vtiger_field.fieldid where vtiger_field.tabid in (7) AND vtiger_profile2field.visible=0 AND vtiger_def_org_field.visible=0 AND vtiger_profile2field.profileid IN (". generateQuestionMarks($profileList) .") and vtiger_field.presence in (0,2) GROUP BY vtiger_field.fieldid order by vtiger_field.tablename";
	$params1 = array($profileList);
	//Postgres 8 fixes
	if( $adb->dbType == "pgsql")
		$query1 = fixPostgresQuery( $query1, $log, 0);
}

$result = $adb->pquery($query1, $params1);

$y=$adb->num_rows($result);
	
for ($x=0; $x<$y; $x++)
{ 
  $tablename = $adb->query_result($result,$x,"tablename");
  $columnname = $adb->query_result($result,$x,"columnname");
	$querycolumns[$x] = $tablename.".".$columnname;
  if($columnname == "smownerid")
  {
    $querycolumns[$x] = "case when (vtiger_users.user_name not like '') then concat(vtiger_users.last_name,' ',vtiger_users.first_name) else vtiger_groups.groupname end as username,vtiger_users.first_name,vtiger_users.last_name,vtiger_users.user_name,vtiger_users.yahoo_id,vtiger_users.title,vtiger_users.phone_work,vtiger_users.department,vtiger_users.phone_mobile,vtiger_users.phone_other,vtiger_users.phone_fax,vtiger_users.email1,vtiger_users.phone_home,vtiger_users.email2,vtiger_users.address_street,vtiger_users.address_city,vtiger_users.address_state,vtiger_users.address_postalcode,vtiger_users.address_country";
  }
  $field_label[$x] = "LEAD_".strtoupper(str_replace(" ","",$adb->query_result($result,$x,"fieldlabel")));
	if($columnname == "smownerid")
  		{
  			$field_label[$x] = $field_label[$x].",USER_FIRSTNAME,USER_LASTNAME,USER_USERNAME,USER_YAHOOID,USER_TITLE,USER_OFFICEPHONE,USER_DEPARTMENT,USER_MOBILE,USER_OTHERPHONE,USER_FAX,USER_EMAIL,USER_HOMEPHONE,USER_OTHEREMAIL,USER_PRIMARYADDRESS,USER_CITY,USER_STATE,USER_POSTALCODE,USER_COUNTRY";
  		}
}
$csvheader = implode(",",$field_label);
//<<<<<<<<<<<<<<<<End>>>>>>>>>>>>>>>>>>>>>>>>
	
if(count($querycolumns) > 0)
{
	$selectcolumns = implode($querycolumns,",");

$query = "select ".$selectcolumns." from vtiger_leaddetails 
  inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_leaddetails.leadid 
  inner join vtiger_leadsubdetails on vtiger_leadsubdetails.leadsubscriptionid=vtiger_leaddetails.leadid 
  inner join vtiger_leadaddress on vtiger_leadaddress.leadaddressid=vtiger_leadsubdetails.leadsubscriptionid 
  inner join vtiger_leadscf on vtiger_leaddetails.leadid = vtiger_leadscf.leadid 
  LEFT JOIN vtiger_groups
  	ON vtiger_groups.groupid = vtiger_crmentity.smownerid
  left join vtiger_users on vtiger_users.id = vtiger_crmentity.smownerid
  where vtiger_crmentity.deleted=0 and vtiger_leaddetails.leadid in (". generateQuestionMarks($mass_merge) .")";
		
$result = $adb->pquery($query, array($mass_merge));
if(!$result){
	die('<font color=red>'.$app_strings['Wrong_Fields_Merge'].'</font>');
}
$avail_pick_arr = getAccessPickListValues('Leads');	
while($columnValues = $adb->fetch_array($result))
{
  $y=$adb->num_fields($result);
  for($x=0; $x<$y; $x++)
  {
	  $value = $columnValues[$x];
	 foreach($columnValues as $key=>$val)
	 {
		if($val == $value && $value != '')
		{
		  if(array_key_exists($key,$avail_pick_arr))
		  {
			if(!in_array($val,$avail_pick_arr[$key]))
			{
				$value = $app_strings['LBL_NOT_ACCESSIBLE'];
			}
		  }
		}
	 }
  	//<<<<<<<<<<<<<<< For Blank Fields >>>>>>>>>>>>>>>>>>>>>>>>>>>>
  	if(trim($value) == "--None--" || trim($value) == "--none--")
  	{
  		$value = "";
  	}
	//<<<<<<<<<<<<<<< End >>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$actual_values[$x] = $value;
		$actual_values[$x] = str_replace('"'," ",$actual_values[$x]);
		//if value contains any line feed or carriage return replace the value with ".value."
		if (preg_match ("/(\r\n)/", $actual_values[$x])) 
		{
			$actual_values[$x] = '"'.$actual_values[$x].'"';
		}
		$actual_values[$x] = decode_html(str_replace(","," ",$actual_values[$x]));
  }
	$mergevalue[] = implode($actual_values,",");  	
}
$csvdata = implode($mergevalue,"###");
}else
{
	die('<font color=red>'.$app_strings['No_Fields_Merge'].'</font>');
}	
// Fix for: http://trac.vtiger.com/cgi-bin/trac.cgi/ticket/2107
$datafilename = $randomfilename . "_data.csv";

$handle = fopen($wordtemplatedownloadpath.$datafilename,"wb");
fwrite($handle,$csvheader."\r\n");
fwrite($handle,str_replace("###","\r\n",$csvdata));
fclose($handle);

?>

<script>
if (window.ActiveXObject){
	try 
	{
  		ovtigerVM = eval("new ActiveXObject('vtigerCRM.ActiveX');");
  		if(ovtigerVM)
  		{
        	var filename = "<?php echo $filename?>";
        	if(filename != "")
        	{
        		if(objMMPage.bDLTempDoc("<?php echo $site_URL?>/test/wordtemplatedownload/<?php echo $filename?>","MMTemplate.doc"))
        		{
        			try
        			{ 
        				if(objMMPage.Init())
        				{
        					objMMPage.vLTemplateDoc();
							objMMPage.bBulkHDSrc("<?php echo $site_URL;?>/test/wordtemplatedownload/<?php echo $datafilename ?>");
        					objMMPage.vBulkOpenDoc();
        					objMMPage.UnInit()
        					window.history.back();
        				}		
        			}catch(errorObject)
        			{	
        				document.write(alert_arr.Error_Merge_Operation);
        			}
        		}else
        		{
        			document.write(alert_arr.Cannot_Get_Template);
        		}
        	}
  		}
		}
	catch(e) {
		document.write(alert_arr.Need_ActiveX);
	}
}
</script>
</body>
</html>