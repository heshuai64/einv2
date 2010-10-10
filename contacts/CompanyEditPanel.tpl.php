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
?>

<?php

	$arrCompanyFields[] = array('name' => QApplication::Translate('Company Name').':',  'value' => $_CONTROL->txtShortDescription->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Description').':',  'value' => $_CONTROL->txtLongDescription->RenderWithError(false));		
	$arrCompanyFields[] = array('name' => QApplication::Translate('Website').':',  'value' => $_CONTROL->txtWebsite->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Email').':',  'value' => $_CONTROL->txtEmail->RenderWithError(false));		
	$arrCompanyFields[] = array('name' => QApplication::Translate('Telephone').':',  'value' => $_CONTROL->txtTelephone->RenderWithError(false));	
	$arrCompanyFields[] = array('name' => QApplication::Translate('Fax').':',  'value' => $_CONTROL->txtFax->RenderWithError(false));
	
	// Custom Fields
	if ($_CONTROL->arrCustomFields) {
		foreach ($_CONTROL->arrCustomFields as $field) {
			if(!$this->blnEditMode || $field['blnView'])
				$arrCompanyFields[] = array('name' => QApplication::Translate($field['input']->Name).':', 'value' => $field['input']->RenderWithError(false));
		}
	}
	
	$arrCompanyFields[] = array('name' => QApplication::Translate('Address Name').':', 'value' => $_CONTROL->txtAddressShortDescription->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Address Line 1').':', 'value' => $_CONTROL->txtAddress1->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Address Line 2').':', 'value' => $_CONTROL->txtAddress2->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('City').':', 'value' => $_CONTROL->txtCity->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('State/Province').':', 'value' => $_CONTROL->lstStateProvince->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Postal Code').':', 'value' => $_CONTROL->txtPostalCode->RenderWithError(false));
	$arrCompanyFields[] = array('name' => QApplication::Translate('Country').':', 'value' => $_CONTROL->lstCountry->RenderWithError(false));
	
	if ($_CONTROL->arrAddressCustomFields) {
		foreach ($_CONTROL->arrAddressCustomFields as $field) {
			if(!$this->blnEditMode || $field['blnView'])
				$arrCompanyFields[] = array('name' => $field['input']->Name . ":", 'value' => $field['input']->RenderWithError(false));
		}
	}
	
?>

<table class="datagrid" cellpadding="5" cellspacing="0" border="0" >
	<tr>
		<td class="record_header" colspan="2">
			<?php 
				$_CONTROL->btnSave->Render();
				echo('&nbsp;');
				$_CONTROL->btnCancel->Render();
			?>
		</td>
	</tr>
	<?php 
		if($arrCompanyFields)foreach ($arrCompanyFields as $arrCompanyField) {
			echo '<tr>';
			echo('<td class="record_field_name">'. $arrCompanyField['name'] .'&nbsp;</td>');
			echo('<td class="record_field_value">'. $arrCompanyField['value'] .'&nbsp;</td>');
			echo('</tr>');
		}
	?>
</table>
