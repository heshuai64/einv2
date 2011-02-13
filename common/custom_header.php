<?php
    $role = array();
    $sql = "select role_id,short_description from role";
    $result = mysql_query($sql);
    while($row = mysql_fetch_assoc($result)){
            $role[$row['role_id']] = $row['short_description'];
    }
    
    $sql = "select role_id from user_account where user_account_id = ".$_SESSION['intUserAccountId'];
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $currency_role = $role[$row['role_id']];

    $custom_module = array(array('id'=>'inventory','label'=>QApplication::Translate('Inventory'),'role'=>''),
                           array('id'=>'contacts','label'=>QApplication::Translate('Contacts'),'role'=>''),
                           array('id'=>'purchase','label'=>QApplication::Translate('Purchase'),'role'=>array('Administrator', 'PPMC')),
                           array('id'=>'import_export','label'=>QApplication::Translate('Import Export'),'role'=>''),
                           array('id'=>'warehouse','label'=>QApplication::Translate('Warehouse'),'role'=>array('Administrator', 'PPMC')),
                           array('id'=>'status_manage','label'=>QApplication::Translate('Sku Status Manage'),'link'=>'../admin/status_manage.php','role'=>array('Administrator'))
                           );
    if(strpos($_SERVER['SCRIPT_NAME'], '.php')){
        $temp = explode("/", $_SERVER['SCRIPT_NAME']);
        $current_module = str_replace('.php', '', $temp[count($temp)-1]);
    }else{
        $temp = explode("/", $_SERVER['SCRIPT_NAME']);
        $current_module = $temp[count($temp)-2];
    }
    //var_dump($current_module);
?>

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
                        <?php
                            foreach($custom_module as $module){
                                if($module['id'] == $current_module){
                                    $class = "current";
                                }else{
                                    $class = "other";
                                }
                                if(empty($module['role']) || in_array($currency_role, $module['role'])){
                                    echo '<td class="empty_tab_space"><img height="1" width="1" src="../images/empty.gif"/></td>';
                                    echo '<td class="'.$class.'_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
                                        <td class="'.$class.'_tab_middle"><a border="0" class="'.$class.'_tab_label" href="'.((!empty($module['link']))?$module['link']:'../'.$module['id'].'/').'">'.$module['label'].'</a></td>
                                        <td class="'.$class.'_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
                                        ';
                                    echo '<td class="empty_tab_space"><img height="1" width="1" src="../images/empty.gif"/></td>';
                                }
                            }
                        ?>
                        
                        <?php if($currency_user_role == "Administrator"){?>
                        <td class="other_tab_left"><img height="1" width="12" src="../images/empty.gif"/></td>
                        <td class="other_tab_middle"><a class="other_tab_label" href="../admin/category_list.php"><?=QApplication::Translate('Admin')?></a></td>
                        <td class="other_tab_right"><img height="1" width="12" src="../images/empty.gif"/></td>
                        <?php }?>
                        <td class="empty_tab_space" width="600px;"> </td>
                </tr></tbody>
            </table>
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
        