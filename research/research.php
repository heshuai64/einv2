<?php
class Research{
    private $conf;
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
    }
    
    public function getId(){
        $today = date("Ym");
        $sql = "select id from sequence where date = '$today'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
       
        if(empty($row['id'])) {
            $sql = "insert into sequence (date,id) value ('$today',1)";
            mysql_query($sql, $this->conn);
        }else {   
            $sql = "update sequence set id = id + 1 where date = '$today'";
            $result = mysql_query($sql, $this->conn);
        }
       
        $sql = "select date,id from sequence where date = '$today'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        return $row['date'].str_repeat("0",(4-strlen($row["id"]))).$row['id'];      
    }
    
    public function getResearchInfoList(){
        session_start();
        
        $user_array = array();
        $sql_1 = "select id,name from user";
        $result_1 = mysql_query($sql_1, $this->conn);
        while($row_1 = mysql_fetch_assoc($result_1)){
            $user_array[$row_1['id']] = $row_1['name'];
        }
        
        if(empty($_POST['limit']) && empty($_POST['start'])){
	    $limit = 20;
	    $start = 0;
	}else{
	    $limit = $_POST['limit'];
	    $start = $_POST['start'];
	}
        
        $where = " where 1 = 1 ";
        
        if(!empty($_POST['status'])){
            $where .= " and status = ".$_POST['status'];
        }elseif(!empty($_POST['type']) && $_POST['type'] == "search"){
            
        }else{
            $where .= " and status = 0";
        }
        
        if(!empty($_POST['id'])){
            $where .= " and id like '".$_POST['id']."%'";
        }
        
        if(!empty($_POST['chinese_title'])){
            $where .= " and chinese_title like '%".$_POST['chinese_title']."%'";
        }
        
        if(!empty($_POST['sales'])){
            $where .= " and sales = '".$_POST['sales']."'";
        }
        
        if(!empty($_POST['createdOn'])){
            $where .= " and createdOn like '".$_POST['chinese_title']."%'";
        }
        
        $sql_0 = "select count(*) as totalCount from research_info ".$where;
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
	
	$sql = "select * from research_info ".$where." limit $start,$limit";
        //echo $sql."\n";
        $result = mysql_query($sql, $this->conn);
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $row['sales'] = $user_array[$row['sales']];
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
    
    /*
        plans sales mode
        0: bid
        1: bin
        2: bid&bin
        3: best offer
    */
    
    public function addResearchInfo(){
        session_start();
        if(empty($_SESSION['user_id'])){
            echo "{success: false, msg: 'timeout'}";
            exit;
        }
        
        $id = $this->getId();
        $images_values = $_POST['images-values'];
        unset($_POST['images-values']);
        $_POST['createdOn'] = date('Y-m-d H:i:s');
        $_POST['sales'] = $_SESSION['user_id'];
        
        $field = "id,";
        $field_value = $id.",";
        foreach($_POST as $key=>$value){
            $field .= $key.",";
            $field_value .= "'".mysql_real_escape_string($value)."',";    
        }
        $field = substr($field, 0, -1);
        $field_value = substr($field_value, 0, -1);
        $sql = "insert into research_info (".$field.") values (".$field_value.")";
        $result = mysql_query($sql);
        
        if(!empty($images_values)){
            $images_values = substr($images_values, 1);
            $images_values = explode(",", $images_values);
            foreach($images_values as $image_name){
                $sql_1 = "insert into research_images (research_id,path) values ('".$id."', '".mysql_real_escape_string($image_name)."')";
                //echo $sql_1."\n";
                $result_1 = mysql_query($sql_1);
            }
        }
        
        if($result){
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
    }
    
    public function getResearchInfo(){
        $images = array();
        $sql_0 = "select id,path from research_images where research_id = '".$_GET['id']."'";
        $result_0 = mysql_query($sql_0, $this->conn);
        while($row_0 = mysql_fetch_assoc($result_0)){
            $images[] = $row_0['path']."?".$row_0['id'];
        }
        $sql = "select * from research_info where id = '".$_GET['id']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $row['images'] = $images;
        echo '['.json_encode($row).']';
	mysql_free_result($result);
    }
    
    public function getResearchPurchseList(){
        $user_array = array();
        $sql_1 = "select id,name from user";
        $result_1 = mysql_query($sql_1, $this->conn);
        while($row_1 = mysql_fetch_assoc($result_1)){
            $user_array[$row_1['id']] = $row_1['name'];
        }
        
        $sql_0 = "select count(*) as totalCount from purchase_info where research_id = '".$_GET['research_id']."'";
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
	
	$sql = "select * from purchase_info where research_id = '".$_GET['research_id']."'";
        //echo $sql."\n";
        $result = mysql_query($sql, $this->conn);
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $row['purchaser'] = $user_array[$row['purchaser']];
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function updateResearchInfo(){
        session_start();
        if(empty($_SESSION['user_id'])){
            echo "{success: false, msg: 'timeout'}";
            exit;
        }
        //print_r($_POST);
        $images_values = substr($_POST['images-values'], 1);
        $images_values = explode(",", $images_values);
        foreach($images_values as $image){
            if(strpos($image, "?") == false && strpos(substr($image, 1), "/") != false){
                $sql_0 = "insert into research_images (research_id,path) values ('".$_GET['id']."','".mysql_real_escape_string($image)."')";
                $result_0 = mysql_query($sql_0);
            }
        }
        unset($_POST['images-values']);
        $sql = "update research_info set ";
        foreach($_POST as $key=>$value){
            $sql .= $key."='".mysql_real_escape_string($value)."',";    
        }
        $sql = substr($sql, 0, -1);
        $sql .= " where id = '".$_GET['id']."'";
        //echo $sql."\n";
        $result = mysql_query($sql);
        if($result){
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
    }
    
    public function getResearchStatusCount(){
        $array = array();
        $sql = "select status,count(*) as count from research_info group by status";
        $result = mysql_query($sql, $this->conn);
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode($array);
    }
    
    public function getPurchaseInfoList(){
        session_start();
        if(empty($_POST['limit']) && empty($_POST['start'])){
	    $limit = 20;
	    $start = 0;
	}else{
	    $limit = $_POST['limit'];
	    $start = $_POST['start'];
	}
        
        $where = " where 1 = 1 ";
        if(!empty($_POST['status'])){
            $where .= " and status = ".$_POST['status'];
        }elseif(!empty($_POST['type']) && $_POST['type'] == "search"){
            
        }else{
            $where .= " and status = 2";
        }
        
        if(!empty($_POST['id'])){
            $where .= " and id like '".$_POST['id']."%'";
        }
        
        if(!empty($_POST['chinese_title'])){
            $where .= " and chinese_title like '%".$_POST['chinese_title']."%'";
        }
        
        if(!empty($_POST['createdOn'])){
            $where .= " and createdOn like '".$_POST['createdOn']."%'";
        }
        
        
        $sql_0 = "select count(*) as totalCount from research_info ".$where;
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
	
	$sql = "select * from research_info ".$where;//." limit $start,$limit";
        //echo $sql."\n";
        $result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $sql_1 = "select * from purchase_info where research_id = '".$row['id']."' and purchaser = ".$_SESSION['user_id'];
            $result_1 = mysql_query($sql_1, $this->conn);
            $row_1 = mysql_fetch_assoc($result_1);
            
            if(is_array($row_1)){
                unset($row['id']);
                $row = array_merge($row, $row_1);
            }else{
                $row['research_id'] = $row['id'];
                unset($row['id']);
            }
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function getPurchseInfo(){
        $images = array();
        $sql_0 = "select path from research_images where research_id = '".$_GET['research_id']."'";
        $result_0 = mysql_query($sql_0, $this->conn);
        while($row_0 = mysql_fetch_assoc($result_0)){
            $images[] = $row_0['path'];
        }
        
        $sql = "select * from research_info where id = '".$_GET['research_id']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $row['research_id'] = $row['id'];
        unset($row['id']);
        
        $sql_1 = "select * from purchase_info where id = '".$_GET['id']."'";
        $result_1 = mysql_query($sql_1, $this->conn);
        $row_1 = mysql_fetch_assoc($result_1);
        if(!empty($row_1)){
            $row = array_merge($row, $row_1);
        }
        $row['images'] = $images;
        
        echo '['.json_encode($row).']';
	mysql_free_result($result);
    }
    
    public function updatePurchaseInofBySales(){
        $sql = "update purchase_info set sales_judge = ".$_POST['sales_judge'].", continue_develop = ".$_POST['continue_develop'].",
        rejected_reason = '".mysql_real_escape_string($_POST['rejected_reason'])."' where id = '".$_GET['id']."'";
        $result = mysql_query($sql, $this->conn);
        if($result){
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
    }
    
    public function updatePurchseInfo(){
        session_start();
        if(empty($_SESSION['user_id'])){
            echo "{success: false, msg: 'timeout'}";
            exit;
        }
        //$sql_0 = "select count(*) as num from purchase_info where research_id = '".$_GET['research_id']."' and purchaser = ".$_SESSION['user_id'];
        //$result_0 = mysql_query($sql_0, $this->conn);
        //$row_0 = mysql_fetch_assoc($result_0);
        if(empty($_GET['id'])){
            $sql = "insert into purchase_info (research_id,purchaser,product_cost,product_net_weight,min_purchase_num,product_arrival_days,remark,suppliers_info,createdOn) values
            ('".$_GET['research_id']."',".$_SESSION['user_id'].",".$_POST['product_cost'].",".$_POST['product_net_weight'].",".$_POST['min_purchase_num'].",
            ".$_POST['product_arrival_days'].",'".mysql_real_escape_string($_POST['remark'])."','".mysql_real_escape_string($_POST['suppliers_info'])."','".date("Y-m-d H:i:s")."')";
            $result = mysql_query($sql, $this->conn);
        }else{
            $sql = "update purchase_info set product_cost = ".$_POST['product_cost'].",product_net_weight = ".$_POST['product_net_weight'].",
            min_purchase_num = ".$_POST['min_purchase_num'].",product_arrival_days = ".$_POST['product_arrival_days'].",
            remark = '".mysql_real_escape_string($_POST['remark'])."',suppliers_info = '".mysql_real_escape_string($_POST['suppliers_info'])."'
            where id = ".$_GET['id'];
            $result = mysql_query($sql, $this->conn);
        }
        //echo $sql."\n";
        
        $sql_1 = "update research_info set status = ".$_POST['status']." where id = '".$_GET['research_id']."'";
        //echo $sql_1."\n";
        $result_1 = mysql_query($sql_1, $this->conn);
        
        if($result && $result_1){
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
        
    }
    
    public function uploadImages(){
        $today = date("Ym");
        $tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . "/" . $today . "/";
        if(!file_exists($targetPath)){
            mkdir($targetPath);
        }
        
        //file_put_contents("logs/xx.log", $targetPath);
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
        move_uploaded_file($tempFile, $targetFile);
        $image_name = str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
        //file_put_contents("logs/xx.log", print_r(array($_SERVER['DOCUMENT_ROOT'], $_REQUEST['folder'], $targetFile, $image_name), true), FILE_APPEND);
        if($image_name[0] != "/"){
            echo "/".$image_name;
        }else{
            echo $image_name;
        }
    }
    
    public function deleteImages(){
        $sql = "delete from research_images where id = ".$_GET['id'];
        $result = mysql_query($sql, $this->conn);
        if($result){
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
    }
    
    private function getLO($type, $status){
        $status_array = array(0=>'新品',
                              1=>'待审核',
                              2=>'待询价',
                              3=>'询价待审核',
                              4=>'询价完成',
                              5=>'拿样确认',
                              6=>'新品开发成功',
                              7=>'新品开发失败',
                              8=>'放弃');
        session_start();
        $role = $_SESSION['role'];
        $array = array();
        if($type == "R"){
            if($role == 1){
                switch($status){
                    case "1":
                        $array = array(0=>array('id'=>'1', 'name'=>$status_array[1]),
                                       1=>array('id'=>'2', 'name'=>$status_array[2]),
                                       2=>array('id'=>'8', 'name'=>$status_array[8]));
                    break;
                
                    case "7":
                        $array = array(0=>array('id'=>'7', 'name'=>$status_array[7]),
                                       1=>array('id'=>'2', 'name'=>$status_array[2]),
                                       2=>array('id'=>'8', 'name'=>$status_array[8]));
                    break;
                
                    case "8":
                        $array = array(0=>array('id'=>'8', 'name'=>$status_array[8]),
                                       1=>array('id'=>'1', 'name'=>$status_array[1]));
                    break;
                }
            }elseif($role == 2){
                switch($status){
                    case "0":
                        $array = array(0=>array('id'=>'0', 'name'=>$status_array[0]),
                                       1=>array('id'=>'1', 'name'=>$status_array[1]));
                    break;
                
                    case "3":
                        $array = array(0=>array('id'=>'3', 'name'=>$status_array[3]),
                                       1=>array('id'=>'2', 'name'=>$status_array[2]),
                                       2=>array('id'=>'4', 'name'=>$status_array[4]),
                                       3=>array('id'=>'7', 'name'=>$status_array[7]));
                    break;
                
                    case "5":
                        $array = array(0=>array('id'=>'5', 'name'=>$status_array[5]),
                                       1=>array('id'=>'6', 'name'=>$status_array[6]),
                                       2=>array('id'=>'7', 'name'=>$status_array[7]));
                    break;
                }
            }elseif($role == 3){
                switch($status){
                    case "2":
                        $array = array(0=>array('id'=>'2', 'name'=>$status_array[2]),
                                       1=>array('id'=>'3', 'name'=>$status_array[3]));
                    break;
                
                    case "4":
                        $array = array(0=>array('id'=>'4', 'name'=>$status_array[4]),
                                       1=>array('id'=>'5', 'name'=>$status_array[5]));
                    break;
                }
            }
            
        }elseif($type == "P"){
            
        }
        //print_r($array);
        echo json_encode($array);
    }
    
    /*
        0 = new product
        1 = waiting review
        2 = waiting inquiry
        3 = inquiry waiting review
        4 = inquiry complete
        5 = take sample confirm
        6 = new product develop success
        7 = new product develop failure
        8 = give up
    */
    
    public function getRCOStatus(){
        $sql = "select status from research_info where id = '".$_GET['id']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        $this->getLO('R', $row['status']);
    }
    
    /*
        1:sales manager
        2:sales
        3:purchaser
    */
    
    public function login(){
        if($_SERVER['REMOTE_ADDR'] != "127.0.0.1" && substr($_SERVER['REMOTE_ADDR'], 0, 8) != "192.168."){
	    $ip_array = json_decode(file_get_contents("http://192.168.1.168:8888/eBayBO/service.php?action=getClientIp"));
	    //file_put_contents("/tmp/xx.log", print_r($ip_array, true));
	    if(!in_array($_SERVER['REMOTE_ADDR'], $ip_array)){
		echo "{success: false}";
		return 0;
	    }
	}
        
        session_set_cookie_params(24 * 60 * 60);
        session_start();
        $sql = "select id,name,role from user where name = '".$_POST['name']."' and password = '".$_POST['password']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        if(!empty($row['id'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            setcookie("user_name", $row['name'], time() + (60 * 60 * 24), '/');
            setcookie("user_role", $row['role'], time() + (60 * 60 * 24), '/');
            echo "{success: true}";
        }else{
            echo "{success: false}";
        }
    }
}

$service = new Research();
$action = $_GET['action'];
if(method_exists($service, $action)){
    $service->$action();
}
?>