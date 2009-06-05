<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/inventory/css/tracmor.css"></link>
		<link rel="stylesheet" type="text/css" media="screen" href="themes/lightness/ui.all.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/ui.jqgrid.css" />

		<script type="text/javascript" src="/inventory/js/_core/_tracmor.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.ui.all.js"></script>
		<script type="text/javascript" src="js/jquery.layout.js"></script>
		<script type="text/javascript" src="js/jqModal.js"></script>
		<script type="text/javascript" src="js/jquery.jqGrid.js"></script>
</head>
	<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
	<table cellspacing="0" cellpadding="0" width="100%" style="background: transparent url(../images/main_header_bg.png) repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
					<tbody><tr style="height: 64px;">
						<td>
							<table cellspacing="0" cellpadding="0">
								<tbody><tr>
									<td style="padding-left: 15px; padding-top: 6px;"><span id="c3_ctl"><span id="c3"><img src="../images/empty.gif"/></span></span></td>
									<td align="right" width="100%" valign="top" style="padding-right: 10px; text-align: right;">  <span id="c2_ctl"><span style="color: rgb(85, 85, 85); font-family: arial; font-size: 12px; font-weight: bold; cursor: pointer;" onclick="qc.pB('InventoryModelListForm', 'c2', 'QClickEvent', '');" id="c2">Sign Out</span></span></td>
								</tr>
							</tbody></table>
						</td>
					</tr>
					<tr>
						<td>
							<table cellspacing="0" cellpadding="0">
								<tbody><tr style="height: 24px;">
									<td style="width: 15px; background-image: url(../images/emptyTabSpace.gif); background-repeat: repeat-x;"><img height="1" width="15" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td><td class="other_tab_middle"><a border="0" class="other_tab_label" href="../inventory/">Inventory</a></td><td class="other_tab_right">
									<img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="current_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td><td class="current_tab_middle"><a class="current_tab_label" href="../admin/miscellaneous.php?type=1">Miscellaneous</a></td><td class="current_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<img height="1" width="12" src="../images/empty.gif"/></td><td class="empty_tab_space"><img height="1" width="1" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td><td class="other_tab_middle"><a class="other_tab_label" href="../admin/category_list.php">Admin</a></td><td class="other_tab_right">
									<img height="1" width="12" src="../images/empty.gif"/></td>
									<td width="100%" class="empty_tab_space"> </td>
								</tr>
							</tbody></table>
						</td>
					</tr>
					<tr style="height: 20px; background-color: rgb(172, 172, 172);">
						<td>
							<table cellspacing="0" cellpadding="0">
								<tbody><tr>
									<td width="100%" style="padding-left: 10px; font-family: arial; color: rgb(255, 255, 255); font-size: 12px; font-weight: bold;">Welcome Admin</td>									<td><span style="display: none;" id="c4_ctl"><div style="padding: 0px 20px 14px 0px;" id="c4"><img height="16" width="16" alt="Please Wait..." src="/inventory/images/spinner_14.gif" class="spinner"/></div></span></td>
									<!--<td><img src="../images/searchSeparator.gif"></td>-->
									<!--<td style="padding-left:5px;padding-right:5px;font-family:arial;color:#FFFFFF;font-size:12px;font-weight:bold;">Search</td>
									<td style="padding-left:5px;padding-right:5px;"><input type="text" style="border:1px solid #000000;font-size:12px;font-family:arial;"></td>
									<td style="padding-right:15px;"><input type="submit" value="Go" style="font-family:arial;font-size:12px;font-weight:bold;"></td>-->
								</tr>
							</tbody></table>
						</td>
					</tr>
					<tr style="height: 1px; background-color: rgb(120, 120, 120);">
						<td/>
					</tr>					
					<!--<tr style="height:20px;background-color:#dddddd">
						<td>
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding-left:10px;font-family:arial;color:#555555;font-size:12px;font-weight:bold;">Last Viewed:</td>
									<td></td>
								</tr>
							</table>
						</td>
					</tr>-->
				</tbody>
        </table>
					
					
	
	
	<table cellspacing="0" cellpadding="0" width="100%">
		<tr style="height:10px">
			<td/>
		</tr>
		<tr>
			<td valign="top">
				<!-- End Header Menu -->
				
				<!-- Begin Shortcut Menu -->
				<span id="c5_ctl"><span id="c5">
							<table cellspacing="0" cellpadding="0" border="0" style="padding-left: 10px;">
								<tbody><tr style="height: 21px;">
									<td style="width: 5px; background-image: url(../images/moduleTab_left.gif);"><img height="1" width="5" src="../images/empty.gif"/></td>
									<td width="150" style="background-image: url(../images/moduleTab_middle.gif); font-family: arial; color: rgb(85, 85, 85); font-size: 12px; font-weight: bold;">Shortcuts</td>
									<td style="background-image: url(../images/moduleTab_middle.gif);"><img height="1" width="90" src="../images/empty.gif"/></td>
									<td style="background-image: url(../images/moduleTab_right.gif);"><img height="1" width="5" src="../images/empty.gif"/></td>
								</tr>
								<tr>
				
									<td style="border-left: 1px solid rgb(170, 170, 170); border-right: 1px solid rgb(170, 170, 170); border-bottom: 1px solid rgb(170, 170, 170); font-family: arial; color: rgb(85, 85, 85); font-size: 12px;" colspan="4">
										<!-- Shortcuts  -->
										<table cellspacing="0" cellpadding="0" align="left" width="100%" style="font-family: arial; color: rgb(85, 85, 85); font-size: 12px; line-height: 1.5;">
											<tbody><tr>
												<td><img height="1" width="30" src="../images/empty.gif"/></td>
												<td style="border-left: 1px solid rgb(204, 204, 204);"/>
											</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut0" src="/inventory/images/icons/weather_lightning.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a class="graylink" href="../admin/miscellaneous.php?type=1">Stock Attention</a></td></tr><tr>
					<td align="center" width="30"><img name="shortcut1" src="/inventory/images/icons/weather_rain.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a class="graylink" href="../admin/miscellaneous.php?type=2">Out Of Stock </a></td></tr><tr>
					<td align="center" width="30"><img name="shortcut2" src="/inventory/images/icons/weather_sun.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a class="graylink" href="../admin/miscellaneous.php?type=3">Top Sales</a></td></tr><tr>
					<td align="center" width="30"><img name="shortcut3" src="/inventory/images/icons/money_yen.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a class="graylink" href="../admin/miscellaneous.php?type=4">Postage By Date</a></td></tr><tr>
				</tr>
					</tbody></table>
									</td>
								</tr>
							</tbody></table></span></span><!-- End Shortcut Menu -->
			</td>
			<td>
				<img width="10" src="../images/empty.gif"/>
			</td>
			<td width="100%" valign="top">
				<div class="title"><?php
					switch($_GET['type']){
						case 1:
							echo "Stock Attention";
							?>
							<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery("#list").jqGrid({ url:'../service.php?action=stockAttention',
											datatype: "json",
											colNames:['Id', 'Model', 'Name', 'Quantity', 'Week Flow'],
											colModel:[ {name:'id',index:'id', width:100}, {name:'model',index:'model', width:100}, {name:'name',index:'name', width:200, sortable:false}, {name:'quantity',index:'quantity', width:100}, {name:'flow',index:'flow', width:100}],
											rowNum:30,
											//rowList:[10,20,30],
											imgpath: "../themes/basic/images",
											pager: jQuery('#pager'),
											sortname: 'quantity',
											viewrecords: true,
											sortorder: "asc",
											caption:"Stock Attention" }
											).navGrid('#pager',{search:false,edit:false,add:false,del:false}); 
							})
							</script>
							<?php
						break;
					
						case 2:
							echo "Out Of Stock";
							?>
							<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery("#list").jqGrid({ url:'../service.php?action=outOfStock',
											datatype: "json",
											colNames:['Id', 'Model', 'Name', 'Quantity'],
											colModel:[ {name:'id',index:'id', width:100}, {name:'model',index:'model', width:100}, {name:'name',index:'name', width:200, sortable:false}, {name:'quantity',index:'quantity', width:100}],
											rowNum:30,
											//rowList:[10,20,30],
											imgpath: "../themes/basic/images",
											pager: jQuery('#pager'),
											sortname: 'quantity',
											viewrecords: true,
											sortorder: "asc",
											caption:"Out Of Stock" }
											).navGrid('#pager',{search:false,edit:false,add:false,del:false}); 
							})
							</script>
							<?php
						break;
					
						case 3:
							echo "Top Sales";
							?>
							<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery("#list").jqGrid({ url:'../service.php?action=topSales',
											datatype: "json",
											colNames:['Id', 'Model', 'Name', 'Quantity', 'Time'],
											colModel:[ {name:'id',index:'id', width:60}, {name:'model',index:'model', width:100}, {name:'name',index:'name', width:200, sortable:false}, {name:'quantity',index:'quantity', width:100}, {name:'time',index:'time', width:120}],
											rowNum:30,
											imgpath: "../themes/basic/images",
											pager: jQuery('#pager'),
											sortname: 'quantity',
											viewrecords: true,
											sortorder: "desc",
											caption:"Top Sales" }
											).navGrid('#pager',{search:false,edit:false,add:false,del:false}); 
							})
							</script>
							<?php
						break;
					}
				
				?></div>
				<br class="item_divider"/>
				<table id="list" class="scroll" cellpadding="0" cellspacing="0"></table>
				<div id="pager" class="scroll" style="text-align:center;"></div>
				<?php
					if($_GET['type'] == 4){
				?>
				<div id="postage-by-date">
					<script type="text/javascript">
						jQuery(document).ready(function(){
							$('#start_datepicker').datepicker({
								dateFormat: 'yy-mm-dd'
							});
							
							$('#end_datepicker').datepicker({
								dateFormat: 'yy-mm-dd',
								//inline: true,
								onSelect: function(dateText) {
									var start_date = $("#start_datepicker").val();
									var end_date = dateText;
									$.ajax({
										type: "Get",
										url: "../service.php?action=totalPostageByDate&start_date="+start_date+"&end_date="+end_date,
										data: "date="+dateText,
										success: function(msg){
											//console.log($('#start_datepicker'));
											
											msg = "From " + start_date + " to <br>" + end_date + " total postage: "+msg+"<br>*************************<br>";
										  	$("#total-postage").append(msg);
											jQuery("#postage-list").clearGridData();
											jQuery("#postage-list").setGridParam( {url: '../service.php?action=postageByDate&start_date='+start_date+'&end_date='+end_date}); 
											jQuery("#postage-list").trigger("reloadGrid");
										}
									});
								}
				
							});
							
							var shipmentMethodFmatter = function(el, cellval, opts){
								switch(cellval){
									case "B":
										$(el).html("Bulk");
									break;
								
									case "S":
										$(el).html("SpeedPost");
									break;
								
									case "R":
										$(el).html("Registered");
									break;
								
									case "U":
										$(el).html("UPS");
									break;
								}
								
							}
							
							jQuery("#postage-list").jqGrid({ url:'../service.php?action=postageByDate',
												datatype: "json",
												colNames:['Model', 'Quantity', 'Shipment Method', 'Shipment Fee'],
												colModel:[ {name:'model',index:'model', align:"center", width:120}, {name:'quantity',index:'quantity', align:"center", width:100}, {name:'shipment_method',index:'shipment_method', align:"center", width:150, formatter:shipmentMethodFmatter, sortable:false}, {name:'shipment_fee',index:'shipment_fee', width:100}],
												rowNum:30,
												imgpath: "../themes/basic/images",
												pager: jQuery('#postage-pager'),
												sortname: 'inventory_model_code',
												viewrecords: true,
												sortorder: "asc",
												caption:"Shipment History" }
											).navGrid('#postage-pager',{search:false,edit:false,add:false,del:false}); 
						})
					</script>
					<div style="position:relative">
						<div style="float:left;position:">
							<p>Start Date: <input type="text" id="start_datepicker"></p>
							<p>End   Date: <input type="text" id="end_datepicker"></p>
						</div>
						<div id="total-postage" style="float:left;padding-left:30px;left:200px;position:absolute"></div>
						<div id="list002" style="float:left;position:absolute;left:450px;top:0px">
							<table id="postage-list" class="scroll" cellpadding="0" cellspacing="0"></table>
							<div id="postage-pager" class="scroll" style="text-align:center;"></div>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</td>
		</tr>
	</table>
	
	
	</body>

</html>