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
    
    public function inventoryTakeOut($inventory_model, $quantity, $shipment_id, $shipment_method){
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
        
        //get sku model id
        $sql = "select inventory_model_id from inventory_model where inventory_model_code='".$inventory_model."'";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        
        //get sku location
        $sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        $inventory_location_id = $row['inventory_location_id'];
        
        if(!empty($source_location_id)){
            //sku add stock out transaction
            $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','".$shipment_id.", ".$shipment_method_descript."','".$created_by."','".date("Y-m-d H:i:s")."')";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $transaction_id = mysql_insert_id(Service::$database_connect);
            
            //-------------------------------------------   Weight   -----------------------------------------------
            //get weight field id
            echo "<font color='red'><br>Weight Start<br></font>";
            $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
            echo $weight_field_sql;
            echo "<br>";
            $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
            $weight_field_row = mysql_fetch_assoc($weight_field_result);
            
            
            //get weight value
            $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
            echo $weight_value_sql;
            echo "<br>";
            $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
            $weight_value_row = mysql_fetch_assoc($weight_value_result);
            $weight = (float)$weight_value_row['short_description'];
            echo "<font color='red'><br>Weight End<br></font>";
            
            
            //---------------------------------------  Envelope  ---------------------------------------------------
            /*
            //get envelope field id
            echo "<font color='red'><br>Envelope Start<br></font>";
            $envelope_field_sql = "select custom_field_id from custom_field where short_description = 'Envelope'";
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
            values ('".$inventory_location_id."','".$transaction_id."','".$quantity."','".$source_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."','".$shipment_id."','".$shipment_method."',".$shipment_fee.")";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                //sku update stock quantity
                $sql = "update inventory_location set quantity = quantity - ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
                echo $sql;
                echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
            }
        }else{
            echo "Sku Not In Location!<br>";
        }
    }
    
    public function syncEnvelope(){
        //-------------------------------------------   Constant  --------------------------------------------
        //Battery Category Id
        $battery_category = 2;
        $s_envelope_model_id = 5;
        $m_envelope_model_id = 6;
        $l_envelope_model_id = 7;
        $xl_envelope_model_id = 8;
                
        //S Inventory Model And Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$s_envelope_model_id."'";
        echo $envelope_location_sql;
        echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $s_location_id = $envelope_location_row['location_id'];
        $s_inventory_location_id = $envelope_location_row['inventory_location_id'];
          
        //M Inventory Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$m_envelope_model_id."'";
        echo $envelope_location_sql;
        echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $m_location_id = $envelope_location_row['location_id'];
        $m_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //L Inventory Model And Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$l_envelope_model_id."'";
        echo $envelope_location_sql;
        echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $l_location_id = $envelope_location_row['location_id'];
        $l_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //XL Inventory Model And Location
        $envelope_location_sql = "select location_id,inventory_location_id from inventory_location where inventory_model_id = '".$xl_envelope_model_id."'";
        echo $envelope_location_sql;
        echo "<br>";
        $envelope_location_result = mysql_query($envelope_location_sql, Service::$database_connect);
        $envelope_location_row = mysql_fetch_assoc($envelope_location_result);
        $xl_location_id = $envelope_location_row['location_id'];
        $xl_inventory_location_id = $envelope_location_row['inventory_location_id'];
        
        //-----------------------------------------------------------------------------------------------------
        
        $sql = "select shipment_id from inventory_transaction where inventory_transaction_id = 90";//envelope_status = 0 and shipment_id !=''";
        $result = mysql_query($sql, Service::$database_connect);
        $created_by = 1;
        while($row = mysql_fetch_assoc($result)){
            //$sql_1 = "select inventory_location_id,quantity from inventory_transaction where shipment_id = '".$row['shipment_id']."'";
            $sql_1 = "select inventory_transaction_id,inventory_location_id,quantity from inventory_transaction where inventory_transaction_id = 89 or inventory_transaction_id = 90";//envelope_status = 0 and shipment_id !=''";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
            $num_rows_1 = mysql_num_rows($result_1);
            
            if($num_rows_1 > 1){
//------------------------------------------ Many Envelope  --------------------------------------------------                
                echo "<font color='red'><br>Many Envelope Start<br></font>";
                $s_envelope_count = 0;
                $m_envelope_count = 0;
                $l_envelope_count = 0;
                $xl_envelope_count = 0;
                
                while($row_1 = mysql_fetch_assoc($result_1)){
                    $inventory_model_id = $row_1['inventory_location_id'];
                    //get envelope field id
                    $envelope_field_sql = "select custom_field_id from custom_field where short_description = 'Envelope'";
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
                    
                    //get category id
                    $sql_2 = "select category_id from inventory_model where inventory_model_id = '".$inventory_model_id."'";
                    $result_2 = mysql_query($sql_2, Service::$database_connect);
                    $row_2 = mysql_fetch_assoc($result_2);
                    $category_id = $row_2['category_id'];
                        
                    if($envelope_model_id == $s_envelope_model_id && $s_envelope_count < 6 && $category_id == $battery_category && $row_1['quantity'] < 6){
                        //S Envelope
                        $s_envelope_count += $row_1['quantity'];
                        if($s_envelope > 6){
                            continue;
                        }
                    }elseif($envelope_model_id == $m_envelope_model_id){
                        //M Envelope
                        $m_envelope_count += $row_1['quantity'];
                    }elseif($envelope_model_id == $l_envelope_model_id){
                        //L Envelope
                        $l_envelope_count += $row_1['quantity'];
                    }elseif($envelope_model_id == $xl_envelope_model_id){
                        //XL Envelope
                        $xl_envelope_count += $row_1['quantity'];
                    }
                }
                
                if($s_envelope_count > 0 && $s_envelope_count < 6){
                    if($s_envelope_count == 1){
                        //2-4 S = 1L envelope add stock out transaction
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
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$s_inventory_location_id."' and location_id = '".$s_location_id."'";
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
                    }elseif($s_envelope_count > 1 && $s_envelope_count < 5){
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
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$l_inventory_location_id."' and location_id = '".$l_location_id."'";
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
                    }elseif($s_envelope_count == 5){
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
                            $envelope_update_stock_sql = "update inventory_location set quantity = quantity - 1 where inventory_model_id = '".$xl_inventory_location_id."' and location_id = '".$xl_location_id."'";
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
                        if($envelope_update_stock_result){
                            $envelope_status_sql = "update inventory_transaction set envelope_status = 1 where inventory_transaction_id = '".$row_1['inventory_transaction_id']."'";
                            echo $envelope_status_sql;
                            echo "<br>";
                            $envelope_status_result = mysql_query($envelope_status_sql, Service::$database_connect);
                        }
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
                        $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$l_envelope_count." where inventory_model_id = '".$l_inventory_location_id."' and location_id = '".$l_location_id."'";
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
                        $envelope_update_stock_sql = "update inventory_location set quantity = quantity - ".$xl_envelope_count." where inventory_model_id = '".$xl_inventory_location_id."' and location_id = '".$xl_location_id."'";
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
                }
                echo "<font color='red'><br>Many Envelope End<br></font>";
            }else{
//------------------------------------------ Single Envelope  --------------------------------------------------
                echo "<font color='red'><br>Single Envelope Start<br></font>";
                $row_1 = mysql_fetch_assoc($result_1);
                $inventory_model_id = $row_1['inventory_location_id'];
                //get envelope field id
                $envelope_field_sql = "select custom_field_id from custom_field where short_description = 'Envelope'";
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
                    //get category id
                    $sql_2 = "select category_id from inventory_model where inventory_model_id = '".$inventory_model_id."'";
                    $result_2 = mysql_query($sql_2, Service::$database_connect);
                    $row_2 = mysql_fetch_assoc($result_2);
                    $category_id = $row_2['category_id'];
                    
                    //envelope stock out
                    if($category_id == $battery_category){
                        if($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] > 1 && $row_1['quantity'] < 5){
                            // 2-4 S
                            $inventory_location_id = $l_inventory_location_id;
                            $envelope_model_id = $l_envelope_model_id;
                            $row_1['quantity'] = 1;
                        }elseif($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] == 5){
                            //5 S
                            $inventory_location_id = $xl_inventory_location_id;
                            $envelope_model_id = $xl_envelope_model_id;
                            $row_1['quantity'] = 1;
                        }elseif($envelope_model_id == $s_envelope_model_id && $row_1['quantity'] > 5){
                            //over S
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
                    echo "Envelope Not In Location!<br>";
                }
                echo "<font color='red'><br>Single Envelope End<br></font>";
            }
        }
    }
    
    public function importCsv($csv_file_name){
        //get weight field id
        $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
        echo $weight_field_sql;
        echo "<br>";
        $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
        $weight_field_row = mysql_fetch_assoc($weight_field_result);
        $weight_field_id = $weight_field_row['custom_field_id'];
        
        //get cost field id
        $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
        echo $cost_field_sql;
        echo "<br>";
        $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
        $cost_field_row = mysql_fetch_assoc($cost_field_result);
        $cost_field_id =  $cost_field_row['custom_field_id'];
        
        //get envelope field id
        $envelope_field_sql = "select custom_field_id from custom_field where short_description = 'Envelope'";
        echo $envelope_field_sql;
        echo "<br>";
        $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
        $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
        $envelope_field_id = $envelope_field_row['custom_field_id'];
            
        $entity_qtype_id = 2; //inventory
        
        //----------------------------------------------------------------------------------------------------    
        $manufacturer_id = 1;
        $created_by = 1;
        $category_id = 1;
        $creation_date = date("Y-m-d H:i:s");
        
        
        $inventory_model_code = "a09050901";
        $short_description = "a09050901";
        $long_description = "a09050901";
        
        $weight = "0.5";
        $cost = "200";
        $envelope = "L";
        
        
        
        $sql = "insert into inventory_model (category_id,manufacturer_id,inventory_model_code,short_description,long_description,created_by,creation_date) values 
        ($category_id,$manufacturer_id,'".$inventory_model_code."','".$short_description."','".$long_description."','".$created_by."','".$creation_date."')";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $inventory_model_id = mysql_insert_id(Service::$database_connect);
        
        //add weight
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
        $sql = "select custom_field_value_id from custom_field_value where short_description = '".$envelope."'";
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
        $sql = "insert into custom_field_selection (custom_field_value_id,entity_qtype_id,entity_id) values ($envelope_custom_field_value_id,$entity_qtype_id,$inventory_model_id)";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        
        
        
        exit;
        $row = 1;
        $handle = fopen($csv_file_name, "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
            $sql = "";
        }
        fclose($handle);    
    }
    
    public function stockAttention(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
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
    
    public function totalPostageByDate($date){
        $sql = "select sum(shipment_fee) as total_shipment_fee from inventory_transaction where creation_date like '".$date."%'";
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
    
    public function postageByDate($date){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(empty($date)){
            $date = date("Y-m-d");
        }
        $sql = "select count(*) as count from 
        inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id where it.creation_date like '".$date."%'";
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
        
        if($page ==0)
            $page = 1;
            
        if ($page > $total_pages)
            $page=$total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        
        $sql = "select im.inventory_model_code,it.quantity,it.shipment_method,it.shipment_fee from 
        inventory_transaction as it left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
        where it.creation_date like '".$date."%' order by ".$sidx." ".$sord." limit ".$start.",".$limit;
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
    
    public function getShippingMethodBySku(){
        $AEA = array();
        $data = json_decode($_GET['data']);
        //file_put_contents("/tmp/1.log", print_r($data, true), FILE_APPEND);
        $sku_array = $data->sku_array;
        //$sku_array = explode(",", $_GET['skuString']);

        foreach($sku_array as $sku){
            //var_dump($sku);
            echo "<font color='green'><br>Loop Start--------------------------------------------------------<br></font>";
            //get sku model id
            $sql = "select inventory_model_id,category_id from inventory_model where inventory_model_code='".$sku->skuId."'";
            echo $sql;
            echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $row = mysql_fetch_assoc($result);
            $category = $row['category_id'];
            $inventory_model_id = $row['inventory_model_id'];
            echo $category."<br>";
            echo $inventory_model_id."<br>";
            
            //-------------------------------------------   Weight   -----------------------------------------------
            //get weight field id
            echo "<font color='red'><br>Weight Start<br></font>";
            $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
            echo $weight_field_sql;
            echo "<br>";
            $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
            $weight_field_row = mysql_fetch_assoc($weight_field_result);
            
            
            //get weight value
            $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
            echo $weight_value_sql;
            echo "<br>";
            $weight_value_result = mysql_query($weight_value_sql, Service::$database_connect);
            $weight_value_row = mysql_fetch_assoc($weight_value_result);
            $weight = (float) $weight_value_row['short_description'] * $sku->quantity;
            echo $weight."<br>";
            echo "<font color='red'><br>Weight End<br></font>";
            
            //-------------------------------------------    Cost    -----------------------------------------------
            //get cost field id
            echo "<font color='red'><br>Cost Start<br></font>";
            $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
            echo $cost_field_sql;
            echo "<br>";
            $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
            $cost_field_row = mysql_fetch_assoc($cost_field_result);
            
            
            //get cost value
            $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
            echo $cost_value_sql;
            echo "<br>";
            $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
            $cost_value_row = mysql_fetch_assoc($cost_value_result);
            $cost = $cost_value_row['short_description'] * $sku->quantity;
            echo $cost."<br>";
            echo "<font color='red'><br>Cost End<br></font>";
            
            if($weight > 1.4){
                $shippingMethod = "S";
                break;
            }else{
                switch($category){
                    case "1":
                        //Battery
                        if($cost < 100 || ($cost >= 100 && $cost < 200 && in_array($data->country, $AEA))){
                            $shippingMethod = "B";
                        }else{
                            $shippingMethod = "R";
                            break;
                        }
                    break;
                
                    case "2":
                        //Game
                        if($cost < 150){
                            $shippingMethod = "B";
                        }else{
                            $shippingMethod = "R";
                            break;
                        }
                    break;
                
                    case "3":
                        //Security
                        if($cost < 99){
                            $shippingMethod = "B";
                        }else{
                            $shippingMethod = "R";
                            break;
                        }
                    break;
                
                    case "4":
                        //Case
                        $shippingMethod = "B";
                    break;
                
                    case "5":
                        //Oil Painting
                        $shippingMethod = "B";
                    break;
                }
            }
            echo $shippingMethod."<br>";
            echo "<font color='green'><br>Loop End--------------------------------------------------------<br></font>";
        }
        echo json_encode(array('shippingMethod'=>$shippingMethod));
    }
    
    public function calculateWeekFlow(){
        $seven_day_ago = date("Y-m-d", time() - ((7 * 24 * 60 * 60)));
        $today = date("Y-m-d");
        $sql = "select im.inventory_model_code,sum(quantity) as week_flow from transaction as t left join inventory_transaction as it on 
        (t.transaction_id=it.transaction_id) left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
        where t.transaction_type_id = 5 and t.creation_date between '".$seven_day_ago."' and '".$today."' group by im.inventory_model_code";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            echo $sql_1;
            echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
        print_r($array);
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
switch($action){
    case "inventoryTakeOut":
        $service->inventoryTakeOut($_GET['inventory_model'], $_GET['quantity'], $_GET['shipment_id'], $_GET['shipment_method']);
        break;

    case "stockAttention":
        $service->stockAttention();
        break;
    
    case "outOfStock":
        $service->outOfStock();
        break;
    
    case "topSales":
        $service->topSales();
        break;
    
    case "totalPostageByDate":
        $service->totalPostageByDate($_GET['date']);
        break;
    
    case "postageByDate":
        $service->postageByDate($_GET['date']);
        break;
    
    case "calculateWeekFlow":
        $service->calculateWeekFlow();
        break;
    
    case "getShippingMethodBySku":
        $service->getShippingMethodBySku();
        break;
    
    case "syncEnvelope":
        $service->syncEnvelope();
        break;
    
    case "importCsv":
        $service->importCsv($_GET['file_name']);
}

//http://127.0.0.1:6666/tracmor/service.php?action=inventoryTakeOut&inventory_model=a008&quantity=10&note=test&shipment_method=B
//http://127.0.0.1:6666/tracmor/service.php?action=syncEnvelope
?>