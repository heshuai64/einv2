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
    
    public function getResearchInfoList(){
        if(empty($_POST['limit']) && empty($_POST['start'])){
	    $limit = 20;
	    $start = 0;
	}else{
	    $limit = $_POST['limit'];
	    $start = $_POST['start'];
	}
        
        $where = " where 1 = 1 ";
        
        $sql_0 = "select count(*) as totalCount from research_info ".$where;
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
	
	$sql = "select * from research_info ".$where." limit $start,$limit";
        $result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function getResearchInfo(){
        $sql = "select * from research_info where id = '".$_GET['id']."'";
        $result = mysql_query($sql, $this->conn);
        $row = mysql_fetch_assoc($result);
        echo '['.json_encode($row).']';
	mysql_free_result($result);
    }
    
    public function getPurchseInfo(){
        $research_id = $_GET['research_id'];
        $sql_0 = "select count(*) as totalCount from purchase_info where research_id = '".$research_id."'";
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
        
        $sql = "select * from purchase_info where research_id = '".$research_id."'";
        $result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function getPurchaseInfoList(){
        if(empty($_POST['limit']) && empty($_POST['start'])){
	    $limit = 20;
	    $start = 0;
	}else{
	    $limit = $_POST['limit'];
	    $start = $_POST['start'];
	}
        
        $where = " where 1 = 1 ";
        
        $sql_0 = "select count(*) as totalCount from purchase_info ".$where;
	$result_0 = mysql_query($sql_0, $this->conn);
	$row_0 = mysql_fetch_assoc($result_0);
	$totalCount = $row_0['totalCount'];
	
	$sql = "select * from purchase_info ".$where." limit $start,$limit";
        $result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = array();
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
        mysql_free_result($result);
    }
}

$service = new Research();
$action = $_GET['action'];
if(method_exists($service, $action)){
    $service->$action();
}
?>