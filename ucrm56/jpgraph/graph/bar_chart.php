<?php
/*******************柱图*****************/
session_start();
require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph.php');
require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph_bar.php');

$graph = new Graph(400+count($_SESSION['report_d'])*40,400,'auto');
$graph->img->SetMargin(80,20,40,100);
$graph->SetShadow();
$graph->SetScale("textint");
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetTickLabels($_SESSION['report_d']);
$graph->xaxis->SetLabelAngle(15);
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->title->Set($_SESSION['report_title'].",总数：".$_SESSION['report_t']);
$b1 = new BarPlot($_SESSION['report_c']);
$b1->value->Show();
$b1->value->SetFormat('%d');//
$graph->Add($b1);
$graph->Stroke();
/****************************************/
?>