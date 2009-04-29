<?php
class Service{
    const DATABASE_HOST = 'localhost';
    const DATABASE_USER = 'root';
    const DATABASE_PASSWORD = '';
    const DATABASE_NAME = 'tracmor';
    private static $database_connect;
    
    public function __construct(){
        Service::$database_connect = mysql_connect(self::DATABASE_HOST, self::DATABASE_USER, self::DATABASE_PASSWORD);

        if (!Service::$database_connect) {
            echo "Unable to connect to DB: " . mysql_error(Service::$database_connect);
            exit;
        }
          
        if (!mysql_select_db(self::DATABASE_NAME, Service::$database_connect)) {
            echo "Unable to select mydbname: " . mysql_error(Service::$database_connect);
            exit;
        }
    }
    
    public function inventoryTakeOut($inventory_model, $quantity, $note, $shipment_method){
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
        $created_by = 1;
        $source_location_id = 6;
        
        
        $sql = "select inventory_model_id from inventory_model where inventory_model_code='".$inventory_model."'";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        
        $sql = "select location_id from inventory_location where inventory_model_id = '".$inventory_model_id."' and quantity > ".$quantity."";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        
        if(!empty($source_location_id)){
            $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','".$note.", ".$shipment_method_descript."','".$created_by."','".date("Y-m-d H:i:s")."')";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $transaction_id = mysql_insert_id(Service::$database_connect);
        
            $sql = "select custom_field_id from custom_field where short_description = 'Weight'";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            
            $sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$row['custom_field_id']."'";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $weight = $row['short_description'];
            
            switch($shipment_method){
                case "B":
                    $shipment_fee = 90 * $weight;
                    break;
                
                case "R":
                    $shipment_fee = 90 * $weight + 13;
                    break;
                
                case "S":
                    $shipment_fee = 240 + (($weight - 0.5 ) / 0.5 * 75) * 0.42;
                    break;
                
            }
            
            $sql = "insert into inventory_transaction (inventory_location_id,transaction_id,quantity,source_location_id,destination_location_id,created_by,creation_date,shipment_method,shipment_fee) 
            values ('".$inventory_model_id."','".$transaction_id."','".$quantity."','".$source_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."','".$shipment_method."',".$shipment_fee.")";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                $sql = "update inventory_location set quantity = quantity - ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
            }
        }else{
            echo "No Stock!";
        }
    }
    
    public function __destruct(){
        mysql_close(Service::$database_connect);
    }
    
    
}
    
$service = new Service();
$action = (!empty($_GET['action']))?$_GET['action']:$_POST['action'];
switch($action){
    case "inventoryTakeOut":
        $service->inventoryTakeOut($_GET['inventory_model'], $_GET['quantity'], $_GET['note'], $_GET['shipment_method']);
        break;
}

//http://127.0.0.1:6666/tracmor/service.php?action=inventoryTakeOut&inventory_model=a008&quantity=10&note=test&shipment_method=B
?>