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
	$arrInventoryFields[] = array('name' => QApplication::Translate('Short Description').':',  'value' => $this->lblShortDescription->Render(false) . $this->txtShortDescription->RenderWithError(false));
	$arrInventoryFields[] = array('name' => QApplication::Translate('Category').':', 'value' => $this->lblCategory->Render(false) . $this->lstCategory->RenderWithError(false));
	$arrInventoryFields[] = array('name' => QApplication::Translate('Manufacturer').':', 'value' => $this->lblManufacturer->Render(false) . $this->lstManufacturer->RenderWithError(false));
	$arrInventoryFields[] = array('name' => QApplication::Translate('Inventory Code').':', 'value' => $this->lblInventoryModelCode->Render(false) . $this->txtInventoryModelCode->RenderWithError(false));
	$arrInventoryFields[] = array('name' => QApplication::Translate('Long Description').':', 'value' => $this->pnlLongDescription->Render(false) . $this->txtLongDescription->RenderWithError(false));
	
	// Custom Fields
	if ($this->arrCustomFields) {
		foreach ($this->arrCustomFields as $field) {
			//if ($this->blnEditMode) {
				//Display Custom Field in Edit Mode if the role has "View" access 
				//	if(($field['blnView'])){
					if(!$this->blnEditMode || $field['blnView']){
						$arrInventoryFields[] = array('name' => QApplication::Translate($field['lbl']->Name).':', 'value' => $field['lbl']->Render(false).$field['input']->RenderWithError(false));
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
		$arrInventoryFields[] = array('name' => QApplication::Translate('Quantity').':', 'value' => $this->lblTotalQuantity->Render(false));
		$arrInventoryFields[] = array('name' => QApplication::Translate('Date Created').':', 'value' => $this->lblCreationDate->Render(false));
		$arrInventoryFields[] = array('name' => QApplication::Translate('Date Modified').':', 'value' => $this->lblModifiedDate->Render(false));			
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
<style>
.manage-block{
	text-align: left; 
	border: solid #98BF21;
	position: relative;
}
</style>
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
	//mysql_query("SET NAMES 'latin1'");
	mysql_query("CHARACTER SET 'latin1'");
	
	$sql = "select inventory_model_code from inventory_model where inventory_model_id = '".$_GET['intInventoryModelId']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$sku = $row['inventory_model_code'];
	
	$role = array();
	$sql = "select role_id,short_description from role";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$role[$row['role_id']] = $row['short_description'];
	}
	
	$role_1 = array('Administrator', 'PPMC');
	$role_2 = array('Administrator');
	
	$sql = "select role_id from user_account where user_account_id = ".$_SESSION['intUserAccountId'];
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$currency_user_role = $role[$row['role_id']];
	
	/*
	CREATE TABLE `sku_manufacturer` (
	`sku` VARCHAR( 20 ) NOT NULL ,
	`manufacturer_id` INT NOT NULL ,
	INDEX ( `sku` , `manufacturer_id` )
	)
	
	CREATE TABLE `suppliers` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`name` VARCHAR( 255 ) NOT NULL ,
	`description` TEXT NOT NULL ,
	`created_by` INT NOT NULL ,
	`creation_date` DATETIME NOT NULL ,
	`modified_by` INT NOT NULL ,
	`modified_date` DATETIME NOT NULL
	) 
	
	CREATE TABLE `sku_suppliers` (
	`sku` VARCHAR( 20 ) NOT NULL ,
	`suppliers_id` INT NOT NULL ,
	`modified_by` INT NOT NULL ,
	`modified_date` DATETIME NOT NULL ,
	INDEX ( `sku` , `suppliers_id` )
	) 
	
	ALTER TABLE `sku_purchase` ADD `suppliers_id` INT NOT NULL AFTER `quantity` ;
	ALTER TABLE `sku_purchase` ADD INDEX ( `suppliers_id` );
 
	$sql = "select inventory_model_code,manufacturer_id from inventory_model where inventory_model_id = '".$_GET['intInventoryModelId']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$sku = $row['inventory_model_code'];
	$manufacturer_id = array(0 => $row['manufacturer_id']);
	
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
	*/
	
	
		$suppliers_id = array();
		$sql_3 = "select suppliers_id from sku_suppliers where sku = '".$sku."'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_assoc($result_3)){
			$suppliers_id[] = $row_3['suppliers_id'];
		}
		
		$sql_4 = "select id,name from suppliers";
		$result_4 = mysql_query($sql_4);
		$suppliers_option = "";
		$i = 0;
		while($row_4 = mysql_fetch_assoc($result_4)){
			if(in_array($row_4['id'], $suppliers_id)){
				$suppliers_option .= '<option selected="" value="'.$row_4['id'].'">'.$row_4['name'].'</option>';
			}else{
				$suppliers_option .= '<option value="'.$row_4['id'].'">'.$row_4['name'].'</option>';
			}
			$i++;
		}
		
		$suppliers_select  = '<select multiple="multiple" id="suppliers" name="sku_suppliers[]" size="'.$i.'">';
		$suppliers_select  .= $suppliers_option;
		$suppliers_select  .= '</select>';
?>
<!-- 
<br><br>
<div id="Suppliers" style="text-align: left; border: dotted; height: 860px; position: relative;">
	<script type="text/javascript">
		$().ready(function() {
			$('#suppliers').multiselect2side({moveOptions: false});
		});
		
		function updateSuppliers(){
			//alert($("#manufacturer").val());
			var suppliers;
			if($.isArray($("#suppliers").val())){
				var xx = $("#suppliers").val();
				//alert(xx);
				$.each(xx, function(index, value) {
					suppliers += value + ",";
				});
				suppliers = suppliers.substring(9, suppliers.length - 1);
			}else{
				suppliers = $("#suppliers").val();
			}
			$.post("/inventory/service.php?action=updateSuppliers",
			       {
					sku     : $("#c19").val(),
					suppliers : suppliers
			       },
				function(data){
					//alert(data.msg);
				}, "json"
			);
			       
			return false;
		}
	</script>
	<h2>Suppliers</h2>
	<div style="font-size: 12px; position: relative;"><div style="float: left; color: blue;">Suppliers List</div><div style="position: absolute; float: left; left: 320px; color: green;">SKU Suppliers</div></div>
	<?=$suppliers_select?>
	<div style="float: none;">
	<button style="position: absolute; top: 10px; left: 100px;" onclick="return updateSuppliers();">Update Suppliers</button>
	</div>
</div>
 -->
 <br><br>
 <div id="image-panel" class="manage-block">
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
	<h2><?=QApplication::Translate('Image Manage')?></h2>
	<form name="form" action="" method="POST" enctype="multipart/form-data">
		<input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"><br>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:32px"><?=QApplication::Translate('Upload Image')?></button>
	</form>
	<img id="loading" src="../images/loading.gif" style="display:none;">
	<div style="position:absolute;right:300px;top:0px">
		<a href="../inventory_images/<?=substr($this->txtInventoryModelCode->Text, 0, 2)?>/<?=$this->txtInventoryModelCode->Text?>.jpg"><img border=0 style="width:150px;height:100px" id="inventory-image" src="../inventory_images/<?=substr($this->txtInventoryModelCode->Text, 0, 2)?>/<?=$this->txtInventoryModelCode->Text?>.jpg"/></a>
	</div>
</div>
<br><br>
<?php
if(in_array($currency_user_role, $role_1)){
?>
<div id="purchaser-panel" class="manage-block">
	<script type="text/javascript">
		function save_purchaser(){
			$.post("/inventory/service.php?action=savePurchaser", { sku: '<?=$sku?>', purchaser_id: $("#purchaser_id").val()},
				function(data){
				window.location.reload();
				//$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			});
		}
	</script>
	<h2><?=QApplication::Translate('Purchaser Manage')?></h2>
	<?php
	$sql = "select purchaser_id from sku_purchaser where sku = '".$sku."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$purchaser_id = $row['purchaser_id'];
	
	$purchaser = "";
	$sql = "select user_account_id,username from user_account";
	$result = mysql_query($sql);
	$purchaser .= '<select id="purchaser_id">';
	while($row = mysql_fetch_assoc($result)){
		$purchaser .= '<option value="'.$row['user_account_id'].'"'.($purchaser_id == $row['user_account_id']?' selected="selected"':'').'>'.$row['username'].'</option>';
	}
	$purchaser .= '</select>';
	echo $purchaser;
	?>
	<input type='button' value='<?=QApplication::Translate('Save')?>' onClick='save_purchaser()'/>
</div>
<br><br>
<div id="vendors-panel" class="manage-block">
	<script type="text/javascript">
		function add_sku_company_contact_price(){
			$.post("/inventory/service.php?action=addSkuCompanyContactPrice", { sku: '<?=$sku?>', vendors_id: $("#vendors_id").val(), contact_id: $("#contact_id").val(), purchase_price: $("#purchase_price").val() },
				function(data){
				window.location.reload();	
				//$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			});
		}
		
		function delete_sku_company_contact_price(id){
			$.post("/inventory/service.php?action=deleteSkuCompanyContactPrice", { id: id},
				function(data){
				window.location.reload();	
				//$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			});
		}
		
		function set_default_sku_company_contact(id, sku){
			$.post("/inventory/service.php?action=setDefaultSkuCompanyContact", { id: id, sku: sku},
				function(data){
					if(data == 2){
						alert("已经设置默认供应商,请取消默认供应商!");
					}else{
						window.location.reload();	
					}
				
				//$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			});
		}
		
		function cancel_default_sku_company_contact(id, sku){
			$.post("/inventory/service.php?action=cancelDefaultSkuCompanyContact", { id: id, sku: sku},
				function(data){
					window.location.reload();	
				//$('#combo-list-panel').load('/inventory/service.php?action=getSKuComboList&sku=<?=$sku?>');		
			});
		}
		
		$(document).ready(function() {
			$('#vendors_id').change(function() {
				$.getJSON('../service.php?action=getContactByCompany&company_id='+this.value, function(data) {
					$('#contact_id').empty();
					$.each(data, function(key, value){
						$('#contact_id').
						append($("<option></option>").
							attr("value", value.id).
							text(value.name));
					})

				});

			});
		});
	</script>
	<h2><?=QApplication::Translate('Vendors Manage')?></h2>
	<?php
	$company = QApplication::Translate('Company').": ";
	$sql = "select * from company";
	$result = mysql_query($sql);
	$company .= '<select id="vendors_id">';
	while($row = mysql_fetch_assoc($result)){
		$company_array[$row['company_id']] = $row['short_description'];
		$company .= '<option value="'.$row['company_id'].'">'.$row['short_description'].'</option>';
	}
	$company .= '</select>';
	echo $company;
	
	$contact = "&nbsp;&nbsp;".QApplication::Translate('Contact').": ";
	$contact .= '<select id="contact_id">
		</select>';
	
	$sql = "select * from contact";
	$result = mysql_query($sql);
	//$contact .= '<select id="contact_id">';
	while($row = mysql_fetch_assoc($result)){
		$contact_array[$row['contact_id']] = $row['first_name'].$row['last_name'];
		//$contact .= '<option value="'.$row['contact_id'].'">'.$row['first_name'].$row['last_name'].'</option>';
	}
	//$contact .= '</select>';
	
	echo $contact;
	?>
	&nbsp;&nbsp;<?=QApplication::Translate('Purchase Price')?>: <input id="purchase_price" name="purchase_price" type="text" style="width: 100px;"/>
	<input type='button' value='<?=QApplication::Translate('Add')?>' onClick='add_sku_company_contact_price()'/>
	<?php
	$sql = "select * from sku_company_contact_price where sku = '".$sku."'";
	$result = mysql_query($sql);
	$vendors_table = "";
	while($row = mysql_fetch_assoc($result)){
		$vendors_table .= "<tr>";
		$vendors_table .= "<td>";
		$vendors_table .= $row['default']==1?'<font color="red">'.QApplication::Translate('Y').'</font>':QApplication::Translate('N');
		$vendors_table .= "</td>";
		$vendors_table .= "<td>";
		$vendors_table .= $company_array[$row['company_id']];
		$vendors_table .= "</td>";
		$vendors_table .= "<td>";
		$vendors_table .= @$contact_array[$row['contact_id']];
		$vendors_table .= "</td>";
		$vendors_table .= "<td>";
		$vendors_table .= $row['purchase_price'];
		$vendors_table .= "</td>";
		$vendors_table .= "<td>";
		$vendors_table .= $row['created_by'];
		$vendors_table .= "</td>";
		$vendors_table .= "<td>";
		$vendors_table .= "<input type='button' value='".QApplication::Translate('Set Default')."' onClick='set_default_sku_company_contact(".$row['id'].", \"".$row['sku']."\")'> | <input type='button' value='".QApplication::Translate('Cancel Default')."' onClick='cancel_default_sku_company_contact(".$row['id'].", \"".$row['sku']."\")'> | <input type='button' value='".QApplication::Translate('Delete')."' onClick='delete_sku_company_contact_price(".$row['id'].")'>";
		$vendors_table .= "</td>";
		$vendors_table .= "</tr>";
	}
	?>
	<div id="vendors-price-list">
		<table border=1>
			<tr><th><?=QApplication::Translate('Default')?></th><th><?=QApplication::Translate('Company')?></th><th><?=QApplication::Translate('Contact')?></th><th><?=QApplication::Translate('Purchase Price')?></th><th><?=QApplication::Translate('Created By')?></th><th><?=QApplication::Translate('Operate')?></th></tr>
			<?=$vendors_table?>
		</table>
	</div>
</div>
<?php
}
mysql_query("SET NAMES 'UTF8'");
$sql = "select * from description where sku = '".$sku."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

?>
<br><br>
<div id="description-tabs" class="manage-block">
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
	<h2><?=QApplication::Translate('Description Manage')?></h2>
	<ul>
	    <li><a href="#fragment-1"><span><?=QApplication::Translate('English')?></span></a></li>
	    <li><a href="#fragment-2"><span><?=QApplication::Translate('French')?></span></a></li>
	    <li><a href="#fragment-3"><span><?=QApplication::Translate('Germany')?></span></a></li>
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
	<?php
	$sql_1 = "select custom_field_value_id from custom_field_value where custom_field_id = 10 and short_description = 'active'";
	$result_1 = mysql_query($sql_1);
	$row_1 = mysql_fetch_assoc($result_1);
	$custom_field_value_id = $row_1['custom_field_value_id'];
	
	$sql_2 = "select count(*) as num from custom_field_selection where entity_qtype_id = 2 and custom_field_value_id = ".$custom_field_value_id." and entity_id = ".$_GET['intInventoryModelId'];
	$result_2 = mysql_query($sql_2);
	$row_2 = mysql_fetch_assoc($result_2);
	$active = $row_2['num'];
	
	//var_dump($currency_user_role);
	//var_dump($role_2);
	if($active == 0 || in_array($currency_user_role, $role_2)){?>
	<button onclick="return updateDescription();"><?=QApplication::Translate('Save')?></button>
	<?php }?>
	
	<script type="text/javascript">
		var e = CKEDITOR.replace( 'english' );
		var f = CKEDITOR.replace( 'french' );
		var g = CKEDITOR.replace( 'germany' );
		$('#description-tabs').tabs();
	</script>
</div>
<br><br>

<div id="combo-panel" class="manage-block">
	<h2><?=QApplication::Translate('Combo')?></h2>
	<div id="add-combo-panel">
		<form >
			SKU: <input type="text" id="attachment"/>
			<?=QApplication::Translate('Quantity')?>: <input type="text" id="quantity"/>
			<input id="add-combo" type="button" value="<?=QApplication::Translate('Add')?>"/>
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
				<?=QApplication::Translate('Quantity')?>
			</th>
			<th>
				<?=QApplication::Translate('Stock')?>
			</th>
			<th>
				<?=QApplication::Translate('Operate')?>
			</th>
		</tr>
	<?php
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

<div id="complaints-panel" class="manage-block">
	<h2><?=QApplication::Translate('Complaints')?></h2>
	<table border=1>
		<tr>
			<th>
				<?=QApplication::Translate('Content')?>
			</th>
			<th>
				<?=QApplication::Translate('Time')?>
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

<!--
<div id="purchase-panel" class="manage-block">
	<h2><?=QApplication::Translate('Purchase In The Way')?></h2>
	<div id="add-purchase-panel">
		<form >
			Quantity: <input type="text" id="purchase-quantity"/>
			<input id="add-purchase" type="button" value="Add Quantity"/>
		</form>
	</div>
	<?php
	$content = "";
	$sql = "select vendors_id,contact_id,sku_price,sku_purchase_qty,expected_arrival_date from purchase_orders where sku = '".$sku."' and purchase_status = '6'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$content .= "<tr>";
		$content .= "<td>".$company_array[$row['vendors_id']]."</td>";
		$content .= "<td>".$contact_array[$row['contact_id']]."</td>";
		$content .= "<td>".$row['sku_price']."</td>";
		$content .= "<td>".$row['sku_purchase_qty']."</td>";
		$content .= "<td>".$row['expected_arrival_date']."</td>";
		$content .= "</tr>";
	}
	?>
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
-->
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
			echo('<div class="title">'.QApplication::Translate('Quantity by Location').'</div>');
			$this->dtgInventoryQuantities->RenderWithError(); 
			echo '<br class="item_divider" />';
			echo '<div class="title">'.QApplication::Translate('Transactions').'</div>';
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