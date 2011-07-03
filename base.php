<?php
define ('__DOCROOT__', '/export/inventory');
set_include_path(get_include_path() . PATH_SEPARATOR . __DOCROOT__);

class Base{
    protected $conn;
    public $conf;
    public $log = true;
    
    public function __construct(){
        $this->conf = parse_ini_file('config.ini', true);
        $this->conn = mysql_connect($this->conf['database']['host'], $this->conf['database']['user'], $this->conf['database']['password']);

        if (!$this->conn) {
            echo "Unable to connect to DB: " . mysql_error();
            exit;
        }
          
        if (!mysql_select_db($this->conf['database']['name'], $this->conn)) {
            echo "Unable to select mydbname: " . mysql_error();
            exit;
        }
        
        //mysql_query("SET NAMES 'UTF8'", $conn);
    }
      
    protected function getCurrentUserName(){
	session_start();
	if(!empty($_SESSION['intUserAccountId'])){
	    $sql = "select username from user_account where user_account_id = '".$_SESSION['intUserAccountId']."'";
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    return $row['username'];
	}else{
	    return "";
	}
    }
    
    protected function log($file_name, $data){
	/*
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
	    $x = "\\";
	}else{
	    $x = "/";
	}
	*/
	
	if($this->log){
	    //echo $file_name.": ".$data."\n";
	    if(!file_exists($this->conf['path']['log'].DIRECTORY_SEPARATOR.$file_name)){
		mkdir($this->conf['path']['log'].DIRECTORY_SEPARATOR.$file_name, 0777);
	    }
	    file_put_contents($this->conf['path']['log'].DIRECTORY_SEPARATOR.$file_name.DIRECTORY_SEPARATOR.date("Ymd").".html", $data, FILE_APPEND);
	}
    }
    
    protected function getPurchaseOrdersId($type){
        $date = date("Ymd");
        $sql_1 = "LOCK TABLES queue";
        mysql_query($sql_1, $this->conn);
        
        $sql_2 = "select type,id from queue where date = '".$date."' and type = '".$type."'";
        $result_2 = mysql_query($sql_2, $this->conn);
        $row_2 = mysql_fetch_assoc($result_2);
        if(empty($row_2['id'])){
            $sql_3 = "insert into queue (date,type,id) values ('".$date."','".$type."','1')";
            $result_3 = mysql_query($sql_3, $this->conn);
        }else{
            $sql_3 = "update queue set id = id + 1 where date = '".$date."' and type = '".$type."'";
            $result_3 = mysql_query($sql_3, $this->conn);
        }
        
        $sql_4 = "select * from queue where date = '".$date."' and type = '".$type."'";
        $result_4 = mysql_query($sql_4, $this->conn);
        $row_4 = mysql_fetch_assoc($result_4);
        
        $sql_5 = "UNLOCK TABLES";
        mysql_query($sql_5, $this->conn);
        
        return $row_4['type'].$row_4['date'].substr("0000", 0, 4 - strlen($row_4['id'])).$row_4['id'];
    }
    
    protected function getGoInventoryOrdersId(){
	$type = "GIO";
	$date = date("Ymd");
        //$sql_1 = "LOCK TABLES queue";
        //mysql_query($sql_1, $this->conn);
        
        $sql_2 = "select type,id from queue where date = '".$date."' and type = '".$type."'";
        $result_2 = mysql_query($sql_2, $this->conn);
        $row_2 = mysql_fetch_assoc($result_2);
        if(empty($row_2['id'])){
            $sql_3 = "insert into queue (date,type,id) values ('".$date."','".$type."','1')";
            $result_3 = mysql_query($sql_3, $this->conn);
        }else{
            $sql_3 = "update queue set id = id + 1 where date = '".$date."' and type = '".$type."'";
            $result_3 = mysql_query($sql_3, $this->conn);
        }
        
        $sql_4 = "select * from queue where date = '".$date."' and type = '".$type."'";
        $result_4 = mysql_query($sql_4, $this->conn);
        $row_4 = mysql_fetch_assoc($result_4);
        
        //$sql_5 = "UNLOCK TABLES";
	//mysql_query($sql_5, $this->conn);
        
        return $row_4['type'].$row_4['date'].substr("0000", 0, 4 - strlen($row_4['id'])).$row_4['id'];
    }
    
    protected function _C($table, $array){
	$fields = "";
	$values = "";
	
	foreach($array as $key=>$value){
	    $fields .= $key.",";
	    $values .= "'".mysql_real_escape_string($value)."',";
	}
	$fields = substr($fields, 0, -1);
	$values = substr($values, 0, -1);
	
	$sql = "insert into ".$table." (".$fields.") values (".$values.")";
	//echo $sql."\n";
	$result = mysql_query($sql, $this->conn);
	return $result;
    }
    
    protected function get($url, $action, $params = ''){
	$p = "";
	if(!empty($params)){
	    foreach($params as $key=>$value){
		$p .= "&".$key."=".urlencode($value);
	    }
	}
        $ch = curl_init($url.'?action='.$action.$p);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
	return $result;
    }
    
    protected function post($url, $action, $params){
        $p = "";
        foreach($params as $key=>$value){
            $p .= $key."=".urlencode($value)."&";
        }
        $p = substr($p, 0, -1);
        
        $ch = curl_init($url."?action=".$action);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
	return $result;
    }
    
    public function getCustomFieldId($field_name){
	$field_sql = "select custom_field_id from custom_field where short_description = '".$field_name."'";
        //echo $field_sql."\n";
	$field_result = mysql_query($field_sql, $this->conn);
        $field_row = mysql_fetch_assoc($field_result);
        $field_id = $field_row['custom_field_id'];
	return $field_id;
    }
    
    public function getCustomFieldValue($entity_id, $field_name, $entity_qtype_id = 2){
	$field_id = $this->getCustomFieldId($field_name);
	
	$value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id
	where cfs.entity_qtype_id='".$entity_qtype_id."' and cfs.entity_id='".$entity_id."' and cfv.custom_field_id = '".$field_id."'";
	//echo $value_sql."\n";
	$value_result = mysql_query($value_sql, $this->conn);
	$value_row = mysql_fetch_assoc($value_result);
	return $value_row['short_description'];
    }
    
    public function getCustomFieldValueBySku($sku, $field_name, $entity_qtype_id = 2){
	$sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	$inventory_model_id = $row['inventory_model_id'];
	
	return $this->getCustomFieldValue($inventory_model_id, $field_name, $entity_qtype_id);
    }
    
    public function updateCustomFieldValue($entity_id, $field_name, $field_value, $operate = "", $entity_qtype_id = 2){
	$this->log("updateCustomFieldValue", "<br>-----------------------------------".date("Y-m-d H:i:s")."----------------------------------<br>");
	
	$field_sql = "select custom_field_id,custom_field_qtype_id from custom_field where short_description = '".$field_name."'";
        $field_result = mysql_query($field_sql, $this->conn);
        $field_row = mysql_fetch_assoc($field_result);
        $field_id = $field_row['custom_field_id'];
	$field_qtype_id = $field_row['custom_field_qtype_id'];
	
	$sql_1 = "select count(*) as num from custom_field_selection as cfs left join custom_field_value as cfv 
	on cfs.custom_field_value_id=cfv.custom_field_value_id 
	where cfs.entity_qtype_id='".$entity_qtype_id."' and cfs.entity_id='".$entity_id."' and cfv.custom_field_id = '".$field_id."'";
	$result_1 = mysql_query($sql_1, $this->conn);
	$row_1 = mysql_fetch_assoc($result_1);
	$this->log("updateCustomFieldValue", $sql_1."<br>");
	
	$this->log("updateCustomFieldValue", print_r($row_1, true));
	
	if($row_1['num'] == 0){
	    //select
	    if($this->conf['customFieldQtype']['select'] == $field_qtype_id){
		$sql_2 = "select custom_field_value_id from custom_field_value where custom_field_id = '".$field_id."' and short_description = '".$field_value."'";
		$result_2 = mysql_query($sql_2, $this->conn);
		$row_2 = mysql_fetch_assoc($result_2);
		$this->log("updateCustomFieldValue", $sql_2."<br>");
		
		$sql_3 = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) 
		values ('".$row_2['custom_field_value_id']."','".$entity_qtype_id."','".$entity_id."')";
		$result_3 = mysql_query($sql_3, $this->conn);
		$this->log("updateCustomFieldValue", $sql_3."<br>");
	    }else{
		$sql_2 = "insert into custom_field_value (custom_field_id,short_description,created_by,creation_date) values  
		(".$field_id.",'".$field_value."',1,now())";
		$result_2 = mysql_query($sql_2, $this->conn);
		$custom_field_value_id = mysql_insert_id($this->conn);
		$this->log("updateCustomFieldValue", $sql_2."<br>");
		
		$sql_3 = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values 
		(".$custom_field_value_id.",".$entity_qtype_id.",".$entity_id.")";
		$result_3 = mysql_query($sql_3, $this->conn);
		$this->log("updateCustomFieldValue", $sql_3."<br>");
	    }
	}else{
	    //select
	    if($this->conf['customFieldQtype']['select'] == $field_qtype_id){
		$sql_2 = "select custom_field_value_id from custom_field_value where custom_field_id = '".$field_id."' and short_description = '".$field_value."'";
		$result_2 = mysql_query($sql_2, $this->conn);
		$row_2 = mysql_fetch_assoc($result_2);
		$this->log("updateCustomFieldValue", $sql_2."<br>");
		/*
		$sql_3 = "update custom_field_selection set custom_field_value_id = '".$row_2['custom_field_value_id']."'
		where entity_id = '".$entity_id."' and entity_qtype_id= '".$entity_qtype_id."'";
		$result_3 = mysql_query($sql_3, $this->conn);
		$this->log("updateCustomFieldValue", $sql_3."<br>");
		*/
		$sql_3 = "update custom_field_selection as cfs left join custom_field_value as cfv on cfs.custom_field_value_id=cfv.custom_field_value_id
		set cfs.custom_field_value_id = '".$row_2['custom_field_value_id']."' 
		where cfs.entity_qtype_id= '".$entity_qtype_id."' and cfs.entity_id = '".$entity_id."' and cfv.custom_field_id = '".$field_id."'";
		$result_3 = mysql_query($sql_3, $this->conn);
		$this->log("updateCustomFieldValue", $sql_3."<br>");
	    }else{
		if(!empty($operate)){
		    $sql_2 = "update custom_field_selection as cfs left join custom_field_value as cfv 
		    on cfs.custom_field_value_id=cfv.custom_field_value_id set cfv.short_description = cfv.short_description ".$operate." ".$field_value." 
		    where cfs.entity_qtype_id='".$entity_qtype_id."' and cfs.entity_id='".$entity_id."' and cfv.custom_field_id = '".$field_id."'";
		    $result_2 = mysql_query($sql_2, $this->conn);
		    $this->log("updateCustomFieldValue", $sql_2."<br>");
		}else{
		    $sql_2 = "update custom_field_selection as cfs left join custom_field_value as cfv 
		    on cfs.custom_field_value_id=cfv.custom_field_value_id set cfv.short_description = '".$field_value."' 
		    where cfs.entity_qtype_id='".$entity_qtype_id."' and cfs.entity_id='".$entity_id."' and cfv.custom_field_id = '".$field_id."'";
		    $result_2 = mysql_query($sql_2, $this->conn);
		    $this->log("updateCustomFieldValue", $sql_2."<br>");
		}
	    }
	}
    }
    
    public function updateCustomFieldValueBySku($sku, $field_name, $field_value, $operate = "", $entity_qtype_id = 2){
	$sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	$inventory_model_id = $row['inventory_model_id'];
	
	$this->updateCustomFieldValue($inventory_model_id, $field_name, $field_value, $operate, $entity_qtype_id);
    }
    
    public function sendMessageToAM($destination, $message){
        require_once 'Stomp.php';
        require_once 'Stomp/Message/Map.php';
        
        $con = new Stomp($this->conf['service']['activeMq']);
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
    
    public function dealSkuStockMessage(){
        require_once 'Stomp.php';
        require_once 'Stomp/Message/Map.php';
        
        $consumer = new Stomp($this->conf['service']['activeMq']);
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
    
    public function getStock($inventory_model_id="", $sku="", $warehouse_id=6){
	if(!empty($sku)){
	    $sql_1 = "select inventory_model_id from inventory_model where inventory_model_code = '".$sku."'";
	    $result_1 = mysql_query($sql_1, $this->conn);
	    $row_1 = mysql_fetch_assoc($result_1);
	    $inventory_model_id = $row_1['inventory_model_id'];
	}
	
	$sql_2 = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."' and location_id = '".$warehouse_id."'";
	$result_2 = mysql_query($sql_2, $this->conn);
	$row_2 = mysql_fetch_assoc($result_2);
	return $row_2['quantity'];
    }
    
    public function updateStock($inventory_model_id="", $quantity="", $operate="", $note="", $user_id="", $warehouse_id=6){
	session_start();
	if(empty($inventory_model_id) && empty($quantity) && empty($operate)){
	    $inventory_model_id = $_POST['inventory_model_id'];
	    $quantity = $_POST['quantity'];
	    $operate = $_POST['operate'];
	}
	
	if(empty($user_id)){
	    $user_id = $_SESSION['intUserAccountId'];
	}
	
	$sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
        $this->log("updateStock", $sql."<br>");
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        $inventory_location_id = $row['inventory_location_id'];
	
	if(empty($source_location_id)){
	    $source_location_id = $warehouse_id;
	    $sql = "insert into inventory_location (inventory_model_id,location_id,quantity,created_by,creation_date) 
	    values ('".$inventory_model_id."','".$source_location_id."','0','".$user_id."','".date("Y-m-d H:i:s")."')";
	    $this->log("updateStock", $sql."<br>");
	    $result = mysql_query($sql, $this->conn);
	    $inventory_location_id = mysql_insert_id($this->conn);
	}
	
	if($operate == "+"){
	    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','4','".$note."','".$user_id."','".date("Y-m-d H:i:s")."')";
	    $this->log("updateStock", $sql."<br>");
	    $result_1 = mysql_query($sql, $this->conn);
	    $transaction_id = mysql_insert_id($this->conn);
	
	    $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
	    values ('".$inventory_location_id."','".$transaction_id."','".$quantity."',4,'".$source_location_id."','".$user_id."','".date("Y-m-d H:i:s")."')";
	    $this->log("updateStock", $sql."<br>");
	    $result_2 = mysql_query($sql, $this->conn);
	}elseif($operate == "-"){
	    $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','".$note."','".$user_id."','".date("Y-m-d H:i:s")."')";
	    $this->log("updateStock", $sql."<br>");
	    $result_1 = mysql_query($sql, $this->conn);
	    $transaction_id = mysql_insert_id($this->conn);
	
	    $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date) 
	    values ('".$inventory_location_id."','".$transaction_id."','".$quantity."','".$source_location_id."',5,'".$user_id."','".date("Y-m-d H:i:s")."')";
	    $this->log("updateStock", $sql."<br>");
	    $result_2 = mysql_query($sql, $this->conn);
	}
	
	if($result_1 && $result_2){
	    $sql = "update inventory_location set quantity = quantity ".$operate." ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
	    $this->log("updateStock", $sql."<br>");
	    $result = mysql_query($sql, $this->conn);
	    
	    $this->updateVirtualStock($inventory_model_id, $quantity, $operate);
	    /*
	    $sql = "update inventory_model set modified_by = '".$created_by."',modified_date = '".date("Y-m-d H:i:s")."' where inventory_model_id = '".$inventory_model_id."'";
	    $this->log("skuPurchaseStoring", $sql."<br>");
	    $result = mysql_query($sql, $this->conn);
	    $this->log("skuPurchaseStoring", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
	    */
	    $sql = "select inventory_model_code from inventory_model where inventory_model_id = ".$inventory_model_id;
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    
	    $this->sendMessageToAM($this->conf['topic']['skuStock'],
		    array("sku"=> $row['inventory_model_code'],
			  "stock"=> $this->getStock($inventory_model_id),
			  "operate"=> $operate,
			  "quantity"=> $quantity
			  ));

	    if($result){
		return true;
	    }else{
		return false;
	    }
	}else{
	    return false;
	}
    }
    
    public function getVirtualStock($inventory_model_id="", $sku=""){
	if(!empty($sku)){
	    return $this->getCustomFieldValueBySku($sku, $this->conf['fieldArray']['virtualStock']);
	}
	return $this->getCustomFieldValue($inventory_model_id, $this->conf['fieldArray']['virtualStock']);
    }
    
    public function updateVirtualStock($inventory_model_id="", $virtualStock="", $operate = ""){
    	if(empty($inventory_model_id) && empty($virtualStock) && empty($operate)){
    		$inventory_model_id = $_POST['inventory_model_id'];
    		$virtualStock = $_POST['virtualStock'];
    		$operate = $_POST['operate'];
    	}
	$this->updateCustomFieldValue($inventory_model_id, $this->conf['fieldArray']['virtualStock'], $virtualStock, $operate);
    }
    
    public function getPurchaseInTransit($inventory_model_id){
	$sql_1 = "select inventory_model_code from inventory_model where inventory_model_id = '".$inventory_model_id."'";
	$result_1 = mysql_query($sql_1, $this->conn);
	$row_1 = mysql_fetch_assoc($result_1);
	$sku = $row_1['inventory_model_code'];
	    
	$sql = "select sum(sku_purchase_qty) as purchase_in_transit from purchase_orders where purchase_status = '5' and sku = '".$sku."' group by sku";
	//echo $sql."\n";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	return (!empty($row['purchase_in_transit']))?$row['purchase_in_transit']:0;
    }
    
    public function getSkuPurchaseInTransit($sku){
	$sql = "select sum(sku_purchase_qty) as purchase_in_transit from purchase_orders where purchase_status = '5' and sku = '".$sku."' group by sku";
	//echo $sql."\n";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	return (!empty($row['purchase_in_transit']))?$row['purchase_in_transit']:0;
    }
    
    public function getSkuCombo($sku){
	$sql = "select attachment,quantity from combo where sku = '".$sku."'";
	$result = mysql_query($sql, $this->conn);
	while($row = mysql_fetch_assoc($result)){
	    $array[] = $row;
	}
	return $array;
    }
    
    public function getFlow($inventory_model_id="", $sku=""){
	if(!empty($inventory_model_id)){
	    $sql = "select three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model where inventory_model_id = ".$inventory_model_id;
	}else{
	    $sql = "select three_day_flow,week_flow_1,week_flow_2,week_flow_3 from inventory_model where inventory_model_code = '".$sku."'";
	}
	$result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
	return $row;
    }
}
?>