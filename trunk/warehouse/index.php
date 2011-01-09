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
                <!-- GC -->
	 	<!-- LIBS -->
	 	<script type="text/javascript" src="../adapter/ext/ext-base.js"></script>
	 	<!-- ENDLIBS -->
		<script type="text/javascript" src="../ext-all.js"></script>
                <script type="text/javascript" src="zh_cn.js"></script>
                <script type="text/javascript" src="warehouse.js"></script>
	</head>
	<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
	<?php
            include("../common/custom_header.php");
        ?>
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
                                                        <tbody>
                                                            <tr>
                                                                <td><img height="1" width="30" src="../images/empty.gif"/></td>
                                                                <td style="border-left: 1px solid rgb(204, 204, 204);"/>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="30"><img name="shortcut0" src="/inventory/images/icons/calendar.gif"/></td>
                                                                <td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);">
                                                                    <a id="position-management" class="graylink"><?=QApplication::Translate('Position Management')?></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" width="30"><img name="shortcut0" src="/inventory/images/icons/calendar.gif"/></td>
                                                                <td onmouseout="this.style.backgroundColor='#FFFFFF';" onmouseover="this.style.backgroundColor='#EEEEEE';" style="border-left: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); padding-left: 5px; cursor: pointer; background-color: rgb(255, 255, 255);">
                                                                    <a id="sku-info-search" class="graylink"><?=QApplication::Translate('SKU Search')?></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </td>
                                    </tr>
                            </tbody></table></span></span><!-- End Shortcut Menu -->
			</td>
			<td>
				<img width="10" src="../images/empty.gif"/>
			</td>
			<td width="100%" valign="top">
                            <div id="position-management-panel" style="position: absolute; top: 10px;"></div>
			    <div id="sku-management-panel" style="position: absolute; top: 10px;">
			</td>
		</table>
        </div>
        </body>
</html>