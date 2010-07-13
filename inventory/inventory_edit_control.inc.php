<?php
/*
 * Copyright (c)  2006, Universal Diagnostic Solutions, Inc. 
 *
 * This file is part of Tracmor.  
 *
 * Tracmor is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version. 
 *	
 * Tracmor is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tracmor; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
	
	// Build array of all fields to display
		$arrInventoryFields[] = array('name' => 'Short Description:',  'value' => $this->lblShortDescription->Render(false) . $this->txtShortDescription->RenderWithError(false));
		$arrInventoryFields[] = array('name' => 'Category:', 'value' => $this->lblCategory->Render(false) . $this->lstCategory->RenderWithError(false));
		$arrInventoryFields[] = array('name' => 'Manufacturer:', 'value' => $this->lblManufacturer->Render(false) . $this->lstManufacturer->RenderWithError(false));
		$arrInventoryFields[] = array('name' => 'Inventory Code:', 'value' => $this->lblInventoryModelCode->Render(false) . $this->txtInventoryModelCode->RenderWithError(false));
		$arrInventoryFields[] = array('name' => 'Long Description:', 'value' => $this->pnlLongDescription->Render(false) . $this->txtLongDescription->RenderWithError(false));
	
	// Custom Fields
	if ($this->arrCustomFields) {
		foreach ($this->arrCustomFields as $field) {
			//if ($this->blnEditMode) {
				//Display Custom Field in Edit Mode if the role has "View" access 
				//	if(($field['blnView'])){
					if(!$this->blnEditMode || $field['blnView']){
						$arrInventoryFields[] = array('name' => $field['lbl']->Name.':', 'value' => $field['lbl']->Render(false).$field['input']->RenderWithError(false));
					}
				//	}				
				//}// Display Custom Field in Create Mode if the role has "Edit" access or is it required
				//elseif($field['blnEdit'] || $field['blnRequired']){
				//	$arrInventoryFields[] = array('name' => $field['lbl']->Name.':', 'value' => $field['lbl']->Render(false).$field['input']->RenderWithError(false));
			//	}			
		}
	}
	
	// Show quantity and metadata if this is not a new inventory model
	if ($this->blnEditMode) {
		$arrInventoryFields[] = array('name' => 'Quantity:', 'value' => $this->lblTotalQuantity->Render(false));
		$arrInventoryFields[] = array('name' => 'Date Created:', 'value' => $this->lblCreationDate->Render(false));
		$arrInventoryFields[] = array('name' => 'Date Modified:', 'value' => $this->lblModifiedDate->Render(false));			
	}

?>


<div class="title">Inventory: <?php $this->lblHeaderInventoryModelCode->Render(); ?> </div>
<table class="datagrid" cellpadding="5" cellspacing="0" border="0" >
	<tr>
		<td class="record_header">
			<?php 
				$this->btnEdit->Render();
				$this->btnSave->RenderWithError();
				echo('&nbsp;');
				$this->atcAttach->RenderWithError();
				echo('&nbsp;');
				$this->btnCancel->RenderWithError();
				$this->btnDelete->RenderWithError();
			?>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="vertical-align:top;">
						<table cellpadding="0" cellspacing="0">
						<?php
							if(isset($arrInventoryFields)){
								for ($i=0;$i<ceil(count($arrInventoryFields)/2);$i++) {
									echo('<tr>');
									echo('<td class="record_field_name">'. $arrInventoryFields[$i]['name'] .'&nbsp;</td>');
									echo('<td class="record_field_value">'. $arrInventoryFields[$i]['value'] .'&nbsp;</td>');
									echo('</tr>');
								}
							}
						?>
						</table>
					</td>
					<td style="vertical-align:top;">
						<table cellpadding="0" cellspacing="0">
						<?php
							if(isset($arrInventoryFields)){
								for ($i=ceil(count($arrInventoryFields)/2);$i<count($arrInventoryFields);$i++) {
									echo('<tr>');
									echo('<td class="record_field_name">'. $arrInventoryFields[$i]['name'] .'&nbsp;</td>');
									echo('<td class="record_field_value">'. $arrInventoryFields[$i]['value'] .'&nbsp;</td>');
									echo('</tr>');
								}
							}
						?>				
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="../js/ajaxfileupload.js"></script>
<script type="text/javascript" src="../js/jquery.tabs.min.js"></script>
<script type="text/javascript" src="../js/jquery.multiselect2side.js"></script>

<link rel="stylesheet" href="../css/jquery.tabs.css" type="text/css" media="print, projection, screen">
<link rel="stylesheet" href="../css/jquery.multiselect2side.css" type="text/css">

<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="../css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
<?php
//var_dump(QApplication::$objUserAccount->UserAccountId);
/*
CREATE TABLE `tracmor`.`description` (
	`sku` VARCHAR( 50 ) NOT NULL ,
	`english` TEXT NOT NULL ,
	`french` TEXT NOT NULL ,
	`germany` TEXT NOT NULL ,
	PRIMARY KEY ( `sku` )
) ENGINE = MYISAM
*/
if(!empty($_GET['intInventoryModelId'])){
	$sql = "select inventory_model_code,manufacturer_id from inventory_model where inventory_model_id = '".$_GET['intInventoryModelId']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$sku = $row['inventory_model_code'];
	$manufacturer_id = array(0 => $row['manufacturer_id']);
	
	$sql = "select * from description where sku = '".$sku."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	$sql_1 = "select custom_field_value_id from custom_field_value where custom_field_id = 10 and short_description = 'active'";
	$result_1 = mysql_query($sql_1);
	$row_1 = mysql_fetch_assoc($result_1);
	$custom_field_value_id = $row_1['custom_field_value_id'];
	
	$sql_2 = "select count(*) as num from custom_field_selection where entity_qtype_id = 2 and custom_field_value_id = ".$custom_field_value_id." and entity_id = ".$_GET['intInventoryModelId'];
	$result_2 = mysql_query($sql_2);
	$row_2 = mysql_fetch_assoc($result_2);
	$active = $row_2['num'];
	
	/*
	CREATE TABLE `sku_manufacturer` (
	`sku` VARCHAR( 20 ) NOT NULL ,
	`manufacturer_id` INT NOT NULL ,
	INDEX ( `sku` , `manufacturer_id` )
	)
	*/
	
	$sql_3 = "select count(*) as num from sku_manufacturer where sku = '".$sku."'";
	$result_3 = mysql_query($sql_3);
	$row_3 = mysql_fetch_assoc($result_3);
	
	if($row_3['num'] > 0){
		$manufacturer_id = array();
		$sql_3 = "select manufacturer_id from sku_manufacturer where sku = '".$sku."'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_assoc($result_3)){
			$manufacturer_id[] = $row_3['manufacturer_id'];
		}
	}
	
	$sql_4 = "select manufacturer_id,short_description from manufacturer";
	$result_4 = mysql_query($sql_4);
	$manufacturer_option = "";
	$i = 0;
	while($row_4 = mysql_fetch_assoc($result_4)){
		if(in_array($row_4['manufacturer_id'], $manufacturer_id)){
			$manufacturer_option .= '<option selected="" value="'.$row_4['manufacturer_id'].'">'.$row_4['short_description'].'</option>';
		}else{
			$manufacturer_option .= '<option value="'.$row_4['manufacturer_id'].'">'.$row_4['short_description'].'</option>';
		}
		$i++;
	}
	
	$manufacturer_select  = '<select multiple="multiple" id="manufacturer" name="sku_manufacturer[]" size="'.$i.'">';
	$manufacturer_select  .= $manufacturer_option;
	$manufacturer_select  .= '</select>';
?>

<script type="text/javascript">
	$().ready(function() {
		$('#manufacturer').multiselect2side({moveOptions: false});
	});
	
	function updateManufacturer(){
		//alert($("#manufacturer").val());
		var manufacturer;
		if($.isArray($("#manufacturer").val())){
			var xx = $("#manufacturer").val();
			//alert(xx);
			$.each(xx, function(index, value) {
					manufacturer += value + ",";
			});
			manufacturer = manufacturer.substring(9, manufacturer.length - 1);
		}else{
			manufacturer = $("#manufacturer").val();
		}
		$.post("/inventory/service.php?action=updateManufacturer",
		       {
				sku     : $("#c19").val(),
				manufacturer : manufacturer
		       },
			function(data){
				//alert(data.msg);
			}, "json"
		);
		       
		return false;
	}
</script>

<!--
<div id="Suppliers" style="text-align: left; border: dotted; height: 200px;">
	<h2>Suppliers</h2>
	<div style="font-size: 12px; position: relative;"><div style="float: left;">Suppliers List</div><div style="position: absolute; float: left; left: 320px; color: green;">SKU Suppliers</div></div>
	<?=$manufacturer_select?>
	<div style="float: none;">
	<button onclick="return updateManufacturer();">Update Manufacturer</button>
	</div>
</div>
-->
<script type="text/javascript">
	function updateDescription(){

		$.post("/inventory/service.php?action=updateSkuDescription",
		       {
				sku     : $("#c19").val(),
				english : e.getData(),
				french  : f.getData(),
				germany : g.getData()
		       },
			function(data){
		    	//console.log(data);
				alert(data.msg);
				//msg += data.msg;
				
		    	$.post("/eBayListing/service.php?action=updateSkuDescription",
		 		       {
		 				sku     : $("#c19").val(),
		 				english : e.getData(),
		 				french  : f.getData(),
		 				germany : g.getData()
		 		       },
		 			function(data){
		 				//console.log(data);
		 		    	//msg += data.msg;
		 		    	alert(data.msg);
		 			}, "json"
		 		);
			}, "json"
		);

		return false;
	}
</script>	
<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
<br><br>
<div id="description-tabs" style="text-align: left; border: dotted;">
	<ul>
	    <li><a href="#fragment-1"><span>English</span></a></li>
	    <li><a href="#fragment-2"><span>French</span></a></li>
	    <li><a href="#fragment-3"><span>Germany</span></a></li>
	</ul>
	<div id="fragment-1">
		<textarea id="english" rows="40" cols="120"><?=html_entity_decode($row['english'], ENT_QUOTES)?></textarea>
	</div>
	<div id="fragment-2">
		<textarea id="french" rows="40" cols="120"><?=html_entity_decode($row['french'], ENT_QUOTES)?></textarea>
	</div>
	<div id="fragment-3">
		<textarea id="germany" rows="40" cols="120"><?=html_entity_decode($row['germany'], ENT_QUOTES)?></textarea>
	</div>
	<?php if($active == 0){?>
	<button onclick="return updateDescription();">Update Description</button>
	<?php }?>
</div>
<br>
<br>
<script type="text/javascript">
	var e = CKEDITOR.replace( 'english' );
	var f = CKEDITOR.replace( 'french' );
	var g = CKEDITOR.replace( 'germany' );
	$('#description-tabs').tabs();
</script>
<?php
}
?>	
<div id="image-panel" style="position:relative; display: none;">
	<script type="text/javascript">
		/*
		$("#c17").bind("blur", function(e){
			alert($("#c17").val());
			$.post("doajaxfileupload.php", { categoryId: $("#c17").val(), inventoryCode: $("#c19").val() } );
		});
			
		$("#c19").bind("blur", function(e){
			alert($("#c19").val());
			$.post("doajaxfileupload.php", { categoryId: $("#c17").val(), inventoryCode: $("#c19").val() } );
		});
		*/
		$("#c17").blur(function(){
			//alert($("#c17").val());
			$.post("doajaxfileupload.php", { categoryId: $("#c17").val(), inventoryCode: $("#c19").val() } );
		});
		
		$("#c19").blur(function(){
			//alert($("#c19").val());
			$.post("doajaxfileupload.php", { categoryId: $("#c17").val(), inventoryCode: $("#c19").val() } );
		});
		
		function ajaxFileUpload()
		{
			$("#loading")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});
	
			$.ajaxFileUpload
			(
				{
					url:'doajaxfileupload.php?categoryId=<?=$this->lstCategory->SelectedValue?>&inventoryCode=<?=$this->txtInventoryModelCode->Text?>',
					secureuri:false,
					fileElementId:'fileToUpload',
					dataType: 'json',
					success: function (data, status)
					{
						document.getElementById("inventory-image").src = data.imagePath;
					},
					error: function (data, status, e)
					{
						alert(e);
					}
				}
			)
			
			return false;
	
		}
	</script>	
	<form name="form" action="" method="POST" enctype="multipart/form-data">
		<input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"><br>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:32px">Upload Image</button>
	</form>
	<img id="loading" src="../images/loading.gif" style="display:none;">
	<div style="position:absolute;right:300px;top:0px">
		<img style="width:150px;height:100px" id="inventory-image" src="../inventory_images/<?=$this->lstCategory->SelectedValue?>/<?=$this->txtInventoryModelCode->Text?>.jpg"/>
	</div>
</div>
<?php 
if(!empty($_GET['intInventoryModelId'])){
?>
<div id="combo-panel" style="border: dotted;">
	<h2>Combo</h2>
	<div id="add-combo-panel">
		<form >
			SKU: <input type="text" id="attachment"/>
			Quantity: <input type="text" id="quantity"/>
			<input id="add-combo" type="button" value="Add"/>
		</form>
	</div>
	<script type="text/javascript">
		$("#add-combo").click(function(){
			$.post("/inventory/service.php?action=addSKuCombo", { sku: '<?=$sku?>', attachment: $("#attachment").val(), quantity: $("#quantity").val() },
				function(data){
				$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			} );
		})
		
		function deleteSkuCombo(id){
			$.post("/inventory/service.php?action=deleteSkuCombo", { id: id},
				function(data){
				$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			} );
		}
	</script>
	<div id="combo-list-panel">
	<table border=1>
		<tr>
			<th>
				SKU
			</th>
			<th>
				Quantity
			</th>
			<th>
				Stock
			</th>
			<th>
				Operate
			</th>
		</tr>
	<?php
	mysql_query("SET NAMES 'UTF8'");
	$sql = "select id,sku,attachment,quantity from combo where sku = '".@$sku."'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$sku = $row['attachment'];
		$quantity = $row['quantity'];
		
		//get sku model id
		$sql_1 = "select inventory_model_id from inventory_model where inventory_model_code='".$row['attachment']."'";
		//echo $sql;
		//echo "<br>";
		$result_1 = mysql_query($sql_1);
		$row_1 = mysql_fetch_assoc($result_1);
		$inventory_model_id = $row_1['inventory_model_id'];
		
		//get sku location
		$sql_2 = "select quantity from inventory_location where inventory_model_id = '".$inventory_model_id."'";// and quantity > ".$quantity."";
		//echo $sql;
		//echo "<br>";
		$result_2 = mysql_query($sql_2);
		$row_2 = mysql_fetch_assoc($result_2);
		$stock = $row_2['quantity'];
		echo "<tr>";
		echo "<td>".$sku."</td>";
		echo "<td>".$quantity."</td>";
		echo "<td>".$stock."</td>";
		echo "<td><input type='button' value='Delete' onClick='deleteSkuCombo(".$row['id'].")'/></td>";
		echo "</tr>";
	}
	?>
	</table>
	</div>
</div>
<br><br>
<div id="complaints-panel" style="border: dotted;">
	<h2>Complaints</h2>
	<table border=1>
		<tr>
			<th>
				Content
			</th>
			<th>
				Time
			</th>
		</tr>
	<?php
		$sql = "select content,time from complaints where sku = '".@$sku."'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>".$row['content']."</td>";
			echo "<td>".$row['time']."</td>";
			echo "</tr>";
		}
	?>
	</table>
</div>
<br><br>
<div id="purchase-panel" style="border: dotted;">
	<h2>Purchase In The Way</h2>
	<div id="add-purchase-panel">
		<form >
			Quantity: <input type="text" id="purchase-quantity"/>
			<input id="add-purchase" type="button" value="Add Quantity"/>
		</form>
	</div>
	<div id="purchase-list-panel">
		<table border=1>
			<tr>
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
				$sql = "select * from sku_purchase where sku = '".@$sku."' order by id desc";
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
				$.post("/inventory/service.php?action=addSKuPurchase", { sku: '<?=$sku?>', by: '<?=QApplication::$objUserAccount->Username?>', quantity: $("#purchase-quantity").val() },
					function(data){
					$('#purchase-list-panel').load('/inventory/service.php?action=getSKuPurchaseList&sku=<?=$sku?>');		
				} );
			})
			
			function skuPurchaseStoring(id){
				$.post("/inventory/service.php?action=skuPurchaseStoring", { id: id, byId: '<?=QApplication::$objUserAccount->UserAccountId?>', byName: '<?=QApplication::$objUserAccount->Username?>'},
					function(data){
					//$('#purchase-list-panel').load('/inventory/service.php?action=getSKuPurchaseList&sku=<?=$sku?>');				
					window.location.reload(); 
				} );
			}
			
			function skuPurchaseCancel(id){
				$.post("/inventory/service.php?action=skuPurchaseCancel", { id: id, by: '<?=QApplication::$objUserAccount->Username?>'},
					function(data){
					$('#purchase-list-panel').load('/inventory/service.php?action=getSKuPurchaseList&sku=<?=$sku?>');				
				} );
			}
		</script>
	</div>
</div>
<?php
}
$this->pnlAttachments->Render();
?>

<br class="item_divider">

<?php 
		if ($this->blnEditMode) {
			$this->btnMove->Render();
			$this->btnTakeOut->Render();
			$this->btnRestock->Render();
			//$this->btnShip->Render();
			//$this->btnReceive->Render();
			echo '<br class="item_divider />';
			echo '<br class="item_divider />';
			echo('<div class="title">Quantity by Location</div>');
			$this->dtgInventoryQuantities->RenderWithError(); 
			echo '<br class="item_divider" />';
			echo '<div class="title">Transactions</div>';
			$this->dtgInventoryTransaction->RenderWithError();
		}
?>
<br class="item_divider">
<?php
/*
if ($this->blnEditMode) {
	$this->lblShipmentReceipt->Render();
	$this->dtgShipmentReceipt->RenderWithError();
}
*/
?>