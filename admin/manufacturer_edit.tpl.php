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

	include('../includes/header.inc.php');
	$this->RenderBegin();
?>
<!-- Begin Header Menu -->
<?php 
	$this->ctlHeaderMenu->Render();
?>
<!-- End Header Menu -->

<!-- Begin Shortcut Menu -->
<?php
	include('shortcut_menu.inc.php');
?>
<!-- End Shortcut Menu -->

		</td>
		<td>
			<img src="../images/empty.gif" width="10">
		</td>
		<td width="100%" valign="top">

	
		<div class="title">Manufacturers: <?php $this->lblHeaderManufacturer->Render(); ?></div>
		<table class="datagrid" cellpadding="5" cellspacing="0" border="0">
			<tr>
				<td class="record_header">
					<?php 
						$this->btnSave->Render();
						echo('&nbsp;');
						$this->btnDelete->Render();
						echo('&nbsp;');
						$this->btnCancel->RenderWithError();
					?>
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td class="record_field_name">Manufacturer Name: </td>
							<td class="record_field_edit"><?php $this->txtShortDescription->RenderWithError(); ?></td>
						</tr>
						<tr>
							<td class="record_field_name">Description: </td>
							<td class="record_field_edit"><?php $this->txtLongDescription->RenderWithError("Rows=10"); ?></td>
						</tr>
						<?php
						// Custom Fields
						if ($this->arrCustomFields) {
							foreach ($this->arrCustomFields as $field) {
								echo('<tr><td class="record_field_name">'.$field['lbl']->Name.': </td>');
								echo('<td class="record_field_edit"'.$field['input']->RenderWithError(false).'</td></tr>');
							}
						}
						?>
					</table>
				</td>
			</tr>
		</table>
		<br class="item_divider" />
	<?php $this->RenderEnd() ?>
	<?php require_once('../includes/footer.inc.php'); ?>