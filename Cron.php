<?php
include("base.php");

class Cron extends Base{
    public function __construct(){
	parent::__construct();
        mysql_query("SET NAMES 'UTF8'", $this->conn);
    }
    
    public function calculateWeekFlow(){
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  Start  +++++++++++++++++++++++++++++++</font><br>");
        $result_json = $this->get($this->conf['service']['ebayBO'], 'getSkuFlow');
	$service_result = json_decode($result_json);
	
	$sql_0 = "update inventory_model set three_day_flow=0,week_flow_1=0,week_flow_2=0,week_flow_3=0";
	$this->log("calculateWeekFlow", $sql_0."<br>");
	$result_0 = mysql_query($sql_0, $this->conn);
	
	//file_put_contents("/tmp/11", print_r($service_result, true));
	//exit;
	foreach($service_result as $key=>$value){
	    switch($key){
		case "three_day":
		    $flow_field = "three_day_flow";
		break;
	    
		case "one_week":
		    $flow_field = "week_flow_1";
		break;
	    
		case "two_week":
		    $flow_field = "week_flow_2";
		break;
	    
		case "three_week":
		    $flow_field = "week_flow_3";
		break;
	    }
	    
	    foreach($value as $sku){
		$sku_combo = $this->getSkuCombo($sku->skuId);
		if(count($sku_combo) > 1){
		    $this->log("calculateComboWeekFlow", "<br>-------------------".$sku->skuId."-------------------<br>");
		    foreach($sku_combo as $sku_c){
			$sql_1 = "update inventory_model set ".$flow_field." = ".($sku->flow * $sku_c['quantity'])." where inventory_model_code = '".$sku_c['attachment']."'";
			$this->log("calculateComboWeekFlow", $sql_1."<br>");
			$result_1 = mysql_query($sql_1, $this->conn);
		    }
		}else{
		    $sql_1 = "update inventory_model set ".$flow_field." = ".$sku->flow." where inventory_model_code = '".$sku->skuId."'";
		    $this->log("calculateWeekFlow", $sql_1."<br>");
		    $result_1 = mysql_query($sql_1, $this->conn);
		}
	    }
	}
	
	/*
	$three_day_ago = date("Y-m-d", time() - ((3 * 24 * 60 * 60)));
	$one_week_ago = date("Y-m-d", time() - ((7 * 24 * 60 * 60)));
	$two_week_ago = date("Y-m-d", time() - ((14 * 24 * 60 * 60)));
	$three_week_ago = date("Y-m-d", time() - ((21 * 24 * 60 * 60)));
        $today = date("Y-m-d");
	
	$sql_0 = "update inventory_model set three_day_flow=0,week_flow_1=0,week_flow_2=0,week_flow_3=0";
	$this->log("calculateWeekFlow", $sql_0."<br>");
	//echo $sql_1;
	//echo "<br>";
	$result_0 = mysql_query($sql_0, $this->conn);
	
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$three_day_ago."' and '".$today."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, $this->conn);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set three_day_flow = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, $this->conn);
        }
	
	//one week flow
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$one_week_ago."' and '".$today."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, $this->conn);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_1 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, $this->conn);
        }
	
	//two week flow
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$two_week_ago."' and '".$one_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, $this->conn);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_2 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, $this->conn);
        }
	
	//three week flow
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$three_week_ago."' and '".$two_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, $this->conn);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_3 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, $this->conn);
        }
	*/
        //print_r($array);
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  End  +++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function generatePurchaseOrder(){
	//get stock day
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get lower limit
	$sql = "select custom_field_id from custom_field where short_description = 'MOQ'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	$manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, $this->conn);
        while($row_4 = mysql_fetch_assoc($result_4)){
            $manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
	
	$sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model";
	$data = "SKU,英文名称,最低起订数,采购在途,建议采购数,(目前库存量-安全库存量)差值,目前库存量,最低（安全）库存量,备货天数,前三天销售数量,上周销售数量,上上周销售数量,上上上周销售数量"."\n";
	$result_1 = mysql_query($sql_1, $this->conn);
        while($row_1 = mysql_fetch_assoc($result_1)){
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            $sql_5 = "select sum(quantity) as quantity from sku_purchase where sku = '".$row_1['inventory_model_code']."' and status = 0";
            $result_5 = mysql_query($sql_5, $this->conn);
            $row_5 = mysql_fetch_assoc($result_5);
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, $this->conn);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
	    /*
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, $this->conn);
            $row_3 = mysql_fetch_assoc($result_3);
            */
	    $row_3['short_description'] = 3;
            
            /*
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, $this->conn);
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
	
	file_put_contents($this->conf['path']['po']."/".date("Y-m-d").".csv", $data);//FILE_APPEND
    }
    
    public function generatePurchaseOrderExcel(){
        require_once '/export/inventory/class/PHPExcel.php';
        require_once '/export/inventory/class/PHPExcel/IOFactory.php';
        $php_excel = new PHPExcel();
        $today = date("Y-m-d");
        
        mysql_query("SET NAMES 'latin1'", $this->conn);
        
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
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get lower limit
	$sql = "select custom_field_id from custom_field where short_description = 'MOQ'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	$manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, $this->conn);
        while($row_4 = mysql_fetch_assoc($result_4)){
            $manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
	
	$sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model order by inventory_model_code";
	$result_1 = mysql_query($sql_1, $this->conn);
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
            $status_value_result = mysql_query($status_value_sql, $this->conn);
            $status_value_row = mysql_fetch_assoc($status_value_result);
            
            $status = $status_value_row['short_description'];
            if($status == 'new' || $status == 'waiting for approve' || $status == 'under review' || $status == 'inactive'){
                //echo $row_1['inventory_model_code']."\n";
                continue;
            }
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            $sql_5 = "select sum(quantity) as quantity from sku_purchase where sku = '".$row_1['inventory_model_code']."' and status = 0";
            $result_5 = mysql_query($sql_5, $this->conn);
            $row_5 = mysql_fetch_assoc($result_5);
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, $this->conn);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
	    
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, $this->conn);
            $row_3 = mysql_fetch_assoc($result_3);
            if(empty($row_3['short_description']))
                $row_3['short_description'] = 3;
            
            
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, $this->conn);
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
                    
		    /*
                    mysql_query("SET NAMES 'UTF8'", $this->conn);
                    $sql_6 = "insert into purchase_planned (date,sku,title,min_purchase_num,purchase_in_the_way,
                    suggest_purchase_num,stock,safe_stock,stock_days,
                    three_day_flow,week_flow_1,week_flow_2,week_flow_3) values 
                    ('".$today."','".$row_1['inventory_model_code']."','".$row_1['long_description']."','".$row_4['short_description']."','".$row_5['quantity']."',
                    '".$purchase."','".$row_2['quantity']."','".$safe_stock."','".$row_3['short_description']."',
                    '".$row_1['three_day_flow']."','".$row_1['week_flow_1']."','".$row_1['week_flow_2']."','".$row_1['week_flow_3']."')";
                    echo $sql_6."\n";
                    $result_6 = mysql_query($sql_6, $this->conn);
		    */
                    $i++;
		}
	    //}
	}
        $writer = PHPExcel_IOFactory::createWriter($php_excel, 'Excel5');
	$writer->save($this->conf['path']['po']."/".date("Y-m-d").".xls");
    }
    
    public function generatePurchasePlanned(){
	mysql_query("SET NAMES 'latin1'", $this->conn);
	$date = date("Y-m-d");
	
	//get stock day
        $sql = "select custom_field_id from custom_field where short_description = '".$this->conf['fieldArray']['stockDays']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get min purchase qty
	$sql = "select custom_field_id from custom_field where short_description = '".$this->conf['fieldArray']['MOQ']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	//get status field
	$sql = "select custom_field_id from custom_field where short_description = '".$this->conf['fieldArray']['skuStatus']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$status_field_id =  $row['custom_field_id'];   
	
	//get virtual stock field
        $sql = "select custom_field_id from custom_field where short_description = '".$this->conf['fieldArray']['virtualStock']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $virtual_stock_field_id = $row['custom_field_id'];
	
	$sql_1 = "select inventory_model_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model order by inventory_model_code";
	$result_1 = mysql_query($sql_1, $this->conn);
        while($row_1 = mysql_fetch_assoc($result_1)){
            //get status value
            $status_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id 
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$row_1['inventory_model_id']."' and cfv.custom_field_id = '".$status_field_id."'";
            //echo $status_value_sql."\n";
            $status_value_result = mysql_query($status_value_sql, $this->conn);
            $status_value_row = mysql_fetch_assoc($status_value_result);
            $status = $status_value_row['short_description'];
            if($status == 'new' || $status == 'waiting for approve' || $status == 'under review' || $status == 'inactive'){
                //echo $row_1['inventory_model_code']."\n";
                continue;
            }
	    
	    //get stock day
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	    on cfs.custom_field_value_id = cfv.custom_field_value_id 
	    where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, $this->conn);
            $row_3 = mysql_fetch_assoc($result_3);
            if(!empty($row_3['short_description'])){
		$stock_day = $row_3['short_description'];
	    }else{
		$stock_day = 3;
	    }
	    
	    //get moq
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	    on cfs.custom_field_value_id = cfv.custom_field_value_id 
	    where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, $this->conn);
            $row_4 = mysql_fetch_assoc($result_4);
            if(!empty($row_4['short_description'])){
                $min_purchase_quantity = $row_4['short_description'];
	    }else{
		$min_purchase_quantity = 50;
	    }
	    /*
	    if($min_purchase_quantity % 10 < 5){
		$min_purchase_quantity = floor($min_purchase_quantity / 10) * 10 + 5;
	    }elseif($min_purchase_quantity % 10 > 5){
		$min_purchase_quantity = floor($min_purchase_quantity / 10) * 10 + 10;
	    }
	    */
	    //$min_purchase_quantity = ceil($min_purchase_quantity / 10) * 10;
	    
	    //get virtual stock
	    /*
	    $sql_5 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	    on cfs.custom_field_value_id = cfv.custom_field_value_id 
	    where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$virtual_stock_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_5 = mysql_query($sql_5, $this->conn);
            $row_5 = mysql_fetch_assoc($result_5);
	    $virtual_stock = $row_5['short_description'];
	    */
	    $virtual_stock = $this->getVirtualStock($row_1['inventory_model_id']);
	    
	    //get stock qty
	    /*
	    $sql_6 = "select quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."' and location_id = '".$this->conf['location']['warehouse']."'";
	    $result_6 = mysql_query($sql_6, $this->conn);
	    $row_6 = mysql_fetch_assoc($result_6);
	    $stock = $row_6['quantity'];
	    */
	    $stock = $this->getStock($row_1['inventory_model_id']);
	    
	    //get purchase in transit
	    /*
	    $sql_8 = "select sum(sku_purchase_qty) as purchase_in_transit from purchase_orders where purchase_status = '6' and sku = '".$row_1 ['inventory_model_code']."' group by sku";
	    $result_8 = mysql_query($sql_8, $this->conn);
            $row_8 = mysql_fetch_assoc($result_8);
	    $purchase_in_transit = $row_8['purchase_in_transit'];
	    */
	    $purchase_in_transit = $this->getSkuPurchaseInTransit($row_1['inventory_model_code']);
	    echo $row_1['inventory_model_code'].":".$stock."|".$virtual_stock."|".$purchase_in_transit."\n";
	    //continue;
	    
	    $buffer_day = 2;
	    $purchase_rate = 1;
	    $flow = $row_1['week_flow_1'] / 6;
	    //$stock_day = 30;
	    $suggest_purchase_num = ($flow * ($stock_day + $buffer_day) - $purchase_in_transit - $virtual_stock) * $purchase_rate;
	    
	    if($suggest_purchase_num > $stock){
		if($suggest_purchase_num < $min_purchase_quantity){
		    $suggest_purchase_num = $min_purchase_quantity;
		}
		$suggest_purchase_num = ceil($suggest_purchase_num / 10) * 10;
		//
		$sql_7 = "insert into purchase_planned (date,sku,sku_status,title,min_purchase_num,
		purchase_in_the_way,suggest_purchase_num,stock,virtual_stock,stock_days,three_day_flow,
		week_flow_1,week_flow_2,week_flow_3,
		purchase_status,purchase_type) values 
		('".$date."','".$row_1['inventory_model_code']."','".$status."','".mysql_real_escape_string($row_1['long_description'])."','".$min_purchase_quantity."',
		'".$purchase_in_transit."','".$suggest_purchase_num."','".$stock."','".$virtual_stock."','".$stock_day."','".$row_1 ['three_day_flow']."',
		'".$row_1 ['week_flow_1']."','".$row_1 ['week_flow_2']."','".$row_1 ['week_flow_3']."',
		'0','0')";
		echo $sql_7."\n";
		$result_7 = mysql_query($sql_7, $this->conn);
	    }
	}
    }
    
    //ALTER TABLE `purchase_planned` CHANGE `safe_stock` `virtual_stock` INT( 11 ) NOT NULL;
    //ALTER TABLE `purchase_planned` ADD `type` INT( 1 ) NOT NULL DEFAULT '0';
    public function calculateVirtualStock(){
	$this->log("calculateVirtualStock", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  Start  +++++++++++++++++++++++++++++++</font><br>");
	$sql_0 = "select inventory_model_id from inventory_model";
	$result_0 = mysql_query($sql_0, $this->conn);
        while($row_0 = mysql_fetch_assoc($result_0)){
	    $stock = (int) $this->getStock($row_0['inventory_model_id']);
	    $this->updateCustomFieldValue($row_0['inventory_model_id'], $this->conf['fieldArray']['virtualStock'], $stock);
	}
	
	//get virtual stock field
        $sql = "select custom_field_id from custom_field where short_description = '".$this->conf['fieldArray']['virtualStock']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $field_id = $row['custom_field_id'];
	
	$service_result = $this->get($this->conf['service']['ebayBO'], 'getReadyShipShipmentSku');
	$service_result = json_decode($service_result);
	//$this->log("calculateVirtualStock", print_r($service_result, true));
	for($i = 0; $i < count($service_result); $i++){
	    $sku = $service_result[$i]->skuId;
	    $qty = $service_result[$i]->quantity;
	    $this->log("calculateVirtualStock", $sku.":".$qty."<br>");
	    //print_r($result[$i]);
	    //continue;
	    $sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	    $result = mysql_query($sql, $this->conn);
            $row = mysql_fetch_assoc($result);
	    $inventory_model_id = $row['inventory_model_id'];
	    
	    $sql_1 = "select count(*) as num from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id 
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$field_id."'";
	    $result_1 = mysql_query($sql_1, $this->conn);
            $row_1 = mysql_fetch_assoc($result_1);
	    
	    //get stock qty
	    $sql_3 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$inventory_model_id."' and location_id = '".$this->conf['location']['warehouse']."'";
	    $result_3 = mysql_query($sql_3, $this->conn);
	    $row_3 = mysql_fetch_assoc($result_3);
	    $stock = $row_3['quantity'];
		
	    if($row_1['num'] == 0){
		$sql_2 = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values  
		(".$field_id.",'".($stock - $qty)."',1,now())";
		$result_2 = mysql_query($sql_2, $this->conn);
		$custom_field_value_id = mysql_insert_id($this->conn);
		$this->log("calculateVirtualStock", $sql_2."<br>");
		
		$sql_4 = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values 
		(".$custom_field_value_id.",2,".$inventory_model_id.")";
		$result_4 = mysql_query($sql_4, $this->conn);
		$this->log("calculateVirtualStock", $sql_4."<br><br>");
	    }else{
		//cfv.short_description - ".$qty." 
		$sql_2 = "update custom_field_selection as cfs left join custom_field_value as cfv 
		on cfs.custom_field_value_id=cfv.custom_field_value_id set cfv.short_description = '".($stock - $qty)."' 
		where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$field_id."'";
		$result_2 = mysql_query($sql_2, $this->conn);
		$this->log("calculateVirtualStock", $sql_2."<br><br>");
	    }
	}
	$this->log("calculateVirtualStock", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  End  +++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function generateComplaints(){
        require '/export/inventory/class/PHPExcel.php';
        require '/export/inventory/class/PHPExcel/IOFactory.php';
        $php_excel = new PHPExcel();
        
        mysql_query("SET NAMES 'latin1'", $this->conn);
        
        $php_excel->setActiveSheetIndex(0);
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'No');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'SKU');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, '问题');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, '坏品损坏个数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, '售出个数');
        $php_excel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, '坏品率');
        
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
    }
    
    public function dealSkuStock(){
        require __DOCROOT__ . '/Stomp.php';
        require __DOCROOT__ . '/Stomp/Message/Map.php';
        
        $consumer = new Stomp($this->conf['service']['activeMq']);
        $consumer->clientId = "inventorySkuStock";
        $consumer->connect();
        $consumer->subscribe($this->conf['topic']['skuStock'], array('transformation' => 'jms-map-json'));
        $msg = $consumer->readFrame();
	if ( $msg != null) {
	    $consumer->ack($msg);
	    if($msg->map['stock'] <= 0 && $msg->map['operate'] == "+"){
		$sql = "select status from sku_status_history where sku = '".$msg->map['sku']."' order by id desc limit 0,1";
		$result = mysql_query($sql, $this->conn);
		$row = mysql_fetch_assoc($result);
		
		$this->log("dealSkuStock", print_r($msg->map, true)."<br>");
		
		$this->updateCustomFieldValueBySku($msg->map['sku'], $this->conf['fieldArray']['skuStatus'], $this->conf['skuStatus'][str_replace(" ", "_", $row['status'])]);
	    }
	}else{
	    echo date("Y-m-d H:i:s")." no message\n";
	}
	$consumer->disconnect();
    }
    
    public function syncStock(){
	$service_result = $this->get($this->conf['service']['ebayBO'], 'getNeedSyncStock');
	$service_result = json_decode($service_result);
	$this->log("syncStock", print_r($service_result, true)."<br>");
	for($i = 0; $i < count($service_result); $i++){
	    $shipmentId = $service_result[$i]->shipmentId;
	    $sku = $service_result[$i]->skuId;
	    $qty = $service_result[$i]->quantity;
	    
	    $sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    $inventory_model_id = $row['inventory_model_id'];
	    echo $shipmentId."|".$sku."|".$inventory_model_id."|".$qty."\n";
	    /*
	    $result = $this->updateStock($inventory_model_id, $qty, "-", "", 1);
	    if($result){
		$service_result = $this->get($this->conf['service']['ebayBO'], 'updateShipmentSyncStockStatus', array('shipmentId'=>$shipmentId));
		if(strpos($service_result, "success"){
		    $this->log("syncStock", "success: ".$shipmentId."|".$sku."|".$inventory_model_id"|".$qty."<br>");
		}else{
		    $this->log("syncStock", "<font color='red'>failure: ".$shipmentId."|".$sku."|".$qty."</font><br>");
		}
	    }
	    */
	}
    }
    
    public function __destruct(){
        mysql_close($this->conn);
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