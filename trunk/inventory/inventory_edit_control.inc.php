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
<link rel="stylesheet" href="../css/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="../css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
<?php
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
	$sql = "select inventory_model_code from inventory_model where inventory_model_id = '".$_GET['intInventoryModelId']."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$sku = $row['inventory_model_code'];
	
	$sql = "select * from description where sku = '".$sku."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

?>
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
<div id="description-tabs" style="text-align: left;">
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
	<button onclick="return updateDescription();">Update Description</button>
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
<div id="image-panel" style="position:relative;">
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