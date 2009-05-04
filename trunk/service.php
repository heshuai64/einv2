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
        
        $sql = "select location_id from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
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
            $responce->rows[$i]['id']= $row[id];
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
$action = (!empty($_GET['action']))?$_GET['action']:$_POST['action'];
switch($action){
    case "inventoryTakeOut":
        $service->inventoryTakeOut($_GET['inventory_model'], $_GET['quantity'], $_GET['note'], $_GET['shipment_method']);
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
}

//http://127.0.0.1:6666/tracmor/service.php?action=inventoryTakeOut&inventory_model=a008&quantity=10&note=test&shipment_method=B
?>