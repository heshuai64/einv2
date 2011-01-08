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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/inventory/css/tracmor.css"></link>
		<link rel="stylesheet" type="text/css" href="../resources/css/ext-all.css" />
		<link rel="stylesheet" type="text/css" href="../resources/css/xtheme-gray.css" />
		<link rel="stylesheet" type="text/css" href="fileuploadfield.css"/>
	    <!-- GC -->
	 	<!-- LIBS -->
	 	<script type="text/javascript" src="../adapter/ext/ext-base.js"></script>
	 	<!-- ENDLIBS -->
	
		<script type="text/javascript" src="../ext-all.js"></script>
		<script type="text/javascript" src="zh_cn.js"></script>
		<script src="FileUploadField.js"></script>
		<script type="text/javascript" src="purchase.js"></script>
	</head>
	<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" style="width: 1630px;">
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
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_middle"><a border="0" class="other_tab_label" href="../inventory/"><?=QApplication::Translate('Inventory')?></a></td>
									<td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_middle"><a border="0" class="other_tab_label" href="../contacts/"><?=QApplication::Translate('Contacts')?></a></td>
									<td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="current_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="current_tab_middle"><a class="current_tab_label" href="../purchase/index.php"><?=QApplication::Translate('Purchase')?></a></td>
									<td class="current_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="empty_tab_space"><img height="1" width="1" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_middle"><a class="other_tab_label" href="../admin/miscellaneous.php?type=1"><?=QApplication::Translate('Miscellaneous')?></a></td>
									<td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_middle"><a class="other_tab_label" href="../import_export/index.php"><?=QApplication::Translate('Import Export')?></a></td>
									<td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="other_tab_middle"><a class="other_tab_label" href="../admin/category_list.php"><?=QApplication::Translate('Admin')?></a></td>
									<td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
									<td class="empty_tab_space" width="600"> </td>
								</tr>
							</tbody></table>
						</td>
					</tr>
					<tr style="height: 20px; background-color: rgb(172, 172, 172);">
						<td>
							<table cellspacing="0" cellpadding="0">
								<tbody><tr>
									<td width="100%" style="padding-left: 10px; font-family: arial; color: rgb(255, 255, 255); font-size: 12px; font-weight: bold;">Welcome</td>
									<td><span style="display: none;" id="c4_ctl"><div style="padding: 0px 20px 14px 0px;" id="c4"><img height="16" width="16" alt="Please Wait..." src="/inventory/images/spinner_14.gif" class="spinner"/></div></span></td>
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
        
	<div style="position: relative;">
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
					<td align="center" width="30"><img name="shortcut0" src="/inventory/images/icons/calendar.gif"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="view-purchase-planned" class="graylink"><?=QApplication::Translate('View Purchase Planned')?></a></td>
				</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut1" src="/inventory/images/icons/search.gif"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="view-purchase-orders" class="graylink" href="#"><?=QApplication::Translate('Search Purchase Order')?></a></td>
				</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut2" src="/inventory/images/icons/inquiry.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="inquiry-purchase-orders" class="graylink" href="#"><?=QApplication::Translate('Inquiry Purchase Order')?></a></td>
				</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut3" src="/inventory/images/icons/approval.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="approval-purchase-orders" class="graylink" href="#"><?=QApplication::Translate('Approval Purchase Order')?></a></td>
				</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut4" src="/inventory/images/icons/delivery.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="purchase-in-transit" class="graylink" href="#"><?=QApplication::Translate('Purchase In Transit')?></a></td>
				</tr>
				<tr>
					<td align="center" width="30"><img name="shortcut5" src="/inventory/images/icons/purchase_to_stock.png"/></td><td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);"><a id="go-inventory-orders" class="graylink" href="#"><?=QApplication::Translate('Purchase To Inventory Order')?></a></td>
				</tr>
					
										</tbody></table>
									</td>
								</tr>
							</tbody></table></span></span><!-- End Shortcut Menu -->
			</td>
			<td>
				<img width="10" src="../images/empty.gif"/>
			</td>
			<td width="100%" valign="top"><?php 
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
						
			?>
				
			</td>
		</table>
	<h1 style="position: absolute; left: 180px; top: 0px;">请测试...</h2>
	<div id="purchase-planned-panel" style="position: absolute; left: 180px; top: 20px; width: 900px;"></div>
	<div id="purchase-orders-panel" style="position: absolute; left: 180px; top: 20px; width: 1024px;"></div>
	</div>
</body>
</html>