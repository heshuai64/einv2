<?php
class Service{
    const DATABASE_HOST = 'localhost';
    const DATABASE_USER = 'root';
    
    const DATABASE_PASSWORD = '5333533';
    const DATABASE_NAME = 'tracmor';
    //const DATABASE_PASSWORD = '5333533';
    //const DATABASE_NAME = 'inventory';
    private static $database_connect;
    
    public function __construct(){
        Service::$database_connect = mysql_connect(self::DATABASE_HOST, self::DATABASE_USER, self::DATABASE_PASSWORD);

        if (!Service::$database_connect) {
            echo "Unable to connect to DB: " . mysql_error(Service::$database_connect);
            exit;
        }
          
        mysql_query("SET NAMES 'UTF8'", Service::$database_connect);
        
        if (!mysql_select_db(self::DATABASE_NAME, Service::$database_connect)) {
            echo "Unable to select mydbname: " . mysql_error(Service::$database_connect);
            exit;
        }
    }
    
    private function log($file_name, $data){
        file_put_contents("/export/inventory/log/".$file_name."-".date("Y-m-d").".html", $data, FILE_APPEND);
        //echo $data;   
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
        $this->log("inventoryTakeOut", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        
        //get sku location
        $sql = "select inventory_location_id,location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
        $this->log("inventoryTakeOut", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $source_location_id = $row['location_id'];
        $inventory_location_id = $row['inventory_location_id'];
        
        if(!empty($source_location_id)){
            //sku add stock out transaction
            $sql = "insert into transaction (entity_qtype_id,transaction_type_id,note,created_by,creation_date) values ('2','5','".$shipment_id.", ".$shipment_method_descript."','".$created_by."','".date("Y-m-d H:i:s")."')";
            $this->log("inventoryTakeOut", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            $transaction_id = mysql_insert_id(Service::$database_connect);
            
            //-------------------------------------------   Weight   -----------------------------------------------
            //get weight field id
            //echo "<font color='red'><br>Weight Start<br></font>";
            $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
            $this->log("inventoryTakeOut", $weight_field_sql."<br>");
            //echo $weight_field_sql;
            //echo "<br>";
            $weight_field_result = mysql_query($weight_field_sql, Service::$database_connect);
            $weight_field_row = mysql_fetch_assoc($weight_field_result);
            
            
            //get weight value
            $weight_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
            on cfs.custom_field_value_id=cfv.custom_field_value_id
            where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$weight_field_row['custom_field_id']."'";
            $this->log("inventoryTakeOut", $weight_value_sql."<br>");
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
            values ('".$inventory_location_id."','".$transaction_id."','".$quantity."','".$source_location_id."','3','".$created_by."','".date("Y-m-d H:i:s")."','".$shipment_id."','".$shipment_method."','".$shipment_fee."')";
            $this->log("inventoryTakeOut", $sql."<br>");
            //echo $sql;
            //echo "<br>";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                //sku update stock quantity
                $sql = "update inventory_location set quantity = quantity - ".$quantity." where inventory_model_id = '".$inventory_model_id."' and location_id = '".$source_location_id."'";
                $this->log("inventoryTakeOut", $weight_value_sql."<br>");
                //echo $sql;
                //echo "<br>";
                $result = mysql_query($sql, Service::$database_connect);
                
                $sql = "update inventory_model set modified_by = '".$created_by."',modified_date = '".date("Y-m-d H:i:s")."' where inventory_model_id = '".$inventory_model_id."'";
                $this->log("inventoryTakeOut", $weight_value_sql."<br>");
                $result = mysql_query($sql, Service::$database_connect);
                $this->log("inventoryTakeOut", $sql."<br><font color='red'>++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++</font><br>");
                echo "take out success";
            }
        }else{
            echo "Sku Not In Location!<br>";
        }
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
    
    public function addInventory($category_id, $inventory_model_code, $short_description, $long_description, $weight, $cost, $envelopes, $quantity, $manufacturer_id){
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
    
    public function importCsv($csv_file_name){
        /*
        $creation_date = "2009-05-19 15:30:00";
        $sql = "delete from custom_field_value where creation_date > '".$creation_date."'";
        echo $sql;
        echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        */
            
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
        $stock_days_field_sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
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
        $sql = "select custom_field_id from custom_field where short_description = 'Lower Limit'";
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
        $sql = "select custom_field_id from custom_field where short_description = 'Stock Days'";
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
        
        $sql_1 = "select inventory_model_id,inventory_model_code,short_description,week_flow from inventory_model where category_id = '".$_GET['category_id']."' order by ".$sidx." ".$sord." limit ".$start.",".$limit;
        //echo $sql_1;
        //echo "<br>";
        
        $result_1 = mysql_query($sql_1, Service::$database_connect);
        $array = array();
        $i = 0;
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
            
            $responce->rows[$i]['id']= $row_1['inventory_model_id'];
            $responce->rows[$i]['cell'] = array($row_1['inventory_model_code'], $row_1['short_description'], $row_2['quantity'], round(($row_1['week_flow'] / 14 ) * $row_3['short_description']), $row_3['short_description'], $row_1['week_flow']);
            $i++;
        }
        
        echo json_encode($responce);
    }
    
    public function stockAttentionByCategory(){
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        
        
        $sql = "select custom_field_id from custom_field where short_description = 'Lower Limit'";
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
    
    public function postageByDate($date){
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
    
    public function getShippingMethodBySku(){
        $AEACJ = array('United States', 'United Kingdom', 'Australia', 'Canada', 'Japan');
        $_GET['data'] = str_replace("\\", "", $_GET['data']);
        $data = json_decode($_GET['data']);
        //echo $_GET['data'];
        //file_put_contents("/tmp/1.log", print_r($data, true), FILE_APPEND);
        $sku_array = $data->sku_array;
        //$sku_array = explode(",", $_GET['skuString']);
        
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
            $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
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
            $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
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
            $paper_field_sql = "select custom_field_id from custom_field where short_description = 'Paper tube'";
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
                $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
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
                $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
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
        
        if($total_weight > 1.4){
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
        echo json_encode(array('shippingMethod'=>$shippingMethod));
    }
    
    public function getEnvelopeBySku(){
        $this->log("getEnvelopeBySku", "<font color='red'><br>****************************************** Start  ******************************************<br></font>");
        $envelope_field_value = "Envelope";
        $envelope_field_sql = "select custom_field_id from custom_field where short_description = '".$envelope_field_value."'";
        //echo $envelope_field_sql;
        //echo "<br>";
        $envelope_field_result = mysql_query($envelope_field_sql, Service::$database_connect);
        $envelope_field_row = mysql_fetch_assoc($envelope_field_result);
        
        $_GET['data'] = str_replace("\\", "", $_GET['data']);
        //$this->log("getEnvelopeBySku", $_GET['data']."<br>");                
        $skuArray = json_decode($_GET['data']);
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
        $seven_day_ago = date("Y-m-d", time() - ((14 * 24 * 60 * 60)));
        $today = date("Y-m-d");
        $sql = "select im.inventory_model_code,sum(quantity) as week_flow from transaction as t left join inventory_transaction as it on 
        (t.transaction_id=it.transaction_id) left join inventory_model as im on it.inventory_location_id=im.inventory_model_id 
        where t.transaction_type_id = 5 and t.creation_date between '".$seven_day_ago."' and '".$today."' group by im.inventory_model_code";
        
        $this->log("calculateWeekFlow", $sql."<br>");
        //echo $sql;
        //echo "<br>";
        $result = mysql_query($sql, Service::$database_connect);
        $array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $sql_1 = "update inventory_model set week_flow = ".$row['week_flow']." where inventory_model_code = '".$row['inventory_model_code']."'";
            $this->log("calculateWeekFlow", $sql_1."<br>");
            //echo $sql_1;
            //echo "<br>";
            $result_1 = mysql_query($sql_1, Service::$database_connect);
        }
        //print_r($array);
        $this->log("calculateWeekFlow", "<br><font color='red'>++++++++++++++++++++++++++++++++++++++  End  +++++++++++++++++++++++++++++++</font><br>");
    }
    
    public function getAllSkus(){
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
    
    public function getSkuCost(){
        $this->log("getSkuCost", "<font color='red'><br>****************************************** Start  ******************************************<br></font>");
        //get inventory model id
        $sql = "select inventory_model_id from inventory_model where inventory_model_code = '".$_GET['data']."'";
        $this->log("getSkuCost", $sql."<br>");
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        $inventory_model_id = $row['inventory_model_id'];
        
        //-------------------------------------------    Cost    -----------------------------------------------
        //get cost field id
        $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
        $this->log("getSkuCost", $cost_field_sql."<br>");

        $cost_field_result = mysql_query($cost_field_sql, Service::$database_connect);
        $cost_field_row = mysql_fetch_assoc($cost_field_result);
        
        
        //get cost value
        $cost_value_sql = "select cfv.short_description from custom_field_selection as cfs left join custom_field_value as cfv 
        on cfs.custom_field_value_id=cfv.custom_field_value_id
        where cfs.entity_qtype_id='2' and cfs.entity_id='".$inventory_model_id."' and cfv.custom_field_id = '".$cost_field_row['custom_field_id']."'";
        $this->log("getSkuCost", $cost_value_sql."<br>");

        $cost_value_result = mysql_query($cost_value_sql, Service::$database_connect);
        $cost_value_row = mysql_fetch_assoc($cost_value_result);
        $cost = $cost_value_row['short_description'];
        $this->log("getSkuCost", "Cost: ".$cost."<br><font color='red'>******************************************  End  ******************************************<br></font>");
        echo json_encode(array('skuCost'=>$cost));
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
        $cost_field_sql = "select custom_field_id from custom_field where short_description = 'Cost'";
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
        $weight_field_sql = "select custom_field_id from custom_field where short_description = 'Weight'";
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
        $this->log("getSkuInfo", "skuTitle: ".$short_description.", skuCost: ".$cost.", skuWeight: ".$weight."<br><font color='red'>******************************************  End  ******************************************<br></font>");
        echo json_encode(array('skuTitle'=>$short_description, 'skuCost'=>$cost, 'skuWeight'=> $weight));
    }
    
    public function updateSkuDescription(){
        $sql = "select count(*) as num from description where sku = '".$_POST['sku']."'";
        $result = mysql_query($sql, Service::$database_connect);
        $row = mysql_fetch_assoc($result);
        if($row['num'] == 0){
            $sql = "insert into description (sku,english,french,germany) values ('".$_POST['sku']."','".$_POST['english']."','".$_POST['french']."','".$_POST['germany']."')";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                echo json_encode(array("sucess"=> true,  "msg"=>"add description success."));
            }else{
                echo json_encode(array("sucess"=> false, "msg"=>"add description failure."));
            }
        }else{
            $sql = "update description set english = '".$_POST['english']."',french = '".$_POST['french']."',germany = '".$_POST['germany']."' where sku = '".$_POST['sku']."'";
            $result = mysql_query($sql, Service::$database_connect);
            if($result){
                echo json_encode(array("sucess"=> true,  "msg"=>"update description success."));
            }else{
                echo json_encode(array("sucess"=> false, "msg"=>"update description failure."));
            }
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
        echo $row[$languae];
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
    
    case "syncAppertainStock":
        $service->syncAppertainStock();
        break;
    
    case "importCsv":
        $service->importCsv($_GET['file_name']);
        break;
    
    case "getAllSkus":
        $service->getAllSkus();
        break;
    
    case "getSuppliers":
        $service->getSuppliers();
        break;
    
    case "getCategories":
        $service->getCategories();
        break;
    
    case "deleteInventory":
        $service->deleteInventory();
        break;
    
    case "getCategoriesTree":
        $service->getCategoriesTree();
        break;
    
    case "getModelBySkuId":
        $service->getModelBySkuId();
        break;
    
    case "getSkuCost":
        $service->getSkuCost();
        break;
    
    case "getEnvelopeBySku":
        $service->getEnvelopeBySku();
        break;
    
    case "updateStockDays":
        $service->updateStockDays();
        break;
        
    case "getSkuInfo":
    	$service->getSkuInfo();
    	break;
    
    case "updateSkuDescription":
        $service->updateSkuDescription();
        break;
    
    case "getSkuDescription":
        $service->getSkuDescription();
        break;
}

//http://127.0.0.1:6666/tracmor/service.php?action=inventoryTakeOut&inventory_model=a008&quantity=10&note=test&shipment_method=B
//http://127.0.0.1:6666/tracmor/service.php?action=syncAppertainStock
//http://127.0.0.1:6666/tracmor/service.php?action=importCsv&file_name=
?>