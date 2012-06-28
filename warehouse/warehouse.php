<?php
include("../base.php");

class Warehouse extends Base{
    public function __construct(){
	parent::__construct();
    }
    
    public function getSkuPosition(){
        $position = $this->getCustomFieldValueBySku($_POST['sku'], $this->conf['fieldArray']['LocatorNumber']);
        if(empty($position)){
            echo "{position: ''}";
        }else{
            echo "{position: '".$position."'}";
        }
    }
    
    public function updateSkuPosition(){
        $this->updateCustomFieldValueBySku($_POST['sku'], $this->conf['fieldArray']['LocatorNumber'], $_POST['position']);
    }
    
    public function getSkuInfo(){
	$array = array();
	$sql = "select inventory_model_id as id,long_description as title from inventory_model where inventory_model_code = '".$_GET['sku']."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	$array['title'] = $row['title'];
	$array['status'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['skuStatus']);
	$array['weight'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['weight']);
	$array['accessories'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['accessories']);
	$array['stock'] = $this->getStock($row['id']);
	$array['position'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['LocatorNumber']);
	$array['product_parameters'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['productParameters']);
	$array['envelope'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['envelope']);
	$array['bar_cotton'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['barCotton']);
	$array['bar_cotton_number'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['barCottonNumber']);
	$array['massive_cotton'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['massiveCotton']);
	$array['massive_cotton_number'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['massiveCottonNumber']);
	
	//$array['image'] = "http://127.0.0.1:6666/inventory/inventory_images/".substr($_GET['sku'], 0, 2)."/".$_GET['sku'].".jpg";
	$array['image'] = "http://rich2010.3322.org:8080/inventory/inventory_images/".substr($_GET['sku'], 0, 2)."/".$_GET['sku'].".jpg";
	echo '['.json_encode($array).']';
    }
    
    public function getSkuWarehouseStock(){
	$limit = 50;
	$start = !empty($_POST['start'])?$_POST['start']:0;
	
	if(!empty($_REQUEST['sku']) || !empty($_REQUEST['title'])){
	    $where = "1 = 1";
	    $inventory_model_id = "";
	    if(!empty($_REQUEST['sku'])){
		$where .= " and inventory_model_code like '".$_REQUEST['sku']."%'";
	    }
	    if(!empty($_REQUEST['title'])){
		$where .= " and long_description like '%".$_REQUEST['title']."%'";
	    }
	    
	    $sql = "select count(*) as totalCount from inventory_model where ".$where;
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    $totalCount = $row['totalCount'];
	    
	    $sql = "select inventory_model_id from inventory_model where ".$where;
	    $result = mysql_query($sql, $this->conn);
	    while($row = mysql_fetch_assoc($result)){
		$inventory_model_id .= $row['inventory_model_id'].",";
	    }
	    $inventory_model_id = substr($inventory_model_id, 0, -1);
	}else{
	    $sql = "select count(*) as totalCount from inventory_model";
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    $totalCount = $row['totalCount'];
	}
	
	$title_array = array();
	if(isset($inventory_model_id)){
	    $sql = "select im.inventory_model_code,im.long_description,location_id,sum(il.quantity) as quantity from inventory_model as im left join inventory_location as il on im.inventory_model_id = il.inventory_model_id where il.inventory_model_id in (".$inventory_model_id.") group by il.inventory_model_id,il.location_id" . (empty($_GET['type'])?" limit ".$start.",".$limit:"");
	}else{
	    $sql = "select im.inventory_model_code,im.long_description,location_id,sum(il.quantity) as quantity from inventory_model as im left join inventory_location as il on im.inventory_model_id = il.inventory_model_id group by il.inventory_model_id,il.location_id" . (empty($_GET['type'])?" limit ".$start.",".$limit:"");
	}
	//echo $sql."\n";
	
	$result = mysql_query($sql, $this->conn);
	$temp = array();
	while($row = mysql_fetch_assoc($result)){
	    $temp[$row['inventory_model_code']][$row['location_id']] = $row['quantity'];
	    $title_array[$row['inventory_model_code']] = $row['long_description'];
	}
	
	//print_r($temp);
	//exit;
	$array = array();
	
	if($_GET['type'] == "xls"){
	    set_time_limit(600);
	    ini_set("memory_limit","256M");
	    require_once '../class/PHPExcel.php';
	    require_once '../class/PHPExcel/IOFactory.php';
    
	    $objExcel = new PHPExcel();
	    
	    $objExcel->setActiveSheetIndex(0);
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'SKU');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Title');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'Status');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, 'Locator');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'Stock');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, 'Virtual Stock');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, 'Good Products Warehouse');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, 'Bad Products Warehouse');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Sample Warehouse');
	    $objExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, 'Repair Warehouse');
	    
	    $i = 2;
	    foreach($temp as $key=>$value){
		$j = 0;
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $key);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $title_array[$key]);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $this->getCustomFieldValueBySku($key, $this->conf['fieldArray']['skuStatus']));
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $this->getCustomFieldValueBySku($key, $this->conf['fieldArray']['LocatorNumber']));
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value[6]+$value[7]+$value[8]+$value[9]);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $this->getVirtualStock("", $key));
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value[6]);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value[7]);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value[8]);
		$objExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $value[9]);
		$i++;
	    }
	    
	    $outputFileName = "output.xls";
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
	    exit;
	}else{
	    foreach($temp as $key=>$value){
		$array[] = array('sku'=>$key,
				 'title'=>$title_array[$key],
				 'status'=>$this->getCustomFieldValueBySku($key, $this->conf['fieldArray']['skuStatus']),
				 'locator'=>$this->getCustomFieldValueBySku($key, $this->conf['fieldArray']['LocatorNumber']),
				 'stock'=>$value[6]+$value[7]+$value[8]+$value[9],
				 'virtual_stock'=>$this->getVirtualStock("", $key),
				 'good_products_warehouse'=>$value[6],
				 'bad_products_warehouse'=>$value[7],
				 'sample_warehouse'=>$value[8],
				 'repair_warehouse'=>$value[9]);
	    }
	    echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
	}
    }
}

$action = $_GET['action'];
$warehouse = new Warehouse();
$warehouse->$action();