<?php
/*******************饼图*****************/
session_start();

require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph.php');
require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph_pie.php');

$graph = new PieGraph(600+count($_SESSION['report_d'])*10,400+count($_SESSION['report_d'])*12,'auto');
$graph->SetShadow();
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->title->Set($_SESSION['report_title'].",总数：".$_SESSION['report_t']);
$p1 = new PiePlot($_SESSION['report_c']);
$p1->value->SetFont(FF_SIMSUN,FS_BOLD);
$p1->value->SetColor("darkred");
$p1->SetSize(0.3);
$p1->SetCenter(0.3);
/*
for($i=0; $i<=count($_SESSION['report_d']) ; $i++){
	$report_d[$i]=$_SESSION['report_d'][$i].'('.$_SESSION['report_c'][$i].')';
}
$p1->SetLegends($report_d);
*/
$pie_count=count($_SESSION['report_d']);
for($i=0; $i<=$pie_count ; $i++){
	$data_pie[$i]=$_SESSION['report_d'][$i].'('.$_SESSION['report_c'][$i].')';
}
$p1->SetLegends($data_pie);
$graph->Add($p1);
$graph->Stroke();
/****************************************/
?>