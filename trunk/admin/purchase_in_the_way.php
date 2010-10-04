<?php
ini_set('include_path', '../');
session_start();

if(empty($_SESSION['intUserAccountId'])){
    header('Location: /inventory/login.php');
}

$config = parse_ini_file('config.ini', true);

$conn = mysql_connect($config['database']['host'], $config['database']['user'], $config['database']['password']);

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

//mysql_query("SET NAMES 'UTF8'");

if (!mysql_select_db($config['database']['name'])) {
    echo "Unable to select mydbname: " . mysql_error();
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
    exit;
}

$sql_4 = "select id,name from suppliers";
$result_4 = mysql_query($sql_4);
$suppliers_option = "";
while($row_4 = mysql_fetch_assoc($result_4)){
    $suppliers[$row_4['id']] = $row_4['name'];
    $suppliers_option .= '<option value="'.$row_4['id'].'">'.$row_4['name'].'</option>';
}
$suppliers_select  = '<select id="purchase-suppliers-id" name="purchase-suppliers-id">';
$suppliers_select  .= $suppliers_option;
$suppliers_select  .= '</select>';        
//ALTER TABLE `sku_purchase` ADD `remark` TEXT NOT NULL AFTER `quantity` ;
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Purchase In The Way</title>
    <script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
</head>
<body>
    <div id="purchase-panel">
        <h2 style="text-align: center;">Purchase In The Way</h2>
        <div id="add-purchase-panel">
                <form >
                        SKU: <input type="text" id="purchase-sku"/> |
                        Price: <input type="text" id="purchase-price"/> |
                        Quantity: <input type="text" id="purchase-quantity"/> |
                        Suppliers: <?=$suppliers_select?> <br>
                        Remark: <textarea rows="3" cols="50" id="purchase-remark"></textarea> <br>
                        <input id="add-purchase" type="button" value="Add"/>
                </form>
        </div>
        <div id="purchase-list-panel">
            <table border=1>
                    <tr>
                            <th>
                                    SKU
                            </th>
                            <th>
                                    Price
                            </th>
                            <th>
                                    Quantity
                            </th>
                            <th>
                                    Suppliers
                            </th>
                            <th>
                                    Date Created
                            </th>
                            <th>
                                    Date Modified
                            </th>
                            <th>
                                    Status
                            </th>
                            <th>
                                    Remark
                            </th>
                            <th>
                                    Operate
                            </th>
                    </tr>
                    <?php
                            mysql_query("SET NAMES 'UTF8'");
                            $sql = "select * from sku_purchase where status = 0 order by sku,modified_date desc";
                            $result = mysql_query($sql);
                            while($row = mysql_fetch_assoc($result)){
                                    switch($row['status']){
                                            case 0:
                                                    $status = "Processing";
                                                    $operate = "<input type='button' value='Storing To Warehouse' onClick='skuPurchaseStoring(".$row['id'].")'/> <br> <input type='button' value='Cancel' onClick='skuPurchaseCancel(".$row['id'].")'/>";
                                            break;
                                    
                                            case 1:
                                                    $status = "In Warehouse";
                                                    $operate = "";
                                            break;
                                    
                                            case 2:
                                                    $status = "Cancel";
                                                    $operate = "";
                                            break;
                                    }
                                    
                                    echo "<tr>";
                                    echo "<td>".$row['sku']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    echo "<td>".$row['quantity']."</td>";
                                    echo "<td>".$suppliers[$row['suppliers_id']]."</td>";
                                    echo "<td>".$row['created_by'].' by '.$row['creation_date']."</td>";
                                    echo "<td>".$row['modified_by'].' by '.$row['modified_date']."</td>";
                                    echo "<td>".$status."</td>";
                                    echo "<td>".$row['remark']."</td>";
                                    echo "<td>".$operate."</td>";
                                    echo "</tr>";
                            }
                            
                            mysql_query("SET NAMES 'latin1'");
                    ?>
            </table>
            <script type="text/javascript">
                    $("#add-purchase").click(function(){
                            $.post("/inventory/service.php?action=addSKuPurchase", { sku: $("#purchase-sku").val(), price: $("#purchase-price").val(), byId: '<?=$_SESSION['intUserAccountId']?>', by: '', quantity: $("#purchase-quantity").val(), suppliers_id: $("#purchase-suppliers-id").val(), remark: $("#purchase-remark").val()},
                                    function(data){
                                    $('#purchase-list-panel').load('/inventory/service.php?action=getPurchaseList');		
                            } );
                    })
                    
                    function skuPurchaseStoring(id){
                            $.post("/inventory/service.php?action=skuPurchaseStoring", { id: id, byId: '<?=$_SESSION['intUserAccountId']?>', byName: ''},
                                    function(data){
                                    $('#purchase-list-panel').load('/inventory/service.php?action=getPurchaseList');				
                                    //window.location.reload(); 
                            } );
                    }
                    
                    function skuPurchaseCancel(id){
                            $.post("/inventory/service.php?action=skuPurchaseCancel", { id: id, byId: '<?=$_SESSION['intUserAccountId']?>', by: ''},
                                    function(data){
                                    $('#purchase-list-panel').load('/inventory/service.php?action=getPurchaseList');				
                            } );
                    }
            </script>
        </div>
    </div>
</body>
</html>