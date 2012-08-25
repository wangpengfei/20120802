<?php
/*******************线图*****************/
session_start();
require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph.php');
require_once (substr(dirname($_SERVER['SCRIPT_FILENAME']),0,-5).'jpgraph_line.php');

$graph = new Graph(400+count($_SESSION['report_d'])*40,400);
$graph->img->SetMargin(80,20,40,100);	
$graph->img->SetAntiAliasing();
$graph->SetScale("textint");
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetTickLabels($_SESSION['report_d']);
$graph->xaxis->SetLabelAngle(15);

$graph->SetShadow();
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->title->Set($_SESSION['report_title'].",总数：".$_SESSION['report_t']);
$graph->yscale->SetGrace(1,10);
$p1 = new LinePlot($_SESSION['report_c']);
$p1->value->Show();
$p1->mark->SetType(MARK_FILLEDCIRCLE);
$p1->mark->SetFillColor("red");
$p1->mark->SetWidth(4);
$p1->SetColor("blue");
$p1->SetCenter();
$p1->value->SetFormat('%d');//
$graph->Add($p1);
$graph->Stroke();
?>