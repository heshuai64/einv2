<?php
class Cron{
    const DATABASE_HOST = 'localhost';
    const DATABASE_USER = 'root';
    const LOG_PATH = '/export/inventory/log';
    const PO_PATH = '/export/inventory/PO';
    const EXCEL_PATH = '/export/inventory/excel';
    
    //const DATABASE_NAME = 'tracmor';
    const DATABASE_NAME = 'inventory';
    const DATABASE_PASSWORD = '5333533';
    const ACTIVE_MQ = "tcp://192.168.1.168:61613";
    private static $database_connect;
    private $log = true;
    
    public function __construct(){
        Cron::$database_connect = mysql_connect(self::DATABASE_HOST, self::DATABASE_USER, self::DATABASE_PASSWORD);

        if (!Cron::$database_connect) {
            echo "Unable to connect to DB: " . mysql_error(Cron::$database_connect);
            exit;
        }
        
        mysql_query("SET NAMES 'UTF8'", Cron::$database_connect);
        
        if (!mysql_select_db(self::DATABASE_NAME, Cron::$database_connect)) {
            echo "Unable to select mydbname: " . mysql_error(Cron::$database_connect);
            exit;
        }
    }
    
    private function log($file_name, $data){
	if($this->log){
	    //echo $file_name.": ".$data."\n";
	    if(!file_exists(self::LOG_PATH."/".$file_name)){
		mkdir(self::LOG_PATH."/".$file_name, 0777);
	    }
	    file_put_contents(self::LOG_PATH."/".$file_name."/".date("Ymd").".html", $data, FILE_APPEND);
	}
    }
    
    public function calculateWeekFlow(){
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  Start  +++++++++++++++++++++++++++++++</font><br>");
        $three_day_ago = date("Y-m-d", time() - ((3 * 24 * 60 * 60)));
	$one_week_ago = date("Y-m-d", time() - ((7 * 24 * 60 * 60)));
	$two_week_ago = date("Y-m-d", time() - ((14 * 24 * 60 * 60)));
	$three_week_ago = date("Y-m-d", time() - ((21 * 24 * 60 * 60)));
        $today = date("Y-m-d");
	
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$three_day_ago."' and '".$today."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Cron::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set three_day_flow = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Cron::$database_connect);
        }
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$one_week_ago."' and '".$today."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Cron::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_1 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Cron::$database_connect);
        }
	
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$two_week_ago."' and '".$one_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Cron::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_2 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Cron::$database_connect);
        }
	
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$three_week_ago."' and '".$two_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Cron::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_3 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Cron::$database_connect);
        }
        //print_r($array);
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  End  +++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function generatePurchaseOrder(){
	//get stock day
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
        $result = mysql_query($sql, Cron::$database_connect);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get lower limit
	$sql = "select custom_field_id from custom_field where short_description = 'MOQ'";
        $result = mysql_query($sql, Cron::$database_connect);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	$manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, Cron::$database_connect);
        while($row_4 = mysql_fetch_assoc($result_4)){
            $manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
	
	$sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model";
	$data = "SKU,英文名称,最低起订数,采购在途,建议采购数,(目前库存量-安全库存量)差值,目前库存量,最低（安全）库存量,备货天数,前三天销售数量,上周销售数量,上上周销售数量,上上上周销售数量"."\n";
	$result_1 = mysql_query($sql_1, Cron::$database_connect);
        while($row_1 = mysql_fetch_assoc($result_1)){
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            $sql_5 = "select sum(quantity) as quantity from sku_purchase where sku = '".$row_1['inventory_model_code']."' and status = 0";
            $result_5 = mysql_query($sql_5, Cron::$database_connect);
            $row_5 = mysql_fetch_assoc($result_5);
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, Cron::$database_connect);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
	    /*
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Cron::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
            */
	    $row_3['short_description'] = 3;
            
            /*
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, Cron::$database_connect);
            $row_4 = mysql_fetch_assoc($result_4);
            */
	    $row_4['short_description'] = 0;
            
	    $safe_stock = round($row_3['short_description'] * (($row_1['three_day_flow'] / 3) * 0.3 + ($row_1['week_flow_1'] / 7) * 0.3 + ($row_1['week_flow_2'] / 7) * 0.2 + ($row_1['week_flow_3'] / 7) * 0.2));
	    $virtual_stock = $row_2['quantity'] - $safe_stock;
	    
	    //if($virtual_stock > 0){
		if($row_4['short_description'] > 0){
		    if($row_4['short_description'] > $virtual_stock * -1){
			$purchase = $row_4['short_description'];
		    }else{
			$purchase = $virtual_stock * -1;
		    }
		}else{
		    $purchase = $virtual_stock * -1;
		}
		
		$flow = (int) ($row_1['week_flow_1'] * 0.5 + $row_1['week_flow_2'] * 0.3 + $row_1['week_flow_3'] * 0.2 / 3) / 7;
		if($row_2['quantity'] < $flow * $row_3['short_description']){
		    $data .= $row_1['inventory_model_code'].",".$row_1['short_description']./*",".$row_1['long_description'].*/",".
                    $row_4['short_description'].",".$row_5['quantity'].",".$purchase.",".
		    $virtual_stock.",".$row_2['quantity'].",".$safe_stock.",".$row_3['short_description'].",".
		    $row_1['three_day_flow'].",".$row_1['week_flow_1'].",".$row_1['week_flow_2'].",".$row_1['week_flow_3']."\n";
		}
	    //}
	}
	
	file_put_contents(Cron::PO_PATH."/".date("Y-m-d").".csv", $data);//FILE_APPEND
    }
    
    public function generatePurchaseOrderExcel(){
        require_once '/export/inventory/class/PHPExcel.php';
        require_once '/export/inventory/class/PHPExcel/IOFactory.php';
        $php_excel = new PHPExcel();
        
        mysql_query("SET NAMES 'latin1'", Cron::$database_connect);
        
        $php_excel->setActiveSheetIndex(0);
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'SKU');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, '英文名称');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, '中文名称');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, '最低起订数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, '采购在途');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, '建议采购数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, '(目前库存量-安全库存量)差值');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, '目前库存量');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, '最低（安全）库存量');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, '备货天数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(10, 1, '前三天销售数量');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(11, 1, '上周销售数量');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(12, 1, '上上周销售数量');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(13, 1, '上上上周销售数量');
        
        //get stock day
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
        $result = mysql_query($sql, Cron::$database_connect);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get lower limit
	$sql = "select custom_field_id from custom_field where short_description = 'MOQ'";
        $result = mysql_query($sql, Cron::$database_connect);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	$manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, Cron::$database_connect);
        while($row_4 = mysql_fetch_assoc($result_4)){
            $manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
	
	$sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model order by inventory_model_code";
	$result_1 = mysql_query($sql_1, Cron::$database_connect);
        $i = 2;
        while($row_1 = mysql_fetch_assoc($result_1)){
            //get status field
            $status_field_sql = "select custom_field_id from custom_field where short_description = 'Sku Status'";
            $status_field_result = mysql_query($status_field_sql);
            $status_field_row = mysql_fetch_assoc($status_field_result);
            
            
            //get status value
            $status_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id 
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$row_1['inventory_model_id']."' and cfv.custom_field_id = '".$status_field_row['custom_field_id']."'";
            //echo $status_value_sql."\n";
            $status_value_result = mysql_query($status_value_sql, Cron::$database_connect);
            $status_value_row = mysql_fetch_assoc($status_value_result);
            
            $status = $status_value_row['short_description'];
            if($status == 'new' || $status == 'waiting for approve' || $status == 'under review' || $status == 'inactive'){
                echo $row_1['inventory_model_code']."\n";
                continue;
            }
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            $sql_5 = "select sum(quantity) as quantity from sku_purchase where sku = '".$row_1['inventory_model_code']."' and status = 0";
            $result_5 = mysql_query($sql_5, Cron::$database_connect);
            $row_5 = mysql_fetch_assoc($result_5);
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, Cron::$database_connect);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
	    
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Cron::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
            if(empty($row_3['short_description']))
                $row_3['short_description'] = 3;
            
            
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, Cron::$database_connect);
            $row_4 = mysql_fetch_assoc($result_4);
            if(empty($row_4['short_description']))
                $row_4['short_description'] = 0;
            
	    $safe_stock = round($row_3['short_description'] * (($row_1['three_day_flow'] / 3) * 0.3 + ($row_1['week_flow_1'] / 7) * 0.3 + ($row_1['week_flow_2'] / 7) * 0.2 + ($row_1['week_flow_3'] / 7) * 0.2));
	    $virtual_stock = $row_2['quantity'] - $safe_stock;
	    
	    //if($virtual_stock > 0){
		if($row_4['short_description'] > 0){
		    if($row_4['short_description'] > $virtual_stock * -1){
			$purchase = $row_4['short_description'];
		    }else{
			$purchase = $virtual_stock * -1;
		    }
		}else{
		    $purchase = $virtual_stock * -1;
		}
		
		$flow = (int) ($row_1['week_flow_1'] * 0.5 + $row_1['week_flow_2'] * 0.3 + $row_1['week_flow_3'] * 0.2 / 3) / 7;
		if($row_2['quantity'] < $flow * $row_3['short_description']){
		    $j = 0;
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['inventory_model_code']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['short_description']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['long_description']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_4['short_description']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_5['quantity']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $purchase);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $virtual_stock);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_2['quantity']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $safe_stock);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_3['short_description']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['three_day_flow']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['week_flow_1']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['week_flow_2']);
                    $php_excel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $row_1['week_flow_3']);
                    $i++;
		}
	    //}
	}
        $writer = PHPExcel_IOFactory::createWriter($php_excel, 'Excel5');
	$writer->save(Cron::PO_PATH."/".date("Y-m-d").".xls");
    }
    
    public function generateComplaints(){
        require_once '/export/inventory/class/PHPExcel.php';
        require_once '/export/inventory/class/PHPExcel/IOFactory.php';
        $php_excel = new PHPExcel();
        
        mysql_query("SET NAMES 'latin1'", Cron::$database_connect);
        
        $php_excel->setActiveSheetIndex(0);
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'No');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'SKU');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, '问题');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, '坏品损坏个数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, '售出个数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, '坏品率');
        
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
        $result = mysql_query($sql, Cron::$database_connect);
        $row = mysql_fetch_assoc($result);
    }
    
    public function dealSkuOutOfLibrary(){
        
    }
    
    public function __destruct(){
        mysql_close(Cron::$database_connect);
    }
}

$cron = new Cron();
if(!empty($argv[1])){
    $action = $argv[1];
}else{
    $action = (!empty($_GET['action']))?$_GET['action']:$_POST['action'];
}

$cron->$action();
?>