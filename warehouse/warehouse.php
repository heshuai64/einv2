<?php
include("../base.php");

class Warehouse extends Base{
    public function __construct(){
	parent::__construct();
    }
    
    public function getSkuPosition(){
        $position = $this->getCustomFieldValueBySku($_POST['sku'], $this->conf['fieldArray']['LocatorNumber']);
        if(empty($position)){
            echo "{position: ''}";
        }else{
            echo "{position: '".$position."'}";
        }
    }
    
    public function updateSkuPosition(){
        $this->updateCustomFieldValueBySku($_POST['sku'], $this->conf['fieldArray']['LocatorNumber'], $_POST['position']);
    }
    
    public function getSkuInfo(){
	$array = array();
	$sql = "select inventory_model_id as id,long_description as title from inventory_model where inventory_model_code = '".$_GET['sku']."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	$array['title'] = $row['title'];
	$array['status'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['skuStatus']);
	$array['weight'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['weight']);
	$array['accessories'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['accessories']);
	$array['stock'] = $this->getStock($row['id']);
	$array['position'] = $this->getCustomFieldValue($row['id'], $this->conf['fieldArray']['LocatorNumber']);
	//$array['image'] = "http://127.0.0.1:6666/inventory/inventory_images/".substr($_GET['sku'], 0, 2)."/".$_GET['sku'].".jpg";
	$array['image'] = "http://rich2010.3322.org:8080/inventory/inventory_images/".substr($_GET['sku'], 0, 2)."/".$_GET['sku'].".jpg";
	echo '['.json_encode($array).']';
    }
}

$action = $_GET['action'];
$warehouse = new Warehouse();
$warehouse->$action();