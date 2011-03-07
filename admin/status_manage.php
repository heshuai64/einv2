<?php
include('../includes/configuration.inc.php');
include('../includes/prepend.inc.php');
if(empty($_SESSION['intUserAccountId'])){
    header('Location: /inventory/login.php');
}

$db_conf = unserialize(DB_CONNECTION_1);
$conn = mysql_connect($db_conf['server'], $db_conf['username'], $db_conf['password']);

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
  
if (!mysql_select_db($db_conf['database'])) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}
ini_set('include_path', '../');
$config = parse_ini_file('config.ini', true);

require_once 'Stomp.php';
require_once 'Stomp/Message/Map.php';
define("ACTIVE_MQ", "tcp://192.168.1.168:61613");

mysql_query("SET NAMES 'UTF8'");

$role = array();
$sql = "select role_id,short_description from role";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){
	$role[$row['role_id']] = $row['short_description'];
}

$role_1 = array('Administrator');

$sql = "select role_id from user_account where user_account_id = ".$_SESSION['intUserAccountId'];
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$currency_user_role = $role[$row['role_id']];

if(!in_array($currency_user_role, $role_1)){
	echo "没有权限访问!";
	exit;	
}

//get status field id
$status_field_sql = "select custom_field_id from custom_field where short_description = 'Sku Status'";
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

//print_r($status_array_1);
//print_r($status_array_2);
/*
$status_value = array();
$sql_2 = "select custom_field_value_id from custom_field_selection where entity_qtype_id = 2 and custom_field_value_id in (".$status_string.") and entity_id = 16";
$result_2 = mysql_query($sql_2);
$row_2 = mysql_fetch_assoc($result_2);
$status_value = $status_array_1[$row_2['custom_field_value_id']];
//var_dump($row_2);
*/
        
    if(!empty($_GET)){    
		switch ($_GET['action']){
			case "getSkuStatusGrid":
				$sql = "select count(*) as totalCount from 
				inventory_model as im left join custom_field_selection as cfs on im.inventory_model_id = cfs.entity_id 
				where cfs.custom_field_value_id = ".$status_array_2[$_POST['status']];
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				$totalCount = $row['totalCount'];
				
				$array = array();
				$sql = "select inventory_model_id,inventory_model_code,short_description from 
				inventory_model as im left join custom_field_selection as cfs on im.inventory_model_id = cfs.entity_id 
				where cfs.custom_field_value_id = ".$status_array_2[$_POST['status']]." limit ".$_POST['start'].",".$_POST['limit'];
				$result = mysql_query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					$array[] = $row;
				}
				echo json_encode(array('totalCount'=>$totalCount, 'records'=>$array));
				mysql_free_result($result);
			break;
			
			case "getSkuStatusCount":
				$sql = "select custom_field_value_id,count(*) as total from custom_field_selection where entity_qtype_id = 2 and custom_field_value_id in (".$status_string.") group by custom_field_value_id";
				$result = mysql_query($sql);
				while ($row = mysql_fetch_assoc($result)) {
					$row['status'] = str_replace(" ","-", $status_array_1[$row['custom_field_value_id']]);
					unset($row['custom_field_value_id']);
					$array[] = $row;
				}
				echo json_encode($array);
				mysql_free_result($result);
			break;
			
			case "changeStatus":
				if($_POST['status'] == "inactive" || $_POST['status'] == "under review"){
					$id_array = explode(",", $_POST['ids']);
					$sku_str = "";
					foreach($id_array as $id){
						$sql = "select inventory_model_code from inventory_model where inventory_model_id = ".$id;
						$result = mysql_query($sql);
						$row = mysql_fetch_assoc($result);
						$sku_str .= $row['inventory_model_code'].",";
					}
					$sku_str = substr($sku_str, 0, -1);
					
					$con = new Stomp($config['service']['activeMq']);
					$con->connect();
					// send a message to the queue
					$body = array("skus"=> $sku_str, "status"=> $_POST['status']);
					$header = array();
					$header['transformation'] = 'jms-map-json';
					$mapMessage = new StompMessageMap($body, $header);
					$con->send("/queue/SkuStatus", $mapMessage, array('persistent'=>'true'));
					$con->disconnect();
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
			break;
		}
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	    <title>SKU Status Manage</title>
	    <link rel="stylesheet" type="text/css" href="/ext-3.2.0/resources/css/ext-all.css"/>
	    <link rel="stylesheet" type="text/css" href="status-manage.css"/>
	    <script type="text/javascript" src="/ext-3.2.0/adapter/ext/ext-base.js"></script>
	    <script type="text/javascript" src="/ext-3.2.0/ext-all.js"></script>
	    <script type="text/javascript" src="js/status-manage.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/inventory/css/tracmor.css"></link>
		<link rel="stylesheet" type="text/css" href="../resources/css/ext-all.css" />
		<link rel="stylesheet" type="text/css" href="../resources/css/xtheme-gray.css" />
	    <!-- GC -->
	 	<!-- LIBS -->
	 	<script type="text/javascript" src="../adapter/ext/ext-base.js"></script>
	 	<!-- ENDLIBS -->
		<script type="text/javascript" src="../ext-all.js"></script>
	</head>
	<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
	<?php
            include("../common/custom_header.php");
        ?>
<body>
	<div id="menu-panel" style="position:relative; width: 200px;">
		<div id="new-button" style="position:absolute; top: 100px;"></div>
		<div id="waiting-for-approve-button" style="position:absolute; top: 150px;" ></div>
		<div id="under-review-button" style="position:absolute; top: 200px;"></div>
		<div id="active-button" style="position:absolute; top: 250px;"></div>
		<div id="inactive-button" style="position:absolute; top: 250px; left: 80px;"></div>
		<div id="out-of-stock-button" style="position:absolute; top: 300px;"></div>
	</div>
	<div id="content-panel" style="position:relative; left: 200px; width: 600px; height: 600px;">
	</div>
</body>
</html>
<?php 

?>