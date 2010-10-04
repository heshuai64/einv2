<?php
class Service{
    const LOG_PATH = '/export/inventory/log';
    const PO_PATH = '/export/inventory/PO';
    private static $active_mq;
    private static $database_connect;
    private $log = true;
    private static $q_action = array('stockAttention', 'getSkuStatusGrid');
    private static $field_array;
    
    public function __construct(){
	$config = parse_ini_file('config.ini', true);
	
	Service::$active_mq = $config['service']['activeMq'];
	
	Service::$field_array = $config['fieldArray'];
	//print_r(Service::$field_array);
        Service::$database_connect = mysql_connect($config['database']['host'], $config['database']['user'], $config['database']['password']);

        if (!Service::$database_connect) {
            echo "Unable to connect to DB: " . mysql_error(Service::$database_connect);
            exit;
        }
        
        if(!empty($_GET['action']) && !in_array($_GET['action'], Service::$q_action)){
            mysql_query("SET NAMES 'UTF8'", Service::$database_connect);
        }elseif(empty($_GET['action'])){
            mysql_query("SET NAMES 'UTF8'", Service::$database_connect);
        }
        
        if (!mysql_select_db($config['database']['name'], Service::$database_connect)) {
            echo "Unable to select mydbname: " . mysql_error(Service::$database_connect);
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
    
    private function sendMessageToAM($destination, $message){
        require_once 'Stomp.php';
        require_once 'Stomp/Message/Map.php';
        
        $con = new Stomp(Service::$active_mq);
        $conn->sync = false;
        $con->connect();
        
        $header = array();
        $header['transformation'] = 'jms-map-json';
        $mapMessage = new StompMessageMap($message, $header);
        $result = $con->send($destination, $mapMessage, array('persistent'=>'true'));
        $con->disconnect();
        if(!$result){
            $this->log("sendMessageToAM", "send message to activemq failure,
                       destination: $destination,
                       mapMessage: ".print_r($mapMessage, true)."
                       <br>");
        }
        return $result;
    }
    
    private function checkSkuCombo($inventory_model){
	$sql = "select count(*) as num from combo where sku = '".$inventory_model."'";
	//$this->log("skuTakeOut", $sql."<br>");
	$result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
	return $row['num'];
    }
    
    private function skuComboTakeOut($inventory_model,$inventory_model_id,$quantity,$shipment_id='',$shipment_method=''){
	$sql = "select attachment,quantity from combo where sku = '".$inventory_model."'";
	$this->log("skuTakeOut", $sql."<br>");
	$result = mysql_query($sql, Service::$database_connect);
        while($row = mysql_fetch_assoc($result)){
	    $sql_1 = "select inventory_model_id from inventory_model where inventory_model_code = '".$row['attachment']."'";
	    $this->log("skuTakeOut", $sql_1."<br>");
	    $result_1 = mysql_query($sql_1, Service::$database_connect);
	    $row_1 = mysql_fetch_assoc($result_1);
	    
	    $this->skuTakeOut($row['attachment'],$row_1['inventory_model_id'],$row['quantity'] * $quantity,$shipment_id,$shipment_method);
	}
    }
    
    private function getSkuStock($sku){
	$sql = "select inventory_model_id from inventory_model where inventory_model_code='".$sku."'";
	$result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
	$inventory_model_id = $row['inventory_model_id'];
	
	$sql = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";
	$this->log("inventoryTakeOut", $sql."<br>");
	$result = mysql_query($sql, Service::$database_connect);
	$row = mysql_fetch_assoc($result);
	return $row['quantity'];
    }
    
    private function getStock($inventory_model_id){
	$sql = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";
	$this->log("inventoryTakeOut", $sql."<br>");
	$result = mysql_query($sql, Service::$database_connect);
	$row = mysql_fetch_assoc($result);
	return $row['quantity'];
    }
    
    private function checkSkuStock($sku, $quantity){
	if($this->checkSkuCombo($sku)){
	    $this->log("inventoryTakeOut", "<font color='yellow'>" . $sku." is combo!</font>");
	    $sql = "select attachment,quantity from combo where sku = '".$sku."'";
	    $result = mysql_query($sql, Service::$database_connect);
	    while($row = mysql_fetch_assoc($result)){
		if($this->getSkuStock($row['attachment']) < $quantity * $row['quantity']){
		    return false;
		}
	    }
	    return true;
	}else{
	    if($this->getSkuStock($sku) >= $quantity){
		return true;
	    }else{
		return false;
	    }
	}
    }
    
    private function skuTakeOut($inventory_model,$inventory_model_id,$quantity,$shipment_id='',$shipment_method=''){
        $this->log("skuTakeOut", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
	
	if($this->checkSkuCombo($inventory_model)){
	    $this->skuComboTakeOut($inventory_model,$inventory_model_id,$quantity,$shipment_id,$shipment_method);
	}
	
	$created_by = 1;
        $source_location_id = 6;
        //B=Bulk,R=Registered,S=SpeedPost
        switch($shipment_method){
            case "B":
                $shipment_method_descript = "Bulk";
                break;
            
            case "R":
                $shipment_method_descript = "Registered";
                break;
            
            case "S":
                $shipment_method_descript = "SpeedPost";
                break;
            
        }
        
        $sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
        $this->log("skuTakeOut", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        $inventory_location_id = $row['inventory_location_id'];
        
        if(!empty($source_location_id)){
            //sku add stock out transaction
            $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','".$shipment_id.", ".$shipment_method_descript."','".$created_by."','".date("Y-m-d H:i:s")."')";
            $this->log("skuTakeOut", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $transaction_id = mysql_insert_id(Service::$database_connect);
            
            //-------------------------------------------   Weight   -----------------------------------------------
            //get weight field id
            //echo "<font color='red'><br>Weight Start<br></font>";
            $weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
            $this->log("skuTakeOut", $weight_field_sql."<br>");
            //echo $weight_field_sql;
            //echo "<br>";
            $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
            $weight_field_row = mysql_fetch_assoc($weight_field_result);
            
            
            //get weight value
            $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
            $this->log("skuTakeOut", $weight_value_sql."<br>");
            //echo $weight_value_sql;
            //echo "<br>";
            $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
            $weight_value_row = mysql_fetch_assoc($weight_value_result);
            $weight = (float)$weight_value_row['short_description'];
            //echo "<font color='red'><br>Weight End<br></font>";
            
            
            //---------------------------------------  Envelope  ---------------------------------------------------
            /*
            //get envelope field id
            echo "<font color='red'><br>Envelope Start<br></font>";
            $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['envelope']."'";
            echo $envelope_field_sql;
            echo "<br>";
            $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
            $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
            
            
            //get envelope value
            $envelope_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$envelope_field_row['custom_field_id']."'";
            echo $envelope_value_sql;
            echo "<br>";
            $envelope_value_result = mysql_query($envelope_value_sql, Service::$database_connect);
            $envelope_value_row = mysql_fetch_assoc($envelope_value_result);
            $envelope = $envelope_value_row['short_description'];
            
            //get envelope model id
            $envelope_model_sql = "select inventory_model_id from inventory_model where short_description ='Envelope-".$envelope."'";
            echo $envelope_model_sql;
            echo "<br>";
            $envelope_model_result = mysql_query($envelope_model_sql, Service::$database_connect);
            $envelope_model_row = mysql_fetch_assoc($envelope_model_result);
            $envelope_model_id = $envelope_model_row['inventory_model_id'];
            
            //get envelope location
            $envelope_location_sql = "select location_id from inventory_location where inventory_model_id = '".$envelope_model_id."'";// and quantity > ".$quantity."";
            echo $envelope_location_sql;
            echo "<br>";
            $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
            $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
            $envelope_location_id = $envelope_location_row['location_id'];
            
            if(!empty($envelope_location_id)){
                //envelope add stock out transaction
                $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$inventory_model."','".$created_by."','".date("Y-m-d H:i:s")."')";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                
                //envelope stock out
                $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                values ('".$envelope_model_id."','".$envelope_transaction_id."','".$quantity."','".$envelope_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                echo $envelope_stock_out_sql;
                echo "<br>";
                $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                if($envelope_stock_out_result){
                    //envelope update stock quantity
                    $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$quantity." where inventory_model_id = '".$envelope_model_id."' and location_id = '".$envelope_location_id."'";
                    echo $envelope_update_stock_sql;
                    echo "<br>";
                    $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                }
            }else{
                echo "Envelope Not In Location!<br>";
            }
            echo "<font color='red'><br>Envelope End<br></font>";
            */
            //----------------------------------------------------------------------------------------------------
            
            switch($shipment_method){
                case "B":
                    $shipment_fee = 90 * $weight;
                    break;
                
                case "R":
                    $shipment_fee = (110 * $weight) + $quantity * 13;
                    break;
                
                case "S":
                    $shipment_fee = 240 + (($weight - 0.5 ) / 0.5 * 75) * 0.42;
                    break;
                
            }
            
            //sku stock out
            $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date,shipment_id,shipment_method,shipment_fee) 
            values ('".$inventory_location_id."','".$transaction_id."','".$quantity."','".$source_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."','".$shipment_id."','".$shipment_method."','".$shipment_fee."')";
            $this->log("skuTakeOut", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                //sku update stock quantity
                $sql = "update inventory_location set quantity = quantity - ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
                $this->log("skuTakeOut", $sql."<br>");
                //echo $sql;
                //echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                
                $sql = "update inventory_model set modified_by = '".$created_by."',modified_date = '".date("Y-m-d H:i:s")."' where inventory_model_id = '".$inventory_model_id."'";
                //$this->log("skuTakeOut", $sql."<br>");
                $result = mysql_query($sql, Service::$database_connect);
                $this->log("skuTakeOut", $sql."<br><font color='red'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
                echo $inventory_model." 出库成功(success).<br>";
                flush();
                $this->sendMessageToAM("/topic/SkuOutOfLibrary",
                        array("sku"=> $inventory_model,
                              "quantity"=> $quantity,
                              "shipment_id"=> $shipment_id,
                              "shipment_method"=> $shipment_method));
            }
        }else{
            echo "<font color=\'red\' size=\'7\'>SKU 不在仓库!</font>";
        }
    }
    
    public function inventoryTakeOut($inventory_model='', $quantity='',$shipment_id='',$shipment_method=''){
        $inventory_model = (($inventory_model!="")?$inventory_model:$_GET['inventory_model']);
        $quantity = (($quantity!="")?$quantity:$_GET['quantity']);
        $shipment_id = (($shipment_id!="")?$shipment_id:$_GET['shipment_id']);
        $shipment_method = (($shipment_method!="")?$shipment_method:$_GET['shipment_method']);
        
	$this->log("inventoryTakeOut", "<br><font color='blue'>++++++++++++++++++++++++++++++++++++++ ".$shipment_id." ++++++++++++++++++++++++++++++++++++</font><br>");
        if(strpos($inventory_model, ",")){
            $sku_array = explode(",", $inventory_model);
            $quantiry_array = explode(",", $quantity);
            $inventory_model_id_array = array();
            $msg = "";
            $flag = true;
            $i = 0;
            foreach($sku_array as $sku){
		if($this->checkSkuStock($sku, $quantiry_array[$i]) == false){
		    echo "<font color=\'red\' size=\'7\'>". $sku." 没有库存.</font><br>";
		    echo "<font color=\'red\' size=\'7\'>包裹不能发送.</font><br>";
		    
		    $this->log("inventoryTakeOut", "<font color='yellow'>" . $inventory_model." no stock!</font>");
		    flush();
		    $this->sendMessageToAM("/topic/SkuOutOfStock",
				array("sku"=> $inventory_model,
				      "quantity"=> $quantity,
				      "shipment_id"=> $shipment_id,
				      "shipment_method"=> $shipment_method));
		    return 0;
		}
		
                //get sku model id
                $sql = "select inventory_model_id from inventory_model where inventory_model_code='".$sku."'";
                $this->log("inventoryTakeOut", $sql."<br>");
                //echo $sql;
                //echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                $row = mysql_fetch_assoc($result);
                $inventory_model_id = $row['inventory_model_id'];
                $inventory_model_id_array[$i] = $inventory_model_id;
		
                /*
		//get sku location
                $sql = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";
                $this->log("inventoryTakeOut", $sql."<br>");
                $result = mysql_query($sql, Service::$database_connect);
                $row = mysql_fetch_assoc($result);
                $location_quantity = $row['quantity'];
		
		$location_quantity = $this->getStock($inventory_model_id);
		
                if($quantiry_array[$i] > $location_quantity){
                    $flag = false;
                    $msg .= "<font color=\'red\' size=\'7\'>". $sku." 没有库存.</font><br>";
		    $this->log("inventoryTakeOut", "<font color='yellow'>" . $sku." no stock!</font>");
                }else{
		    $msg .= $sku." 有 ".$location_quantity." 在仓库.<br>";
		    $this->log("inventoryTakeOut", "<font color='green'>".$sku." in stock!</font><br>");
                }
		*/
		
		$location_quantity = $this->getStock($inventory_model_id);
		$msg .= $sku." 有 ".$location_quantity." 在仓库.<br>";
		$this->log("inventoryTakeOut", "<font color='green'>".$sku." in stock!</font><br>");
                $i++;
            }
            
	    /*
            if($flag){
                $i = 0;
                echo $msg;
                foreach($inventory_model_id_array as $inventory_model_id){
                    $this->skuTakeOut($sku_array[$i], $inventory_model_id, $quantiry_array[$i], $shipment_id, $shipment_method);
                    $i++;
                }
                return 1;
            }else{
                echo "<font color=\'red\' size=\'7\'>".$msg." 包裹不能发送.</font><br>";
                flush();
                $this->sendMessageToAM("/topic/SkuOutOfStock",
                            array("sku"=> $inventory_model,
                                  "quantity"=> $quantity,
                                  "shipment_id"=> $shipment_id,
                                  "shipment_method"=> $shipment_method));
                return 0;
            }
	    */
	    
	    $i = 0;
	    echo $msg;
	    foreach($inventory_model_id_array as $inventory_model_id){
		$this->skuTakeOut($sku_array[$i], $inventory_model_id, $quantiry_array[$i], $shipment_id, $shipment_method);
		$i++;
	    }
	    return 1;
        }else{
	    if($this->checkSkuStock($inventory_model, $quantity) == false){
		echo "<font color=\'red\' size=\'7\'>". $sku." 没有库存.</font><br>";
		echo "<font color=\'red\' size=\'7\'>包裹不能发送.</font><br>";
		
		$this->log("inventoryTakeOut", "<font color='yellow'>" . $inventory_model." no stock!</font>");
		flush();
		$this->sendMessageToAM("/topic/SkuOutOfStock",
                            array("sku"=> $inventory_model,
                                  "quantity"=> $quantity,
                                  "shipment_id"=> $shipment_id,
                                  "shipment_method"=> $shipment_method));
		return 0;
	    }

            //get sku model id
            $sql = "select inventory_model_id from inventory_model where inventory_model_code='".$inventory_model."'";
            $this->log("inventoryTakeOut", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $inventory_model_id = $row['inventory_model_id'];
	    
            /*
            //get sku location
            $sql = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";
            $this->log("inventoryTakeOut", $sql."<br>");
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $location_quantity = $row['quantity'];
	    
	    $location_quantity = $this->getStock($inventory_model_id);
	    
            if($quantity > $location_quantity){
                echo "<font color=\'red\' size=\'7\'>". $inventory_model." 没有库存.</font><br>";
		$this->log("inventoryTakeOut", "<font color='yellow'>" . $inventory_model." no stock!</font>");
                flush();
                $this->sendMessageToAM("/topic/SkuOutOfStock",
                            array("sku"=> $inventory_model,
                                  "quantity"=> $quantity,
                                  "shipment_id"=> $shipment_id,
                                  "shipment_method"=> $shipment_method));
                return 0;
            }else{
                $msg .= $inventory_model." 有 ".$location_quantity." 在仓库.<br>";
		$this->log("inventoryTakeOut", "<font color='green'>" . $inventory_model." in stock!</font>");
            }
	    */
	    
	    $location_quantity = $this->getStock($inventory_model_id);
	    echo $inventory_model." 有 ".$location_quantity." 在仓库.<br>";
	    $this->log("inventoryTakeOut", "<font color='green'>" . $inventory_model." in stock!</font>");
	    
            $this->skuTakeOut($inventory_model, $inventory_model_id, $quantity, $shipment_id, $shipment_method);
        }
	$this->log("inventoryTakeOut", "<br><font color='blue'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function syncAppertainStock(){
//-------------------------------------------   Constant  Start -------------------------------------------
        //Battery Category Id
        $battery_category = 2;
        $s_envelope_model_id = 5;
        $m_envelope_model_id = 6;
        $l_envelope_model_id = 7;
        $xl_envelope_model_id = 8;
        $envelope_prefix = "Envelope-";
        $envelope_field_value = "Envelope";
        
        //Oil Painting Category Id
        $oil_painting_category = 5;
        $s_paper_tube_modle_id = 9;
        $m_paper_tube_modle_id = 10;
        $l_paper_tube_modle_id = 11;
        $paper_tube_prefix = "Paper-Tube-";
        $paper_tube_field_value = "Paper Tube";
        
        $created_by = 1;
        
        
        //S Envelope Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$s_envelope_model_id."'";
        //echo $envelope_location_sql;
        //echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $s_location_id = $envelope_location_row['location_id'];
        $s_inventory_location_id = $envelope_location_row['inventory_location_id'];
          
        //M Envelope Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$m_envelope_model_id."'";
        //echo $envelope_location_sql;
        //echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $m_location_id = $envelope_location_row['location_id'];
        $m_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //L Envelope Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$l_envelope_model_id."'";
        //echo $envelope_location_sql;
        //echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $l_location_id = $envelope_location_row['location_id'];
        $l_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //XL Envelope Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$xl_envelope_model_id."'";
        //echo $envelope_location_sql;
        //echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $xl_location_id = $envelope_location_row['location_id'];
        $xl_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //S Paper Tube Location
        $paper_tube_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$s_paper_tube_modle_id."'";
        //echo $paper_tube_location_sql;
        //echo "<br>";
        $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
        $paper_tube_location_row = mysql_fetch_assoc($envelope_location_result);
        $s_p_location_id = $paper_tube_location_row['location_id'];
        $s_p_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
        
        //M Paper Tube Location
        $paper_tube_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$m_paper_tube_modle_id."'";
        //echo $paper_tube_location_sql;
        //echo "<br>";
        $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
        $paper_tube_location_row = mysql_fetch_assoc($envelope_location_result);
        $m_p_location_id = $paper_tube_location_row['location_id'];
        $m_p_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
        
        //L Paper Tube Location
        $paper_tube_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$l_paper_tube_modle_id."'";
        //echo $paper_tube_location_sql;
        //echo "<br>";
        $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
        $paper_tube_location_row = mysql_fetch_assoc($envelope_location_result);
        $l_p_location_id = $paper_tube_location_row['location_id'];
        $l_p_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
        
//-------------------------------------------   Constant  End -------------------------------------------
        
        $sql = "select shipment_id from inventory_transaction where inventory_transaction_id = 90";//envelope_status = 0 and shipment_id !=''";
        $result = mysql_query($sql, Service::$database_connect);
        
        while($row = mysql_fetch_assoc($result)){
            //$sql_1 = "select inventory_transaction_id,inventory_location_id,quantity from inventory_transaction where shipment_id = '".$row['shipment_id']."'";
            //$sql_1 = "select inventory_transaction_id,inventory_location_id,quantity from inventory_transaction where inventory_transaction_id = 90";
            $sql_1 = "select inventory_transaction_id,inventory_location_id,quantity from inventory_transaction where inventory_transaction_id = 89 or inventory_transaction_id = 90";
            echo $sql_1;
            echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
            $num_rows_1 = mysql_num_rows($result_1);
            
            if($num_rows_1 > 1){
//------------------------------------------ Many  --------------------------------------------------                
                echo "<font color='purple'><br>Many Start<br></font>";
                $s_envelope_count = 0;
                $m_envelope_count = 0;
                $l_envelope_count = 0;
                $xl_envelope_count = 0;
                $envelope_inventory_transaction_id_array = array();
                
                $s_paper_count = 0;
                $m_paper_count = 0;
                $l_paper_count = 0;
                $paper_tube_inventory_transacton_id_array = array();
                
                while($row_1 = mysql_fetch_assoc($result_1)){
                    $inventory_model_id = $row_1['inventory_location_id'];
                    $category_sql = "select category_id from inventory_model where inventory_model_id = '".$row_1['inventory_location_id']."'";
                    echo $category_sql;
                    echo "<br>";
                    $category_result = mysql_query($category_sql, Service::$database_connect);
                    $category_row = mysql_fetch_assoc($category_result);
                    $category_id = $category_row['category_id'];
                    echo "category_id: ".$category_id."<br>";
                                     
                    if($category_id == $oil_painting_category){
                        //get paper tube field id
                        $paper_tube_field_sql = "select custom_field_id from custom_field where short_description = '".$paper_tube_field_value."'";
                        echo $paper_tube_field_sql;
                        echo "<br>";
                        $paper_tube_field_result = mysql_query($paper_tube_field_sql, Service::$database_connect);
                        $paper_tube_field_row = mysql_fetch_assoc($paper_tube_field_result);
                        
                        
                        //get paper tube value
                        $paper_tube_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                        on cfs.custom_field_value_id=cfv.custom_field_value_id
                        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$paper_tube_field_row['custom_field_id']."'";
                        echo $paper_tube_value_sql;
                        echo "<br>";
                        $paper_tube_value_result = mysql_query($paper_tube_value_sql, Service::$database_connect);
                        $paper_tube_value_row = mysql_fetch_assoc($paper_tube_value_result);
                        $paper_tube = $paper_tube_value_row['short_description'];
                        
                        //get paper tube model id
                        $paper_tube_model_sql = "select inventory_model_id from inventory_model where short_description ='".$paper_tube_prefix.$paper_tube."'";
                        echo $paper_tube_model_sql;
                        echo "<br>";
                        $paper_tube_model_result = mysql_query($paper_tube_model_sql, Service::$database_connect);
                        $paper_tube_model_row = mysql_fetch_assoc($paper_tube_model_result);
                        $paper_tube_model_id = $paper_tube_model_row['inventory_model_id'];
                        
                        //Paper Tube
                        switch($paper_tube_model_id){
                            case $s_paper_tube_modle_id:
                                $s_paper_count++;
                                break;
                            
                            case $m_paper_tube_modle_id:
                                $m_paper_count++;
                                break;
                            
                            case $l_paper_tube_modle_id:
                                $l_paper_count++;
                                break;
                        }
                        $paper_tube_inventory_transacton_id_array[] = $row_1['inventory_transaction_id'];
                        
                    }else{
                        //get envelope field id
                        $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".$envelope_field_value."'";
                        echo $envelope_field_sql;
                        echo "<br>";
                        $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
                        $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
                        
                        
                        //get envelope value
                        $envelope_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                        on cfs.custom_field_value_id=cfv.custom_field_value_id
                        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$envelope_field_row['custom_field_id']."'";
                        echo $envelope_value_sql;
                        echo "<br>";
                        $envelope_value_result = mysql_query($envelope_value_sql, Service::$database_connect);
                        $envelope_value_row = mysql_fetch_assoc($envelope_value_result);
                        $envelope = $envelope_value_row['short_description'];
                        
                        //get envelope model id
                        $envelope_model_sql = "select inventory_model_id from inventory_model where short_description ='".$envelope_prefix.$envelope."'";
                        echo $envelope_model_sql;
                        echo "<br>";
                        $envelope_model_result = mysql_query($envelope_model_sql, Service::$database_connect);
                        $envelope_model_row = mysql_fetch_assoc($envelope_model_result);
                        $envelope_model_id = $envelope_model_row['inventory_model_id'];
                    
                        //Envelope
                        switch($envelope_model_id){
                            case $s_envelope_model_id:
                                if($s_envelope_count < 6 && $category_id == $battery_category && $row_1['quantity'] < 6){
                                    //S Envelope
                                    $s_envelope_count += $row_1['quantity'];
                                    if($s_envelope > 6){
                                        continue;
                                    }   
                                }
                            break;
                        
                            case $m_envelope_model_id:
                                //M Envelope
                                $m_envelope_count += $row_1['quantity'];
                            break;
                        
                            case $l_envelope_model_id:
                                //L Envelope
                                $l_envelope_count += $row_1['quantity'];
                            break;
                        
                            case $xl_envelope_model_id:
                                //XL Envelope
                                $xl_envelope_count += $row_1['quantity'];
                            break;
                        }
                        $envelope_inventory_transaction_id_array[] = $row_1['inventory_transaction_id'];
                    }
                }
                
                echo "<font color='red'>Envelope:<br>";
                echo "S: ". $s_envelope_count."<br>";
                echo "M: ". $m_envelope_count."<br>";
                echo "L: ". $l_envelope_count."<br>";
                echo "XL: ". $xl_envelope_count."<br>";
                echo "</font>";
                
                echo "<br>";
                
                echo "<font color='red'>Paper Tube:<br>";
                echo "S: ". $s_paper_count."<br>";
                echo "M: ". $m_paper_count."<br>";
                echo "L: ". $l_paper_count."<br>";
                echo "</font>";

//paper tube add stock out transaction ----------------------------------------------------------------------------------------               
                if($s_paper_count > 0){
                    echo "<font color='red'><br>S In Many Paper Tube Start<br></font>";
                    //get paper tube location
                    $paper_tube_location_sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$s_paper_tube_modle_id."'";// and quantity > ".$quantity."";
                    echo $paper_tube_location_sql;
                    echo "<br>";
                    $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
                    $paper_tube_location_row = mysql_fetch_assoc($paper_tube_location_result);
                    $paper_tube_location_id = $paper_tube_location_row['location_id'];
                    $paper_tube_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
                
                    if(!empty($paper_tube_location_id)){
                        //paper tube add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $paper_tube_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $paper_tube_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$paper_tube_inventory_location_id."','".$paper_tube_transaction_id."','".$s_paper_count."','".$paper_tube_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $paper_tube_stock_out_sql;
                        echo "<br>";
                        $paper_tube_stock_out_result = mysql_query($paper_tube_stock_out_sql, Service::$database_connect);
                        if($paper_tube_stock_out_result){
                            //paper tube update stock quantity
                            $paper_tube_update_stock_sql = "update inventory_location set quantity = quantity - ".$s_paper_count." where inventory_model_id = '".$s_paper_tube_modle_id."' and location_id = '".$paper_tube_location_id."'";
                            echo $paper_tube_update_stock_sql;
                            echo "<br>";
                            $paper_tube_update_stock_result = mysql_query($paper_tube_update_stock_sql, Service::$database_connect);
                        }
                    }
                    echo "<font color='red'>S In Many Paper Tube End<br></font>";
                }elseif($m_paper_count > 0){
                    echo "<font color='red'><br>M In Many Paper Tube Start<br></font>";
                    //get paper tube location
                    $paper_tube_location_sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$m_paper_tube_modle_id."'";// and quantity > ".$quantity."";
                    echo $paper_tube_location_sql;
                    echo "<br>";
                    $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
                    $paper_tube_location_row = mysql_fetch_assoc($paper_tube_location_result);
                    $paper_tube_location_id = $paper_tube_location_row['location_id'];
                    $paper_tube_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
                
                    if(!empty($paper_tube_location_id)){
                        //paper tube add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $paper_tube_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $paper_tube_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$paper_tube_inventory_location_id."','".$paper_tube_transaction_id."','".$m_paper_count."','".$paper_tube_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $paper_tube_stock_out_sql;
                        echo "<br>";
                        $paper_tube_stock_out_result = mysql_query($paper_tube_stock_out_sql, Service::$database_connect);
                        if($paper_tube_stock_out_result){
                            //paper tube update stock quantity
                            $paper_tube_update_stock_sql = "update inventory_location set quantity = quantity - ".$m_paper_count." where inventory_model_id = '".$m_paper_tube_modle_id."' and location_id = '".$paper_tube_location_id."'";
                            echo $paper_tube_update_stock_sql;
                            echo "<br>";
                            $paper_tube_update_stock_result = mysql_query($paper_tube_update_stock_sql, Service::$database_connect);
                        }
                    }
                    echo "<font color='red'>M In Many Paper Tube End<br></font>";
                }elseif($l_paper_count > 0){
                    echo "<font color='red'><br>L In Many Paper Tube Start<br></font>";
                    //get paper tube location
                    $paper_tube_location_sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$l_paper_tube_modle_id."'";// and quantity > ".$quantity."";
                    echo $paper_tube_location_sql;
                    echo "<br>";
                    $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
                    $paper_tube_location_row = mysql_fetch_assoc($paper_tube_location_result);
                    $paper_tube_location_id = $paper_tube_location_row['location_id'];
                    $paper_tube_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
                
                    if(!empty($paper_tube_location_id)){
                        //paper tube add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $paper_tube_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $paper_tube_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$paper_tube_inventory_location_id."','".$paper_tube_transaction_id."','".$l_paper_count."','".$paper_tube_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $paper_tube_stock_out_sql;
                        echo "<br>";
                        $paper_tube_stock_out_result = mysql_query($paper_tube_stock_out_sql, Service::$database_connect);
                        if($paper_tube_stock_out_result){
                            //paper tube update stock quantity
                            $paper_tube_update_stock_sql = "update inventory_location set quantity = quantity - ".$l_paper_count." where inventory_model_id = '".$l_paper_tube_modle_id."' and location_id = '".$paper_tube_location_id."'";
                            echo $paper_tube_update_stock_sql;
                            echo "<br>";
                            $paper_tube_update_stock_result = mysql_query($paper_tube_update_stock_sql, Service::$database_connect);
                        }
                    }
                    echo "<font color='red'>L In Many Paper Tube End<br></font>";
                }
                
//envelope add stock out transaction ----------------------------------------------------------------------------------------
                echo "<font color='red'><br>Many Envelope Start<br></font>";
                if($s_envelope_count > 0 && $s_envelope_count < 6){
                    if($s_envelope_count == 1){
                        echo "<font color='red'>1L</font><br>";
                        //1L envelope add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$s_inventory_location_id."','".$envelope_transaction_id."',1,'".$s_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $envelope_stock_out_sql;
                        echo "<br>";
                        $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                        if($envelope_stock_out_result){
                            //M envelope update stock quantity
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$s_envelope_model_id."' and location_id = '".$s_location_id."'";
                            echo $envelope_update_stock_sql;
                            echo "<br>";
                            $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                        }
                    }elseif($s_envelope_count > 1 && $s_envelope_count < 5){
                        echo "<font color='red'>2-4 S = 1L</font><br>";
                        //2-4 S = 1L envelope add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$l_inventory_location_id."','".$envelope_transaction_id."',1,'".$l_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $envelope_stock_out_sql;
                        echo "<br>";
                        $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                        if($envelope_stock_out_result){
                            //M envelope update stock quantity
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$l_envelope_model_id."' and location_id = '".$l_location_id."'";
                            echo $envelope_update_stock_sql;
                            echo "<br>";
                            $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                        }
                    }elseif($s_envelope_count == 5){
                        echo "<font color='red'>5S = 1XL</font><br>";
                        //5S = 1XL envelope add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$xl_inventory_location_id."','".$envelope_transaction_id."',1,'".$xl_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $envelope_stock_out_sql;
                        echo "<br>";
                        $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                        if($envelope_stock_out_result){
                            //M envelope update stock quantity
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$xl_envelope_model_id."' and location_id = '".$xl_location_id."'";
                            echo $envelope_update_stock_sql;
                            echo "<br>";
                            $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                        }
                    }else{
                        //over XL
                        echo "<font color='red'>over XL</font><br>";
                    }
                }elseif($m_envelope_count > 0){
                    //M envelope add stock out transaction
                    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $sql;
                    echo "<br>";
                    $result = mysql_query($sql, Service::$database_connect);
                    $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                    
                    $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                    values ('".$m_inventory_location_id."','".$envelope_transaction_id."','".$m_envelope_count."','".$m_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $envelope_stock_out_sql;
                    echo "<br>";
                    $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                    if($envelope_stock_out_result){
                        //M envelope update stock quantity
                        $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$m_envelope_count." where inventory_model_id = '".$m_envelope_model_id."' and location_id = '".$m_location_id."'";
                        echo $envelope_update_stock_sql;
                        echo "<br>";
                        $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                    }
                }elseif($l_envelope_count > 0){
                    //L envelope add stock out transaction
                    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $sql;
                    echo "<br>";
                    $result = mysql_query($sql, Service::$database_connect);
                    $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                    
                    $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                    values ('".$l_inventory_location_id."','".$envelope_transaction_id."','".$l_envelope_count."','".$l_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $envelope_stock_out_sql;
                    echo "<br>";
                    $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                    if($envelope_stock_out_result){
                        //M envelope update stock quantity
                        $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$l_envelope_count." where inventory_model_id = '".$l_envelope_model_id."' and location_id = '".$l_location_id."'";
                        echo $envelope_update_stock_sql;
                        echo "<br>";
                        $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                    }
                }elseif($xl_envelope_count > 0){
                    //XL envelope add stock out transaction
                    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $sql;
                    echo "<br>";
                    $result = mysql_query($sql, Service::$database_connect);
                    $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                    
                    $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                    values ('".$xl_inventory_location_id."','".$envelope_transaction_id."','".$xl_envelope_count."','".$xl_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                    echo $envelope_stock_out_sql;
                    echo "<br>";
                    $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                    if($envelope_stock_out_result){
                        //M envelope update stock quantity
                        $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$xl_envelope_count." where inventory_model_id = '".$xl_envelope_model_id."' and location_id = '".$xl_location_id."'";
                        echo $envelope_update_stock_sql;
                        echo "<br>";
                        $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                    }
                }
                echo "<font color='red'>Many Envelope End<br><br></font>";
                
                //---------------------------- Update Inventory Transaction Start --------------------------
                foreach($envelope_inventory_transaction_id_array as $envelope_inventory_transaction_id){
                    $envelope_status_sql = "update inventory_transaction set envelope_status = 1 where inventory_transaction_id = '".$envelope_inventory_transaction_id."'";
                    echo $envelope_status_sql;
                    echo "<br>";
                    $envelope_status_result = mysql_query($envelope_status_sql, Service::$database_connect);
                }
                
                foreach($paper_tube_inventory_transacton_id_array as $paper_tube_inventory_transacton_id){
                    $paper_tube_status_sql = "update inventory_transaction set envelope_status = 1 where inventory_transaction_id = '".$paper_tube_inventory_transacton_id."'";
                    echo $paper_tube_status_sql;
                    echo "<br>";
                    $paper_tube_status_result = mysql_query($paper_tube_status_sql, Service::$database_connect);
                }
                //---------------------------- Update Inventory Transaction End --------------------------
                
                echo "<font color='purple'><br>Many End<br></font>";
//------------------------------------------ Many End  -----------------------------------------------------
            }else{
//------------------------------------------ Single Paper Tube  --------------------------------------------
                    $row_1 = mysql_fetch_assoc($result_1);
                    $category_sql = "select category_id from inventory_model where inventory_model_id = '".$row_1['inventory_location_id']."'";
                    echo $category_sql;
                    echo "<br>";
                    $category_result = mysql_query($category_sql, Service::$database_connect);
                    $category_row = mysql_fetch_assoc($category_result);
                    $category_id = $category_row['category_id'];
                        
                    echo "category_id: ".$category_id;
                    echo "<br>";
                    if($category_id == $oil_painting_category){
                        echo "<font color='red'><br>Single Paper Tube Start<br></font>";
                        $inventory_model_id = $row_1['inventory_location_id'];
                        
                        //get paper tube field id
                        $paper_tube_field_sql = "select custom_field_id from custom_field where short_description = '".$paper_tube_field_value."'";
                        echo $paper_tube_field_sql;
                        echo "<br>";
                        $paper_tube_field_result = mysql_query($paper_tube_field_sql, Service::$database_connect);
                        $paper_tube_field_row = mysql_fetch_assoc($paper_tube_field_result);
                        
                        //get paper tube value
                        $paper_tube_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                        on cfs.custom_field_value_id=cfv.custom_field_value_id
                        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$paper_tube_field_row['custom_field_id']."'";
                        echo $paper_tube_value_sql;
                        echo "<br>";
                        $paper_tube_value_result = mysql_query($paper_tube_value_sql, Service::$database_connect);
                        $paper_tube_value_row = mysql_fetch_assoc($paper_tube_value_result);
                        $paper_tube = $paper_tube_value_row['short_description'];
                        echo "<font color='red'>".$paper_tube."</font><br>";
                        
                        //get paper tube model id
                        $paper_tube_model_sql = "select inventory_model_id from inventory_model where short_description ='".$paper_tube_prefix.$paper_tube."'";
                        echo $paper_tube_model_sql;
                        echo "<br>";
                        $paper_tube_model_result = mysql_query($paper_tube_model_sql, Service::$database_connect);
                        $paper_tube_model_row = mysql_fetch_assoc($paper_tube_model_result);
                        $paper_tube_model_id = $paper_tube_model_row['inventory_model_id'];
                    
                        //get paper tube location
                        $paper_tube_location_sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$paper_tube_model_id."'";// and quantity > ".$quantity."";
                        echo $paper_tube_location_sql;
                        echo "<br>";
                        $paper_tube_location_result = mysql_query($paper_tube_location_sql, Service::$database_connect);
                        $paper_tube_location_row = mysql_fetch_assoc($paper_tube_location_result);
                        $paper_tube_location_id = $paper_tube_location_row['location_id'];
                        $paper_tube_inventory_location_id = $paper_tube_location_row['inventory_location_id'];
                    
                        if(!empty($paper_tube_location_id)){
                            //paper tube add stock out transaction
                            $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                            echo $sql;
                            echo "<br>";
                            $result = mysql_query($sql, Service::$database_connect);
                            $paper_tube_transaction_id = mysql_insert_id(Service::$database_connect);
                            
                            $paper_tube_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                            values ('".$paper_tube_inventory_location_id."','".$paper_tube_transaction_id."','".$row_1['quantity']."','".$paper_tube_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                            echo $paper_tube_stock_out_sql;
                            echo "<br>";
                            $paper_tube_stock_out_result = mysql_query($paper_tube_stock_out_sql, Service::$database_connect);
                            if($paper_tube_stock_out_result){
                                //paper tube update stock quantity
                                $paper_tube_update_stock_sql = "update inventory_location set quantity = quantity - ".$row_1['quantity']." where inventory_model_id = '".$paper_tube_model_id."' and location_id = '".$paper_tube_location_id."'";
                                echo $paper_tube_update_stock_sql;
                                echo "<br>";
                                $paper_tube_update_stock_result = mysql_query($paper_tube_update_stock_sql, Service::$database_connect);
                                if($paper_tube_update_stock_result){
                                    $paper_tube_status_sql = "update inventory_transaction set envelope_status = 1 where inventory_transaction_id = '".$row_1['inventory_transaction_id']."'";
                                    echo $paper_tube_status_sql;
                                    echo "<br>";
                                    $paper_tube_status_result = mysql_query($paper_tube_status_sql, Service::$database_connect);
                                }
                            }
                        }else{
                            echo "Error: Paper Tube Not In Location!<br>";
                        }
                        echo "<font color='red'><br>Single Paper Tube End<br></font>";
                    }else{ 
//------------------------------------------ Single Envelope  ----------------------------------------------
                    echo "<font color='red'><br>Single Envelope Start<br></font>";
                    $row_1 = mysql_fetch_assoc($result_1);
                    $inventory_model_id = $row_1['inventory_location_id'];
                    //get envelope field id
                    $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".$envelope_field_value."'";
                    echo $envelope_field_sql;
                    echo "<br>";
                    $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
                    $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
                    
                    
                    //get envelope value
                    $envelope_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                    on cfs.custom_field_value_id=cfv.custom_field_value_id
                    where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$envelope_field_row['custom_field_id']."'";
                    echo $envelope_value_sql;
                    echo "<br>";
                    $envelope_value_result = mysql_query($envelope_value_sql, Service::$database_connect);
                    $envelope_value_row = mysql_fetch_assoc($envelope_value_result);
                    $envelope = $envelope_value_row['short_description'];
                    echo "<font color='red'>".$envelope."</font><br>";
                    
                    //get envelope model id
                    $envelope_model_sql = "select inventory_model_id from inventory_model where short_description ='".$envelope_prefix.$envelope."'";
                    echo $envelope_model_sql;
                    echo "<br>";
                    $envelope_model_result = mysql_query($envelope_model_sql, Service::$database_connect);
                    $envelope_model_row = mysql_fetch_assoc($envelope_model_result);
                    $envelope_model_id = $envelope_model_row['inventory_model_id'];
                    
                    //get envelope location
                    $envelope_location_sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$envelope_model_id."'";// and quantity > ".$quantity."";
                    echo $envelope_location_sql;
                    echo "<br>";
                    $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
                    $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
                    $envelope_location_id = $envelope_location_row['location_id'];
                    $inventory_location_id = $envelope_location_row['inventory_location_id'];
                    
                    if(!empty($envelope_location_id)){
                        //get category id
                        $sql_2 = "select category_id from inventory_model where inventory_model_id = '".$inventory_model_id."'";
                        $result_2 = mysql_query($sql_2, Service::$database_connect);
                        $row_2 = mysql_fetch_assoc($result_2);
                        $category_id = $row_2['category_id'];
                        
                        //envelope stock out
                        if($category_id == $battery_category){
                            if($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] == 1){
                                //1S
                                echo "<font color='red'>1S</font><br>";
                                $inventory_location_id = $s_inventory_location_id;
                                $envelope_model_id = $s_envelope_model_id;
                                $row_1['quantity'] = 1;
                            }elseif($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] > 1 && $row_1['quantity'] < 5){
                                //2-4S = L
                                echo "<font color='red'>2-4S = L</font><br>";
                                $inventory_location_id = $l_inventory_location_id;
                                $envelope_model_id = $l_envelope_model_id;
                                $row_1['quantity'] = 1;
                            }elseif($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] == 5){
                                //5S = XL
                                echo "<font color='red'>5S = XL</font><br>";
                                $inventory_location_id = $xl_inventory_location_id;
                                $envelope_model_id = $xl_envelope_model_id;
                                $row_1['quantity'] = 1;
                            }elseif($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] > 5){
                                //over XL
                                echo "<font color='red'>over XL</font><br>";
                                continue;
                            }  
                        }
                        
                        //envelope add stock out transaction
                        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','stock out for ".$row['shipment_id']."','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $sql;
                        echo "<br>";
                        $result = mysql_query($sql, Service::$database_connect);
                        $envelope_transaction_id = mysql_insert_id(Service::$database_connect);
                        
                        $envelope_stock_out_sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
                        values ('".$inventory_location_id."','".$envelope_transaction_id."','".$row_1['quantity']."','".$envelope_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."')";
                        echo $envelope_stock_out_sql;
                        echo "<br>";
                        $envelope_stock_out_result = mysql_query($envelope_stock_out_sql, Service::$database_connect);
                        if($envelope_stock_out_result){
                            //envelope update stock quantity
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$row_1['quantity']." where inventory_model_id = '".$envelope_model_id."' and location_id = '".$envelope_location_id."'";
                            echo $envelope_update_stock_sql;
                            echo "<br>";
                            $envelope_update_stock_result = mysql_query($envelope_update_stock_sql, Service::$database_connect);
                            if($envelope_update_stock_result){
                                $envelope_status_sql = "update inventory_transaction set envelope_status = 1 where inventory_transaction_id = '".$row_1['inventory_transaction_id']."'";
                                echo $envelope_status_sql;
                                echo "<br>";
                                $envelope_status_result = mysql_query($envelope_status_sql, Service::$database_connect);
                            }
                        }
                    }else{
                        echo "Error: Envelope Not In Location!<br>";
                    }
                    echo "<font color='red'><br>Single Envelope End<br></font>";
                    
                }
            }
//------------------------------------------ Single End  ----------------------------------------------------
        }
    }
    
    
    
    public function deleteInventory(){
        $inventory_model_id = $_GET['id'];
        
        //delte custom field value
        $sql_4 = "delete from custom_field_selection where entity_id = '".$inventory_model_id."'";
        echo $sql_4;
        echo "<br>";
        $result_4 = mysql_query($sql_4, Service::$database_connect);
        
        //get inventory location id
        $sql_6 = "select inventory_location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";
        echo $sql_6;
        echo "<br>";
        $result_6 = mysql_query($sql_6, Service::$database_connect);
        $row_6 = mysql_fetch_assoc($result_6);
        
        //get transaction id
        $sql_7 = "select inventory_transaction_id,transaction_id from inventory_transaction where inventory_location_id = '". $row_6['inventory_location_id']."'";
        echo $sql_7;
        echo "<br>";
        $result_7 = mysql_query($sql_7, Service::$database_connect);
        
        while($row_7 = mysql_fetch_assoc($result_7)){
            //delete transactoin
            $sql_8 = "delete from transaction where transaction_id = '".$row_7['transaction_id']."'";
            echo $sql_8;
            echo "<br>";
            $result_8 = mysql_query($sql_8, Service::$database_connect);
            
            //delete inventory transaction
            $sql_9 = "delete from inventory_transaction where inventory_transaction_id = '".$row_7['inventory_transaction_id']."'";
            echo $sql_9;
            echo "<br>";
            $result_9 = mysql_query($sql_9, Service::$database_connect);
        }
        
        /*
        //delete inventory location
        $sql_10 = "delete from inventory_location where inventory_location_id = '". $row_6['inventory_location_id']."'";
        echo $sql_10;
        echo "<br>";
        $result_10 = mysql_query($sql_10, Service::$database_connect);
        */
        
        //delete inventory location
        $sql_5 = "delete from inventory_location where inventory_model_id = '".$inventory_model_id."'";
        echo $sql_5;
        echo "<br>";
        $result_5 = mysql_query($sql_5, Service::$database_connect);
        
        //delete sku
        $sql_2 = "delete from inventory_model where inventory_model_id = '".$inventory_model_id."'";
        echo $sql_2;
        echo "<br>";
        $result_2 = mysql_query($sql_2, Service::$database_connect);
    }
    
    private function addInventory($category_id, $inventory_model_code, $short_description, $long_description, $weight, $cost, $envelopes, $quantity, $manufacturer_id){
        //get weight field id
        $weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
        echo $weight_field_sql;
        echo "<br>";
        $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
        $weight_field_row = mysql_fetch_assoc($weight_field_result);
        $weight_field_id = $weight_field_row['custom_field_id'];
        
        //get cost field id
        $cost_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['cost']."'";
        echo $cost_field_sql;
        echo "<br>";
        $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
        $cost_field_row = mysql_fetch_assoc($cost_field_result);
        $cost_field_id =  $cost_field_row['custom_field_id'];
        
        //get envelope field id
        $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['envelope']."'";
        echo $envelope_field_sql;
        echo "<br>";
        $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
        $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
        $envelope_field_id = $envelope_field_row['custom_field_id'];
            
        $entity_qtype_id = 2; //inventory
        
        //----------------------------------------------------------------------------------------------------    
        
        //入库 仓库
        $location_id = 6;
        
        
        $created_by = 1;
        $creation_date = date("Y-m-d H:i:s");
        
        
        /*
        $category_id = 1;
        $inventory_model_code = "a09050901";
        $short_description = "a09050901";
        $long_description = "a09050901";
        
        $weight = "0.5";
        $cost = "200";
        $envelope = "L";
        */
        
        
        $sql = "insert into inventory_model (category_id,manufacturer_id,inventory_model_code,short_description,long_description,created_by,creation_date) values 
        ($category_id,$manufacturer_id,'".$inventory_model_code."','".mysql_real_escape_string($short_description)."','".mysql_real_escape_string($long_description)."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        if(!$result){
            
            $sql_1 = "select inventory_model_id from inventory_model where inventory_model_code = '".$inventory_model_code."'";
            echo $sql_1;
            echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
            $row_1 = mysql_fetch_assoc($result_1);
            $inventory_model_id = $row_1['inventory_model_id'];
            
            //delte custom field value
            $sql_4 = "delete from custom_field_selection where entity_id = '".$inventory_model_id."'";
            echo $sql_4;
            echo "<br>";
            $result_4 = mysql_query($sql_4, Service::$database_connect);
            
            //get inventory location id
            $sql_6 = "select inventory_location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";
            echo $sql_6;
            echo "<br>";
            $result_6 = mysql_query($sql_6, Service::$database_connect);
            $row_6 = mysql_fetch_assoc($result_6);
            
            //get transaction id
            $sql_7 = "select inventory_transaction_id,transaction_id from inventory_transaction where inventory_location_id = '". $row_6['inventory_location_id']."'";
            echo $sql_7;
            echo "<br>";
            $result_7 = mysql_query($sql_7, Service::$database_connect);
            
            while($row_7 = mysql_fetch_assoc($result_7)){
                //delete transactoin
                $sql_8 = "delete from transaction where transaction_id = '".$row_7['transaction_id']."'";
                echo $sql_8;
                echo "<br>";
                $result_8 = mysql_query($sql_8, Service::$database_connect);
                
                //delete inventory transaction
                $sql_9 = "delete from inventory_transaction where inventory_transaction_id = '".$row_7['inventory_transaction_id']."'";
                echo $sql_9;
                echo "<br>";
                $result_9 = mysql_query($sql_9, Service::$database_connect);
            }
            
            /*
            //delete inventory location
            $sql_10 = "delete from inventory_location where inventory_location_id = '". $row_6['inventory_location_id']."'";
            echo $sql_10;
            echo "<br>";
            $result_10 = mysql_query($sql_10, Service::$database_connect);
            */
            
            //delete inventory location
            $sql_5 = "delete from inventory_location where inventory_model_id = '".$inventory_model_id."'";
            echo $sql_5;
            echo "<br>";
            $result_5 = mysql_query($sql_5, Service::$database_connect);
            
            //delete sku
            $sql_2 = "delete from inventory_model where inventory_model_id = '".$inventory_model_id."'";
            echo $sql_2;
            echo "<br>";
            $result_2 = mysql_query($sql_2, Service::$database_connect);
            
            //insert sku
            $sql = "insert into inventory_model (category_id,manufacturer_id,inventory_model_code,short_description,long_description,created_by,creation_date) values 
            ($category_id,$manufacturer_id,'".$inventory_model_code."','".mysql_real_escape_string($short_description)."','".mysql_real_escape_string($long_description)."','".$created_by."','".$creation_date."')";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
        }
        $inventory_model_id = mysql_insert_id(Service::$database_connect);
        //$inventory_model_id = 100;
        
        //add weight
        echo "<font color='red'>add weight</font><br>";
        $sql = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values ($weight_field_id,'".$weight."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $weight_custom_field_value_id = mysql_insert_id(Service::$database_connect);
        
        $sql = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values ($weight_custom_field_value_id,$entity_qtype_id,$inventory_model_id)";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
        //add cost
        echo "<font color='red'>add cost</font><br>";
        $sql = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values ($cost_field_id,'".$cost."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $cost_custom_field_value_id = mysql_insert_id(Service::$database_connect);
        
        $sql = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values ($cost_custom_field_value_id,$entity_qtype_id,$inventory_model_id)";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
        //add envelope
        echo "<font color='red'>add envelope</font><br>";
        $sql = "select custom_field_value_id from custom_field_value where custom_field_id = '".$envelope_field_id."' and short_description = '".$envelopes."'";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $envelope_custom_field_value_id = $row['custom_field_value_id'];
        /*
        $sql = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values ($envelope_field_id,'".$envelope."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $envelope_custom_field_value_id = mysql_insert_id(Service::$database_connect);
        */
        echo "<font color='red'>add custom field</font><br>";
        $sql = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values ($envelope_custom_field_value_id,$entity_qtype_id,$inventory_model_id)";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
        
        //add location quantity
        echo "<font color='red'>add location quantity</font><br>";
        $sql = "insert into inventory_location (inventory_model_id,location_id,quantity,created_by,creation_date) 
        values ('".$inventory_model_id."','".$location_id."','".$quantity."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $inventory_location_id = mysql_insert_id(Service::$database_connect);
        
        //restock
        //add transactions  Restock(4)
        echo "<font color='red'>add transactions</font><br>";
        $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','4','import stock','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $transaction_id = mysql_insert_id(Service::$database_connect);
        
        //add inventory transactions    New Inventory(4)
        echo "<font color='red'>add inventory transactions</font><br>";
        $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
        values ('".$inventory_location_id."','".$transaction_id."','".$quantity."','4','".$location_id."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
    }
    
    public function importCsv(){
        /*
        $creation_date = "2009-05-19 15:30:00";
        $sql = "delete from custom_field_value where creation_date > '".$creation_date."'";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        */
        $csv_file_name = $_GET['file_name'];
        $categories_id = 4;
        $row = 1;
        
        $handle = fopen($csv_file_name, "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            /*
            if($row > 214){
                $categories_id = 1;
            }elseif($row > 117){
                 $categories_id = 4;
            }elseif($row > 95){
                $categories_id = 3;
            }
            */
            $num = count($data);
            echo "<font color='green'> $num fields in line $row: <br /></font>\n";
            
            for ($c=0; $c < $num; $c++) {
                echo $c.": ".$data[$c] . "<br />\n";
            }
            
            //var_dump($data);
            if(in_array($data[5], array('S','M','L','XL'))){
                //if(!is_int($data[2])){
                //    $data[2] = substr($data[2], 3);
                //}
                                
                switch($data[7]){
                    case "历精";
                        $data[7] = 1;
                        break;
                    
                    case "飞远";
                        $data[7] = 4;
                        break;
                    
                    case "恒丰利泰";
                        $data[7] = 5;
                        break;
                    
                    default:
                        $data[7] = 3;
                        break;
                }
                
                //var_dump($data);
                //exit;
                /*
                $sql = "select manufacturer_id from manufacturer where LOCATE(short_description,'".trim($data[5])."')";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                $row = mysql_fetch_assoc($result);
                var_dump($row);
                $data[5] = $row['manufacturer_id'];
                */
                
                $data[0] = trim($data[0]);
                $data[1] = trim($data[1]);
                $data[2] = trim($data[2]);
                $data[3] = trim($data[3]);
                $data[4] = trim($data[4]);
                $data[5] = trim($data[5]);
                $data[6] = trim($data[6]);
                $data[7] = trim($data[7]);
                //category_id, inventory_model_code, short_description, long_description, weight, cost, envelopes, quantity, manufacturer_id
                $this->addInventory($categories_id, $data[0], $data[1], $data[2], $data[4], $data[3], $data[5], $data[6], $data[7]);
                //exit;
            }

            //if($row > 5)
            //    exit;
                
            $row++;
            //exit;
        }
        fclose($handle);
    }
    
    public function updateStockDays(){
        //select * from  custom_field_value as cfv left join custom_field_selection cfs on cfv.custom_field_value_id = cfs.custom_field_value_id where cfv.custom_field_id = 8 and cfs.entity_id = 1486;
        $created_by = 1;
        $creation_date = date("Y-m-d H:i:s");
        $modified_by = 1;
        $modified_date = date("Y-m-d H:i:s");
        $stock_days = 2;
        $entity_qtype_id = 2; //inventory
        $manufacturer_id = 1; //历精
        
        //get stock days field id
        $stock_days_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['stockDays']."'";
        echo $stock_days_field_sql;
        echo "<br>";
        $stock_days_field_result = mysql_query($stock_days_field_sql, Service::$database_connect);
        $stock_days_field_row = mysql_fetch_assoc($stock_days_field_result);
        $stock_days_field_id = $stock_days_field_row['custom_field_id'];
            
        $sql_1 = "select inventory_model_id from inventory_model where manufacturer_id <> '".$manufacturer_id."'";
        echo $sql_1;
        echo "<br>";
        $result_1 = mysql_query($sql_1, Service::$database_connect);
        while($row_1 = mysql_fetch_assoc($result_1)){
            $inventory_model_id = $row_1['inventory_model_id'];
            
            $sql = "select cfv.custom_field_value_id from custom_field_value as cfv left join custom_field_selection cfs on cfv.custom_field_value_id = cfs.custom_field_value_id where cfv.custom_field_id = '".$stock_days_field_id."' and cfs.entity_id = '".$inventory_model_id."'";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            if(empty($row['custom_field_value_id'])){
                //add stock days
                echo "<font color='red'>add stock days</font><br>";
                $sql = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values ($stock_days_field_id,'".$stock_days."','".$created_by."','".$creation_date."')";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                $stock_days_custom_field_value_id = mysql_insert_id(Service::$database_connect);
                
                $sql = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values ($stock_days_custom_field_value_id,$entity_qtype_id,$inventory_model_id)";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
            }else{
                $sql = "update custom_field_value set short_description = '".$stock_days."',modified_by = '".$modified_by."',modified_date = '".$modified_date."' where custom_field_value_id = '".$row['custom_field_value_id']."'";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
            }
            
            echo "<br>";
            echo "<br>";
            //exit;
        }
    }
    
    public function stockAttention(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
        /*
        $sql = "select count(*) as count from 
        inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
        where il.quantity < im.week_flow";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $count = $row['count'];
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        
        if ($page > $total_pages)
            $page=$total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        
        $sql = "select im.inventory_model_id as id,im.week_flow as flow,im.inventory_model_code as model,il.quantity,im.short_description as name,l.short_description as location from 
        inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
        where il.quantity < im.week_flow order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $i = 0;
        while($row = mysql_fetch_assoc($result)){
            $responce->rows[$i]['id']= $row[inventory_model_id];
            $responce->rows[$i]['cell'] = array($row['id'],$row['model'],$row['name'],$row['quantity'],$row['flow'],$row['location']);
            $i++; 
            //$array[] = $row;
        }
        echo json_encode($responce);
        */
        
        
        //***********************************************************************************************
        /*
        $sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['lowerLimit']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        
        
        $sql_1 = "select count(*) as count from inventory_location as il where il.quantity <= (select cfv.short_description as count from custom_field_value as cfv left join custom_field_selection as cfs on cfv.custom_field_value_id = cfs.custom_field_value_id 
        where il.inventory_model_id = cfs.entity_id and cfs.entity_qtype_id = 2 and custom_field_id = '".$row['custom_field_id']."')";
        //echo $sql_1;
        //echo "<br>";
        
        $result_1 = mysql_query($sql_1, Service::$database_connect);
        $row_1 = mysql_fetch_assoc($result_1);
        $count = $row_1['count'];
        
        //var_dump($count);
        
        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 1;
        }
        
        //var_dump($total_pages);

        if ($page > $total_pages){
            $page = $total_pages;
        }
        
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        
        $sql_2 = "select il.inventory_model_id from inventory_location as il where il.quantity <= (select cfv.short_description from custom_field_value as cfv left join custom_field_selection as cfs on cfv.custom_field_value_id = cfs.custom_field_value_id 
        where il.inventory_model_id = cfs.entity_id and cfs.entity_qtype_id = 2 and custom_field_id = '".$row['custom_field_id']."') order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql_2;
        //echo "<br>";
        
        $i = 0;
        $result_2 = mysql_query($sql_2, Service::$database_connect);
        while($row_2 = mysql_fetch_assoc($result_2)){
            
            $sql_3 = "select im.inventory_model_id as id,im.week_flow as flow,im.inventory_model_code as model,il.quantity,im.short_description as name,l.short_description as location from 
            inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
            where im.inventory_model_id = '".$row_2['inventory_model_id']."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Service::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
            
            $responce->rows[$i]['id']= $row_2['inventory_model_id'];
            $responce->rows[$i]['cell'] = array($row_3['model'],$row_3['name'],$row_3['quantity'],$row_3['flow']);
            $i++;
        }
        echo json_encode($responce);
        */
        
        $game_category_id = 1;
        $battery_category_id = 2;
        $security_category_id = 3;
        $accessories_category_id = 4;
        $oil_painting_category_id = 5;
        
        //get stock day
        $sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['stockDays']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
        
        $sql_0 = "select count(*) as count from inventory_model where category_id = '".$_GET['category_id']."'";
        $result_0 = mysql_query($sql_0, Service::$database_connect);
        $row_0 = mysql_fetch_assoc($result_0);
        $count = $row_0['count'];
        
        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 1;
        }
        
        //var_dump($total_pages);

        if ($page > $total_pages){
            $page = $total_pages;
        }
        
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        
        $manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, Service::$database_connect);
        while($row_4 = mysql_fetch_assoc($result_4)){
        	$manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
        
        $sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,week_flow_1,week_flow_2,week_flow_3 from inventory_model where category_id = '".$_GET['category_id']."' order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql_1;
        //echo "<br>";
        
        $result_1 = mysql_query($sql_1, Service::$database_connect);
        $array = array();
        $i = 0;
        $xx = 0;
        $responce->records = 0;
        
        while($row_1 = mysql_fetch_assoc($result_1)){
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, Service::$database_connect);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
            
            $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Service::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
            //$array[$i]['stock_day'] = $row_3['short_description'];
            
            //$array[$i]['ready_stock'] = ($array[$i]['week_flow'] / 7 ) * $array[$i]['stock_day'];
            if($row_1['week_flow_1'] > 0){// && $row_2['quantity'] <= ($row_1['week_flow_1'] / 7 ) * $row_3['short_description']){
            	$responce->rows[$i]['id']= $row_1['inventory_model_id'];
	            $responce->rows[$i]['cell'] = array($row_1['inventory_model_code'], $row_1['short_description'], $row_2['quantity'], round(($row_1['week_flow'] / 14 ) * $row_3['short_description']), $row_3['short_description'], $row_1['week_flow_1'], $row_1['week_flow_2'], $row_1['week_flow_3'], $manufacture[$row_1['manufacturer_id']]);
	            $i++;
	            $responce->records++;
            }
        }
    	if( $i > 0 ) {
            $responce->total = ceil($i/$limit);
        } else {
            $responce->total = 1;
        }
        echo json_encode($responce);
    }
    
    public function stockAttentionByCategory(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
        
        $sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['lowerLimit']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        
        
        $sql_1 = "select count(*) as count from inventory_location as il where il.quantity <= (select cfv.short_description as count from custom_field_value as cfv left join custom_field_selection as cfs on cfv.custom_field_value_id = cfs.custom_field_value_id 
        where il.inventory_model_id = cfs.entity_id and cfs.entity_qtype_id = 2 and custom_field_id = '".$row['custom_field_id']."')";
        //echo $sql_1;
        //echo "<br>";
        
        $result_1 = mysql_query($sql_1, Service::$database_connect);
        $row_1 = mysql_fetch_assoc($result_1);
        $count = $row_1['count'];
        
        //var_dump($count);
        
        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 1;
        }
        
        //var_dump($total_pages);

        if ($page > $total_pages){
            $page = $total_pages;
        }
        
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        
        /*
        $sql_2 = "select cfs.entity_id from custom_field_value as cfv left join custom_field_selection as cfs on cfv.custom_field_value_id = cfs.custom_field_value_id 
        where cfs.entity_qtype_id = 2 and cfv.short_description < 3 and custom_field_id = '".$row['custom_field_id']."'";
        */
        
        $sql_2 = "select il.inventory_model_id from inventory_location as il where il.quantity <= (select cfv.short_description from custom_field_value as cfv left join custom_field_selection as cfs on cfv.custom_field_value_id = cfs.custom_field_value_id 
        where il.inventory_model_id = cfs.entity_id and cfs.entity_qtype_id = 2 and custom_field_id = '".$row['custom_field_id']."') order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql_2;
        //echo "<br>";
        
        $i = 0;
        $result_2 = mysql_query($sql_2, Service::$database_connect);
        while($row_2 = mysql_fetch_assoc($result_2)){
            
            $sql_3 = "select im.inventory_model_id as id,im.week_flow_1,im.week_flow_2,im.week_flow_3,im.inventory_model_code as model,il.quantity,im.short_description as name,l.short_description as location from 
            inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
            where im.inventory_model_id = '".$row_2['inventory_model_id']."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Service::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
            
            $responce->rows[$i]['id']= $row_2['inventory_model_id'];
            $responce->rows[$i]['cell'] = array($row_3['model'],$row_3['name'],$row_3['quantity'],$row_3['flow_1'],$row_3['flow_2'],$row_3['flow_3']);
            $i++;
        }
        echo json_encode($responce);
    }
    
    public function outOfStock(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
        $sql = "select count(*) as count from 
        inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
        where il.quantity < 0";
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $count = $row['count'];
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        
        if ($page > $total_pages)
            $page=$total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        
        $sql = "select im.inventory_model_id as id,im.inventory_model_code as model,im.short_description as name,il.quantity,l.short_description as location from 
        inventory_model as im left join inventory_location as il on (im.inventory_model_id=il.inventory_model_id) left join location as l on (il.location_id=l.location_id) 
        where il.quantity < 0 order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
    
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $i = 0;
        while($row = mysql_fetch_assoc($result)){
            $responce->rows[$i]['id']= $row[id];
            $responce->rows[$i]['cell'] = array($row['id'],$row['model'],$row['name'],$row['quantity'],$row['location']);
            $i++; 
        }
        echo json_encode($responce); 
    }
    
    public function topSales(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
        $sql = "select count(*) as count from 
        inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id";
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $count = $row['count'];
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        
        if ($page > $total_pages)
            $page=$total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        
        $sql = "select it.inventory_location_id as id,im.inventory_model_code as model,im.short_description as name,it.quantity,it.creation_date as time from 
        inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
        order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        $result = mysql_query($sql, Service::$database_connect);
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $i = 0;
        while($row = mysql_fetch_assoc($result)){
            $responce->rows[$i]['id']= $row['id'];
            $responce->rows[$i]['cell'] = array($row['id'],$row['model'],$row['name'],$row['quantity'],$row['time']);
            $i++; 
        }
        echo json_encode($responce); 
    }
    
    public function totalPostageByDate(){
        if(empty($_GET['start_date'])){
            $sql = "select sum(shipment_fee) as total_shipment_fee from inventory_transaction where creation_date like '".date("Y-m-d")."%'"; 
        }else{
            $sql = "select sum(shipment_fee) as total_shipment_fee from inventory_transaction where creation_date between '".$_GET['start_date']."' and '".$_GET['end_date']."'";
        }
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        if(!empty($row['total_shipment_fee'])){
            echo $row['total_shipment_fee'];
        }else{
            echo "0.00";
        }
    }
    
    public function postageByDate(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(empty($_GET['start_date'])){
            $sql = "select count(*) as count from 
            inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id where it.creation_date like '".date("Y-m-d")."%'";
        }else{
            $sql = "select count(*) as count from 
            inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id where it.creation_date between '".$_GET['start_date']."' and '".$_GET['end_date']."'";
        }
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $count = $row['count'];
        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        
        if($page == 0)
            $page = 1;
            
        //if ($page > $total_pages)
        //    $page = $total_pages;
        
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        if(empty($_GET['start_date'])){
            $sql = "select im.inventory_model_code,it.quantity,it.shipment_method,it.shipment_fee from 
            inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
            where it.creation_date like '".date("Y-m-d")."%' order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        }else{
            $sql = "select im.inventory_model_code,it.quantity,it.shipment_method,it.shipment_fee from 
            inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
            where it.creation_date between '".$_GET['start_date']."' and '".$_GET['end_date']."' order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        }
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $i = 0;
        while($row = mysql_fetch_assoc($result)){
            $responce->rows[$i]['id']= $row['inventory_model_code'];
            $responce->rows[$i]['cell'] = array($row['inventory_model_code'],$row['quantity'],$row['shipment_method'],$row['shipment_fee']);
            $i++; 
        }
        echo json_encode($responce); 
        
    }
    
    public function getCategoryBySku($sku){
	$sql = "select category_id from inventory_model where inventory_model_code = '".$sku."'";
	$result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
	$category_id = $row['category_id'];
	
	if(!empty($category_id)){
	    $sql = "select short_description from category where category_id = ".$category_id;
	    $result = mysql_query($sql, Service::$database_connect);
	    $row = mysql_fetch_assoc($result);
	    return $row['short_description'];
	}else{
	    return "";
	}
    }
    
    public function getWeightBySku($sku){
	$sql_0 = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result_0 = mysql_query($sql_0, Service::$database_connect);
        $row_0 = mysql_fetch_assoc($result_0);
	$inventory_model_id = $row_0['inventory_model_id'];
	
	//-------------------------------------------   Weight   -----------------------------------------------
	//get weight field id
	//echo "<font color='red'><br>Weight Start<br></font>";
	$weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
	//echo $weight_field_sql;
	//echo "<br>";
	$weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
	$weight_field_row = mysql_fetch_assoc($weight_field_result);
	
	
	//get weight value
	$weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id
	where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
	//echo $weight_value_sql;
	//echo "<br>";
	$weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
	$weight_value_row = mysql_fetch_assoc($weight_value_result);
	$weight = (float)$weight_value_row['short_description'];
	
	return $weight;
    }
    
    public function getEPEBySku($sku){
	$sql_0 = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result_0 = mysql_query($sql_0, Service::$database_connect);
        $row_0 = mysql_fetch_assoc($result_0);
	$inventory_model_id = $row_0['inventory_model_id'];
	
	//-------------------------------------------   Weight   -----------------------------------------------
	//get weight field id
	//echo "<font color='red'><br>Weight Start<br></font>";
	$weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['EPE']."'";
	//echo $weight_field_sql;
	//echo "<br>";
	$weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
	$weight_field_row = mysql_fetch_assoc($weight_field_result);
	
	
	//get weight value
	$weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id
	where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
	//echo $weight_value_sql;
	//echo "<br>";
	$weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
	$weight_value_row = mysql_fetch_assoc($weight_value_result);
	$weight = $weight_value_row['short_description'];
	
	return $weight;
    }
    
    public function getProductGradeBySku($sku = ''){
	global $argv;
	if(!empty($argv[2])){
	    $sku = $argv[2];
	}
	
	$sql_0 = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result_0 = mysql_query($sql_0, Service::$database_connect);
        $row_0 = mysql_fetch_assoc($result_0);
	$inventory_model_id = $row_0['inventory_model_id'];
	
	//-------------------------------------------   Weight   -----------------------------------------------
	//get weight field id
	//echo "<font color='red'><br>Weight Start<br></font>";
	$weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['productGrade']."'";
	//echo $weight_field_sql;
	//echo "<br>";
	$weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
	$weight_field_row = mysql_fetch_assoc($weight_field_result);
	
	
	//get weight value
	$weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id
	where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
	//echo $weight_value_sql;
	//echo "<br>";
	$weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
	$weight_value_row = mysql_fetch_assoc($weight_value_result);
	$weight = $weight_value_row['short_description'];
	
	//echo $weight;
	return $weight;
    }
    
    public function getShippingFeeBySku($sku="", $shipment_method="", $quantity=1){
	switch($shipment_method){
            case "B":
                $shipment_method_descript = "Bulk";
                break;
            
            case "R":
                $shipment_method_descript = "Registered";
                break;
            
            case "S":
                $shipment_method_descript = "SpeedPost";
                break;
            
        }
	
	$sql_0 = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result_0 = mysql_query($sql_0, Service::$database_connect);
        $row_0 = mysql_fetch_assoc($result_0);
	$inventory_model_id = $row_0['inventory_model_id'];
	
	//-------------------------------------------   Weight   -----------------------------------------------
	//get weight field id
	//echo "<font color='red'><br>Weight Start<br></font>";
	$weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
	//echo $weight_field_sql;
	//echo "<br>";
	$weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
	$weight_field_row = mysql_fetch_assoc($weight_field_result);
	
	
	//get weight value
	$weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id
	where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
	//echo $weight_value_sql;
	//echo "<br>";
	$weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
	$weight_value_row = mysql_fetch_assoc($weight_value_result);
	$weight = (float)$weight_value_row['short_description'];
	
	switch($shipment_method){
	    case "B":
		$shipment_fee = 90 * $weight;
		break;
	    
	    case "R":
		$shipment_fee = (110 * $weight) + $quantity * 13;
		break;
	    
	    case "S":
		$shipment_fee = 240 + (($weight - 0.5 ) / 0.5 * 75) * 0.42;
		break;
	    
	}
	    
	return $shipment_fee;
    }
    
    public function getShippingMethodBySku($sku_json=""){
        $AEACJ = array('United States', 'United Kingdom', 'Australia', 'Canada', 'Japan');
        $_GET['data'] = str_replace("\\", "", $_GET['data']);
        $data = json_decode($_GET['data']);
	if(!empty($sku_json)){
	    $sku_array = json_decode($sku_json);
	    $this->log = false;
	}else{
	    //echo $_GET['data'];
	    //file_put_contents("/tmp/1.log", print_r($data, true), FILE_APPEND);
	    $sku_array = $data->sku_array;
	    //$sku_array = explode(",", $_GET['skuString']);
	}
       
        //var_dump($sku_array);
        //$shippingMethod = array();
        $total_weight = 0;
        $total_cost = 0;
        
        $this->log("getShippingMethodBySku", "<font color='black'><br>======================================   ".$data->id." Start  ======================================<br></font>");
        /*
        foreach($sku_array as $sku){
            //var_dump($sku);
            $this->log("getShippingMethodBySku", "<font color='green'><br>Loop Start--------------------------------------------------------<br></font>");
            //get sku model id
            $sql = "select inventory_model_id,category_id from inventory_model where inventory_model_code='".$sku->skuId."'";
            $this->log("getShippingMethodBySku", $sql."<br>");
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $category = $row['category_id'];
            $inventory_model_id = $row['inventory_model_id'];
            $this->log("getShippingMethodBySku", "category: ".$category."<br>inventory_model_id: ".$inventory_model_id."<br>");

            //-------------------------------------------   Weight   -----------------------------------------------
            //get weight field id
            $this->log("getShippingMethodBySku", "<font color='red'><br>Weight Start<br></font>");
            $weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
            $this->log("getShippingMethodBySku", $weight_field_sql."<br>");
            
            $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
            $weight_field_row = mysql_fetch_assoc($weight_field_result);
            
            
            //get weight value
            $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
            $this->log("getShippingMethodBySku", $weight_value_sql."<br>");
            
            $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
            $weight_value_row = mysql_fetch_assoc($weight_value_result);
            $weight = (float) $weight_value_row['short_description'] * $sku->quantity;
            $total_weight += $weight;
            $this->log("getShippingMethodBySku", "weight: ".$weight."<br><font color='red'>Weight End<br></font>");
            
            //-------------------------------------------    Cost    -----------------------------------------------
            //get cost field id
            $this->log("getShippingMethodBySku", "<font color='red'><br>Cost Start<br></font>");
            $cost_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['cost']."'";
            $this->log("getShippingMethodBySku", $cost_field_sql."<br>");

            $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
            $cost_field_row = mysql_fetch_assoc($cost_field_result);
            
            
            //get cost value
            $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
            $this->log("getShippingMethodBySku", $cost_value_sql."<br>");

            $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
            $cost_value_row = mysql_fetch_assoc($cost_value_result);
            $cost = $cost_value_row['short_description'] * $sku->quantity;
            $this->log("getShippingMethodBySku", "cost: ".$cost."<br><font color='red'>Cost End<br></font>");
            
            //-----------------------------------------    Paper tube  ----------------------------------------------
            //get Paper tube field id
            $this->log("getShippingMethodBySku", "<font color='red'><br>Paper Start<br></font>");
            $paper_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['paperTube']."'";
            $this->log("getShippingMethodBySku", $paper_field_sql."<br>");
 
            $paper_field_result = mysql_query($paper_field_sql, Service::$database_connect);
            $paper_field_row = mysql_fetch_assoc($paper_field_result);
            
            
            //get Paper tube value
            $paper_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$paper_field_row['custom_field_id']."'";
            $this->log("getShippingMethodBySku", $paper_value_sql."<br>");
            
            $paper_value_result = mysql_query($paper_value_sql, Service::$database_connect);
            $paper_value_row = mysql_fetch_assoc($paper_value_result);
            $paper = $paper_value_row['short_description'];
            $this->log("getShippingMethodBySku", "Paper: ".$paper."<br><font color='red'>Paper End<br></font>");
            
            
            if($weight > 1.4){
                $shippingMethod[3] = "S";
                $currently = "S";
                break;
            }else{
                switch($category){
                    case "1":
                        //Battery
                        if($cost < 100 || ($cost >= 100 && $cost < 200 && in_array($data->country, $AEA))){
                            $shippingMethod[1] = "B";
                            $currently = "B";
                        }else{
                            $shippingMethod[2] = "R";
                            $currently = "R";
                            break;
                        }
                    break;
                
                    case "2":
                        //Game
                        if($cost < 150){
                            $shippingMethod[1] = "B";
                            $currently = "B";
                        }else{
                            $shippingMethod[2] = "R";
                            $currently = "R";
                            break;
                        }
                    break;
                
                    case "3":
                        //Security
                        if($cost < 99){
                            $shippingMethod[1] = "B";
                            $currently = "B";
                        }else{
                            $shippingMethod[2] = "R";
                            $currently = "R";
                            break;
                        }
                    break;
                
                    case "4":
                        //Case
                        $shippingMethod[1] = "B";
                        $currently = "B";
                    break;
                
                    case "5":
                        //Oil Painting
                        if($sku->quantity < 3){
                            $shippingMethod[1] = "B";
                            $currently = "B";
                        }else{
                            $shippingMethod[3] = "S";
                            $currently = "S";
                        }
                        
                        if($paper != "S"){
                            $shippingMethod[3] = "S";
                            $currently = "S";
                        }
                    break;
                }
            }
            $this->log("getShippingMethodBySku", "currently: ".$currently);
            $this->log("getShippingMethodBySku", "<font color='green'><br>Loop End--------------------------------------------------------<br></font>");
        }
        
        if($total_weight > 1.4){
            $shippingMethod[3] = "S";
        }
        */
        
        foreach($sku_array as $sku){
            //var_dump($sku);
            $this->log("getShippingMethodBySku", "<font color='green'><br>******************************************  SKU Loop Start  ******************************************<br></font>");
            //get sku model id
            $sql = "select inventory_model_id from inventory_model where inventory_model_code='".$sku->skuId."'";
            $this->log("getShippingMethodBySku", $sql."<br>");
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $inventory_model_id = $row['inventory_model_id'];
            $this->log("getShippingMethodBySku", "Inventory Model Id: ".$inventory_model_id."<br>");
            if(!empty($inventory_model_id)){
                //-------------------------------------------   Weight   -----------------------------------------------
                //get weight field id
                $this->log("getShippingMethodBySku", "<font color='red'><br>******************************************  Weight Start  ******************************************<br></font>");
                $weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
                $this->log("getShippingMethodBySku", $weight_field_sql."<br>");
                
                $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
                $weight_field_row = mysql_fetch_assoc($weight_field_result);
                
                
                //get weight value
                $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                on cfs.custom_field_value_id=cfv.custom_field_value_id
                where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
                $this->log("getShippingMethodBySku", $weight_value_sql."<br>");
                
                $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
                $weight_value_row = mysql_fetch_assoc($weight_value_result);
                $weight = (float) $weight_value_row['short_description'] * $sku->quantity;
                $total_weight += $weight;
                $this->log("getShippingMethodBySku", "Weight: ".$weight."<br>******************************************  <font color='red'>Weight End  ******************************************<br></font>");
            
                //-------------------------------------------    Cost    -----------------------------------------------
                //get cost field id
                $this->log("getShippingMethodBySku", "<font color='red'><br>****************************************** Cost Start  ******************************************<br></font>");
                $cost_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['cost']."'";
                $this->log("getShippingMethodBySku", $cost_field_sql."<br>");
    
                $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
                $cost_field_row = mysql_fetch_assoc($cost_field_result);
                
                
                //get cost value
                $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                on cfs.custom_field_value_id=cfv.custom_field_value_id
                where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
                $this->log("getShippingMethodBySku", $cost_value_sql."<br>");
    
                $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
                $cost_value_row = mysql_fetch_assoc($cost_value_result);
                $total_cost += $cost_value_row['short_description'] * $sku->quantity;
                $this->log("getShippingMethodBySku", "Cost: ".$cost."<br><font color='red'>******************************************  Cost End  ******************************************<br></font>");
            }else{
                break;
            }
        }
        
        if($total_weight > 2){
            $shippingMethod = "U";
        }elseif($total_weight > 1.4){
            $shippingMethod = "S";
        }else{
            if(in_array($data->country, $AEACJ)){
                if($total_cost > 200){
                    $shippingMethod = "R";
                }else{
                    $shippingMethod = "B";
                }
            }else{
                if($total_cost > 150){
                    $shippingMethod = "R";
                }else{
                    $shippingMethod = "B";
                }
            }
        }
        $this->log("getShippingMethodBySku", "Total Weight: ".$total_weight."<br>");
        $this->log("getShippingMethodBySku", "Total Cost: ".$total_cost."<br>");
        //$this->log("getShippingMethodBySku", print_r($shippingMethod, true));
        $this->log("getShippingMethodBySku", "Shipping Method: ".$shippingMethod."<br>");
        $this->log("getShippingMethodBySku", "<font color='black'><br>======================================  ".$data->id." End   ======================================<br><br><br><br></font>");
        //$shippingMethod = (!empty($shippingMethod[3])?$shippingMethod[3]:(!empty($shippingMethod[2])?$shippingMethod[2]:$shippingMethod[1]));
        if(empty($sku_json)){
	    echo json_encode(array('shippingMethod'=>$shippingMethod));
	}
	return $shippingMethod;
    }
    
    public function getSkuLowestPrice($sku="", $internal=false){
	global $argv;
	if(!empty($argv[2])){
	    $sku = $argv[2];
	}else{
	    $sku = $_GET['sku'];
	}
	$sku_shipping_fee = $this->getShippingFeeBySku($sku, $this->getShippingMethodBySku(json_encode(array('skuId'=>$sku, 'quantity'=>1))));
	$envelope = $this->getEnvelopeBySku($sku);
	switch($envelope){
	    case "S":
		$envelope_cost = 0.8;
	    break;
	
	    case "M":
		$envelope_cost = 1.2;
	    break;
	
	    case "L":
		$envelope_cost = 4.6;
	    break;
	
	    case "XL":
		$envelope_cost = 6;
	    break;
	}
	$category = $this->getCategoryBySku($sku);
	switch($category){
	    case "Battery":
		$category_cost = 1.3;
	    break;
	
	    case "Power Tools":
		$category_cost = 1.3;
	    break;
	
	    case "Game":
		$category_cost = 1.4;
	    break;
	
	    case "Security":
		$category_cost = 1.3;
	    break;
	
	    default:
		$category_cost = 1.5;
	    break;
	}
	
	$epe_cost = $this->getEPEBySku($sku);
	switch($epe_cost){
	    case "2TX500mmX130mmX1":
		$epe_cost = 1;
	    break;
	
	    case "4TX500mmX130mmX2":
		$epe_cost = 2;
	    break;
	
	    case "4TX500mmX130mmX1":
		$epe_cost = 1;
	    break;
	
	    default:
		$epe_cost = 1;
	    break;
	}
	
	$productGrade = $this->getProductGradeBySku($sku);
	switch($productGrade){
	    case "A":
		$product_grade_cost = 1.28;
	    break;
	
	    case "B":
		$product_grade_cost = 1.30;
	    break;
	
	    case "C":
		$product_grade_cost = 1.35;
	    break;
	
	    case "D":
		$product_grade_cost = 1.4;
	    break;
	
	    case "E":
		$product_grade_cost = 1.45;
	    break;
	
	    case "F":
		$product_grade_cost = 1.5;
	    break;
	
	    default :
		$product_grade_cost = 1;
	    break;
	}
	
	$sku_cost = $this->getSkuCost($sku, true);
	$sku_weight = $this->getWeightBySku($sku);
	//echo $sku_cost."\n";
	//echo $sku_shipping_fee."\n";
	$lowestPrice = ($sku_cost * 1.06 + $envelope_cost + $epe_cost + $sku_shipping_fee + 2.4) * $product_grade_cost;
	//echo $lowestPrice."\n";
	$formula = "(".$sku_cost." * 1.06 + ".$envelope_cost." + ".$epe_cost." + ".$sku_shipping_fee." + 2.4) * ".$product_grade_cost;
	
	if($internal){
	    return $lowestPrice;
	}else{
	    echo json_encode(array('C'=> $sku_cost, 'W'=> $sku_weight, 'S'=> $sku_shipping_fee, 'L'=>$lowestPrice, 'F'=> $formula));
	}
    }
    
    public function getEnvelopeBySku($sku=""){
	if(!empty($sku)){
	    $skuArray[0]->skuId = $sku;
	    $this->log = false;
	}else{
	    $_GET['data'] = str_replace("\\", "", $_GET['data']);
	    //$this->log("getEnvelopeBySku", $_GET['data']."<br>");                
	    $skuArray = json_decode($_GET['data']);
	}
        $this->log("getEnvelopeBySku", "<font color='red'><br>****************************************** Start  ******************************************<br></font>");
        $envelope_field_value = "Envelope";
        $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['envelope']."'";
        //echo $envelope_field_sql;
        //echo "<br>";
        $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
        $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
        
        
        //$this->log("getEnvelopeBySku", print_r($skuArray, true));
        if(count($skuArray) > 1){
            $envelopeArray = array("B"=>0,
                                   "XL"=>0,
                                   "L"=>0,
                                   "M"=>0,
                                   "S"=>0);
            
            foreach($skuArray as $value){
                //get inventory model id
                $inventory_model_sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$value->skuId."'";
                $this->log("getEnvelopeBySku",$inventory_model_sql."<br>");
                //echo $inventory_model_sql;
                //echo "<br>";
                $inventory_model_result = mysql_query($inventory_model_sql, Service::$database_connect);
                $inventory_model_row = mysql_fetch_assoc($inventory_model_result);
                $inventory_model_id = $inventory_model_row['inventory_model_id'];
                
                if(!empty($inventory_model_id)){
                    //get envelope value
                    $envelope_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                    on cfs.custom_field_value_id=cfv.custom_field_value_id
                    where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$envelope_field_row['custom_field_id']."'";
                    $this->log("getEnvelopeBySku",$envelope_value_sql."<br>");
                    //echo $envelope_value_sql;
                    //echo "<br>";
                    $envelope_value_result = mysql_query($envelope_value_sql, Service::$database_connect);
                    $envelope_value_row = mysql_fetch_assoc($envelope_value_result);
                    $envelope = $envelope_value_row['short_description'];
                    
                    $envelopeArray[$envelope] += $value->quantity;
                }
            }
            
            $this->log("getEnvelopeBySku", print_r($envelopeArray, true));
            
            foreach($envelopeArray as $envelope){
                switch($envelope){
                    case "S":
                        if($envelopeArray["S"] > 2 && $envelopeArray["S"] <= 4){
                            echo json_encode(array('envelope' => 'M'));
                            return 1;
                        }elseif($envelopeArray["S"] > 4 && $envelopeArray["S"] <= 15){
                            echo json_encode(array('envelope' => 'L'));
                            return 1;
                        }elseif($envelopeArray["S"] > 15 && $envelopeArray["S"] <= 30){
                            echo json_encode(array('envelope' => 'XL'));
                            return 1;
                        }elseif($envelopeArray["S"] > 30){
                            echo json_encode(array('envelope' => 'B'));
                            return 1;
                        }
                    break;
                    
                    case "M":
                        if($envelopeArray["M"] > 2 && $envelopeArray["M"] <= 4){
                            echo json_encode(array('envelope' => 'L'));
                            return 1;
                        }elseif($envelopeArray["M"] > 4 && $envelopeArray["M"] <= 6){
                            echo json_encode(array('envelope' => 'XL'));
                            return 1;
                        }elseif($envelopeArray["M"] > 6){
                            echo json_encode(array('envelope' => 'B'));
                            return 1;
                        }
                    break;
                    
                    case "L":
                        if($envelopeArray["L"] > 2 && $envelopeArray["L"] <= 4){
                            echo json_encode(array('envelope' => 'XL'));
                            return 1;
                        }elseif($envelopeArray["L"] > 4){
                            echo json_encode(array('envelope' => 'B'));
                            return 1;
                        }
                    break;
                
                    case "XL":
                        if($envelopeArray["XL"] > 2){
                            echo json_encode(array('envelope' => 'B'));
                            return 1;
                        }
                    break;
                }
            }
        }else{
            //get inventory model id
            $inventory_model_sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$skuArray[0]->skuId."'";
            $this->log("getEnvelopeBySku",$inventory_model_sql."<br>");
            //echo $inventory_model_sql;
            //echo "<br>";
            $inventory_model_result = mysql_query($inventory_model_sql, Service::$database_connect);
            $inventory_model_row = mysql_fetch_assoc($inventory_model_result);
            $inventory_model_id = $inventory_model_row['inventory_model_id'];
            
            if(!empty($inventory_model_id)){
                //get envelope value
                $envelope_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
                on cfs.custom_field_value_id=cfv.custom_field_value_id
                where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$envelope_field_row['custom_field_id']."'";
                $this->log("getEnvelopeBySku",$envelope_value_sql."<br>");
                //echo $envelope_value_sql;
                //echo "<br>";
                $envelope_value_result = mysql_query($envelope_value_sql, Service::$database_connect);
                $envelope_value_row = mysql_fetch_assoc($envelope_value_result);
                $envelope = $envelope_value_row['short_description'];
                
		if(!empty($sku)){
		    return $envelope;
		}
		
                $this->log("getEnvelopeBySku", $skuArray[0]->quantity. " X ". $envelope."<br>");
                
                if($skuArray[0]->quantity <= 2){
                    echo json_encode(array('envelope' => $envelope));
                }else{
                    switch($envelope){
                        case "S":
                            if($skuArray[0]->quantity > 2 && $skuArray[0]->quantity <= 4){
                                echo json_encode(array('envelope' => 'M'));
                            }elseif($skuArray[0]->quantity > 4 && $skuArray[0]->quantity <= 15){
                                echo json_encode(array('envelope' => 'L'));
                            }elseif($skuArray[0]->quantity > 15 && $skuArray[0]->quantity <= 30){
                                echo json_encode(array('envelope' => 'XL'));
                            }elseif($skuArray[0]->quantity > 30){
                                echo json_encode(array('envelope' => 'B'));
                            }
                        break;
                        
                        case "M":
                            if($skuArray[0]->quantity > 2 && $skuArray[0]->quantity <= 4){
                                echo json_encode(array('envelope' => 'L'));
                            }elseif($skuArray[0]->quantity > 4 && $skuArray[0]->quantity <= 6){
                                echo json_encode(array('envelope' => 'XL'));
                            }elseif($skuArray[0]->quantity > 6){
                                echo json_encode(array('envelope' => 'B'));
                            }
                        break;
                        
                        case "L":
                            if($skuArray[0]->quantity > 2 && $skuArray[0]->quantity <= 4){
                                echo json_encode(array('envelope' => 'XL'));
                            }elseif($skuArray[0]->quantity > 4){
                                echo json_encode(array('envelope' => 'B'));
                            }
                        break;
                    
                        case "XL":
                            if($skuArray[0]->quantity > 2){
                                echo json_encode(array('envelope' => 'B'));
                            }
                        break;
                    }
                }
            }else{
                //$this->log("getEnvelopeBySku", $skuArray[0]->skuId. " no in inventory!<br>");
            }
        }
        
        $this->log("getEnvelopeBySku", "<font color='red'><br>****************************************** End  ******************************************<br></font>");
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
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set three_day_flow = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$one_week_ago."' and '".$today."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_1 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
	
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$two_week_ago."' and '".$one_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_2 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
	
	//
	$sql = "select im.inventory_model_code,sum(it.quantity) as week_flow from (inventory_model as im left join inventory_location il on im.inventory_model_id = il.inventory_model_id) 
	left join inventory_transaction as it on il.inventory_location_id = it.inventory_location_id 
	where it.destination_location_id = 3 and it.creation_date between '".$three_week_ago."' and '".$two_week_ago."' group by im.inventory_model_code";
	
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow_3 = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
        //print_r($array);
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  End  +++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function getAllSkus(){
	mysql_query("SET NAMES 'latin1'");
        if(count($_POST) == 0){
            $sql = "select count(*) as count from inventory_model";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $totalCount = $row['count'];
            
            if(empty($_POST['start']) && empty($_POST['limit'])){
                $_POST['start'] = 0;
                $_POST['limit'] = 20;
            }
            
            $sql = "select inventory_model_id,category_id,manufacturer_id,inventory_model_code,short_description,long_description from inventory_model limit ".$_POST['start'].",".$_POST['limit'];
            $result = mysql_query($sql, Service::$database_connect);
            $array = array();
        
        }else{
            $where = " where 1 = 1 ";
		
            if(!empty($_POST['inventory_model_code'])){
                    $where .= " and inventory_model_code like '%".$_POST['inventory_model_code']."%'";
            }
            
            if(!empty($_POST['short_description'])){
                    $where .= " and short_description like '%".$_POST['short_description']."%'";
            }
            
            if(!empty($_POST['long_description'])){
                    $where .= " and long_description like '%".$_POST['long_description']."%'";
            }
            
            if(!empty($_POST['category_id'])){
                    $where .= " and category_id  = '".$_POST['category_id']."'";
            }
            
            if(!empty($_POST['manufacturer_id'])){
                    $where .= " and manufacturer_id = '".$_POST['manufacturer_id']."'";
            }
                
            $sql = "select count(*) as count from inventory_model ".$where;
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $totalCount = $row['count'];
            
            $sql = "select inventory_model_id,category_id,manufacturer_id,inventory_model_code,short_description,long_description from inventory_model ".$where." limit ".$_POST['start'].",".$_POST['limit'];
            //echo $sql;
            $result = mysql_query($sql, Service::$database_connect);
            $array = array();
        }
        
        
        $i = 0;
        while($row = mysql_fetch_assoc($result)){
            $sql_1 = "select short_description from category where category_id = '".$row['category_id']."'";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
            $row_1 = mysql_fetch_assoc($result_1);
            
            
            $sql_2 = "select short_description from manufacturer where manufacturer_id = '".$row['manufacturer_id']."'";
            $result_2 = mysql_query($sql_2, Service::$database_connect);
            $row_2 = mysql_fetch_assoc($result_2);
            
            $array[$i]['inventory_model_code'] = $row['inventory_model_code'];
            $array[$i]['short_description'] = $row['short_description'];
            $array[$i]['long_description'] = $row['long_description'];
            
            $array[$i]['category'] = $row_1['short_description'];
            $array[$i]['manufacturer'] = $row_2['short_description'];
            
            $sql_3 = "select cfv.custom_field_id,cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_qtype_id = 2 and cfs.entity_id = '".$row['inventory_model_id']."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Service::$database_connect);
            while($row_3 = mysql_fetch_assoc($result_3)){
                $sql_4 = "select short_description from custom_field where custom_field_id = '".$row_3['custom_field_id']."'";
                $result_4 = mysql_query($sql_4, Service::$database_connect);
                $row_4 = mysql_fetch_assoc($result_4);
                $array[$i][$row_4['short_description']] = $row_3['short_description'];
            }
            $i++;
        }
        
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
	mysql_free_result($result);
    }
    
    public function getSuppliers(){
	mysql_query("SET NAMES 'latin1'");
        $sql = "select manufacturer_id as id,short_description as name from manufacturer";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        
        echo json_encode($array);
    }
    
    public function getCategories(){
        $sql = "select category_id as id,short_description as name from category where inventory_flag = 1";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        
        echo json_encode($array);
    }
    
    public function getCategoriesTree(){
	$sql = "select category_id,short_description from category where inventory_flag = 1";
	//echo $sql;
	$result = mysql_query($sql, Service::$database_connect);
	$array = array();
	$i = 0;
	while($row = mysql_fetch_assoc($result)){
            $sql_1 = "select count(*) as count from inventory_model where category_id = '".$row['category_id']."'";
	    $result_1 = mysql_query($sql_1, Service::$database_connect);
            $row_1 = mysql_fetch_assoc($result_1);

            $array[$i]['id'] = $row['category_id'];
	    $array[$i]['text'] = $row['short_description'] ." (".$row_1['count'].")";
	    $array[$i]['leaf'] = true;
	    $i++;
	}
	echo json_encode($array);
	mysql_free_result($result);
    }
    
    public function getModelBySkuId(){
        $sql = "select short_description from inventory_model where inventory_model_code = '".$_REQUEST['skuId']."'";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        //json_encode($row);
        echo 'model:'.$row['short_description'];
    }
    
    public function getSkuCost($sku="", $internal=false){
	if(!empty($sku)){
	    $_GET['data'] = $sku;
	}
        //$this->log("getSkuCost", "<font color='red'><br>****************************************** Start  ******************************************<br></font>");
        //get inventory model id
        $sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$_GET['data']."'";
        //$this->log("getSkuCost", $sql."<br>");
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        
        //-------------------------------------------    Cost    -----------------------------------------------
        //get cost field id
        $cost_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['cost']."'";
        //$this->log("getSkuCost", $cost_field_sql."<br>");

        $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
        $cost_field_row = mysql_fetch_assoc($cost_field_result);
        
        
        //get cost value
        $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
        on cfs.custom_field_value_id=cfv.custom_field_value_id
        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
        //$this->log("getSkuCost", $cost_value_sql."<br>");

        $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
        $cost_value_row = mysql_fetch_assoc($cost_value_result);
        $cost = $cost_value_row['short_description'];
        //$this->log("getSkuCost", "Cost: ".$cost."<br><font color='red'>******************************************  End  ******************************************<br></font>");
        if(empty($sku) && $internal == false){
	    echo json_encode(array('skuCost'=>$cost));
	}
	return $cost;
    }
    
    public function getSkuStatus($sku=""){
	global $argv;
	if(!empty($sku)){
	    $_GET['data'] = $sku;
	}elseif(!empty($argv[2])){
	    $_GET['data'] = $argv[2];
	}
	//get inventory model id
        $sql = "select inventory_model_id,short_description from inventory_model where inventory_model_code = '".$_GET['data']."'";
        //echo $sql."\n";
	$result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
	$inventory_model_id = $row['inventory_model_id'];
	
	//get status field
	$status_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['skuStatus']."'";
        $status_field_result = mysql_query($status_field_sql);
        $status_field_row = mysql_fetch_assoc($status_field_result);
        
        
	//get status value
        $status_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
        on cfs.custom_field_value_id=cfv.custom_field_value_id 
        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$status_field_row['custom_field_id']."'";
	//echo $status_value_sql."\n";
	$status_value_result = mysql_query($status_value_sql, Service::$database_connect);
        $status_value_row = mysql_fetch_assoc($status_value_result);
	
	$status = $status_value_row['short_description'];
	
	echo json_encode(array('status'=>$status));
    }
    
    public function getSkuInfo(){
    	$this->log("getSkuInfo", "<font color='red'><br>****************************************** Start  ******************************************<br></font>");
        //get inventory model id
        $sql = "select inventory_model_id,short_description from inventory_model where inventory_model_code = '".$_GET['data']."'";
        $this->log("getSkuInfo", $sql."<br>");
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        $short_description = $row['short_description'];
        //-------------------------------------------    Cost    -----------------------------------------------
        //get cost field id
        $cost_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['cost']."'";
        $this->log("getSkuInfo", $cost_field_sql."<br>");

        $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
        $cost_field_row = mysql_fetch_assoc($cost_field_result);
        
        
        //get cost value
        $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
        on cfs.custom_field_value_id=cfv.custom_field_value_id
        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
        $this->log("getSkuInfo", $cost_value_sql."<br>");
		
        //------------------------------------------- Weight -----------------------------------------
        //get weight field id
        $weight_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['weight']."'";
        $this->log("getSkuInfo", $weight_field_sql."<br>");
                
        $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
        $weight_field_row = mysql_fetch_assoc($weight_field_result);
                
                
        //get weight value
        $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
        on cfs.custom_field_value_id=cfv.custom_field_value_id 
        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
        $this->log("getSkuInfo", $weight_value_sql."<br>");
                
        $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
        $weight_value_row = mysql_fetch_assoc($weight_value_result);
        $weight = (float) $weight_value_row['short_description'];
                
        $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
        $cost_value_row = mysql_fetch_assoc($cost_value_result);
        $cost = $cost_value_row['short_description'];
        
        //----------------------------------------- Stock --------------------------------------------
        $stock_sql = "select sum(quantity) as quantity from inventory_location where inventory_model_id = ".$inventory_model_id." group by inventory_model_id";
        $stock_result = mysql_query($stock_sql, Service::$database_connect);
        $stock_row = mysql_fetch_assoc($stock_result);
        $stock = $stock_row['quantity'];
        
	//-----------------------------------------  Lowest Price  ------------------------------------
	$sku_lowest_price = $this->getSkuLowestPrice($_GET['data'], true);
	
        $this->log("getSkuInfo", "skuTitle: ".$short_description.", skuCost: ".$cost.", skuLowestPrice: ".$sku_lowest_price.", skuWeight: ".$weight.", skuStock: ".$stock."<br><font color='red'>******************************************  End  ******************************************<br></font>");
        echo json_encode(array('skuTitle'=>$short_description, 'skuCost'=>$cost, 'skuLowestPrice'=>$sku_lowest_price, 'skuWeight'=> $weight, 'skuStock'=>$stock));
    }
    
    public function updateSkuDescription(){
        $sql = "select count(*) as num from description where sku = '".$_POST['sku']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        if($row['num'] == 0){
            $sql = "insert into description (sku,english,french,germany) values ('".$_POST['sku']."','".htmlentities($_POST['english'], ENT_QUOTES)."','".htmlentities($_POST['french'], ENT_QUOTES)."','".htmlentities($_POST['germany'], ENT_QUOTES)."')";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                echo json_encode(array("sucess"=> true,  "msg"=>"add description success."));
            }else{
                echo json_encode(array("sucess"=> false, "msg"=>"add description failure."));
            }
        }else{
            $sql = "update description set english = '".htmlentities($_POST['english'], ENT_QUOTES)."',french = '".htmlentities($_POST['french'], ENT_QUOTES)."',germany = '".htmlentities($_POST['germany'], ENT_QUOTES)."' where sku = '".$_POST['sku']."'";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                echo json_encode(array("sucess"=> true,  "msg"=>"update description success."));
            }else{
                echo json_encode(array("sucess"=> false, "msg"=>"update description failure."));
            }
        }
    }
    
    public function updateSuppliers(){
	//print_r($_POST['manufacturer']);
	session_start();
	if(strpos($_POST['suppliers'], ",")){
	    $sql = "delete from sku_suppliers where sku = '".$_POST['sku']."'";
	    $result = mysql_query($sql, Service::$database_connect);
	    foreach(explode(",", $_POST['suppliers']) as $value){
		$sql = "insert into sku_suppliers (sku,suppliers_id,modified_by,modified_date) values ('".$_POST['sku']."', '".$value."','".$_SESSION['intUserAccountId']."',now())";
		echo $sql."\n";
		$result = mysql_query($sql, Service::$database_connect);
		//var_dump($result);
	    }
	}else{
	    $sql = "delete from sku_suppliers where sku = '".$_POST['sku']."'";
	    $result = mysql_query($sql, Service::$database_connect);
	    
	    $sql = "insert into sku_suppliers (sku,suppliers_id,modified_by,modified_date) values ('".$_POST['sku']."', '".$_POST['suppliers']."','".$_SESSION['intUserAccountId']."',now())";
	    echo $sql."\n";
	    $result = mysql_query($sql, Service::$database_connect);
	}
    }
    
    public function getSkuDescription(){
        switch($_GET['site']){
            case "US":
                $languae = "english";
            break;
        
            case "UK":
                $languae = "english";
            break;
        
            case "Australia":
                $languae = "english";
            break;
        
            case "France":
                $languae = "french";
            break;
        
            case "Germany":
                $languae = "germany";
            break;
        }
        $sql = "select ".$languae." from description where sku = '".$_GET['sku']."'";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        echo html_entity_decode($row[$languae], ENT_QUOTES);
    }
    
    public function complaints(){
        $sql = "insert into complaints (sku,content,time) values ('".$_POST['sku']."','".mysql_real_escape_string($_POST['content'])."','".date("Y-m-d H:i:s")."')";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function addSKuCombo(){
        $sql = "insert into combo (sku,attachment,quantity) values ('".$_POST['sku']."','".$_POST['attachment']."','".$_POST['quantity']."') ";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function getSKuComboList(){
        echo '
        <table border=1>
		<tr>
			<th>
				SKU
			</th>
			<th>
				Quantity
			</th>
			<th>
				Stock
			</th>
                        <th>
				Operate
			</th>
		</tr>';
	$sql = "select id,sku,attachment,quantity from combo where sku = '".$_GET['sku']."'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$sku = $row['attachment'];
		$quantity = $row['quantity'];
		
		//get sku model id
		$sql_1 = "select inventory_model_id from inventory_model where inventory_model_code='".$row['attachment']."'";
		//echo $sql;
		//echo "<br>";
		$result_1 = mysql_query($sql_1);
		$row_1 = mysql_fetch_assoc($result_1);
		$inventory_model_id = $row_1['inventory_model_id'];
		
		//get sku location
		$sql_2 = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
		//echo $sql;
		//echo "<br>";
		$result_2 = mysql_query($sql_2);
		$row_2 = mysql_fetch_assoc($result_2);
		$stock = $row_2['quantity'];
		echo "<tr>";
		echo "<td>".$sku."</td>";
		echo "<td>".$quantity."</td>";
		echo "<td>".$stock."</td>";
                echo "<td><input type='button' value='Delete' onClick='deleteSkuCombo(".$row['id'].")'/></td>";
		echo "</tr>";
	}
	echo '</table>';
    }
    
    public function deleteSkuCombo(){
        $sql = "delete from combo where id = '".$_POST['id']."'";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    private function getUserName($user_account_id){
	$sql = "select username from user_account where user_account_id = ".$user_account_id;
	$result = mysql_query($sql, Service::$database_connect);
	$row = mysql_fetch_assoc($result);
	return $row['username'];
    }
    
    public function addSKuPurchase(){
	if(empty($_POST['by'])){
	    $_POST['by'] = $this->getUserName($_POST['byId']);
	}
	$now = date('Y-m-d H:i:s');
	$sql = "insert into sku_purchase (sku,quantity,price,suppliers_id,remark,created_by,creation_date,modified_by,modified_date,status) values ('".$_POST['sku']."','".$_POST['quantity']."','".$_POST['price']."','".$_POST['suppliers_id']."','".$_POST['remark']."','".$_POST['by']."','".$now."','".$_POST['by']."','".$now."',0)";
        //echo $sql;
        $result = mysql_query($sql, Service::$database_connect);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function getSKuPurchaseList(){
	echo '<table border=1>
			<tr>
				<th>
					Quantity
				</th>
				<th>
					Date Created
				</th>
				<th>
					Date Modified
				</th>
				<th>
					Status
				</th>
				<th>
					Remark
				</th>
				<th>
					Operate
				</th>
			</tr>';
				$sql = "select * from sku_purchase where sku = '".$_GET['sku']."' order by id desc";
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result)){
					switch($row['status']){
						case 0:
							$status = "Processing";
							$operate = "<input type='button' value='Storing To Warehouse' onClick='skuPurchaseStoring(".$row['id'].")'/> | <input type='button' value='Cancel' onClick='skuPurchaseCancel(".$row['id'].")'/>";
						break;
					
						case 1:
							$status = "In Warehouse";
							$operate = "";
						break;
					
						case 2:
							$status = "Cancel";
							$operate = "";
						break;
					}
					
					echo "<tr>";
					echo "<td>".$row['quantity']."</td>";
					echo "<td>".$row['created_by'].' by '.$row['creation_date']."</td>";
					echo "<td>".$row['modified_by'].' by '.$row['modified_date']."</td>";
					echo "<td>".$status."</td>";
					echo "<td>".$row['remark']."</td>";
					echo "<td>".$operate."</td>";
					echo "</tr>";
				}
	echo '</table>';
    }
    
    public function getPurchaseList(){
	mysql_query("SET NAMES 'latin1'");
	$sql_4 = "select id,name from suppliers";
	$result_4 = mysql_query($sql_4);
	while($row_4 = mysql_fetch_assoc($result_4)){
	    $suppliers[$row_4['id']] = $row_4['name'];
	}

	echo '<table border=1>
		<tr>
			<th>
				SKU
			</th>
			<th>
				Price
                        </th>
			<th>
				Quantity
			</th>
			<th>
				Suppliers
			</th>
			<th>
				Date Created
			</th>
			<th>
				Date Modified
			</th>
			<th>
				Status
			</th>
			<th>
				Remark
			</th>
			<th>
				Operate
			</th>
		</tr>';
	mysql_query("SET NAMES 'UTF8'");
	$sql = "select * from sku_purchase where status = 0 order by sku,modified_date desc";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		switch($row['status']){
			case 0:
				$status = "Processing";
				$operate = "<input type='button' value='Storing To Warehouse' onClick='skuPurchaseStoring(".$row['id'].")'/> <br> <input type='button' value='Cancel' onClick='skuPurchaseCancel(".$row['id'].")'/>";
			break;
		
			case 1:
				$status = "In Warehouse";
				$operate = "";
			break;
		
			case 2:
				$status = "Cancel";
				$operate = "";
			break;
		}
		
		echo "<tr>";
		echo "<td>".$row['sku']."</td>";
		echo "<td>".$row['price']."</td>";
		echo "<td>".$row['quantity']."</td>";
		echo "<td>".$suppliers[$row['suppliers_id']]."</td>";
		echo "<td>".$row['created_by'].' by '.$row['creation_date']."</td>";
		echo "<td>".$row['modified_by'].' by '.$row['modified_date']."</td>";
		echo "<td>".$status."</td>";
		echo "<td>".$row['remark']."</td>";
		echo "<td>".$operate."</td>";
		echo "</tr>";
	}
	echo '</table>';
    }
    
    public function skuPurchaseStoring(){
	if(empty($_POST['byName'])){
	    $_POST['byName'] = $this->getUserName($_POST['byId']);
	}
	$created_by = $_POST['byId'];
	$sql = "select sku,quantity,remark from sku_purchase where id = ".$_POST['id'];
	$result = mysql_query($sql, Service::$database_connect);
	$row = mysql_fetch_assoc($result);
	$quantity = $row['quantity'];
	$note = $row['remark'];
	
	$sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$row['sku']."'";
	$result = mysql_query($sql, Service::$database_connect);
	$row = mysql_fetch_assoc($result);
	$inventory_model_id = $row['inventory_model_id'];
	
	$sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
        $this->log("skuPurchaseStoring", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        $inventory_location_id = $row['inventory_location_id'];
        
	if(empty($source_location_id)){
	    $sql = "insert into inventory_location (inventory_model_id,location_id,quantity,created_by,creation_date) 
	    values ('".$inventory_model_id."','6','0','".$created_by."','".date("Y-m-d H:i:s")."')";
	    $this->log("skuPurchaseStoring", $sql."<br>");
	    $result = mysql_query($sql, Service::$database_connect);
	    $inventory_location_id = mysql_insert_id(Service::$database_connect);
	    $source_location_id = 6;
	}
	
        if(!empty($source_location_id)){
	    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','4','".$note."','".$created_by."','".date("Y-m-d H:i:s")."')";
            $this->log("skuPurchaseStoring", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $transaction_id = mysql_insert_id(Service::$database_connect);
	    
	    //sku purchase storing
            $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
            values ('".$inventory_location_id."','".$transaction_id."','".$quantity."',4,'".$source_location_id."','".$created_by."','".date("Y-m-d H:i:s")."')";
            $this->log("skuPurchaseStoring", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                //sku update stock quantity
                $sql = "update inventory_location set quantity = quantity + ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
                $this->log("skuPurchaseStoring", $sql."<br>");
                //echo $sql;
                //echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                
                $sql = "update inventory_model set modified_by = '".$created_by."',modified_date = '".date("Y-m-d H:i:s")."' where inventory_model_id = '".$inventory_model_id."'";
                $this->log("skuPurchaseStoring", $sql."<br>");
                $result = mysql_query($sql, Service::$database_connect);
                $this->log("skuPurchaseStoring", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
                flush();
		/*
                $this->sendMessageToAM("/topic/SkuInToLibrary",
                        array("sku"=> $inventory_model,
                              "quantity"=> $quantity,
                              "shipment_id"=> $shipment_id,
                              "shipment_method"=> $shipment_method));
		*/
		$sql = "update sku_purchase set status = 1,modified_by='".$_POST['byName']."',modified_date='".date("Y-m-d H:i:s")."' where id = '".$_POST['id']."'";
		$result = mysql_query($sql);
		if($result){
		    echo 1;
		}else{
		    echo 0;
		}
            }
	}
    }
    
    public function skuPurchaseCancel(){
	if(empty($_POST['by'])){
	    $_POST['by'] = $this->getUserName($_POST['byId']);
	}
	$sql = "update sku_purchase set status = 2,modified_by='".$_POST['by']."',modified_date='".date("Y-m-d H:i:s")."' where id = '".$_POST['id']."'";
	$result = mysql_query($sql);
	if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function getSkuStatusGrid(){
    	//get status field id
        $status_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['skuStatus']."'";
        $status_field_result = mysql_query($status_field_sql);
        $status_field_row = mysql_fetch_assoc($status_field_result);
        
        $status_array_1 = array();
        $status_array_2 = array();
        $status_string = "";
        $sql_1 = "select custom_field_value_id,short_description from custom_field_value where custom_field_id = ".$status_field_row['custom_field_id'];
        $result_1 = mysql_query($sql_1);
        while($row_1 = mysql_fetch_assoc($result_1)){
        	$status_array_1[$row_1['custom_field_value_id']] = $row_1['short_description'];
        	$status_array_2[$row_1['short_description']] = $row_1['custom_field_value_id'];
        	$status_string .= $row_1['custom_field_value_id'].",";
        }
        $status_string = substr($status_string, 0, -1);
        
        $sku_where = "";
        if(!empty($_POST['sku'])){
        	$sku_where = " and im.inventory_model_code like '".$_POST['sku']."%'";
        }
        
    	$sql = "select count(*) as totalCount from 
		inventory_model as im left join custom_field_selection as cfs on im.inventory_model_id = cfs.entity_id 
		where cfs.custom_field_value_id = ".$status_array_2[$_POST['status']].$sku_where;
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$totalCount = $row['totalCount'];
		
		$array = array();
		$sql = "select inventory_model_id,inventory_model_code,short_description from 
		inventory_model as im left join custom_field_selection as cfs on im.inventory_model_id = cfs.entity_id 
		where cfs.custom_field_value_id = ".$status_array_2[$_POST['status']]." ".$sku_where." limit ".$_POST['start'].",".$_POST['limit'];
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$array[] = $row;
		}
		echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
		mysql_free_result($result);
    }
    
    public function getSkuStatusCount(){
    	//get status field id
        $status_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['skuStatus']."'";
        $status_field_result = mysql_query($status_field_sql);
        $status_field_row = mysql_fetch_assoc($status_field_result);
        
        $status_array_1 = array();
        $status_array_2 = array();
        $status_string = "";
        $sql_1 = "select custom_field_value_id,short_description from custom_field_value where custom_field_id = ".$status_field_row['custom_field_id'];
        $result_1 = mysql_query($sql_1);
        while($row_1 = mysql_fetch_assoc($result_1)){
        	$status_array_1[$row_1['custom_field_value_id']] = $row_1['short_description'];
        	$status_array_2[$row_1['short_description']] = $row_1['custom_field_value_id'];
        	$status_string .= $row_1['custom_field_value_id'].",";
        }
        $status_string = substr($status_string, 0, -1);
        
    	$sql = "select custom_field_value_id,count(*) as total from custom_field_selection where entity_qtype_id = 2 and custom_field_value_id in (".$status_string.") group by custom_field_value_id";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$row['status'] = str_replace(" ","-", $status_array_1[$row['custom_field_value_id']]);
			unset($row['custom_field_value_id']);
			$array[] = $row;
		}
		echo json_encode($array);
		mysql_free_result($result);
    }
    
    public function changeStatus(){
    	//get status field id
        $status_field_sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['skuStatus']."'";
        $status_field_result = mysql_query($status_field_sql);
        $status_field_row = mysql_fetch_assoc($status_field_result);
        
        $status_array_1 = array();
        $status_array_2 = array();
        $status_string = "";
        $sql_1 = "select custom_field_value_id,short_description from custom_field_value where custom_field_id = ".$status_field_row['custom_field_id'];
        $result_1 = mysql_query($sql_1);
        while($row_1 = mysql_fetch_assoc($result_1)){
        	$status_array_1[$row_1['custom_field_value_id']] = $row_1['short_description'];
        	$status_array_2[$row_1['short_description']] = $row_1['custom_field_value_id'];
        	$status_string .= $row_1['custom_field_value_id'].",";
        }
        $status_string = substr($status_string, 0, -1);
        
    	if($_POST['status'] == "inactive" || $_POST['status'] == "under review"){
            $this->sendMessageToAM("/queue/SkuStatus",
                        array("skus"=> $_POST['skus'],
                              "status"=> $_POST['status']));
        }
        
        if(strpos($_POST['ids'], ",") != false){
            $id_array = explode(",", $_POST['ids']);
            foreach($id_array as $id){
                $sql = "update custom_field_selection set custom_field_value_id = ".$status_array_2[$_POST['status']]." where entity_qtype_id = 2 and custom_field_value_id in (".$status_string.") and entity_id = ".$id;
                $result = mysql_query($sql);
                echo $sql."\n";
            }
        }else{
            $id = $_POST['ids'];
            $sql = "update custom_field_selection set custom_field_value_id = ".$status_array_2[$_POST['status']]." where entity_qtype_id = 2 and custom_field_value_id in (".$status_string.") and entity_id = ".$id;
            $result = mysql_query($sql);
            echo $sql."\n";
        }
    }
    
    public function dealSkuStockMessage(){
    	//ini_set('include_path', '../');
        require_once 'Stomp.php';
        require_once 'Stomp/Message/Map.php';
        
        $consumer = new Stomp(Service::$active_mq);
        $consumer->clientId = "inventory";
        $consumer->connect();
        $consumer->subscribe("/topic/SkuOutStock", array('transformation' => 'jms-map-json'));
        while(1){
            $msg = $consumer->readFrame();
            if ( $msg != null) {
                //echo "Message '$msg->body' received from queue\n";
                //print_r($msg->map);
                //$this->inventoryTakeOut($msg->map['inventory_model'], $msg->map['quantity'], $msg->map['shipment_id'], $msg->map['shipment_method']);
                $consumer->ack($msg);
            }
            sleep(1);
        }
    }
    
    public function updateSkuStatusFromCsv(){
	$row = 1;
	if (($handle = fopen("Inactive.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		echo $data[0] . "\n";
		$sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$data[0]."'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		
		$status = 5919;
		$sql = "update custom_field_selection set custom_field_value_id = ".$status." where entity_qtype_id = 2 and custom_field_value_id in (5915,5916,5917,5918,5919,5920) and entity_id = ".$row['inventory_model_id'];
		echo $sql."\n";
		$result = mysql_query($sql);
	    }
	    fclose($handle);
	}
    }
    
    public function updateSkuStatusFromTxt(){
	/*
	 Array ( 
	 5915] => new
	 [5916] => waiting for approve
	 [5917] => under review
	 [5918] => active
	 [5919] => inactive
	 [5920] => out of stock
	 )
	 
	 Array ( [new] => 5915
	 [waiting for approve] => 5916
	 [under review] => 5917
	 [active] => 5918
	 [inactive] => 5919
	 [out of stock] => 5920
	 ) 
	*/
	$content = file_get_contents("temp.txt");
	$ids = explode("\n", $content);
	$sku = "";
	foreach($ids as $id){
	    $sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$id."'";
	    $result = mysql_query($sql);
	    $row = mysql_fetch_assoc($result);
	    $sku .= "'".$id."',";
	    
	    $status = 5919;
	    $sql = "update custom_field_selection set custom_field_value_id = ".$status." where entity_qtype_id = 2 and custom_field_value_id in (5915,5916,5917,5918,5919,5920) and entity_id = ".$row['inventory_model_id'];
	    echo $sql."\n";
	    $result = mysql_query($sql);
	  
	}
	$sku = substr($sku, 0, -1);
	file_put_contents("temp1.txt", $sku);
    }
    
    public function generatePurchaseOrder(){
	//get stock day
        $sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['stockDays']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $stock_day_field_id = $row['custom_field_id'];
	
	//get lower limit
	$sql = "select custom_field_id from custom_field where short_description = '".Service::$field_array['MOQ']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $moq_field_id = $row['custom_field_id'];
	
	$manufacture = array();
        $sql_4 = "select manufacturer_id,short_description from manufacturer";
        $result_4 = mysql_query($sql_4, Service::$database_connect);
        while($row_4 = mysql_fetch_assoc($result_4)){
            $manufacture[$row_4['manufacturer_id']] = $row_4['short_description'];
        }
	
	$sql_1 = "select inventory_model_id,manufacturer_id,inventory_model_code,short_description,long_description,three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model";
	$data = "SKU,英文名称,中文名称,最低起订数,建议采购数,(目前库存量-安全库存量)差值,目前库存量,最低（安全）库存量,备货天数,前三天销售数量,上周销售数量,上上周销售数量,上上上周销售数量";
	while($row_1 = mysql_fetch_assoc($result_1)){
            //$array[$i]['inventory_model_id'] = $row_1['inventory_model_id'];
            //$array[$i]['inventory_model_code'] = $row_1['inventory_model_code'];
            //$array[$i]['short_description'] = $row_1['short_description'];
            //$array[$i]['week_flow'] = $row_1['week_flow'];
            
            $sql_2 = "select sum(quantity) as quantity from inventory_location where inventory_model_id = '".$row_1['inventory_model_id']."'";
            //echo $sql_2;
            //echo "<br>";
            $result_2 = mysql_query($sql_2, Service::$database_connect);
            $row_2 = mysql_fetch_assoc($result_2);
            //$array[$i]['quantity'] = $row_2['quantity'];
	    
	    $sql_3 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$stock_day_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_3 = mysql_query($sql_3, Service::$database_connect);
            $row_3 = mysql_fetch_assoc($result_3);
	    
	    $sql_4 = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id = cfv.custom_field_value_id where cfs.entity_id = '".$row_1['inventory_model_id']."' and cfs.entity_qtype_id = '2' and cfv.custom_field_id = '".$moq_field_id."'";
            //echo $sql_3;
            //echo "<br>";
            $result_4 = mysql_query($sql_4, Service::$database_connect);
            $row_4 = mysql_fetch_assoc($result_4);
	    
	    $safe_stock = $row_3['short_description'] * (($row_1['three_day_flow'] / 3) * 0.3 + ($row_1['week_flow_1'] / 7) * 0.3 + ($row_1['week_flow_2'] / 7) * 0.2 + ($row_1['week_flow_3'] / 7) * 0.2);
	    $virtual_stock = $row_2['quantity'] - $safe_stock;
	    
	    if($virtual_stock > 0){
		if($row_4['short_description'] > 0){
		    if($row_4['short_description'] > $virtual_stock * -1){
			$purchase = $row_4['short_description'];
		    }else{
			$purchase = $virtual_stock * -1;
		    }
		}else{
		    $purchase = $virtual_stock * -1;
		}
		
		$flow = ($row_1['week_flow_1'] * 0.5 + $row_1['week_flow_2'] * 0.3 + $row_1['week_flow_3'] * 0.2 / 3) / 7;
		if($row_2['quantity'] < $flow * $row_3['short_description']){
		    $data .= $row_1['inventory_model_code'].",".$row_1['short_description'].",".$row_1['long_description'].",".$purchase.",".
		    $virtual_stock.",".$row_2['quantity'].",".$safe_stock.",".$row_3['short_description'].",".
		    $row_1['three_day_flow'].",".$row_1['week_flow_1'].",".$row_1['week_flow_2'].",".$row_1['week_flow_3'];
		}
	    }
	}
	
	file_put_contents(Service::PO_PATH."/".date("Y-m-d"), $data, FILE_APPEND);
    }
    
    public function caclCost(){
	//echo "3.68 * ".$_GET['price']." - 79.65 * ".$_GET['weight']." - 4.07";
	echo 3.95 * $_GET['price'] - 81.8 * $_GET['weight'] - 4.2;
    }
    
    public function __destruct(){
        mysql_close(Service::$database_connect);
    }
    
    
}
    
$service = new Service();
if(!empty($argv[1])){
    $action = $argv[1];
}else{
    $action = (!empty($_GET['action']))?$_GET['action']:$_POST['action'];
}

$service->$action();
//http://127.0.0.1:6666/tracmor/service.php?action=inventoryTakeOut&inventory_model=a008&quantity=10&note=test&shipment_method=B
//http://127.0.0.1:6666/tracmor/service.php?action=syncAppertainStock
//http://127.0.0.1:6666/tracmor/service.php?action=importCsv&file_name=
?>