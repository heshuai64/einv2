<?php
session_start();

if(empty($_SESSION['intUserAccountId'])){
    //echo "请先登录系统再使用,谢谢.";
    header('Location: /inventory/login.php');
}

$conn = mysql_connect("localhost", "root", "5333533");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

mysql_query("SET NAMES 'UTF8'");

if (!mysql_select_db("inventory")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

//ALTER TABLE `sku_purchase` ADD `remark` TEXT NOT NULL AFTER `quantity` ;
?>

<html>
<head>
    <title>Purchase In The Way</title>
    <script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
</head>
<body>
    <div id="purchase-panel">
        <h2 style="text-align: center;">Purchase In The Way</h2>
        <div id="add-purchase-panel">
                <form >
                        SKU: <input type="text" id="purchase-sku"/> | 
                        Quantity: <input type="text" id="purchase-quantity"/> <br>
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
                                    Quantity
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
                            $sql = "select * from sku_purchase where status = 0 order by sku,modified_date desc";
                            $result = mysql_query($sql);
                            while($row = mysql_fetch_assoc($result)){
                                    switch($row['status']){
                                            case 0:
                                                    $status = "Processing";
                                                    $operate = "<input type='button' value='Storing To Warehouse' onClick='skuPurchaseStoring(".$row['id'].")'/> | <input type='button' value='Cancel' onClick='skuPurchaseCancel(".$row['id'].")'/>";
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
                                    echo "<td>".$row['quantity']."</td>";
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
                            $.post("/inventory/service.php?action=addSKuPurchase", { sku: $("#purchase-sku").val(), byId: '<?=$_SESSION['intUserAccountId']?>', by: '', quantity: $("#purchase-quantity").val(), remark: $("#purchase-remark").val()},
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