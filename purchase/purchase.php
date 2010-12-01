<?php
include("../base.php");

class Purchase extends Base{
    /*
    PO
    1: draft
    2: waiting inquiry
    3: waiting approval
    4: approval not pass
    5: approval pass
    6: in transit
    7: change to GIO
    */
    
    /*
    GIO
    1: new
    2: to inventory
    */
    
    public function __construct(){
	parent::__construct();
    }
    
    public function getAllCompany(){
	$array = array();
	$sql = "select * from company";
	$result = mysql_query($sql, $this->conn);
	while($row = mysql_fetch_assoc($result)){
	    $array[$row['company_id']] = $row; 
	}
	return $array;
    }
    
    public function getCompanyById($company_id){
	$sql = "select * from company where company_id = '".$company_id."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	return $row;
    }
    
    public function getAddressById($address_id){
	$sql = "select * from address where address_id = '".$address_id."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	return $row;
    }
    
    public function getAllContact(){
	$array = array();
	$sql = "select * from contact";
	$result = mysql_query($sql, $this->conn);
	while($row = mysql_fetch_assoc($result)){
	    $array[$row['contact_id']] = $row; 
	}
	return $array;
    }
    
    public function getContactById($contact_id){
	$sql = "select * from contact where contact_id = '".$contact_id."'";
	$result = mysql_query($sql, $this->conn);
	$row = mysql_fetch_assoc($result);
	return $row;
    }
    
    public function getPurchasePlanned(){
	$where = " where purchase_status = 0";
	if(!empty($_POST['date'])){
	    $where .= " and date = '".substr($_POST['date'], 0, 10)."'";
	}else{
	    $where .= " and date = '".date("Y-m-d")."'";
	}
	
	if(!empty($_POST['type']) && $_POST['type'] != "2"){
	    $where .= " and purchase_type = '".$_POST['type']."'";
	}
	
        $sql = "select * from purchase_planned ".$where;
	//echo $sql;
        $result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = "";
        while($row = mysql_fetch_assoc($result)){
            $array[] = $row;
            $i++;
        }
        echo json_encode(array('totalCount'=>$i, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function getPurchaseOrders(){
	if($_POST['purchase_status'] == 6){
	    $this->getGoInventoryOrders();
	    return 1;
	}
	$allCompany = $this->getAllCompany();
	$allContact = $this->getAllContact();
	
	$where = " where 1 = 1 ";
	if(!empty($_POST['vendors'])){
	    $where .= " and vendors = '".$_POST['vendors']."'";
	}
	if(!empty($_POST['sku'])){
	    $where .= " and sku like '".$_POST['sku']."%'";
	}
	if(!empty($_POST['purchase_type'])){
	    $where .= " and purchase_type = '".$_POST['purchase_type']."'";
	}
	if(!empty($_POST['purchase_status'])){
	    $where .= " and purchase_status = '".$_POST['purchase_status']."'";
	}
	if(!empty($_POST['purchaser'])){
	    $where .= " and purchaser = '".$_POST['purchaser']."'";
	}
	
	$sql = "select * from purchase_orders ".$where;
	//echo $sql."\n";
	
	$result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = "";
        while($row = mysql_fetch_assoc($result)){
	    $row['vendors'] = $allCompany[$row['vendors_id']]['short_description']."<br>".$allContact[$row['contact_id']]['first_name'].$allContact[$row['contact_id']]['last_name'];
            $array[] = $row;
            $i++;
        }
        echo json_encode(array('totalCount'=>$i, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function getPurchaseOrdersById(){
	$sql = "select * from purchase_orders where id = '".$_GET['id']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	echo '['.json_encode($row).']';
	mysql_free_result($result);
    }
    
    public function updatePurchaseOrders(){
	$sql = "select * from purchase_orders where id = '".$_POST['id']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	if($row['sku_price'] != $_POST['sku_price']){
	    $sql_1 = "update sku_company_contact_price set purchase_price = '".$_POST['sku_price']."' 
	    where sku = '".$row['sku']."' and company_id = '".$row['vendors_id']."' and contact_id = '".$row['contact_id']."'";    
	    $result_1 = mysql_query($sql_1);
	}
	
	$sql = "update purchase_orders set sku_old_purchase_qty = sku_purchase_qty,sku_purchase_qty = '".$_POST['sku_purchase_qty']."',sku_purchase_qty_remark = '".mysql_real_escape_string($_POST['sku_purchase_qty_remark'])."',
	sku_old_price = sku_price,sku_price = '".$_POST['sku_price']."',sku_price_remark = '".mysql_real_escape_string($_POST['sku_price_remark'])."',sku_total_price = '".($_POST['sku_purchase_qty'] * $_POST['sku_price'])."' 
	where id = '".$_POST['id']."'";
	$result = mysql_query($sql);
	if($result){
	    echo "1";
	}else{
	    echo "0";
	}
    }
    
    public function updatePurchaseOrdersVendors(){
	session_start();
	$sql = "update purchase_orders set vendors_id = '".$_POST['vendors_id']."',contact_id = '".$_POST['contact_id']."' where id = '".$_POST['id']."'";
	$result = mysql_query($sql);
	if($result){
	    $sql_1 = "update contact set phone_office = '".$_POST['phone_office']."',phone_mobile = '".$_POST['phone_mobile']."',modified_by='".$_SESSION['intUserAccountId']."'  
	    where contact_id = ".$_POST['contact_id']." and company_id = ".$_POST['vendors_id'];
	    $result_1 = mysql_query($sql_1);
	    
	    $sql_2 = "update company as c left join address as a 
	    on c.address_id = a.address_id set a.short_description = '".$_POST['address']."',a.modified_by = '".$_SESSION['intUserAccountId']."' 
	    where c.company_id = ".$_POST['vendors_id'];
	    $result_2 = mysql_query($sql_2);
	    //$this->updateCustomFieldValue($_POST['vendors_id'], $this->conf['fieldArray']['paymentMethod'], '', '', $this->conf['entityQtype']['Company']);
	    $this->updateCustomFieldValue($_POST['vendors_id'], $this->conf['fieldArray']['receiveAccounts'], $_POST['receive_account'],'', $this->conf['entityQtype']['Company']);
	}
	
	if($result){
	    echo "1";
	}else{
	    echo "0";
	}
    }
    
    public function getPurchaseOrdersVendors(){
	$sql = "select vendors_id,contact_id,sku from purchase_orders where id = '".$_GET['id']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$contact = $this->getContactById($row['contact_id']);
	$company = $this->getCompanyById($row['vendors_id']);
	$address = $this->getAddressById($company['address_id']);

	$row['phone_office'] = $contact['phone_office'];
	$row['phone_mobile'] = $contact['phone_mobile'];
	$row['address'] = $address['short_description'];
	$row['payment_method'] = str_replace(" ", "_", strtolower($this->getCustomFieldValue($row['vendors_id'], $this->conf['fieldArray']['paymentMethod'], $this->conf['entityQtype']['Company'])));
	$row['receive_account'] = $this->getCustomFieldValue($row['vendors_id'], $this->conf['fieldArray']['receiveAccounts'], $this->conf['entityQtype']['Company']);
	echo '['.json_encode($row).']';
	mysql_free_result($result);
    }
    
    public function deletePurchaseOrders(){
	$ids = explode(",", $_POST['ids']);
	foreach($ids as $id){
	    $sql = "delete from purchase_orders where id = '".$id."'";
	    $result = mysql_query($sql, $this->conn);
	}
	echo "1";
    }
    
    public function createPOFromPP(){
	$ids = explode(",", $_POST['ids']);
	foreach($ids as $id){
	    $array = array();
	    $sql = "select * from purchase_planned where id = ".$id;
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    
	    
	    $sql_1 = "select purchaser_id from sku_purchaser where sku = '".$row['sku']."'";
	    $result_1 = mysql_query($sql_1, $this->conn);
	    $row_1 = mysql_fetch_assoc($result_1);
	    if(!empty($row_1)){
		$sql_2 = "select first_name,last_name from user_account where user_account_id = '".$row_1['purchaser_id']."'";
		$result_2 = mysql_query($sql_2, $this->conn);
		$row_2 = mysql_fetch_assoc($result_2);
		$array['purchaser'] = $row_2['first_name'].$row_2['last_name'];
	    }
	    
	    $sql_3 = "select company_id,contact_id,purchase_price from sku_company_contact_price where sku = '".$row['sku']."'";
	    $result_3 = mysql_query($sql_3, $this->conn);
	    $row_3 = mysql_fetch_assoc($result_3);
	    /*
	    if(!empty($row_3)){
		$sql_4 = "select short_description from company where company_id = ".$row_3['company_id'];
		$result_4 = mysql_query($sql_4, $this->conn);
		$row_4 = mysql_fetch_assoc($result_4);
		
		$sql_5 = "select first_name,last_name from contact where contact_id = ".$row_3['contact_id'];
		$result_5 = mysql_query($sql_5, $this->conn);
		$row_5 = mysql_fetch_assoc($result_5);
		
		$array['vendors'] = $row_4['short_description']." ".$row_5['first_name']." ".$row_5['last_name'];
		$array['vendors_phone'] = $row_5['phone_mobile'];
		$array['vendors_fax'] = $row_5['fax'];
	    }
	    */
	    $array['vendors_id'] = $row_3['company_id'];
	    $array['contact_id'] = $row_3['contact_id'];
	    
	    $array['id'] = $this->getPurchaseOrdersId("PO");
	    $array['purchase_status'] = 1;
	    $array['generate_date'] = date("Y-m-d");
	    $array['sku'] = $row['sku'];
	    $array['purchase_type'] = $row['type'];
	    
	    $array['sku_status'] = $row['sku_status'];
	    $array['sku_title'] = $row['title'];
	    $array['sku_stock'] = $row['stock'];
	    $array['sku_virtual_stock'] = $row['virtual_stock'];
	    $array['sku_purchase_in_transit'] = $row['purchase_in_the_way'];
	    $array['sku_purchase_qty'] = $row['suggest_purchase_num'];
	    $array['sku_price'] = $row_3['purchase_price'];
	    $array['sku_total_price'] = $row['suggest_purchase_num'] * $row_3['purchase_price'];
	    $array['sku_defective_qty'] = "";
	    $array['sku_rework_qty'] = "";
	
	    $array['sku_purchase_cycle'] = $this->getCustomFieldValueBySku($row['sku'], $this->conf['fieldArray']['purchaseCycle']);
	    $array['sku_three_day_flow'] = $row['three_day_flow'];
	    $array['sku_week_flow'] = $row['week_flow_1'];
	    $array['created_by'] = "system";
	    $array['created_on'] = date("Y-m-d h:i:s");
	    
	    if($this->_C("purchase_orders", $array)){
		$sql_6 = "update purchase_planned set purchase_status = 1 where id = ".$id;
		$result_6 = mysql_query($sql_6, $this->conn);
	    }
	}
	echo "1";
    }
    
    private function updatePurchaseOrdersStatus($ids = null, $status = null){
	if(!empty($ids) && !empty($status)){
	    $ids = explode(",", $ids);
	    foreach($ids as $id){
		$sql_1 = "update purchase_orders set purchase_status = ".$status." where id = '".$id."'";
		$result_1 = mysql_query($sql_1, $this->conn);
	    }
	    echo "1";
	}else{
	    echo "0";
	}
    }
    
    public function createPurchaseOrders(){
	$sku = $_POST['sku'];
	$sku_price = $_POST['sku_price'];
	$sku_purchase_qty = $_POST['sku_purchase_qty'];
	$vendors_id = $_POST['vendors_id'];
	$contact_id = $_POST['contact_id'];
	
	$sql_1 = "select purchaser_id from sku_purchaser where sku = '".$sku."'";
	$result_1 = mysql_query($sql_1, $this->conn);
	$row_1 = mysql_fetch_assoc($result_1);
	if(!empty($row_1)){
	    $sql_2 = "select first_name,last_name from user_account where user_account_id = '".$row_1['purchaser_id']."'";
	    $result_2 = mysql_query($sql_2, $this->conn);
	    $row_2 = mysql_fetch_assoc($result_2);
	    $array['purchaser'] = $row_2['first_name'].$row_2['last_name'];
	}
	/*
	$sql_3 = "select company_id,contact_id,purchase_price from sku_company_contact_price where sku = '".$row['sku']."'";
	$result_3 = mysql_query($sql_3, $this->conn);
	$row_3 = mysql_fetch_assoc($result_3);
	
	if(!empty($row_3)){
	    $sql_4 = "select short_description from company where company_id = ".$row_3['company_id'];
	    $result_4 = mysql_query($sql_4, $this->conn);
	    $row_4 = mysql_fetch_assoc($result_4);
	    
	    $sql_5 = "select first_name,last_name from contact where contact_id = ".$row_3['contact_id'];
	    $result_5 = mysql_query($sql_5, $this->conn);
	    $row_5 = mysql_fetch_assoc($result_5);
	    
	    $array['vendors'] = $row_4['short_description']." ".$row_5['first_name']." ".$row_5['last_name'];
	    $array['vendors_phone'] = $row_5['phone_mobile'];
	    $array['vendors_fax'] = $row_5['fax'];
	}
	*/
	$array['id'] = $this->getPurchaseOrdersId("PO");
	$array['vendors_id'] = $vendors_id;
	$array['contact_id'] = $contact_id;
	$array['purchase_status'] = 1;
	$array['generate_date'] = date("Y-m-d");
	$array['sku'] = $sku;
	$array['purchase_type'] = 1;
	
	$sql_6 = "select * from inventory_model where inventory_model_code = '".$sku."'";
	$result_6 = mysql_query($sql_6, $this->conn);
	$row_6 = mysql_fetch_assoc($result_6);
	$array['sku_title'] = $row_6['long_description'];
	$array['sku_three_day_flow'] = $row_6['three_day_flow'];
	$array['sku_week_flow'] = $row_6['week_flow_1'];
	
	$array['sku_status'] = $this->getCustomFieldValueBySku($sku, $this->conf['fieldArray']['skuStatus']);
	$array['sku_stock'] = $this->getStock("", $sku);
	$array['sku_virtual_stock'] = $this->getCustomFieldValueBySku($sku, $this->conf['fieldArray']['virtualStock']);
	$array['sku_purchase_in_transit'] = "";//
	$array['sku_purchase_qty'] = $sku_purchase_qty;
	$array['sku_price'] = $sku_price;
	$array['sku_total_price'] = $sku_purchase_qty * $sku_price;
	$array['sku_defective_qty'] = "";
	$array['sku_rework_qty'] = "";
	$array['created_by'] = "system";
	$array['created_on'] = date("Y-m-d h:i:s");
	
	$result = $this->_C("purchase_orders", $array);
	if($result){
	    echo '{success: true}';
		
	}else{
	    echo '{success: false,
		      errors: {message: "can\'t create."}
		}';
	}
    }
    
    public function submitPurchaseOrders(){
	$this->updatePurchaseOrdersStatus($_POST['ids'], 2);
    }
    
    public function purchaseOrdersInquiryComplete(){
	$this->updatePurchaseOrdersStatus($_POST['ids'], 3);
    }
    
    public function approvalPurchaseOrdersNotPass(){
	$this->updatePurchaseOrdersStatus($_POST['ids'], 4);
    }
    
    public function approvalPurchaseOrdersPass(){
	$this->updatePurchaseOrdersStatus($_POST['ids'], 5);
	$ids = explode(",", $_POST['ids']);
	foreach($ids as $id){
	    $sql_1 = "select sku from purchase_orders where id = '".$id."'";
	    $result_1 = mysql_query($sql_1, $this->conn);
	    $row_1 = mysql_fetch_assoc($result_1);
	    
	    $purchase_cycle = $this->getCustomFieldValueBySku($row_1['sku'], $this->conf['fieldArray']['stockDays']);
	    //echo $purchase_cycle."\n";
	    $expected_arrival_date = date("Y-m-d", time() + $purchase_cycle * 24 * 60 * 60);
	    
	    $sql_2 = "update purchase_orders set approval_pass_date = now(),expected_arrival_date = '".$expected_arrival_date."' where id = '".$id."'";
	    $result_2 = mysql_query($sql_2, $this->conn);
	}
    }
    
    public function purchaseOrdersReturnApproval(){
	$this->updatePurchaseOrdersStatus($_POST['ids'], 3);
    }
    
    public function changePO2GIO(){
	$go_inventory_orders_id = $this->getGoInventoryOrdersId();
	//print_r($_POST);
	if($_POST['quantity'] < $_POST['total_quantity']){
	    $sku_total_price = $_POST['quantity'] * $_POST['price'];
	    $sql = "insert into go_inventory_orders (id,purchase_type,purchaser,vendors_id,contact_id,
	    purchase_status,generate_date,approval_pass_date,sku,sku_status,sku_title,sku_stock,sku_virtual_stock,
	    sku_purchase_in_transit,sku_purchase_qty,sku_old_purchase_qty,sku_purchase_qty_remark,
	    sku_price,sku_old_price,sku_price_remark,sku_total_price,sku_defective_qty,sku_rework_qty,
	    sku_purchase_cycle,sku_three_day_flow,sku_week_flow,expected_arrival_date,created_by,created_on) 
	    select '".$go_inventory_orders_id."',purchase_type,purchaser,vendors_id,contact_id,
	    '1',generate_date,approval_pass_date,sku,sku_status,sku_title,sku_stock,sku_virtual_stock,
	    sku_purchase_in_transit,'".$_POST['quantity']."',sku_old_purchase_qty,sku_purchase_qty_remark,
	    sku_price,sku_old_price,sku_price_remark,'".$sku_total_price."',sku_defective_qty,sku_rework_qty,
	    sku_purchase_cycle,sku_three_day_flow,sku_week_flow,expected_arrival_date,created_by,created_on from purchase_orders where id = '".$_POST['id']."'";
	    //echo $sql."\n";
	    $result = mysql_query($sql, $this->conn);
	    
	    $sku_purchase_qty = $_POST['total_quantity'] - $_POST['quantity'];
	    $sku_total_price = $_POST['quantity'] * $_POST['price'];
	    $sql = "update purchase_orders set sku_purchase_qty = ".$sku_purchase_qty.",sku_total_price = sku_total_price - ".$sku_total_price." where id = '".$_POST['id']."'";
	    //echo $sql."\n";
	    $result = mysql_query($sql, $this->conn);
	}else{
	    $sql = "insert into go_inventory_orders (id,purchase_type,purchaser,vendors_id,contact_id,
	    purchase_status,generate_date,approval_pass_date,sku,sku_status,sku_title,sku_stock,sku_virtual_stock,
	    sku_purchase_in_transit,sku_purchase_qty,sku_old_purchase_qty,sku_purchase_qty_remark,
	    sku_price,sku_old_price,sku_price_remark,sku_total_price,sku_defective_qty,sku_rework_qty,
	    sku_purchase_cycle,sku_three_day_flow,sku_week_flow,expected_arrival_date,created_by,created_on) 
	    select '".$go_inventory_orders_id."',purchase_type,purchaser,vendors_id,contact_id,
	    '1',generate_date,approval_pass_date,sku,sku_status,sku_title,sku_stock,sku_virtual_stock,
	    sku_purchase_in_transit,sku_purchase_qty,sku_old_purchase_qty,sku_purchase_qty_remark,
	    sku_price,sku_old_price,sku_price_remark,sku_total_price,sku_defective_qty,sku_rework_qty,
	    sku_purchase_cycle,sku_three_day_flow,sku_week_flow,expected_arrival_date,created_by,created_on from purchase_orders where id = '".$_POST['id']."'";
	    //echo $sql."\n";
	    $result = mysql_query($sql, $this->conn);
	    
	    $sql = "update purchase_orders set purchase_status = 7 where id = '".$_POST['id']."'";
	    //echo $sql."\n";
	    $result = mysql_query($sql, $this->conn);
	}
	echo "1";
    }
    
    public function getGoInventoryOrders(){
	$allCompany = $this->getAllCompany();
	$allContact = $this->getAllContact();
	
	$sql = "select * from go_inventory_orders where purchase_status = 1";
	$result = mysql_query($sql, $this->conn);
	$i = 0;
	$array = "";
        while($row = mysql_fetch_assoc($result)){
	    $row['vendors'] = $allCompany[$row['vendors_id']]['short_description']."<br>".$allContact[$row['contact_id']]['first_name'].$allContact[$row['contact_id']]['last_name'];
            $array[] = $row;
            $i++;
        }
        echo json_encode(array('totalCount'=>$i, 'records'=>$array));
        mysql_free_result($result);
    }
    
    public function GIOToInventory(){
	session_start();
	$ids = explode(",", $_POST['ids']);
	foreach($ids as $id){
	    $sql = "select sku,sku_purchase_qty from go_inventory_orders where id = '".$id."'";
	    $result = mysql_query($sql, $this->conn);
	    $row = mysql_fetch_assoc($result);
	    
	    $sql_1 = "select inventory_model_id from inventory_model where inventory_model_code = '".$row['sku']."'";
	    $result_1 = mysql_query($sql_1, $this->conn);
	    $row_1 = mysql_fetch_assoc($result_1);
	    
	    $result = $this->updateStock($row_1['inventory_model_id'], $row['sku_purchase_qty'], "+");
	    if($result){
		$sql_1 = "update go_inventory_orders set purchase_status = 2 where id = '".$id."'";
		$result_1 = mysql_query($sql_1, $this->conn);
	    }
	}
	echo "1";
    }
    
    public function getVendors(){
	$array = array();
	$sql = "select company_id as id,short_description as name from company";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
	    $array[] = $row;
	}
	echo json_encode($array);
    }
    
    public function getPurchaser(){
	$array = array();
	$sql = "select user_account_id as id, CONCAT(first_name, ' ', last_name) as name from user_account";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
	    $array[] = $row;
	}
	echo json_encode($array);
    }
    
    public function getContact(){
	$where = "";
	if(!empty($_POST['company_id'])){
	    $where .= " where company_id = ".$_POST['company_id'];
	}
	$array = array();
	$sql = "select contact_id as id, CONCAT(first_name, ' ', last_name) as name from contact".$where;
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
	    $array[] = $row;
	}
	echo json_encode($array);
    }
}


$action = $_GET['action'];
$purchase = new Purchase();
$purchase->$action();


?>