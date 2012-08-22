<?php
include("../base.php");

class Report extends Base{
    public function __construct(){
	parent::__construct();
	mysql_query("SET NAMES 'UTF8'");
    }
    
    public function getSkuComplaints(){
	$array = array();
	$totalCount = 0;
	$sql = "select * from complaints where `time` between '".$_REQUEST['start_date']."' and '".$_REQUEST['end_date']."'";
	//echo $sql."\n";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
	    $array[] = $row;
	    $totalCount++;
	}
	
	if($_GET['type'] == "xls"){
	    set_time_limit(600);
	    ini_set("memory_limit","256M");
	    require_once '../class/PHPExcel.php';
	    require_once '../class/PHPExcel/IOFactory.php';
    
	    $objExcel = new PHPExcel();
	    $objExcel->setActiveSheetIndex(0);
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'SKU');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Content');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'Date');
	    
	    $i = 2;
	    foreach($array as $value){
		$j = 0;
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value['sku']);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value['content']);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value['time']);
		$i++;
	    }
	    
	    $outputFileName = "SkuComplaints(".$_REQUEST['start_date']."--".$_REQUEST['end_date'].").xls";
	    header("Content-Type: application/force-download");     
	    header("Content-Type: application/octet-stream");     
	    header("Content-Type: application/download");     
	    header('Content-Disposition:inline;filename="'.$outputFileName.'"');     
	    header("Content-Transfer-Encoding: binary");     
	    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");     
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");     
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");     
	    header("Pragma: no-cache");     
	
	    $writer = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
	    $writer->save('php://output');	//echo $data;
	}else{
	    echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
	}
    }
    
}


$action = $_GET['action'];
$report = new Report();
$report->$action();