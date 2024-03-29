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
	 * 
	 * Original Qcodo code under the MIT License. See qcodo.inc.php for more information.
	 */

	abstract class QForm extends QFormBase {
		///////////////////////////
		// Form Preferences
		///////////////////////////

		/**
		 * If you wish to encrypt the resulting formstate data to be put on the form (via
		 * QCryptography), please specify a key to use.  The default cipher and encrypt mode
		 * on QCryptography will be used, and because the resulting encrypted data will be
		 * sent via HTTP POST, it will be Base64 encoded.
		 *
		 * @var string EncryptionKey the key to use, or NULL if no encryption is required
		 */
		public static $EncryptionKey = null;

		/**
		 * The QFormStateHandler to use to handle the actual serialized form.  By default,
		 * QFormStateHandler will be used (which simply outputs the entire serialized
		 * form data stream to the form), but file- and session- based, or any custom db-
		 * based FormState handling can be used as well.
		 *
		 * @var string FormStateHandler the classname of the FormState handler to use
		 */
		public static $FormStateHandler = 'QFormStateHandler';
		
		/**
		 * These are the list of core QForm JavaScript files, or JavaScript files needed by
		 * a QControl, which QForm should IGNORE trying to load during a RenderBegin() or RenderAjax() call.
		 * 
		 * In production or as a performance tweak, you may want to use the compressed "_qc_packed.js"
		 * library (which is a compressed, single file version of ALL the qcodo .js files that is in _core).
		 * 
		 * If you want to do this, MAKE SURE you FIRST MANUALLY do a <script> inclusion of "/assets/js/_core/_qc_packed.js" in
		 * your HTML.  Then, you can specify that QForm "ignore" all the other qcodo _core javascripts.
		 *
		 * @var array
		 */
		//protected $strIgnoreJavaScriptFileArray = array();
		protected $strIgnoreJavaScriptFileArray = array(
			'_core/calendar.js',
			'_core/calendar_popup.js',
			'_core/control.js',
			'_core/control_dialog.js',
			'_core/control_handle.js',
			'_core/control_move.js',
			'_core/control_resize.js',
			'_core/control_rollover.js',
			'_core/date_time_picker.js',
			'_core/event.js',
			'_core/listbox.js',
			'_core/logger.js',
			'_core/post.js',
			'_core/qcodo.js',
			'_core/treenav.js',
			'datagrid_column_toggle.js');
		
		// Declare DefaultWaitIcon public (instead of protected in QFormBase.inc) so that it can be set from a custom control
		// This can be removed once HeaderMenu is moved from a custom control to a QPanel.
		public $objDefaultWaitIcon;
		
		// This is simply to make RenderBegin publicly available
		public function RenderCsvBegin($blnDisplayOutput = true) {
			$this->RenderBegin($blnDisplayOutput);
		}
		
		// This is simply to make RenderEnd publicly available
		public function RenderCsvEnd($blnDisplayOutput = true) {
			$this->RenderEnd($blnDisplayOutput);
		}
	}
?>
