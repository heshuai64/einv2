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

$strTransactionHeader = null;
$strLocationName = null;

switch ($this->intTransactionTypeId) {
	case 1:  // Move
		$strTransactionHeader = '<div class="title">Move Assets</div>';
		$strLocationName = 'Move To:';
		break;
	case 2:  // Check In
		$strTransactionHeader = '<div class="title">Check In Assets</div>';
		$strLocationName = 'Check In To:';
		break;
	case 3:  // Check Out
		$strTransactionHeader = '<div class="title">Check Out Assets</div>';
		break;	
	case 8:  // Reserve
		$strTransactionHeader = '<div class="title">Reserve Assets</div>';
		break;	
	case 9:  // Unreserve
		$strTransactionHeader = '<div class="title">Unreserve Assets</div>';
		break;	
}

echo($strTransactionHeader);
?>
<br class="item_divider" />
<?php
$this->btnSave->RenderWithError();
echo('&nbsp;');
$this->btnCancel->RenderWithError();
?>
<table>
	<tr>
		<td class="record_field_name"><?php echo($strLocationName); ?></td>
		<td><?php $this->lstLocation->RenderWithError(); ?></td>
	</tr>
	<tr>
		<td class="record_field_name">Note: </td>
		<td><?php $this->txtNote->RenderWithError(); ?></td>
	</tr>
	<tr>
		<td class="record_field_name">Asset Code:</td>
		<td><?php $this->txtNewAssetCode->RenderWithError(); ?>&nbsp;<?php $this->btnAdd->Render(); ?></td>
	</tr>
</table>
<?php $this->dtgAssetTransact->RenderWithError(); ?>
