<?php
require_once '../class/PHPExcel.php';
require_once '../class/PHPExcel/IOFactory.php';
require_once '../base.php';

include('../includes/configuration.inc.php');
include('../includes/prepend.inc.php');
if(empty($_SESSION['intUserAccountId'])){
	header('Location: /inventory/login.php');
}

$base = new Base();
$base->log = false;

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

if(!empty($_GET['action']) && $_GET['action'] == "exportCompany"){
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"company.csv\"");
	echo "Company ID,Company Name,Contact Id,Contact Name\r\n";
	
	$sql = "select company_id,short_description from company";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$sql_1 = "select contact_id,CONCAT(first_name, ' ', last_name) as name from contact where company_id = ".$row['company_id'];
		$result_1 = mysql_query($sql_1);
		while($row_1 = mysql_fetch_assoc($result_1)){
			echo $row['company_id'].",".$row['short_description'].",".$row_1['contact_id'].",".$row_1['name']."\r\n";
		}
	}
	exit;
}

$role = array();
$sql = "select role_id,short_description from role";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){
	$role[$row['role_id']] = $row['short_description'];
}

$role_1 = array('Administrator', 'PPMC');

$sql = "select role_id from user_account where user_account_id = ".$_SESSION['intUserAccountId'];
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$currency_user_role = $role[$row['role_id']];

if(!in_array($currency_user_role, $role_1)){
	echo "没有权限访问!";
	exit;	
}
	
if(!empty($_POST)){
	switch($_POST['action']){
		case "import_sku_company_contact":
			$handle = fopen($_FILES['import_file']['tmp_name'], "r");
			while (($data = fgetcsv($handle)) !== FALSE) {
				//print_r($data);
				$sql = "select count(*) as num from contact where company_id = ".$data[1]." and contact_id = ".$data[2];
				//echo $sql."<br>";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				
				if(empty($row['num'])){
					echo '公司ID:'.$data[1].",联系人ID:".$data[2]." 不存在.<br>";
					continue;
				}
				
				$sql = "select count(*) as num from sku_company_contact_price where sku = '".$data[0]."' and company_id = ".$data[1]." and contact_id = ".$data[2];
				//echo $sql."<br>";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);
				if(empty($row['num'])){
					$sql_1 = "insert into sku_company_contact_price (sku,company_id,contact_id,purchase_price) values 
					('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')";
					$result = mysql_query($sql_1);
				}else{
					$sql_1 = "update sku_company_contact_price set purchase_price = '".$data[3]."' where 
					sku = '".$data[0]."' and company_id = '".$data[1]."' and contact_id = '".$data[2]."'";
					$result = mysql_query($sql_1);
				}
				//echo $sql_1."<br>";
				
			}
			fclose($handle);
		break;
	
		case "import_company_contact":
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES['import_file']['tmp_name']);
			//$objPHPExcel = $objReader->load($_FILES['alexcel']['tmp_name']);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			foreach ($objWorksheet->getRowIterator() as $row) {
				$array = array();
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false);
				foreach ($cellIterator as $cell) {
				    $array[] = $cell->getValue();
				}
				
				$sql_1 = "insert into address (company_id,short_description,country_id,address_1,created_by,creation_date,modified_by) 
				values ('1', '".mysql_real_escape_string($array[5])."',45,'".mysql_real_escape_string($array[5])."','".$_SESSION['intUserAccountId']."',now(),'".$_SESSION['intUserAccountId']."')";
				echo $sql_1."<br/>";
				$result_1 = mysql_query($sql_1);
				if(!$result_1){
					echo mysql_error();
				}
				$address_id = mysql_insert_id();
				
				$sql_2 = "insert into company (address_id,short_description,website,telephone,created_by,creation_date,modified_by) 
				values ('".$address_id."','".mysql_real_escape_string($array[0])."','".$array[1]."','".$array[2]."','".$_SESSION['intUserAccountId']."',now(),'".$_SESSION['intUserAccountId']."')";
				echo $sql_2."<br/>";
				$result_2 = mysql_query($sql_2);
				if(!$result_2){
					echo mysql_error();
				}
				$company_id = mysql_insert_id();
				
				$base->updateCustomFieldValue($company_id, $base->conf['fieldArray']['paymentMethod'], $array[3], "", $base->conf['entityQtype']['Company']);
				$base->updateCustomFieldValue($company_id, $base->conf['fieldArray']['receiveAccounts'], $array[4], "", $base->conf['entityQtype']['Company']);
				
				$sql_3 = "insert into contact (company_id,first_name,last_name,phone_office,phone_home,created_by,creation_date,modified_by) 
				values ('".$company_id."','".$array[6]."','".$array[7]."','".$array[8]."','".$array[9]."','".$_SESSION['intUserAccountId']."',now(),'".$_SESSION['intUserAccountId']."')";
				echo $sql_3."<br/>";
				$result_3 = mysql_query($sql_3);
				if(!$result_3){
					echo mysql_error();
				}
				$contact_id = mysql_insert_id();

				$sql_4 = "update address set company_id = '".$company_id."' where address_id = '".$address_id."'";
				echo $sql_4."<br/>";
				$result_4 = mysql_query($sql_4);
				
				echo "<br/>";
			}
		break;
	}
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
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
        <div style="border: medium solid #98BF21; position: relative;">
		<div id="company-contact">
		<?php
		$company_array = array();
		$sql_1 = "select company_id as id,short_description as name from company order by id";
		$result_1 = mysql_query($sql_1);
		$i = 0;
		while($row_1 = mysql_fetch_assoc($result_1)){
			$company_array[$i]['id'] = $row_1['id'];
			$company_array[$i]['name'] = $row_1['name'];
			
			$sql_2 = "select contact_id as id,CONCAT(first_name, ' ', last_name) as name from contact where company_id = ".$row_1['id'];
			$result_2 = mysql_query($sql_2);
			while($row_2 = mysql_fetch_assoc($result_2)){
				$company_array[$i]['contact'][] = $row_2;
			}
		    $i++;
		}
		//print_r($company_array);
		
		$company_content = "<h2>供应商/联系人ID信息  <a href='index.php?action=exportCompany'>导出</a></h2>";
		$company_content .= "<table border='1'><tr><th>公司ID</th><th>公司名</th><th>联系人</th></tr>";
		foreach($company_array as $company){
			$company_content .= "<tr><td>".$company['id']."</td><td>".$company['name']."</td>";
			if(!empty($company['contact'])){
				$company_content .= "<td><table border='1'><tr><th>ID</th><th>姓名</th></tr>";
				foreach($company['contact'] as $contact){
					$company_content .= "<tr><td>".$contact['id']."</td><td>".$contact['name']."</td></tr>";
				}
				$company_content .= "</table></td>";
			}
			$company_content .= "</tr>";
		}
		$company_content .= "</table>";
		echo $company_content;
		?>
		</div>
		
		<div style="left: 400px; position: absolute; top: 0px;">
			<h2>案例</h2>
			<table border="1">
				<tr><td>LB00135</td><td>1</td><td>1</td><td>5.5</td></tr>
				<tr><td>LE00053</td><td>2</td><td>2</td><td>10.5</td></tr>
			</table>
			<br>
			<h2>说明:</h2>
			第一行 SKU LB00135 的供应商ID为1，联系人ID为1，采购价为5.5<br>
			第二行 SKU LE00053 的供应商ID为2，联系人ID为2，采购价为10.5<br>
		</div>
		
		<div style="left: 550px; position: absolute; top: 0px;">
			<h2>导入</h2>
			选中要导入的文件(CSV格式,逗号分隔):
			<form enctype="multipart/form-data" method="post">
				<input type="file" name="import_file">
				<input type="hidden" name="action" value="import_sku_company_contact">
				<br>
				<input type="submit"/ value="提交">
			</form>
		</div>
	</div>
	
	<div style="border: medium solid #98BF21; position: relative;">
		<div>
			<h2>案例</h2>
			<table border="1">
				<tr><td>如皋市永大服装辅料有限公司</td><td>http://x.com</td><td>0513-87056303</td><td>Advance Payment</td><td>支付宝</td><td>江苏 如皋市 江苏省南通市白蒲镇工业区白下路1号</td><td>刘</td><td>卫峰</td><td></td><td>13906274188</td></tr>
				<tr><td>富凯光学仪器厂</td><td>http://x.com</td><td>0577-86004882</td><td>Advance Payment</td><td>戴显川 农行：622845 0330002253117</td><td>温州 瓯海 南白象 霞坊路89号</td><td>夏</td><td>先生</td><td>0577-86004885 86004887</td><td></td></tr>
			</table>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
		</div>
		
		
		<div style="left: 550px; position: absolute; top: 100px;">
			<h2>供应商信息导入</h2>	
			选中要导入的文件(excel格式):
			<form enctype="multipart/form-data" method="post">
				<input type="file" name="import_file">
				<input type="hidden" name="action" value="import_company_contact">
				<br>
				<input type="submit"/ value="提交">
			</form>
		</div>
	</div>
</body>
</html>